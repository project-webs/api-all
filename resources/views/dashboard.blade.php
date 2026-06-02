<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasbor - API Portal</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #6366f1;
            --primary-hover: #4f46e5;
            --bg-dark: #0f172a;
            --card-bg: rgba(30, 41, 59, 0.7);
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --border-color: rgba(255, 255, 255, 0.08);
            --success: #10b981;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-dark);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Ambient background glow elements */
        .ambient-glow {
            position: absolute;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            filter: blur(140px);
            z-index: 1;
            opacity: 0.3;
            pointer-events: none;
        }

        .glow-1 {
            background: radial-gradient(circle, var(--primary) 0%, transparent 70%);
            top: -20%;
            right: -10%;
        }

        .glow-2 {
            background: radial-gradient(circle, #10b981 0%, transparent 70%);
            bottom: -20%;
            left: -10%;
        }

        .container {
            width: 100%;
            max-width: 600px;
            padding: 20px;
            position: relative;
            z-index: 10;
        }

        .dashboard-card {
            background: var(--card-bg);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--border-color);
            border-radius: 28px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            text-align: center;
        }

        .avatar-container {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary) 0%, #10b981 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px auto;
            box-shadow: 0 8px 24px rgba(99, 102, 241, 0.2);
        }

        .avatar-container i {
            font-size: 32px;
            color: #ffffff;
        }

        .welcome-title {
            font-family: 'Outfit', sans-serif;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 8px;
            background: linear-gradient(135deg, #ffffff 0%, #cbd5e1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .welcome-subtitle {
            color: var(--success);
            font-weight: 500;
            font-size: 15px;
            margin-bottom: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .user-details {
            background: rgba(15, 23, 42, 0.5);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 24px;
            margin-bottom: 32px;
            text-align: left;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .detail-row:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .detail-row:first-child {
            padding-top: 0;
        }

        .detail-label {
            color: var(--text-muted);
            font-size: 14px;
        }

        .detail-value {
            font-weight: 500;
            font-size: 14px;
            color: var(--text-main);
        }

        .btn-logout {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #fca5a5;
            border-radius: 14px;
            padding: 12px 28px;
            font-family: inherit;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .btn-logout:hover {
            background-color: var(--danger);
            border-color: var(--danger);
            color: #ffffff;
            box-shadow: 0 4px 16px rgba(239, 68, 68, 0.3);
            transform: translateY(-2px);
        }

        .btn-logout:active {
            transform: translateY(0);
        }
    </style>
</head>
<body>
    <div class="ambient-glow glow-1"></div>
    <div class="ambient-glow glow-2"></div>

    <div class="container">
        <div class="dashboard-card">
            <div class="avatar-container">
                <i class="fa-solid fa-user-astronaut"></i>
            </div>
            
            <h1 class="welcome-title">Halo, {{ Auth::user()->name }}!</h1>
            
            <div class="welcome-subtitle">
                <i class="fa-solid fa-circle-check"></i>
                <span>Berhasil masuk ke sistem</span>
            </div>

            <div class="user-details">
                <div class="detail-row">
                    <span class="detail-label">Nama Lengkap</span>
                    <span class="detail-value">{{ Auth::user()->name }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Alamat Email</span>
                    <span class="detail-value">{{ Auth::user()->email }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Terdaftar Sejak</span>
                    <span class="detail-value">{{ Auth::user()->created_at->format('d M Y, H:i') }}</span>
                </div>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <span>Keluar Aplikasi</span>
                </button>
            </form>
        </div>
    </div>
</body>
</html>
