<?php

namespace App\Http\Controllers;

use App\Models\FaqEntry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FaqEntryController extends Controller
{
    public function index(Request $request): View
    {
        abort_unless(auth()->check() && auth()->user()->hasAdminPermission('manage_content'), 403);

        $entries = FaqEntry::query()
            ->orderBy('group_name')
            ->orderByDesc('updated_at')
            ->get();

        return view('admin-faq-entries', [
            'entries' => $entries,
            'editingEntry' => $request->filled('edit')
                ? FaqEntry::query()->find($request->query('edit'))
                : null,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        abort_unless(auth()->check() && auth()->user()->hasAdminPermission('manage_content'), 403);

        $validated = $request->validate([
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string', 'max:10000'],
            'group_name' => ['required', 'string', 'max:100'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        FaqEntry::create([
            'admin_id' => auth()->id(),
            'question' => $validated['question'],
            'answer' => $validated['answer'],
            'group_name' => $validated['group_name'],
            'is_published' => (bool) ($validated['is_published'] ?? true),
        ]);

        return back()->with('faq_success', 'FAQ saved successfully.');
    }

    public function update(Request $request, FaqEntry $faqEntry): RedirectResponse
    {
        abort_unless(auth()->check() && auth()->user()->hasAdminPermission('manage_content'), 403);

        $validated = $request->validate([
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string', 'max:10000'],
            'group_name' => ['required', 'string', 'max:100'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $faqEntry->fill([
            'question' => $validated['question'],
            'answer' => $validated['answer'],
            'group_name' => $validated['group_name'],
            'is_published' => (bool) ($validated['is_published'] ?? $faqEntry->is_published),
        ]);

        if (!$faqEntry->admin_id) {
            $faqEntry->admin_id = auth()->id();
        }

        $faqEntry->save();

        return back()->with('faq_success', 'FAQ updated successfully.');
    }

    public function destroy(FaqEntry $faqEntry): RedirectResponse
    {
        abort_unless(auth()->check() && auth()->user()->hasAdminPermission('manage_content'), 403);

        $faqEntry->delete();

        return back()->with('faq_success', 'FAQ deleted successfully.');
    }
}
