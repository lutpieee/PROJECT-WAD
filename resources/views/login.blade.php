<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Open Library Telkom University</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        /* CSS yang Anda berikan */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #f8f9fa;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .main-wrapper {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        /* Judul Branding di luar Card */
        .brand-header {
            margin-bottom: 30px;
            text-align: center;
        }

        .brand-header h1 {
            font-size: 2.2rem;
            color: #333;
            font-weight: 700;
            letter-spacing: -1px;
        }

        .brand-header h1 span {
            color: #b11116;
            /* Merah khas Telkom */
            font-style: italic;
        }

        /* Kotak Login */
        .login-box {
            background: #ffffff;
            width: 100%;
            max-width: 400px;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h2 {
            font-size: 1.6rem;
            font-weight: 600;
            color: #2d3436;
            margin-bottom: 5px;
        }

        .header p {
            color: #636e72;
            font-size: 0.9rem;
        }

        /* Form Styling */
        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: #444;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 14px;
            border: 1.5px solid #eee;
            border-radius: 12px;
            background: #fdfdfd;
            font-size: 0.9rem;
            transition: 0.3s;
        }

        input:focus {
            outline: none;
            border-color: #b11116;
            background: #fff;
            box-shadow: 0 4px 12px rgba(177, 17, 22, 0.05);
        }

        /* Tombol Login */
        button {
            width: 100%;
            padding: 15px;
            background: #b11116;
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
        }

        button:hover {
            background: #8e0e12;
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(177, 17, 22, 0.2);
        }

        /* Pesan Alert Error/Sukses */
        .alert {
            padding: 12px;
            border-radius: 10px;
            font-size: 0.85rem;
            margin-bottom: 20px;
            text-align: center;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* Footer Link & Copyright */
        .footer-link {
            margin-top: 25px;
            text-align: center;
            font-size: 0.9rem;
        }

        .footer-link a {
            color: #b11116;
            text-decoration: none;
            font-weight: 600;
        }

        .footer-link a:hover {
            text-decoration: underline;
        }

        .copyright {
            margin-top: 20px;
            color: #bbb;
            font-size: 0.75rem;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="main-wrapper">
        <div class="brand-header">
            <h1>Open Library <span>Telkom University</span></h1>
        </div>

        <div class="login-box">
            <div class="header">
                <h2>Selamat Datang</h2>
                <p>Silakan masuk ke akun Anda</p>
            </div>

            {{-- Pesan Sukses setelah Register --}}
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Pesan Error jika Login Gagal --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login.process') }}" method="POST">
                @csrf

                <div class="input-group">
                    <label>Email Institusi</label>
                    <input type="email" name="email" placeholder="nama@telkomuniversity.ac.id"
                        value="{{ old('email') }}" required>
                </div>

                <div class="input-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Masukkan password" required>
                </div>

                <button type="submit">MASUK SEKARANG</button>
            </form>

            <div class="footer-link">
                <p>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
            </div>

            <div class="copyright">
                &copy; {{ date('Y') }} Telkom University Open Library
            </div>
        </div>
    </div>

</body>

</html>