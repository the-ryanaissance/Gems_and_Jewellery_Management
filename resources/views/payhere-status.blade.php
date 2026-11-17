<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Payment Status' }}</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            min-height: 100vh;
            display: grid;
            place-items: center;
            font-family: Arial, sans-serif;
            background: linear-gradient(180deg, #fffdf8 0%, #f7efe2 100%);
            color: #2b2118;
        }
        .card {
            width: min(620px, calc(100% - 28px));
            padding: 36px;
            border-radius: 28px;
            background: rgba(255, 255, 255, 0.96);
            border: 1px solid rgba(225, 206, 178, 0.9);
            box-shadow: 0 18px 44px rgba(71, 50, 28, 0.08);
            text-align: center;
        }
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 14px;
            border-radius: 999px;
            font-size: .82rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .08em;
        }
        .badge.success { background: rgba(47, 111, 101, 0.1); color: #2f6f65; }
        .badge.pending { background: rgba(184, 146, 80, 0.14); color: #8a6f50; }
        .badge.cancelled, .badge.failed, .badge.charged_back { background: rgba(179, 56, 56, 0.1); color: #b33838; }
        h1 {
            margin-top: 16px;
            font-size: clamp(2rem, 4vw, 3rem);
            line-height: 1;
        }
        p {
            margin-top: 12px;
            color: #715d49;
            line-height: 1.7;
        }
        .actions {
            margin-top: 24px;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 12px;
        }
        a, button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 180px;
            height: 48px;
            border-radius: 16px;
            border: none;
            font-weight: 800;
            text-decoration: none;
            cursor: pointer;
        }
        .primary { background: linear-gradient(135deg, #2f6f65, #214841); color: #fff; }
        .secondary { border: 1px solid #e6cfaa; background: #fff; color: #755a3c; }
        .meta {
            margin-top: 14px;
            font-size: .9rem;
            color: #8a6f50;
        }
    </style>
</head>
<body>
    <main class="card">
        <span class="badge {{ $state ?? 'pending' }}">{{ $title ?? 'Payment Status' }}</span>
        <h1>{{ $title ?? 'Payment Status' }}</h1>
        <p>{{ $message ?? 'Please wait while we verify your payment.' }}</p>
        <div class="actions">
            @if(($state ?? '') === 'success')
                <button class="primary" type="button" id="clearAndContinue">Continue</button>
            @elseif(($state ?? '') === 'pending')
                <a class="primary" href="{{ $redirectUrl ?? route('checkout') }}">Check Again</a>
                <a class="secondary" href="{{ route('checkout') }}">Back to Checkout</a>
            @else
                <a class="primary" href="{{ $redirectUrl ?? route('checkout') }}">Back to Checkout</a>
            @endif
        </div>
        @if(($state ?? '') === 'pending')
            <p class="meta">This page will refresh automatically in a few seconds.</p>
        @endif
    </main>

    <script>
        (function () {
            const state = @json($state ?? 'pending');
            const redirectUrl = @json($redirectUrl ?? route('home'));
            const clearStorage = @json($clearStorage ?? false);
            const keysToClear = ['pg_cart', 'pg_cart_selected', 'pg_checkout_session', 'pg_checkout_orders'];

            const clearClientStorage = () => {
                keysToClear.forEach((key) => localStorage.removeItem(key));
            };

            const finishSuccess = () => {
                if (clearStorage) {
                    clearClientStorage();
                }
                window.location.href = redirectUrl;
            };

            if (state === 'success') {
                setTimeout(finishSuccess, 1500);
                document.getElementById('clearAndContinue')?.addEventListener('click', finishSuccess);
            }

            if (state === 'pending') {
                setTimeout(() => window.location.reload(), 3000);
            }
        })();
    </script>
</body>
</html>
