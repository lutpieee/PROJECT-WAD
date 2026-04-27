<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jadwal | Open Library</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-red: #b11116;
            --primary-hover: #8e0e12;
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
            max-width: 500px;
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
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }

        input, select {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            border: 1.5px solid #eee;
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
                <h2>Edit Jadwal Ruangan</h2>
            </div>

            <form action="{{ route('admin.jadwal.update', $jadwal->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Ruangan</label>
                    <select name="ruangan_id" required>
                        @foreach($ruangans as $ruangan)
                            <option value="{{ $ruangan->id }}"
                                {{ $jadwal->ruangan_id == $ruangan->id ? 'selected' : '' }}>
                                {{ $ruangan->nomor_ruangan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" value="{{ $jadwal->tanggal }}" required>
                </div>

                <div class="form-group">
                    <label>Jam Mulai</label>
                    <input type="time" name="jam_mulai" value="{{ $jadwal->jam_mulai }}" required>
                </div>

                <div class="form-group">
                    <label>Jam Selesai</label>
                    <input type="time" name="jam_selesai" value="{{ $jadwal->jam_selesai }}" required>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" required>
                        <option value="available" {{ $jadwal->status == 'available' ? 'selected' : '' }}>Available</option>
                        <option value="booked" {{ $jadwal->status == 'booked' ? 'selected' : '' }}>Booked</option>
                        <option value="blocked" {{ $jadwal->status == 'blocked' ? 'selected' : '' }}>Blocked</option>
                    </select>
                </div>

                <div class="btn-container">
                    <button class="btn-save">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>

                    <a href="{{ route('admin.jadwal.index') }}" class="btn-cancel">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </main>
</div>
</body>
</html>
