<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | Open Library</title>
    <link rel="stylesheet" href="{{ asset('css/admnstyle.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

    <div class="admin-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Open Lib <span>Tel-U</span></h2>
            </div>

            <nav class="sidebar-nav">
                <ul>
                    <li><a href="{{ route('admin.dashboard') }}" class="active"><i class="fas fa-chart-pie"></i>
                            <span>Dashboard</span></a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fas fa-users"></i>
                            <span>Users</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.ruangan.index') }}"
                            class="{{ request()->routeIs('admin.ruangan.*') ? 'active' : '' }}">
                            <i class="fas fa-door-open"></i>
                            <span>Ruangan</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.jadwal.index') }}"
                        class="{{ request()->routeIs('admin.jadwal.*') ? 'active' : '' }}">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Jadwal</span>
                        </a>
                    </li>
                    <li><a href="/admin/approval">
                        <i class="fas fa-check-double"></i>
                        <span>Approval</span>
                        </a></li>
                    <li><a href="{{ route('admin.riwayat.index') }}"
                        class="{{ request()->routeIs('admin.riwayat.*') ? 'active' : '' }}">
                        <i class="fas fa-history"></i>
                        <span>Riwayat</span>
                        </a>
                        </li>
                </ul>
            </nav>

            <div class="sidebar-footer">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn"
                        style="width: 100%; border: none; cursor: pointer;">Keluar</button>
                </form>
            </div>
        </aside>

        <main class="main-content">
            <header class="content-header">
                <div class="header-title">
                    <h1>Admin Dashboard</h1>
                    <p>Ringkasan data sistem saat ini</p>
                </div>
                <div class="admin-profile">
                    <span>Halo, <strong>{{ Auth::user()->name }}</strong></span>
                    <div class="avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
                </div>
            </header>

            <div class="stats-grid">
                <div class="card stat-card">
                    <div class="stat-info">
                        <span class="stat-label">Total Users</span>
                        <h2>{{ $data['total_users'] }}</h2>
                    </div>
                    <div class="stat-icon users">👤</div>
                </div>

                <div class="card stat-card">
                    <div class="stat-info">
                        <span class="stat-label">Ruangan Tersedia</span>
                        <h2>{{ $data['total_ruangan'] }}</h2>
                    </div>
                    <div class="stat-icon room">🏢</div>
                </div>

                <div class="card stat-card">
                    <div class="stat-info">
                        <span class="stat-label">Menunggu Approval</span>
                        <h2>{{ $data['pending_approval'] }}</h2>
                    </div>
                    <div class="stat-icon pending">⏳</div>
                </div>

                <div class="card stat-card">
                    <div class="stat-info">
                        <span class="stat-label">Total Peminjaman</span>
                        <h2>{{ $data['total_peminjaman'] }}</h2>
                    </div>
                    <div class="stat-icon total">📈</div>
                </div>
            </div>
        </main>
    </div>

</body>

</html>