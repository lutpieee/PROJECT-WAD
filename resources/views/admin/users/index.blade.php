<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen User | Open Library</title>

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

        /* --- SIDEBAR STYLING --- */
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
            color: #333;
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
            transition: 0.3s;
        }

        .logout-btn:hover {
            background: var(--primary-red);
            color: #fff;
        }

        /* --- MAIN CONTENT AREA --- */
        .main-content {
            flex: 1;
            padding: 40px;
            margin-left: var(--sidebar-width);
            /* Agar konten tidak tertutup sidebar */
            min-height: 100vh;
        }

        /* Header Section */
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
            color: var(--text-dark);
            border-left: 5px solid var(--primary-red);
            padding-left: 15px;
        }

        /* Table Container */
        .table-container {
            background: white;
            padding: 0;
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
            text-align: left;
            padding: 18px 20px;
            font-weight: 500;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 0.5px;
        }

        td {
            padding: 15px 20px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 14px;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover {
            background-color: #fefefe;
            transition: 0.3s;
        }

        /* Badges */
        .role-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            background: #eee;
            color: #666;
        }

        .role-admin {
            background: #ffe5e6;
            color: var(--primary-red);
        }

        /* Buttons */
        .btn {
            padding: 10px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-add {
            background: var(--primary-red);
            color: white;
            box-shadow: 0 4px 15px rgba(177, 17, 22, 0.3);
        }

        .btn-add:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
        }

        .btn-edit {
            background: #fff4e5;
            color: #ff8800;
        }

        .btn-edit:hover {
            background: #ff8800;
            color: white;
        }

        .btn-delete {
            background: #ffe5e5;
            color: #d63031;
            padding: 8px 15px;
        }

        .btn-delete:hover {
            background: #d63031;
            color: white;
        }

        /* Alert */
        .alert {
            padding: 15px 20px;
            background: #d4edda;
            color: #155724;
            border-radius: 10px;
            margin-bottom: 25px;
            border-left: 5px solid #28a745;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
            }

            .sidebar-header h2,
            .sidebar-nav span,
            .logout-btn span {
                display: none;
            }

            .main-content {
                margin-left: 70px;
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
                <li><a href="{{ route('admin.dashboard') }}"><i class="fas fa-chart-pie"></i> <span>Dashboard</span></a>
                </li>
                <li><a href="{{ route('admin.users.index') }}" class="active"><i class="fas fa-users"></i>
                        <span>Users</span></a></li>
                <li><a href="{{ route('admin.ruangan.index') }}"
       class="{{ request()->routeIs('admin.ruangan.*') ? 'active' : '' }}">
        <i class="fas fa-door-open"></i>
        <span>Ruangan</span>
    </a></li>
                <li><a  href="{{ route('admin.jadwal.index') }}"class="{{ request()->routeIs('admin.jadwal.*') ? 'active' : '' }}"><i class="fas fa-calendar-alt"></i><span>Jadwal</span></a></li>
                <li><a href="{{ route('admin.approval.index') }}"class="{{ request()->routeIs('admin.approval.*') ? 'active' : ''}}"><i class="fas fa-check-double"></i> <span>Approval</span></a></li>
                <li><a href="{{ route('admin.riwayat.index') }}"class="{{ request()->routeIs('admin.riwayat.*') ? 'active' : ''}}"><i class="fas fa-history"></i> <span>Riwayat</span></a></li>
            </ul>
        </nav>

        <div class="sidebar-footer">
            <a href="#" class="logout-btn"><i class="fas fa-sign-out-alt"></i> <span>Keluar</span></a>
        </div>
    </aside>

    <div class="main-content">
        <div class="header-wrapper">
            <h1>Daftar Pengguna</h1>
            <a href="{{ route('admin.users.create') }}" class="btn btn-add">
                <i class="fas fa-plus"></i> Tambah Pengguna
            </a>
        </div>

        @if(session('success'))
            <div class="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td><strong>{{ $user->name }}</strong></td>
                            <td style="color: #666;">{{ $user->email }}</td>
                            <td>
                                <span class="role-badge {{ $user->role == 'admin' ? 'role-admin' : '' }}">
                                    {{ strtoupper($user->role) }}
                                </span>
                            </td>
                            <td style="text-align: center;">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-edit" title="Edit User">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;"
                                    onsubmit="return confirm('Hapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete">
                                        <i class="fas fa-trash"></i> Hapus
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