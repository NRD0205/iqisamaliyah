<!DOCTYPE html>
<html lang="id">

<head>
    <title>Login Amaliyah</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- Menggunakan font Inter yang modern dan bersih -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #1a1a2e;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }

        /* Container yang mensimulasikan layar HP */
        .phone-container {
            background: #ffffff;
            width: 100vw;
            height: 100vh;
            height: 100dvh;
            max-width: 420px;
            padding: 40px 45px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }

        /* Efek melayang untuk layar desktop */
        @media(min-width: 480px) {
            .phone-container {
                height: 800px;
                max-height: 90vh;
                border-radius: 35px;
                box-shadow: 0 0 60px rgba(0, 0, 0, 0.5);
            }
        }

        h1.title {
            text-align: center;
            font-size: 1.35rem;
            font-weight: 600;
            color: #111;
            letter-spacing: 0.5px;
            margin-bottom: 60px;
            margin-top: -30px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        .input-group {
            position: relative;
            display: flex;
            align-items: center;
            border-bottom: 1px solid #cbd5e0;
            padding-bottom: 8px;
            transition: border-color 0.3s;
        }

        .input-group:focus-within {
            border-bottom-color: #111;
        }

        .input-group svg {
            color: #4a5568;
            margin-right: 14px;
            margin-bottom: 2px;
        }

        .input-group input {
            flex: 1;
            border: none;
            outline: none;
            background: transparent;
            font-family: 'Inter', sans-serif;
            font-size: 0.85rem;
            color: #111;
            padding: 2px 0;
        }

        .input-group input::placeholder {
            color: #a0aec0;
            font-weight: 500;
        }

        .register-text {
            text-align: center;
            font-size: 0.72rem;
            color: #4a5568;
            font-weight: 500;
            margin-top: 5px;
            margin-bottom: 35px;
        }

        .register-text a {
            color: #6b46c1;
            text-decoration: none;
            font-weight: 600;
        }

        .register-text a:hover {
            text-decoration: underline;
        }

        .btn-wrapper {
            display: flex;
            justify-content: center;
        }

        button.login-btn {
            background: #111;
            color: #fff;
            border: none;
            padding: 13px 0;
            width: 140px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 1px;
            cursor: pointer;
            transition: transform 0.15s, background 0.2s;
            font-family: 'Inter', sans-serif;
        }

        button.login-btn:active {
            transform: scale(0.96);
            background: #2d3748;
        }

        /* Laravel Error styling */
        .alert {
            background: #fed7d7;
            color: #c53030;
            padding: 12px;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-bottom: 25px;
            text-align: center;
            border: 1px solid #feb2b2;
        }
    </style>
</head>

<body>

    <div class="phone-container">

        @if($errors->any())
            <div class="alert">
                {{ $errors->first() }}
            </div>
        @endif

        <h1 class="title">SIGN IN</h1>

        <form action="/login" method="POST">
            @csrf

            <div class="input-group">
                <!-- Ikon User outline persis gambar -->
                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
                <input type="text" name="nisn" placeholder="NISN" required autocomplete="off">
            </div>

            <div class="input-group">
                <!-- Ikon Lock outline persis gambar -->
                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                </svg>
                <input type="password" name="password" placeholder="Password" required>
            </div>


            <div class="btn-wrapper">
                <button type="submit" class="login-btn">LOGIN</button>
            </div>
        </form>
    </div>

</body>

</html>