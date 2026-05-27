<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Peminjaman Saya | OBLIP</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #b11116;
            --secondary: #ef2020;
            --bg-body: #f8fafc;
            --white: #ffffff;
            --text-main: #0f172a;
            --text-sub: #64748b;
            --border-color: #e2e8f0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background: var(--bg-body);
            color: var(--text-main);
        }

        nav {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            padding: 14px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border-color);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary), #ef4444);
            color: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
        }

        .brand {
            font-size: 1.45rem;
            font-weight: 800;
            color: var(--secondary);
            letter-spacing: -1px;
        }

        .brand span {
            color: var(--primary);
            font-weight: 400;
        }

        .btn-logout {
            padding: 8px 20px;
            border: 1.5px solid var(--border-color);
            color: var(--text-sub);
            background: var(--white);
            border-radius: 10px;
            font-weight: 700;
            cursor: pointer;
        }

        .container {
            max-width: 1120px;
            margin: 40px auto;
            padding: 0 24px;
        }

        .page-header {
            background: var(--white);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 24px;
        }

        .page-header h2 {
            font-size: 1.6rem;
            font-weight: 800;
            letter-spacing: -0.6px;
        }

        .page-header p {
            color: var(--text-sub);
            margin-top: 4px;
        }

        .btn-back {
            background: #f1f5f9;
            color: var(--primary);
            padding: 12px 18px;
            border-radius: 12px;
            font-weight: 800;
            text-decoration: none;
            white-space: nowrap;
        }

        .table-wrapper {
            background: var(--white);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 820px;
            border-collapse: collapse;
        }

        th {
            background: #f8fafc;
            color: var(--text-sub);
            font-size: 0.78rem;
            text-align: left;
            padding: 18px;
            text-transform: uppercase;
        }

        td {
            padding: 18px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: top;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .muted {
            color: var(--text-sub);
            font-size: 0.88rem;
        }

        .status {
            padding: 7px 12px;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 800;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
        }

        .pending { background: #fffbeb; color: #d97706; }
        .approved { background: #ecfdf5; color: #059669; }
        .rejected { background: #fef2f2; color: #dc2626; }
        .cancelled { background: #f1f5f9; color: #64748b; }

        .empty {
            padding: 52px 24px;
            color: var(--text-sub);
            text-align: center;
        }

        @media (max-width: 760px) {
            nav {
                align-items: flex-start;
                gap: 12px;
                flex-wrap: wrap;
            }

            .brand {
                order: 3;
                width: 100%;
                text-align: center;
            }

            .container {
                margin: 26px auto;
                padding: 0 16px;
            }

            .page-header {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>
<body>

<nav>
    <div class="nav-left">
        <div class="avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
        <strong>{{ Auth::user()->name }}</strong>
    </div>
    <div class="brand">OBLIP <span>Open Library</span></div>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn-logout">Logout</button>
    </form>
</nav>

<main class="container">
    <section class="page-header">
        <div>
            <h2>Riwayat Peminjaman Saya</h2>
            <p>Semua daftar pengajuan peminjaman ruangan dari akun kamu.</p>
        </div>
        <a href="{{ route('user.home') }}" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali</a>
    </section>

    <section class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Ruangan</th>
                    <th>Jadwal</th>
                    <th>Keperluan</th>
                    <th>Status</th>
                    <th>Diajukan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peminjamans as $peminjaman)
                    @php
                        $statusText = match ($peminjaman->status) {
                            'approved' => 'DISETUJUI',
                            'rejected' => 'DITOLAK',
                            'cancelled' => 'DIBATALKAN',
                            default => 'MENUNGGU',
                        };
                    @endphp
                    <tr>
                        <td><strong>Ruangan {{ optional(optional($peminjaman->jadwal)->ruangan)->nomor_ruangan ?? '-' }}</strong></td>
                        <td>
                            {{ optional($peminjaman->jadwal)->tanggal ?? '-' }}
                            <div class="muted">{{ optional($peminjaman->jadwal)->jam_mulai ?? '-' }} - {{ optional($peminjaman->jadwal)->jam_selesai ?? '-' }}</div>
                        </td>
                        <td>{{ $peminjaman->keperluan }}</td>
                        <td>
                            <span class="status {{ $peminjaman->status }}">
                                {{ $statusText }}
                            </span>
                        </td>
                        <td class="muted">{{ $peminjaman->created_at->format('d M Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="empty">Belum ada riwayat peminjaman</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>
</main>

</body>
</html>
