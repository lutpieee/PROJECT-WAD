<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Open Library Telkom University</title>

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
            background-image: radial-gradient(circle at top right, #f8f9fa, #e9ecef);
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

        .brand-header {
            margin-bottom: 20px;
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
            font-style: italic;
            margin-left: 5px;
        }

        .register-box {
            background: #ffffff;
            width: 100%;
            max-width: 450px;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
            border: none;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .icon-circle {
            width: 60px;
            height: 60px;
            background: rgba(177, 17, 22, 0.1);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 15px;
        }

        .header h2 {
            color: #2d3436;
            font-size: 1.6rem;
            font-weight: 600;
        }

        .header p {
            color: #636e72;
            font-size: 0.9rem;
        }

        .input-group {
            margin-bottom: 18px;
        }

        .input-group label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: #b11116;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #f1f3f5;
            border-radius: 12px;
            background: #f8f9fa;
            font-size: 0.95rem;
            transition: all 0.25s ease;
        }

        input:focus {
            outline: none;
            border-color: #b11116;
            background: #fff;
            box-shadow: 0 4px 12px rgba(177, 17, 22, 0.08);
        }

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
            margin-top: 10px;
            transition: all 0.3s ease;
        }

        button:hover {
            background: #8e0e12;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(177, 17, 22, 0.2);
        }

        .footer-link {
            margin-top: 25px;
            text-align: center;
            font-size: 0.9rem;
            color: #636e72;
        }

        .footer-link a {
            color: #b11116;
            text-decoration: none;
            font-weight: 600;
        }

        .footer-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .brand-header h1 {
                font-size: 1.6rem;
            }
        }
    </style>
</head>

<body>

    <div class="main-wrapper">
        <div class="brand-header">
            <h1>Open Library <span>Telkom University</span></h1>
        </div>

        <div class="register-box">
            <div class="header">
                <div class="icon-circle">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#b11116" viewBox="0 0 256 256">
                        <path
                            d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24ZM74.08,197.5a64,64,0,0,1,107.84,0,87.83,87.83,0,0,1-107.84,0ZM190.44,184.58a80,80,0,0,0-124.88,0,88,88,0,1,1,124.88,0ZM128,80a32,32,0,1,0,32,32A32,32,0,0,0,128,80Zm0,48a16,16,0,1,1,16-16A16,16,0,0,1,128,128Z">
                        </path>
                    </svg>
                </div>
                <h2>Buat Akun Baru</h2>
                <p>Bergabunglah untuk menggunakan fasilitas oblip</p>
            </div>

            <form action="{{ route('register.process') }}" method="POST">
                @csrf

                <div class="input-group">
                    <label>Nama Lengkap</label>
                    <input name="name" type="text" placeholder="Masukkan nama lengkap" value="{{ old('name') }}"
                        required>
                    @error('name')
                        <small
                            style="color: #b11116; font-size: 0.75rem; margin-top: 5px; display: block;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="input-group">
                    <label>Email Institusi</label>
                    <input name="email" type="email" placeholder="nama@telkomuniversity.ac.id"
                        value="{{ old('email') }}" required>
                    @error('email')
                        <small
                            style="color: #b11116; font-size: 0.75rem; margin-top: 5px; display: block;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="input-group">
                    <label>Password</label>
                    <input name="password" type="password" placeholder="Min. 6 karakter" required>
                    @error('password')
                        <small
                            style="color: #b11116; font-size: 0.75rem; margin-top: 5px; display: block;">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit">DAFTAR SEKARANG</button>
            </form>

            <div class="footer-link">
                <p>Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a></p>
            </div>
        </div>
    </div>

</body>

</html>