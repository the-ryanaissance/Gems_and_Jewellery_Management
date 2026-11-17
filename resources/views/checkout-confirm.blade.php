<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Payment | Piyumatha Gems & Jewellery</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            min-height: 100vh;
            font-family: 'Manrope', sans-serif;
            color: #261d16;
            background: linear-gradient(180deg, #fffdf8 0%, #f7efea 100%);
            display: grid;
            place-items: center;
            padding: 24px;
        }
        .confirm-card {
            width: min(720px, 100%);
            background: #fff;
            border: 1px solid #eadbc6;
            border-radius: 28px;
            box-shadow: 0 18px 44px rgba(71, 50, 28, 0.08);
            overflow: hidden;
        }
        .confirm-hero {
            padding: 28px 30px;
            background: linear-gradient(135deg, #fff9f1, #f8eddc);
            border-bottom: 1px solid #eadbc6;
        }
        .eyebrow {
            display: inline-flex;
            padding: 8px 12px;
            border-radius: 999px;
            background: rgba(47, 111, 101, 0.1);
            color: #2f6f65;
            font-size: .8rem;
            font-weight: 800;
            letter-spacing: .08em;
            text-transform: uppercase;
        }
        h1 {
            margin-top: 14px;
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(2.2rem, 5vw, 3.4rem);
            line-height: .95;
            color: #2b2118;
        }
        .confirm-body { padding: 26px 30px 30px; display: grid; gap: 22px; }
        .summary-grid { display: grid; gap: 12px; }
        .summary-row { display: flex; justify-content: space-between; gap: 12px; padding: 14px 16px; border-radius: 16px; background: #fffaf3; border: 1px solid #efdfca; }
        .summary-row span { color: #7c6650; }
        .summary-row strong { color: #2b2118; }
        .summary-items { display: grid; gap: 12px; }
        .summary-item { display: grid; grid-template-columns: 68px 1fr auto; gap: 12px; align-items: center; padding: 14px; border-radius: 18px; background: #fff; border: 1px solid #efe1ce; }
        .summary-item img { width: 68px; height: 68px; object-fit: cover; border-radius: 16px; }
        .summary-item strong { display: block; color: #2b2118; }
        .summary-item span { display: block; margin-top: 4px; color: #7c6650; font-size: .92rem; line-height: 1.5; }
        .summary-item em { font-style: normal; color: #214841; font-weight: 800; white-space: nowrap; }
        .flash {
            padding: 14px 16px;
            border-radius: 16px;
            border: 1px solid #e7c98f;
            background: linear-gradient(135deg, #fff7e7, #fff1d7);
            color: #7c5b22;
            line-height: 1.65;
        }
        .flash.error {
            border-color: #f0c1c1;
            background: linear-gradient(135deg, #fff5f5, #ffecec);
            color: #a33;
        }
        .notice {
            padding: 14px 16px;
            border-radius: 16px;
            border: 1px solid #e7c98f;
            background: linear-gradient(135deg, #fff7e7, #fff1d7);
            color: #7c5b22;
            line-height: 1.65;
        }
        .notice strong { display: block; margin-bottom: 4px; color: #6a4710; }
        .actions { display: flex; justify-content: space-between; gap: 12px; flex-wrap: wrap; }
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 160px;
            height: 50px;
            padding: 0 18px;
            border-radius: 16px;
            border: none;
            font-weight: 800;
            cursor: pointer;
            text-decoration: none;
        }
        .btn.primary { background: linear-gradient(135deg, #2f6f65, #214841); color: #fff; }
        .btn.secondary { background: #fff; color: #755a3c; border: 1px solid #e6cfaa; }
        .status { min-height: 22px; color: #b33838; font-size: .92rem; text-align: center; }
        .gateway-panel {
            padding: 18px;
            border-radius: 20px;
            border: 1px solid #eadbc6;
            background: linear-gradient(180deg, #fffdf9 0%, #fff8ee 100%);
            display: none;
            gap: 14px;
        }
        .gateway-panel.show { display: grid; }
        .gateway-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }
        .gateway-head strong {
            font-size: 1.05rem;
            color: #2b2118;
        }
        .gateway-head span {
            color: #7c6650;
            font-size: .92rem;
        }
        .gateway-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }
        .gateway-field {
            display: grid;
            gap: 8px;
        }
        .gateway-field.full {
            grid-column: 1 / -1;
        }
        .gateway-field label {
            font-size: .88rem;
            font-weight: 700;
            color: #4c3b2a;
        }
        .gateway-field input {
            width: 100%;
            border: 1px solid #e6cfaa;
            border-radius: 14px;
            background: #fff;
            color: #2d241c;
            padding: 13px 14px;
            font: inherit;
            outline: none;
        }
        .gateway-field input:focus {
            border-color: #b89250;
            box-shadow: 0 0 0 4px rgba(184, 146, 80, 0.12);
        }
        .gateway-note {
            color: #7c5b22;
            background: #fff7e7;
            border: 1px solid #e7c98f;
            padding: 12px 14px;
            border-radius: 16px;
            line-height: 1.6;
            font-size: .92rem;
        }
        .bank-details {
            display: grid;
            gap: 12px;
            padding: 18px;
            border-radius: 20px;
            border: 1px solid #e7c98f;
            background: linear-gradient(180deg, #fffdf7 0%, #fff8ea 100%);
        }
        .bank-details h2 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.7rem;
            color: #2b2118;
        }
        .bank-detail-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }
        .bank-detail {
            padding: 14px 16px;
            border-radius: 16px;
            background: #fff;
            border: 1px solid #efdfca;
        }
        .bank-detail span {
            display: block;
            color: #8b7150;
            font-size: .8rem;
            text-transform: uppercase;
            letter-spacing: .06em;
        }
        .bank-detail strong {
            display: block;
            margin-top: 6px;
            color: #2d241b;
            line-height: 1.5;
            word-break: break-word;
        }
        .receipt-upload {
            display: grid;
            gap: 10px;
        }
        .receipt-meta {
            color: #7c6650;
            font-size: .92rem;
            line-height: 1.6;
        }
        .gateway-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            flex-wrap: wrap;
        }
        .processing {
            display: none;
            align-items: center;
            gap: 10px;
            color: #2f6f65;
            font-weight: 700;
            font-size: .92rem;
        }
        .processing.show { display: inline-flex; }
        .spinner {
            width: 18px;
            height: 18px;
            border: 2px solid rgba(47, 111, 101, 0.2);
            border-top-color: #2f6f65;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
        @media (max-width: 640px) {
            .confirm-hero, .confirm-body { padding-left: 20px; padding-right: 20px; }
            .summary-item { grid-template-columns: 56px 1fr; }
            .summary-item em { grid-column: 2; }
            .actions { flex-direction: column; }
            .btn { width: 100%; }
            .gateway-grid { grid-template-columns: 1fr; }
            .bank-detail-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <main class="confirm-card">
        <section class="confirm-hero">
            <span class="eyebrow">{{ !empty($quotationCheckout) ? 'Custom Quotation' : 'Confirm Payment' }}</span>
            <h1>{{ !empty($quotationCheckout) ? 'Review and Pay Quotation' : 'Review and Pay' }}</h1>
        </section>

        <section class="confirm-body">
            @if ($errors->any())
                <div class="flash error">
                    {{ $errors->first() }}
                </div>
            @endif

            @if (!empty($quotationCheckout) && !empty($pickupOnly))
                <div class="notice">
                    <strong>Pickup only applies to this quotation</strong>
                    This quotation is above Rs 40,000, so only 20% is payable now. The remaining balance will be collected at pickup, and shipping has been set to Rs 0.
                </div>
            @elseif (!empty($quotationCheckout))
                <div class="notice">
                    <strong>Quotation payment</strong>
                    This payment will confirm your custom jewellery quotation and continue the normal checkout flow.
                </div>
            @endif

            <div class="summary-items">
                @foreach ($items as $item)
                    <article class="summary-item">
                        <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}">
                        <div>
                            <strong>{{ $item['name'] }}</strong>
                            @if (!empty($item['size_value']))
                                <span>{{ $item['size_label'] ?: 'Size' }}: {{ $item['size_value'] }}</span>
                            @endif
                            <span>Qty: {{ $item['quantity'] }}</span>
                        </div>
                        <em>Rs {{ number_format(((float) $item['price']) * ((int) $item['quantity']), 0) }}</em>
                    </article>
                @endforeach
            </div>

                <div class="summary-grid">
                <div class="summary-row"><span>Subtotal</span><strong>Rs {{ number_format($subtotal, 0) }}</strong></div>
                <div class="summary-row"><span>Shipping</span><strong>Rs {{ number_format($shippingCost, 0) }}</strong></div>
                @if (!empty($pickupOnly))
                    <div class="summary-row"><span>Paid Amount</span><strong>Rs {{ number_format($depositAmount, 0) }}</strong></div>
                    <div class="summary-row"><span>Amount Left to Pay</span><strong>Rs {{ number_format($balanceDue, 0) }}</strong></div>
                @endif
                <div class="summary-row"><span>{{ !empty($quotationCheckout) ? 'Quotation Total' : 'Total' }}</span><strong>Rs {{ number_format($total, 0) }}</strong></div>
            </div>

            @if ((string) $paymentMethod === 'bank')
                <div class="bank-details">
                    <h2>Bank Transfer Details</h2>
                    <div class="gateway-note">Please transfer the amount to the bank account below, then upload the receipt to confirm your order.</div>
                    <div class="bank-detail-grid">
                        <div class="bank-detail">
                            <span>Bank Name</span>
                            <strong>Commercial Bank</strong>
                        </div>
                        <div class="bank-detail">
                            <span>Account Name</span>
                            <strong>K.C. Pinwantha</strong>
                        </div>
                        <div class="bank-detail">
                            <span>Account Number</span>
                            <strong>8000056547</strong>
                        </div>
                        <div class="bank-detail">
                            <span>Branch</span>
                            <strong>Ratnapura Branch</strong>
                        </div>
                    </div>
                    <div class="receipt-upload">
                        <div class="receipt-meta">Use your order name or order number as the payment reference. The uploaded receipt will be saved with the order for admin review.</div>
                    </div>
                </div>
            @else
                <div class="gateway-panel show" id="mockGateway">
                    <div class="gateway-head">
                        <div>
                            <strong>Payment Gateway</strong>
                            
                        </div>
                        <span class="eyebrow" style="background: rgba(184, 146, 80, 0.12); color: #8a6f50;">{{ strtoupper($paymentMethod ?? 'card') }} PAYMENT</span>
                    </div>

                    <div class="gateway-note">
                        {{ !empty($pickupOnly) ? 'This is a simulated 20% deposit payment flow for pickup-only orders.' : 'Enter any demo card details to simulate a successful card payment.' }}
                    </div>

                    <div class="gateway-grid">
                        <div class="gateway-field full">
                            <label for="mockCardName">Cardholder Name</label>
                            <input id="mockCardName" type="text" placeholder="Name on card" autocomplete="cc-name">
                        </div>
                        <div class="gateway-field full">
                            <label for="mockCardNumber">Card Number</label>
                            <input id="mockCardNumber" type="text" inputmode="numeric" maxlength="19" placeholder="4242 4242 4242 4242" autocomplete="cc-number">
                        </div>
                        <div class="gateway-field">
                            <label for="mockCardExpiry">Expiry</label>
                        <input id="mockCardExpiry" type="text" placeholder="MM / YY" maxlength="7" autocomplete="cc-exp">
                        </div>
                        <div class="gateway-field">
                            <label for="mockCardCvv">CVV</label>
                            <input id="mockCardCvv" type="password" placeholder="123" maxlength="4" autocomplete="cc-csc">
                        </div>
                    </div>

                    <div class="processing" id="gatewayProcessing">
                        <span class="spinner"></span>
                        <span>Processing secure demo payment...</span>
                    </div>
                </div>
            @endif

            <form class="actions" method="POST" action="{{ route('checkout.complete') }}" id="checkoutPayForm" enctype="multipart/form-data">
                @csrf
                <a href="{{ route('checkout') }}" class="btn secondary">Back</a>
                @if ((string) $paymentMethod === 'bank')
                    <input type="file" name="receipt_image" id="bankReceiptInput" accept="image/*" hidden>
                    <button type="button" class="btn primary" id="uploadReceiptButton">Upload Receipt</button>
                @else
                    <button type="submit" class="btn primary" id="payButton">{{ !empty($quotationCheckout) ? 'Pay Quotation' : (!empty($pickupOnly) ? 'Pay 20% Deposit' : 'Pay') }}</button>
                @endif
            </form>
            <div class="status" id="gatewayStatus"></div>
        </section>
    </main>

    <script>
        (function () {
            const paymentMethod = @json($paymentMethod ?? 'card');
            const gatewayPanel = document.getElementById('mockGateway');
            const payForm = document.getElementById('checkoutPayForm');
            const payButton = document.getElementById('payButton');
            const uploadReceiptButton = document.getElementById('uploadReceiptButton');
            const bankReceiptInput = document.getElementById('bankReceiptInput');
            const gatewayProcessing = document.getElementById('gatewayProcessing');
            const gatewayStatus = document.getElementById('gatewayStatus');
            const cardName = document.getElementById('mockCardName');
            const cardNumber = document.getElementById('mockCardNumber');
            const cardExpiry = document.getElementById('mockCardExpiry');
            const cardCvv = document.getElementById('mockCardCvv');

            const normalizeDigits = (value) => String(value || '').replace(/\D/g, '');
            const showStatus = (message, isError = false) => {
                if (!gatewayStatus) return;
                gatewayStatus.textContent = message || '';
                gatewayStatus.style.color = isError ? '#b33838' : '#2f6f65';
            };

            if (paymentMethod === 'card') {
                if (!gatewayPanel || !payForm || !payButton) {
                    return;
                }

                cardNumber?.addEventListener('input', () => {
                    const digits = normalizeDigits(cardNumber.value).slice(0, 16);
                    cardNumber.value = digits.replace(/(\d{4})(?=\d)/g, '$1 ');
                });

            cardExpiry?.addEventListener('input', () => {
                const digits = normalizeDigits(cardExpiry.value).slice(0, 4);
                cardExpiry.value = digits.length > 2 ? `${digits.slice(0, 2)} / ${digits.slice(2)}` : digits;
            });

                cardCvv?.addEventListener('input', () => {
                    cardCvv.value = normalizeDigits(cardCvv.value).slice(0, 4);
                });

                const validateGateway = () => {
                    const name = String(cardName?.value || '').trim();
                    const number = normalizeDigits(cardNumber?.value || '');
                    const expiry = String(cardExpiry?.value || '').trim();
                    const cvv = String(cardCvv?.value || '').trim();

                    if (name.length < 3) {
                        showStatus('Please enter the cardholder name.', true);
                        return false;
                    }
                    if (number.length < 12) {
                        showStatus('Please enter a valid demo card number.', true);
                        return false;
                    }
                    if (!/^\d{2}\s*\/\s*\d{2}$/.test(expiry)) {
                        showStatus('Please enter the expiry in MM / YY format.', true);
                        return false;
                    }
                    if (cvv.length < 3) {
                        showStatus('Please enter a valid CVV.', true);
                        return false;
                    }

                    showStatus('');
                    return true;
                };

                payForm.addEventListener('submit', async (event) => {
                    event.preventDefault();

                    if (!validateGateway()) {
                        return;
                    }

                    payButton.disabled = true;
                    payButton.textContent = 'Processing...';
                    gatewayProcessing?.classList.add('show');
                    showStatus('Authorizing demo payment...');

                    window.setTimeout(() => {
                        payForm.submit();
                    }, 1400);
                });
                return;
            }

            if (paymentMethod === 'bank') {
                if (!payForm || !uploadReceiptButton || !bankReceiptInput) {
                    return;
                }

                uploadReceiptButton.addEventListener('click', () => {
                    bankReceiptInput.click();
                });

                bankReceiptInput.addEventListener('change', () => {
                    const file = bankReceiptInput.files && bankReceiptInput.files[0] ? bankReceiptInput.files[0] : null;
                    if (!file) {
                        showStatus('Please select a receipt image.', true);
                        return;
                    }

                    showStatus(`Receipt selected: ${file.name}`);
                    uploadReceiptButton.disabled = true;
                    uploadReceiptButton.textContent = 'Uploading...';
                    gatewayProcessing?.classList.add('show');

                    window.setTimeout(() => {
                        payForm.submit();
                    }, 900);
                });
            }
        })();
    </script>
</body>
</html>
