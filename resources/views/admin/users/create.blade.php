<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah User | Open Library</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f7f6;
            display: flex;
            justify-content: center;
            padding: 40px;
        }

        .form-container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            color: #b11116;
            margin-bottom: 20px;
            border-bottom: 2px solid #f4f4f4;
            padding-bottom: 10px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            font-size: 14px;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-sizing: border-box;
        }

        .btn-save {
            width: 100%;
            padding: 12px;
            background: #b11116;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            margin-top: 10px;
        }

        .btn-save:hover {
            background: #8e0e12;
        }

        .btn-back {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #666;
            text-decoration: none;
            font-size: 13px;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h2>Tambah Pengguna</h2>
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="name" required placeholder="Contoh: Budi Santoso">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required placeholder="email@example.com">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required placeholder="Minimal 6 karakter">
            </div>
            <div class="form-group">
                <label>Role</label>
                <select name="role">
                    <option value="pengguna">PENGGUNA</option>
                    <option value="admin">ADMIN</option>
                </select>
            </div>
            <button type="submit" class="btn-save">Simpan Pengguna</button>
            <a href="{{ route('admin.users.index') }}" class="btn-back">← Kembali ke Daftar</a>
        </form>
    </div>
</body>

</html>