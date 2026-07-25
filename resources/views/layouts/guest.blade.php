<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Global Supply Chain Risk') }} - Authentication</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        :root {
            --bg-color: #0b0f19;
            --card-bg: rgba(18, 24, 38, 0.85);
            --primary-gradient: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            --glass-border: rgba(255, 255, 255, 0.12);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-color);
            color: #f8fafc;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow-x: hidden;
            margin: 0;
            padding: 30px 15px;
        }

        /* Ambient Glow Effect */
        .ambient-glow-1 {
            position: absolute;
            top: -10%;
            left: -10%;
            width: 550px;
            height: 550px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.25) 0%, rgba(0, 0, 0, 0) 70%);
            border-radius: 50%;
            z-index: 0;
            pointer-events: none;
        }

        .ambient-glow-2 {
            position: absolute;
            bottom: -10%;
            right: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.18) 0%, rgba(0, 0, 0, 0) 70%);
            border-radius: 50%;
            z-index: 0;
            pointer-events: none;
        }

        .auth-container {
            width: 100%;
            max-width: 440px;
            position: relative;
            z-index: 10;
        }

        .glass-auth-card {
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 2.25rem 2rem;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.6);
        }

        .brand-logo-glow {
            width: 64px;
            height: 64px;
            background: var(--primary-gradient);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            box-shadow: 0 0 30px rgba(59, 130, 246, 0.5);
        }

        .form-control-custom {
            background: rgba(11, 15, 25, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: #fff;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control-custom:focus {
            background: rgba(11, 15, 25, 0.9);
            border-color: #3b82f6;
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.3);
            color: #fff;
        }

        .form-control-custom::placeholder {
            color: #64748b;
        }

        .btn-auth-submit {
            background: var(--primary-gradient);
            border: none;
            color: #fff;
            font-weight: 700;
            border-radius: 12px;
            padding: 12px 24px;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(59, 130, 246, 0.4);
        }

        .btn-auth-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.6);
            color: #fff;
        }

        .auth-link {
            color: #94a3b8;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .auth-link:hover {
            color: #3b82f6;
        }

        .input-group-text-custom {
            background: rgba(11, 15, 25, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-right: none;
            color: #64748b;
            border-top-left-radius: 12px;
            border-bottom-left-radius: 12px;
        }

        .input-group .form-control-custom {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        .brand-text {
            background: linear-gradient(90deg, #ffffff, #cbd5e1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body>

    <div class="ambient-glow-1"></div>
    <div class="ambient-glow-2"></div>

    <div class="auth-container">
        <div class="text-center mb-4">
            <a href="/" class="text-decoration-none d-inline-block">
                <div class="brand-logo-glow">
                    <i class="fa-solid fa-earth-americas text-white fs-2"></i>
                </div>
                <h3 class="fw-bold brand-text mb-0">SupplyChain<span class="text-primary">Risk</span></h3>
                <p class="text-muted small">Global Risk Intelligence Platform</p>
            </a>
        </div>

        <div class="glass-auth-card">
            {{ $slot }}
        </div>

        <div class="text-center mt-4">
            <a href="/" class="auth-link small"><i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Dashboard Utama</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
