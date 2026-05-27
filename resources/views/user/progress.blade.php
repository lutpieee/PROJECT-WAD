<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Progress Peminjaman | OBLIP</title>

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

        .progress-grid {
            display: grid;
            gap: 18px;
        }

        .progress-card {
            background: var(--white);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 24px;
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 18px;
        }

        .meta {
            color: var(--text-sub);
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 8px;
            font-size: 0.92rem;
        }

        .meta i {
            color: var(--primary);
        }

        .keperluan {
            margin-top: 14px;
            color: var(--text-main);
        }

        .status-badge {
            align-self: start;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-weight: 800;
            font-size: 0.78rem;
            padding: 9px 14px;
            white-space: nowrap;
        }

        .pending { background: #fffbeb; color: #d97706; }
        .approved { background: #ecfdf5; color: #059669; }
        .rejected { background: #fef2f2; color: #dc2626; }

        .timeline {
            margin-top: 18px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        .step {
            background: #f8fafc;
            border: 1px solid var(--border-color);
            border-radius: 14px;
            padding: 12px;
            color: var(--text-sub);
            font-size: 0.82rem;
            font-weight: 700;
        }

        .step.active {
            border-color: #fde68a;
            background: #fffbeb;
            color: #d97706;
        }

        .step.done {
            border-color: #bbf7d0;
            background: #f0fdf4;
            color: #059669;
        }

        .step.failed {
            border-color: #fecaca;
            background: #fef2f2;
            color: #dc2626;
        }

        .empty {
            background: var(--white);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 52px 24px;
            text-align: center;
            color: var(--text-sub);
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

            .page-header,
            .progress-card {
                grid-template-columns: 1fr;
            }

            .page-header {
                align-items: flex-start;
            }

            .timeline {
                grid-template-columns: 1fr;
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
            <h2>Cek Progress Peminjaman</h2>
            <p>Pantau status pengajuan ruangan yang sedang diproses admin.</p>
        </div>
        <a href="{{ route('user.home') }}" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali</a>
    </section>

    <section class="progress-grid">
        @forelse($peminjamans as $peminjaman)
            @php
                $statusText = match ($peminjaman->status) {
                    'approved' => 'DISETUJUI',
                    'rejected' => 'DITOLAK',
                    default => 'MENUNGGU',
                };
            @endphp

            <article class="progress-card">
                <div>
                    <h3>Ruangan {{ optional(optional($peminjaman->jadwal)->ruangan)->nomor_ruangan ?? '-' }}</h3>
                    <div class="meta">
                        <span><i class="fas fa-calendar"></i> {{ optional($peminjaman->jadwal)->tanggal ?? '-' }}</span>
                        <span><i class="fas fa-clock"></i> {{ optional($peminjaman->jadwal)->jam_mulai ?? '-' }} - {{ optional($peminjaman->jadwal)->jam_selesai ?? '-' }}</span>
                    </div>
                    <p class="keperluan">{{ $peminjaman->keperluan }}</p>

                    <div class="timeline">
                        <div class="step done">Pengajuan dikirim</div>
                        <div class="step {{ $peminjaman->status === 'pending' ? 'active' : 'done' }}">Diproses admin</div>
                        <div class="step {{ $peminjaman->status === 'approved' ? 'done' : ($peminjaman->status === 'rejected' ? 'failed' : '') }}">
                            {{ $peminjaman->status === 'rejected' ? 'Ditolak' : 'Keputusan' }}
                        </div>
                    </div>
                </div>

                <span class="status-badge {{ $peminjaman->status }}">
                    <i class="fas {{ $peminjaman->status === 'approved' ? 'fa-check' : ($peminjaman->status === 'rejected' ? 'fa-xmark' : 'fa-hourglass-half') }}"></i>
                    {{ $statusText }}
                </span>
            </article>
        @empty
            <div class="empty">
                <strong>Belum ada pengajuan.</strong>
                <p>Ajukan peminjaman dari halaman jadwal ruangan untuk melihat progress di sini.</p>
            </div>
        @endforelse
    </section>
</main>

</body>
</html>
