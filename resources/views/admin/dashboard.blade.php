<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | Open Library</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-red: #b11116;
            --primary-hover: #8e0e12;
            --bg-light: #f8f9fa;
            --text-dark: #333;
            --text-muted: #64748b;
            --sidebar-width: 260px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg-light);
            margin: 0;
            display: flex;
            color: var(--text-dark);
        }

        .sidebar {
            width: var(--sidebar-width);
            background: #ffffff;
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
            z-index: 100;
        }

        .sidebar-header {
            padding: 30px 20px;
            text-align: center;
        }

        .sidebar-header h2 {
            font-size: 1.2rem;
            margin: 0;
        }

        .sidebar-header h2 span {
            color: var(--primary-red);
            font-style: italic;
        }

        .sidebar-nav {
            flex-grow: 1;
            padding: 10px 15px;
        }

        .sidebar-nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-nav a {
            text-decoration: none;
            color: #64748b;
            padding: 12px 15px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-radius: 10px;
            margin-bottom: 5px;
            font-size: 0.95rem;
            transition: 0.3s;
        }

        .sidebar-nav a:hover,
        .sidebar-nav a.active {
            background: var(--primary-red);
            color: #fff;
        }

        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid #f1f5f9;
        }

        .logout-btn {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--primary-red);
            background: none;
            color: var(--primary-red);
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            font-family: inherit;
        }

        .logout-btn:hover {
            background: var(--primary-red);
            color: white;
        }

        .main-content {
            flex: 1;
            padding: 40px;
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            width: calc(100% - var(--sidebar-width));
        }

        .header-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
        }

        h1 {
            margin: 0;
            font-weight: 600;
            font-size: 28px;
            border-left: 5px solid var(--primary-red);
            padding-left: 15px;
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--text-muted);
            font-size: 14px;
        }

        .avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: var(--primary-red);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card,
        .panel {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .stat-card {
            padding: 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 118px;
        }

        .stat-label {
            color: var(--text-muted);
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .stat-card h2 {
            margin: 8px 0 0 0;
            color: var(--text-dark);
            font-size: 30px;
            line-height: 1;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .icon-users { background: #eff6ff; color: #2563eb; }
        .icon-room { background: #e8f5e9; color: #2e7d32; }
        .icon-pending { background: #fff3cd; color: #856404; }
        .icon-total { background: #ffe5e6; color: var(--primary-red); }

        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 14px;
            margin-bottom: 30px;
        }

        .action-link {
            background: #fff;
            color: var(--primary-red);
            border: 1px solid #f0d1d2;
            border-radius: 10px;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            min-height: 52px;
        }

        .action-link:hover {
            background: var(--primary-red);
            color: #fff;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.3fr) minmax(280px, 0.7fr);
            gap: 20px;
        }

        .panel {
            overflow: hidden;
        }

        .panel-header {
            padding: 20px 24px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .panel-header h2 {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
        }

        .panel-link {
            color: var(--primary-red);
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-scroll {
            width: 100%;
            overflow-x: auto;
        }

        .table-scroll table {
            min-width: 620px;
        }

        thead {
            background: var(--primary-red);
            color: white;
        }

        th {
            padding: 16px 18px;
            text-align: center;
            font-size: 13px;
            font-weight: 500;
        }

        td {
            padding: 16px 18px;
            border-bottom: 1px solid #f0f0f0;
            text-align: center;
            font-size: 14px;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        tbody tr:hover {
            background: #f9fafb;
        }

        .badge {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            display: inline-block;
        }

        .pending { background: #fff3cd; color: #856404; }
        .approved { background: #d4edda; color: #155724; }
        .rejected { background: #f8d7da; color: #721c24; }
        .cancelled { background: #e2e3e5; color: #383d41; }

        .summary-list {
            padding: 16px 24px 24px;
            display: grid;
            gap: 14px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 0;
            border-bottom: 1px solid #f1f5f9;
            font-size: 14px;
        }

        .summary-item:last-child {
            border-bottom: none;
        }

        .summary-item span {
            color: var(--text-muted);
        }

        .summary-item strong {
            color: var(--text-dark);
            font-size: 18px;
        }

        .empty-state {
            padding: 40px 20px;
            color: var(--text-muted);
            text-align: center;
            font-size: 14px;
        }

        @media (max-width: 1100px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
            }

            .sidebar-header h2,
            .sidebar-nav span,
            .logout-btn span,
            .admin-profile span {
                display: none;
            }

            .main-content {
                margin-left: 70px;
                width: calc(100% - 70px);
                padding: 24px;
            }

            .header-wrapper {
                align-items: flex-start;
            }
        }

        @media (max-width: 540px) {
            .main-content {
                padding: 22px 16px;
            }

            h1 {
                font-size: 24px;
                line-height: 1.25;
            }

            .stat-card {
                min-height: 106px;
                padding: 18px;
            }

            .stat-card h2 {
                font-size: 28px;
            }

            .panel-header {
                align-items: flex-start;
                flex-direction: column;
                padding: 18px;
            }

            .summary-list {
                padding: 12px 18px 18px;
            }
        }
    </style>
</head>

<body>

    <aside class="sidebar">
        <div class="sidebar-header">
            <h2>Open Lib <span>Tel-U</span></h2>
        </div>

        <nav class="sidebar-nav">
            <ul>
                <li><a href="{{ route('admin.dashboard') }}" class="active"><i class="fas fa-chart-pie"></i><span>Dashboard</span></a></li>
                <li><a href="{{ route('admin.users.index') }}"><i class="fas fa-users"></i><span>Users</span></a></li>
                <li><a href="{{ route('admin.ruangan.index') }}"><i class="fas fa-door-open"></i><span>Ruangan</span></a></li>
                <li><a href="{{ route('admin.jadwal.index') }}"><i class="fas fa-calendar-alt"></i><span>Jadwal</span></a></li>
                <li><a href="{{ route('admin.approval.index') }}"><i class="fas fa-check-double"></i><span>Approval</span></a></li>
                <li><a href="{{ route('admin.riwayat.index') }}"><i class="fas fa-history"></i><span>Riwayat</span></a></li>
            </ul>
        </nav>

        <div class="sidebar-footer">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> <span>Keluar</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="main-content">
        <div class="header-wrapper">
            <h1>Dashboard Admin</h1>
            <div class="admin-profile">
                <span>Halo, <strong>{{ auth()->user()->name }}</strong></span>
                <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            </div>
        </div>

        <section class="stats-grid">
            <div class="stat-card">
                <div>
                    <span class="stat-label">Total Users</span>
                    <h2>{{ $data['total_users'] }}</h2>
                </div>
                <div class="stat-icon icon-users"><i class="fas fa-users"></i></div>
            </div>

            <div class="stat-card">
                <div>
                    <span class="stat-label">Ruangan Tersedia</span>
                    <h2>{{ $data['ruangan_tersedia'] }}</h2>
                </div>
                <div class="stat-icon icon-room"><i class="fas fa-door-open"></i></div>
            </div>

            <div class="stat-card">
                <div>
                    <span class="stat-label">Menunggu Approval</span>
                    <h2>{{ $data['pending_approval'] }}</h2>
                </div>
                <div class="stat-icon icon-pending"><i class="fas fa-clock"></i></div>
            </div>

            <div class="stat-card">
                <div>
                    <span class="stat-label">Total Peminjaman</span>
                    <h2>{{ $data['total_peminjaman'] }}</h2>
                </div>
                <div class="stat-icon icon-total"><i class="fas fa-chart-line"></i></div>
            </div>
        </section>

        <section class="quick-actions">
            <a href="{{ route('admin.ruangan.create') }}" class="action-link"><i class="fas fa-plus"></i> Tambah Ruangan</a>
            <a href="{{ route('admin.jadwal.create') }}" class="action-link"><i class="fas fa-calendar-plus"></i> Tambah Jadwal</a>
            <a href="{{ route('admin.approval.index') }}" class="action-link"><i class="fas fa-check-double"></i> Cek Approval</a>
        </section>

        <section class="dashboard-grid">
            <div class="panel">
                <div class="panel-header">
                    <h2>Peminjaman Terbaru</h2>
                    <a href="{{ route('admin.riwayat.index') }}" class="panel-link">Lihat Riwayat</a>
                </div>

                <div class="table-scroll">
                    <table>
                        <thead>
                            <tr>
                                <th>Peminjam</th>
                                <th>Ruangan</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentPeminjamans as $peminjaman)
                                <tr>
                                    <td><strong>{{ $peminjaman->user->name ?? '-' }}</strong></td>
                                    <td>Ruangan {{ optional(optional($peminjaman->jadwal)->ruangan)->nomor_ruangan ?? '-' }}</td>
                                    <td>{{ optional($peminjaman->jadwal)->tanggal ?? '-' }}</td>
                                    <td>
                                        <span class="badge {{ $peminjaman->status }}">
                                            {{ strtoupper($peminjaman->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="empty-state">Belum ada peminjaman ruangan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="panel">
                <div class="panel-header">
                    <h2>Ringkasan Sistem</h2>
                </div>

                <div class="summary-list">
                    <div class="summary-item">
                        <span>Total Ruangan</span>
                        <strong>{{ $data['total_ruangan'] }}</strong>
                    </div>
                    <div class="summary-item">
                        <span>Total Jadwal</span>
                        <strong>{{ $data['total_jadwal'] }}</strong>
                    </div>
                    <div class="summary-item">
                        <span>Peminjaman Disetujui</span>
                        <strong>{{ $data['approved_peminjaman'] }}</strong>
                    </div>
                    <div class="summary-item">
                        <span>Peminjaman Ditolak</span>
                        <strong>{{ $data['rejected_peminjaman'] }}</strong>
                    </div>
                </div>
            </div>
        </section>
    </main>

</body>

</html>
