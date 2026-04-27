<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Ruangan {{ $ruangan->nomor_ruangan }} | OBLIP</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #b11116;
            --secondary: #ef2020ff;
            --bg-body: #f8fafc;
            --white: #ffffff;
            --text-main: #0f172a;
            --text-sub: #64748b;
            --border-color: #e2e8f0;
        }

        * {
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Plus Jakarta Sans', sans-serif;
        }

        body {
            background:var(--bg-body);
            color:var(--text-main);
        }

        nav {
            background:white;
            padding:14px 5%;
            display:flex;
            justify-content:space-between;
            align-items:center;
            border-bottom:1px solid var(--border-color);
        }

        .avatar {
            width:38px;
            height:38px;
            background:linear-gradient(135deg,var(--primary),#ef4444);
            color:white;
            border-radius:10px;
            display:flex;
            align-items:center;
            justify-content:center;
            font-weight:700;
        }

        .btn-logout {
            padding:8px 20px;
            border:1px solid var(--border-color);
            background:white;
            border-radius:10px;
            cursor:pointer;
            font-weight:600;
        }

        .container {
            max-width:1000px;
            margin:40px auto;
            padding:0 24px;
        }

        .header-card {
            background:white;
            padding:30px;
            border-radius:20px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            border:1px solid var(--border-color);
            margin-bottom:30px;
        }

        .btn-back {
            background:#f1f5f9;
            padding:12px 20px;
            border-radius:12px;
            text-decoration:none;
            font-weight:700;
            color:var(--secondary);
        }

        .table-wrapper {
            background:white;
            border-radius:20px;
            overflow:hidden;
            border:1px solid var(--border-color);
        }

        table {
            width:100%;
            border-collapse:collapse;
        }

        th {
            background:#f8fafc;
            padding:18px;
            text-align:left;
            font-size:12px;
            color:var(--text-sub);
        }

        td {
            padding:18px;
            border-bottom:1px solid #f1f5f9;
        }

        tr:last-child td {
            border-bottom:none;
        }

        .status {
            padding:8px 14px;
            border-radius:12px;
            font-size:12px;
            font-weight:700;
            display:inline-flex;
            align-items:center;
            gap:8px;
        }

        .available { background:#ecfdf5; color:#059669; }
        .waiting { background:#fffbeb; color:#d97706; }
        .booked { background:#fef2f2; color:#dc2626; }
        .rejected { background:#fef2f2; color:#b91c1c; }

        .spinner {
            width:14px;
            height:14px;
            border:2px solid #fde68a;
            border-top:2px solid #d97706;
            border-radius:50%;
            animation:spin 1s linear infinite;
        }

        @keyframes spin { to { transform:rotate(360deg); } }

        .btn-book {
            background:var(--secondary);
            color:white;
            padding:10px 18px;
            border:none;
            border-radius:10px;
            font-weight:700;
            cursor:pointer;
            width:100%;
        }

        textarea {
            width:100%;
            padding:8px;
            border-radius:8px;
            border:1px solid var(--border-color);
            margin-bottom:8px;
        }

        .empty {
            text-align:center;
            padding:50px;
            color:var(--text-sub);
            font-style:italic;
        }
    </style>
</head>

<body>

<nav>
    <div style="display:flex;align-items:center;gap:12px">
        <div class="avatar">{{ substr(Auth::user()->name,0,1) }}</div>
        <strong>{{ Auth::user()->name }}</strong>
    </div>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="btn-logout">Logout</button>
    </form>
</nav>

<div class="container">

    <div class="header-card">
        <div>
            <h2>Ruangan {{ $ruangan->nomor_ruangan }}</h2>
            <p>Kapasitas {{ $ruangan->kapasitas }} Mahasiswa</p>
        </div>
        <a href="{{ route('user.home') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
            @forelse($jadwals as $j)
                @php
                    $peminjamans = $j->peminjamans ?? collect();
                    $pending = $peminjamans->where('status', 'pending')->count();
                    $approved = $peminjamans->where('status', 'approved')->count();
                    $rejected = $peminjamans->where('status', 'rejected')->count();
                @endphp
                <tr>
                    <td>{{ \Carbon\Carbon::parse($j->tanggal)->format('d M Y') }}</td>
                    <td>{{ $j->jam_mulai }} - {{ $j->jam_selesai }}</td>

                    <td>
                        @if($approved)
                            <span class="status booked">DIBOOKING</span>
                        @elseif($pending)
                            <span class="status waiting"><span class="spinner"></span> MENUNGGU APPROVAL</span>
                        @elseif($rejected)
                            <span class="status rejected">DITOLAK</span>
                        @else
                            <span class="status available">TERSEDIA</span>
                        @endif
                    </td>

                    <td>
                        @if(!$approved && $pending == 0)
                            <form action="{{ route('booking.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="jadwal_id" value="{{ $j->id }}">
                                <textarea name="keperluan" required placeholder="Keperluan peminjaman"></textarea>
                                <button type="submit" class="btn-book">
                                    @if($rejected)
                                        Booking Ulang
                                    @else
                                        Ajukan Booking
                                    @endif
                                </button>
                            </form>
                        @elseif($pending)
                            <small style="font-weight:600;color:#92400e;">Diproses Admin</small>
                        @elseif($approved)
                            <small style="color:#059669;">Booking Berhasil</small>
                        @elseif($rejected)
                            <small style="color:#b91c1c;">Booking Ditolak</small>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="empty">Belum ada jadwal untuk ruangan ini</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

</div>

</body>
</html>
