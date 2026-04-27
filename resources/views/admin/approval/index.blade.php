<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approval Peminjaman | Open Library</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-red: #b11116;
            --primary-hover: #8e0e12;
            --bg-light: #f8f9fa;
            --text-dark: #333;
            --sidebar-width: 260px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg-light);
            margin: 0;
            display: flex;
            color: var(--text-dark);
        }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background: #ffffff;
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
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
        }

        .logout-btn:hover {
            background: var(--primary-red);
            color: white;
        }

        /* Main content */
        .main-content {
            flex: 1;
            padding: 40px;
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }

        h1 {
            margin: 0 0 30px 0;
            font-weight: 600;
            font-size: 28px;
            border-left: 5px solid var(--primary-red);
            padding-left: 15px;
        }

        /* Table */
        .table-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: var(--primary-red);
            color: white;
        }

        th {
            padding: 18px 20px;
            text-align: center;
            font-weight: 500;
        }

        td {
            padding: 16px 20px;
            border-bottom: 1px solid #f0f0f0;
            text-align: center;
            vertical-align: middle;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        /* Status */
        .status-pending {
            background: #fff3cd;
            color: #856404;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        /* Buttons */
        .btn-action {
            padding: 8px 0;
            border-radius: 8px;
            font-size: 0.85rem;
            display: block;
            width: 100%;
            font-weight: 600;
            border: none;
            cursor: pointer;
            color: white;
        }

        .btn-approve {
            background: #09ad2dff;
        }

        .btn-reject {
            background: #b91c1c;
        }

        .btn-actions-container {
            display: flex;
            flex-direction: column;
            gap: 8px;
            width: 120px; /* semua tombol sama lebar */
            margin: 0 auto;
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
                <li><a href="{{ route('admin.dashboard') }}"><i class="fas fa-chart-pie"></i><span>Dashboard</span></a></li>
                <li><a href="{{ route('admin.users.index') }}"><i class="fas fa-users"></i><span>Users</span></a></li>
                <li><a href="{{ route('admin.ruangan.index') }}"><i class="fas fa-door-open"></i><span>Ruangan</span></a></li>
                <li><a href="{{ route('admin.jadwal.index') }}"><i class="fas fa-calendar-alt"></i><span>Jadwal</span></a></li>
                <li><a href="{{ route('admin.approval.index') }}" class="active"><i class="fas fa-check-double"></i><span>Approval</span></a></li>
                <li><a href="{{ route('admin.riwayat.index') }}"><i class="fas fa-history"></i><span>Riwayat</span></a></li>
            </ul>
        </nav>

        <div class="sidebar-footer">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">Keluar</button>
            </form>
        </div>
    </aside>

    <div class="main-content">
        <h1>Approval Peminjaman Ruangan</h1>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Ruangan</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Keperluan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($peminjamans as $p)
                    <tr>
                        <td>{{ $p->user->name }}</td>
                        <td>{{ optional($p->jadwal->ruangan)->nomor_ruangan }}</td>
                        <td>{{ $p->jadwal->tanggal }}</td>
                        <td>{{ $p->jadwal->jam_mulai }} - {{ $p->jadwal->jam_selesai }}</td>
                        <td>{{ $p->keperluan }}</td>
                        <td>
                            @if($p->status === 'pending')
                                <span class="status-pending">PENDING</span>
                            @else
                                {{ strtoupper($p->status) }}
                            @endif
                        </td>
                        <td>
                            <div class="btn-actions-container">
                                <form method="POST" action="{{ route('admin.approval.approve', $p->id) }}">
                                    @csrf
                                    <button type="submit" class="btn-action btn-approve">Approve</button>
                                </form>
                                <form method="POST" action="{{ route('admin.approval.reject', $p->id) }}">
                                    @csrf
                                    <button type="submit" class="btn-action btn-reject">Reject</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">Tidak ada pengajuan pending</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
