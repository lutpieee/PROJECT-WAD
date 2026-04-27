<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | OBLIP Telkom University</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #b11116;
            --primary-light: #fff5f5;
            --secondary: #ef2020ff;
            --bg-body: #f8fafc;
            --white: #ffffff;
            --text-main: #0f172a;
            --text-sub: #64748b;
            --success: #10b981;
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
            line-height: 1.6;
        }

        /* ========== NAVBAR ========== */
        nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            padding: 14px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            position: sticky; top: 0; z-index: 1000;
            border-bottom: 1px solid var(--border-color);
        }

        .nav-left { 
            display: flex; align-items: center; gap: 12px; 
        }

        .avatar {
            width: 40px; height: 40px; 
            background: linear-gradient(135deg, var(--primary), #ef4444); 
            color: var(--white);
            border-radius: 12px; display: flex; justify-content: center; align-items: center;
            font-weight: 700; font-size: 1.1rem;
            box-shadow: 0 4px 10px rgba(177, 17, 22, 0.2);
        }

        .nav-center h1 { 
            font-size: 1.5rem; font-weight: 850; letter-spacing: -1px; color: var(--secondary);
        }
        .nav-center h1 span { 
            color: var(--primary); font-style: normal; font-weight: 400; opacity: 0.8;
        }

        .btn-logout {
            padding: 8px 20px; border: 1.5px solid var(--border-color); color: var(--text-sub);
            background: var(--white); border-radius: 10px; font-weight: 600;
            cursor: pointer; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 0.85rem;
        }

        .btn-logout:hover { 
            background: #fff1f2; color: var(--primary); border-color: #fecaca;
            transform: translateY(-1px);
        }

        /* ========== CONTAINER ========== */
        .container {
            max-width: 1140px;
            margin: 40px auto;
            padding: 0 24px;
        }

        /* ========== QUICK NAV ========== */
        .quick-nav {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
            margin-bottom: 40px;
        }

        .nav-card {
            background: var(--white);
            padding: 24px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 20px;
            text-decoration: none;
            color: inherit;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .nav-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 20px -5px rgba(0,0,0,0.05);
            border-color: var(--primary);
        }

        .nav-card i {
            width: 54px; height: 54px;
            border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem;
        }

        .nav-card p { font-size: 0.85rem; color: var(--text-sub); margin-bottom: 2px; }
        .nav-card strong { font-size: 1.1rem; font-weight: 700; color: var(--text-main); }

        .bg-blue { background: #eff6ff; color: #2563eb; }
        .bg-green { background: #f0fdf4; color: #16a34a; }

        /* ========== BANNER ========== */
        .availability-banner {
            background: var(--white);
            border: 1px solid var(--border-color);
            padding: 24px 32px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 32px;
            position: relative;
            overflow: hidden;
        }

        .availability-banner::before {
            content: '';
            position: absolute; left: 0; top: 0; bottom: 0;
            width: 6px; background: var(--primary);
        }

        .availability-banner span {
            font-weight: 700; color: var(--text-main); font-size: 1.1rem;
        }

        .availability-banner .count {
            font-size: 2rem; font-weight: 800; color: var(--primary);
            display: flex; align-items: baseline; gap: 8px;
        }

        /* ========== ROOM GRID ========== */
        .room-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 28px;
        }

        .room-card {
            background: var(--white);
            border-radius: 24px;
            border: 1px solid var(--border-color);
            padding: 24px;
            position: relative;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .room-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0,0,0,0.05);
            border-color: var(--primary);
        }

        .room-badge {
            position: absolute; top: 20px; right: 20px;
            padding: 6px 14px; border-radius: 10px;
            font-size: 0.75rem; font-weight: 700;
        }

        .available { background: #dcfce7; color: #15803d; }
        .booked { background: #f1f5f9; color: #64748b; }

        .room-body h3 {
            font-size: 1.15rem; font-weight: 800; margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .room-body p {
            font-size: 0.9rem; color: var(--text-sub); margin-bottom: 24px;
            display: flex; align-items: center; gap: 8px;
        }

        .btn-book {
            display: block; text-align: center;
            background: var(--secondary); color: white;
            padding: 12px; border-radius: 14px;
            font-size: 0.9rem; font-weight: 600;
            text-decoration: none; transition: all 0.3s;
        }

        .btn-book:hover {
            background: var(--primary);
            box-shadow: 0 4px 12px rgba(177, 17, 22, 0.2);
        }

        .btn-book.disabled {
            background: #f1f5f9; color: #94a3b8;
            pointer-events: none; border: 1px solid var(--border-color);
        }
    </style>
</head>
<body>

  <nav>
        <div class="nav-left">
            <div class="avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
            <span style="font-weight: 700; font-size: 0.9rem;">{{ Auth::user()->name }}</span>
        </div>
        <div class="nav-center">
            <h1>OBLIP <span>Open Library</span></h1>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">Logout</button>
        </form>
    </nav>

<div class="container">

    <!-- QUICK NAV -->
    <div class="quick-nav">
        <a href="#" class="nav-card">
            <i class="fas fa-tasks bg-blue"></i>
            <div>
                <p>Status Peminjaman</p>
                <strong>Cek Progress</strong>
            </div>
        </a>

        <a href="#" class="nav-card">
            <i class="fas fa-history bg-green"></i>
            <div>
                <p>Riwayat Saya</p>
                <strong>Daftar Peminjaman</strong>
            </div>
        </a>
    </div>

    <!-- BANNER -->
    <div class="availability-banner">
        <span>Ketersediaan Ruangan</span>
        <div class="count">
            {{ $ruangans->where('status', 1)->count() }}
            <span style="font-size:.9rem;color:#64748b">Tersedia</span>
        </div>
    </div>

    <!-- ROOM GRID -->
    <div class="room-grid">
        @foreach($ruangans as $room)
            <div class="room-card">

                <span class="room-badge {{ $room->status ? 'available' : 'booked' }}">
                    {{ $room->status ? 'Tersedia' : 'Penuh' }}
                </span>

                <div class="room-body">
                    <h3>RUANGAN {{ $room->nomor_ruangan }}</h3>
                    <p><i class="fas fa-users"></i> Kapasitas {{ $room->kapasitas }} Mahasiswa</p>

                    <a href="{{ route('admin.ruangan.jadwal', $room->id) }}"
                       class="btn-book {{ !$room->status ? 'disabled' : '' }}">
                        Lihat Jadwal
                    </a>
                </div>

            </div>
        @endforeach
    </div>

</div>

</body>
</html>
