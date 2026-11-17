<?php

use App\Models\ZodiacSign;
use App\Models\Astrology;
use App\Models\BirthstoneMonth;
use App\Models\CustomJewelleryRequest;
use App\Models\CustomJewelleryQuotation;
use App\Models\ConsultationRequest;
use App\Models\Appointment;
use App\Models\Category;
use App\Models\Gem;
use App\Models\GemType;
use App\Models\JewelleryType;
use App\Models\ProductCollection;
use App\Models\Product360Preview;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderReturn;
use App\Models\Product;
use App\Models\ProductView;
use App\Models\ProductBirthstone;
use App\Models\ProductReview;
use App\Models\SiteNotification;
use App\Models\AdminActivityLog;
use App\Models\WishlistItem;
use App\Models\User;
use App\Models\Jewellery;
use App\Models\ContentPost;
use App\Models\ContactMessage;
use App\Models\FaqEntry;
use App\Models\NewsletterSubscriber;
use App\Services\MetalPriceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminContactMessageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContentPostController;
use App\Http\Controllers\ConsultationRequestController;
use App\Http\Controllers\ConsultationMessageController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\CustomJewelleryRequestController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\JewelleryController;
use App\Http\Controllers\GemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FaqEntryController;

if (!function_exists('redirectUserByRole')) {
    function redirectUserByRole(User $user)
    {
        if (Str::lower((string) ($user->account_status ?? '')) === 'blocked') {
            if (Auth::check() && Auth::id() === $user->id) {
                Auth::logout();
                request()->session()->invalidate();
                request()->session()->regenerateToken();
            }

            return redirect()->route('signin')->with('auth_error', 'Your account has been blocked. Please contact support.');
        }

        return match ($user->role) {
            'admin', 'lower_admin', 'content_manager' => redirect()->route('admin.dashboard'),
            'consultant' => redirect()->route('consultant.dashboard'),
            default => redirect()->route('home'),
        };
    }
}

if (!function_exists('abortUnlessRole')) {
    function abortUnlessRole(string $role): void
    {
        if (Auth::user()?->role !== $role) {
            abort(403);
        }
    }
}

if (!function_exists('ensureCustomerDashboardAccess')) {
    function ensureCustomerDashboardAccess()
    {
        $user = Auth::user();

        if (!$user) {
            abort(403);
        }

        if (Str::lower((string) ($user->account_status ?? '')) === 'blocked') {
            Auth::logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();

            return redirect()->route('signin')->with('auth_error', 'Your account has been blocked. Please contact support.');
        }

        if (in_array($user->role, ['admin', 'lower_admin', 'content_manager'], true)) {
            abort(403);
        }

        if ($user->role !== 'customer') {
            return redirectUserByRole($user);
        }

        return null;
    }
}

if (!function_exists('profileRedirectResponse')) {
    function profileRedirectResponse(Request $request, string $message, string $sessionKey = 'profile_success')
    {
        $redirectTo = $request->input('redirect_to');

        if ($redirectTo) {
            return redirect($redirectTo)->with($sessionKey, $message);
        }

        return back()->with($sessionKey, $message);
    }
}

function filterDashboardRows($rows, string $search, array $fields)
{
    $needle = Str::lower(trim($search));

    if ($needle === '') {
        return $rows->values();
    }

    return $rows->filter(function ($row) use ($needle, $fields) {
        foreach ($fields as $field) {
            $value = data_get($row, $field, '');
            if (is_array($value)) {
                $value = implode(' ', array_map('strval', $value));
            }
            $value = Str::lower((string) $value);
            if ($value !== '' && Str::contains($value, $needle)) {
                return true;
            }
        }

        return false;
    })->values();
}

function streamCsvDownload(string $filename, array $headers, $rows)
{
    return response()->streamDownload(function () use ($headers, $rows) {
        $handle = fopen('php://output', 'w');
        fputcsv($handle, $headers);

        foreach ($rows as $row) {
            fputcsv($handle, $row);
        }

        fclose($handle);
    }, $filename, [
        'Content-Type' => 'text/csv; charset=UTF-8',
    ]);
}

function adminReportSectionDefinition(string $section): array
{
    return match (Str::lower($section)) {
        'sales' => [
            'title' => 'Sales Report',
            'rows_key' => 'salesReportRows',
            'headers' => ['From Date', 'To Date', 'Category', 'Total Sales', 'Total Orders', 'Revenue'],
            'filter_key' => 'category',
            'filename' => 'sales-report',
        ],
        'orders' => [
            'title' => 'Order Report',
            'rows_key' => 'orderReportRows',
            'headers' => ['From Date', 'To Date', 'Status', 'Total Orders', 'Pickup-only', 'Cancelled'],
            'filter_key' => 'status',
            'filename' => 'order-report',
        ],
        'products' => [
            'title' => 'Product Report',
            'rows_key' => 'productReportRows',
            'headers' => ['From Date', 'To Date', 'Product Type', 'Top Selling', 'Most Viewed'],
            'filter_key' => 'product_type',
            'filename' => 'product-report',
        ],
        'inventory' => [
            'title' => 'Inventory Report',
            'rows_key' => 'inventoryReportRows',
            'headers' => ['From Date', 'To Date', 'Stock Status', 'Current Summary', 'Low Stock Items', 'Out of Stock'],
            'filter_key' => 'stock_status',
            'filename' => 'inventory-report',
        ],
        'customers' => [
            'title' => 'Customer Report',
            'rows_key' => 'customerReportRows',
            'headers' => ['From Date', 'To Date', 'Customer Type', 'Total', 'Top Buyer', 'Repeat Orders'],
            'filter_key' => 'customer_type',
            'filename' => 'customer-report',
        ],
        'consultations' => [
            'title' => 'Consultation Report',
            'rows_key' => 'consultationReportRows',
            'headers' => ['From Date', 'To Date', 'Consultation Type', 'Total Requests', 'Completed', 'Top Consultant'],
            'filter_key' => 'consultation_type',
            'filename' => 'consultation-report',
        ],
        'custom-jewellery' => [
            'title' => 'Custom Jewellery Report',
            'rows_key' => 'customJewelleryReportRows',
            'headers' => ['From Date', 'To Date', 'Request Status', 'Total Requests', 'Custom Demand', 'Quotation Acceptance'],
            'filter_key' => 'request_status',
            'filename' => 'custom-jewellery-report',
        ],
        'revenue' => [
            'title' => 'Revenue Analytics',
            'rows_key' => 'revenueReportRows',
            'headers' => ['From Date', 'To Date', 'Revenue Type', 'Top Selling Gem', 'Popular Category', 'Trend Insight'],
            'filter_key' => 'revenue_type',
            'filename' => 'revenue-analytics',
        ],
        default => abort(404),
    };
}

function adminReportFilterRows(array $rows, Request $request, string $filterKey): array
{
    $fromDate = trim((string) $request->query('from_date', ''));
    $toDate = trim((string) $request->query('to_date', ''));
    $filterValue = trim((string) $request->query($filterKey, ''));

    return collect($rows)
        ->filter(function (array $row) use ($fromDate, $toDate, $filterValue, $filterKey) {
            $rowFrom = trim((string) ($row['from_date'] ?? ''));
            $rowTo = trim((string) ($row['to_date'] ?? ''));
            $rowFilter = trim((string) ($row[$filterKey] ?? $row['category'] ?? $row['status'] ?? $row['product_type'] ?? $row['stock_status'] ?? $row['customer_type'] ?? $row['request_status'] ?? $row['revenue_type'] ?? ''));

            if ($fromDate !== '' && $rowFrom !== '-' && $rowFrom !== '' && $rowFrom < $fromDate) {
                return false;
            }

            if ($toDate !== '' && $rowTo !== '-' && $rowTo !== '' && $rowTo > $toDate) {
                return false;
            }

            if ($filterValue !== '' && Str::lower($rowFilter) !== Str::lower($filterValue)) {
                return false;
            }

            return true;
        })
        ->values()
        ->all();
}

function adminReportTextRows(array $headers, array $rows): array
{
    $lines = [];
    $lines[] = implode(' | ', $headers);

    foreach ($rows as $row) {
        $lines[] = implode(' | ', array_map(function ($value) {
            return trim(preg_replace('/\s+/', ' ', (string) $value));
        }, $row));
    }

    return $lines;
}

function adminReportXmlEscape(string $value): string
{
    return htmlspecialchars($value, ENT_XML1 | ENT_COMPAT, 'UTF-8');
}

function adminReportColumnName(int $index): string
{
    $name = '';
    $index++;

    while ($index > 0) {
        $remainder = ($index - 1) % 26;
        $name = chr(65 + $remainder) . $name;
        $index = intdiv($index - 1, 26);
    }

    return $name;
}

function adminReportTextLength(string $value): int
{
    return function_exists('mb_strlen') ? mb_strlen($value) : strlen($value);
}

function adminReportXlsxSheetXml(string $title, array $headers, array $rows): string
{
    $allRows = [];
    $allRows[] = array_merge([$title], array_fill(1, max(0, count($headers) - 1), ''));
    $allRows[] = $headers;

    foreach ($rows as $row) {
        $allRows[] = array_map(fn ($value) => (string) $value, $row);
    }

    $columnWidths = [];
    foreach ($headers as $columnIndex => $header) {
        $maxLength = adminReportTextLength((string) $header);
        foreach ($allRows as $rowValues) {
            $maxLength = max($maxLength, adminReportTextLength((string) ($rowValues[$columnIndex] ?? '')));
        }
        $columnWidths[$columnIndex] = min(max($maxLength + 4, 12), 42);
    }

    $sheetRows = [];
    foreach ($allRows as $rowIndex => $rowValues) {
        $cells = [];
        foreach ($rowValues as $cellIndex => $value) {
            if ($rowIndex === 0 && $cellIndex > 0) {
                continue;
            }

            $ref = adminReportColumnName($cellIndex) . ($rowIndex + 1);
            $cells[] = '<c r="' . $ref . '" t="inlineStr"><is><t xml:space="preserve">' . adminReportXmlEscape((string) $value) . '</t></is></c>';
        }
        $sheetRows[] = '<row r="' . ($rowIndex + 1) . '">' . implode('', $cells) . '</row>';
    }

    $dimensionEnd = adminReportColumnName(max(0, count($headers) - 1)) . (count($allRows));
    $columnXml = '';
    foreach ($columnWidths as $columnIndex => $width) {
        $columnXml .= '<col min="' . ($columnIndex + 1) . '" max="' . ($columnIndex + 1) . '" width="' . $width . '" customWidth="1"/>';
    }

    return '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
        . '<worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships">'
        . '<dimension ref="A1:' . $dimensionEnd . '"/>'
        . '<sheetViews><sheetView workbookViewId="0"/></sheetViews>'
        . '<sheetFormatPr defaultRowHeight="20"/>'
        . '<cols>' . $columnXml . '</cols>'
        . '<sheetData>' . implode('', $sheetRows) . '</sheetData>'
        . '</worksheet>';
}

function adminReportXlsxBinary(string $title, array $headers, array $rows): string
{
    $tempPath = tempnam(sys_get_temp_dir(), 'report_xlsx_');
    if ($tempPath === false) {
        abort(500, 'Unable to create report export.');
    }

    $zipPath = $tempPath . '.xlsx';
    @unlink($tempPath);

    $zip = new ZipArchive();
    if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
        abort(500, 'Unable to build Excel export.');
    }

    $zip->addFromString('[Content_Types].xml', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types"><Default Extension="rels" ContentType="application/vnd.openxmlformats-package.relationships+xml"/><Default Extension="xml" ContentType="application/xml"/><Override PartName="/xl/workbook.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet.main+xml"/><Override PartName="/xl/worksheets/sheet1.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml"/><Override PartName="/docProps/app.xml" ContentType="application/vnd.openxmlformats-officedocument.extended-properties+xml"/><Override PartName="/docProps/core.xml" ContentType="application/vnd.openxmlformats-package.core-properties+xml"/></Types>');
    $zip->addFromString('_rels/.rels', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships"><Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument" Target="xl/workbook.xml"/><Relationship Id="rId2" Type="http://schemas.openxmlformats.org/package/2006/relationships/metadata/core-properties" Target="docProps/core.xml"/><Relationship Id="rId3" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/extended-properties" Target="docProps/app.xml"/></Relationships>');
    $zip->addFromString('docProps/app.xml', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Properties xmlns="http://schemas.openxmlformats.org/officeDocument/2006/extended-properties" xmlns:vt="http://schemas.openxmlformats.org/officeDocument/2006/docPropsVTypes"><Application>Laravel</Application><DocSecurity>0</DocSecurity><ScaleCrop>false</ScaleCrop><Company>Pinwantha Gems & Jewellery</Company><LinksUpToDate>false</LinksUpToDate><SharedDoc>false</SharedDoc><HyperlinksChanged>false</HyperlinksChanged><AppVersion>1.0</AppVersion></Properties>');
    $zip->addFromString('docProps/core.xml', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><cp:coreProperties xmlns:cp="http://schemas.openxmlformats.org/package/2006/metadata/core-properties" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:dcterms="http://purl.org/dc/terms/" xmlns:dcmitype="http://purl.org/dc/dcmitype/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"><dc:creator>Pinwantha Gems & Jewellery</dc:creator><cp:lastModifiedBy>Pinwantha Gems & Jewellery</cp:lastModifiedBy><dcterms:created xsi:type="dcterms:W3CDTF">' . now()->toAtomString() . '</dcterms:created><dcterms:modified xsi:type="dcterms:W3CDTF">' . now()->toAtomString() . '</dcterms:modified></cp:coreProperties>');
    $zip->addFromString('xl/workbook.xml', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><workbook xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships"><sheets><sheet name="' . adminReportXmlEscape(Str::limit($title, 31, '')) . '" sheetId="1" r:id="rId1"/></sheets></workbook>');
    $zip->addFromString('xl/_rels/workbook.xml.rels', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships"><Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet" Target="worksheets/sheet1.xml"/></Relationships>');
    $zip->addFromString('xl/worksheets/sheet1.xml', adminReportXlsxSheetXml($title, $headers, $rows));
    $zip->close();

    $binary = file_get_contents($zipPath);
    @unlink($zipPath);

    if ($binary === false) {
        abort(500, 'Unable to read Excel export.');
    }

    return $binary;
}

function adminReportPdfEscape(string $text): string
{
    return str_replace(['\\', '(', ')'], ['\\\\', '\\(', '\\)'], $text);
}

function adminReportPdfTextLength(string $text): int
{
    return function_exists('mb_strlen') ? mb_strlen($text) : strlen($text);
}

function adminReportPdfTruncate(string $text, int $maxCharacters): string
{
    $text = trim(preg_replace('/\s+/', ' ', $text) ?? '');

    if ($maxCharacters < 4) {
        return substr($text, 0, max(0, $maxCharacters));
    }

    if (adminReportPdfTextLength($text) <= $maxCharacters) {
        return $text;
    }

    return rtrim(substr($text, 0, $maxCharacters - 3)) . '...';
}

function adminReportPdfColumnWidths(array $headers, array $rows, int $availableWidth = 523): array
{
    $weights = [];
    $columnCount = count($headers);

    for ($index = 0; $index < $columnCount; $index++) {
        $headerText = strtolower((string) ($headers[$index] ?? ''));
        $maxLength = adminReportPdfTextLength((string) ($headers[$index] ?? ''));
        foreach ($rows as $row) {
            $maxLength = max($maxLength, adminReportPdfTextLength((string) ($row[$index] ?? '')));
        }
        $weight = max(10, min(30, $maxLength));

        if (preg_match('/(date|time)/i', $headerText)) {
            $weight = max($weight, 14);
        } elseif (preg_match('/(status|category|type|customer|product|request|consultation|method|name)/i', $headerText)) {
            $weight = max($weight, 20);
        } elseif (preg_match('/(total|amount|revenue|sales|orders|count|pickup|cancelled|completed|balance|paid|outstanding|stock|value|price)/i', $headerText)) {
            $weight = max($weight, 14);
        } else {
            $weight = max($weight, 12);
        }

        $weights[$index] = $weight;
    }

    $totalWeight = array_sum($weights) ?: $columnCount;
    $widths = [];
    $remainingWidth = $availableWidth;
    $remainingWeight = $totalWeight;

    foreach ($weights as $index => $weight) {
        $isLast = $index === array_key_last($weights);
        if ($isLast) {
            $widths[$index] = max(44, $remainingWidth);
            break;
        }

        $rawWidth = (int) round(($availableWidth * $weight) / $totalWeight);
        $headerText = strtolower((string) ($headers[$index] ?? ''));
        $minWidth = 72;
        $maxWidth = 150;

        if (preg_match('/(date|time)/i', $headerText)) {
            $minWidth = 76;
            $maxWidth = 98;
        } elseif (preg_match('/(status|category|type|customer|product|request|consultation|method|name)/i', $headerText)) {
            $minWidth = 94;
            $maxWidth = 180;
        } elseif (preg_match('/(total|amount|revenue|sales|orders|count|pickup|cancelled|completed|balance|paid|outstanding|stock|value|price)/i', $headerText)) {
            $minWidth = 72;
            $maxWidth = 110;
        } elseif ($index < 2) {
            $minWidth = 68;
            $maxWidth = 94;
        }

        $width = max($minWidth, min($maxWidth, $rawWidth));
        $widths[$index] = $width;
        $remainingWidth -= $width;
        $remainingWeight -= $weight;
    }

    if ($remainingWidth < 44) {
        $delta = 44 - $remainingWidth;
        $widths[array_key_last($widths)] = max(44, ($widths[array_key_last($widths)] ?? 0) - $delta);
    }

    return $widths;
}

function adminReportPdfBuildPageStream(string $title, array $headers, array $rows, int $pageNumber, int $pageCount, array $meta = []): string
{
    $pageWidth = 595;
    $pageHeight = 842;
    $marginX = 36;
    $topY = 780;
    $tableTopY = 708;
    $rowHeight = 22;
    $headerHeight = 24;
    $availableWidth = 523;
    $widths = adminReportPdfColumnWidths($headers, $rows, $availableWidth);
    $reportTitle = trim((string) ($meta['report_title'] ?? $title));
    $sectionLabel = trim((string) ($meta['section_label'] ?? ''));
    $dateRange = trim((string) ($meta['date_range'] ?? ''));
    $subtitle = trim((string) ($meta['subtitle'] ?? 'Pinwantha Gems & Jewellery Admin Report Export'));

    $commands = [];
    $commands[] = 'q';
    $commands[] = '1 1 1 rg';
    $commands[] = '0 0 ' . $pageWidth . ' ' . $pageHeight . ' re f';
    $commands[] = '0.78 0.61 0.36 rg';
    $commands[] = '0 ' . ($pageHeight - 70) . ' ' . $pageWidth . ' 70 re f';
    $commands[] = '0.17 0.14 0.11 rg';
    $commands[] = 'BT';
    $commands[] = '/F1 26 Tf';
    $commands[] = '1 0 0 1 ' . $marginX . ' ' . ($topY - 24) . ' Tm';
    $commands[] = '(' . adminReportPdfEscape($reportTitle) . ') Tj';
    $commands[] = 'ET';
    $commands[] = 'BT';
    $commands[] = '/F1 9 Tf';
    $commands[] = '0.34 0.25 0.16 rg';
    $commands[] = '1 0 0 1 ' . $marginX . ' ' . ($topY - 44) . ' Tm';
    $commands[] = '(' . adminReportPdfEscape($subtitle) . ') Tj';
    $commands[] = 'ET';
    $commands[] = '0.97 0.95 0.91 rg';
    $commands[] = '0 ' . ($pageHeight - 126) . ' ' . $pageWidth . ' 126 re f';
    $commands[] = '0.91 0.85 0.76 RG';
    $commands[] = '0.91 0.85 0.76 rg';
    $commands[] = '0 ' . ($pageHeight - 126) . ' ' . $pageWidth . ' 126 re S';
    $commands[] = '0.34 0.25 0.16 rg';
    $commands[] = 'BT';
    $commands[] = '/F1 11 Tf';
    $commands[] = '1 0 0 1 ' . $marginX . ' ' . ($pageHeight - 98) . ' Tm';
    $commands[] = '(Generated ' . adminReportPdfEscape(now()->format('Y-m-d H:i')) . ') Tj';
    $commands[] = 'ET';
    $commands[] = 'BT';
    $commands[] = '/F1 9 Tf';
    $commands[] = '1 0 0 1 ' . $marginX . ' ' . ($pageHeight - 114) . ' Tm';
    $commands[] = '(Page ' . $pageNumber . ' of ' . $pageCount . ') Tj';
    $commands[] = 'ET';
    if ($sectionLabel !== '') {
        $commands[] = 'BT';
        $commands[] = '/F1 9 Tf';
        $commands[] = '1 0 0 1 ' . $marginX . ' ' . ($pageHeight - 130) . ' Tm';
        $commands[] = '(' . adminReportPdfEscape($sectionLabel) . ') Tj';
        $commands[] = 'ET';
    }
    if ($dateRange !== '') {
        $commands[] = 'BT';
        $commands[] = '/F1 9 Tf';
        $commands[] = '1 0 0 1 ' . $marginX . ' ' . ($pageHeight - 146) . ' Tm';
        $commands[] = '(Date Range: ' . adminReportPdfEscape($dateRange) . ') Tj';
        $commands[] = 'ET';
    }

    $xPositions = [$marginX];
    foreach ($widths as $index => $width) {
        $xPositions[$index + 1] = $xPositions[$index] + $width;
    }

    $headerRowY = $tableTopY;
    $commands[] = '0.86 0.67 0.35 rg';
    $commands[] = $marginX . ' ' . $headerRowY . ' ' . $availableWidth . ' ' . $headerHeight . ' re f';
    $commands[] = '0.82 0.64 0.34 RG';
    $commands[] = $marginX . ' ' . $headerRowY . ' ' . $availableWidth . ' ' . $headerHeight . ' re S';

    $commands[] = 'BT';
    $commands[] = '/F1 8 Tf';
    $commands[] = '1 1 1 rg';
    foreach ($headers as $index => $header) {
        $cellX = $xPositions[$index] + 6;
        $cellWidth = $widths[$index] - 12;
        $commands[] = '1 0 0 1 ' . $cellX . ' ' . ($headerRowY + 8) . ' Tm';
        $commands[] = '(' . adminReportPdfEscape(adminReportPdfTruncate((string) $header, max(8, (int) floor($cellWidth / 4.2)))) . ') Tj';
    }
    $commands[] = 'ET';

    $startY = $headerRowY - $rowHeight;
    foreach ($rows as $rowIndex => $row) {
        $rowY = $startY - ($rowIndex * $rowHeight);
        $fill = $rowIndex % 2 === 0 ? '0.99 0.97 0.94 rg' : '1 1 1 rg';
        $commands[] = $fill;
        $commands[] = $marginX . ' ' . $rowY . ' ' . $availableWidth . ' ' . $rowHeight . ' re f';
        $commands[] = '0.92 0.87 0.79 RG';
        $commands[] = $marginX . ' ' . $rowY . ' ' . $availableWidth . ' ' . $rowHeight . ' re S';
        $commands[] = '0.19 0.16 0.12 rg';
        $commands[] = 'BT';
        $commands[] = '/F1 8 Tf';

        foreach ($headers as $index => $header) {
            $cellX = $xPositions[$index] + 5;
            $cellWidth = $widths[$index] - 10;
            $maxChars = max(8, (int) floor($cellWidth / 4.3));
            $value = adminReportPdfTruncate((string) ($row[$index] ?? ''), $maxChars);
            $rightAligned = preg_match('/(total|amount|revenue|sales|orders|count|pickup|cancelled|completed|repeat|low|out of stock|stock|rate)/i', (string) $header) === 1;
            if ($rightAligned) {
                $textWidth = max(20, min($cellWidth - 6, adminReportPdfTextLength($value) * 4.2));
                $cellX = $xPositions[$index + 1] - $textWidth - 4;
            }
            $commands[] = '1 0 0 1 ' . $cellX . ' ' . ($rowY + 7) . ' Tm';
            $commands[] = '(' . adminReportPdfEscape($value) . ') Tj';
        }
        $commands[] = 'ET';
    }

    $commands[] = 'Q';

    return implode("\n", $commands);
}

function adminReportPdfBinary(string $title, array $headers, array $rows, array $meta = []): string
{
    $pageRows = 28;
    $chunks = array_chunk($rows, $pageRows);
    $pageCount = max(1, count($chunks));
    $pages = [];
    $logoBinary = adminReportPdfLogoBinary();

    foreach ($chunks as $index => $chunkRows) {
        $pages[] = adminReportPdfBuildPageStream($title, $headers, $chunkRows, $index + 1, $pageCount, $meta);
    }

    if (empty($pages)) {
        $pages[] = adminReportPdfBuildPageStream($title, $headers, [], 1, 1, $meta);
    }

    $objects = [];
    $objects[] = '<< /Type /Catalog /Pages 2 0 R >>';
    $kids = [];
    $pageCount = count($pages);
    $basePageObjectId = 3;
    $fontObjectId = 3 + ($pageCount * 2);

    for ($i = 0; $i < $pageCount; $i++) {
        $pageObjectId = $basePageObjectId + ($i * 2);
        $contentObjectId = $pageObjectId + 1;
        $kids[] = $pageObjectId . ' 0 R';
        $objects[] = '<< /Type /Page /Parent 2 0 R /MediaBox [0 0 595 842] /Resources << /Font << /F1 ' . $fontObjectId . ' 0 R >> >> /Contents ' . $contentObjectId . ' 0 R >>';
        $content = $pages[$i];
        $objects[] = '<< /Length ' . strlen($content) . ' >> stream' . "\n" . $content . "\n" . 'endstream';
    }
    $objects[1] = '<< /Type /Pages /Kids [' . implode(' ', $kids) . '] /Count ' . $pageCount . ' >>';
    $objects[] = '<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>';
    if ($logoBinary !== null) {
        $objects[] = '<< /Type /XObject /Subtype /Image /Width 220 /Height 220 /ColorSpace /DeviceRGB /BitsPerComponent 8 /Filter /DCTDecode /Length ' . strlen($logoBinary) . ' >> stream' . "\n" . $logoBinary . "\n" . 'endstream';
    }

    $pdf = "%PDF-1.4\n";
    $offsets = [0];
    foreach ($objects as $index => $object) {
        $offsets[] = strlen($pdf);
        $pdf .= ($index + 1) . " 0 obj\n" . $object . "\nendobj\n";
    }
    $xrefPos = strlen($pdf);
    $pdf .= "xref\n0 " . (count($objects) + 1) . "\n";
    $pdf .= "0000000000 65535 f \n";
    for ($i = 1; $i < count($offsets); $i++) {
        $pdf .= str_pad((string) $offsets[$i], 10, '0', STR_PAD_LEFT) . " 00000 n \n";
    }
    $pdf .= "trailer\n<< /Size " . (count($objects) + 1) . " /Root 1 0 R >>\nstartxref\n{$xrefPos}\n%%EOF";

    return $pdf;
}

function adminReportXlsxTempFile(string $title, array $headers, array $rows): string
{
    $tempPath = tempnam(sys_get_temp_dir(), 'report_xlsx_');
    if ($tempPath === false) {
        abort(500, 'Unable to create report export.');
    }

    $zipPath = $tempPath . '.xlsx';
    @unlink($tempPath);

    $zip = new ZipArchive();
    if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
        abort(500, 'Unable to build Excel export.');
    }

    $zip->addFromString('[Content_Types].xml', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types"><Default Extension="rels" ContentType="application/vnd.openxmlformats-package.relationships+xml"/><Default Extension="xml" ContentType="application/xml"/><Override PartName="/xl/workbook.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet.main+xml"/><Override PartName="/xl/worksheets/sheet1.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml"/><Override PartName="/docProps/app.xml" ContentType="application/vnd.openxmlformats-officedocument.extended-properties+xml"/><Override PartName="/docProps/core.xml" ContentType="application/vnd.openxmlformats-package.core-properties+xml"/></Types>');
    $zip->addFromString('_rels/.rels', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships"><Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument" Target="xl/workbook.xml"/><Relationship Id="rId2" Type="http://schemas.openxmlformats.org/package/2006/relationships/metadata/core-properties" Target="docProps/core.xml"/><Relationship Id="rId3" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/extended-properties" Target="docProps/app.xml"/></Relationships>');
    $zip->addFromString('docProps/app.xml', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Properties xmlns="http://schemas.openxmlformats.org/officeDocument/2006/extended-properties" xmlns:vt="http://schemas.openxmlformats.org/officeDocument/2006/docPropsVTypes"><Application>Laravel</Application><DocSecurity>0</DocSecurity><ScaleCrop>false</ScaleCrop><Company>Pinwantha Gems & Jewellery</Company><LinksUpToDate>false</LinksUpToDate><SharedDoc>false</SharedDoc><HyperlinksChanged>false</HyperlinksChanged><AppVersion>1.0</AppVersion></Properties>');
    $zip->addFromString('docProps/core.xml', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><cp:coreProperties xmlns:cp="http://schemas.openxmlformats.org/package/2006/metadata/core-properties" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:dcterms="http://purl.org/dc/terms/" xmlns:dcmitype="http://purl.org/dc/dcmitype/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"><dc:creator>Pinwantha Gems & Jewellery</dc:creator><cp:lastModifiedBy>Pinwantha Gems & Jewellery</cp:lastModifiedBy><dcterms:created xsi:type="dcterms:W3CDTF">' . now()->toAtomString() . '</dcterms:created><dcterms:modified xsi:type="dcterms:W3CDTF">' . now()->toAtomString() . '</dcterms:modified></cp:coreProperties>');
    $zip->addFromString('xl/workbook.xml', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><workbook xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships"><sheets><sheet name="' . adminReportXmlEscape(Str::limit($title, 31, '')) . '" sheetId="1" r:id="rId1"/></sheets></workbook>');
    $zip->addFromString('xl/_rels/workbook.xml.rels', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships"><Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet" Target="worksheets/sheet1.xml"/></Relationships>');
    $zip->addFromString('xl/worksheets/sheet1.xml', adminReportXlsxSheetXml($title, $headers, $rows));
    $zip->close();

    return $zipPath;
}

function adminReportDownloadResponse(string $section, string $format, string $title, array $headers, array $rows, array $meta = [])
{
    $format = Str::lower($format);
    $baseFilename = Str::slug($section) . '-' . now()->format('Y-m-d-His');

    return match ($format) {
        'pdf' => response()->streamDownload(function () use ($title, $headers, $rows, $meta) {
            echo adminReportPdfBinary($title, $headers, $rows, $meta);
        }, $baseFilename . '.pdf', [
            'Content-Type' => 'application/pdf',
        ]),
        'xlsx' => response()->download(
            adminReportXlsxTempFile($title, $headers, $rows),
            $baseFilename . '.xlsx',
            ['Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']
        )->deleteFileAfterSend(true),
        default => streamCsvDownload($baseFilename . '.csv', $headers, $rows),
    };
}

function formatAdminProductRow(Product $product): array
{
    $preview360 = productSupports360Preview($product) && product360PreviewTableExists()
        ? ($product->relationLoaded('preview360') ? $product->getRelation('preview360') : null)
        : null;
    $categoryName = trim((string) ($product->category?->name ?? ''));
    $resolvedCategory = $categoryName ?: ($product->collection ? 'Collections' : ($product->gem ? 'Gems' : 'Products'));
    $stock = (int) ($product->stock ?? 0);
    $status = $stock <= 0 ? 'Out of Stock' : ($stock <= 5 ? 'Low' : 'Active');
    $isGemProduct = Str::lower($resolvedCategory) === 'gems';
    $isCollectionProduct = Str::lower($resolvedCategory) === 'collections';

    $gemType = $product->gem?->gemType?->name
        ?? $product->jewellery?->type?->name
        ?? ($isCollectionProduct ? 'Collection' : null)
        ?? '-';
    $color = $product->gem?->color ?: '-';
    $shape = $product->gem?->shape ?: '-';
    $caratWeight = $product->gem?->carat_weight !== null ? (string) $product->gem->carat_weight : '-';

    $metal = $product->jewellery?->metal ?: 'N/A';
    if ($isCollectionProduct) {
        $metal = $product->collection?->metal ?: 'N/A';
    }
    $metalPurity = $product->jewellery?->metal_purity ?: '-';
    $metalWeight = $product->jewellery?->metal_weight !== null ? (string) $product->jewellery->metal_weight : '-';
    $makingCharge = $product->jewellery?->making_charge !== null ? (string) $product->jewellery->making_charge : '-';
    $wastage = $product->jewellery?->wastage_percent !== null ? (string) $product->jewellery->wastage_percent : '-';
    $marketFactor = $product->jewellery?->market_factor !== null ? (string) $product->jewellery->market_factor : '-';
    $occasion = $product->jewellery?->occasion ?: '-';
    $gender = $product->jewellery?->gender ?: '-';
    $gemstone = $product->jewellery?->gemstone ?: ($gemType ?: '-');
    if ($isCollectionProduct) {
        $occasion = $product->collection?->occasion ?: '-';
        $gender = $product->collection?->gender ?: '-';
        $gemstone = $product->collection?->gemstone ?: '-';
    }
    $jewelleryType = $product->jewellery?->type?->name ?: '-';
    $pricingMode = $isCollectionProduct
        ? 'Static'
        : ($product->jewellery?->pricing_mode ? Str::title((string) $product->jewellery->pricing_mode) : '-');
    $description = trim((string) ($product->description ?? '')) ?: 'Premium quality product with certified authenticity.';
    $mainImage = $product->image ?: '';
    $fallbackPrice = (float) $product->getRawOriginal('price');
    $displayPrice = $fallbackPrice;
    if (!$isCollectionProduct && $product->jewellery && Str::lower((string) ($product->jewellery->pricing_mode ?? 'dynamic')) === 'dynamic') {
        try {
            $displayPrice = (float) app(\App\Services\JewelleryPricingService::class)->priceForProduct($product, $fallbackPrice);
        } catch (\Throwable $e) {
            $displayPrice = $fallbackPrice;
        }
    }
    $sizeLabel = trim((string) ($product->size_label ?? ''));
    $sizeOptions = trim((string) ($product->size_options ?? ''));

    return [
        'db_id' => $product->product_id,
        'product_id' => 'PRD-' . str_pad((string) $product->product_id, 3, '0', STR_PAD_LEFT),
        'name' => $product->name,
        'category' => $resolvedCategory,
        'price_value' => $displayPrice,
        'fallback_price' => $fallbackPrice,
        'price' => 'LKR ' . number_format($displayPrice, 2),
        'stock' => $stock,
        'status' => $status,
        'status_class' => match ($status) {
            'Active' => 'ok',
            'Low' => 'warn',
            'Out of Stock' => 'bad',
            default => 'info',
        },
        'gem_type' => $gemType,
        'jewellery_type' => $jewelleryType,
        'collection_occasion' => $occasion,
        'collection_gender' => $gender,
        'collection_gemstone' => $gemstone,
        'collection_metal' => $metal,
        'color' => $isGemProduct ? $color : '-',
        'shape' => $isGemProduct ? $shape : '-',
        'carat_weight' => $isGemProduct ? $caratWeight : '-',
        'metal' => $metal,
        'metal_purity' => $metalPurity,
        'occasion' => $occasion,
        'gender' => $gender,
        'gemstone' => $gemstone,
        'metal_weight' => $metalWeight,
        'making_charge' => $makingCharge,
        'wastage' => $wastage,
        'market_factor' => $marketFactor,
        'pricing_mode' => $pricingMode,
        'discount' => '0',
        'description' => $description,
        'main_image' => $mainImage,
        'size_label' => $sizeLabel,
        'size_options' => $sizeOptions,
        'size_options_list' => $sizeOptions !== ''
            ? collect(preg_split('/\s*,\s*/', $sizeOptions, -1, PREG_SPLIT_NO_EMPTY))->map(fn ($option) => trim((string) $option))->filter()->values()->all()
            : [],
        'preview_360_available' => $preview360 ? 'Yes' : 'No',
        'preview_360_count' => $preview360?->frame_count ?? 0,
        'preview_360_folder' => $preview360?->folder_path ?? '',
        'preview_360_images' => $preview360?->frame_files ?? [],
        'high_value' => $stock <= 5 ? 'Yes' : 'No',
        'featured' => 'No',
        'discounted' => 'No',
        'new_arrival' => 'No',
        'initials' => collect(explode(' ', (string) $product->name))
            ->filter()
            ->map(fn ($part) => strtoupper(substr($part, 0, 1)))
            ->take(2)
            ->implode(''),
        'search_blob' => Str::lower(implode(' ', array_filter([
            (string) $product->product_id,
            $product->name,
            $resolvedCategory,
            $description,
            $gemType,
            $jewelleryType,
            $metal,
            $metalPurity,
            $status,
        ]))),
    ];
}

function product360FolderPath(Product $product): string
{
    $slug = Str::slug(trim((string) $product->name));
    $folderName = trim($slug, '-');

    if ($folderName === '') {
        $folderName = 'product-' . $product->product_id;
    } else {
        $folderName .= '-' . $product->product_id;
    }

    return 'images/Preview/' . $folderName;
}

function product360PreviewTableExists(): bool
{
    return Schema::hasTable('product_360_previews');
}

function productSupports360Preview(Product $product): bool
{
    if (!$product->relationLoaded('jewellery')) {
        $product->loadMissing('jewellery');
    }

    return (bool) $product->jewellery;
}

function getProduct360PreviewIfAvailable(Product $product): ?Product360Preview
{
    if (!product360PreviewTableExists() || !productSupports360Preview($product)) {
        return null;
    }

    return $product->relationLoaded('preview360')
        ? $product->getRelation('preview360')
        : $product->preview360;
}

function normalizeJewelleryGender(?string $gender): ?string
{
    $value = Str::lower(trim((string) $gender));

    return match ($value) {
        'male', 'man', 'men' => 'Male',
        'female', 'woman', 'women' => 'Female',
        'unisex' => 'Unisex',
        default => $gender !== null ? Str::title(trim($gender)) : null,
    };
}

function productBaseRelations(): array
{
    $relations = ['category', 'jewellery.type', 'gem.gemType', 'collection'];

    if (product360PreviewTableExists()) {
        $relations[] = 'preview360';
    }

    return $relations;
}

function deleteProduct360PreviewFiles(?Product360Preview $preview): void
{
    if (!$preview) {
        return;
    }

    $folderPath = public_path(trim($preview->folder_path, '/'));
    if (File::exists($folderPath)) {
        File::deleteDirectory($folderPath);
    }
}

function storeOptimizedPreviewFrame($file, string $absolutePath, string $baseName, int $quality = 88): string
{
    $sourcePath = $file->getRealPath();
    $imageData = $sourcePath ? file_get_contents($sourcePath) : false;

    if ($imageData === false) {
        throw new RuntimeException('Unable to read preview image.');
    }

    $image = @imagecreatefromstring($imageData);
    if ($image === false) {
        $targetExtension = strtolower((string) $file->getClientOriginalExtension() ?: 'jpg');
        $fileName = $baseName . '.' . ($targetExtension ?: 'jpg');
        $file->move($absolutePath, $fileName);
        return $fileName;
    }

    $targetExtension = function_exists('imagewebp') ? 'webp' : 'jpg';
    $fileName = $baseName . '.' . $targetExtension;
    $targetPath = $absolutePath . DIRECTORY_SEPARATOR . $fileName;

    if ($targetExtension === 'webp') {
        imagepalettetotruecolor($image);
        imagealphablending($image, true);
        imagesavealpha($image, true);
        imagewebp($image, $targetPath, $quality);
    } else {
        imagejpeg($image, $targetPath, $quality);
    }

    imagedestroy($image);
    return $fileName;
}

function storeProduct360PreviewFiles(Product $product, Request $request, ?Product360Preview $existingPreview = null): ?Product360Preview
{
    if (!product360PreviewTableExists()) {
        return $existingPreview;
    }

    if (!productSupports360Preview($product)) {
        if ($existingPreview) {
            deleteProduct360PreviewFiles($existingPreview);
            $existingPreview->delete();
        }

        return null;
    }

    if (!$request->hasFile('preview_360_images')) {
        return $existingPreview;
    }

    $files = $request->file('preview_360_images');
    $files = is_array($files) ? array_values(array_filter($files)) : [];

    if (count($files) !== 8) {
        throw ValidationException::withMessages([
            'preview_360_images' => 'Please upload exactly 8 images for the 360 preview.',
        ]);
    }

    if ($existingPreview) {
        deleteProduct360PreviewFiles($existingPreview);
        $existingPreview->delete();
    }

    $folderPath = product360FolderPath($product);
    $absolutePath = public_path($folderPath);
    if (!File::exists($absolutePath)) {
        File::makeDirectory($absolutePath, 0755, true);
    }

    $storedFiles = [];
    foreach ($files as $index => $file) {
        $frameNumber = str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT);
        $fileName = storeOptimizedPreviewFrame($file, $absolutePath, $frameNumber, 88);
        $storedFiles[] = $fileName;
    }

    return Product360Preview::query()->updateOrCreate(
        ['product_id' => $product->product_id],
        [
            'folder_path' => $folderPath,
            'frame_count' => count($storedFiles),
            'frame_files' => $storedFiles,
            'uploaded_by' => Auth::id(),
        ]
    );
}

function tryStoreProduct360PreviewFiles(Product $product, Request $request, ?Product360Preview $existingPreview = null): ?Product360Preview
{
    try {
        return storeProduct360PreviewFiles($product, $request, $existingPreview);
    } catch (Throwable $e) {
        report($e);
        return $existingPreview;
    }
}

function adminDashboardUserManagementData(Request $request): array
{
    $allUsers = User::query()
        ->orderByDesc('created_at')
        ->get();

    $consultationRequests = ConsultationRequest::query()
        ->with(['customer', 'consultant', 'messages'])
        ->latest()
        ->get();

    $appointmentRequests = Appointment::query()
        ->with(['customer', 'consultant'])
        ->latest()
        ->get();

    $consultants = $allUsers
        ->where('role', 'consultant')
        ->values();

    $customerUsersRaw = $allUsers
        ->where('role', 'customer')
        ->values()
        ->map(function (User $user, int $index) {
            $firstName = (string) ($user->first_name ?? '');
            $lastName = (string) ($user->last_name ?? '');
            $fullName = trim((($user->first_name ?? '') . ' ' . ($user->last_name ?? ''))) ?: 'Customer';

            return [
                'db_id' => $user->id,
                'user_id' => (string) $user->id,
                'first_name' => $firstName,
                'last_name' => $lastName,
                'name' => $fullName,
                'email' => $user->email,
                'phone' => $user->phone_number ?: '-',
                'birth_date' => $user->birth_date ? (is_object($user->birth_date) && method_exists($user->birth_date, 'format')
                    ? $user->birth_date->format('Y-m-d')
                    : \Illuminate\Support\Carbon::parse((string) $user->birth_date)->format('Y-m-d')) : '',
                'registration_date' => $user->created_at?->toDateString() ?: '-',
                'status' => $user->account_status ?: ($user->email_verified_at ? 'Active' : 'Inactive'),
                'initials' => collect(explode(' ', $fullName))->filter()->map(fn ($part) => strtoupper(substr($part, 0, 1)))->take(2)->implode(''),
            ];
        });

    $consultantUsersRaw = $consultants
        ->values()
        ->map(function (User $user, int $index) use ($consultationRequests) {
            $firstName = (string) ($user->first_name ?? '');
            $lastName = (string) ($user->last_name ?? '');
            $fullName = trim((($user->first_name ?? '') . ' ' . ($user->last_name ?? ''))) ?: 'Consultant';
            $assignedConsultations = $consultationRequests->where('consultant_id', $user->id)->count();

            return [
                'db_id' => $user->id,
                'consultant_id' => (string) $user->id,
                'first_name' => $firstName,
                'last_name' => $lastName,
                'name' => $fullName,
                'email' => $user->email,
                'phone' => $user->phone_number ?: '-',
                'birth_date' => $user->birth_date ? (is_object($user->birth_date) && method_exists($user->birth_date, 'format')
                    ? $user->birth_date->format('Y-m-d')
                    : \Illuminate\Support\Carbon::parse((string) $user->birth_date)->format('Y-m-d')) : '',
                'assigned_customers' => $consultationRequests->where('consultant_id', $user->id)->pluck('user_id')->unique()->count(),
                'availability' => $assignedConsultations > 20 ? 'Busy' : 'Available',
                'status' => $user->account_status ?: 'Active',
                'initials' => collect(explode(' ', $fullName))->filter()->map(fn ($part) => strtoupper(substr($part, 0, 1)))->take(2)->implode(''),
            ];
        });

    $adminUsersRaw = $allUsers
        ->whereIn('role', ['admin', 'lower_admin', 'content_manager'])
        ->values()
        ->map(function (User $user, int $index) {
            $fullName = trim((($user->first_name ?? '') . ' ' . ($user->last_name ?? ''))) ?: 'Admin';
            $roleLabel = Str::title(str_replace('_', ' ', $user->role));
            $permissions = $user->role === 'admin'
                ? ['All permissions']
                : $user->effectiveAdminPermissions();

            return [
                'db_id' => $user->id,
                'admin_id' => (string) $user->id,
                'first_name' => $user->first_name ?: '',
                'last_name' => $user->last_name ?: '',
                'name' => $fullName,
                'email' => $user->email,
                'phone' => $user->phone_number ?: '-',
                'birth_date' => $user->birth_date ? (is_object($user->birth_date) && method_exists($user->birth_date, 'format')
                    ? $user->birth_date->format('Y-m-d')
                    : \Illuminate\Support\Carbon::parse((string) $user->birth_date)->format('Y-m-d')) : '',
                'role_label' => $roleLabel,
                'role_key' => $user->role,
                'updated_on' => $user->updated_at?->format('Y-m-d H:i') ?: '-',
                'status' => $user->account_status ?: 'Active',
                'permissions_list' => $permissions,
                'permissions_label' => implode(', ', $permissions),
                'permissions_count' => count($permissions),
                'initials' => collect(explode(' ', $fullName))->filter()->map(fn ($part) => strtoupper(substr($part, 0, 1)))->take(2)->implode(''),
            ];
        });

    $customerSearch = (string) $request->query('customer_search', '');
    $customerStatus = trim((string) $request->query('customer_status', ''));
    $customerUsers = filterDashboardRows($customerUsersRaw, $customerSearch, ['user_id', 'name', 'email', 'phone', 'status']);
    if ($customerStatus !== '' && Str::lower($customerStatus) !== 'all status') {
        $customerUsers = $customerUsers->filter(function (array $user) use ($customerStatus) {
            return Str::lower((string) ($user['status'] ?? '')) === Str::lower($customerStatus);
        })->values();
    }

    $consultantSearch = (string) $request->query('consultant_search', '');
    $consultantStatus = trim((string) $request->query('consultant_status', ''));
    $consultantUsers = filterDashboardRows($consultantUsersRaw, $consultantSearch, ['consultant_id', 'name', 'email', 'phone', 'status']);
    if ($consultantStatus !== '' && Str::lower($consultantStatus) !== 'all status') {
        $consultantUsers = $consultantUsers->filter(function (array $user) use ($consultantStatus) {
            return Str::lower((string) ($user['status'] ?? '')) === Str::lower($consultantStatus);
        })->values();
    }

    $adminSearch = (string) $request->query('admin_search', '');
    $adminRole = trim((string) $request->query('admin_role', ''));
    $adminUsers = filterDashboardRows($adminUsersRaw, $adminSearch, ['admin_id', 'name', 'email', 'phone', 'role_label', 'status']);
    if ($adminRole !== '' && Str::lower($adminRole) !== 'all roles') {
        $adminUsers = $adminUsers->filter(function (array $user) use ($adminRole) {
            return Str::lower((string) ($user['role_label'] ?? '')) === Str::lower($adminRole);
        })->values();
    }

    $roleSearch = (string) $request->query('role_search', '');
    $roleRows = collect([
        [
            'role' => 'admin',
            'description' => 'Full system control',
            'permissions' => ['All permissions'],
            'user_count' => $adminUsersRaw->where('role_label', 'Admin')->count(),
        ],
        [
            'role' => 'lower_admin',
            'description' => 'Orders, products, inventory, custom jewellery, consultations and contact messages',
            'permissions' => [
                'manage_orders',
                'manage_products',
                'manage_inventory',
                'manage_custom_jewellery',
                'manage_consultations',
                'manage_contact_messages',
            ],
            'user_count' => $adminUsersRaw->where('role_label', 'Lower Admin')->count(),
        ],
        [
            'role' => 'content_manager',
            'description' => 'Content, reports and notifications',
            'permissions' => [
                'manage_content',
                'manage_reports',
                'manage_notifications',
            ],
            'user_count' => $adminUsersRaw->where('role_label', 'Content Manager')->count(),
        ],
    ]);
    if ($roleSearch !== '') {
        $roleRows = filterDashboardRows($roleRows, $roleSearch, ['role', 'description', 'permissions']);
    }

    $adminActivityLogsRaw = AdminActivityLog::query()
        ->with('actor')
        ->latest()
        ->take(50)
        ->get()
        ->map(function (AdminActivityLog $log) {
            $actionKey = strtolower($log->action);
            $statusClass = match ($actionKey) {
                'deleted' => 'bad',
                'blocked' => 'bad',
                'unblocked' => 'ok',
                'created', 'updated', 'role updated', 'permissions updated' => 'ok',
                default => 'info',
            };
            $statusLabel = match ($actionKey) {
                'deleted' => 'Deleted',
                'blocked' => 'Blocked',
                'unblocked' => 'Unblocked',
                default => 'Success',
            };

            return [
                'log_id' => 'LOG-' . str_pad((string) ($log->id), 4, '0', STR_PAD_LEFT),
                'user_name' => $log->actor_name,
                'role' => Str::title(str_replace('_', ' ', $log->actor_role)),
                'action' => $log->summary,
                'module' => $log->module,
                'date_time' => $log->created_at?->format('Y-m-d H:i') ?: '-',
                'ip_device' => trim(($log->ip_address ?: '-') . ' / ' . Str::limit((string) $log->user_agent, 24, '')),
                'status_class' => $statusClass,
                'status_label' => $statusLabel,
            ];
        });

    $logSearch = (string) $request->query('log_search', '');
    $logAction = trim((string) $request->query('log_action', ''));
    $logDate = trim((string) $request->query('log_date', ''));
    $adminActivityLogs = filterDashboardRows($adminActivityLogsRaw, $logSearch, ['log_id', 'user_name', 'role', 'action', 'module', 'ip_device', 'status_label']);
    if ($logAction !== '' && Str::lower($logAction) !== 'all actions') {
        $adminActivityLogs = $adminActivityLogs->filter(function (array $log) use ($logAction) {
            return Str::contains(Str::lower((string) ($log['action'] ?? '')), Str::lower($logAction));
        })->values();
    }
    if ($logDate !== '') {
        $adminActivityLogs = $adminActivityLogs->filter(function (array $log) use ($logDate) {
            return Str::startsWith((string) ($log['date_time'] ?? ''), $logDate);
        })->values();
    }

    $roleRows = $roleRows->map(function (array $roleRow) use ($adminUsersRaw) {
        $roleLabel = Str::title(str_replace('_', ' ', $roleRow['role']));
        $permissions = $roleRow['permissions'];

        $roleRow['user_count'] = $adminUsersRaw->where('role_label', $roleLabel)->count();
        return $roleRow;
    });

    $uniqueAdminPermissions = $roleRows
        ->flatMap(fn ($role) => $role['permissions'])
        ->reject(fn ($permission) => $permission === 'All permissions')
        ->unique()
        ->values();

    $consultationMetrics = [
        'total_requests' => $consultationRequests->count(),
        'pending_requests' => $consultationRequests->where('status', 'Pending')->count(),
        'approved_requests' => $consultationRequests->where('status', 'Approved')->count(),
        'completed_requests' => $consultationRequests->where('status', 'Completed')->count(),
        'rejected_requests' => $consultationRequests->where('status', 'Rejected')->count(),
    ];

    $appointmentMetrics = [
        'total_appointments' => $appointmentRequests->count(),
        'pending_appointments' => $appointmentRequests->where('status', 'Pending')->count(),
        'confirmed_appointments' => $appointmentRequests->where('status', 'Confirmed')->count(),
        'completed_appointments' => $appointmentRequests->where('status', 'Completed')->count(),
        'cancelled_appointments' => $appointmentRequests->where('status', 'Cancelled')->count(),
    ];

    $buildStatusOptions = function ($items, array $preferredOrder = []) {
        $statuses = collect($items)
            ->filter()
            ->map(fn ($status) => trim((string) $status))
            ->filter()
            ->unique()
            ->values();

        $orderedPreferred = collect($preferredOrder)
            ->filter(fn ($status) => $statuses->contains($status))
            ->values();

        $remaining = $statuses
            ->reject(fn ($status) => in_array($status, $preferredOrder, true))
            ->sort()
            ->values();

        return $orderedPreferred->merge($remaining)->values()->all();
    };

    $consultationStatusOptions = $buildStatusOptions(
        $consultationRequests->pluck('status'),
        ['Pending', 'Approved', 'Completed', 'Rejected', 'Cancelled']
    );

    $appointmentStatusOptions = $buildStatusOptions(
        $appointmentRequests->pluck('status'),
        ['Pending', 'Confirmed', 'Completed', 'Cancelled']
    );

    $consultationPendingTypeMetrics = $consultationRequests
        ->where('status', 'Pending')
        ->groupBy(function (ConsultationRequest $consultationRequest) {
            return trim((string) ($consultationRequest->display_request_type ?: $consultationRequest->request_type ?: 'Consultation'));
        })
        ->map(function ($items, string $typeLabel) {
            return [
                'label' => $typeLabel,
                'count' => $items->count(),
            ];
        })
        ->sortByDesc('count')
        ->values()
        ->take(2);

    $consultationTypeOptions = $consultationRequests
        ->map(function (ConsultationRequest $consultationRequest) {
            return trim((string) ($consultationRequest->display_request_type ?: $consultationRequest->request_type ?: 'Consultation'));
        })
        ->filter()
        ->unique()
        ->values()
        ->all();

    $consultationTopConsultant = $consultationRequests
        ->whereNotNull('consultant_id')
        ->groupBy(function (ConsultationRequest $consultationRequest) {
            return trim((string) ($consultationRequest->consultant_name ?: 'Unassigned'));
        })
        ->sortByDesc(fn ($items) => $items->count())
        ->keys()
        ->first() ?: 'Unassigned';

    $consultationReportRows = $consultationRequests
        ->groupBy(function (ConsultationRequest $consultationRequest) {
            return trim((string) ($consultationRequest->display_request_type ?: $consultationRequest->request_type ?: 'Consultation'));
        })
        ->map(function ($items, string $typeLabel) {
            $sortedItems = $items->sortBy(function (ConsultationRequest $consultationRequest) {
                return $consultationRequest->created_at?->timestamp ?? 0;
            })->values();

            $topConsultant = $items
                ->whereNotNull('consultant_id')
                ->groupBy(function (ConsultationRequest $consultationRequest) {
                    return trim((string) ($consultationRequest->consultant_name ?: 'Unassigned'));
                })
                ->sortByDesc(fn ($group) => $group->count())
                ->keys()
                ->first() ?: 'Unassigned';

            return [
                'from_date' => $sortedItems->first()?->created_at?->format('Y-m-d') ?? '-',
                'to_date' => $sortedItems->last()?->created_at?->format('Y-m-d') ?? '-',
                'type' => $typeLabel,
                'total_requests' => $items->count(),
                'completed_requests' => $items->where('status', 'Completed')->count(),
                'top_consultant' => $topConsultant,
            ];
        })
        ->sortByDesc('total_requests')
        ->values();

    $userMetrics = [
        'customers_total' => $customerUsers->count(),
        'customers_active' => $customerUsers->where('status', 'Active')->count(),
        'customers_blocked' => $customerUsers->where('status', 'Blocked')->count(),
        'customers_new_this_month' => $customerUsers->filter(fn ($user) => $user['registration_date'] !== '-' && Str::startsWith($user['registration_date'], now()->format('Y-m')))->count(),
        'consultants_total' => $consultantUsers->count(),
        'consultants_active' => $consultantUsers->where('status', 'Active')->count(),
        'consultants_blocked' => $consultantUsers->where('status', 'Blocked')->count(),
        'admins_total' => $adminUsers->count(),
        'admin_roles_total' => $roleRows->count(),
        'permissions_total' => $uniqueAdminPermissions->count(),
        'restricted_roles_total' => $roleRows->where('role', '!=', 'admin')->count(),
    ];

    $activityLogMetrics = [
        'total_activities' => $adminActivityLogs->count(),
        'created_today' => $adminActivityLogs->filter(fn ($log) => Str::contains($log['action'] ?? '', 'Created'))->count(),
        'changes_today' => $adminActivityLogs->filter(fn ($log) => Str::contains($log['action'] ?? '', 'Updated') || Str::contains($log['action'] ?? '', 'Role') || Str::contains($log['action'] ?? '', 'Permission') || Str::contains($log['action'] ?? '', 'Blocked') || Str::contains($log['action'] ?? '', 'Unblocked'))->count(),
        'deleted_today' => $adminActivityLogs->filter(fn ($log) => Str::contains($log['action'] ?? '', 'Deleted'))->count(),
    ];

    return [
        'consultationRequests' => $consultationRequests,
        'appointmentRequests' => $appointmentRequests,
        'consultants' => $consultants,
        'consultationMetrics' => $consultationMetrics,
        'appointmentMetrics' => $appointmentMetrics,
        'consultationStatusOptions' => $consultationStatusOptions,
        'appointmentStatusOptions' => $appointmentStatusOptions,
        'consultationPendingTypeMetrics' => $consultationPendingTypeMetrics,
        'consultationTypeOptions' => $consultationTypeOptions,
        'consultationTopConsultant' => $consultationTopConsultant,
        'consultationReportRows' => $consultationReportRows,
        'customerUsers' => $customerUsers,
        'consultantUsers' => $consultantUsers,
        'adminUsers' => $adminUsers,
        'roleRows' => $roleRows,
        'userMetrics' => $userMetrics,
        'adminActivityLogs' => $adminActivityLogs,
        'activityLogMetrics' => $activityLogMetrics,
        'filteredRoleRows' => $roleRows,
    ];
}

function adminDashboardProductData(Request $request): array
{
    $productsRaw = Product::query()
        ->with(productBaseRelations())
        ->orderByDesc('product_id')
        ->get()
        ->map(fn (Product $product) => formatAdminProductRow($product));

    $inventoryRowsRaw = Product::query()
        ->with(productBaseRelations())
        ->orderBy('name')
        ->get()
        ->map(function (Product $product) {
            $stock = (int) ($product->stock ?? 0);
            $categoryName = trim((string) ($product->category?->name ?? ''));
            $resolvedCategory = $categoryName ?: ($product->collection ? 'Collections' : ($product->gem ? 'Gems' : 'Products'));
            $status = $stock > 15 ? 'Healthy' : ($stock === 0 ? 'Out of Stock' : ($stock < 5 ? 'Critical' : 'Low'));

            return [
                'db_id' => $product->product_id,
                'item_id' => 'INV-' . str_pad((string) $product->product_id, 3, '0', STR_PAD_LEFT),
                'product_id' => 'PRD-' . str_pad((string) $product->product_id, 3, '0', STR_PAD_LEFT),
                'name' => $product->name,
                'category' => $resolvedCategory,
                'stock' => $stock,
                'status' => $status,
                'status_class' => match ($status) {
                    'Healthy' => 'ok',
                    'Low' => 'warn',
                    'Critical' => 'bad',
                    'Out of Stock' => 'bad',
                    default => 'info',
                },
                'search_blob' => Str::lower(implode(' ', array_filter([
                    (string) $product->product_id,
                    $product->name,
                    $resolvedCategory,
                    (string) $stock,
                    $status,
                ]))),
            ];
        });

    $lowStockRowsRaw = $inventoryRowsRaw
        ->filter(fn (array $row) => (int) ($row['stock'] ?? 0) <= 15)
        ->values();

    $outOfStockRowsRaw = $inventoryRowsRaw
        ->filter(fn (array $row) => (int) ($row['stock'] ?? 0) === 0)
        ->values();

    $inventoryHistoryRowsRaw = AdminActivityLog::query()
        ->where('module', 'Inventory')
        ->latest()
        ->take(50)
        ->get()
        ->map(function (AdminActivityLog $log) {
            $summary = (string) $log->summary;
            $qtyChange = '-';
            if (preg_match('/([+-]\d+|\d+)\s*$/', $summary, $matches)) {
                $qtyChange = $matches[1];
            }

            return [
                'log_id' => 'HIS-' . str_pad((string) $log->id, 3, '0', STR_PAD_LEFT),
                'user' => $log->actor_name,
                'action' => $log->action,
                'item' => $log->subject_type ?: 'Product',
                'qty_change' => $qtyChange,
                'date_time' => $log->created_at?->format('Y-m-d H:i') ?: '-',
                'status_class' => match (Str::lower((string) $log->action)) {
                    'created', 'updated', 'added', 'adjusted' => 'ok',
                    'deleted' => 'bad',
                    default => 'info',
                },
                'status_label' => $log->action,
            ];
        });

    $reviewRowsRaw = ProductReview::query()
        ->with(['product', 'user'])
        ->latest()
        ->get()
        ->map(function (ProductReview $review) {
            $productName = $review->product?->name ?: 'Product';
            $customerName = $review->name ?: trim((string) ($review->user?->first_name . ' ' . $review->user?->last_name)) ?: 'Customer';
            $comment = trim((string) $review->review);
            $status = Str::title((string) $review->status);

            return [
                'db_id' => $review->id,
                'review_id' => 'REV-' . str_pad((string) $review->id, 4, '0', STR_PAD_LEFT),
                'customer' => $customerName,
                'product' => $productName,
                'rating' => (int) $review->rating,
                'comment' => $comment,
                'status' => $status,
                'status_class' => match (Str::lower((string) $review->status)) {
                    'approved' => 'ok',
                    'rejected' => 'bad',
                    default => 'warn',
                },
                'date' => $review->created_at?->format('Y-m-d') ?: '-',
                'product_db_id' => $review->product_id,
                'customer_email' => $review->email,
                'search_blob' => Str::lower(implode(' ', array_filter([
                    (string) $review->id,
                    $customerName,
                    $productName,
                    (string) $review->rating,
                    $comment,
                    $status,
                ]))),
            ];
        });

    $productCategoryRowsRaw = Category::query()
        ->withCount('products')
        ->orderBy('name')
        ->get()
        ->map(function (Category $category) {
            $productCount = (int) ($category->products_count ?? 0);

            return [
                'db_id' => $category->category_id,
                'name' => $category->name,
                'product_count' => $productCount,
                'status' => $productCount > 0 ? 'Active' : 'Empty',
                'status_class' => $productCount > 0 ? 'ok' : 'warn',
                'initials' => collect(explode(' ', (string) $category->name))
                    ->filter()
                    ->map(fn ($part) => strtoupper(substr($part, 0, 1)))
                    ->take(2)
                    ->implode(''),
            ];
        });

    $jewelleryTypeRowsRaw = JewelleryType::query()
        ->withCount('jewellery')
        ->orderBy('name')
        ->get()
        ->map(function (JewelleryType $type) {
            $productCount = (int) ($type->jewellery_count ?? 0);

            return [
                'db_id' => $type->type_id,
                'name' => $type->name,
                'product_count' => $productCount,
                'status' => $productCount > 0 ? 'Active' : 'Empty',
                'status_class' => $productCount > 0 ? 'ok' : 'warn',
                'initials' => collect(explode(' ', (string) $type->name))
                    ->filter()
                    ->map(fn ($part) => strtoupper(substr($part, 0, 1)))
                    ->take(2)
                    ->implode(''),
                'search_blob' => Str::lower(implode(' ', array_filter([
                    (string) $type->type_id,
                    $type->name,
                    (string) $productCount,
                ]))),
            ];
        });

    $gemTypeRowsRaw = GemType::query()
        ->withCount('gems')
        ->orderBy('name')
        ->get()
        ->map(function (GemType $type) {
            $productCount = (int) ($type->gems_count ?? 0);

            return [
                'db_id' => $type->gem_type_id,
                'name' => $type->name,
                'product_count' => $productCount,
                'status' => $productCount > 0 ? 'Active' : 'Empty',
                'status_class' => $productCount > 0 ? 'ok' : 'warn',
                'initials' => collect(explode(' ', (string) $type->name))
                    ->filter()
                    ->map(fn ($part) => strtoupper(substr($part, 0, 1)))
                    ->take(2)
                    ->implode(''),
                'search_blob' => Str::lower(implode(' ', array_filter([
                    (string) $type->gem_type_id,
                    $type->name,
                    (string) $productCount,
                ]))),
            ];
        });

    $products = $productsRaw->values();

    $productMetrics = [
        'total_products' => $productsRaw->count(),
        'jewellery_products' => $productsRaw->filter(fn (array $product) => Str::contains(Str::lower((string) ($product['category'] ?? '')), 'jewel'))->count(),
        'gem_products' => $productsRaw->filter(fn (array $product) => Str::contains(Str::lower((string) ($product['category'] ?? '')), 'gem'))->count(),
        'active_products' => $productsRaw->where('status', 'Active')->count(),
        'low_stock_products' => $productsRaw->where('status', 'Low')->count(),
        'out_of_stock_products' => $productsRaw->where('status', 'Out of Stock')->count(),
        'filtered_products' => $productsRaw->count(),
        'total_categories' => $jewelleryTypeRowsRaw->count(),
    ];

    $inventoryMetrics = [
        'total_skus' => $inventoryRowsRaw->count(),
        'healthy' => $inventoryRowsRaw->where('status', 'Healthy')->count(),
        'low' => $inventoryRowsRaw->where('status', 'Low')->count(),
        'critical' => $inventoryRowsRaw->where('status', 'Critical')->count(),
        'out_of_stock' => $inventoryRowsRaw->where('status', 'Out of Stock')->count(),
    ];

    return [
        'productRows' => $products,
        'inventoryRows' => $inventoryRowsRaw,
        'lowStockRows' => $lowStockRowsRaw,
        'outOfStockRows' => $outOfStockRowsRaw,
        'inventoryHistoryRows' => $inventoryHistoryRowsRaw,
        'reviewRows' => $reviewRowsRaw,
        'categoryRows' => $jewelleryTypeRowsRaw,
        'productCategoryRows' => $productCategoryRowsRaw,
        'jewelleryTypeRows' => $jewelleryTypeRowsRaw,
        'productCategoryOptions' => $productCategoryRowsRaw->pluck('name')->filter()->push('Collections')->unique()->values(),
        'stockProductOptions' => $inventoryRowsRaw->map(function (array $row) {
            return [
                'db_id' => $row['db_id'],
                'name' => $row['name'],
                'stock' => $row['stock'],
                'status' => $row['status'],
            ];
        })->values(),
        'gemTypeRows' => $gemTypeRowsRaw,
        'gemTypeOptions' => $gemTypeRowsRaw->pluck('name')->filter()->values(),
        'jewelleryTypeOptions' => $jewelleryTypeRowsRaw->pluck('name')->filter()->values(),
        'productMetrics' => $productMetrics,
        'inventoryMetrics' => $inventoryMetrics,
    ];
}

function adminDashboardOrderData(Request $request): array
{
    $ordersRaw = Order::query()
        ->with(['items'])
        ->latest()
        ->get()
        ->map(function (Order $order) {
            $customerName = trim((string) (($order->first_name ?? '') . ' ' . ($order->last_name ?? ''))) ?: 'Customer';
            $items = $order->items->values();
            $productNames = $items->pluck('product_name')->map(fn ($name) => trim((string) $name))->filter()->values();
            $displayProducts = $productNames->take(2)->implode(', ');

            if ($productNames->count() > 2) {
                $displayProducts .= ' + ' . ($productNames->count() - 2) . ' more';
            }

            if ($displayProducts === '') {
                $displayProducts = 'Order items';
            }

            $totalAmount = (float) ($order->total ?? ((float) $order->subtotal + (float) $order->shipping_cost));
            $pickupOnly = (bool) $order->pickup_only;
            $shippingMethod = Str::lower((string) ($order->shipping_method ?? 'standard'));
            if ($shippingMethod === 'free') {
                $shippingMethod = 'standard';
            }
            $isPickupOrder = $pickupOnly || $shippingMethod === 'pickup';
            $isPickupFullyPaid = $pickupOnly && in_array(Str::lower((string) $order->status), ['completed', 'pickup completed'], true);
            $depositAmount = (float) ($isPickupFullyPaid
                ? $totalAmount
                : ($order->deposit_amount ?? ($pickupOnly ? round(((float) $order->subtotal) * 0.2, 2) : $totalAmount)));
            $balanceDue = (float) ($isPickupFullyPaid
                ? 0
                : ($order->balance_due ?? ($pickupOnly ? max(((float) $order->subtotal) - $depositAmount, 0) : 0)));
            $status = Str::title(trim((string) ($order->status ?: 'Pending')));
            $statusClass = match (Str::lower((string) $order->status)) {
                'completed' => 'ok',
                'processing' => 'info',
                'cancelled' => 'bad',
                default => 'warn',
            };
            $paymentMethod = match (Str::lower((string) $order->payment_method)) {
                'card' => 'Card',
                'bank' => 'Bank Transfer',
                'cod' => 'Cash on Delivery',
                'cash_on_pickup', 'cash on pickup', 'pickup' => 'Cash on Delivery',
                default => Str::title(str_replace('_', ' ', (string) $order->payment_method)),
            };
            $shippingMethodLabel = match ($shippingMethod) {
                'standard' => 'Standard Shipping',
                'express' => 'Express Shipping',
                'pickup' => 'Store Pickup',
                default => Str::title(str_replace('_', ' ', $shippingMethod)),
            };
            $pickupConfig = $pickupOnly ? 'Pickup Only (Auto)' : ($shippingMethod === 'pickup' ? 'Store Pickup' : 'Standard Delivery');
            $placedBy = $customerName;

            return [
                'db_id' => $order->id,
                'order_id' => $order->order_number,
                'customer_name' => $customerName,
                'placed_by' => $placedBy,
                'products' => $displayProducts,
                'payment_method' => $paymentMethod,
                'payment_method_key' => Str::lower((string) ($order->payment_method ?? '')),
                'shipping_method' => $shippingMethod,
                'shipping_method_label' => $shippingMethodLabel,
                'receipt_image' => $order->receipt_image ? asset($order->receipt_image) : '',
                'order_date' => $order->created_at?->toDateString() ?: '-',
                'order_type' => $isPickupOrder ? 'pickup' : 'delivery',
                'pickup_only' => $pickupOnly,
                'pickup_config' => $pickupConfig,
                'deposit_amount' => $depositAmount,
                'balance_due' => $balanceDue,
                'status' => $status,
                'status_class' => $statusClass,
                'total_amount' => 'Rs ' . number_format($totalAmount, 0),
                'total_value' => $totalAmount,
                'search_blob' => Str::lower(implode(' ', array_filter([
                    (string) $order->order_number,
                    $customerName,
                    $displayProducts,
                    $paymentMethod,
                    $shippingMethodLabel,
                    $status,
                    $pickupConfig,
                    'deposit',
                    $isPickupOrder ? 'pickup' : 'delivery',
                ]))),
            ];
        });

    $totalOrders = $ordersRaw->count();
    $pendingToday = $ordersRaw->filter(function (array $order) {
        return ($order['order_date'] ?? '') === now()->toDateString() && Str::contains(Str::lower((string) ($order['status'] ?? '')), 'pending');
    })->count();
    $pickupOrders = $ordersRaw->filter(fn (array $order) => !empty($order['pickup_only']) || Str::lower((string) ($order['shipping_method'] ?? '')) === 'pickup')->count();
    $pickupOnlyOrders = $ordersRaw->where('pickup_only', true)->count();
    $highValueOrders = $ordersRaw->filter(function (array $order) {
        $amount = (float) preg_replace('/[^0-9.]/', '', (string) ($order['total_amount'] ?? '0'));
        return $amount >= 40000;
    })->count();

    $orderMetrics = [
        'total_orders' => $totalOrders,
        'pending_today' => $pendingToday,
        'pickup_orders' => $pickupOrders,
        'pickup_only_orders' => $pickupOnlyOrders,
        'high_value_orders' => $highValueOrders,
    ];

    $deliveryOrderRows = $ordersRaw->filter(fn (array $order) => Str::contains(Str::lower((string) ($order['status'] ?? '')), 'out for delivery'))->values();
    $pickupOrderRows = $ordersRaw->filter(function (array $order) {
        return !empty($order['pickup_only'])
            || Str::lower((string) ($order['shipping_method'] ?? '')) === 'pickup'
            || Str::contains(Str::lower((string) ($order['status'] ?? '')), 'pickup')
            || Str::lower((string) ($order['payment_method'] ?? '')) === '20% deposit';
    })->values();

    return [
        'orderRows' => $ordersRaw,
        'orderMetrics' => $orderMetrics,
        'deliveryOrderRows' => $deliveryOrderRows,
        'pickupOrderRows' => $pickupOrderRows,
    ];
}

function adminDashboardReturnData(Request $request): array
{
    $returnRows = OrderReturn::query()
        ->with(['order', 'user', 'reviewedBy'])
        ->latest()
        ->get()
        ->map(function (OrderReturn $returnRequest) {
            $customerName = trim((string) (($returnRequest->user?->first_name ?? '') . ' ' . ($returnRequest->user?->last_name ?? ''))) ?: 'Customer';
            $orderNumber = $returnRequest->order?->order_number ?: 'Order';
            $decision = $returnRequest->decision ?: 'Pending Review';
            $refundStatus = $returnRequest->refund_status ?: 'In Progress';
            $reviewedBy = trim((string) (($returnRequest->reviewedBy?->first_name ?? '') . ' ' . ($returnRequest->reviewedBy?->last_name ?? ''))) ?: '-';

            return [
                'db_id' => $returnRequest->id,
                'request_id' => $returnRequest->request_number,
                'order_id' => $orderNumber,
                'order_db_id' => $returnRequest->order_id,
                'customer_name' => $customerName,
                'reason' => $returnRequest->reason,
                'requested_date' => $returnRequest->created_at?->toDateString() ?: '-',
                'decision' => $decision,
                'decision_class' => $returnRequest->decision_class,
                'refund_status' => $refundStatus,
                'refund_status_class' => $returnRequest->refund_status_class,
                'refund_amount' => $returnRequest->refund_amount !== null ? 'Rs ' . number_format((float) $returnRequest->refund_amount, 0) : '-',
                'refund_amount_value' => (float) ($returnRequest->refund_amount ?? 0),
                'admin_note' => $returnRequest->admin_note ?: '-',
                'reviewed_by' => $reviewedBy,
                'reviewed_at' => $returnRequest->reviewed_at?->toDateTimeString() ?: '-',
                'order_status' => Str::title((string) ($returnRequest->order?->status ?? 'Completed')),
                'search_blob' => Str::lower(implode(' ', array_filter([
                    (string) $returnRequest->request_number,
                    $orderNumber,
                    $customerName,
                    $returnRequest->reason,
                    $decision,
                    $refundStatus,
                    (string) $returnRequest->admin_note,
                    $reviewedBy,
                ]))),
            ];
        });

    $returnMetrics = [
        'total_returns' => $returnRows->count(),
        'awaiting_review' => $returnRows->where('decision', 'Pending Review')->count(),
        'approved_refunds' => $returnRows->filter(fn (array $row) => Str::lower((string) ($row['decision'] ?? '')) === 'approved' && Str::lower((string) ($row['refund_status'] ?? '')) === 'refunded')->count(),
        'rejected_requests' => $returnRows->where('decision', 'Rejected')->count(),
    ];

    return [
        'returnRequestRows' => $returnRows,
        'returnMetrics' => $returnMetrics,
    ];
}

function adminDashboardCustomJewelleryData(Request $request): array
{
    $customRequests = CustomJewelleryRequest::query()
        ->with(['user', 'jewelleryType', 'gem.product', 'quotation'])
        ->latest()
        ->get()
        ->map(function (CustomJewelleryRequest $customRequest) {
            $customerName = trim((string) (($customRequest->user?->first_name ?? '') . ' ' . ($customRequest->user?->last_name ?? ''))) ?: 'Customer';
            $quotation = $customRequest->quotation;
            $status = Str::title((string) ($customRequest->status ?: 'Pending'));
            $quotationStatus = $quotation?->status ?: ($customRequest->quotation_amount ? 'Sent' : '-');
            $refImages = collect($customRequest->reference_images ?? [])->filter()->values();

            return [
                'db_id' => $customRequest->id,
                'request_id' => $customRequest->request_number,
                'customer_name' => $customerName,
                'customer_email' => $customRequest->user?->email ?: '-',
                'gem_type' => $customRequest->gemDisplayName,
                'metal' => $customRequest->metal,
                'size' => $customRequest->size_value ?: '-',
                'engraving' => $customRequest->engraving ?: 'None',
                'reference_count' => $customRequest->reference_count,
                'reference_images' => $refImages->all(),
                'requested_date' => $customRequest->created_at?->toDateString() ?: '-',
                'status' => $status,
                'status_class' => $customRequest->status_class,
                'notes' => $customRequest->notes ?: '-',
                'measurement_label' => $customRequest->measurement_label ?: 'Measurement',
                'type_display_name' => $customRequest->type_display_name,
                'type_details_summary' => $customRequest->type_details_summary,
                'quotation_amount' => $quotation?->quotation_amount !== null ? 'Rs ' . number_format((float) $quotation->quotation_amount, 0) : ($customRequest->quotation_amount !== null ? 'Rs ' . number_format((float) $customRequest->quotation_amount, 0) : '-'),
                'quotation_amount_value' => (float) ($quotation?->quotation_amount ?? $customRequest->quotation_amount ?? 0),
                'quotation_note' => $quotation?->quotation_note ?: ($customRequest->quotation_note ?: '-'),
                'quotation_image' => $quotation?->quotation_image ?: '-',
                'quotation_image_url' => $quotation?->quotation_image ? asset('images/Quotations/' . $quotation->quotation_image) : '',
                'quotation_status' => $quotationStatus,
                'quotation_status_raw' => $quotation?->status ?: ($customRequest->quotation_amount ? 'Sent' : '-'),
                'quotation_status_class' => $quotation?->status_class ?? ($quotationStatus === 'Sent' ? 'info' : 'warn'),
                'quotation_number' => $quotation?->quotation_number ?: '-',
                'quotation_sent_at' => $quotation?->sent_at?->toDateTimeString() ?: '-',
                'quotation_paid_at' => $quotation?->paid_at?->toDateTimeString() ?: '-',
                'search_blob' => Str::lower(implode(' ', array_filter([
                    (string) $customRequest->request_number,
                    $customerName,
                    $customRequest->metal,
                    $customRequest->size_value,
                    $customRequest->engraving,
                    $customRequest->notes,
                    $customRequest->type_details_summary,
                    $status,
                    $quotationStatus,
                    (string) ($quotation?->status ?? ''),
                    (string) ($quotation?->quotation_number ?? ''),
                    (string) ($quotation?->quotation_amount ?? ''),
                    (string) ($quotation?->quotation_image ?? ''),
                ]))),
                'has_quotation' => (bool) $quotation,
            ];
        });

    $pendingRequests = $customRequests->where('status', 'Pending')->values();
    $paidRequests = $customRequests->filter(fn (array $row) => Str::lower((string) ($row['quotation_status_raw'] ?? $row['quotation_status'] ?? '')) === 'paid')->values();
    $quotationRows = $customRequests->filter(fn (array $row) => !empty($row['has_quotation']) || Str::lower((string) ($row['status'] ?? '')) === 'quoted')->values();

    $customMetrics = [
        'total_requests' => $customRequests->count(),
        'pending_review' => $pendingRequests->count(),
            'paid_requests' => $paidRequests->count(),
            'quoted_requests' => $quotationRows->count(),
        ];

    return [
        'customRequestRows' => $customRequests,
        'customPendingRows' => $pendingRequests,
        'customQuotationRows' => $quotationRows,
        'customPaidRows' => $paidRequests,
        'customMetrics' => $customMetrics,
    ];
}

function adminDashboardReportData(Request $request): array
{
    $currency = fn (float $amount): string => 'Rs ' . number_format($amount, 0);
    $orders = Order::query()
        ->with(['items.product.category', 'items.product.collection', 'items.product.gem', 'items.product.jewellery', 'items.review'])
        ->latest()
        ->get();
    $products = Product::query()
        ->with(['category', 'collection', 'gem', 'jewellery', 'reviews'])
        ->get()
        ->keyBy('product_id');
    $productViewCounts = ProductView::query()
        ->select('product_id', DB::raw('count(*) as views_count'))
        ->groupBy('product_id')
        ->pluck('views_count', 'product_id');
    $customers = User::query()
        ->where('role', 'customer')
        ->withCount('orders')
        ->latest()
        ->get();
    $customRequests = CustomJewelleryRequest::query()
        ->with(['user', 'jewelleryType', 'gem.product', 'quotation'])
        ->latest()
        ->get();

    $resolveCategory = function (?Product $product): string {
        $categoryName = trim((string) ($product?->category?->name ?? ''));

        if ($categoryName !== '') {
            return $categoryName;
        }

        if ($product?->collection) {
            return 'Collections';
        }

        if ($product?->gem) {
            return 'Gems';
        }

        if ($product?->jewellery) {
            return 'Jewellery';
        }

        return 'Uncategorized';
    };

    $getOrderStatus = function (Order $order): string {
        return Str::title(trim((string) ($order->status ?: 'Pending')));
    };

    $productStats = [];
    $categoryStats = [];
    $categoryRevenueByMonth = [];
    $categoryUnitsByMonth = [];
    $monthStats = [];

    foreach ($orders as $order) {
        $orderDate = $order->created_at;
        $monthKey = $orderDate?->format('Y-m') ?? 'unknown';
        $monthLabel = $orderDate?->format('F Y') ?? 'Unknown';
        $orderTotal = (float) ($order->total ?? 0);

        if (!isset($monthStats[$monthKey])) {
            $monthStats[$monthKey] = [
                'label' => $monthLabel,
                'orders' => 0,
                'revenue' => 0.0,
                'custom_revenue' => 0.0,
                'pickup_only' => 0,
                'top_gem' => '-',
                'popular_category' => '-',
            ];
        }

        $monthStats[$monthKey]['orders']++;
        $monthStats[$monthKey]['revenue'] += $orderTotal;
        $monthStats[$monthKey]['pickup_only'] += $order->pickup_only ? 1 : 0;

        foreach ($order->items as $item) {
            $product = $item->product;
            $productId = (int) ($product?->product_id ?? $item->product_id);
            $productName = trim((string) ($product?->name ?? $item->product_name ?? 'Product'));
            $categoryName = $resolveCategory($product);
            $lineTotal = (float) ($item->line_total ?? 0);
            $quantity = (int) ($item->quantity ?? 0);
            $approvedReviews = $product?->reviews?->where('status', 'approved') ?? collect();
            $averageRating = (float) ($approvedReviews->avg('rating') ?? 0);
            $viewsCount = (int) ($productViewCounts[$productId] ?? 0);

            if (!isset($productStats[$productId])) {
                $productStats[$productId] = [
                    'product_id' => $productId,
                    'name' => $productName,
                    'category' => $categoryName,
                    'gem_type' => trim((string) ($product?->gem?->gemType?->name ?? '-')) ?: '-',
                    'jewellery_type' => trim((string) ($product?->jewellery?->type?->name ?? '-')) ?: '-',
                    'units' => 0,
                    'revenue' => 0.0,
                    'orders' => [],
                    'first_date' => $orderDate?->copy(),
                    'last_date' => $orderDate?->copy(),
                    'reviews_count' => (int) $approvedReviews->count(),
                    'views_count' => $viewsCount,
                    'average_rating' => $averageRating,
                ];
            }

            $productStats[$productId]['units'] += $quantity;
            $productStats[$productId]['revenue'] += $lineTotal;
            $productStats[$productId]['orders'][$order->id] = true;
            $productStats[$productId]['first_date'] = $productStats[$productId]['first_date']
                ? ($orderDate && $orderDate->lt($productStats[$productId]['first_date']) ? $orderDate->copy() : $productStats[$productId]['first_date'])
                : $orderDate?->copy();
            $productStats[$productId]['last_date'] = $productStats[$productId]['last_date']
                ? ($orderDate && $orderDate->gt($productStats[$productId]['last_date']) ? $orderDate->copy() : $productStats[$productId]['last_date'])
                : $orderDate?->copy();

            if (!isset($categoryStats[$categoryName])) {
                $categoryStats[$categoryName] = [
                    'category' => $categoryName,
                    'units' => 0,
                    'revenue' => 0.0,
                    'orders' => [],
                    'first_date' => $orderDate?->copy(),
                    'last_date' => $orderDate?->copy(),
                ];
            }

            $categoryStats[$categoryName]['units'] += $quantity;
            $categoryStats[$categoryName]['revenue'] += $lineTotal;
            $categoryStats[$categoryName]['orders'][$order->id] = true;
            $categoryStats[$categoryName]['first_date'] = $categoryStats[$categoryName]['first_date']
                ? ($orderDate && $orderDate->lt($categoryStats[$categoryName]['first_date']) ? $orderDate->copy() : $categoryStats[$categoryName]['first_date'])
                : $orderDate?->copy();
            $categoryStats[$categoryName]['last_date'] = $categoryStats[$categoryName]['last_date']
                ? ($orderDate && $orderDate->gt($categoryStats[$categoryName]['last_date']) ? $orderDate->copy() : $categoryStats[$categoryName]['last_date'])
                : $orderDate?->copy();

            if (!isset($categoryRevenueByMonth[$monthKey][$categoryName])) {
                $categoryRevenueByMonth[$monthKey][$categoryName] = 0.0;
            }
            $categoryRevenueByMonth[$monthKey][$categoryName] += $lineTotal;

            if (!isset($categoryUnitsByMonth[$monthKey][$categoryName])) {
                $categoryUnitsByMonth[$monthKey][$categoryName] = 0;
            }
            $categoryUnitsByMonth[$monthKey][$categoryName] += $quantity;
        }
    }

    foreach ($products as $product) {
        $productId = (int) $product->product_id;
        $productName = trim((string) ($product->name ?? 'Product'));
        $categoryName = $resolveCategory($product);
        $approvedReviews = $product->reviews?->where('status', 'approved') ?? collect();
        $viewsCount = (int) ($productViewCounts[$productId] ?? 0);

        if (!isset($productStats[$productId])) {
            $productStats[$productId] = [
                'product_id' => $productId,
                'name' => $productName,
                'category' => $categoryName,
                'gem_type' => trim((string) ($product->gem?->gemType?->name ?? '-')) ?: '-',
                'jewellery_type' => trim((string) ($product->jewellery?->type?->name ?? '-')) ?: '-',
                'units' => 0,
                'revenue' => 0.0,
                'orders' => [],
                'first_date' => null,
                'last_date' => null,
                'reviews_count' => (int) $approvedReviews->count(),
                'views_count' => $viewsCount,
                'average_rating' => (float) ($approvedReviews->avg('rating') ?? 0),
            ];
        }

        if (!isset($categoryStats[$categoryName])) {
            $categoryStats[$categoryName] = [
                'category' => $categoryName,
                'units' => 0,
                'revenue' => 0.0,
                'orders' => [],
                'first_date' => null,
                'last_date' => null,
            ];
        }
    }

    $productStatsCollection = collect($productStats)->map(function (array $stats) use ($currency) {
        $product = $productStats = $stats;
        $averageRating = $stats['average_rating'] ?: 0;
        $reviewsCount = $stats['reviews_count'] ?: 0;

        return [
            'product_id' => $stats['product_id'],
            'name' => $stats['name'],
            'category' => $stats['category'],
            'gem_type' => $stats['gem_type'] ?? '-',
            'jewellery_type' => $stats['jewellery_type'] ?? '-',
            'units' => $stats['units'],
            'revenue' => $stats['revenue'],
            'revenue_label' => $currency((float) $stats['revenue']),
            'orders' => count($stats['orders']),
            'reviews_count' => $reviewsCount,
            'views_count' => (int) ($stats['views_count'] ?? 0),
            'average_rating' => round((float) $averageRating, 1),
            'first_date' => $stats['first_date']?->toDateString() ?: '-',
            'last_date' => $stats['last_date']?->toDateString() ?: '-',
        ];
    })->values();

    $categoryStatsCollection = collect($categoryStats)->map(function (array $stats) use ($productStatsCollection, $currency) {
        $productsInCategory = $productStatsCollection->where('category', $stats['category'])->sortByDesc('units')->values();
        $topSelling = $productsInCategory->first()['name'] ?? '-';
        $bestRated = $productsInCategory->sortByDesc('average_rating')->first()['name'] ?? '-';
        $mostViewed = $productsInCategory->sortByDesc('views_count')->first()['name'] ?? '-';

        return [
            'category' => $stats['category'],
            'from_date' => $stats['first_date']?->toDateString() ?: '-',
            'to_date' => $stats['last_date']?->toDateString() ?: '-',
            'total_sales' => $stats['units'],
            'total_orders' => count($stats['orders']),
            'revenue' => $currency((float) $stats['revenue']),
            'top_selling' => $topSelling,
            'best_rated' => $bestRated,
            'most_viewed' => $mostViewed,
        ];
    })->sortByDesc('revenue')->values();

    $bestSeller = $productStatsCollection->sortByDesc('units')->first();
    $lowestSeller = $productStatsCollection->sortBy('units')->first();
    $mostReviewed = $productStatsCollection->sortByDesc('views_count')->first();
    $topCategory = $categoryStatsCollection->sortByDesc('revenue')->first();
    $mostViewedCategory = $products
        ->filter(function (Product $product) {
            return trim((string) ($product->category?->name ?? '')) !== '';
        })
        ->map(function (Product $product) use ($productViewCounts) {
            $productId = (int) $product->product_id;
            $categoryName = trim((string) ($product->category?->name ?? ''));

            return [
                'category' => $categoryName,
                'views' => (int) ($productViewCounts[$productId] ?? 0),
            ];
        })
        ->groupBy('category')
        ->map(fn ($group) => $group->sum('views'))
        ->sortDesc()
        ->keys()
        ->first() ?: '-';
    $topGemType = $productStatsCollection->where('gem_type', '!=', '-')
        ->groupBy('gem_type')
        ->map(fn ($group) => $group->sum('units'))
        ->sortDesc()
        ->keys()
        ->first() ?: '-';
    $topJewelleryType = $productStatsCollection->where('jewellery_type', '!=', '-')
        ->groupBy('jewellery_type')
        ->map(fn ($group) => $group->sum('units'))
        ->sortDesc()
        ->keys()
        ->first() ?: '-';

    $salesDaily = $orders->filter(fn (Order $order) => $order->created_at?->isToday())->sum(fn (Order $order) => (float) ($order->total ?? 0));
    $salesWeekly = $orders->filter(fn (Order $order) => $order->created_at?->greaterThanOrEqualTo(now()->startOfWeek()))->sum(fn (Order $order) => (float) ($order->total ?? 0));
    $salesMonthly = $orders->filter(fn (Order $order) => $order->created_at?->isCurrentMonth())->sum(fn (Order $order) => (float) ($order->total ?? 0));
    $salesYearly = $orders->filter(fn (Order $order) => $order->created_at?->isCurrentYear())->sum(fn (Order $order) => (float) ($order->total ?? 0));

    $orderStatuses = $orders->groupBy(function (Order $order) {
        return Str::title(trim((string) ($order->status ?: 'Pending')));
    })->map(function ($items, string $status) use ($currency) {
        $items = collect($items);
        $pickupOnly = $items->filter(fn (Order $order) => (bool) $order->pickup_only)->count();
        $cancelled = $items->filter(fn (Order $order) => Str::lower((string) $order->status) === 'cancelled')->count();
        $firstDate = $items->min(fn (Order $order) => $order->created_at?->timestamp ?? 0);
        $lastDate = $items->max(fn (Order $order) => $order->created_at?->timestamp ?? 0);

        return [
            'status' => $status,
            'from_date' => $firstDate ? now()->createFromTimestamp($firstDate)->toDateString() : '-',
            'to_date' => $lastDate ? now()->createFromTimestamp($lastDate)->toDateString() : '-',
            'total_orders' => $items->count(),
            'pickup_only' => $pickupOnly,
            'cancelled' => $cancelled,
            'revenue' => $currency($items->sum(fn (Order $order) => (float) ($order->total ?? 0))),
        ];
    })->sortByDesc('total_orders')->values();

    $customerOrderStats = $orders
        ->groupBy('user_id')
        ->map(function ($items, $userId) {
            $items = collect($items);
            return [
                'user_id' => $userId,
                'orders' => $items->count(),
                'revenue' => $items->sum(fn (Order $order) => (float) ($order->total ?? 0)),
                'first_date' => $items->min(fn (Order $order) => $order->created_at?->timestamp ?? 0),
                'last_date' => $items->max(fn (Order $order) => $order->created_at?->timestamp ?? 0),
            ];
        });

    $customerLookup = $customers->keyBy('id');
    $topBuyerEntry = $customerOrderStats->sortByDesc('orders')->first();
    $topBuyerName = $topBuyerEntry ? trim((string) (($customerLookup[$topBuyerEntry['user_id']]?->first_name ?? '') . ' ' . ($customerLookup[$topBuyerEntry['user_id']]?->last_name ?? ''))) : '-';
    $repeatBuyerCount = $customerOrderStats->filter(fn (array $stats) => $stats['orders'] > 1)->count();
    $activeCustomerCount = $customers->filter(fn (User $user) => Str::lower((string) ($user->account_status ?: '')) === 'active' || !empty($user->email_verified_at) || ($customerOrderStats[$user->id]['orders'] ?? 0) > 0)->count();
    $newThisMonthCount = $customers->filter(fn (User $user) => $user->created_at?->isCurrentMonth())->count();
    $topBuyerCount = $customerOrderStats->filter(fn (array $stats) => $stats['orders'] >= 3)->count();

    $customerReportRows = collect([
        [
            'from_date' => $customers->min(fn (User $user) => $user->created_at?->timestamp ?? 0) ? now()->createFromTimestamp($customers->min(fn (User $user) => $user->created_at?->timestamp ?? 0))->toDateString() : '-',
            'to_date' => $customers->max(fn (User $user) => $user->created_at?->timestamp ?? 0) ? now()->createFromTimestamp($customers->max(fn (User $user) => $user->created_at?->timestamp ?? 0))->toDateString() : '-',
            'customer_type' => 'All Customers',
            'total' => $customers->count(),
            'top_buyer' => $topBuyerName,
            'repeat_orders' => $repeatBuyerCount,
        ],
        [
            'from_date' => now()->startOfMonth()->toDateString(),
            'to_date' => now()->toDateString(),
            'customer_type' => 'New This Month',
            'total' => $newThisMonthCount,
            'top_buyer' => $topBuyerName,
            'repeat_orders' => $customers->filter(fn (User $user) => $user->created_at?->isCurrentMonth() && (($customerOrderStats[$user->id]['orders'] ?? 0) > 1))->count(),
        ],
        [
            'from_date' => now()->startOfMonth()->toDateString(),
            'to_date' => now()->toDateString(),
            'customer_type' => 'Active Customers',
            'total' => $activeCustomerCount,
            'top_buyer' => $topBuyerName,
            'repeat_orders' => $repeatBuyerCount,
        ],
        [
            'from_date' => now()->startOfMonth()->toDateString(),
            'to_date' => now()->toDateString(),
            'customer_type' => 'Repeat Buyers',
            'total' => $repeatBuyerCount,
            'top_buyer' => $topBuyerName,
            'repeat_orders' => $customerOrderStats->sum(fn (array $stats) => max(0, $stats['orders'] - 1)),
        ],
    ]);

    $customerSummary = [
        'total_customers' => $customers->count(),
        'new_registrations' => $newThisMonthCount,
        'active_customers' => $activeCustomerCount,
        'top_buyers' => $topBuyerCount,
    ];

    $customerReportRows = $customerReportRows->map(function (array $row) use ($currency) {
        return $row;
    });

    $inventoryRows = collect($dashboardInventoryRows = Product::query()->with(['category', 'jewellery', 'gem', 'collection'])->orderBy('name')->get()->map(function (Product $product) {
        $stock = (int) ($product->stock ?? 0);
        $status = $stock > 15 ? 'Healthy' : ($stock === 0 ? 'Out of Stock' : ($stock < 5 ? 'Critical' : 'Low'));

        return [
            'name' => $product->name,
            'stock' => $stock,
            'status' => $status,
        ];
    }));
    $inventoryStatusRows = collect([
        ['status' => 'Healthy', 'summary' => 'Stock levels are within range.'],
        ['status' => 'Low', 'summary' => 'Reorder soon to avoid stockouts.'],
        ['status' => 'Critical', 'summary' => 'Urgent restock required.'],
        ['status' => 'Out of Stock', 'summary' => 'No inventory remaining.'],
    ])->map(function (array $row) use ($inventoryRows, $currency) {
        $statusRows = $inventoryRows->where('status', $row['status']);

        return [
            'from_date' => now()->startOfMonth()->toDateString(),
            'to_date' => now()->toDateString(),
            'stock_status' => $row['status'],
            'summary' => $row['summary'],
            'low_stock_items' => $statusRows->count(),
            'out_of_stock_items' => $row['status'] === 'Out of Stock' ? $statusRows->count() : 0,
        ];
    });

    $pendingCustom = $customRequests->where('status', 'Pending')->count();
    $approvedCustom = $customRequests->where('status', 'Approved')->count();
    $rejectedCustom = $customRequests->where('status', 'Rejected')->count();
    $paidCustom = $customRequests->filter(fn (CustomJewelleryRequest $request) => Str::lower((string) ($request->quotation?->status ?? '')) === 'paid')->count();
    $acceptanceRate = $customRequests->count() ? round(($customRequests->filter(fn (CustomJewelleryRequest $request) => in_array(Str::lower((string) ($request->quotation?->status ?? '')), ['accepted', 'paid'], true))->count() / max($customRequests->whereNotNull('quotation')->count(), 1)) * 100) : 0;

    $customReportRows = $customRequests
        ->groupBy(function (CustomJewelleryRequest $request) {
            return Str::title((string) ($request->status ?: 'Pending'));
        })
        ->map(function ($items, string $status) {
            $items = collect($items);
            $topDemand = $items->groupBy(function (CustomJewelleryRequest $request) {
                return trim((string) ($request->type_display_name ?: 'Custom Jewellery'));
            })->sortByDesc(fn ($group) => $group->count())->keys()->first() ?: 'Custom Jewellery';
            $accepted = $items->filter(fn (CustomJewelleryRequest $request) => in_array(Str::lower((string) ($request->quotation?->status ?? '')), ['accepted', 'paid'], true))->count();
            $quoted = $items->whereNotNull('quotation')->count();

            return [
                'from_date' => $items->min(fn (CustomJewelleryRequest $request) => $request->created_at?->timestamp ?? 0) ? now()->createFromTimestamp($items->min(fn (CustomJewelleryRequest $request) => $request->created_at?->timestamp ?? 0))->toDateString() : '-',
                'to_date' => $items->max(fn (CustomJewelleryRequest $request) => $request->created_at?->timestamp ?? 0) ? now()->createFromTimestamp($items->max(fn (CustomJewelleryRequest $request) => $request->created_at?->timestamp ?? 0))->toDateString() : '-',
                'request_status' => $status,
                'total_requests' => $items->count(),
                'custom_demand' => $topDemand,
                'quotation_acceptance' => $quoted > 0 ? round(($accepted / $quoted) * 100) . '%' : '0%',
            ];
        })
        ->sortByDesc('total_requests')
        ->values();

    $customDemandThisMonth = $customRequests->filter(fn (CustomJewelleryRequest $request) => $request->created_at?->isCurrentMonth())->count();
    $customDemandLastMonth = $customRequests->filter(fn (CustomJewelleryRequest $request) => $request->created_at?->isLastMonth())->count();
    $customDemandTrend = $customDemandLastMonth > 0
        ? round((($customDemandThisMonth - $customDemandLastMonth) / $customDemandLastMonth) * 100)
        : ($customDemandThisMonth > 0 ? 100 : 0);

    $revenueRows = collect();
    for ($i = 5; $i >= 0; $i--) {
        $monthStart = now()->copy()->startOfMonth()->subMonths($i);
        $monthEnd = $monthStart->copy()->endOfMonth();
        $monthKey = $monthStart->format('Y-m');
        $monthOrders = $orders->filter(fn (Order $order) => $order->created_at && $order->created_at->betweenIncluded($monthStart, $monthEnd));
        $monthCustomRevenue = $customRequests->filter(fn (CustomJewelleryRequest $request) => $request->quotation?->paid_at && $request->quotation->paid_at->betweenIncluded($monthStart, $monthEnd))->sum(fn (CustomJewelleryRequest $request) => (float) ($request->quotation?->quotation_amount ?? 0));
        $monthTotalRevenue = $monthOrders->sum(fn (Order $order) => (float) ($order->total ?? 0)) + $monthCustomRevenue;

        $productsInMonth = collect();
        $categoriesInMonth = collect();
        foreach ($monthOrders as $order) {
            foreach ($order->items as $item) {
                $product = $item->product;
                $categoryName = $resolveCategory($product);
                $productName = trim((string) ($product?->name ?? $item->product_name ?? 'Product'));
                $productsInMonth->push([
                    'name' => $productName,
                    'category' => $categoryName,
                    'quantity' => (int) ($item->quantity ?? 0),
                ]);
                $categoriesInMonth->put($categoryName, (float) ($categoriesInMonth->get($categoryName, 0) + (float) ($item->line_total ?? 0)));
            }
        }

        $topGem = $productsInMonth
            ->filter(fn (array $row) => Str::lower((string) $row['category']) === 'gems')
            ->groupBy('name')
            ->map(fn ($group) => $group->sum('quantity'))
            ->sortDesc()
            ->keys()
            ->first() ?: '-';
        $popularCategory = $categoriesInMonth->sortDesc()->keys()->first() ?: '-';

        $revenueRows->push([
            'from_date' => $monthStart->toDateString(),
            'to_date' => $monthEnd->toDateString(),
            'revenue_type' => 'Monthly Revenue',
            'top_selling_gem' => $topGem,
            'popular_category' => $popularCategory,
            'trend_insight' => $monthTotalRevenue > 0
                ? $currency($monthTotalRevenue) . ' recorded for ' . $monthStart->format('F Y')
                : 'No revenue recorded for ' . $monthStart->format('F Y'),
            'revenue_value' => $monthTotalRevenue,
        ]);
    }

    $currentMonthRow = $revenueRows->last();
    $previousMonthRow = $revenueRows->count() > 1 ? $revenueRows->get($revenueRows->count() - 2) : null;
    $currentMonthRevenue = (float) ($currentMonthRow['revenue_value'] ?? 0);
    $previousMonthRevenue = (float) ($previousMonthRow['revenue_value'] ?? 0);
    $revenueTrend = $previousMonthRevenue > 0
        ? round((($currentMonthRevenue - $previousMonthRevenue) / $previousMonthRevenue) * 100)
        : ($currentMonthRevenue > 0 ? 100 : 0);
    $grossRevenue = $orders->sum(fn (Order $order) => (float) ($order->total ?? 0)) + $customRequests->filter(fn (CustomJewelleryRequest $request) => Str::lower((string) ($request->quotation?->status ?? '')) === 'paid')->sum(fn (CustomJewelleryRequest $request) => (float) ($request->quotation?->quotation_amount ?? 0));

    $monthlySalesChart = collect(range(6, 0))->map(function (int $offset) use ($orders, $currency) {
        $monthStart = now()->copy()->startOfMonth()->subMonths($offset);
        $monthEnd = $monthStart->copy()->endOfMonth();
        $monthOrders = $orders->filter(fn (Order $order) => $order->created_at && $order->created_at->betweenIncluded($monthStart, $monthEnd));
        $value = (float) $monthOrders->sum(fn (Order $order) => (float) ($order->total ?? 0));

        return [
            'label' => $monthStart->format('M'),
            'month' => $monthStart->format('Y-m'),
            'value' => $value,
            'value_label' => $currency($value),
        ];
    })->values();

    $monthlySalesMax = max(1, (float) $monthlySalesChart->max('value'));
    $monthlySalesChart = $monthlySalesChart->map(function (array $row) use ($monthlySalesMax) {
        $row['height'] = max(12, (int) round(($row['value'] / $monthlySalesMax) * 100));
        return $row;
    })->values();

    $orderStatusPalette = [
        'Pending' => '#d7a156',
        'Processing' => '#5f88d9',
        'Completed' => '#5c968b',
        'Cancelled' => '#c86f61',
        'Pickup' => '#b89ae6',
    ];
    $orderStatusChart = collect(array_keys($orderStatusPalette))->map(function (string $status) use ($orderStatuses) {
        $match = $orderStatuses->first(function (array $row) use ($status) {
            return Str::lower((string) ($row['status'] ?? '')) === Str::lower($status);
        });

        return [
            'label' => $status,
            'count' => (int) ($match['total_orders'] ?? 0),
        ];
    })->values();
    $orderStatusTotal = max(1, (int) $orderStatusChart->sum('count'));
    $orderStatusChart = $orderStatusChart->map(function (array $row) use ($orderStatusPalette, $orderStatusTotal) {
        $row['color'] = $orderStatusPalette[$row['label']] ?? '#b98945';
        $row['percent'] = round(($row['count'] / $orderStatusTotal) * 100, 1);
        return $row;
    })->values();

    $topProductsChart = $productStatsCollection
        ->sortByDesc('units')
        ->take(4)
        ->values()
        ->map(function (array $row) {
            return [
                'label' => $row['name'] ?: 'Product',
                'count' => (int) ($row['units'] ?? 0),
            ];
        });
    $topProductsMax = max(1, (int) $topProductsChart->max('count'));
    $topProductsPalette = ['#b98945', '#5c968b', '#c86f61', '#75624f'];
    $topProductsChart = $topProductsChart->map(function (array $row, int $index) use ($topProductsMax, $topProductsPalette) {
        $row['color'] = $topProductsPalette[$index % count($topProductsPalette)];
        $row['height'] = max(20, (int) round(($row['count'] / $topProductsMax) * 190));
        return $row;
    })->values();

    return [
        'salesSummary' => [
            'daily_sales' => $currency($salesDaily),
            'weekly_sales' => $currency($salesWeekly),
            'monthly_sales' => $currency($salesMonthly),
            'yearly_revenue' => $currency($salesYearly),
        ],
        'salesReportRows' => collect($categoryStatsCollection)->map(function (array $row) use ($currency) {
            return [
                'from_date' => $row['from_date'],
                'to_date' => $row['to_date'],
                'category' => $row['category'],
                'total_sales' => $row['total_sales'],
                'total_orders' => $row['total_orders'],
                'revenue' => $row['revenue'],
                'revenue_label' => $row['revenue'],
            ];
        })->values(),
        'orderSummary' => [
            'total_orders' => $orders->count(),
            'pending_orders' => $orders->filter(fn (Order $order) => Str::contains(Str::lower((string) $order->status), 'pending'))->count(),
            'completed_orders' => $orders->filter(fn (Order $order) => in_array(Str::lower((string) $order->status), ['completed', 'pickup completed'], true))->count(),
            'pickup_orders' => $orders->filter(fn (Order $order) => (bool) $order->pickup_only || Str::lower((string) $order->shipping_method) === 'pickup' || Str::contains(Str::lower((string) $order->status), 'pickup'))->count(),
        ],
        'orderReportRows' => $orderStatuses,
        'productSummary' => [
            'best_seller' => $bestSeller['name'] ?? '-',
            'lowest_seller' => $lowestSeller['name'] ?? '-',
            'most_viewed' => $mostReviewed['name'] ?? '-',
            'top_category' => $topCategory['category'] ?? '-',
            'most_viewed_category' => $mostViewedCategory,
            'top_gem_type' => $topGemType,
            'top_jewellery_type' => $topJewelleryType,
        ],
        'productReportRows' => $categoryStatsCollection->map(function (array $row) {
            return [
                'from_date' => $row['from_date'],
                'to_date' => $row['to_date'],
                'product_type' => $row['category'],
                'top_selling' => $row['top_selling'],
                'most_viewed' => $row['most_viewed'],
            ];
        })->values(),
        'inventorySummary' => [
            'total_skus' => $inventoryRows->count(),
            'low_stock' => $inventoryRows->where('status', 'Low')->count(),
            'critical_stock' => $inventoryRows->where('status', 'Critical')->count(),
            'out_of_stock' => $inventoryRows->where('status', 'Out of Stock')->count(),
        ],
        'inventoryReportRows' => $inventoryStatusRows->values(),
        'customerSummary' => $customerSummary,
        'customerReportRows' => $customerReportRows,
        'customJewellerySummary' => [
            'total_requests' => $customRequests->count(),
            'approved_requests' => $approvedCustom,
            'rejected_requests' => $rejectedCustom,
            'paid_requests' => $paidCustom,
            'acceptance_rate' => $acceptanceRate . '%',
        ],
        'customJewelleryReportRows' => $customReportRows,
        'revenueSummary' => [
            'monthly_revenue' => $currency($currentMonthRevenue),
            'gross_revenue' => $currency($grossRevenue),
            'pickup_only_count' => $orders->filter(fn (Order $order) => (bool) $order->pickup_only)->count(),
            'custom_demand_trend' => ($customDemandTrend >= 0 ? '+' : '') . $customDemandTrend . '%',
        ],
        'revenueReportRows' => $revenueRows->map(function (array $row) use ($currency) {
            return [
                'from_date' => $row['from_date'],
                'to_date' => $row['to_date'],
                'revenue_type' => $row['revenue_type'],
                'top_selling_gem' => $row['top_selling_gem'],
                'popular_category' => $row['popular_category'],
                'trend_insight' => $row['trend_insight'],
            ];
        })->values(),
        'dashboardCharts' => [
            'monthly_sales' => $monthlySalesChart,
            'order_status' => $orderStatusChart,
            'top_products' => $topProductsChart,
        ],
    ];
}

function adminDashboardNotificationData(Request $request): array
{
    $notifications = SiteNotification::query()
        ->with('recipientUser')
        ->latest('published_at')
        ->latest('created_at')
        ->get()
        ->map(function (SiteNotification $notification) {
            $recipientRoleRaw = Str::lower((string) ($notification->recipient_role ?: 'all'));
            $recipientRoleLabel = match ($recipientRoleRaw) {
                'admin' => 'Admin',
                'consultant' => 'Consultant',
                'customer' => 'Customer',
                default => 'All',
            };
            $recipientName = trim((string) (($notification->recipientUser?->first_name ?? '') . ' ' . ($notification->recipientUser?->last_name ?? '')));
            $recipientLabel = $recipientRoleLabel . ($recipientName !== '' ? ' / ' . $recipientName : '');
            $publishedDate = $notification->published_at?->toDateString() ?: $notification->created_at?->toDateString() ?: '-';
            $publishedDateTime = $notification->published_at?->toDateTimeString() ?: $notification->created_at?->toDateTimeString() ?: '-';
            $notificationId = 'NTF-' . str_pad((string) $notification->id, 3, '0', STR_PAD_LEFT);

            return [
                'db_id' => $notification->id,
                'notification_id' => $notificationId,
                'title' => $notification->title,
                'message' => $notification->message,
                'category' => $notification->category ?: 'General',
                'image_path' => $notification->image_path ?: null,
                'image_url' => $notification->imageUrl(),
                'recipient_role' => $recipientRoleLabel,
                'recipient_role_raw' => $recipientRoleRaw,
                'recipient_user_id' => $notification->recipient_user_id,
                'recipient_user_name' => $recipientName ?: '-',
                'recipient_label' => $recipientLabel,
                'published_date' => $publishedDate,
                'published_datetime' => $publishedDateTime,
                'status' => $notification->status ?: 'Unread',
                'status_class' => $notification->status_class,
                'action_label' => $notification->action_label ?: '-',
                'action_url' => $notification->action_url ?: '-',
                'search_blob' => Str::lower(implode(' ', array_filter([
                    (string) $notificationId,
                    (string) $notification->title,
                    (string) $notification->message,
                    (string) $notification->category,
                    (string) $recipientRoleLabel,
                    (string) $recipientName,
                    (string) $notification->status,
                    (string) ($notification->action_label ?? ''),
                    (string) ($notification->action_url ?? ''),
                ]))),
            ];
        });

    $notificationCategoryOptions = collect([
        'General',
        'Orders',
        'Promotions',
        'Support',
        'Account',
        'Product Updates',
    ]);

    $notificationMetrics = [
        'total_notifications' => $notifications->count(),
        'unread_notifications' => $notifications->where('status', 'Unread')->count(),
        'read_notifications' => $notifications->where('status', 'Read')->count(),
        'actionable_notifications' => $notifications->filter(fn (array $row) => filled($row['action_label']) || filled($row['action_url']))->count(),
    ];

    return [
        'notificationRows' => $notifications,
        'notificationMetrics' => $notificationMetrics,
        'notificationCategoryOptions' => $notificationCategoryOptions,
        'notificationRoleOptions' => collect(['consultant', 'customer']),
        'notificationRecipientUsers' => User::query()
            ->whereIn('role', ['consultant', 'customer'])
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->get()
            ->map(function (User $user) {
                $name = trim((string) (($user->first_name ?? '') . ' ' . ($user->last_name ?? ''))) ?: 'User';

                return [
                    'id' => $user->id,
                    'name' => $name,
                    'role' => $user->role,
                    'label' => $name . ' (' . Str::title(str_replace('_', ' ', (string) $user->role)) . ')',
                ];
            }),
    ];
}

function adminDashboardContactMessageData(Request $request): array
{
    $messages = ContactMessage::query()
        ->with(['customer', 'repliedBy'])
        ->latest()
        ->get()
        ->map(function (ContactMessage $message) {
            $customerName = trim((string) (($message->customer?->first_name ?? '') . ' ' . ($message->customer?->last_name ?? '')))
                ?: $message->name
                ?: 'Customer';
            $repliedByName = trim((string) (($message->repliedBy?->first_name ?? '') . ' ' . ($message->repliedBy?->last_name ?? '')));
            $replyDate = $message->replied_at?->format('Y-m-d H:i') ?: '-';

            return [
                'db_id' => $message->id,
                'message_id' => 'MSG-' . str_pad((string) $message->id, 3, '0', STR_PAD_LEFT),
                'name' => $customerName,
                'email' => $message->email,
                'date' => $message->date?->format('Y-m-d') ?: (string) $message->date,
                'subject' => $message->subject,
                'message' => $message->message,
                'status' => $message->status ?: 'Unread',
                'status_class' => match ((string) $message->status) {
                    'Replied' => 'ok',
                    'Read' => 'info',
                    'Urgent' => 'bad',
                    default => 'warn',
                },
                'reply_message' => $message->reply_message ?: '',
                'reply_date' => $replyDate,
                'reply_by' => $repliedByName ?: '-',
                'search_blob' => Str::lower(implode(' ', array_filter([
                    (string) $message->id,
                    $customerName,
                    $message->email,
                    (string) $message->date,
                    $message->subject,
                    $message->message,
                    $message->status,
                    $message->reply_message ?: '',
                ]))),
            ];
        });

    return [
        'adminContactMessages' => $messages,
        'adminContactSummary' => [
            'total' => $messages->count(),
            'unread' => $messages->where('status', 'Unread')->count(),
            'read' => $messages->where('status', 'Read')->count(),
            'replied' => $messages->where('status', 'Replied')->count(),
        ],
        'adminContactStatusOptions' => collect(['Unread', 'Read', 'Replied']),
    ];
}

function normalizeBirthDateInput(\DateTimeInterface|string|null $birthDate): ?string
{
    if ($birthDate instanceof \DateTimeInterface) {
        return $birthDate->format('Y-m-d');
    }

    $birthDate = trim((string) $birthDate);

    return $birthDate !== '' ? $birthDate : null;
}

function formatDateInputValue(\DateTimeInterface|string|null $value): string
{
    $normalized = normalizeBirthDateInput($value);

    if ($normalized === null) {
        return '';
    }

    try {
        return (new DateTime($normalized))->format('Y-m-d');
    } catch (Throwable $e) {
        return '';
    }
}

function zodiacSignNameFromBirthDate(\DateTimeInterface|string|null $birthDate): string
{
    $birthDate = normalizeBirthDateInput($birthDate);

    if ($birthDate === null) {
        return 'Pisces';
    }

    $birthDate = new DateTime($birthDate);
    $day = (int) $birthDate->format('j');
    $month = (int) $birthDate->format('n');

    if (($month == 3 && $day >= 21) || ($month == 4 && $day <= 19)) {
        return 'Aries';
    }

    if (($month == 4 && $day >= 20) || ($month == 5 && $day <= 20)) {
        return 'Taurus';
    }

    if (($month == 5 && $day >= 21) || ($month == 6 && $day <= 21)) {
        return 'Gemini';
    }

    if (($month == 6 && $day >= 22) || ($month == 7 && $day <= 22)) {
        return 'Cancer';
    }

    if (($month == 7 && $day >= 23) || ($month == 8 && $day <= 22)) {
        return 'Leo';
    }

    if (($month == 8 && $day >= 23) || ($month == 9 && $day <= 22)) {
        return 'Virgo';
    }

    if (($month == 9 && $day >= 23) || ($month == 10 && $day <= 23)) {
        return 'Libra';
    }

    if (($month == 10 && $day >= 24) || ($month == 11 && $day <= 21)) {
        return 'Scorpio';
    }

    if (($month == 11 && $day >= 22) || ($month == 12 && $day <= 21)) {
        return 'Sagittarius';
    }

    if (($month == 12 && $day >= 22) || ($month == 1 && $day <= 19)) {
        return 'Capricorn';
    }

    if (($month == 1 && $day >= 20) || ($month == 2 && $day <= 18)) {
        return 'Aquarius';
    }

    return 'Pisces';
}

function zodiacIdFromBirthDate(\DateTimeInterface|string|null $birthDate): ?int
{
    $signName = zodiacSignNameFromBirthDate($birthDate);

    return ZodiacSign::query()
        ->where('sign_name', $signName)
        ->value('zodiac_id');
}

function birthstoneMonthNameFromBirthDate(\DateTimeInterface|string|null $birthDate): ?string
{
    $birthDate = normalizeBirthDateInput($birthDate);

    if ($birthDate === null) {
        return null;
    }

    $month = (int) (new DateTime($birthDate))->format('n');

    return match ($month) {
        1 => 'January',
        2 => 'February',
        3 => 'March',
        4 => 'April',
        5 => 'May',
        6 => 'June',
        7 => 'July',
        8 => 'August',
        9 => 'September',
        10 => 'October',
        11 => 'November',
        12 => 'December',
        default => null,
    };
}

function birthstoneMonthIdFromBirthDate(\DateTimeInterface|string|null $birthDate): ?int
{
    $monthName = birthstoneMonthNameFromBirthDate($birthDate);

    if (!$monthName) {
        return null;
    }

    return BirthstoneMonth::query()
        ->where('month_name', $monthName)
        ->value('month_id');
}

function astrologySignProfiles(): array
{
    return [
        'Aries' => [
            'gem_name' => 'Diamond',
            'image' => asset('images/diamond.jpg'),
            'summary' => 'Bold, direct, and full of momentum. Diamond brings a sharp, luminous finish to Aries energy.',
            'details' => 'Best when you want clarity, confidence, and a strong first impression.',
            'accent' => 'Fire / Initiative',
        ],
        'Taurus' => [
            'gem_name' => 'Emerald',
            'image' => asset('images/emerald.jpg'),
            'summary' => 'Grounded and refined. Emerald complements Taurus with calm depth and timeless richness.',
            'details' => 'A great match for steady style, lasting quality, and luxurious everyday wear.',
            'accent' => 'Earth / Stability',
        ],
        'Gemini' => [
            'gem_name' => 'Amethyst',
            'image' => asset('images/amethyst.jpg'),
            'summary' => 'Curious and fast-moving. Amethyst keeps Gemini polished while still feeling expressive and light.',
            'details' => 'Ideal when you want a versatile stone that feels lively but balanced.',
            'accent' => 'Air / Adaptability',
        ],
        'Cancer' => [
            'gem_name' => 'Ruby',
            'image' => asset('images/ruby.jpg'),
            'summary' => 'Protective and intuitive. Ruby adds warmth, courage, and a glow that feels emotionally rich.',
            'details' => 'Perfect for soft power, heartfelt gifts, and elegant pieces with a little drama.',
            'accent' => 'Water / Protection',
        ],
        'Leo' => [
            'gem_name' => 'Peridot',
            'image' => asset('images/peridot.jpg'),
            'summary' => 'Radiant and creative. Peridot matches Leo’s bright presence with fresh, confident energy.',
            'details' => 'A strong choice for standout styling and jewelry that feels visible and joyful.',
            'accent' => 'Fire / Radiance',
        ],
        'Virgo' => [
            'gem_name' => 'Sapphire',
            'image' => asset('images/sapphire.jpg'),
            'summary' => 'Clear-minded and precise. Sapphire reflects Virgo’s love of order, elegance, and clean detail.',
            'details' => 'Excellent for refined looks, meaningful gifts, and understated luxury.',
            'accent' => 'Earth / Precision',
        ],
        'Libra' => [
            'gem_name' => 'Opal',
            'image' => asset('images/opal.jpg'),
            'summary' => 'Balanced and beautifully styled. Opal suits Libra’s eye for harmony, softness, and grace.',
            'details' => 'Great for romantic designs, smooth color play, and a polished finish.',
            'accent' => 'Air / Harmony',
        ],
        'Scorpio' => [
            'gem_name' => 'Topaz',
            'image' => asset('images/topaz.png'),
            'summary' => 'Intense and magnetic. Topaz gives Scorpio a bright focal point with depth and edge.',
            'details' => 'Best for statement pieces that feel powerful without losing elegance.',
            'accent' => 'Water / Depth',
        ],
        'Sagittarius' => [
            'gem_name' => 'Turquoise',
            'image' => asset('images/main_website/web_dec.png'),
            'summary' => 'Free-spirited and adventurous. Turquoise keeps Sagittarius feeling open, bright, and optimistic.',
            'details' => 'A lovely stone for travel, movement, and a more playful jewelry mood.',
            'accent' => 'Fire / Adventure',
        ],
        'Capricorn' => [
            'gem_name' => 'Garnet',
            'image' => asset('images/garnet.jpg'),
            'summary' => 'Focused and enduring. Garnet gives Capricorn a strong, classic presence with deep color.',
            'details' => 'Well suited to timeless pieces, serious style, and long-wear value.',
            'accent' => 'Earth / Discipline',
        ],
        'Aquarius' => [
            'gem_name' => 'Amethyst',
            'image' => asset('images/amethyst.jpg'),
            'summary' => 'Original and future-minded. Amethyst suits Aquarius with a cool, distinct, modern feel.',
            'details' => 'A good choice for clean lines, creative energy, and contemporary styling.',
            'accent' => 'Air / Originality',
        ],
        'Pisces' => [
            'gem_name' => 'Aquamarine',
            'image' => asset('images/aquamarine.jpg'),
            'summary' => 'Soft, intuitive, and fluid. Aquamarine matches Pisces with a serene, dreamy tone.',
            'details' => 'Beautiful for delicate pieces, calming color, and a gentle everyday look.',
            'accent' => 'Water / Intuition',
        ],
    ];
}

function zodiacArtworkForSign(string $signName): string
{
    return match ($signName) {
        'Aries' => asset('images/Zodiac/aries.png'),
        'Taurus' => asset('images/Zodiac/taurus.png'),
        'Gemini' => asset('images/Zodiac/gemini.png'),
        'Cancer' => asset('images/Zodiac/cancer.png'),
        'Leo' => asset('images/Zodiac/leo.png'),
        'Virgo' => asset('images/Zodiac/virgo.png'),
        'Libra' => asset('images/Zodiac/libra.png'),
        'Scorpio' => asset('images/Zodiac/scorpio.png'),
        'Sagittarius' => asset('images/Zodiac/saggitarius.png'),
        'Capricorn' => asset('images/Zodiac/capricorn.png'),
        'Aquarius' => asset('images/Zodiac/aquarius.png'),
        'Pisces' => asset('images/Zodiac/pisces.png'),
        default => asset('images/Zodiac/banner.jpg'),
    };
}

function zodiacGemArtworkForSign(string $signName): string
{
    return match ($signName) {
        'Aries' => asset('images/diamond.jpg'),
        'Taurus' => asset('images/emerald.jpg'),
        'Gemini' => asset('images/amethyst.jpg'),
        'Cancer' => asset('images/ruby.jpg'),
        'Leo' => asset('images/peridot.jpg'),
        'Virgo' => asset('images/sapphire.jpg'),
        'Libra' => asset('images/opal.jpg'),
        'Scorpio' => asset('images/topaz.png'),
        'Sagittarius' => asset('images/main_website/web_j70.jfif'),
        'Capricorn' => asset('images/garnet.jpg'),
        'Aquarius' => asset('images/amethyst.jpg'),
        'Pisces' => asset('images/aquamarine.jpg'),
        default => asset('images/placeholders/notavailable.png'),
    };
}

function zodiacProfileForSign(string $signName): array
{
    return match ($signName) {
        'Aries' => ['gem_name' => 'Diamond', 'summary' => 'Bold, direct, and full of momentum.', 'details' => 'Best when you want clarity and confidence.', 'accent' => 'Fire / Initiative'],
        'Taurus' => ['gem_name' => 'Emerald', 'summary' => 'Calm, grounded, and refined.', 'details' => 'A steady match for timeless style.', 'accent' => 'Earth / Stability'],
        'Gemini' => ['gem_name' => 'Amethyst', 'summary' => 'Curious, quick, and expressive.', 'details' => 'Ideal for light, versatile energy.', 'accent' => 'Air / Adaptability'],
        'Cancer' => ['gem_name' => 'Ruby', 'summary' => 'Warm, protective, and intuitive.', 'details' => 'A rich choice for heartfelt elegance.', 'accent' => 'Water / Protection'],
        'Leo' => ['gem_name' => 'Peridot', 'summary' => 'Bright, confident, and creative.', 'details' => 'Made for standout presence.', 'accent' => 'Fire / Radiance'],
        'Virgo' => ['gem_name' => 'Sapphire', 'summary' => 'Clear-minded and precise.', 'details' => 'A clean fit for polished looks.', 'accent' => 'Earth / Precision'],
        'Libra' => ['gem_name' => 'Opal', 'summary' => 'Balanced and beautifully styled.', 'details' => 'Soft, graceful, and easy to wear.', 'accent' => 'Air / Harmony'],
        'Scorpio' => ['gem_name' => 'Topaz', 'summary' => 'Intense, magnetic, and focused.', 'details' => 'Strong without losing elegance.', 'accent' => 'Water / Depth'],
        'Sagittarius' => ['gem_name' => 'Turquoise', 'summary' => 'Open, bright, and adventurous.', 'details' => 'A playful choice with movement.', 'accent' => 'Fire / Adventure'],
        'Capricorn' => ['gem_name' => 'Garnet', 'summary' => 'Focused and enduring.', 'details' => 'Classic, steady, and long-lasting.', 'accent' => 'Earth / Discipline'],
        'Aquarius' => ['gem_name' => 'Amethyst', 'summary' => 'Original and future-minded.', 'details' => 'Cool, modern, and distinctive.', 'accent' => 'Air / Originality'],
        'Pisces' => ['gem_name' => 'Aquamarine', 'summary' => 'Soft, intuitive, and fluid.', 'details' => 'Gentle and calm in every setting.', 'accent' => 'Water / Intuition'],
        default => ['gem_name' => 'Gemstone', 'summary' => 'Your sign profile.', 'details' => 'Personalized astrology details.', 'accent' => null],
    };
}

function zodiacElementArtworkForElement(?string $element): string
{
    return match ($element) {
        'Fire' => asset('images/Zodiac/fire.png'),
        'Earth' => asset('images/Zodiac/earth.png'),
        'Air' => asset('images/Zodiac/air.png'),
        'Water' => asset('images/Zodiac/water.png'),
        default => asset('images/Zodiac/elements.jpg'),
    };
}

function zodiacElementBannerForElement(?string $element): string
{
    return match ($element) {
        'Fire', 'Earth', 'Air', 'Water' => asset('images/Zodiac/elements.jpg'),
        default => asset('images/Zodiac/elements.jpg'),
    };
}

function zodiacCompatibilityBanner(): string
{
    return asset('images/Zodiac/compatible.jpg');
}

function customJewelleryOptionSets(): array
{
    return [
        'measurement_options' => [
            'ring' => ['4', '4.5', '5', '5.5', '6', '6.5', '7', '7.5', '8', '8.5', '9', '9.5', '10'],
            'necklace' => ['14 inches', '16 inches', '18 inches', '20 inches', '22 inches', '24 inches'],
            'bracelet' => ['6 inches', '6.5 inches', '7 inches', '7.5 inches', '8 inches', '8.5 inches'],
            'earring' => ['8 mm', '10 mm', '12 mm', '15 mm', '18 mm', '20 mm', '25 mm'],
            'chain' => ['16 inches', '18 inches', '20 inches', '22 inches', '24 inches', '30 inches'],
            'bangle' => ['2.2', '2.3', '2.4', '2.5', '2.6', '2.7', '2.8'],
            'pendant' => ['Small', 'Medium', 'Large'],
        ],
        'field_options' => [
            'ring' => [
                'ring_band_type' => ['Classic', 'Split shank', 'Halo', 'Three-stone', 'Twisted'],
                'ring_gem_cut' => ['Round', 'Oval', 'Princess', 'Cushion', 'Emerald', 'Pear', 'Marquise'],
                'ring_setting_style' => ['Prong', 'Bezel', 'Pavé', 'Channel', 'Tension'],
            ],
            'necklace' => [
                'necklace_chain_type' => ['Cable', 'Curb', 'Box', 'Rope', 'Figaro'],
                'necklace_pendant_type' => ['Solitaire', 'Halo', 'Drop', 'Locket', 'Cluster'],
                'necklace_chain_style' => ['Fine', 'Bold', 'Layered', 'Adjustable'],
            ],
            'bracelet' => [
                'bracelet_bracelet_type' => ['Tennis', 'Chain', 'Cuff', 'Charm', 'Bangle'],
                'bracelet_clasp_type' => ['Lobster', 'Box', 'Toggle', 'Slide', 'Hidden'],
                'bracelet_finish' => ['Polished', 'Brushed', 'Matte', 'Hammered'],
            ],
            'earring' => [
                'earring_earring_type' => ['Stud', 'Hoop', 'Drop', 'Huggie', 'Chandelier'],
                'earring_backing_type' => ['Push-back', 'Leverback', 'Screw-back', 'Clip-on'],
                'earring_drop_style' => ['Short', 'Medium', 'Long', 'Statement'],
            ],
            'chain' => [
                'chain_chain_type' => ['Cable', 'Rope', 'Figaro', 'Box', 'Wheat'],
                'chain_link_style' => ['Fine', 'Bold', 'Intricate', 'Flat'],
                'chain_clasp_type' => ['Spring ring', 'Lobster', 'Box', 'Toggle'],
            ],
            'bangle' => [
                'bangle_bangle_type' => ['Solid', 'Open', 'Hinged', 'Adjustable'],
                'bangle_finish' => ['High polish', 'Satin', 'Matte', 'Hammered'],
                'bangle_hinge_type' => ['Hinged', 'Slip-on', 'Adjustable'],
            ],
            'pendant' => [
                'pendant_pendant_shape' => ['Round', 'Oval', 'Heart', 'Teardrop', 'Star'],
                'pendant_setting_type' => ['Bezel', 'Prong', 'Halo', 'Flush'],
                'pendant_bail_type' => ['Hidden', 'Decorative', 'Fixed', 'Swivel'],
            ],
        ],
    ];
}

function validateAndSaveProfileDetails(Request $request)
{
    $validated = $request->validate([
        'full_name' => ['required', 'string', 'max:150', 'regex:/^[A-Za-z\s\'-]+$/'],
        'email' => ['required', 'email', 'max:255', 'unique:users,email,'.Auth::id()],
        'phone_number' => ['nullable', 'string', 'max:30'],
        'birth_date' => ['nullable', 'date'],
        'address' => ['nullable', 'string', 'max:1000'],
    ], [
        'full_name.regex' => 'Full name can only contain letters, spaces, apostrophes, and hyphens.',
    ]);

    $nameParts = preg_split('/\s+/', trim($validated['full_name'])) ?: [];
    $firstName = array_shift($nameParts) ?: '';
    $lastName = count($nameParts) ? implode(' ', $nameParts) : null;

    $request->user()->forceFill([
        'first_name' => $firstName,
        'last_name' => $lastName,
        'email' => $validated['email'],
        'phone_number' => $validated['phone_number'] ?: null,
        'birth_date' => $validated['birth_date'] ?: null,
        'zodiac_id' => $validated['birth_date'] ? zodiacIdFromBirthDate($validated['birth_date']) : null,
        'address' => $validated['address'] ?: null,
    ])->save();
}

Route::get('/', function () {
    $featuredJewelleryProducts = Product::query()
        ->select('products.product_id', 'products.name', 'products.description', 'products.image', 'products.price')
        ->whereHas('jewellery')
        ->with(['jewellery.type'])
        ->withSum([
            'orderItems as sold_units' => fn ($query) => $query->whereHas('order', fn ($order) => $order->where('status', '!=', 'Cancelled')),
        ], 'quantity')
        ->orderByDesc('sold_units')
        ->orderBy('name')
        ->limit(4)
        ->get()
        ->map(function (Product $product) {
            $jewellery = $product->jewellery;
            $jewelleryType = $jewellery?->type?->name ?? 'Jewellery';

            return [
                'product_id' => $product->product_id,
                'name' => $product->name,
                'category' => $jewelleryType,
                'price' => $product->price,
                'image' => $product->image
                    ? asset('images/Product/'.$product->image)
                    : asset('images/placeholders/notavailable.png'),
                'url' => route('products.show', $product->product_id),
                'sold_units' => (int) ($product->sold_units ?? 0),
            ];
        });

    $bannerProductForType = function (string $typeKeyword) {
        return Product::query()
            ->select('products.product_id', 'products.name', 'products.description', 'products.image', 'products.price')
            ->whereHas('jewellery.type', function ($query) use ($typeKeyword) {
                $query->whereRaw('LOWER(name) LIKE ?', ['%'.strtolower($typeKeyword).'%']);
            })
            ->orderBy('name')
            ->first();
    };

    $necklaceBannerProduct = $bannerProductForType('necklace');
    $earringBannerProduct = $bannerProductForType('earring');

    $bannerCards = [
        [
            'subtitle' => 'LUXURY NECKLACE',
            'title' => 'Best Friend <br>Jewelry',
            'description' => 'A wide range of exquisite necklaces crafted with perfection.',
            'url' => route('jewellery', ['category' => 'type:necklace']),
            'image' => $necklaceBannerProduct?->image
                ? asset('images/Product/' . $necklaceBannerProduct->image)
                : asset('images/main_website/web_c1.jfif'),
        ],
        [
            'subtitle' => 'OUR EARRINGS',
            'title' => 'Diamond <br> Stud Earrings',
            'description' => 'A wide range of exquisite earrings for every occasion.',
            'url' => route('jewellery', ['category' => 'type:earring']),
            'image' => $earringBannerProduct?->image
                ? asset('images/Product/' . $earringBannerProduct->image)
                : asset('images/main_website/web_c2.png'),
        ],
    ];

    $featuredGemProducts = Product::query()
        ->select('products.product_id', 'products.name', 'products.description', 'products.image', 'products.price')
        ->whereHas('gem')
        ->with(['gem.gemType'])
        ->withSum([
            'orderItems as sold_units' => fn ($query) => $query->whereHas('order', fn ($order) => $order->where('status', '!=', 'Cancelled')),
        ], 'quantity')
        ->orderByDesc('sold_units')
        ->orderBy('name')
        ->limit(4)
        ->get()
        ->map(function (Product $product) {
            $gemType = $product->gem?->gemType?->name ?? 'Gem';

            return [
                'product_id' => $product->product_id,
                'name' => $product->name,
                'category' => $gemType,
                'price' => $product->price,
                'image' => $product->image
                    ? asset('images/Product/'.$product->image)
                : asset('images/placeholders/notavailable.png'),
                'url' => route('products.show', $product->product_id),
                'sold_units' => (int) ($product->sold_units ?? 0),
            ];
        });

    $homeReviews = ProductReview::query()
        ->where('status', 'approved')
        ->with([
            'user:id,first_name,last_name,profile_image_path',
            'product:product_id,name,image',
        ])
        ->latest()
        ->limit(6)
        ->get()
        ->map(function (ProductReview $review) {
            $authorName = trim((string) ($review->user?->first_name ?? '').' '.(string) ($review->user?->last_name ?? ''));
            $authorName = $authorName !== '' ? $authorName : ($review->name ?: 'Verified Buyer');

            return [
                'rating' => (int) $review->rating,
                'rating_label' => number_format((float) $review->rating, 1),
                'text' => Str::limit((string) $review->review, 180),
                'author_name' => Str::title($authorName),
                'author_role' => 'Verified Buyer',
                'product_name' => $review->product?->name,
                'avatar_url' => $review->user?->profileImageUrl(),
                'avatar_initial' => $review->user?->profileInitial() ?? strtoupper(substr($authorName ?: 'V', 0, 1)),
            ];
        })
        ->values();

    $homeReviewCount = ProductReview::query()
        ->where('status', 'approved')
        ->count();

    $homeHappyCustomers = ProductReview::query()
        ->where('status', 'approved')
        ->whereNotNull('user_id')
        ->distinct()
        ->count('user_id');

    if ($homeHappyCustomers <= 0) {
        $homeHappyCustomers = $homeReviewCount;
    }

    return view('home', [
        'featuredJewelleryProducts' => $featuredJewelleryProducts,
        'bannerCards' => $bannerCards,
        'featuredGemProducts' => $featuredGemProducts,
        'homeReviews' => $homeReviews,
        'homeReviewCount' => $homeReviewCount,
        'homeHappyCustomers' => $homeHappyCustomers,
    ]);
})->name('home');

Route::post('/newsletter/subscribe', function (Request $request) {
    $email = Str::lower(trim((string) $request->input('email', '')));
    $newsletterRedirect = fn (string $message) => redirect()->to(route('home').'#newsletter-section')->with('newsletter_success', $message);

    validator(['email' => $email], [
        'email' => ['required', 'email:rfc,dns', 'max:255'],
    ])->validate();

    if (NewsletterSubscriber::query()->where('email', $email)->exists()) {
        return $newsletterRedirect('You are already subscribed to our newsletter.');
    }

    try {
        NewsletterSubscriber::create([
            'email' => $email,
            'subscribed_at' => now(),
        ]);
    } catch (QueryException $exception) {
        if ((int) ($exception->errorInfo[1] ?? 0) === 1062) {
            return $newsletterRedirect('You are already subscribed to our newsletter.');
        }

        throw $exception;
    }

    return $newsletterRedirect('Thanks for subscribing to our newsletter.');
})->name('newsletter.subscribe');

Route::get('/about', function () {
    return view('about'); // Laravel will automatically find resources/views/about.blade.php
})->name('about');

Route::get('/blogs', [ContentPostController::class, 'index'])->name('blogs');
Route::get('/blogs/{contentPost:slug}', [ContentPostController::class, 'show'])->name('blogs.show');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/faq', function () {
    $faqEntries = FaqEntry::query()
        ->published()
        ->orderBy('group_name')
        ->orderByDesc('updated_at')
        ->get();

    return view('faq', [
        'faqEntries' => $faqEntries,
    ]);
})->name('faq');

Route::get('/terms-and-conditions', function () {
    return view('terms');
})->name('terms');

Route::get('/privacy-policy', function () {
    return view('privacy');
})->name('privacy');

Route::get('/story', function () {
    return view('story');
})->name('story');

Route::get('/gemstory', function () {
    return view('gemstory');
})->name('gemstory');

Route::get('/juwelerystory', function () {
    return view('juwelerystory');
})->name('juwelerystory');

Route::get('/signin', function () {
    if (Auth::check()) {
        return redirectUserByRole(Auth::user());
    }

    return view('signin');
})->name('signin');


Route::redirect('/login', '/')->name('login');


Route::post('/signup', function (Request $request) {
    $validated = $request->validateWithBag('signup', [
        'first_name' => 'required|string|max:100',
        'last_name' => 'nullable|string|max:100',
        'gender' => 'required|in:Male,Female,Other',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|confirmed|min:6',
        'birth_date' => 'required|date|before:' . date('Y-m-d', strtotime('-13 years')),
    ], [
        'first_name.required' => 'First name is required.',
        'last_name.regex' => 'Last name can only contain letters, spaces, apostrophes, and hyphens.',
        'gender.required' => 'Gender is required.',
        'gender.in' => 'Please select a valid gender.',
        'birth_date.required' => 'Date of birth is required.',
        'birth_date.before' => 'You must be at least 13 years old to register.',
        'email.unique' => 'This email is already registered.',
        'password.confirmed' => 'Password confirmation does not match.',
    ]);
    $zodiacId = zodiacIdFromBirthDate($validated['birth_date']);
    if (!$zodiacId) {
        return back()
            ->withErrors(['birth_date' => 'Unable to resolve zodiac sign for the selected birth date.'], 'signup')
            ->withInput($request->only('first_name', 'last_name', 'gender', 'email', 'birth_date'));
    }
    $user = User::create([
        'first_name' => $validated['first_name'],
        'last_name' => $validated['last_name'] ?? null,
        'gender' => $validated['gender'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'birth_date' => $validated['birth_date'],
        'zodiac_id' => $zodiacId,
        'role' => 'customer',
    ]);
    return redirect()->route('signin')->with('auth_success', 'Account created successfully. Please sign in.');
})->name('signup.submit');


Route::post('/signin', function (Request $request) {
    $credentials = $request->validateWithBag('signin', [
        'email' => ['required', 'email'],
        'password' => ['required', 'string'],
    ]);

    $user = User::query()->where('email', $credentials['email'])->first();
    if ($user && Str::lower((string) ($user->account_status ?? '')) === 'blocked') {
        return back()
            ->with('auth_error', 'Your account has been blocked. Please contact support.')
            ->withInput($request->only('email'));
    }

    if (Auth::attempt($credentials, $request->boolean('remember'))) {
        $request->session()->regenerate();
        $authenticatedUser = Auth::user();

        if ($authenticatedUser && Str::lower((string) ($authenticatedUser->account_status ?? '')) === 'blocked') {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()
                ->with('auth_error', 'Your account has been blocked. Please contact support.')
                ->withInput($request->only('email'));
        }

        return redirectUserByRole($authenticatedUser);
    }

    return back()
        ->withErrors(['email' => 'Invalid email or password.'], 'signin')
        ->withInput($request->only('email'));
})->name('signin.submit');

function recordAdminActivity(?User $actor, Request $request, string $action, string $module, string $summary, ?string $subjectType = null, ?int $subjectId = null): void
{
    try {
        AdminActivityLog::create([
            'actor_user_id' => $actor?->id,
            'actor_name' => trim((($actor?->first_name ?? '') . ' ' . ($actor?->last_name ?? ''))) ?: 'System',
            'actor_role' => $actor?->role ?: 'system',
            'action' => $action,
            'module' => $module,
            'subject_type' => $subjectType,
            'subject_id' => $subjectId,
            'summary' => $summary,
            'ip_address' => $request->ip(),
            'user_agent' => mb_substr((string) $request->userAgent(), 0, 1000),
        ]);
    } catch (Throwable $e) {
        report($e);
    }
}

Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
        if ($redirect = ensureCustomerDashboardAccess()) {
            return $redirect;
        }

        return view('customer-account', ['activeSection' => 'profile']);
    })->name('profile');

    Route::get('/astrology', function () {
        if ($redirect = ensureCustomerDashboardAccess()) {
            return $redirect;
        }

        $user = Auth::user()->loadMissing('zodiacSign');
        $resolvedZodiacId = $user->zodiac_id ?: ($user->birth_date ? zodiacIdFromBirthDate($user->birth_date) : null);
        $currentSign = $resolvedZodiacId ? ZodiacSign::query()->find($resolvedZodiacId) : $user->zodiacSign;
        $astrologyProfiles = astrologySignProfiles();

        $normalizeAstrologyStoneName = function (?string $value): string {
            $value = Str::lower(trim((string) $value));

            if ($value === '') {
                return '';
            }

            $value = preg_replace('/[^a-z0-9]+/', ' ', $value) ?? $value;
            $value = trim(preg_replace('/\s+/', ' ', $value) ?? $value);
            $value = preg_replace('/^(natural|genuine|real|pure|blue|light|dark|pink|green|yellow|white|black|red|purple|clear|raw|rough)\s+/', '', $value) ?? $value;

            return trim(preg_replace('/\s+/', ' ', $value) ?? $value);
        };

        $astrologyStoneSearchTerms = function (?string $value) use ($normalizeAstrologyStoneName): array {
            $raw = Str::lower(trim((string) $value));
            $normalized = $normalizeAstrologyStoneName($raw);

            return array_values(array_unique(array_filter([
                $raw,
                $normalized,
            ])));
        };

        $formatAstrologyProductCards = function ($products) {
            return collect($products)
                ->filter(function (Product $product) {
                    if ($product->relationLoaded('gem') || $product->relationLoaded('jewellery') || $product->relationLoaded('collection')) {
                        return ($product->relationLoaded('gem') && $product->gem)
                            || ($product->relationLoaded('jewellery') && $product->jewellery)
                            || ($product->relationLoaded('collection') && $product->collection);
                    }

                    return $product->gem()->exists() || $product->jewellery()->exists() || $product->collection()->exists();
                })
                ->take(6)
                ->map(function (Product $product) {
                    $stock = max(0, (int) ($product->stock ?? 0));

                    return [
                        'product_id' => $product->product_id,
                        'name' => $product->name,
                        'description' => $product->description,
                        'image' => $product->image
                            ? asset('images/Product/'.$product->image)
                            : asset('images/placeholders/notavailable.png'),
                        'meta' => $product->gem?->gemType?->name
                            ?: ($product->jewellery?->gemstone ?: ($product->collection?->gemstone ?: 'Birthstone')),
                        'price' => $product->price,
                        'stock' => $stock,
                        'stock_status' => $stock <= 0 ? 'out-of-stock' : ($stock <= 5 ? 'critical' : 'in-stock'),
                        'stock_label' => $stock <= 0 ? 'Out of Stock' : ($stock <= 5 ? 'Only ' . $stock . ' left' : 'In Stock'),
                        'url' => route('products.show', $product->product_id),
                    ];
                })
                ->values();
        };

        $currentSignCard = $currentSign ? [
            'zodiac_id' => $currentSign->zodiac_id,
            'sign_name' => $currentSign->sign_name,
            'element' => $currentSign->element,
            'element_description' => $currentSign->element_description,
            'description' => $currentSign->description,
            'compatible_sign' => $currentSign->compatible_sign,
            'image' => $currentSign->image ? asset('images/Zodiac/'.$currentSign->image) : zodiacArtworkForSign($currentSign->sign_name),
            'element_image' => zodiacElementArtworkForElement($currentSign->element),
            'element_banner' => zodiacElementBannerForElement($currentSign->element),
            'compatible_banner' => zodiacCompatibilityBanner(),
        ] : null;

        $birthstoneMonthId = $user->birth_date ? birthstoneMonthIdFromBirthDate($user->birth_date) : null;
        $birthstoneMonth = $birthstoneMonthId
            ? BirthstoneMonth::query()->find($birthstoneMonthId)
            : null;
        $birthstoneLink = $birthstoneMonth
            ? ProductBirthstone::query()
                ->with(['product' => fn ($query) => $query->with(['gem.gemType', 'jewellery', 'collection'])])
                ->where('month_id', $birthstoneMonth->month_id)
                ->orderBy('product_id')
                ->first()
            : null;
        $birthstoneProduct = $birthstoneLink?->product;
        $birthstoneGemName = trim((string) (
            $birthstoneProduct?->gem?->gemType?->name
            ?: $birthstoneProduct?->jewellery?->gemstone
            ?: $birthstoneProduct?->collection?->gemstone
            ?: ''
        ));
        $birthstoneStoneKey = $normalizeAstrologyStoneName($birthstoneGemName);

        $birthstoneProducts = $birthstoneMonth
            ? $birthstoneMonth->products()
                ->with(['gem.gemType', 'jewellery', 'collection'])
                ->orderBy('products.name')
                ->get()
            : collect();

        $matchingJewelleryProducts = $birthstoneStoneKey !== ''
            ? Product::query()
                ->with(['gem.gemType', 'jewellery', 'collection'])
                ->whereHas('jewellery', function ($query) use ($astrologyStoneSearchTerms, $birthstoneGemName, $birthstoneStoneKey) {
                    $searchTerms = $astrologyStoneSearchTerms($birthstoneGemName);
                    if ($birthstoneStoneKey !== '' && !in_array($birthstoneStoneKey, $searchTerms, true)) {
                        $searchTerms[] = $birthstoneStoneKey;
                    }
                    $searchTerms = array_values(array_unique(array_filter($searchTerms)));

                    if (!count($searchTerms)) {
                        $searchTerms = [$birthstoneStoneKey];
                    }

                    $query->whereNotNull('gemstone')
                        ->where(function ($nested) use ($searchTerms) {
                            foreach ($searchTerms as $index => $term) {
                                $pattern = '%' . $term . '%';

                                if ($index === 0) {
                                    $nested->whereRaw('LOWER(TRIM(gemstone)) LIKE ?', [$pattern]);
                                    continue;
                                }

                                $nested->orWhereRaw('LOWER(TRIM(gemstone)) LIKE ?', [$pattern]);
                            }
                        });
                })
                ->orderBy('name')
                ->get()
            : collect();

        $birthstoneCard = $birthstoneMonth ? [
            'month_id' => $birthstoneMonth->month_id,
            'month_name' => $birthstoneMonth->month_name,
            'description' => $birthstoneLink->description ?? $birthstoneMonth->description ?? $birthstoneProduct?->description,
            'product_name' => $birthstoneProduct?->name,
            'image' => $birthstoneProduct?->image
                ? asset('images/Product/'.$birthstoneProduct->image)
                : asset('images/placeholders/notavailable.png'),
        ] : null;

        $currentRecommendedProducts = $formatAstrologyProductCards(
            $birthstoneProducts
                ->merge($matchingJewelleryProducts)
                ->unique('product_id')
                ->values()
        );
        $recommendedProductLabel = $birthstoneGemName !== '' ? $birthstoneGemName : (($birthstoneMonth?->month_name ?? '') !== '' ? $birthstoneMonth->month_name . ' Birthstone' : 'Birthstone');

        $signOptions = ZodiacSign::query()
            ->orderBy('zodiac_id')
            ->get()
            ->map(function (ZodiacSign $sign) {
                return [
                    'zodiac_id' => $sign->zodiac_id,
                    'sign_name' => $sign->sign_name,
                    'element' => $sign->element,
                    'element_description' => $sign->element_description,
                    'description' => $sign->description,
                    'compatible_sign' => $sign->compatible_sign,
                    'image' => $sign->image
                        ? asset('images/Zodiac/'.$sign->image)
                        : zodiacArtworkForSign($sign->sign_name),
                    'element_image' => zodiacElementArtworkForElement($sign->element),
                    'element_banner' => zodiacElementBannerForElement($sign->element),
                    'compatible_banner' => zodiacCompatibilityBanner(),
                ];
            })
            ->values();

        $selectedSignId = $currentSign?->zodiac_id ?? $signOptions->first()['zodiac_id'] ?? null;

        return view('astrology', [
            'user' => $user,
            'currentSign' => $currentSign,
            'currentSignCard' => $currentSignCard,
            'birthstoneMonth' => $birthstoneMonth,
            'birthstoneProduct' => $birthstoneProduct,
            'birthstoneCard' => $birthstoneCard,
            'recommendedProductLabel' => $recommendedProductLabel,
            'signOptions' => $signOptions,
            'selectedSignId' => $selectedSignId,
            'currentRecommendedProducts' => $currentRecommendedProducts,
        ]);
    })->name('astrology');

    Route::post('/profile', function (Request $request) {
        if ($redirect = ensureCustomerDashboardAccess()) {
            return $redirect;
        }

        validateAndSaveProfileDetails($request);

        return profileRedirectResponse($request, 'Profile details updated successfully.');
    })->name('profile.update');

    Route::post('/profile/image', function (Request $request) {
        $validated = $request->validate([
            'profile_image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
        ]);

        $user = $request->user();
        $folderMap = [
            'admin' => 'admins',
            'consultant' => 'consultants',
            'customer' => 'customers',
        ];
        $roleFolder = $folderMap[$user->role] ?? 'customers';
        $relativeDirectory = 'uploads/profile-images/'.$roleFolder;
        $directory = public_path($relativeDirectory);

        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        if ($user->profile_image_path) {
            $oldImagePath = public_path($user->profile_image_path);
            $managedPrefixes = ['uploads/profile-images/admins/', 'uploads/profile-images/consultants/', 'uploads/profile-images/customers/'];

            if (collect($managedPrefixes)->contains(fn ($prefix) => Str::startsWith($user->profile_image_path, $prefix)) && File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }
        }

        $extension = $validated['profile_image']->getClientOriginalExtension();
        $fileName = Str::uuid().'.'.$extension;
        $validated['profile_image']->move($directory, $fileName);

        $user->forceFill([
            'profile_image_path' => $relativeDirectory.'/'.$fileName,
        ])->save();

        return profileRedirectResponse($request, 'Profile image updated successfully.', 'profile_image_success');
    })->name('profile.image.update');

    Route::post('/profile/image/remove', function (Request $request) {
        if ($redirect = ensureCustomerDashboardAccess()) {
            return $redirect;
        }

        $user = $request->user();

        if ($user->profile_image_path) {
            $oldImagePath = public_path($user->profile_image_path);
            $managedPrefixes = ['uploads/profile-images/admins/', 'uploads/profile-images/consultants/', 'uploads/profile-images/customers/'];

            if (collect($managedPrefixes)->contains(fn ($prefix) => Str::startsWith($user->profile_image_path, $prefix)) && File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }
        }

        $user->forceFill([
            'profile_image_path' => null,
        ])->save();

        return profileRedirectResponse($request, 'Profile image removed successfully.', 'profile_image_success');
    })->name('profile.image.remove');

    Route::get('/admin/dashboard', function (Request $request) {
        abort_unless(Auth::check() && Auth::user()->canAccessAdminDashboard(), 403);
        $metalPriceService = app(MetalPriceService::class);
        $metalRates = $metalPriceService->normalizedRates();
        $metalSnapshotAt = $metalPriceService->latestSnapshot();
        $metalQuoteCurrency = strtoupper((string) ($metalRates['quote_currency'] ?? config('services.metalpriceapi.quote_currency', 'LKR')));
        $metalMarketFactor = (float) config('services.metalpriceapi.market_factor', 0.8);
        $metalLabels = [
            'gold' => 'Gold',
            'silver' => 'Silver',
            'platinum' => 'Platinum',
        ];

        $metalPriceRows = collect($metalLabels)
            ->map(function (string $label, string $key) use ($metalRates, $metalSnapshotAt, $metalQuoteCurrency, $metalMarketFactor) {
                $rate = (array) ($metalRates[$key] ?? []);

                if (! isset($rate['price_per_gram'], $rate['price_per_troy_ounce'])) {
                    return null;
                }

                $pricePerGram = (float) $rate['price_per_gram'];
                $pricePerOunce = (float) $rate['price_per_troy_ounce'];
                $adjustedPricePerGram = $pricePerGram * $metalMarketFactor;

                return [
                    'id' => 'MTL-' . strtoupper(substr($key, 0, 3)),
                    'metal' => $label,
                    'symbol' => (string) ($rate['symbol'] ?? strtoupper(substr($key, 0, 3))),
                    'price_per_troy_ounce' => $pricePerOunce,
                    'price_per_gram' => $pricePerGram,
                    'adjusted_price_per_gram' => $adjustedPricePerGram,
                    'quote_currency' => $metalQuoteCurrency,
                    'snapshot_date' => $metalSnapshotAt?->format('Y-m-d') ?? today()->toDateString(),
                    'snapshot_time' => $metalSnapshotAt?->format('h:i A') ?? '-',
                ];
            })
            ->filter()
            ->values();

        $metalFilterOptions = $metalPriceRows->pluck('metal')->unique()->values();
        $metalSummaryMap = $metalPriceRows->keyBy('metal');

        $adminBlogPosts = ContentPost::query()
            ->ofType('blog')
            ->with('admin')
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->get();

        $adminBlogSummary = [
            'total' => $adminBlogPosts->count(),
            'published' => $adminBlogPosts->where('is_published', true)->count(),
            'draft' => $adminBlogPosts->where('is_published', false)->count(),
            'zodiac' => $adminBlogPosts->filter(function (ContentPost $post) {
                return Str::contains(Str::lower((string) $post->category), 'zodiac');
            })->count(),
        ];

        $adminNewsPosts = ContentPost::query()
            ->ofType('news')
            ->with('admin')
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->get();

        $adminNewsSummary = [
            'total' => $adminNewsPosts->count(),
            'published' => $adminNewsPosts->where('is_published', true)->count(),
            'draft' => $adminNewsPosts->where('is_published', false)->count(),
            'events' => $adminNewsPosts->filter(function (ContentPost $post) {
                return Str::contains(Str::lower((string) $post->category), 'event');
            })->count(),
        ];

        $adminFaqEntries = FaqEntry::query()
            ->with('admin')
            ->orderBy('group_name')
            ->orderByDesc('updated_at')
            ->get();

        $adminFaqSummary = [
            'total' => $adminFaqEntries->count(),
            'published' => $adminFaqEntries->where('is_published', true)->count(),
            'draft' => $adminFaqEntries->where('is_published', false)->count(),
            'consultation' => $adminFaqEntries->filter(fn (FaqEntry $entry) => Str::contains(Str::lower((string) $entry->group_name), 'consultation'))->count(),
        ];

        $dashboardData = [
            ...adminDashboardUserManagementData($request),
            ...adminDashboardProductData($request),
            ...adminDashboardOrderData($request),
            ...adminDashboardReturnData($request),
            ...adminDashboardCustomJewelleryData($request),
            ...adminDashboardNotificationData($request),
            ...adminDashboardContactMessageData($request),
            'adminBlogPosts' => $adminBlogPosts,
            'adminBlogSummary' => $adminBlogSummary,
            'adminNewsPosts' => $adminNewsPosts,
            'adminNewsSummary' => $adminNewsSummary,
            'adminFaqEntries' => $adminFaqEntries,
            'adminFaqSummary' => $adminFaqSummary,
            'metalPriceRows' => $metalPriceRows,
            'metalFilterOptions' => $metalFilterOptions,
            'metalSummaryMap' => $metalSummaryMap,
            'metalQuoteCurrency' => $metalQuoteCurrency,
            'metalSnapshotAt' => $metalSnapshotAt,
            'metalMarketFactor' => $metalMarketFactor,
        ];

        $dashboardData = array_merge($dashboardData, adminDashboardReportData($request));

        return view('admin-dashboard', [
            ...$dashboardData,
        ]);
    })->name('admin.dashboard');

    Route::get('/admin/reports/export/{section}', function (Request $request, string $section) {
        abort_unless(Auth::check() && Auth::user()->canAccessAdminDashboard(), 403);

        $section = Str::lower($section);
        $format = Str::lower((string) $request->query('format', 'csv'));
        $reportData = adminDashboardReportData($request);

        $normalizeFilterValue = function (?string $value): string {
            $value = trim((string) $value);

            if ($value === '') {
                return '';
            }

            $lower = Str::lower($value);
            if ($lower === 'all' || Str::startsWith($lower, 'all ')) {
                return '';
            }

            return $value;
        };

        $filterRows = function ($rows, ?string $fromDate = null, ?string $toDate = null, ?string $category = null) {
            return collect($rows)
                ->filter(function (array $row) use ($fromDate, $toDate, $category) {
                    if ($fromDate && !empty($row['from_date']) && $row['from_date'] !== '-' && $row['from_date'] < $fromDate) {
                        return false;
                    }
                    if ($toDate && !empty($row['to_date']) && $row['to_date'] !== '-' && $row['to_date'] > $toDate) {
                        return false;
                    }
                    if ($category && $category !== '' && Str::lower((string) ($row['category'] ?? $row['status'] ?? $row['product_type'] ?? $row['stock_status'] ?? $row['customer_type'] ?? $row['request_status'] ?? $row['revenue_type'] ?? $row['type'] ?? $row['consultation_type'] ?? '')) !== Str::lower($category)) {
                        return false;
                    }
                    return true;
                })
                ->values();
        };

        $fromDate = $normalizeFilterValue((string) $request->query('from_date', ''));
        $toDate = $normalizeFilterValue((string) $request->query('to_date', ''));
        $reportDateRange = $fromDate !== '' && $toDate !== ''
            ? $fromDate . ' to ' . $toDate
            : ($fromDate !== '' ? 'From ' . $fromDate : ($toDate !== '' ? 'Until ' . $toDate : 'All dates'));
        $reportMetaBase = [
            'subtitle' => 'Pinwantha Gems & Jewellery Admin Report Export',
            'date_range' => $reportDateRange,
        ];

        return match ($section) {
            'sales' => adminReportDownloadResponse(
                'sales-report',
                $format,
                'Sales Report',
                ['From Date', 'To Date', 'Category', 'Total Sales', 'Total Orders', 'Revenue'],
                $filterRows(
                    $reportData['salesReportRows'] ?? [],
                    $fromDate,
                    $toDate,
                    $normalizeFilterValue((string) $request->query('category', ''))
                )->map(fn (array $row) => [
                    $row['from_date'] ?? '-',
                    $row['to_date'] ?? '-',
                    $row['category'] ?? '-',
                    $row['total_sales'] ?? 0,
                    $row['total_orders'] ?? 0,
                    $row['revenue'] ?? 'Rs 0',
                ])->all(),
                array_merge($reportMetaBase, ['section_label' => 'Sales Reports'])
            ),
            'orders' => adminReportDownloadResponse(
                'order-report',
                $format,
                'Order Report',
                ['From Date', 'To Date', 'Status', 'Total Orders', 'Pickup-only', 'Cancelled'],
                $filterRows(
                    $reportData['orderReportRows'] ?? [],
                    $fromDate,
                    $toDate,
                    $normalizeFilterValue((string) $request->query('status', ''))
                )->map(fn (array $row) => [
                    $row['from_date'] ?? '-',
                    $row['to_date'] ?? '-',
                    $row['status'] ?? '-',
                    $row['total_orders'] ?? 0,
                    $row['pickup_only'] ?? 0,
                    $row['cancelled'] ?? 0,
                ])->all(),
                array_merge($reportMetaBase, ['section_label' => 'Order Reports'])
            ),
            'products' => adminReportDownloadResponse(
                'product-report',
                $format,
                'Product Report',
                ['From Date', 'To Date', 'Product Type', 'Top Selling', 'Most Viewed'],
                $filterRows(
                    $reportData['productReportRows'] ?? [],
                    $fromDate,
                    $toDate,
                    $normalizeFilterValue((string) $request->query('product_type', ''))
                )->map(fn (array $row) => [
                    $row['from_date'] ?? '-',
                    $row['to_date'] ?? '-',
                    $row['product_type'] ?? '-',
                    $row['top_selling'] ?? '-',
                    $row['most_viewed'] ?? '-',
                ])->all(),
                array_merge($reportMetaBase, ['section_label' => 'Product Reports'])
            ),
            'inventory' => adminReportDownloadResponse(
                'inventory-report',
                $format,
                'Inventory Report',
                ['From Date', 'To Date', 'Stock Status', 'Current Summary', 'Low Stock Items', 'Out of Stock'],
                $filterRows(
                    $reportData['inventoryReportRows'] ?? [],
                    $fromDate,
                    $toDate,
                    $normalizeFilterValue((string) $request->query('stock_status', ''))
                )->map(fn (array $row) => [
                    $row['from_date'] ?? '-',
                    $row['to_date'] ?? '-',
                    $row['stock_status'] ?? '-',
                    $row['summary'] ?? '-',
                    $row['low_stock_items'] ?? 0,
                    $row['out_of_stock_items'] ?? 0,
                ])->all(),
                array_merge($reportMetaBase, ['section_label' => 'Inventory Reports'])
            ),
            'customers' => adminReportDownloadResponse(
                'customer-report',
                $format,
                'Customer Report',
                ['From Date', 'To Date', 'Customer Type', 'Total', 'Top Buyer', 'Repeat Orders'],
                $filterRows(
                    $reportData['customerReportRows'] ?? [],
                    $fromDate,
                    $toDate,
                    $normalizeFilterValue((string) $request->query('customer_type', ''))
                )->map(fn (array $row) => [
                    $row['from_date'] ?? '-',
                    $row['to_date'] ?? '-',
                    $row['customer_type'] ?? '-',
                    $row['total'] ?? 0,
                    $row['top_buyer'] ?? '-',
                    $row['repeat_orders'] ?? 0,
                ])->all(),
                array_merge($reportMetaBase, ['section_label' => 'Customer Reports'])
            ),
            'consultations' => adminReportDownloadResponse(
                'consultation-report',
                $format,
                'Consultation Report',
                ['From Date', 'To Date', 'Consultation Type', 'Total Requests', 'Completed', 'Top Consultant'],
                $filterRows(
                    $reportData['consultationReportRows'] ?? [],
                    $fromDate,
                    $toDate,
                    $normalizeFilterValue((string) $request->query('consultation_type', ''))
                )->map(fn (array $row) => [
                    $row['from_date'] ?? '-',
                    $row['to_date'] ?? '-',
                    $row['type'] ?? '-',
                    $row['total_requests'] ?? 0,
                    $row['completed_requests'] ?? 0,
                    $row['top_consultant'] ?? '-',
                ])->all(),
                array_merge($reportMetaBase, ['section_label' => 'Consultation Reports'])
            ),
            'custom-jewellery' => adminReportDownloadResponse(
                'custom-jewellery-report',
                $format,
                'Custom Jewellery Report',
                ['From Date', 'To Date', 'Request Status', 'Total Requests', 'Custom Demand', 'Quotation Acceptance'],
                $filterRows(
                    $reportData['customJewelleryReportRows'] ?? [],
                    $fromDate,
                    $toDate,
                    $normalizeFilterValue((string) $request->query('request_status', ''))
                )->map(fn (array $row) => [
                    $row['from_date'] ?? '-',
                    $row['to_date'] ?? '-',
                    $row['request_status'] ?? '-',
                    $row['total_requests'] ?? 0,
                    $row['custom_demand'] ?? '-',
                    $row['quotation_acceptance'] ?? '0%',
                ])->all(),
                array_merge($reportMetaBase, ['section_label' => 'Custom Jewellery Reports'])
            ),
            'revenue' => adminReportDownloadResponse(
                'revenue-analytics',
                $format,
                'Revenue Analytics',
                ['From Date', 'To Date', 'Revenue Type', 'Top Selling Gem', 'Popular Category', 'Trend Insight'],
                $filterRows(
                    $reportData['revenueReportRows'] ?? [],
                    $fromDate,
                    $toDate,
                    $normalizeFilterValue((string) $request->query('revenue_type', ''))
                )->map(fn (array $row) => [
                    $row['from_date'] ?? '-',
                    $row['to_date'] ?? '-',
                    $row['revenue_type'] ?? '-',
                    $row['top_selling_gem'] ?? '-',
                    $row['popular_category'] ?? '-',
                    $row['trend_insight'] ?? '-',
                ])->all(),
                array_merge($reportMetaBase, ['section_label' => 'Revenue Analytics'])
            ),
            default => abort(404),
        };
    })->name('admin.reports.export');

    Route::post('/admin/contact-messages/{contactMessage}/reply', [AdminContactMessageController::class, 'reply'])->name('admin.contact-messages.reply');
    Route::post('/admin/contact-messages/{contactMessage}/read', [AdminContactMessageController::class, 'markRead'])->name('admin.contact-messages.read');
    Route::delete('/admin/contact-messages/{contactMessage}', [AdminContactMessageController::class, 'destroy'])->name('admin.contact-messages.destroy');

    Route::post('/admin/notifications/manage', function (Request $request) {
        abort_unless(Auth::check() && Auth::user()->hasAdminPermission('manage_notifications'), 403);

        $validated = $request->validate([
            'action' => ['required', Rule::in(['create'])],
            'recipient_role' => ['required', Rule::in(['consultant', 'customer'])],
            'recipient_user_id' => ['nullable', 'integer', 'exists:users,id'],
            'category' => ['required', Rule::in(['General', 'Orders', 'Promotions', 'Support', 'Account', 'Product Updates'])],
            'notification_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:5120'],
            'title' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
            'action_label' => ['nullable', 'string', 'max:80'],
            'action_url' => ['nullable', 'string', 'max:255'],
        ]);

        $recipientUserId = !empty($validated['recipient_user_id']) ? (int) $validated['recipient_user_id'] : null;
        $recipientRole = $validated['recipient_role'];

        if ($recipientUserId) {
            $recipientUser = User::query()->findOrFail($recipientUserId);
            if ($recipientUser->role !== $recipientRole) {
                throw ValidationException::withMessages([
                    'recipient_user_id' => ['Selected user does not match the chosen recipient role.'],
                ]);
            }
        }

        $imagePath = null;
        if ($request->hasFile('notification_image')) {
            $directory = public_path('images/Notifications');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0755, true);
            }

            $file = $request->file('notification_image');
            $filename = Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();
            $file->move($directory, $filename);
            $imagePath = 'images/Notifications/' . $filename;
        }

        $notificationData = [
            'recipient_role' => $recipientRole,
            'category' => trim((string) $validated['category']),
            'image_path' => $imagePath,
            'title' => trim((string) $validated['title']),
            'message' => trim((string) $validated['message']),
            'status' => 'Unread',
            'action_label' => trim((string) ($validated['action_label'] ?? '')) ?: null,
            'action_url' => trim((string) ($validated['action_url'] ?? '')) ?: null,
            'published_at' => now(),
        ];

        $notificationTitle = $notificationData['title'];
        $recipientCount = 0;

        DB::transaction(function () use ($recipientUserId, $recipientRole, $notificationData, &$recipientCount) {
            if ($recipientUserId) {
                SiteNotification::create($notificationData + [
                    'recipient_user_id' => $recipientUserId,
                ]);
                $recipientCount = 1;
                return;
            }

            $recipientUsers = User::query()
                ->where('role', $recipientRole)
                ->orderBy('first_name')
                ->orderBy('last_name')
                ->get();

            if ($recipientUsers->isEmpty()) {
                throw ValidationException::withMessages([
                    'recipient_role' => ['No users were found for the selected role.'],
                ]);
            }

            $recipientUsers->each(function (User $user) use ($notificationData) {
                SiteNotification::create($notificationData + [
                    'recipient_user_id' => $user->id,
                ]);
            });

            $recipientCount = $recipientUsers->count();
        });

        recordAdminActivity(
            Auth::user(),
            $request,
            'Created',
            'Notifications',
            'Created notification: ' . $notificationTitle,
            'Notification',
            null
        );

        return back()->with('notification_success', $recipientCount > 1
            ? 'Notification sent to ' . $recipientCount . ' users successfully.'
            : 'Notification sent successfully.');
    })->name('admin.notifications.store');

    Route::delete('/admin/notifications/{notification}', function (Request $request, SiteNotification $notification) {
        abort_unless(Auth::check() && Auth::user()->hasAdminPermission('manage_notifications'), 403);
        $title = $notification->title;

        if ($notification->image_path) {
            $imageFile = public_path($notification->image_path);
            if (File::exists($imageFile)) {
                File::delete($imageFile);
            }
        }

        $notification->delete();

        recordAdminActivity(
            Auth::user(),
            $request,
            'Deleted',
            'Notifications',
            'Deleted notification: ' . $title,
            'Notification',
            $notification->id
        );

        return back()->with('notification_success', 'Notification deleted successfully.');
    })->name('admin.notifications.delete');

    Route::post('/admin/orders/manage', function (Request $request) {
        abort_unless(Auth::check() && Auth::user()->hasAdminPermission('manage_orders'), 403);

        $validated = $request->validate([
            'action' => ['required', Rule::in(['update-status', 'cancel'])],
            'order_db_id' => ['required', 'integer', 'exists:orders,id'],
            'status' => ['nullable', 'string', 'max:100'],
            'note' => ['nullable', 'string', 'max:1000'],
        ]);

        $normalizeStatus = function (?string $status): string {
            $lower = Str::lower(trim((string) $status));
            return match ($lower) {
                'pending' => 'Pending',
                'processing' => 'Processing',
                'out for delivery' => 'Out for Delivery',
                'ready for pickup', 'ready to pickup', 'pickup' => 'Ready For Pickup',
                'pickup completed' => 'Pickup Completed',
                'completed' => 'Completed',
                'cancelled' => 'Cancelled',
                'out for pickup' => 'Out for Pickup',
                'verified' => 'Verified',
                'verification pending' => 'Verification Pending',
                default => Str::title($status ?: 'Pending'),
            };
        };

        $order = Order::query()->findOrFail($validated['order_db_id']);
        $previousStatus = (string) ($order->status ?: 'Pending');
        $nextStatus = $validated['action'] === 'cancel'
            ? 'Cancelled'
            : $normalizeStatus($validated['status'] ?? $previousStatus);
        $adminNote = trim((string) ($validated['note'] ?? ''));

        DB::transaction(function () use ($order, $nextStatus, $adminNote) {
            $nextLower = Str::lower($nextStatus);
            $isPickupStatus = Str::contains($nextLower, 'pickup');
            $isPickupFinalized = (bool) $order->pickup_only && in_array($nextLower, ['completed', 'pickup completed'], true);

            if ($isPickupStatus || $isPickupFinalized) {
                $subtotal = (float) $order->subtotal;
                $depositAmount = (float) ($order->deposit_amount ?: round($subtotal * 0.2, 2));

                $order->pickup_only = true;
                $order->shipping_method = 'pickup';
                $order->shipping_cost = 0;
                if ($isPickupFinalized) {
                    $order->deposit_amount = (float) ($order->total ?? $subtotal);
                    $order->balance_due = 0;
                } else {
                    $order->deposit_amount = $depositAmount;
                    $order->balance_due = max($subtotal - $depositAmount, 0);
                }
            }

            if ($nextLower === 'out for delivery' && empty($order->shipping_method)) {
                $order->shipping_method = 'express';
            }

            if ($adminNote !== '') {
                $existingNotes = trim((string) $order->notes);
                $adminEntry = '[' . now()->format('Y-m-d H:i') . '] Admin note: ' . $adminNote;
                $order->notes = $existingNotes === '' ? $adminEntry : ($existingNotes . "\n" . $adminEntry);
            }

            $order->status = $nextStatus;
            $order->save();

            if (!empty($order->user_id)) {
                $messageParts = [
                    'Your order ' . $order->order_number . ' status has been updated to ' . $nextStatus . '.',
                ];

                if ($adminNote !== '') {
                    $messageParts[] = 'Admin note: ' . $adminNote;
                }

                SiteNotification::create([
                    'recipient_user_id' => $order->user_id,
                    'recipient_role' => 'customer',
                    'category' => 'Orders',
                    'title' => 'Order ' . $order->order_number . ' ' . $nextStatus,
                    'message' => implode(' ', $messageParts),
                    'status' => 'Unread',
                    'published_at' => now(),
                ]);
            }
        });

        recordAdminActivity(
            Auth::user(),
            $request,
            'Updated',
            'Orders',
            'Updated order ' . $order->order_number . ' status from ' . $previousStatus . ' to ' . $nextStatus,
            'Order',
            $order->id
        );

        return response()->json([
            'message' => 'Order status updated successfully.',
            'order' => [
                'db_id' => $order->id,
                'order_number' => $order->order_number,
                'status' => $nextStatus,
                'shipping_method' => $order->shipping_method,
                'pickup_only' => (bool) $order->pickup_only,
                'pickup_config' => (bool) $order->pickup_only ? 'Pickup Only (Auto)' : ((string) $order->shipping_method === 'pickup' ? 'Store Pickup' : 'Standard Delivery'),
                'deposit_amount' => (float) ($order->pickup_only && in_array(Str::lower((string) $order->status), ['completed', 'pickup completed'], true) ? ($order->total ?? $order->deposit_amount) : $order->deposit_amount),
                'balance_due' => (float) ($order->pickup_only && in_array(Str::lower((string) $order->status), ['completed', 'pickup completed'], true) ? 0 : $order->balance_due),
            ],
        ]);
    })->name('admin.orders.manage');

    Route::post('/admin/returns/manage', function (Request $request) {
        abort_unless(Auth::check() && Auth::user()->hasAdminPermission('manage_orders'), 403);

        $validated = $request->validate([
            'action' => ['required', Rule::in(['approve', 'reject', 'refund'])],
            'return_db_id' => ['required', 'integer', 'exists:order_returns,id'],
            'note' => ['nullable', 'string', 'max:1000'],
        ]);

        $returnRequest = OrderReturn::query()->with(['order', 'user'])->findOrFail($validated['return_db_id']);
        $order = $returnRequest->order;
        $previousDecision = (string) ($returnRequest->decision ?: 'Pending Review');
        $previousRefundStatus = (string) ($returnRequest->refund_status ?: 'In Progress');
        $adminNote = trim((string) ($validated['note'] ?? ''));

        DB::transaction(function () use ($returnRequest, $order, $validated, $adminNote) {
            $returnRequest->reviewed_by_user_id = Auth::id();
            $returnRequest->reviewed_at = now();

            if ($adminNote !== '') {
                $existing = trim((string) $returnRequest->admin_note);
                $returnRequest->admin_note = $existing === '' ? $adminNote : ($existing . "\n" . $adminNote);

                if ($order) {
                    $existingOrderNote = trim((string) $order->notes);
                    $noteEntry = '[' . now()->format('Y-m-d H:i') . '] Return note: ' . $adminNote;
                    $order->notes = $existingOrderNote === '' ? $noteEntry : ($existingOrderNote . "\n" . $noteEntry);
                }
            }

            if ($validated['action'] === 'approve') {
                $returnRequest->decision = 'Approved';
                $returnRequest->refund_status = 'In Progress';
            } elseif ($validated['action'] === 'reject') {
                $returnRequest->decision = 'Rejected';
                $returnRequest->refund_status = 'In Progress';
            } else {
                $returnRequest->decision = 'Approved';
                $returnRequest->refund_status = 'Refunded';
                $returnRequest->refunded_at = now();
                $returnRequest->refund_amount = (float) ($returnRequest->refund_amount ?: $order?->total ?: 0);

                if ($order) {
                    $order->status = 'Refunded';
                    $order->save();
                }
            }

            if ($order && $validated['action'] !== 'refund') {
                $order->save();
            }

            $returnRequest->save();
        });

        $customerMessage = match ($validated['action']) {
            'approve' => 'Your refund request for order ' . ($order?->order_number ?: '-') . ' has been approved and is now in progress.',
            'reject' => 'Your refund request for order ' . ($order?->order_number ?: '-') . ' has been rejected.',
            default => 'Your refund request for order ' . ($order?->order_number ?: '-') . ' has been marked as refunded.',
        };

        if ($returnRequest->user_id) {
            SiteNotification::create([
                'recipient_user_id' => $returnRequest->user_id,
                'recipient_role' => 'customer',
                'category' => 'Orders',
                'title' => 'Return ' . $returnRequest->request_number . ' ' . Str::title($returnRequest->decision),
                'message' => $customerMessage . ($adminNote !== '' ? ' Admin note: ' . $adminNote : ''),
                'status' => 'Unread',
                'published_at' => now(),
            ]);
        }

        recordAdminActivity(
            Auth::user(),
            $request,
            'Updated',
            'Returns',
            'Updated return ' . $returnRequest->request_number . ' decision from ' . $previousDecision . ' to ' . $returnRequest->decision . ' and refund from ' . $previousRefundStatus . ' to ' . $returnRequest->refund_status,
            'Return Request',
            $returnRequest->id
        );

        return response()->json([
            'message' => 'Return request updated successfully.',
            'return_request' => [
                'db_id' => $returnRequest->id,
                'request_id' => $returnRequest->request_number,
                'order_id' => $order?->order_number,
                'customer_name' => trim((string) (($returnRequest->user?->first_name ?? '') . ' ' . ($returnRequest->user?->last_name ?? ''))) ?: 'Customer',
                'reason' => $returnRequest->reason,
                'requested_date' => $returnRequest->created_at?->toDateString() ?: '-',
                'decision' => $returnRequest->decision,
                'decision_class' => $returnRequest->decision_class,
                'refund_status' => $returnRequest->refund_status,
                'refund_status_class' => $returnRequest->refund_status_class,
                'refund_amount' => $returnRequest->refund_amount !== null ? 'Rs ' . number_format((float) $returnRequest->refund_amount, 0) : '-',
                'admin_note' => $returnRequest->admin_note ?: '-',
                'order_status' => $order?->status ?: 'Completed',
            ],
        ]);
    })->name('admin.returns.manage');

    Route::get('/admin/users/export/{section}', function (Request $request, string $section) {
        abort_unless(Auth::check() && Auth::user()->canAccessAdminDashboard(), 403);

        $dashboardData = adminDashboardUserManagementData($request);
        $section = strtolower($section);

        return match ($section) {
            'customers' => streamCsvDownload(
                'customer-users-' . now()->format('Y-m-d-His') . '.csv',
                ['Customer ID', 'Name', 'Email', 'Phone', 'Joined On', 'Status'],
                $dashboardData['customerUsers']->map(fn (array $user) => [
                    $user['user_id'],
                    $user['name'],
                    $user['email'],
                    $user['phone'],
                    $user['registration_date'],
                    $user['status'],
                ])
            ),
            'consultants' => streamCsvDownload(
                'consultant-users-' . now()->format('Y-m-d-His') . '.csv',
                ['Consultant ID', 'Name', 'Email', 'Phone', 'Consultations', 'Status'],
                $dashboardData['consultantUsers']->map(fn (array $user) => [
                    $user['consultant_id'],
                    $user['name'],
                    $user['email'],
                    $user['phone'],
                    $user['assigned_customers'],
                    $user['status'],
                ])
            ),
            'admins' => streamCsvDownload(
                'admin-users-' . now()->format('Y-m-d-His') . '.csv',
                ['Admin ID', 'Name', 'Email', 'Role', 'Updated On', 'Status', 'Permissions'],
                $dashboardData['adminUsers']->map(fn (array $user) => [
                    $user['admin_id'],
                    $user['name'],
                    $user['email'],
                    $user['role_label'],
                    $user['updated_on'],
                    $user['status'],
                    $user['permissions_label'],
                ])
            ),
            'roles' => streamCsvDownload(
                'role-rows-' . now()->format('Y-m-d-His') . '.csv',
                ['Role', 'Description', 'Permission Matrix', 'Users'],
                $dashboardData['roleRows']->map(fn (array $roleRow) => [
                    Str::title(str_replace('_', ' ', $roleRow['role'])),
                    $roleRow['description'],
                    implode(', ', $roleRow['permissions']),
                    $roleRow['user_count'],
                ])
            ),
            'logs' => streamCsvDownload(
                'admin-activity-logs-' . now()->format('Y-m-d-His') . '.csv',
                ['Log ID', 'User Name', 'Role', 'Action', 'Module', 'Date & Time', 'IP / Device', 'Status'],
                $dashboardData['adminActivityLogs']->map(fn (array $log) => [
                    $log['log_id'],
                    $log['user_name'],
                    $log['role'],
                    $log['action'],
                    $log['module'],
                    $log['date_time'],
                    $log['ip_device'],
                    $log['status_label'],
                ])
            ),
            default => abort(404),
        };
    })->name('admin.users.export');

    Route::post('/admin/products/manage', function (Request $request) {
        if (!Auth::check() || !Auth::user()->hasAdminPermission('manage_products')) {
            return response()->json([
                'message' => 'You do not have permission to manage products.',
            ], 403);
        }

        try {
            $validated = $request->validate([
            'action' => ['required', Rule::in(['create', 'update', 'delete'])],
            'product_id' => ['nullable', 'integer', 'exists:products,product_id'],
            'name' => ['nullable', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'gem_type' => ['nullable', 'string', 'max:255'],
            'jewellery_type' => ['nullable', 'string', 'max:255'],
            'occasion' => ['nullable', 'string', 'max:255'],
            'gender' => ['nullable', 'string', 'max:255'],
            'gemstone' => ['nullable', 'string', 'max:255'],
            'color' => ['nullable', 'string', 'max:255'],
            'shape' => ['nullable', 'string', 'max:255'],
            'carat_weight' => ['nullable', 'numeric', 'min:0'],
            'metal' => ['nullable', 'string', 'max:255'],
            'metal_purity' => ['nullable', 'string', 'max:50'],
            'metal_weight' => ['nullable', 'numeric', 'min:0'],
            'making_charge' => ['nullable', 'numeric', 'min:0'],
            'wastage' => ['nullable', 'numeric', 'min:0'],
            'market_factor' => ['nullable', 'numeric', 'min:0'],
            'pricing_mode' => ['nullable', 'in:dynamic,static'],
            'size_label' => ['nullable', 'string', 'max:100'],
            'size_options' => ['nullable', 'string', 'max:1000'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'stock' => ['nullable', 'integer', 'min:0'],
            'description' => ['nullable', 'string', 'max:2000'],
            'main_image' => ['nullable', 'image', 'max:5120'],
            'preview_360_images' => ['nullable', 'array', 'size:8'],
            'preview_360_images.*' => ['image', 'max:5120'],
            ]);

        $action = $validated['action'];
        if ($action === 'delete') {
            if (empty($validated['product_id'])) {
                return response()->json(['message' => 'Product ID is required.'], 422);
            }
        } else {
            if (trim((string) ($validated['name'] ?? '')) === '') {
                return response()->json(['message' => 'Product name is required.'], 422);
            }
            if (trim((string) ($validated['category'] ?? '')) === '') {
                return response()->json(['message' => 'Category is required.'], 422);
            }
            if ($validated['price'] === null || $validated['price'] === '') {
                return response()->json(['message' => 'Fallback price is required.'], 422);
            }
            if ($validated['stock'] === null || $validated['stock'] === '') {
                return response()->json(['message' => 'Stock is required.'], 422);
            }
        }

        $categoryName = trim((string) ($validated['category'] ?? ''));
        $categorySlug = Str::lower($categoryName);
        $pricingMode = $validated['pricing_mode'] ?? 'dynamic';
        $sizeLabel = trim((string) ($validated['size_label'] ?? ''));
        $sizeOptions = trim((string) ($validated['size_options'] ?? ''));
        $directory = public_path('images/Product');

        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $gemTypeName = trim((string) ($validated['gem_type'] ?? ''));
        $jewelleryTypeName = trim((string) ($validated['jewellery_type'] ?? ''));
        $jewelleryGender = normalizeJewelleryGender($validated['gender'] ?? null);

        if ($categorySlug !== 'jewellery' && $request->hasFile('preview_360_images')) {
            return response()->json([
                'message' => '360 preview images are only allowed for jewellery products.',
            ], 422);
        }

        if ($action !== 'delete') {
            if ($categorySlug === 'gems' && $gemTypeName === '') {
                return response()->json(['message' => 'Gem Type is required for gem products.'], 422);
            }

            if ($categorySlug === 'jewellery' && $jewelleryTypeName === '') {
                return response()->json(['message' => 'Jewellery Type is required for jewellery products.'], 422);
            }
        }

        $resolvedJewelleryType = null;
        if ($categorySlug === 'jewellery' && $jewelleryTypeName !== '') {
            $resolvedJewelleryType = JewelleryType::query()
                ->whereRaw('LOWER(name) = ?', [Str::lower($jewelleryTypeName)])
                ->first();

            if (! $resolvedJewelleryType) {
                return response()->json(['message' => 'Selected jewellery type does not exist.'], 422);
            }
        }

        if ($action === 'delete') {
            $product = Product::query()->with(productBaseRelations())->findOrFail($validated['product_id']);
            $deletedProductName = $product->name;
            $deletedProductId = $product->product_id;

            DB::transaction(function () use ($product, $directory) {
                $preview = getProduct360PreviewIfAvailable($product);
                DB::table('astrology')->where('product_id', $product->product_id)->delete();
                DB::table('product_birthstones')->where('product_id', $product->product_id)->delete();
                DB::table('product_reviews')->where('product_id', $product->product_id)->delete();
                Gem::query()->where('product_id', $product->product_id)->delete();
                Jewellery::query()->where('product_id', $product->product_id)->delete();
                ProductCollection::query()->where('product_id', $product->product_id)->delete();
                deleteProduct360PreviewFiles($preview);
                if ($preview) {
                    $preview->delete();
                }

                if (!empty($product->image)) {
                    $imagePath = $directory . DIRECTORY_SEPARATOR . $product->image;
                    if (File::exists($imagePath)) {
                        File::delete($imagePath);
                    }
                }

                $product->delete();
            });

            recordAdminActivity(Auth::user(), $request, 'Deleted', 'Products', 'Deleted product: ' . $deletedProductName, 'Product', $deletedProductId);

            return response()->json([
                'message' => 'Product deleted successfully.',
            ]);
        }

        if ($action === 'update') {
            $category = Category::firstOrCreate(['name' => Str::title($categoryName)]);
            $product = Product::query()->with(productBaseRelations())->findOrFail($validated['product_id']);
            $normalizedCategory = Str::lower($category->name);
            $isGemProduct = $normalizedCategory === 'gems';
            $isCollectionProduct = $normalizedCategory === 'collections';
            $isJewelleryProduct = $normalizedCategory === 'jewellery';
            $oldImageName = $product->image;
            $newImageName = null;
            if ($request->hasFile('main_image')) {
                $file = $request->file('main_image');
                $newImageName = (string) Str::uuid() . '.' . $file->getClientOriginalExtension();
                $file->move($directory, $newImageName);
            }

            $storedPreview360 = null;

            $updateJewelleryGender = normalizeJewelleryGender($validated['gender'] ?? null);

            DB::transaction(function () use ($product, $validated, $category, $categoryName, $pricingMode, $gemTypeName, $jewelleryTypeName, $isGemProduct, $isCollectionProduct, $isJewelleryProduct, $newImageName, $request, &$storedPreview360, $updateJewelleryGender, $resolvedJewelleryType, $sizeLabel, $sizeOptions) {
                $product->category_id = $category->category_id;
                $product->name = Str::title(trim((string) $validated['name']));
                $product->description = trim((string) ($validated['description'] ?? ''));
                $product->price = (float) $validated['price'];
                $product->stock = (int) $validated['stock'];
                $product->size_label = $isJewelleryProduct && $sizeLabel !== '' ? $sizeLabel : null;
                $product->size_options = $isJewelleryProduct && $sizeOptions !== '' ? $sizeOptions : null;
                if ($newImageName !== null) {
                    $product->image = $newImageName;
                }
                $product->save();

                if ($isGemProduct) {
                    Jewellery::query()->where('product_id', $product->product_id)->delete();
                    ProductCollection::query()->where('product_id', $product->product_id)->delete();

                    $gemTypeId = $gemTypeName !== ''
                        ? GemType::query()->whereRaw('LOWER(name) = ?', [Str::lower($gemTypeName)])->value('gem_type_id')
                        : null;

                    Gem::query()->updateOrCreate(
                        ['product_id' => $product->product_id],
                        [
                            'category_id' => $category->category_id,
                            'gem_type_id' => $gemTypeId,
                            'color' => $validated['color'] ?? null,
                            'shape' => $validated['shape'] ?? null,
                            'carat_weight' => $validated['carat_weight'] ?? null,
                        ]
                    );
                } elseif ($isCollectionProduct) {
                    Gem::query()->where('product_id', $product->product_id)->delete();
                    Jewellery::query()->where('product_id', $product->product_id)->delete();

                    ProductCollection::query()->updateOrCreate(
                        ['product_id' => $product->product_id],
                        [
                            'occasion' => $validated['occasion'] ?? null,
                            'gender' => $validated['gender'] ?? null,
                            'gemstone' => $validated['gemstone'] ?? null,
                            'metal' => $validated['metal'] ?? null,
                        ]
                    );
                } else {
                    Gem::query()->where('product_id', $product->product_id)->delete();
                    ProductCollection::query()->where('product_id', $product->product_id)->delete();

                    Jewellery::query()->updateOrCreate(
                        ['product_id' => $product->product_id],
                        [
                            'category_id' => $category->category_id,
                            'type_id' => $resolvedJewelleryType?->type_id,
                            'occasion' => $validated['occasion'] ?? null,
                            'gender' => $updateJewelleryGender,
                            'metal' => $validated['metal'] ?? null,
                            'metal_purity' => $validated['metal_purity'] ?? null,
                            'gemstone' => $validated['gemstone'] ?? ($gemTypeName !== '' ? $gemTypeName : null),
                            'metal_weight' => (float) ($validated['metal_weight'] ?? 0),
                            'making_charge' => (float) ($validated['making_charge'] ?? 0),
                            'wastage_percent' => (float) ($validated['wastage'] ?? 0),
                            'market_factor' => (float) ($validated['market_factor'] ?? 0.800),
                            'pricing_mode' => $pricingMode ?: 'dynamic',
                        ]
                    );
                }

                $storedPreview360 = tryStoreProduct360PreviewFiles($product, $request, getProduct360PreviewIfAvailable($product));
            });

            if ($newImageName !== null && !empty($oldImageName) && $oldImageName !== $newImageName) {
                $oldImagePath = $directory . DIRECTORY_SEPARATOR . $oldImageName;
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $product->load(productBaseRelations());
            recordAdminActivity(Auth::user(), $request, 'Updated', 'Products', 'Updated product: ' . $product->name, 'Product', $product->product_id);

            return response()->json([
                'message' => 'Product updated successfully.',
                'product' => formatAdminProductRow($product),
            ]);
        }

        $category = Category::firstOrCreate(['name' => Str::title($categoryName)]);
        $productName = Str::title(trim((string) $validated['name']));
        $normalizedProductName = Str::lower($productName);
        $categoryLower = Str::lower($category->name);
        $isJewelleryProduct = $categoryLower === 'jewellery';
        $gemTypeId = $categoryLower === 'gems' && $gemTypeName !== ''
            ? GemType::query()->whereRaw('LOWER(name) = ?', [Str::lower($gemTypeName)])->value('gem_type_id')
            : null;

        $sameText = static function ($left, $right): bool {
            return Str::lower(trim((string) $left)) === Str::lower(trim((string) $right));
        };

        $sameNullableText = static function ($left, $right): bool {
            $leftValue = trim((string) $left);
            $rightValue = trim((string) $right);

            if ($leftValue === '' && $rightValue === '') {
                return true;
            }

            return Str::lower($leftValue) === Str::lower($rightValue);
        };

        $existingProduct = Product::query()
            ->with(['category', 'jewellery.type', 'gem.gemType', 'collection'])
            ->where('category_id', $category->category_id)
            ->whereRaw('LOWER(name) = ?', [$normalizedProductName])
            ->get()
            ->first(function (Product $candidate) use ($categoryLower, $sameText, $sameNullableText, $gemTypeId, $resolvedJewelleryType, $validated, $jewelleryGender, $gemTypeName): bool {
                if ($categoryLower === 'gems') {
                    return (int) ($candidate->gem?->gem_type_id ?? 0) === (int) ($gemTypeId ?? 0)
                        && $sameNullableText($candidate->gem?->color, $validated['color'] ?? null)
                        && $sameNullableText($candidate->gem?->shape, $validated['shape'] ?? null)
                        && $sameText($candidate->gem?->carat_weight, $validated['carat_weight'] ?? null);
                }

                if ($categoryLower === 'collections') {
                    return $sameNullableText($candidate->collection?->occasion, $validated['occasion'] ?? null)
                        && $sameNullableText($candidate->collection?->gender, $validated['gender'] ?? null)
                        && $sameNullableText($candidate->collection?->gemstone, $validated['gemstone'] ?? null)
                        && $sameNullableText($candidate->collection?->metal, $validated['metal'] ?? null);
                }

                $candidateGender = normalizeJewelleryGender($candidate->jewellery?->gender ?? null);
                return (int) ($candidate->jewellery?->type_id ?? 0) === (int) ($resolvedJewelleryType?->type_id ?? 0)
                    && $sameNullableText($candidate->jewellery?->occasion, $validated['occasion'] ?? null)
                    && $sameNullableText($candidateGender, $jewelleryGender)
                    && $sameNullableText($candidate->jewellery?->metal, $validated['metal'] ?? null)
                    && $sameNullableText($candidate->jewellery?->metal_purity, $validated['metal_purity'] ?? null)
                    && $sameNullableText($candidate->jewellery?->gemstone, $validated['gemstone'] ?? ($gemTypeName !== '' ? $gemTypeName : null));
            });

        if ($existingProduct) {
            DB::transaction(function () use ($existingProduct, $validated, $request, $isJewelleryProduct, $sizeLabel, $sizeOptions) {
                $existingProduct->stock = (int) ($existingProduct->stock ?? 0) + (int) $validated['stock'];

                if ($validated['price'] !== null && $validated['price'] !== '') {
                    $existingProduct->price = (float) $validated['price'];
                }

                if (trim((string) ($validated['description'] ?? '')) !== '') {
                    $existingProduct->description = trim((string) $validated['description']);
                }

                $existingProduct->size_label = $isJewelleryProduct && $sizeLabel !== '' ? $sizeLabel : null;
                $existingProduct->size_options = $isJewelleryProduct && $sizeOptions !== '' ? $sizeOptions : null;

                $existingProduct->save();
                tryStoreProduct360PreviewFiles($existingProduct, $request, getProduct360PreviewIfAvailable($existingProduct));
            });

            $existingProduct->load(productBaseRelations());

            recordAdminActivity(
                Auth::user(),
                $request,
                'Updated',
                'Products',
                'Merged duplicate product into existing stock: ' . $existingProduct->name,
                'Product',
                $existingProduct->product_id
            );

            return response()->json([
                'message' => 'Product already exists. Stock updated successfully.',
                'product' => formatAdminProductRow($existingProduct),
            ]);
        }

        $imageName = '';
        $product = null;

        DB::transaction(function () use (
            $request,
            $directory,
            $category,
            $categoryLower,
            $isJewelleryProduct,
            $productName,
            $validated,
            $gemTypeId,
            $resolvedJewelleryType,
            $gemTypeName,
            $jewelleryGender,
            $pricingMode,
            $sizeLabel,
            $sizeOptions,
            &$imageName,
            &$product
        ) {
            if ($request->hasFile('main_image')) {
                $file = $request->file('main_image');
                $imageName = (string) Str::uuid() . '.' . $file->getClientOriginalExtension();
                $file->move($directory, $imageName);
            }

            $product = Product::create([
                'category_id' => $category->category_id,
                'name' => $productName,
                'description' => trim((string) ($validated['description'] ?? '')),
                'image' => $imageName,
                'price' => (float) $validated['price'],
                'stock' => (int) $validated['stock'],
                'size_label' => $isJewelleryProduct && $sizeLabel !== '' ? $sizeLabel : null,
                'size_options' => $isJewelleryProduct && $sizeOptions !== '' ? $sizeOptions : null,
            ]);

            if ($categoryLower === 'gems') {
                Gem::create([
                    'product_id' => $product->product_id,
                    'category_id' => $category->category_id,
                    'gem_type_id' => $gemTypeId,
                    'color' => $validated['color'] ?? null,
                    'shape' => $validated['shape'] ?? null,
                    'carat_weight' => $validated['carat_weight'] ?? null,
                ]);
            } elseif ($categoryLower === 'collections') {
                ProductCollection::create([
                    'product_id' => $product->product_id,
                    'occasion' => $validated['occasion'] ?? null,
                    'gender' => $validated['gender'] ?? null,
                    'gemstone' => $validated['gemstone'] ?? null,
                    'metal' => $validated['metal'] ?? null,
                ]);
            } else {
                Jewellery::create([
                    'product_id' => $product->product_id,
                    'category_id' => $category->category_id,
                    'type_id' => $resolvedJewelleryType->type_id,
                    'occasion' => $validated['occasion'] ?? null,
                    'gender' => $jewelleryGender,
                    'metal' => $validated['metal'] ?? null,
                    'metal_purity' => $validated['metal_purity'] ?? null,
                    'gemstone' => $validated['gemstone'] ?? ($gemTypeName !== '' ? $gemTypeName : null),
                    'metal_weight' => (float) ($validated['metal_weight'] ?? 0),
                    'making_charge' => (float) ($validated['making_charge'] ?? 0),
                    'wastage_percent' => (float) ($validated['wastage'] ?? 0),
                    'market_factor' => (float) ($validated['market_factor'] ?? 0.800),
                    'pricing_mode' => $pricingMode ?: 'dynamic',
                ]);
            }

            tryStoreProduct360PreviewFiles($product, $request);
        });

        if (!$product instanceof Product) {
            throw new RuntimeException('Product creation failed.');
        }

        $product->load(productBaseRelations());
        recordAdminActivity(Auth::user(), $request, 'Created', 'Products', 'Created product: ' . $product->name, 'Product', $product->product_id);

            return response()->json([
                'message' => 'Product created successfully.',
                'product' => formatAdminProductRow($product),
            ]);
        } catch (ValidationException $e) {
            throw $e;
        } catch (Throwable $e) {
            report($e);

            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    })->name('admin.products.manage');

    Route::get('/admin/products/{product}', function (Product $product) {
        abort_unless(Auth::check() && Auth::user()->canAccessAdminDashboard(), 403);

        $product->load(productBaseRelations());

        return response()->json([
            'product' => formatAdminProductRow($product),
        ]);
    })->whereNumber('product')->name('admin.products.show');

    Route::post('/admin/product-reviews/manage', function (Request $request) {
        abort_unless(Auth::check() && Auth::user()->hasAdminPermission('manage_products'), 403);

        $validated = $request->validate([
            'action' => ['required', Rule::in(['delete'])],
            'review_id' => ['required', 'integer', 'exists:product_reviews,id'],
        ]);

        $review = ProductReview::query()->with('product')->findOrFail($validated['review_id']);

        $productName = $review->product?->name ?: 'Product';
        $reviewId = $review->id;
        $review->delete();

        recordAdminActivity(Auth::user(), $request, 'Deleted', 'Product Reviews', 'Deleted review for product: ' . $productName, 'Review', $reviewId);

        return response()->json([
            'message' => 'Review deleted successfully.',
        ]);
    })->name('admin.product-reviews.manage');

    Route::post('/admin/stock/manage', function (Request $request) {
        abort_unless(Auth::check() && Auth::user()->hasAdminPermission('manage_products'), 403);

        $validated = $request->validate([
            'action' => ['required', Rule::in(['add', 'update'])],
            'product_id' => ['required', 'integer', 'exists:products,product_id'],
            'quantity' => ['required', 'integer', 'min:0'],
        ]);

        $product = Product::query()->with(['category', 'collection'])->findOrFail($validated['product_id']);
        $previousStock = (int) ($product->stock ?? 0);
        $quantity = (int) $validated['quantity'];
        $newStock = $validated['action'] === 'add' ? $previousStock + $quantity : $quantity;
        $product->stock = $newStock;
        $product->save();

        $actionLabel = $validated['action'] === 'add' ? 'Added stock' : 'Updated stock';
        recordAdminActivity(
            Auth::user(),
            $request,
            $validated['action'] === 'add' ? 'Added' : 'Updated',
            'Inventory',
            $actionLabel . ' for ' . $product->name . ' from ' . $previousStock . ' to ' . $newStock,
            'Stock',
            $product->product_id
        );

        $product->load(['category', 'jewellery.type', 'gem.gemType', 'collection']);

        return response()->json([
            'message' => 'Stock updated successfully.',
            'product' => formatAdminProductRow($product),
            'stock' => [
                'db_id' => $product->product_id,
                'item_id' => 'INV-' . str_pad((string) $product->product_id, 3, '0', STR_PAD_LEFT),
                'name' => $product->name,
                'category' => trim((string) ($product->category?->name ?? '')) ?: ($product->collection ? 'Collections' : ($product->gem ? 'Gems' : 'Products')),
                'stock' => $newStock,
                'status' => $newStock > 15 ? 'Healthy' : ($newStock === 0 ? 'Out of Stock' : ($newStock < 5 ? 'Critical' : 'Low')),
            ],
        ]);
    })->name('admin.stock.manage');

    Route::get('/admin/stock/export', function (Request $request) {
        abort_unless(Auth::check() && Auth::user()->hasAdminPermission('manage_products'), 403);

        $inventoryRows = Product::query()
            ->with(['category', 'jewellery.type', 'gem.gemType', 'collection'])
            ->orderBy('name')
            ->get()
            ->map(function (Product $product) {
                $stock = (int) ($product->stock ?? 0);
                $categoryName = trim((string) ($product->category?->name ?? ''));
                $resolvedCategory = $categoryName ?: ($product->collection ? 'Collections' : ($product->gem ? 'Gems' : 'Products'));
                $status = $stock > 15 ? 'Healthy' : ($stock === 0 ? 'Out of Stock' : ($stock < 5 ? 'Critical' : 'Low'));

                return [
                    'item_id' => 'INV-' . str_pad((string) $product->product_id, 3, '0', STR_PAD_LEFT),
                    'product_id' => 'PRD-' . str_pad((string) $product->product_id, 3, '0', STR_PAD_LEFT),
                    'name' => $product->name,
                    'category' => $resolvedCategory,
                    'stock' => $stock,
                    'status' => $status,
                ];
            });

        $headers = ['Item ID', 'Product ID', 'Product', 'Category', 'Current Qty', 'Status'];

        return response()->streamDownload(function () use ($inventoryRows, $headers) {
            $output = fopen('php://output', 'w');
            fputcsv($output, $headers);

            foreach ($inventoryRows as $row) {
                fputcsv($output, [
                    $row['item_id'],
                    $row['product_id'],
                    $row['name'],
                    $row['category'],
                    $row['stock'],
                    $row['status'],
                ]);
            }

            fclose($output);
        }, 'stock-inventory.csv', [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    })->name('admin.stock.export');

    Route::post('/admin/categories/manage', function (Request $request) {
        abort_unless(Auth::check() && Auth::user()->hasAdminPermission('manage_products'), 403);

        $validated = $request->validate([
            'action' => ['required', 'in:create,update,delete'],
            'type_id' => ['nullable', 'integer', 'exists:jewellerytype,type_id'],
            'name' => ['nullable', 'string', 'max:255'],
        ]);

        if ($validated['action'] === 'create') {
            $name = trim((string) ($validated['name'] ?? ''));
            if ($name === '') {
                return response()->json(['message' => 'Category name is required.'], 422);
            }

            $category = JewelleryType::firstOrCreate(['name' => Str::title($name)]);

            recordAdminActivity(Auth::user(), $request, 'Created', 'Jewellery Types', 'Created jewellery type: ' . $category->name, 'Category', $category->type_id);

            return response()->json([
                'message' => 'Jewellery type created successfully.',
                'category' => [
                    'type_id' => $category->type_id,
                    'name' => $category->name,
                ],
            ]);
        }

        if ($validated['action'] === 'update') {
            $category = JewelleryType::query()->findOrFail($validated['type_id']);
            $name = trim((string) ($validated['name'] ?? ''));
            if ($name === '') {
                return response()->json(['message' => 'Category name is required.'], 422);
            }

            $category->name = Str::title($name);
            $category->save();

            recordAdminActivity(Auth::user(), $request, 'Updated', 'Jewellery Types', 'Updated jewellery type: ' . $category->name, 'Category', $category->type_id);

            return response()->json([
                'message' => 'Jewellery type updated successfully.',
                'category' => [
                    'type_id' => $category->type_id,
                    'name' => $category->name,
                ],
            ]);
        }

        $category = JewelleryType::query()->withCount('jewellery')->findOrFail($validated['type_id']);
        if ((int) ($category->jewellery_count ?? 0) > 0) {
            return response()->json([
                'message' => 'Please reassign or remove products before deleting this category.',
            ], 422);
        }

        $categoryName = $category->name;
        $categoryId = $category->type_id;
        $category->delete();

        recordAdminActivity(Auth::user(), $request, 'Deleted', 'Jewellery Types', 'Deleted jewellery type: ' . $categoryName, 'Category', $categoryId);

        return response()->json([
            'message' => 'Jewellery type deleted successfully.',
        ]);
    })->name('admin.categories.manage');

    Route::get('/admin/products/export/all', function (Request $request) {
        abort_unless(Auth::check() && Auth::user()->canAccessAdminDashboard(), 403);

        $dashboardData = adminDashboardProductData($request);

        return streamCsvDownload(
            'all-products-' . now()->format('Y-m-d-His') . '.csv',
            ['Product ID', 'Name', 'Category', 'Price', 'Stock', 'Status', 'Gem Type', 'Metal', 'Metal Purity', 'Metal Weight', 'Making Charge', 'Wastage', 'Market Factor', 'Pricing Mode', 'Discount', 'Description', 'Main Image', 'High Value', 'Featured', 'Discounted', 'New Arrival'],
            $dashboardData['productRows']->map(fn (array $product) => [
                $product['product_id'],
                $product['name'],
                $product['category'],
                $product['price'],
                $product['stock'],
                $product['status'],
                $product['gem_type'],
                $product['metal'],
                $product['metal_purity'],
                $product['metal_weight'],
                $product['making_charge'],
                $product['wastage'],
                $product['market_factor'],
                $product['pricing_mode'],
                $product['discount'],
                $product['description'],
                $product['main_image'],
                $product['high_value'],
                $product['featured'],
                $product['discounted'],
                $product['new_arrival'],
            ])
        );
    })->name('admin.products.export.all');

    Route::get('/admin/content-posts', [ContentPostController::class, 'adminIndex'])->name('admin.content-posts');
    Route::post('/admin/content-posts', [ContentPostController::class, 'store'])->name('admin.content-posts.store');
    Route::post('/admin/content-posts/{contentPost}', [ContentPostController::class, 'update'])->name('admin.content-posts.update');
    Route::delete('/admin/content-posts/{contentPost}', [ContentPostController::class, 'destroy'])->name('admin.content-posts.destroy');
    Route::get('/admin/faq', [FaqEntryController::class, 'index'])->name('admin.faq-entries');
    Route::post('/admin/faq', [FaqEntryController::class, 'store'])->name('admin.faq-entries.store');
    Route::post('/admin/faq/{faqEntry}', [FaqEntryController::class, 'update'])->name('admin.faq-entries.update');
    Route::delete('/admin/faq/{faqEntry}', [FaqEntryController::class, 'destroy'])->name('admin.faq-entries.destroy');

    Route::post('/admin/users/manage', function (Request $request) {
        abort_unless(Auth::check() && Auth::user()->role === 'admin', 403);

        $validated = $request->validate([
            'action' => ['required', 'in:create,update,delete,block,role'],
            'user_id' => ['nullable', 'integer', 'exists:users,id'],
            'scope' => ['nullable', 'in:customer,consultant,admin'],
            'first_name' => ['nullable', 'string', 'max:100'],
            'last_name' => ['nullable', 'string', 'max:100'],
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'birth_date' => ['nullable', 'date'],
            'status' => ['nullable', 'in:Active,Inactive,Blocked'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'role' => ['nullable', 'in:admin,lower_admin,content_manager,consultant,customer'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['string'],
        ]);

        $allowedPermissions = [
            'manage_orders',
            'manage_products',
            'manage_inventory',
            'manage_custom_jewellery',
            'manage_consultations',
            'manage_contact_messages',
            'manage_content',
            'manage_reports',
            'manage_notifications',
            'manage_users',
        ];

        $defaultRolePermissions = function (string $role): array {
            $role = Str::lower(trim($role));

            if ($role === '' || $role === 'admin') {
                return [];
            }

            $fallback = match ($role) {
                'lower_admin' => [
                    'manage_orders',
                    'manage_products',
                    'manage_inventory',
                    'manage_custom_jewellery',
                    'manage_consultations',
                    'manage_contact_messages',
                ],
                'content_manager' => [
                    'manage_content',
                    'manage_reports',
                    'manage_notifications',
                ],
                default => [],
            };

            return $fallback;
        };

        $splitName = function (string $name): array {
            $parts = preg_split('/\s+/', trim($name), 2) ?: [];
            return [
                $parts[0] ?? 'User',
                $parts[1] ?? '',
            ];
        };

        $resolveNameParts = function (array $input, string $fallback = 'User') use ($splitName): array {
            $firstName = trim((string) ($input['first_name'] ?? ''));
            $lastName = trim((string) ($input['last_name'] ?? ''));

            if ($firstName !== '' || $lastName !== '') {
                return [
                    $firstName !== '' ? $firstName : $fallback,
                    $lastName,
                ];
            }

            $fullName = trim((string) ($input['name'] ?? ''));
            if ($fullName !== '') {
                return $splitName($fullName);
            }

            return [$fallback, ''];
        };

        $normalizeSizeOptions = function (?string $value): string {
            $parts = preg_split('/\s*,\s*/', trim((string) $value), -1, PREG_SPLIT_NO_EMPTY) ?: [];
            return implode(', ', collect($parts)->map(fn ($part) => trim((string) $part))->filter()->values()->all());
        };

        $normalizeStatus = function (?string $status): string {
            return in_array($status, ['Active', 'Inactive', 'Blocked'], true) ? $status : 'Active';
        };

        if ($validated['action'] === 'delete') {
            $user = User::query()->findOrFail($validated['user_id']);
            $deletedName = trim((($user->first_name ?? '') . ' ' . ($user->last_name ?? ''))) ?: 'User';
            $deletedModule = Str::title(str_replace('_', ' ', $user->role)) . 's';
            $user->delete();
            recordAdminActivity(Auth::user(), $request, 'Deleted', $deletedModule, 'Deleted ' . Str::title(str_replace('_', ' ', $user->role)) . ': ' . $deletedName, 'User', $user->id);

            return response()->json(['message' => 'User deleted successfully.']);
        }

        if ($validated['action'] === 'block') {
            $user = User::query()->findOrFail($validated['user_id']);
            $nextStatus = $user->account_status === 'Blocked' ? 'Active' : 'Blocked';
            $subjectName = trim((($user->first_name ?? '') . ' ' . ($user->last_name ?? ''))) ?: 'User';
            $user->account_status = $user->account_status === 'Blocked' ? 'Active' : 'Blocked';
            $user->save();
            recordAdminActivity(Auth::user(), $request, $nextStatus === 'Blocked' ? 'Blocked' : 'Unblocked', 'Users', ($nextStatus === 'Blocked' ? 'Blocked' : 'Unblocked') . ' user: ' . $subjectName, 'User', $user->id);

            return response()->json([
                'message' => 'User status updated successfully.',
                'status' => $user->account_status,
            ]);
        }

        if ($validated['action'] === 'role') {
            $user = User::query()->findOrFail($validated['user_id']);
            $newRole = $validated['role'] ?? $user->role;
            $user->role = $newRole;
            if (array_key_exists('status', $validated)) {
                $user->account_status = $normalizeStatus($validated['status']);
            }
            $user->permissions = $newRole === 'admin' ? null : $defaultRolePermissions($newRole);
            $user->save();
            recordAdminActivity(Auth::user(), $request, 'Role Updated', 'Roles & Permissions', 'Updated role for ' . trim((($user->first_name ?? '') . ' ' . ($user->last_name ?? ''))) . ' to ' . Str::title(str_replace('_', ' ', $user->role)), 'User', $user->id);

            return response()->json([
                'message' => 'Role updated successfully.',
                'role' => $user->role,
                'status' => $user->account_status,
                'permissions' => $user->permissions ?? [],
            ]);
        }

        if ($validated['action'] === 'update') {
            $user = User::query()->findOrFail($validated['user_id']);
            if (!empty($validated['first_name']) || !empty($validated['last_name']) || !empty($validated['name'])) {
                [$firstName, $lastName] = $resolveNameParts($validated, trim((string) (($user->first_name ?? '') ?: 'User')));
                $user->first_name = $firstName;
                $user->last_name = $lastName;
            }
            if (!empty($validated['email'])) {
                $user->email = $validated['email'];
            }
            if (array_key_exists('phone', $validated)) {
                $user->phone_number = $validated['phone'] ?: null;
            }
            if (array_key_exists('birth_date', $validated)) {
                $user->birth_date = $validated['birth_date'] ?: null;
                $user->zodiac_id = $validated['birth_date'] ? zodiacIdFromBirthDate($validated['birth_date']) : null;
            }
            if (array_key_exists('status', $validated)) {
                $user->account_status = $normalizeStatus($validated['status']);
            }
            if (!empty($validated['password'])) {
                $user->password = $validated['password'];
            }
            if (!empty($validated['role'])) {
                $user->role = $validated['role'];
            }
            if ($user->role === 'admin') {
                $user->permissions = null;
            } elseif (in_array($user->role, ['lower_admin', 'content_manager'], true)) {
                $user->permissions = $defaultRolePermissions($user->role);
            }
            $user->save();
            $updatedName = trim((($user->first_name ?? '') . ' ' . ($user->last_name ?? ''))) ?: 'User';
            recordAdminActivity(Auth::user(), $request, 'Updated', Str::title(str_replace('_', ' ', $user->role)) . 's', 'Updated ' . Str::title(str_replace('_', ' ', $user->role)) . ': ' . $updatedName, 'User', $user->id);

            return response()->json([
                'message' => 'User updated successfully.',
                'user' => $user,
            ]);
        }

        $scope = $validated['scope'] ?? 'customer';
        $role = $validated['role'] ?? $scope;
        if ($scope === 'admin' && !in_array($role, ['admin', 'lower_admin', 'content_manager'], true)) {
            $role = 'admin';
        }
        if ($scope === 'consultant') {
            $role = 'consultant';
        }
        if ($scope === 'customer') {
            $role = 'customer';
        }

        [$firstName, $lastName] = $resolveNameParts($validated, $scope === 'consultant' ? 'Consultant' : ($scope === 'admin' ? 'Admin' : 'Customer'));
        $generatedPassword = Str::random(12);
        $plainPassword = filled($validated['password'] ?? null) ? $validated['password'] : $generatedPassword;
        $birthDate = $validated['birth_date'] ?? null;

        $user = User::create([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $validated['email'],
            'phone_number' => $validated['phone'] ?: null,
            'birth_date' => $birthDate ?: null,
            'zodiac_id' => $birthDate ? zodiacIdFromBirthDate($birthDate) : null,
            'password' => $plainPassword,
            'role' => $role,
            'account_status' => $normalizeStatus($validated['status'] ?? 'Active'),
            'permissions' => in_array($role, ['lower_admin', 'content_manager'], true)
                ? $defaultRolePermissions($role)
                : null,
        ]);

        $user->email_verified_at = now();
        $user->save();
        $createdName = trim((($user->first_name ?? '') . ' ' . ($user->last_name ?? ''))) ?: 'User';
        recordAdminActivity(Auth::user(), $request, 'Created', $scope === 'admin' ? 'Admin Users' : ($scope === 'consultant' ? 'Consultants' : 'Customers'), 'Created ' . Str::title(str_replace('_', ' ', $role)) . ': ' . $createdName, 'User', $user->id);

        return response()->json([
            'message' => 'User created successfully.',
            'temp_password' => $plainPassword,
            'user' => $user,
        ]);
    })->name('admin.users.manage');

    Route::post('/admin/role-permissions', function (Request $request) {
        abort_unless(Auth::check() && Auth::user()->role === 'admin', 403);

        $validated = $request->validate([
            'role' => ['required', 'in:lower_admin,content_manager'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['string'],
        ]);

        $allowedPermissions = [
            'manage_orders',
            'manage_products',
            'manage_inventory',
            'manage_custom_jewellery',
            'manage_consultations',
            'manage_contact_messages',
            'manage_content',
            'manage_reports',
            'manage_notifications',
        ];

        $permissions = array_values(array_unique(array_intersect(
            $validated['permissions'] ?? [],
            $allowedPermissions
        )));

        User::query()
            ->where('role', $validated['role'])
            ->get()
            ->each(function (User $user) use ($permissions) {
                $user->permissions = empty($permissions) ? null : $permissions;
                $user->save();
            });

        recordAdminActivity(Auth::user(), $request, 'Permissions Updated', 'Roles & Permissions', 'Updated permissions for ' . Str::title(str_replace('_', ' ', $validated['role'])) . ' role');

        return response()->json([
            'message' => 'Permissions updated successfully.',
            'role' => $validated['role'],
            'permissions' => $permissions,
        ]);
    })->name('admin.role-permissions.update');

    Route::post('/admin/profile', function (Request $request) {
        abort_unless(Auth::check() && Auth::user()->canAccessAdminDashboard(), 403);

        validateAndSaveProfileDetails($request);

        return profileRedirectResponse($request, 'Profile details updated successfully.');
    })->name('admin.profile.update');

    Route::get('/consultant/dashboard', function () {
        abortUnlessRole('consultant');

        $consultationRequests = ConsultationRequest::query()
            ->with(['customer', 'consultant', 'messages'])
            ->where('consultant_id', Auth::id())
            ->whereNotIn('status', ['Rejected', 'Cancelled'])
            ->latest()
            ->get();

        $appointmentRequests = Appointment::query()
            ->with(['customer', 'consultant'])
            ->latest()
            ->get();

        $appointmentSlotMap = Appointment::query()
            ->where('status', '!=', 'Cancelled')
            ->whereDate('preferred_date', '>=', today())
            ->get(['preferred_date', 'preferred_time', 'reschedule_proposed_date', 'reschedule_proposed_time', 'reschedule_responded_at'])
            ->flatMap(function (Appointment $appointment) {
                $pairs = [];
                if ($appointment->preferred_date && $appointment->preferred_time) {
                    $pairs[] = [
                        'date' => $appointment->preferred_date->format('Y-m-d'),
                        'time' => $appointment->preferred_time,
                    ];
                }
                if ($appointment->reschedule_proposed_date && $appointment->reschedule_proposed_time && $appointment->reschedule_responded_at === null) {
                    $pairs[] = [
                        'date' => $appointment->reschedule_proposed_date->format('Y-m-d'),
                        'time' => $appointment->reschedule_proposed_time,
                    ];
                }
                return $pairs;
            })
            ->groupBy('date')
            ->map(function ($appointmentsForDate) {
                return $appointmentsForDate
                    ->pluck('time')
                    ->filter()
                    ->unique()
                    ->values()
                    ->all();
            })
            ->all();

        $todayAppointmentRequests = Appointment::query()
            ->with(['customer', 'consultant'])
            ->whereDate('preferred_date', today())
            ->orderBy('preferred_time')
            ->get();

        $consultationMetrics = [
            'total_requests' => $consultationRequests->count(),
            'today_appointments' => Appointment::query()
                ->whereDate('preferred_date', today())
                ->count(),
            'pending_requests' => ConsultationRequest::query()->where('consultant_id', Auth::id())->where('status', 'Pending')->count(),
            'approved_requests' => ConsultationRequest::query()->where('consultant_id', Auth::id())->where('status', 'Approved')->count(),
            'completed_requests' => ConsultationRequest::query()->where('consultant_id', Auth::id())->where('status', 'Completed')->count(),
            'rejected_requests' => ConsultationRequest::query()->where('consultant_id', Auth::id())->where('status', 'Rejected')->count(),
            'upcoming_appointments' => Appointment::query()
                ->whereDate('preferred_date', '>', today())
                ->whereIn('status', ['Pending', 'Confirmed'])
                ->count(),
            'cancelled_appointments' => Appointment::query()->where('status', 'Cancelled')->count(),
        ];

        $appointmentMetrics = [
            'today' => $todayAppointmentRequests->count(),
            'upcoming' => Appointment::query()
                ->whereDate('preferred_date', '>', today())
                ->whereIn('status', ['Pending', 'Confirmed'])
                ->count(),
            'completed' => Appointment::query()->where('status', 'Completed')->count(),
            'cancelled' => Appointment::query()->where('status', 'Cancelled')->count(),
        ];

        SiteNotification::query()
            ->where(function ($query) {
                $query->whereNull('recipient_user_id')
                    ->orWhere('recipient_user_id', Auth::id());
            })
            ->whereIn('recipient_role', ['all', 'consultant'])
            ->where('status', 'Unread')
            ->update(['status' => 'Read']);

        $consultantNotifications = SiteNotification::query()
            ->where(function ($query) {
                $query->whereNull('recipient_user_id')
                    ->orWhere('recipient_user_id', Auth::id());
            })
            ->whereIn('recipient_role', ['all', 'consultant'])
            ->latest('published_at')
            ->latest('created_at')
            ->get();

        $consultantCustomerIds = $consultationRequests->pluck('user_id')->filter()->unique()->values();
        $consultantCustomers = $consultantCustomerIds->isEmpty()
            ? collect()
            : User::query()
                ->whereIn('id', $consultantCustomerIds)
                ->with(['zodiacSign'])
                ->orderBy('first_name')
                ->get();

        $consultationCountMap = ConsultationRequest::query()
            ->where('consultant_id', Auth::id())
            ->whereIn('user_id', $consultantCustomerIds)
            ->select('user_id', DB::raw('COUNT(*) as total'))
            ->groupBy('user_id')
            ->pluck('total', 'user_id');

        $wishlistCountMap = WishlistItem::query()
            ->whereIn('user_id', $consultantCustomerIds)
            ->select('user_id', DB::raw('COUNT(*) as total'))
            ->groupBy('user_id')
            ->pluck('total', 'user_id');

        $orderCountMap = Order::query()
            ->whereIn('user_id', $consultantCustomerIds)
            ->select('user_id', DB::raw('COUNT(*) as total'))
            ->groupBy('user_id')
            ->pluck('total', 'user_id');

        $latestOrderMap = Order::query()
            ->with(['items.product'])
            ->whereIn('user_id', $consultantCustomerIds)
            ->latest('created_at')
            ->get()
            ->groupBy('user_id')
            ->map(fn ($orders) => $orders->first());

        $latestConsultationMap = ConsultationRequest::query()
            ->with(['messages'])
            ->where('consultant_id', Auth::id())
            ->whereIn('user_id', $consultantCustomerIds)
            ->latest()
            ->get()
            ->groupBy('user_id')
            ->map(fn ($requests) => $requests->first());

        $customerInsights = $consultantCustomers->map(function (User $customer) use ($consultationCountMap, $wishlistCountMap, $orderCountMap, $latestOrderMap, $latestConsultationMap) {
            $customerId = $customer->id;
            $fullName = trim((($customer->first_name ?? '') . ' ' . ($customer->last_name ?? ''))) ?: 'Customer';
            $latestOrder = $latestOrderMap->get($customerId);
            $latestConsultation = $latestConsultationMap->get($customerId);
            $zodiacName = trim((string) ($customer->zodiacSign?->sign_name ?? ''));
            $zodiacLabel = $zodiacName === 'Libra' ? 'Lib.' : ($zodiacName !== '' ? $zodiacName : '-');

            return [
                'customer_id' => $customerId,
                'name' => $fullName,
                'email' => $customer->email,
                'phone' => $customer->phone_number ?: '-',
                'birth_date' => $customer->birth_date
                    ? (is_object($customer->birth_date) && method_exists($customer->birth_date, 'format')
                        ? $customer->birth_date->format('Y-m-d')
                        : \Illuminate\Support\Carbon::parse((string) $customer->birth_date)->format('Y-m-d'))
                    : '-',
                'zodiac' => $zodiacName !== '' ? $zodiacName : '-',
                'zodiac_label' => $zodiacLabel,
                'zodiac_key' => $zodiacName !== '' ? Str::lower($zodiacName) : '',
                'orders_count' => (int) ($orderCountMap->get($customerId) ?? 0),
                'wishlist_count' => (int) ($wishlistCountMap->get($customerId) ?? 0),
                'consultation_count' => (int) ($consultationCountMap->get($customerId) ?? 0),
                'latest_order_number' => $latestOrder?->order_number ?: '-',
                'latest_order_status' => $latestOrder?->status ?: '-',
                'latest_consultation_type' => $latestConsultation?->display_request_type ?: '-',
                'latest_consultation_status' => $latestConsultation?->status ?: '-',
                'latest_consultation_date' => $latestConsultation?->created_at?->format('Y-m-d') ?: '-',
                'search_blob' => Str::lower(implode(' ', array_filter([
                    $fullName,
                    (string) $customer->email,
                    (string) $customer->phone_number,
                    (string) $customer->birth_date,
                    $zodiacName,
                    (string) ($latestOrder?->order_number ?? ''),
                    (string) ($latestConsultation?->request_number ?? ''),
                    (string) ($latestConsultation?->display_request_type ?? ''),
                ]))),
                'initials' => collect(explode(' ', $fullName))->filter()->map(fn ($part) => strtoupper(substr($part, 0, 1)))->take(2)->implode(''),
            ];
        })->values();

        $customerInsightZodiacOptions = $customerInsights
            ->pluck('zodiac')
            ->filter(fn ($value) => $value !== '-')
            ->unique()
            ->sort()
            ->values();

        $recommendationRows = $consultationRequests
            ->filter(function (ConsultationRequest $request) {
                return trim((string) $request->consultant_note) !== ''
                    || trim((string) $request->customer_note) !== ''
                    || in_array($request->status, ['Approved', 'Completed'], true);
            })
            ->sortByDesc(function (ConsultationRequest $request) {
                return $request->updated_at?->timestamp ?? $request->created_at?->timestamp ?? 0;
            })
            ->take(12)
            ->map(function (ConsultationRequest $request) {
                $summary = trim((string) $request->consultant_note);
                if ($summary === '') {
                    $summary = trim((string) $request->customer_note);
                }
                if ($summary === '') {
                    $summary = 'Continue advising on ' . strtolower((string) $request->display_request_type) . '.';
                }

                return [
                    'request_number' => $request->request_number,
                    'customer_name' => $request->customer_name,
                    'request_type' => $request->display_request_type,
                    'status' => $request->status,
                    'status_class' => $request->status_class,
                    'date' => $request->updated_at?->format('Y-m-d') ?: $request->created_at?->format('Y-m-d') ?: '-',
                    'summary' => $summary,
                    'consultant_name' => $request->consultant_name,
                ];
            })
            ->values();

        return view('consultant-dashboard', [
            'consultationRequests' => $consultationRequests,
            'appointmentRequests' => $appointmentRequests,
            'todayAppointmentRequests' => $todayAppointmentRequests,
            'appointmentSlotMap' => $appointmentSlotMap,
            'consultationMetrics' => $consultationMetrics,
            'appointmentMetrics' => $appointmentMetrics,
            'customerInsights' => $customerInsights,
            'customerInsightZodiacOptions' => $customerInsightZodiacOptions,
            'recommendationRows' => $recommendationRows,
            'consultantNotifications' => $consultantNotifications,
        ]);
    })->name('consultant.dashboard');

    Route::post('/consultant/consultation-requests/{consultationRequest}/status', [ConsultationRequestController::class, 'update'])->name('consultant.consultation-requests.update');
    Route::post('/consultant/appointments/{appointment}/status', [AppointmentController::class, 'update'])->name('consultant.appointments.update');
    Route::post('/appointments/{appointment}/status', [AppointmentController::class, 'update'])->name('appointments.update');

    Route::post('/consultant/profile', function (Request $request) {
        abortUnlessRole('consultant');

        validateAndSaveProfileDetails($request);

        return profileRedirectResponse($request, 'Profile details updated successfully.');
    })->name('consultant.profile.update');

    Route::get('/reviews', function () {
        return redirect()->route('home');
    })->name('reviews');

    Route::get('/messages', function () {
        return redirect()->route('home');
    })->name('messages');

    Route::get('/orders', function () {
        if ($redirect = ensureCustomerDashboardAccess()) {
            return $redirect;
        }

        $customerOrders = Order::query()
            ->with(['items.review', 'returnRequest'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get()
            ->map(function (Order $order) {
                $reviewEligible = $order->status !== 'Cancelled' && $order->items->contains(function ($item) {
                    return !$item->review;
                });
                $returnRequest = $order->returnRequest;

                return [
                    'dbId' => $order->id,
                    'id' => $order->order_number,
                    'customerEmail' => $order->email,
                    'createdAt' => $order->created_at?->toISOString(),
                    'orderDate' => $order->created_at?->toDateString(),
                    'shippingMethod' => $order->shipping_method,
                    'paymentMethod' => $order->payment_method,
                    'receiptImage' => $order->receipt_image ? asset($order->receipt_image) : '',
                    'pickupOnly' => (bool) $order->pickup_only,
                    'depositAmount' => (float) ($order->pickup_only && in_array(Str::lower((string) $order->status), ['completed', 'pickup completed'], true) ? ($order->total ?? $order->deposit_amount) : $order->deposit_amount),
                    'balanceDue' => (float) ($order->pickup_only && in_array(Str::lower((string) $order->status), ['completed', 'pickup completed'], true) ? 0 : $order->balance_due),
                    'amountDueNow' => (bool) $order->pickup_only
                        ? (float) ($order->pickup_only && in_array(Str::lower((string) $order->status), ['completed', 'pickup completed'], true) ? ($order->total ?? $order->deposit_amount) : $order->deposit_amount)
                        : ((float) $order->subtotal + (float) $order->shipping_cost),
                    'status' => $order->status,
                    'shippingPrice' => $order->shipping_cost,
                    'itemsTotalLkr' => $order->subtotal,
                    'returnRequest' => $returnRequest ? [
                        'id' => $returnRequest->id,
                        'requestNumber' => $returnRequest->request_number,
                        'reason' => $returnRequest->reason,
                        'decision' => $returnRequest->decision,
                        'refundStatus' => $returnRequest->refund_status,
                        'adminNote' => $returnRequest->admin_note,
                    ] : null,
                    'items' => $order->items->map(function ($item) {
                        return [
                            'id' => $item->product_id,
                            'name' => $item->product_name,
                            'description' => null,
                            'image' => $item->product_image ? asset('images/Product/'.$item->product_image) : asset('images/placeholders/notavailable.png'),
                            'price' => $item->unit_price,
                            'quantity' => $item->quantity,
                        ];
                    })->values(),
                    'reviewEligible' => $reviewEligible,
                    'customer' => [
                        'address' => $order->address,
                        'city' => $order->city,
                        'town' => $order->town,
                        'province' => $order->province,
                        'postal_code' => $order->postal_code,
                        'phone' => $order->phone,
                    ],
                ];
            });

        return view('customer-account', [
            'activeSection' => 'orders',
            'customerOrders' => $customerOrders,
        ]);
    })->name('orders');

    Route::post('/returns/refund/request', function (Request $request) {
        if ($redirect = ensureCustomerDashboardAccess()) {
            return $redirect;
        }

        $validated = $request->validate([
            'order_id' => ['required', 'integer', 'exists:orders,id'],
            'reason' => ['required', 'string', 'max:3000'],
        ]);

        $order = Order::query()
            ->with('returnRequest')
            ->where('id', $validated['order_id'])
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if (Str::lower((string) $order->status) !== 'completed') {
            return response()->json(['message' => 'Refund requests are only allowed for completed orders.'], 422);
        }

        if ($order->returnRequest) {
            return response()->json(['message' => 'A refund request already exists for this order.'], 422);
        }

        $requestNumber = 'RET-' . now()->format('YmdHis') . '-' . random_int(100, 999);
        $returnRequest = OrderReturn::create([
            'order_id' => $order->id,
            'user_id' => Auth::id(),
            'request_number' => $requestNumber,
            'reason' => trim((string) $validated['reason']),
            'decision' => 'Pending Review',
            'refund_status' => 'In Progress',
        ]);

        SiteNotification::create([
            'recipient_user_id' => null,
            'recipient_role' => 'admin',
            'category' => 'Orders',
            'title' => 'Refund Request ' . $returnRequest->request_number,
            'message' => 'New refund request submitted for order ' . $order->order_number . '. Reason: ' . trim((string) $validated['reason']),
            'status' => 'Unread',
            'published_at' => now(),
        ]);

        SiteNotification::create([
            'recipient_user_id' => Auth::id(),
            'recipient_role' => 'customer',
            'category' => 'Orders',
            'title' => 'Return ' . $returnRequest->request_number . ' Pending Review',
            'message' => 'Your refund request for order ' . $order->order_number . ' has been submitted and is now pending review.',
            'status' => 'Unread',
            'published_at' => now(),
        ]);

        return response()->json([
            'message' => 'Refund request submitted successfully.',
            'return_request' => [
                'id' => $returnRequest->id,
                'request_number' => $returnRequest->request_number,
                'decision' => $returnRequest->decision,
                'refund_status' => $returnRequest->refund_status,
            ],
        ]);
    })->name('returns.refund.request');

    Route::post('/admin/custom-jewellery/manage', function (Request $request) {
        abort_unless(Auth::check() && Auth::user()->hasAdminPermission('manage_custom_jewellery'), 403);

        $validated = $request->validate([
            'action' => ['required', Rule::in(['approve', 'reject', 'send-quotation', 'update-status'])],
            'custom_request_db_id' => ['required', 'integer', 'exists:custom_jewellery_requests,id'],
            'status' => ['nullable', Rule::in(['Pending', 'Approved', 'Quoted', 'Rejected'])],
            'quotation_amount' => ['nullable', 'numeric', 'min:0'],
            'quotation_note' => ['nullable', 'string', 'max:4000'],
            'quotation_image' => ['nullable', 'image', 'max:5120'],
            'admin_note' => ['nullable', 'string', 'max:4000'],
        ]);

        $customRequest = CustomJewelleryRequest::query()
            ->with(['user', 'quotation'])
            ->findOrFail($validated['custom_request_db_id']);

        $customer = $customRequest->user;
        $customerName = trim((string) (($customer?->first_name ?? '') . ' ' . ($customer?->last_name ?? ''))) ?: 'Customer';
        $adminNote = trim((string) ($validated['admin_note'] ?? ''));
        $quotationNote = trim((string) ($validated['quotation_note'] ?? ''));
        $quotationImageFile = $request->file('quotation_image');
        $quotationImageName = null;

        if ($validated['action'] === 'send-quotation') {
            $existingQuotation = $customRequest->quotation;
            if ($existingQuotation && Str::lower((string) $existingQuotation->status) !== 'rejected') {
                return response()->json([
                    'message' => 'A quotation already exists for this request.',
                ], 422);
            }
        }

        if ($validated['action'] === 'send-quotation' && $quotationImageFile) {
            $destination = public_path('images/Quotations');
            if (!is_dir($destination)) {
                mkdir($destination, 0755, true);
            }
            $quotationImageName = 'quotation-' . $customRequest->request_number . '-' . now()->format('YmdHis') . '-' . Str::random(6) . '.' . $quotationImageFile->getClientOriginalExtension();
            $quotationImageFile->move($destination, $quotationImageName);
        }

        DB::transaction(function () use ($validated, $customRequest, $customer, $customerName, $adminNote, $quotationNote, $quotationImageName) {
            if ($validated['action'] === 'approve') {
                $customRequest->update([
                    'status' => 'Approved',
                ]);

                SiteNotification::create([
                    'recipient_user_id' => $customer?->id,
                    'recipient_role' => 'customer',
                    'category' => 'Custom Jewellery',
                    'title' => 'Custom Request ' . $customRequest->request_number . ' Approved',
                    'message' => 'Your custom jewellery request has been approved.' . ($adminNote !== '' ? ' Admin note: ' . $adminNote : ''),
                    'status' => 'Unread',
                    'published_at' => now(),
                ]);
                return;
            }

            if ($validated['action'] === 'reject') {
                $customRequest->update([
                    'status' => 'Rejected',
                ]);

                SiteNotification::create([
                    'recipient_user_id' => $customer?->id,
                    'recipient_role' => 'customer',
                    'category' => 'Custom Jewellery',
                    'title' => 'Custom Request ' . $customRequest->request_number . ' Rejected',
                    'message' => 'Your custom jewellery request was rejected.' . ($adminNote !== '' ? ' Reason: ' . $adminNote : ''),
                    'status' => 'Unread',
                    'published_at' => now(),
                ]);
                return;
            }

            if ($validated['action'] === 'update-status') {
                if ($customRequest->quotation) {
                    throw ValidationException::withMessages([
                        'status' => ['Customer quotation has already been sent; request status can no longer be updated.'],
                    ]);
                }
                $nextStatus = $validated['status'] ?? 'Pending';
                $customRequest->update([
                    'status' => $nextStatus,
                ]);

                SiteNotification::create([
                    'recipient_user_id' => $customer?->id,
                    'recipient_role' => 'customer',
                    'category' => 'Custom Jewellery',
                    'title' => 'Custom Request ' . $customRequest->request_number . ' ' . $nextStatus,
                    'message' => 'Your custom jewellery request status has been updated to ' . $nextStatus . '.' . ($adminNote !== '' ? ' Admin note: ' . $adminNote : ''),
                    'status' => 'Unread',
                    'published_at' => now(),
                ]);
                return;
            }

            $quotationAmount = (float) ($validated['quotation_amount'] ?? 0);
            $quotationData = [
                'user_id' => $customer?->id,
                'quotation_number' => $customRequest->request_number . '-Q-' . now()->format('His'),
                'quotation_amount' => $quotationAmount,
                'quotation_note' => $quotationNote !== '' ? $quotationNote : null,
                'status' => 'Sent',
                'sent_at' => now(),
            ];
            if ($quotationImageName) {
                $quotationData['quotation_image'] = $quotationImageName;
            }

            $quotation = CustomJewelleryQuotation::query()->updateOrCreate(
                ['custom_jewellery_request_id' => $customRequest->id],
                $quotationData
            );

            $customRequest->update([
                'status' => 'Quoted',
                'quotation_amount' => $quotationAmount,
                'quotation_note' => $quotationNote !== '' ? $quotationNote : null,
            ]);

            SiteNotification::create([
                'recipient_user_id' => $customer?->id,
                'recipient_role' => 'customer',
                'category' => 'Custom Jewellery',
                'title' => 'Quotation for ' . $customRequest->request_number,
                'message' => 'A quotation of Rs ' . number_format($quotationAmount, 0) . ' is ready for your custom jewellery request.' . ($quotationNote !== '' ? ' Note: ' . $quotationNote : ''),
                'status' => 'Unread',
                'action_label' => 'Review Quotation',
                'action_url' => route('custom.jewellery'),
                'published_at' => now(),
            ]);
        });

        return response()->json([
            'ok' => true,
            'message' => 'Custom jewellery request updated successfully.',
        ]);
    })->name('admin.custom-jewellery.manage');

    Route::post('/custom-quotations/{quotation}/accept', function (Request $request, CustomJewelleryQuotation $quotation) {
        if ($redirect = ensureCustomerDashboardAccess()) {
            return $redirect;
        }

        abort_unless($quotation->user_id === Auth::id(), 403);
        abort_unless(Str::lower((string) $quotation->status) === 'sent', 422, 'Only sent quotations can be accepted.');

        DB::transaction(function () use ($quotation) {
            $quotation->update([
                'status' => 'Accepted',
                'responded_at' => now(),
            ]);

            $requestNumber = $quotation->request?->request_number ?? 'request';

            SiteNotification::create([
                'recipient_user_id' => null,
                'recipient_role' => 'admin',
                'category' => 'Custom Jewellery',
                'title' => 'Quotation Accepted ' . $requestNumber,
                'message' => 'The customer accepted quotation ' . $quotation->quotation_number . ' for request ' . $requestNumber . '.',
                'status' => 'Unread',
                'published_at' => now(),
            ]);

            SiteNotification::create([
                'recipient_user_id' => Auth::id(),
                'recipient_role' => 'customer',
                'category' => 'Custom Jewellery',
                'title' => 'Quotation ' . $quotation->quotation_number . ' Accepted',
                'message' => 'Your quotation has been accepted. You can now continue to payment.',
                'status' => 'Unread',
                'published_at' => now(),
            ]);
        });

        return redirect()
            ->route('custom.jewellery')
            ->with('custom_jewellery_success', 'Quotation accepted. You can now continue to payment.');
    })->name('custom.quotations.accept');

    Route::post('/custom-quotations/{quotation}/reject', function (Request $request, CustomJewelleryQuotation $quotation) {
        if ($redirect = ensureCustomerDashboardAccess()) {
            return $redirect;
        }

        abort_unless($quotation->user_id === Auth::id(), 403);
        abort_unless(Str::lower((string) $quotation->status) === 'sent', 422, 'Only sent quotations can be rejected.');

        DB::transaction(function () use ($quotation) {
            $quotation->update([
                'status' => 'Rejected',
                'responded_at' => now(),
            ]);

            $requestNumber = $quotation->request?->request_number ?? 'request';

            SiteNotification::create([
                'recipient_user_id' => null,
                'recipient_role' => 'admin',
                'category' => 'Custom Jewellery',
                'title' => 'Quotation Rejected ' . $requestNumber,
                'message' => 'The customer rejected quotation ' . $quotation->quotation_number . ' for request ' . $requestNumber . '.',
                'status' => 'Unread',
                'published_at' => now(),
            ]);

            SiteNotification::create([
                'recipient_user_id' => Auth::id(),
                'recipient_role' => 'customer',
                'category' => 'Custom Jewellery',
                'title' => 'Quotation ' . $quotation->quotation_number . ' Rejected',
                'message' => 'You rejected the quotation for your custom jewellery request.',
                'status' => 'Unread',
                'published_at' => now(),
            ]);
        });

        return redirect()
            ->route('custom.jewellery')
            ->with('custom_jewellery_success', 'Quotation rejected.');
    })->name('custom.quotations.reject');

    Route::get('/custom-quotations/{quotation}/pay', function (Request $request, CustomJewelleryQuotation $quotation) {
        if ($redirect = ensureCustomerDashboardAccess()) {
            return $redirect;
        }

        abort_unless($quotation->user_id === Auth::id(), 403);
        abort_unless(Str::lower((string) $quotation->status) === 'accepted', 422, 'Only accepted quotations can be paid.');
        $quotation->loadMissing(['request.user', 'request.gem.product', 'request.jewelleryType']);
        $customRequest = $quotation->request;
        $customer = $quotation->user;
        $quotationType = Str::slug((string) ($customRequest?->jewelleryType?->name ?? 'Other Jewellery'));
        $quotationImage = asset(match ($quotationType) {
            'ring' => 'images/main_website/web_ji1.png',
            'necklace' => 'images/main_website/web_ji5.png',
            'chain' => 'images/main_website/web_ji9.png',
            'bracelet' => 'images/main_website/web_ji2.png',
            'bangle' => 'images/main_website/web_ji6.png',
            'earring' => 'images/main_website/web_ji3.png',
            'pendant' => 'images/main_website/web_ji10.png',
            default => 'images/main_website/web_ji11.png',
        });

        $payload = [
            'customer' => [
                'first_name' => $customer?->first_name ?? '',
                'last_name' => $customer?->last_name ?? '',
                'email' => $customer?->email ?? '',
                'phone' => $customer?->phone_number ?? null,
                'address' => $customer?->address ?? '',
                'city' => null,
                'town' => null,
                'province' => null,
                'postal_code' => null,
                'notes' => 'Custom quotation payment for ' . ($customRequest?->request_number ?? 'request') . '.',
            ],
            'items' => [[
                'id' => $customRequest?->id ? ('CJR-' . $customRequest->id) : 'CUSTOM-QUOTATION',
                'product_id' => 0,
                'name' => 'Custom Jewellery - ' . ($customRequest?->request_number ?? 'Quotation'),
                'description' => trim(($customRequest?->type_display_name ?? 'Custom Jewellery') . ' · ' . ($customRequest?->metal ?? 'Metal')),
                'image' => $quotationImage,
                'quantity' => 1,
                'price' => (float) $quotation->quotation_amount,
                'quotation_type' => $quotationType,
            ]],
        ];

        $request->session()->put('custom_quotation_checkout', [
            'custom_request_id' => $customRequest?->id,
            'quotation_id' => $quotation->id,
            'quotation_number' => $quotation->quotation_number,
            'quotation_image' => $quotation->quotation_image,
            'customer' => $payload['customer'],
            'items' => $payload['items'],
        ]);

        return redirect()->route('checkout');
    })->name('custom.quotations.pay');

    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
    Route::post('/wishlist/items', [WishlistController::class, 'store'])->name('wishlist.items.store');
    Route::delete('/wishlist/items/{wishlistItem}', [WishlistController::class, 'destroy'])->name('wishlist.items.destroy');

    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [CartController::class, 'storeCheckout'])->name('checkout.store');
    Route::get('/checkout/confirm', [CartController::class, 'confirmCheckout'])->name('checkout.confirm');
    Route::post('/checkout/confirm', [CartController::class, 'finalizeCheckout'])->name('checkout.complete');
    Route::post('/cart/items', [CartController::class, 'store'])->name('cart.items.store');
    Route::patch('/cart/items/{item}', [CartController::class, 'update'])->name('cart.items.update');
    Route::delete('/cart/items/{item}', [CartController::class, 'destroy'])->name('cart.items.destroy');
    Route::post('/cart/sync', [CartController::class, 'sync'])->name('cart.sync');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

    Route::get('/custom-jewellery', function () {
        if ($redirect = ensureCustomerDashboardAccess()) {
            return $redirect;
        }

        $allowedTypeNames = ['Ring', 'Necklace', 'Bracelet', 'Earring', 'Chain', 'Bangle', 'Pendant'];

        $typeOptions = JewelleryType::query()
            ->whereIn('name', $allowedTypeNames)
            ->orderByRaw("FIELD(name, 'Ring', 'Necklace', 'Bracelet', 'Earring', 'Chain', 'Bangle', 'Pendant')")
            ->get()
            ->map(function (JewelleryType $type) {
            $slug = Str::slug($type->name);

            return [
                'id' => $type->type_id,
                'name' => $type->name,
                'slug' => $slug,
                'measurement_label' => match ($slug) {
                    'ring' => 'Ring Size',
                    'necklace' => 'Chain Length',
                    'bracelet' => 'Bracelet Size',
                    'earring' => 'Earring Size',
                    'chain' => 'Chain Length',
                    'bangle' => 'Bangle Size',
                    'pendant' => 'Pendant Size',
                    default => 'Measurement',
                },
                'measurement_placeholder' => match ($slug) {
                    'ring' => 'e.g. 6.5',
                    'necklace' => 'e.g. 18 inches',
                    'bracelet' => 'e.g. 7.5 inches',
                    'earring' => 'e.g. 25 mm',
                    'chain' => 'e.g. 22 inches',
                    'bangle' => 'e.g. 2.6',
                    'pendant' => 'e.g. Medium',
                    default => 'e.g. Any relevant measurement',
                },
            ];
        })->values();

        $gemOptions = Gem::with(['product', 'gemType'])
            ->orderBy('product_id')
            ->get()
            ->map(function (Gem $gem) {
                $productName = $gem->product?->name ?? 'Gem';
                $gemType = $gem->gemType?->name;

                return [
                    'id' => $gem->product_id,
                    'name' => $productName,
                    'label' => $gemType
                        ? "{$productName} · {$gemType}"
                        : $productName,
                    'meta' => trim(implode(' · ', array_filter([
                        $gemType,
                        $gem->color,
                        $gem->shape,
                        $gem->carat_weight ? $gem->carat_weight . ' ct' : null,
                    ]))),
                    'image' => $gem->product?->image
                        ? asset('images/Product/' . $gem->product->image)
                        : asset('images/placeholders/notavailable.png'),
                ];
            })->values();

        $customJewelleryOptionSets = customJewelleryOptionSets();

        $customRequests = CustomJewelleryRequest::with(['jewelleryType', 'gem.product', 'gem.gemType', 'quotation'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('customer-account', [
            'activeSection' => 'custom-jewellery',
            'customJewelleryTypes' => $typeOptions,
            'customGemOptions' => $gemOptions,
            'customMeasurementOptions' => $customJewelleryOptionSets['measurement_options'],
            'customTypeFieldOptions' => $customJewelleryOptionSets['field_options'],
            'customJewelleryRequests' => $customRequests,
        ]);
    })->name('custom.jewellery');

    Route::post('/custom-jewellery', [CustomJewelleryRequestController::class, 'store'])->name('custom.jewellery.store');

    Route::get('/consultations', function () {
        if ($redirect = ensureCustomerDashboardAccess()) {
            return $redirect;
        }

        $consultationRequests = ConsultationRequest::query()
            ->with(['consultant', 'messages'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        $appointments = Appointment::query()
            ->with(['consultant'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        $appointmentSlotMap = Appointment::query()
            ->where('status', '!=', 'Cancelled')
            ->whereDate('preferred_date', '>=', today())
            ->get(['preferred_date', 'preferred_time', 'reschedule_proposed_date', 'reschedule_proposed_time', 'reschedule_responded_at'])
            ->flatMap(function (Appointment $appointment) {
                $pairs = [];
                if ($appointment->preferred_date && $appointment->preferred_time) {
                    $pairs[] = [
                        'date' => $appointment->preferred_date->format('Y-m-d'),
                        'time' => $appointment->preferred_time,
                    ];
                }
                if ($appointment->reschedule_proposed_date && $appointment->reschedule_proposed_time && $appointment->reschedule_responded_at === null) {
                    $pairs[] = [
                        'date' => $appointment->reschedule_proposed_date->format('Y-m-d'),
                        'time' => $appointment->reschedule_proposed_time,
                    ];
                }
                return $pairs;
            })
            ->groupBy('date')
            ->map(function ($appointmentsForDate) {
                return $appointmentsForDate
                    ->pluck('time')
                    ->filter()
                    ->unique()
                    ->values()
                    ->all();
            })
            ->all();

        $consultationSummary = [
            'requests' => $consultationRequests->count(),
            'active_chats' => $consultationRequests->filter(function (ConsultationRequest $consultationRequest) {
                return $consultationRequest->consultant_id !== null && $consultationRequest->status === 'Approved';
            })->count(),
            'appointments' => $appointments->count(),
        ];

        return view('customer-account', [
            'activeSection' => 'consultations',
            'consultationRequests' => $consultationRequests,
            'appointments' => $appointments,
            'appointmentSlotMap' => $appointmentSlotMap,
            'consultationSummary' => $consultationSummary,
        ]);
    })->name('consultations');

    Route::post('/consultations', [ConsultationRequestController::class, 'store'])->name('consultations.store');
    Route::post('/consultations/{consultationRequest}/messages', [ConsultationMessageController::class, 'store'])->name('consultations.messages.store');
    Route::get('/consultations/threads', function () {
        abort_unless(Auth::check() && in_array(Auth::user()->role, ['customer', 'consultant'], true), 403);

        $user = Auth::user();

        $consultationRequests = ConsultationRequest::query()
            ->with(['customer', 'consultant', 'messages'])
            ->when($user->role === 'customer', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->when($user->role === 'consultant', function ($query) use ($user) {
                $query->where('consultant_id', $user->id)
                    ->whereNotIn('status', ['Rejected', 'Cancelled']);
            })
            ->latest()
            ->get()
            ->map(function (ConsultationRequest $request) use ($user) {
                $messages = $request->messages
                    ->filter(function ($message) {
                        return in_array((string) $message->sender_role, ['customer', 'consultant'], true);
                    })
                    ->map(function ($message) {
                        return [
                            'sender' => $message->sender_role === 'consultant' ? 'Consultant' : 'Customer',
                            'time' => $message->created_at?->format('h:i A'),
                            'text' => $message->message,
                            'imagePath' => $message->image_path,
                            'imageUrl' => $message->image_path ? asset($message->image_path) : null,
                        ];
                    })
                    ->values();

                return [
                    'consultationId' => $request->id,
                    'id' => $request->chat_thread_id,
                    'requestId' => $request->request_number,
                    'customerName' => trim((($request->customer?->first_name ?? '') . ' ' . ($request->customer?->last_name ?? ''))),
                    'consultantName' => trim((($request->consultant?->first_name ?? '') . ' ' . ($request->consultant?->last_name ?? ''))) ?: 'Consultant Team',
                    'requestType' => $request->request_type,
                    'status' => $request->status,
                    'consultantId' => $request->consultant_id,
                    'canReply' => $request->consultant_id !== null && $request->status === 'Approved' && (
                        ($user->role === 'customer' && $request->user_id === $user->id) ||
                        ($user->role === 'consultant' && $request->consultant_id === $user->id)
                    ),
                    'submittedAt' => $request->created_at?->format('Y-m-d'),
                    'messages' => $messages,
                ];
            })
            ->values();

        return response()->json(['threads' => $consultationRequests]);
    })->name('consultations.threads');
    Route::get('/admin/consultations/threads', function () {
        abort_unless(Auth::check() && Auth::user()->canAccessAdminDashboard(), 403);

        $consultationRequests = ConsultationRequest::query()
            ->with(['customer', 'consultant', 'messages'])
            ->latest()
            ->get()
            ->map(function (ConsultationRequest $request) {
                return [
                    'consultationId' => $request->id,
                    'id' => $request->chat_thread_id,
                    'requestId' => $request->request_number,
                    'customerName' => trim((($request->customer?->first_name ?? '') . ' ' . ($request->customer?->last_name ?? ''))),
                    'consultantName' => trim((($request->consultant?->first_name ?? '') . ' ' . ($request->consultant?->last_name ?? ''))) ?: 'Consultant Team',
                    'requestType' => $request->request_type,
                    'status' => $request->status,
                    'consultantId' => $request->consultant_id,
                    'submittedAt' => $request->created_at?->format('Y-m-d'),
                    'dateTime' => $request->date_time_label,
                    'messages' => $request->messages
                        ->filter(function ($message) {
                            return in_array((string) $message->sender_role, ['customer', 'consultant', 'admin'], true);
                        })
                        ->map(function ($message) {
                            return [
                                'sender' => ucfirst((string) $message->sender_role),
                                'text' => $message->message,
                                'time' => $message->created_at?->format('h:i A') ?? 'Now',
                                'imageUrl' => $message->image_path ? asset($message->image_path) : null,
                                'imagePath' => $message->image_path,
                            ];
                        })
                        ->values(),
                ];
            })
            ->values();

        return response()->json(['threads' => $consultationRequests]);
    })->name('admin.consultations.threads');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');

    Route::get('/contact-messages', function () {
        if ($redirect = ensureCustomerDashboardAccess()) {
            return $redirect;
        }

        $customerContactMessages = ContactMessage::query()
            ->where('customer_id', Auth::id())
            ->latest()
            ->get()
            ->map(function (ContactMessage $message) {
                $repliedByName = trim((string) (($message->repliedBy?->first_name ?? '') . ' ' . ($message->repliedBy?->last_name ?? '')));

                return [
                    'id' => 'MSG-' . str_pad((string) $message->id, 3, '0', STR_PAD_LEFT),
                    'date' => $message->date?->format('Y-m-d') ?: (string) $message->date,
                    'subject' => $message->subject,
                    'message' => $message->message,
                    'status' => $message->status ?: 'Unread',
                    'replyMessage' => $message->reply_message ?: '',
                    'replyDate' => $message->replied_at?->format('Y-m-d H:i') ?: '',
                    'replyBy' => $repliedByName ?: '',
                ];
            });

        return view('customer-account', [
            'activeSection' => 'contact-messages',
            'customerContactMessages' => $customerContactMessages,
        ]);
    })->name('contact.messages');

    Route::get('/notifications', function () {
        if ($redirect = ensureCustomerDashboardAccess()) {
            return $redirect;
        }

        SiteNotification::query()
            ->where(function ($query) {
                $query->whereNull('recipient_user_id')
                    ->orWhere('recipient_user_id', Auth::id());
            })
            ->whereIn('recipient_role', ['all', 'customer'])
            ->where('status', 'Unread')
            ->update(['status' => 'Read']);

        $customerNotifications = SiteNotification::query()
            ->where(function ($query) {
                $query->whereNull('recipient_user_id')
                    ->orWhere('recipient_user_id', Auth::id());
            })
            ->whereIn('recipient_role', ['all', 'customer'])
            ->latest('published_at')
            ->latest('created_at')
            ->get();

        return view('customer-account', [
            'activeSection' => 'notifications',
            'customerNotifications' => $customerNotifications,
        ]);
    })->name('notifications');

    Route::get('/settings', function () {
        if ($redirect = ensureCustomerDashboardAccess()) {
            return $redirect;
        }

        return view('customer-account', ['activeSection' => 'settings']);
    })->name('settings');

    Route::post('/settings', function (Request $request) {
        if ($redirect = ensureCustomerDashboardAccess()) {
            return $redirect;
        }

        $validated = $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if (!Hash::check($validated['current_password'], $request->user()->password)) {
            return back()
                ->withErrors(['current_password' => 'Current password is incorrect.'])
                ->withInput($request->except(['current_password', 'password', 'password_confirmation']));
        }

        Auth::logoutOtherDevices($validated['current_password']);

        $request->user()->update([
            'password' => $validated['password'],
        ]);

        $request->session()->regenerateToken();

        return redirect()
            ->route('settings')
            ->with('password_success', 'Password updated successfully. You have been signed out of other devices.');
    })->name('settings.password.update');

    Route::post('/dashboard/password', function (Request $request) {
        if (!Auth::check()) {
            abort(403);
        }

        if (!in_array($request->user()->role, ['admin', 'lower_admin', 'content_manager', 'consultant'], true)) {
            abort(403);
        }

        $validated = $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if (!Hash::check($validated['current_password'], $request->user()->password)) {
            return back()
                ->withErrors(['current_password' => 'Current password is incorrect.'])
                ->withInput($request->except(['current_password', 'password', 'password_confirmation']));
        }

        Auth::logoutOtherDevices($validated['current_password']);

        $request->user()->password = $validated['password'];
        $request->user()->save();

        $request->session()->regenerateToken();

        $redirectTo = $request->input('redirect_to');
        if ($redirectTo) {
            return redirect($redirectTo)->with('password_success', 'Password updated successfully. You have been signed out of other devices.');
        }

        return back()->with('password_success', 'Password updated successfully. You have been signed out of other devices.');
    })->name('dashboard.password.update');

    Route::post('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    })->name('logout');
});

Route::get('/auth/google/redirect', function (Request $request) {
    $clientId = config('services.google.client_id');
    $redirectUri = config('services.google.redirect');

    if (!$clientId || !$redirectUri) {
        return redirect()->route('signin')->with('auth_error', 'Google sign-in is not configured.');
    }

    $state = Str::random(40);
    $request->session()->put('google_oauth_state', $state);

    $query = http_build_query([
        'client_id' => $clientId,
        'redirect_uri' => $redirectUri,
        'response_type' => 'code',
        'scope' => 'openid email profile',
        'access_type' => 'offline',
        'prompt' => 'select_account',
        'state' => $state,
    ]);

    return redirect('https://accounts.google.com/o/oauth2/v2/auth?'.$query);
})->name('google.redirect');

Route::get('/auth/google/callback', function (Request $request) {
    $savedState = $request->session()->pull('google_oauth_state');
    $state = (string) $request->query('state', '');
    $code = (string) $request->query('code', '');

    if (!$savedState || !$state || !hash_equals($savedState, $state)) {
        return redirect()->route('signin')->with('auth_error', 'Invalid Google sign-in state.');
    }

    if (!$code) {
        return redirect()->route('signin')->with('auth_error', 'Google sign-in was cancelled.');
    }

    $clientId = config('services.google.client_id');
    $clientSecret = config('services.google.client_secret');
    $redirectUri = config('services.google.redirect');

    $tokenRes = Http::asForm()->post('https://oauth2.googleapis.com/token', [
        'code' => $code,
        'client_id' => $clientId,
        'client_secret' => $clientSecret,
        'redirect_uri' => $redirectUri,
        'grant_type' => 'authorization_code',
    ]);

    if (!$tokenRes->ok()) {
        return redirect()->route('signin')->with('auth_error', 'Unable to verify Google account.');
    }

    $accessToken = (string) data_get($tokenRes->json(), 'access_token', '');
    if (!$accessToken) {
        return redirect()->route('signin')->with('auth_error', 'Missing Google access token.');
    }

    $userRes = Http::withToken($accessToken)->get('https://openidconnect.googleapis.com/v1/userinfo');
    if (!$userRes->ok()) {
        return redirect()->route('signin')->with('auth_error', 'Unable to fetch Google profile.');
    }

    $googleUser = $userRes->json();
    $email = (string) data_get($googleUser, 'email', '');
    $name = trim((string) data_get($googleUser, 'name', 'Google User'));

    if (!$email) {
        return redirect()->route('signin')->with('auth_error', 'Google account email is unavailable.');
    }

    $nameParts = preg_split('/\s+/', $name, 2);
    $firstName = $nameParts[0] ?? 'Google';
    $lastName = $nameParts[1] ?? null;

    $user = User::firstOrCreate(
        ['email' => $email],
        [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'password' => Hash::make(Str::random(32)),
            'role' => 'customer',
        ]
    );

    Auth::login($user, true);

    return redirectUserByRole($user);
})->name('google.callback');

// Backward-compatible redirects for old file-style URLs
Route::redirect('/gemstory.blade.php', '/gemstory', 301);
Route::redirect('/juwelerystory.blade.php', '/juwelerystory', 301);
Route::redirect('/jewellery.php', '/jewellery', 301);
Route::redirect('/gems.php', '/gems', 301);
Route::redirect('/contact.php', '/contact', 301);
Route::redirect('/signin.php', '/signin', 301);
Route::redirect('/signin.blade.php', '/signin', 301);
Route::redirect('/faq.blade.php', '/faq', 301);
Route::redirect('/terms-and-conditions.php', '/terms-and-conditions', 301);
Route::redirect('/privacy-policy.php', '/privacy-policy', 301);
// routes.php
// routes/web.php



Route::middleware(['web'])->group(function () {
    Route::post('/contact-message', [ContactController::class, 'store'])->name('contact-message.store');
});

Route::get('/jewellery', [JewelleryController::class, 'index'])->name('jewellery');
Route::post('/jewellery/filter', [JewelleryController::class, 'filter'])->name('jewellery.filter');


Route::get('/gems', [GemController::class, 'index'])->name('gems');
Route::post('/gems/filter', [GemController::class, 'filter'])->name('gems.filter');

Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::post('/products/{product}/reviews', [ProductController::class, 'storeReview'])
    ->middleware('auth')
    ->name('products.reviews.store');
