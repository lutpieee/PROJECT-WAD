<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Ruangan | Open Library</title>

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

        .sidebar {
            width: 260px;
            background: #ffffff;
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            box-shadow: 2px 0 10px rgba(0,0,0,0.05);
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
            display: block;
            text-align: center;
            padding: 10px;
            color: var(--primary-red);
            border: 1px solid var(--primary-red);
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
        }

        .logout-btn:hover {
            background: var(--primary-red);
            color: #fff;
        }

        .main-content {
            flex: 1;
            padding: 40px;
            margin-left: 260px;
            min-height: 100vh;
        }

        .header-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        h1 {
            margin: 0;
            font-weight: 600;
            font-size: 28px;
            border-left: 5px solid var(--primary-red);
            padding-left: 15px;
        }

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
            text-align: center; /* HEADER RAPIH */
            font-weight: 500;
        }

        td {
            padding: 16px 20px;
            border-bottom: 1px solid #f0f0f0;
            text-align: center; /* DATA LURUS */
        }

        td:first-child {
            text-align: center; /* No Ruangan tetap kiri */
        }

        .btn {
            padding: 10px 18px;
            border-radius: 8px;
            font-size: 13px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: none;
            cursor: pointer;
        }

        .btn-add {
            background: var(--primary-red);
            color: white;
        }

        .btn-edit {
            background: #fff4e5;
            color: #ff8800;
        }

        .btn-delete {
            background: #ffe5e5;
            color: #d63031;
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
            <li><a href="{{ route('admin.ruangan.index') }}" class="active"><i class="fas fa-door-open"></i><span>Ruangan</span></a></li>
            <li><a href="{{ route('admin.jadwal.index') }}"class="{{ request()->routeIs('admin.jadwal.*') ? 'active' : '' }}"><i class="fas fa-calendar-alt"></i><span>Jadwal</span></a></li>
            <li><a href="{{ route('admin.approval.index') }}"><i class="fas fa-check-double"></i><span>Approval</span></a></li>
            <li><a href="{{ route('admin.riwayat.index') }}"><i class="fas fa-history"></i><span>Riwayat</span></a></li>
        </ul>
    </nav>

    <div class="sidebar-footer">
        <a href="#" class="logout-btn"><span>Keluar</span></a>
    </div>
</aside>

<div class="main-content">
    <div class="header-wrapper">
        <h1>Daftar Ruangan</h1>
        <a href="{{ route('admin.ruangan.create') }}" class="btn btn-add">
            <i class="fas fa-plus"></i> Tambah Ruangan
        </a>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No Ruangan</th>
                    <th>Kapasitas</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ruangans as $r)
                <tr>
                    <td><strong>{{ $r->nomor_ruangan }}</strong></td>
                    <td>{{ $r->kapasitas }}</td>
                    <td>{{ $r->status ? 'TERSEDIA' : 'TIDAK TERSEDIA' }}</td>
                    <td>
                        <a href="{{ route('admin.ruangan.edit',$r->id) }}" class="btn btn-edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.ruangan.destroy',$r->id) }}" method="POST" style="display:inline"
                              onsubmit="return confirm('Hapus ruangan ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
