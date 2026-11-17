<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In | Pinwntha Gems</title>
    <link rel="icon" type="image/png" href="{{ asset('images/web_logo.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        :root {
            --bg: #8f7b62;
            --panel: #f7f3ee;
            --line: #d8cec0;
            --text: #2d2925;
            --muted: #6f665d;
            --accent: #bfa16a;
            --accent-dark: #a88a55;
        }

        body {
            height: 100vh;
            background: var(--bg);
            display: grid;
            place-items: center;
            padding: 16px;
            color: var(--text);
            overflow: hidden;
        }

        .auth-wrap {
            width: min(980px, 96vw);
            height: min(92vh, 700px);
            background: transparent;
            display: grid;
            grid-template-columns: 1fr 1fr;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.22);
            border: 1px solid rgba(255, 255, 255, 0.25);
        }

        .auth-visual {
            min-height: 0;
            background: linear-gradient(rgba(0, 0, 0, 0.22), rgba(0, 0, 0, 0.26)),
                url('{{ asset('images/main_website/web_j1.jpg') }}') center/cover no-repeat;
            position: relative;
            display: flex;
            align-items: flex-end;
            padding: 34px;
            color: #fff;
        }

        .auth-visual h2 {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .auth-visual p {
            font-size: 1.05rem;
            max-width: 320px;
            line-height: 1.55;
            opacity: 0.92;
        }

        .auth-panel {
            background: var(--panel);
            padding: 30px 34px;
            border-left: 1px solid var(--line);
            position: relative;
            overflow: auto;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-panel::before,
        .auth-panel::after {
            content: "";
            position: absolute;
            border: 1px solid #b9aca0;
            width: 34px;
            height: 34px;
        }

        .auth-panel::before {
            left: 10px;
            top: 10px;
            border-right: none;
            border-bottom: none;
        }

        .auth-panel::after {
            right: 10px;
            bottom: 10px;
            border-left: none;
            border-top: none;
        }

        .form-box {
            display: none;
            animation: fadeIn .25s ease;
            width: min(420px, 100%);
        }

        .form-box.active {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(6px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h1 {
            font-size: clamp(1.7rem, 2vw, 2.1rem);
            margin-bottom: 18px;
            font-weight: 600;
            line-height: 1.25;
            text-align: center;
        }

        .field-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .field {
            width: 100%;
            border: 1px solid #cfc3b6;
            padding: 11px 12px;
            background: #faf8f5;
            color: #2f2a25;
            margin-bottom: 10px;
            outline: none;
        }

        .field:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 2px rgba(191, 161, 106, 0.14);
        }

        .password-wrap {
            position: relative;
            margin-bottom: 10px;
        }

        .password-wrap .field {
            margin-bottom: 0;
            padding-right: 46px;
        }

        .password-toggle {
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            width: 30px;
            height: 30px;
            border: 0;
            border-radius: 50%;
            background: transparent;
            color: #7a6a58;
            cursor: pointer;
            display: grid;
            place-items: center;
        }

        .password-toggle:hover {
            color: var(--accent-dark);
            background: rgba(191, 161, 106, 0.12);
        }

        .main-btn {
            margin-top: 10px;
            width: 100%;
            border: none;
            border-radius: 999px;
            background: var(--accent);
            color: #fff;
            padding: 12px;
            cursor: pointer;
            font-weight: 600;
            transition: 0.2s ease;
        }

        .main-btn:hover {
            background: var(--accent-dark);
        }

        .form-footer {
            margin-top: 14px;
            color: var(--muted);
            font-size: 0.94rem;
            text-align: center;
        }

        .form-footer a {
            color: #584d42;
            font-weight: 600;
            text-decoration: none;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 900px) {
            .auth-wrap {
                grid-template-columns: 1fr;
                height: min(94vh, 760px);
            }

            .auth-visual {
                min-height: 180px;
            }

            .auth-panel {
                align-items: flex-start;
                padding-top: 20px;
            }
        }
    </style>
</head>
<body>
    <main class="auth-wrap">
        <section class="auth-visual" id="authVisual">
            <div>
                <h2 id="heroTitle">Welcome Back</h2>
                <p id="heroText">Sign in to continue shopping premium gemstone and jewellery collections.</p>
            </div>
        </section>

        <section class="auth-panel">
            <div class="form-box active" id="signInBox">
                <form action="{{ route('signin.submit') }}" method="post" novalidate>
                    @csrf
                    <h1>Sign in to your account.</h1>
                    @if (session('auth_success'))
                        <p class="form-footer" style="color:#1b7a34; margin-top:0; margin-bottom:10px; text-align:left;">
                            {{ session('auth_success') }}
                        </p>
                    @endif
                    @if (session('auth_error'))
                        <p class="form-footer" style="color:#b00020; margin-top:0; margin-bottom:10px; text-align:left;">
                            {{ session('auth_error') }}
                        </p>
                    @endif
                    @if ($errors->signin->any())
                        <p class="form-footer" style="color:#b00020; margin-top:0; margin-bottom:10px; text-align:left;">
                            {{ $errors->signin->first() }}
                        </p>
                    @endif
                    <input class="field" type="email" name="email" placeholder="Email address" value="{{ old('email') }}" required>
                    <input class="field" type="password" name="password" placeholder="Password" required>
                    <button class="main-btn" type="submit">Sign in</button>
                    <p class="form-footer">Don't have an account? <a href="#" id="toSignUp">Sign Up</a></p>
                </form>
            </div>

            <div class="form-box" id="signUpBox">
                <form action="{{ route('signup.submit') }}" method="post" novalidate>
                    @csrf
                    <h1>Create your account.</h1>
                    @if ($errors->signup->any())
                        <p class="form-footer" style="color:#b00020; margin-top:0; margin-bottom:10px; text-align:left;">
                            {{ $errors->signup->first() }}
                        </p>
                    @endif
                    <div class="field-row">
                        <input class="field" type="text" name="first_name" placeholder="First name" value="{{ old('first_name') }}" pattern="[A-Za-z\s'-]+" title="First name can only contain letters, spaces, apostrophes, and hyphens." required>
                        <input class="field" type="text" name="last_name" placeholder="Last name" value="{{ old('last_name') }}" pattern="[A-Za-z\s'-]+" title="Last name can only contain letters, spaces, apostrophes, and hyphens.">
                    </div>
                    
                    <select class="field" name="gender" required>
                        <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Select gender</option>
                        <option value="Male" {{ old('gender') === 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender') === 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="Other" {{ old('gender') === 'Other' ? 'selected' : '' }}>Other</option>
                    </select>

                    <input class="field" type="date" name="birth_date" placeholder="Date of Birth" required>
                    <input class="field" type="email" name="email" placeholder="Email address" value="{{ old('email') }}" required>
                    <div class="password-wrap">
                        <input class="field" type="password" name="password" placeholder="Password" required>
                        <button class="password-toggle" type="button" data-password-toggle="password" aria-label="Show password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="password-wrap">
                        <input class="field" type="password" name="password_confirmation" placeholder="Re-enter password" required>
                        <button class="password-toggle" type="button" data-password-toggle="password_confirmation" aria-label="Show password confirmation">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <button class="main-btn" type="submit">Sign up</button>
                    <p class="form-footer">Already have an account? <a href="#" id="toSignIn">Sign In</a></p>
                </form>
            </div>
        </section>
    </main>
    

    <script>
        const signInBox = document.getElementById('signInBox');
        const signUpBox = document.getElementById('signUpBox');
        const toSignUp = document.getElementById('toSignUp');
        const toSignIn = document.getElementById('toSignIn');
        const heroTitle = document.getElementById('heroTitle');
        const heroText = document.getElementById('heroText');
        const authVisual = document.getElementById('authVisual');

        function togglePasswordVisibility(button) {
            if (!button) return;
            const targetName = button.dataset.passwordToggle;
            if (!targetName) return;
            const form = button.closest('form');
            const input = form ? form.querySelector('input[name="' + targetName + '"]') : document.querySelector('input[name="' + targetName + '"]');
            if (!input) return;

            const isHidden = input.type === 'password';
            input.type = isHidden ? 'text' : 'password';
            button.setAttribute('aria-label', isHidden ? 'Hide password' : 'Show password');
            const icon = button.querySelector('i');
            if (icon) {
                icon.className = isHidden ? 'fas fa-eye-slash' : 'fas fa-eye';
            }
        }

        function setMode(mode) {
            const isSignUp = mode === 'signup';
            signInBox.classList.toggle('active', !isSignUp);
            signUpBox.classList.toggle('active', isSignUp);

            if (isSignUp) {
                heroTitle.textContent = 'Join Pinwntha Gems';
                heroText.textContent = 'Create an account to save favorites, track orders, and enjoy a smoother checkout.';
                authVisual.style.backgroundImage = "linear-gradient(rgba(0,0,0,.24), rgba(0,0,0,.28)), url('{{ asset('images/main_website/web_j56.jpeg') }}')";
                history.replaceState(null, '', '{{ url('/signin') }}#signup');
            } else {
                heroTitle.textContent = 'Welcome Back';
                heroText.textContent = 'Sign in to continue shopping premium gemstone and jewellery collections.';
                authVisual.style.backgroundImage = "linear-gradient(rgba(0,0,0,.22), rgba(0,0,0,.26)), url('{{ asset('images/main_website/web_j1.jpg') }}')";
                history.replaceState(null, '', '{{ url('/signin') }}');
            }
        }

        toSignUp.addEventListener('click', (e) => { e.preventDefault(); setMode('signup'); });
        toSignIn.addEventListener('click', (e) => { e.preventDefault(); setMode('signin'); });

        document.querySelectorAll('[data-password-toggle]').forEach((button) => {
            button.addEventListener('click', () => togglePasswordVisibility(button));
        });

        const shouldOpenSignupFromServer = @json(
            old('first_name') !== null ||
            old('last_name') !== null ||
            $errors->signup->any()
        );

        if (shouldOpenSignupFromServer || window.location.hash === '#signup') {
            setMode('signup');
        } else {
            setMode('signin');
        }
    </script>
</body>
</html>
