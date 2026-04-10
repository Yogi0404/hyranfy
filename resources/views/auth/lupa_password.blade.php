<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(180deg, #6F92C0 0%, #34455A 100%);
        }

        .forgot-container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 14px;
            padding: 40px 35px;
            width: 360px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.2);
            text-align: center;
        }

        .forgot-container h2 {
            font-size: 22px;
            font-weight: 600;
            color: #2E3A59;
            margin-bottom: 25px;
        }

        .form-group {
            text-align: left;
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-size: 14px;
            color: #2E3A59;
            margin-bottom: 6px;
        }

        input {
            width: 100%;
            padding: 10px;
            border-radius: 10px;
            border: none;
            background-color: #E9EBEF;
            font-size: 14px;
            color: #333;
        }

        input::placeholder {
            color: #888;
        }

        input:focus {
            outline: none;
            background-color: #f5f7fa;
            box-shadow: 0 0 0 2px rgba(59,130,246,0.3);
        }

        button {
            width: 100%;
            background: linear-gradient(180deg, #4472C4 0%, #0E1E3A 100%);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 11px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-top: 10px;
        }

        button:hover {
            opacity: 0.9;
        }

        .alert {
            font-size: 13px;
            margin-bottom: 10px;
            text-align: center;
        }

        .alert.error {
            color: red;
        }

        .alert.success {
            color: green;
        }
    </style>
</head>
<body>
    <div class="forgot-container">
        <h2>Lupa Password</h2>

        @if(session('error'))
            <p class="alert error">{{ session('error') }}</p>
        @endif

        @if(session('success'))
            <p class="alert success">{{ session('success') }}</p>
        @endif

        <form action="{{ route('password.reset.post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Masukkan username" required>
            </div>

            <div class="form-group">
                <label>Password Baru</label>
                <input type="password" name="password" placeholder="Masukkan password baru" required>
            </div>

            <div class="form-group">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" placeholder="Konfirmasi password" required>
            </div>

            <button type="submit">Simpan</button>
        </form>
    </div>
</body>
</html>
