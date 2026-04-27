<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna | Open Library</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-red: #b11116;
            --primary-hover: #8e0e12;
            --bg-light: #f8f9fa;
            --text-dark: #333;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg-light);
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: var(--text-dark);
        }

        .form-card {
            background: white;
            width: 100%;
            max-width: 500px;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .form-header {
            margin-bottom: 30px;
            text-align: center;
        }

        .form-header h2 {
            margin: 0;
            color: var(--primary-red);
            font-weight: 600;
        }

        .form-header p {
            color: #777;
            font-size: 14px;
            margin-top: 5px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            font-size: 14px;
        }

        input,
        select {
            width: 100%;
            padding: 12px 15px;
            border: 1.5px solid #eee;
            border-radius: 10px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: var(--primary-red);
            box-shadow: 0 0 0 4px rgba(177, 17, 22, 0.1);
        }

        .btn-container {
            margin-top: 30px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .btn {
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            font-size: 15px;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-update {
            background: var(--primary-red);
            color: white;
        }

        .btn-update:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
        }

        .btn-cancel {
            background: #f1f1f1;
            color: #666;
        }

        .btn-cancel:hover {
            background: #e5e5e5;
        }

        .alert-error {
            background: #fff5f5;
            color: #c0392b;
            padding: 10px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
            border-left: 4px solid #c0392b;
        }
    </style>
</head>

<body>

    <div class="form-card">
        <div class="form-header">
            <h2>Edit Pengguna</h2>
            <p>Perbarui informasi akun <strong>{{ $user->name }}</strong></p>
        </div>

        @if ($errors->any())
            <div class="alert-error">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="form-group">
                <label for="email">Alamat Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="form-group">
                <label for="role">Role Pengguna</label>
                <select name="role" id="role">
                    <option value="pengguna" {{ $user->role == 'pengguna' ? 'selected' : '' }}>PENGGUNA</option>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>ADMIN</option>
                </select>
            </div>

            <div class="btn-container">
                <button type="submit" class="btn btn-update">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-cancel">Batal</a>
            </div>
        </form>
    </div>

</body>

</html>