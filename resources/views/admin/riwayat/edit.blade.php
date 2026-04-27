<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Status Peminjaman | Open Library</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-red: #b11116;
            --bg-light: #f4f6f8;
            --text-dark: #333;
        }

        * {
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            margin: 0;
            background: var(--bg-light);
        }

        .admin-container {
            display: flex;
            min-height: 100vh;
        }

        .main-content {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
        }

        .form-card {
            background: white;
            max-width: 520px;
            width: 100%;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,.1);
        }

        .form-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-header h2 {
            margin: 0;
            color: var(--primary-red);
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 500;
        }

        input, textarea, select {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            border: 1.5px solid #eee;
            background: #f9f9f9;
        }

        input[readonly], textarea[readonly] {
            cursor: not-allowed;
        }

        .btn-container {
            margin-top: 30px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .btn-save {
            background: var(--primary-red);
            color: white;
            padding: 12px;
            border-radius: 10px;
            border: none;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-cancel {
            background: #eee;
            color: #666;
            padding: 12px;
            border-radius: 10px;
            text-align: center;
            text-decoration: none;
        }
    </style>
</head>

<body>
<div class="admin-container">

    @includeIf('admin.partials.sidebar')

    <main class="main-content">
        <div class="form-card">
            <div class="form-header">
                <h2>Approval Peminjaman</h2>
            </div>

            <form action="{{ route('admin.riwayat.update', $peminjaman->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Nama Peminjam</label>
                    <input type="text" value="{{ $peminjaman->user->name }}" readonly>
                </div>

                <div class="form-group">
                    <label>Ruangan</label>
                    <input type="text" value="{{ $peminjaman->jadwal->ruangan->nama_ruangan }}" readonly>
                </div>

                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="text" value="{{ $peminjaman->jadwal->tanggal }}" readonly>
                </div>

                <div class="form-group">
                    <label>Waktu</label>
                    <input type="text"
                        value="{{ $peminjaman->jadwal->jam_mulai }} - {{ $peminjaman->jadwal->jam_selesai }}"
                        readonly>
                </div>

                <div class="form-group">
                    <label>Keperluan</label>
                    <textarea rows="3" readonly>{{ $peminjaman->keperluan }}</textarea>
                </div>

                <div class="form-group">
                    <label>Status Peminjaman</label>
                    <select name="status" required>
                        <option value="pending" {{ $peminjaman->status == 'pending' ? 'selected' : '' }}>
                            Pending
                        </option>
                        <option value="approved" {{ $peminjaman->status == 'approved' ? 'selected' : '' }}>
                            Approved
                        </option>
                        <option value="rejected" {{ $peminjaman->status == 'rejected' ? 'selected' : '' }}>
                            Rejected
                        </option>
                    </select>
                </div>

                <div class="btn-container">
                    <button class="btn-save">
                        <i class="fas fa-save"></i> Simpan Keputusan
                    </button>
                    <a href="{{ route('admin.riwayat.index') }}" class="btn-cancel">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </main>
</div>
</body>
</html>