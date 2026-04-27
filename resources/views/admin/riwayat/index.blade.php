<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Peminjaman Ruangan | Open Library</title>

    <!-- Fonts & Icons -->
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

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: var(--bg-light);
            color: var(--text-dark);
            display: flex;
        }

        /* ================= SIDEBAR ================= */
        /* ================= SIDEBAR ================= */
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

        /* ================= MAIN ================= */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 40px;
            width: 100%;
        }

        h1 {
            font-size: 28px;
            font-weight: 600;
            border-left: 5px solid var(--primary-red);
            padding-left: 15px;
            margin-bottom: 30px;
        }

        /* ================= TABLE ================= */
        .table-container {
            background: #fff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,.08);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: var(--primary-red);
            color: #fff;
        }

        th, td {
            padding: 16px 18px;
            text-align: center;
            font-size: 14px;
        }

        tbody tr:hover {
            background: #f9fafb;
        }

        /* ================= BADGE ================= */
        .badge {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
        }

        .pending { background: #fff3cd; color: #856404; }
        .approved { background: #d4edda; color: #155724; }
        .rejected { background: #f8d7da; color: #721c24; }
        .cancelled { background: #e2e3e5; color: #383d41; }

        /* ================= BUTTON ================= */
        .btn {
            padding: 8px 14px;
            border-radius: 8px;
            font-size: 13px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-edit {
            background: #fff4e5;
            color: #ff8800;
        }
    </style>
</head>

<body>

<!-- ================= SIDEBAR ================= -->
<aside class="sidebar">
    <div class="sidebar-header">
        <h2>Open Lib <span>Tel-U</span></h2>
    </div>

    <nav class="sidebar-nav">
        <a href="{{ route('admin.dashboard') }}"><i class="fas fa-chart-pie"></i>Dashboard</a>
        <a href="{{ route('admin.users.index') }}"><i class="fas fa-users"></i>Users</a>
        <a href="{{ route('admin.ruangan.index') }}"><i class="fas fa-door-open"></i>Ruangan</a>
        <a href="{{ route('admin.jadwal.index') }}"><i class="fas fa-calendar-alt"></i>Jadwal</a>
        <a href="{{ route('admin.approval.index') }}"><i class="fas fa-check-double"></i>Approval</a>
        <a href="{{ route('admin.riwayat.index') }}" class="active">
            <i class="fas fa-history"></i>Riwayat
        </a>
    </nav>
</aside>

<!-- ================= MAIN CONTENT ================= -->
<main class="main-content">
    <h1>Riwayat Peminjaman Ruangan</h1>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Peminjam</th>
                    <th>Ruangan</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Keperluan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="riwayat-body"></tbody>
        </table>
    </div>
</main>

<!-- ================= SCRIPT ================= -->
<script>
fetch('/api/riwayat-peminjaman', {
    headers: { 'Accept': 'application/json' }
})
.then(res => res.json())
.then(res => {
    const body = document.getElementById('riwayat-body');
    body.innerHTML = '';

    if (res.data.length === 0) {
        body.innerHTML = `
            <tr>
                <td colspan="7" style="padding:40px;color:#64748b;font-style:italic;">
                    Belum ada riwayat peminjaman
                </td>
            </tr>
        `;
        return;
    }

    res.data.forEach(item => {
        body.innerHTML += `
            <tr>
                <td>${item.user.name}</td>
                <td>Ruangan ${item.jadwal.ruangan.nomor_ruangan}</td>
                <td>${item.jadwal.tanggal}</td>
                <td>${item.jadwal.jam_mulai} - ${item.jadwal.jam_selesai}</td>
                <td>${item.keperluan}</td>
                <td>
                    <span class="badge ${item.status}">
                        ${item.status.toUpperCase()}
                    </span>
                </td>
                <td>
                    ${item.status === 'pending'
                        ? `<a href="/admin/riwayat-peminjaman/${item.id}/edit" class="btn btn-edit">
                            <i class="fas fa-edit"></i>
                           </a>`
                        : '-'}
                </td>
            </tr>
        `;
    });
});
</script>

</body>
</html>
