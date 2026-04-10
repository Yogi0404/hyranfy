<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Absensi Karyawan</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(180deg, #6F92C0 0%, #34455A 100%);
        }
        .login-container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 14px;
            padding: 45px 35px;
            width: 360px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.2);
            text-align: center;
        }
        h2 { font-size: 22px; color: #2E3A59; margin-bottom: 30px; }
        .form-group { text-align: left; margin-bottom: 15px; }
        label { display: block; font-size: 14px; color: #2E3A59; margin-bottom: 5px; }
        input {
            width: 100%; padding: 10px; border-radius: 10px; border: none;
            background-color: #E9EBEF; font-size: 14px; color: #333;
        }
        input:focus { outline: none; background-color: #f5f7fa; box-shadow: 0 0 0 2px rgba(59,130,246,0.3); }
        .forgot { text-align: left; margin-bottom: 20px; }
        .forgot a { font-size: 13px; color: #3B82F6; text-decoration: none; }
        button {
            width: 100%; background: linear-gradient(180deg, #4472C4 0%, #0E1E3A 100%);
            color: white; border: none; border-radius: 10px; padding: 11px;
            font-size: 15px; font-weight: 600; cursor: pointer; transition: all 0.2s ease;
        }
        button:hover { opacity: 0.9; }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>

        @if(session('error'))
            <p style="color: red; font-size: 14px;">{{ session('error') }}</p>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Username atau Email</label>
                <input type="text" name="email" placeholder="Masukkan username atau email" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Masukkan password" required>
            </div>
            <div class="forgot">
                <a href="{{ route('lupa_password') }}">Lupa Password?</a>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
