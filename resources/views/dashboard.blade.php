<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Global Supply Chain Risk Intelligence Platform</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

    <!-- Chart.js & Leaflet.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <style>
        :root {
            --primary-accent: #3b82f6;
            --primary-gradient: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            --glass-bg: rgba(15, 23, 42, 0.75);
            --glass-border: rgba(255, 255, 255, 0.08);
            --card-radius: 16px;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #0b0f19;
            color: #f1f5f9;
            min-height: 100vh;
        }

        /* Glassmorphism & Custom Cards */
        .glass-card {
            background: rgba(15, 23, 42, 0.75);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--glass-border);
            border-radius: var(--card-radius);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .glass-card:hover {
            border-color: rgba(59, 130, 246, 0.3);
        }

        /* Navbar & Headers */
        .navbar-custom {
            background: rgba(11, 15, 25, 0.9);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--glass-border);
        }

        .brand-badge {
            background: linear-gradient(90deg, #ef4444, #f59e0b, #10b981);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 800;
        }

        /* Navigation Tabs Sidebar/Top */
        .nav-pills .nav-link {
            color: #94a3b8;
            font-weight: 600;
            border-radius: 12px;
            padding: 10px 18px;
            margin-right: 6px;
            transition: all 0.25s ease;
        }

        .nav-pills .nav-link:hover {
            color: #f8fafc;
            background: rgba(255, 255, 255, 0.05);
        }

        .nav-pills .nav-link.active {
            background: var(--primary-gradient);
            color: #fff;
            box-shadow: 0 4px 20px rgba(59, 130, 246, 0.4);
        }

        /* Risk Level Badges */
        .badge-risk-low {
            background: rgba(16, 185, 129, 0.15);
            color: #34d399;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        .badge-risk-medium {
            background: rgba(245, 158, 11, 0.15);
            color: #fbbf24;
            border: 1px solid rgba(245, 158, 11, 0.3);
        }

        .badge-risk-high {
            background: rgba(239, 68, 68, 0.15);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        /* Metric Cards */
        .metric-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        /* Leaflet Maps */
        .map-container {
            height: 480px;
            width: 100%;
            border-radius: 14px;
            overflow: hidden;
            z-index: 1;
        }

        /* Table styling */
        .table-custom {
            color: #cbd5e1;
        }
        .table-custom th {
            background: rgba(30, 41, 59, 0.6);
            color: #94a3b8;
            font-weight: 600;
            border-bottom: 1px solid var(--glass-border);
        }
        .table-custom td {
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            vertical-align: middle;
        }

        /* Sentiment Bars */
        .sentiment-bar-pos { background-color: #10b981; }
        .sentiment-bar-neu { background-color: #64748b; }
        .sentiment-bar-neg { background-color: #ef4444; }

        .form-select, .form-control {
            background-color: #1e293b;
            border-color: #334155;
            color: #f8fafc;
        }
        .form-select:focus, .form-control:focus {
            background-color: #1e293b;
            border-color: var(--primary-accent);
            color: #f8fafc;
            box-shadow: 0 0 0 0.25rem rgba(59, 130, 246, 0.25);
        }
    </style>
</head>
<body>

    <!-- Header Navigation -->
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container-fluid px-4">
            <a class="navbar-brand d-flex align-items-center gap-2" href="#">
                <div class="p-2 bg-primary rounded-3 text-white">
                    <i class="fa-solid fa-earth-americas fa-lg"></i>
                </div>
                <div>
                    <div class="fw-bold fs-5 text-white leading-tight">SupplyChain<span class="brand-badge">Risk</span></div>
                    <div class="text-xs text-muted" style="font-size: 0.75rem;">Global Risk Intelligence Platform</div>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="ms-auto d-flex align-items-center gap-3">
                    <div class="d-none d-md-flex align-items-center gap-2 px-3 py-1 bg-dark rounded-pill border border-secondary text-xs">
                        <span class="spinner-grow spinner-grow-sm text-success" role="status"></span>
                        <span class="text-muted" style="font-size: 0.8rem;">Multi-API Monitoring Engine: <strong class="text-success">Active</strong></span>
                    </div>

                    @auth
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle rounded-pill text-white btn-sm px-3" type="button" data-bs-toggle="dropdown">
                                <i class="fa-solid fa-circle-user me-1 text-primary"></i> {{ Auth::user()->name }} ({{ ucfirst(Auth::user()->role) }})
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark shadow">
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fa-solid fa-user-gear me-2"></i> Profile Settings</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger"><i class="fa-solid fa-right-from-bracket me-2"></i> Log Out</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm rounded-pill px-3">Log in</a>
                        <a href="{{ route('register') }}" class="btn btn-primary btn-sm rounded-pill px-3">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Dashboard Container -->
    <div class="container-fluid px-4 py-4">

        <!-- Navigation Tabs -->
        <ul class="nav nav-pills mb-4 overflow-x-auto flex-nowrap pb-2" id="mainTab" role="tablist">
            <li class="nav-item">
                <button class="nav-link active" id="tab-overview-btn" data-bs-toggle="pill" data-bs-target="#tab-overview"><i class="fa-solid fa-chart-line me-2"></i>Global Country Dashboard</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="tab-risk-btn" data-bs-toggle="pill" data-bs-target="#tab-risk"><i class="fa-solid fa-shield-halved me-2"></i>Risk Scoring Engine</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="tab-weather-btn" data-bs-toggle="pill" data-bs-target="#tab-weather"><i class="fa-solid fa-cloud-bolt me-2"></i>Weather Monitoring</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="tab-currency-btn" data-bs-toggle="pill" data-bs-target="#tab-currency"><i class="fa-solid fa-coins me-2"></i>Currency Impact</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="tab-news-btn" data-bs-toggle="pill" data-bs-target="#tab-news"><i class="fa-solid fa-newspaper me-2"></i>News Intelligence & AI</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="tab-ports-btn" data-bs-toggle="pill" data-bs-target="#tab-ports"><i class="fa-solid fa-ship me-2"></i>World Ports Map</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="tab-charts-btn" data-bs-toggle="pill" data-bs-target="#tab-charts"><i class="fa-solid fa-chart-pie me-2"></i>Data Visualization</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="tab-compare-btn" data-bs-toggle="pill" data-bs-target="#tab-compare"><i class="fa-solid fa-code-compare me-2"></i>Country Comparison</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="tab-watchlist-btn" data-bs-toggle="pill" data-bs-target="#tab-watchlist"><i class="fa-solid fa-star me-2"></i>Watchlist</button>
            </li>
            @if(Auth::check() && Auth::user()->role === 'admin')
            <li class="nav-item">
                <button class="nav-link" id="tab-admin-btn" data-bs-toggle="pill" data-bs-target="#tab-admin"><i class="fa-solid fa-user-shield me-2"></i>Admin Dashboard</button>
            </li>
            @endif
        </ul>

        <!-- Tab Contents -->
        <div class="tab-content" id="mainTabContent">

            <!-- TAB 1: GLOBAL COUNTRY DASHBOARD -->
            <div class="tab-pane fade show active" id="tab-overview">
                <div class="row mb-4">
                    <div class="col-md-8 col-lg-6">
                        <div class="glass-card p-3 d-flex align-items-center gap-3">
                            <i class="fa-solid fa-globe text-primary fs-3"></i>
                            <div class="flex-grow-1">
                                <label class="form-label text-muted mb-1 small fw-semibold">PILIH NEGARA MONITORED:</label>
                                @php
                                    $allCountries = \App\Models\Country::orderBy('name')->get();
                                @endphp
                                <select class="form-select border-0 bg-dark text-white fw-semibold" id="global-country-select" onchange="loadCountryDashboard(this.value)">
                                    @foreach($allCountries as $c)
                                        <option value="{{ $c->code }}" {{ $c->code === 'DEU' ? 'selected' : '' }}>{{ $c->name }} ({{ $c->code }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <button class="btn btn-outline-warning btn-sm rounded-pill" onclick="toggleWatchlistCurrent()" id="btn-watchlist-toggle">
                                <i class="fa-regular fa-star me-1"></i> Bookmark
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Country Quick Stat Cards -->
                <div class="row g-3 mb-4">
                    <div class="col-6 col-md-4 col-xl-2">
                        <div class="glass-card p-3 text-center">
                            <div class="metric-icon bg-primary bg-opacity-10 text-primary mx-auto mb-2"><i class="fa-solid fa-chart-line"></i></div>
                            <div class="text-muted small">GDP Nominal</div>
                            <div class="fw-bold fs-6 mt-1" id="dash-gdp">Loading...</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-xl-2">
                        <div class="glass-card p-3 text-center">
                            <div class="metric-icon bg-warning bg-opacity-10 text-warning mx-auto mb-2"><i class="fa-solid fa-arrow-trend-up"></i></div>
                            <div class="text-muted small">Tingkat Inflasi</div>
                            <div class="fw-bold fs-6 mt-1" id="dash-inflation">Loading...</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-xl-2">
                        <div class="glass-card p-3 text-center">
                            <div class="metric-icon bg-info bg-opacity-10 text-info mx-auto mb-2"><i class="fa-solid fa-users"></i></div>
                            <div class="text-muted small">Populasi</div>
                            <div class="fw-bold fs-6 mt-1" id="dash-population">Loading...</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-xl-2">
                        <div class="glass-card p-3 text-center">
                            <div class="metric-icon bg-success bg-opacity-10 text-success mx-auto mb-2"><i class="fa-solid fa-money-bill-transfer"></i></div>
                            <div class="text-muted small">Kurs vs USD</div>
                            <div class="fw-bold fs-6 mt-1" id="dash-currency">Loading...</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-xl-2">
                        <div class="glass-card p-3 text-center">
                            <div class="metric-icon bg-danger bg-opacity-10 text-danger mx-auto mb-2"><i class="fa-solid fa-temperature-three-quarters"></i></div>
                            <div class="text-muted small">Cuaca Saat Ini</div>
                            <div class="fw-bold fs-6 mt-1" id="dash-weather">Loading...</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-xl-2">
                        <div class="glass-card p-3 text-center">
                            <div class="metric-icon bg-secondary bg-opacity-10 text-white mx-auto mb-2"><i class="fa-solid fa-shield-cat"></i></div>
                            <div class="text-muted small">Risiko Logistik</div>
                            <div class="mt-1" id="dash-risk-badge"><span class="badge badge-risk-low px-3 py-2 fs-6">Low</span></div>
                        </div>
                    </div>
                </div>

                <!-- Detailed Country Overview Row -->
                <div class="row g-4">
                    <div class="col-lg-8">
                        <div class="glass-card p-4 h-100">
                            <h5 class="fw-bold mb-3"><i class="fa-solid fa-circle-info text-primary me-2"></i>Profil Indikator Rantai Pasok Global</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="p-3 bg-dark bg-opacity-50 rounded-3 border border-secondary border-opacity-25">
                                        <div class="text-muted small">Wilayah & Bahasa:</div>
                                        <div class="fw-bold" id="detail-region-lang">-</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-3 bg-dark bg-opacity-50 rounded-3 border border-secondary border-opacity-25">
                                        <div class="text-muted small">Nilai Ekspor & Impor (World Bank):</div>
                                        <div class="fw-bold" id="detail-trade-values">-</div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <h6 class="fw-semibold mt-3 text-muted">Komposisi Skor Indikator Risiko:</h6>
                                    <div class="mb-2">
                                        <div class="d-flex justify-content-between small mb-1">
                                            <span>Weather Risk (30%)</span>
                                            <span id="bar-weather-val">0 / 100</span>
                                        </div>
                                        <div class="progress bg-dark" style="height: 8px;">
                                            <div class="progress-bar bg-info" id="bar-weather" style="width: 0%"></div>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div class="d-flex justify-content-between small mb-1">
                                            <span>Inflation / Economic Risk (20%)</span>
                                            <span id="bar-economic-val">0 / 100</span>
                                        </div>
                                        <div class="progress bg-dark" style="height: 8px;">
                                            <div class="progress-bar bg-warning" id="bar-economic" style="width: 0%"></div>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div class="d-flex justify-content-between small mb-1">
                                            <span>News & Geopolitical Sentiment Risk (40%)</span>
                                            <span id="bar-news-val">0 / 100</span>
                                        </div>
                                        <div class="progress bg-dark" style="height: 8px;">
                                            <div class="progress-bar bg-danger" id="bar-news" style="width: 0%"></div>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div class="d-flex justify-content-between small mb-1">
                                            <span>Currency Fluctuation Risk (10%)</span>
                                            <span id="bar-currency-val">0 / 100</span>
                                        </div>
                                        <div class="progress bg-dark" style="height: 8px;">
                                            <div class="progress-bar bg-success" id="bar-currency" style="width: 0%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="glass-card p-4 h-100">
                            <h5 class="fw-bold mb-3"><i class="fa-solid fa-fire-flame-curved text-danger me-2"></i>Global Ranking Overview</h5>
                            <div class="table-responsive" style="max-height: 320px; overflow-y: auto;">
                                <table class="table table-custom table-hover align-middle mb-0" id="global-ranking-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Negara</th>
                                            <th>Score</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Loaded dynamically -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB 2: RISK SCORING ENGINE -->
            <div class="tab-pane fade" id="tab-risk">
                <div class="row g-4">
                    <div class="col-lg-5">
                        <div class="glass-card p-4">
                            <h5 class="fw-bold mb-3"><i class="fa-solid fa-calculator text-primary me-2"></i>Supply Chain Risk Prediction Engine</h5>
                            <p class="text-muted small">Algoritma Weighted Risk Scoring menghitung risiko secara real-time berdasarkan data Multi-API (Weather, World Bank, ExchangeRate, GNews Lexicon Sentiment).</p>

                            <div class="p-3 bg-dark rounded-3 border border-secondary mb-4">
                                <div class="small text-muted mb-2">FORMULA WEIGHTED SCORING MODEL:</div>
                                <code class="text-warning">Total Risk = (Weather × 30%) + (Inflation × 20%) + (News × 40%) + (Currency × 10%)</code>
                            </div>

                            <div class="text-center p-4 bg-dark bg-opacity-75 rounded-3 border border-secondary">
                                <div class="text-muted small mb-1">HASIL RISK SCORE PREDIKSI:</div>
                                <div class="display-3 fw-extrabold text-warning my-2" id="risk-score-display">--</div>
                                <div id="risk-status-badge-lg"><span class="badge badge-risk-medium px-4 py-2 fs-5">Calculating...</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="glass-card p-4">
                            <h5 class="fw-bold mb-3"><i class="fa-solid fa-list-check me-2"></i>Breakdown Komponen Indikator Prediksi</h5>
                            <div class="table-responsive">
                                <table class="table table-custom align-middle">
                                    <thead>
                                        <tr>
                                            <th>Indikator Risk</th>
                                            <th>Bobot Model</th>
                                            <th>Sub-Skor (0-100)</th>
                                            <th>Kontribusi Skor</th>
                                        </tr>
                                    </thead>
                                    <tbody id="risk-breakdown-tbody">
                                        <!-- Loaded dynamically -->
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-4 p-3 bg-primary bg-opacity-10 border border-primary border-opacity-25 rounded-3">
                                <div class="fw-semibold text-primary"><i class="fa-solid fa-lightbulb me-2"></i>Rekomendasi Keputusan Bisnis:</div>
                                <div class="small text-muted mt-1" id="risk-decision-recommendation">Pilih negara pada dashboard untuk melihat analisis mitigasi rantai pasokan.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB 3: GLOBAL WEATHER MONITORING -->
            <div class="tab-pane fade" id="tab-weather">
                <div class="glass-card p-4">
                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
                        <h5 class="fw-bold m-0"><i class="fa-solid fa-cloud-showers-heavy text-info me-2"></i>Monitoring Cuaca Ekstrem & Gangguan Logistik Global</h5>
                        <div class="text-muted small"><i class="fa-solid fa-circle-dot text-success me-1"></i>Data Source: Open-Meteo Real-time Weather API</div>
                    </div>
                    <div id="weather-map" class="map-container mb-3"></div>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="p-3 bg-dark rounded-3 border border-secondary text-center">
                                <i class="fa-solid fa-wind text-info fs-4 mb-2"></i>
                                <div class="text-muted small">Kecepatan Angin Maksimal</div>
                                <div class="fw-bold fs-5" id="weather-wind-display">-- km/h</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 bg-dark rounded-3 border border-secondary text-center">
                                <i class="fa-solid fa-temperature-high text-warning fs-4 mb-2"></i>
                                <div class="text-muted small">Temperatur Suhu</div>
                                <div class="fw-bold fs-5" id="weather-temp-display">-- °C</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 bg-dark rounded-3 border border-secondary text-center">
                                <i class="fa-solid fa-triangle-exclamation text-danger fs-4 mb-2"></i>
                                <div class="text-muted small">Tingkat Risiko Badai/Cuaca</div>
                                <div class="fw-bold fs-5" id="weather-risk-display">--</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB 4: CURRENCY IMPACT DASHBOARD -->
            <div class="tab-pane fade" id="tab-currency">
                <div class="row g-4">
                    <div class="col-lg-8">
                        <div class="glass-card p-4">
                            <h5 class="fw-bold mb-3"><i class="fa-solid fa-chart-line text-success me-2"></i>Grafik Pergerakan & Volatilitas Kurs Mata Uang</h5>
                            <div style="height: 340px;">
                                <canvas id="currencyTrendChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="glass-card p-4">
                            <h5 class="fw-bold mb-3"><i class="fa-solid fa-coins text-warning me-2"></i>Summary Nilai Tukar</h5>
                            <div class="p-3 bg-dark rounded-3 border border-secondary mb-3">
                                <div class="text-muted small">Pasangan Mata Uang:</div>
                                <div class="fw-bold fs-5 text-white" id="curr-pair-display">USD / -</div>
                                <div class="display-6 fw-bold text-success my-2" id="curr-rate-display">0.00</div>
                                <div class="small" id="curr-change-display"><span class="text-muted">Perubahan 24j: 0.00%</span></div>
                            </div>
                            <div class="p-3 bg-dark rounded-3 border border-secondary">
                                <div class="text-muted small">Status Risiko Volatilitas:</div>
                                <div class="fw-bold mt-1" id="curr-risk-badge-display"><span class="badge badge-risk-low px-3 py-2">Low Volatility</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB 5: NEWS INTELLIGENCE & SENTIMENT ANALYSIS -->
            <div class="tab-pane fade" id="tab-news">
                <div class="row g-4">
                    <div class="col-lg-5">
                        <div class="glass-card p-4">
                            <h5 class="fw-bold mb-3"><i class="fa-solid fa-brain text-purple me-2"></i>Lexicon-Based Sentiment Analysis AI</h5>
                            <p class="text-muted small">Analisis Sentimen Otomatis berbasis Kamus Kata (Dictionary Positive & Negative Words) pada berita logistik & geopolitik.</p>

                            <div class="mb-4">
                                <div class="d-flex justify-content-between text-xs mb-1">
                                    <span class="text-success"><i class="fa-solid fa-face-smile me-1"></i>Positive News (<span id="pct-pos-text">0%</span>)</span>
                                    <span class="text-secondary"><i class="fa-solid fa-face-meh me-1"></i>Neutral (<span id="pct-neu-text">0%</span>)</span>
                                    <span class="text-danger"><i class="fa-solid fa-face-frown me-1"></i>Negative (<span id="pct-neg-text">0%</span>)</span>
                                </div>
                                <div class="progress bg-dark" style="height: 18px;">
                                    <div class="progress-bar sentiment-bar-pos" id="bar-pos-pct" style="width: 0%"></div>
                                    <div class="progress-bar sentiment-bar-neu" id="bar-neu-pct" style="width: 0%"></div>
                                    <div class="progress-bar sentiment-bar-neg" id="bar-neg-pct" style="width: 0%"></div>
                                </div>
                            </div>

                            <div style="height: 220px;">
                                <canvas id="sentimentPieChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="glass-card p-4">
                            <h5 class="fw-bold mb-3"><i class="fa-solid fa-newspaper text-info me-2"></i>News Intelligence Feed (GNews API)</h5>
                            <div id="news-feed-container" style="max-height: 480px; overflow-y: auto;" class="pe-2">
                                <div class="text-center text-muted py-5"><i class="fa-solid fa-spinner fa-spin me-2"></i>Loading news feed...</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB 6: WORLD PORTS MAP -->
            <div class="tab-pane fade" id="tab-ports">
                <div class="glass-card p-4">
                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-3">
                        <h5 class="fw-bold m-0"><i class="fa-solid fa-anchor text-primary me-2"></i>Port Location Dashboard & Global Shipping Hubs</h5>
                        <div class="d-flex gap-2" style="max-width: 400px; width: 100%;">
                            <input type="text" class="form-control form-control-sm" id="port-search-input" placeholder="Cari nama pelabuhan / negara..." onkeyup="filterPortsMap()">
                        </div>
                    </div>
                    <div id="ports-map" class="map-container"></div>
                </div>
            </div>

            <!-- TAB 7: DATA VISUALIZATION DASHBOARD -->
            <div class="tab-pane fade" id="tab-charts">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="glass-card p-4">
                            <h6 class="fw-bold mb-3"><i class="fa-solid fa-chart-area me-2 text-primary"></i>Perbandingan GDP Trend Antar Negara</h6>
                            <div style="height: 260px;">
                                <canvas id="gdpComparisonChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="glass-card p-4">
                            <h6 class="fw-bold mb-3"><i class="fa-solid fa-chart-line me-2 text-warning"></i>Tren Inflasi Global</h6>
                            <div style="height: 260px;">
                                <canvas id="inflationTrendChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="glass-card p-4">
                            <h6 class="fw-bold mb-3"><i class="fa-solid fa-shield-virus me-2 text-danger"></i>Tren Historis Risk Score Antar Waktu</h6>
                            <div style="height: 280px;">
                                <canvas id="riskTrendChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB 8: COUNTRY COMPARISON ENGINE -->
            <div class="tab-pane fade" id="tab-compare">
                <div class="glass-card p-4 mb-4">
                    <h5 class="fw-bold mb-3"><i class="fa-solid fa-scale-balanced text-primary me-2"></i>Country Comparison Engine</h5>
                    <div class="row g-3 align-items-center">
                        <div class="col-md-5">
                            <label class="form-label small text-muted">Negara 1:</label>
                            <select class="form-select bg-dark text-white" id="compare-c1">
                                @foreach($allCountries as $c)
                                    <option value="{{ $c->code }}" {{ $c->code === 'DEU' ? 'selected' : '' }}>{{ $c->name }} ({{ $c->code }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 text-center pt-md-4">
                            <span class="badge bg-primary px-3 py-2 fs-6">VS</span>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label small text-muted">Negara 2:</label>
                            <select class="form-select bg-dark text-white" id="compare-c2">
                                @foreach($allCountries as $c)
                                    <option value="{{ $c->code }}" {{ $c->code === 'IDN' ? 'selected' : '' }}>{{ $c->name }} ({{ $c->code }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 text-center mt-3">
                            <button class="btn btn-primary rounded-pill px-4" onclick="runCountryComparison()"><i class="fa-solid fa-magnifying-glass-chart me-2"></i>Bandingkan Indikator</button>
                        </div>
                    </div>
                </div>

                <div class="row g-4" id="comparison-result-row" style="display: none;">
                    <div class="col-lg-6">
                        <div class="glass-card p-4">
                            <h5 class="fw-bold text-primary mb-3" id="comp-c1-title">Germany</h5>
                            <table class="table table-custom align-middle">
                                <tr><th>GDP Nominal:</th><td id="comp-c1-gdp">-</td></tr>
                                <tr><th>Inflasi:</th><td id="comp-c1-inf">-</td></tr>
                                <tr><th>Mata Uang & Kurs:</th><td id="comp-c1-curr">-</td></tr>
                                <tr><th>Cuaca & Wind:</th><td id="comp-c1-weather">-</td></tr>
                                <tr><th>Sentimen Berita:</th><td id="comp-c1-news">-</td></tr>
                                <tr><th>Total Risk Score:</th><td><span class="fw-bold fs-5 text-warning" id="comp-c1-risk">-</span></td></tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="glass-card p-4">
                            <h5 class="fw-bold text-success mb-3" id="comp-c2-title">Australia</h5>
                            <table class="table table-custom align-middle">
                                <tr><th>GDP Nominal:</th><td id="comp-c2-gdp">-</td></tr>
                                <tr><th>Inflasi:</th><td id="comp-c2-inf">-</td></tr>
                                <tr><th>Mata Uang & Kurs:</th><td id="comp-c2-curr">-</td></tr>
                                <tr><th>Cuaca & Wind:</th><td id="comp-c2-weather">-</td></tr>
                                <tr><th>Sentimen Berita:</th><td id="comp-c2-news">-</td></tr>
                                <tr><th>Total Risk Score:</th><td><span class="fw-bold fs-5 text-warning" id="comp-c2-risk">-</span></td></tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB 9: WATCHLIST -->
            <div class="tab-pane fade" id="tab-watchlist">
                <div class="glass-card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold m-0"><i class="fa-solid fa-star text-warning me-2"></i>Favorite Monitoring List</h5>
                        <button class="btn btn-sm btn-outline-light rounded-pill" onclick="loadWatchlistTab()"><i class="fa-solid fa-rotate me-1"></i> Refresh</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-custom table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Negara</th>
                                    <th>Kode ISO</th>
                                    <th>Mata Uang</th>
                                    <th>Total Risk Score</th>
                                    <th>Risk Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="watchlist-tbody">
                                <!-- Loaded dynamically -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            @if(Auth::check() && Auth::user()->role === 'admin')
            <!-- TAB 10: ADMIN DASHBOARD -->
            <div class="tab-pane fade" id="tab-admin">
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <div class="glass-card p-4">
                            <h5 class="fw-bold mb-3"><i class="fa-solid fa-users-gear text-primary me-2"></i>Manajemen User</h5>
                            <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
                                <table class="table table-custom align-middle small mb-0">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="admin-users-tbody">
                                        <!-- Loaded dynamically -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="glass-card p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="fw-bold m-0"><i class="fa-solid fa-file-pen text-success me-2"></i>Artikel Analisis</h5>
                                <button class="btn btn-sm btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#addArticleModal">+ Artikel Baru</button>
                            </div>
                            <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
                                <table class="table table-custom align-middle small mb-0">
                                    <thead>
                                        <tr>
                                            <th>Judul</th>
                                            <th>Penulis</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="admin-articles-tbody">
                                        <!-- Loaded dynamically -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Admin Port Management Row -->
                <div class="row g-4">
                    <div class="col-12">
                        <div class="glass-card p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="fw-bold m-0"><i class="fa-solid fa-ship text-info me-2"></i>Manajemen Dataset Pelabuhan Global</h5>
                                <button class="btn btn-sm btn-info text-white rounded-pill" data-bs-toggle="modal" data-bs-target="#addPortModal">+ Pelabuhan Baru</button>
                            </div>
                            <div class="table-responsive" style="max-height: 320px; overflow-y: auto;">
                                <table class="table table-custom align-middle small mb-0">
                                    <thead>
                                        <tr>
                                            <th>Nama Pelabuhan</th>
                                            <th>Negara</th>
                                            <th>Latitude</th>
                                            <th>Longitude</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="admin-ports-tbody">
                                        <!-- Loaded dynamically -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>

    <!-- Modal Add Article -->
    <div class="modal fade" id="addArticleModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-white border-secondary">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title">Tambah Artikel Analisis</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="add-article-form">
                        <div class="mb-3">
                            <label class="form-label">Judul Artikel:</label>
                            <input type="text" class="form-control" id="art-title" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Konten Analisis:</label>
                            <textarea class="form-control" id="art-content" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Simpan Artikel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add Port -->
    <div class="modal fade" id="addPortModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-white border-secondary">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title"><i class="fa-solid fa-ship me-2"></i>Tambah Pelabuhan Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="add-port-form">
                        <div class="mb-3">
                            <label class="form-label">Nama Pelabuhan:</label>
                            <input type="text" class="form-control" id="port-name" required placeholder="e.g. Port of Rotterdam">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Negara:</label>
                            <input type="text" class="form-control" id="port-country" required placeholder="e.g. Netherlands">
                        </div>
                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label class="form-label">Latitude:</label>
                                <input type="number" step="any" class="form-control" id="port-lat" required placeholder="51.95">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Longitude:</label>
                                <input type="number" step="any" class="form-control" id="port-lng" required placeholder="4.15">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info text-white w-100">Simpan Pelabuhan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        // Global App State & Dynamic Base API URL
        const API_BASE = (function() {
            let base = window.location.origin;
            const path = window.location.pathname;
            if (path.includes('/public/')) {
                base += path.substring(0, path.indexOf('/public/') + 8);
            } else if (path.includes('/index.php')) {
                base += path.substring(0, path.indexOf('/index.php'));
            }
            return base.replace(/\/$/, '') + '/api';
        })();

        let currentCountryCode = 'DEU';
        let currentCountryData = null;
        let weatherMap = null, weatherMarker = null;
        let portsMap = null, portsMarkersGroup = null;
        let globalPortsData = [];
        let currencyChart = null, sentimentChart = null, gdpChart = null, inflationChart = null, riskChart = null;

        document.addEventListener("DOMContentLoaded", async function () {
            try { await populateCountryDropdowns(); } catch (e) { console.error("populateCountryDropdowns error:", e); }
            const initialCode = document.getElementById('global-country-select')?.value || currentCountryCode;
            try { await loadCountryDashboard(initialCode); } catch (e) { console.error("loadCountryDashboard error:", e); }
            try { await loadGlobalRanking(); } catch (e) { console.error("loadGlobalRanking error:", e); }
            try { await initPortsMap(); } catch (e) { console.error("initPortsMap error:", e); }
            try { initWeatherMap(); } catch (e) { console.error("initWeatherMap error:", e); }
            try { initCharts(); } catch (e) { console.error("initCharts error:", e); }
            try { loadWatchlistTab(); } catch (e) { console.error("loadWatchlistTab error:", e); }
            try { loadAdminData(); } catch (e) { console.error("loadAdminData error:", e); }

            // Tab listeners for map re-render fixes
            document.getElementById('tab-weather-btn')?.addEventListener('shown.bs.tab', function () {
                if (weatherMap) weatherMap.invalidateSize();
            });
            document.getElementById('tab-ports-btn')?.addEventListener('shown.bs.tab', function () {
                if (portsMap) portsMap.invalidateSize();
            });
        });

        async function populateCountryDropdowns() {
            try {
                const res = await fetch(`${API_BASE}/countries`);
                const countries = await res.json();
                const dataArr = Array.isArray(countries) ? countries : (countries.data || []);
                if (Array.isArray(dataArr) && dataArr.length > 0) {
                    const globalSelect = document.getElementById('global-country-select');
                    const compC1 = document.getElementById('compare-c1');
                    const compC2 = document.getElementById('compare-c2');

                    let opts = '';
                    dataArr.forEach(c => {
                        opts += `<option value="${c.code}">${c.name} (${c.code})</option>`;
                    });

                    if (globalSelect) {
                        const val = globalSelect.value;
                        globalSelect.innerHTML = opts;
                        if ([...globalSelect.options].some(o => o.value === val)) {
                            globalSelect.value = val;
                        } else {
                            globalSelect.value = dataArr[0].code;
                        }
                    }
                    if (compC1) {
                        compC1.innerHTML = opts;
                        compC1.value = dataArr[0].code;
                    }
                    if (compC2) {
                        compC2.innerHTML = opts;
                        if (dataArr.length > 1) compC2.value = dataArr[1].code;
                    }
                }
            } catch (err) {
                console.error("Error fetching countries list:", err);
            }
        }


        // 1. GLOBAL COUNTRY DASHBOARD & AJAX FETCH
        async function loadCountryDashboard(code) {
            currentCountryCode = code;

            // Fetch Country Detail
            try {
                const resC = await fetch(`${API_BASE}/countries/${code}`);
                const dataC = await resC.json();
                if (dataC.success && dataC.data) {
                    currentCountryData = dataC.data;
                    document.getElementById('detail-region-lang').innerText = `${currentCountryData.region || '-'} | Currency: ${currentCountryData.currency || '-'} | Lang: ${currentCountryData.language || '-'}`;
                    updateWeatherMapLocation(currentCountryData.latitude, currentCountryData.longitude, currentCountryData.name);
                }
            } catch (err) { console.error("Error fetching country detail:", err); }

            // Fetch Economy Data
            try {
                const resE = await fetch(`${API_BASE}/economy/${code}`);
                const dataE = await resE.json();
                if (dataE.success && dataE.economy) {
                    const eco = dataE.economy;
                    document.getElementById('dash-gdp').innerText = eco.gdp ? '$' + Number(eco.gdp).toLocaleString() : 'N/A';
                    document.getElementById('dash-inflation').innerText = (eco.inflation !== null && eco.inflation !== undefined) ? Number(eco.inflation).toFixed(2) + '%' : 'N/A';
                    document.getElementById('dash-population').innerText = eco.population ? Number(eco.population).toLocaleString() : 'N/A';
                    document.getElementById('detail-trade-values').innerText = `Export: ${eco.export ? '$' + Number(eco.export).toLocaleString() : 'N/A'} | Import: ${eco.import ? '$' + Number(eco.import).toLocaleString() : 'N/A'}`;
                }
            } catch (err) {
                console.error("Error fetching economy:", err);
                document.getElementById('dash-gdp').innerText = 'N/A';
                document.getElementById('dash-inflation').innerText = 'N/A';
                document.getElementById('dash-population').innerText = 'N/A';
            }

            // Fetch Currency Rate
            try {
                const resCurr = await fetch(`${API_BASE}/currency/${code}`);
                const dataCurr = await resCurr.json();
                if (dataCurr.success && dataCurr.currency) {
                    const curr = dataCurr.currency;
                    document.getElementById('dash-currency').innerText = curr.formatted || 'N/A';
                    if (document.getElementById('curr-pair-display')) document.getElementById('curr-pair-display').innerText = `USD / ${curr.target}`;
                    if (document.getElementById('curr-rate-display')) document.getElementById('curr-rate-display').innerText = curr.rate;
                    if (document.getElementById('curr-change-display')) document.getElementById('curr-change-display').innerHTML = `<span class="text-muted">Rate Risk Level: </span><strong class="text-warning">${curr.risk}</strong>`;
                }
            } catch (err) {
                console.error("Error fetching currency:", err);
                document.getElementById('dash-currency').innerText = 'N/A';
            }

            // Fetch Weather Data
            try {
                const resW = await fetch(`${API_BASE}/weather/${code}`);
                const dataW = await resW.json();
                if (dataW.success && dataW.weather) {
                    const w = dataW.weather;
                    document.getElementById('dash-weather').innerText = `${w.temperature}°C, ${w.wind_speed}km/h`;
                    if (document.getElementById('weather-temp-display')) document.getElementById('weather-temp-display').innerText = `${w.temperature} °C`;
                    if (document.getElementById('weather-wind-display')) document.getElementById('weather-wind-display').innerText = `${w.wind_speed} km/h`;
                    if (document.getElementById('weather-risk-display')) document.getElementById('weather-risk-display').innerText = w.risk;
                }
            } catch (err) {
                console.error("Error fetching weather:", err);
                document.getElementById('dash-weather').innerText = 'N/A';
            }

            // Fetch Risk Score
            try {
                const resR = await fetch(`${API_BASE}/risk/${code}`);
                const dataR = await resR.json();
                if (dataR.success && dataR.risk) {
                    updateRiskUI(dataR.risk);
                }
            } catch (err) { console.error("Error fetching risk:", err); }

            // Fetch News Feed & Sentiment
            loadNewsFeed(code);
        }

        function updateRiskUI(r) {
            document.getElementById('risk-score-display').innerText = r.total_score;

            let badgeHtml = '';
            if (r.status.includes('High')) badgeHtml = `<span class="badge badge-risk-high px-4 py-2 fs-5">High Risk</span>`;
            else if (r.status.includes('Medium')) badgeHtml = `<span class="badge badge-risk-medium px-4 py-2 fs-5">Medium Risk</span>`;
            else badgeHtml = `<span class="badge badge-risk-low px-4 py-2 fs-5">Low Risk</span>`;

            document.getElementById('dash-risk-badge').innerHTML = badgeHtml;
            document.getElementById('risk-status-badge-lg').innerHTML = badgeHtml;

            // Update Progress Bars
            document.getElementById('bar-weather').style.width = r.weather_risk + '%';
            document.getElementById('bar-weather-val').innerText = r.weather_risk + ' / 100';

            document.getElementById('bar-economic').style.width = r.inflation_risk + '%';
            document.getElementById('bar-economic-val').innerText = r.inflation_risk + ' / 100';

            document.getElementById('bar-news').style.width = r.news_risk + '%';
            document.getElementById('bar-news-val').innerText = r.news_risk + ' / 100';

            document.getElementById('bar-currency').style.width = r.currency_risk + '%';
            document.getElementById('bar-currency-val').innerText = r.currency_risk + ' / 100';

            // Risk Breakdown Table
            const tbody = document.getElementById('risk-breakdown-tbody');
            tbody.innerHTML = `
                <tr><td>Weather Risk</td><td>30%</td><td>${r.weather_risk}</td><td>+${(r.weather_risk * 0.30).toFixed(1)} pts</td></tr>
                <tr><td>Inflation / Economic Risk</td><td>20%</td><td>${r.inflation_risk}</td><td>+${(r.inflation_risk * 0.20).toFixed(1)} pts</td></tr>
                <tr><td>Geopolitical News Risk</td><td>40%</td><td>${r.news_risk}</td><td>+${(r.news_risk * 0.40).toFixed(1)} pts</td></tr>
                <tr><td>Currency Fluctuation Risk</td><td>10%</td><td>${r.currency_risk}</td><td>+${(r.currency_risk * 0.10).toFixed(1)} pts</td></tr>
            `;

            // Recommendation
            const rec = document.getElementById('risk-decision-recommendation');
            if (r.total_score >= 65) {
                rec.innerHTML = `<span class="text-danger fw-bold"><i class="fa-solid fa-triangle-exclamation me-1"></i>Tingkat Risiko Tinggi (${r.total_score}):</span> Disarankan diversifikasi rute pengiriman dan mempersiapkan buffer stock persediaan bahan baku.`;
            } else if (r.total_score >= 40) {
                rec.innerHTML = `<span class="text-warning fw-bold"><i class="fa-solid fa-circle-info me-1"></i>Tingkat Risiko Sedang (${r.total_score}):</span> Lakukan pemantauan berkala terhadap fluktuasi kurs dan indeks cuaca pelabuhan transit.`;
            } else {
                rec.innerHTML = `<span class="text-success fw-bold"><i class="fa-solid fa-circle-check me-1"></i>Tingkat Risiko Rendah (${r.total_score}):</span> Rantai pasokan stabil. Operasi pengiriman logistik dapat berjalan sesuai rencana reguler.`;
            }
        }

        async function loadGlobalRanking() {
            try {
                const res = await fetch(`${API_BASE}/risk-ranking`);
                const data = await res.json();
                if (data.success) {
                    const tbody = document.querySelector('#global-ranking-table tbody');
                    tbody.innerHTML = '';
                    const labels = [];
                    const scores = [];
                    const infScores = [];

                    data.ranking.forEach((item, idx) => {
                        let badgeClass = item.status.includes('High') ? 'badge-risk-high' : (item.status.includes('Medium') ? 'badge-risk-medium' : 'badge-risk-low');
                        tbody.innerHTML += `
                            <tr>
                                <td>${idx + 1}</td>
                                <td><strong class="text-white">${item.country}</strong></td>
                                <td><span class="fw-bold">${item.score}</span></td>
                                <td><span class="badge ${badgeClass} px-2 py-1">${item.status}</span></td>
                            </tr>
                        `;
                        labels.push(item.country);
                        scores.push(item.score);
                        infScores.push(item.inflation_risk);
                    });

                    // Update Data Visualization Charts dynamically
                    if (gdpChart && labels.length > 0) {
                        gdpChart.data.labels = labels.slice(0, 7);
                        gdpChart.data.datasets[0].data = scores.slice(0, 7);
                        gdpChart.update();
                    }
                    if (inflationChart && labels.length > 0) {
                        inflationChart.data.labels = labels.slice(0, 7);
                        inflationChart.data.datasets[0].data = infScores.slice(0, 7);
                        inflationChart.update();
                    }
                }
            } catch (err) {
                console.error("Error loading ranking:", err);
            }
        }


        // 2. NEWS INTELLIGENCE & SENTIMENT ANALYSIS
        async function loadNewsFeed(code) {
            const container = document.getElementById('news-feed-container');
            container.innerHTML = '<div class="text-center text-muted py-5"><i class="fa-solid fa-spinner fa-spin me-2"></i>Loading news sentiment...</div>';
            try {
                const res = await fetch(`${API_BASE}/news/${code}`);
                const data = await res.json();
                if (data.success) {
                    const s = data.summary;
                    document.getElementById('pct-pos-text').innerText = s.positive_percentage + '%';
                    document.getElementById('pct-neu-text').innerText = s.neutral_percentage + '%';
                    document.getElementById('pct-neg-text').innerText = s.negative_percentage + '%';

                    document.getElementById('bar-pos-pct').style.width = s.positive_percentage + '%';
                    document.getElementById('bar-neu-pct').style.width = s.neutral_percentage + '%';
                    document.getElementById('bar-neg-pct').style.width = s.negative_percentage + '%';

                    updateSentimentChart(s.positive_percentage, s.neutral_percentage, s.negative_percentage);

                    container.innerHTML = '';
                    if (data.news.length === 0) {
                        container.innerHTML = '<div class="text-muted p-3">Belum ada berita tersimpan untuk negara ini.</div>';
                    } else {
                        data.news.forEach(item => {
                            let sentClass = item.sentiment === 'Positive' ? 'text-success border-success' : (item.sentiment === 'Negative' ? 'text-danger border-danger' : 'text-secondary border-secondary');
                            container.innerHTML += `
                                <div class="p-3 bg-dark bg-opacity-50 rounded-3 mb-2 border border-secondary border-opacity-25">
                                    <div class="d-flex justify-content-between align-items-start gap-2">
                                        <h6 class="fw-bold text-white mb-1 small">${item.title}</h6>
                                        <span class="badge border ${sentClass} bg-transparent">${item.sentiment}</span>
                                    </div>
                                    <p class="text-muted small mb-1">${item.description || ''}</p>
                                    <div class="text-xs text-muted" style="font-size: 0.75rem;"><i class="fa-solid fa-newspaper me-1"></i>Source: ${item.source || 'Intelligence Feed'}</div>
                                </div>
                            `;
                        });
                    }
                }
            } catch (err) {
                container.innerHTML = '<div class="text-danger p-3">Gagal memuat berita news intelligence.</div>';
            }
        }

        // 3. LEAFLET MAPS IMPLEMENTATION
        function initWeatherMap() {
            weatherMap = L.map('weather-map').setView([51.1657, 10.4515], 4);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(weatherMap);

            weatherMarker = L.marker([51.1657, 10.4515]).addTo(weatherMap)
                .bindPopup("<b>Weather Monitoring Station</b>").openPopup();
        }

        function updateWeatherMapLocation(lat, lng, countryName) {
            if (!weatherMap) return;
            weatherMap.setView([lat, lng], 5);
            if (weatherMarker) weatherMap.removeLayer(weatherMarker);
            weatherMarker = L.marker([lat, lng]).addTo(weatherMap)
                .bindPopup(`<b>${countryName} Weather Zone</b><br>Lat: ${lat}, Lng: ${lng}`)
                .openPopup();
        }

        async function initPortsMap() {
            portsMap = L.map('ports-map').setView([20.0, 0.0], 2);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(portsMap);

            portsMarkersGroup = L.layerGroup().addTo(portsMap);

            try {
                const res = await fetch(`${API_BASE}/ports`);
                const data = await res.json();
                if (data.success) {
                    globalPortsData = data.data;
                    renderPortsMarkers(globalPortsData);
                }
            } catch (err) {
                console.error("Error loading ports map:", err);
            }
        }

        function renderPortsMarkers(ports) {
            if (!portsMarkersGroup) return;
            portsMarkersGroup.clearLayers();
            ports.forEach(port => {
                const marker = L.marker([port.latitude, port.longitude]);
                marker.bindPopup(`
                    <div class="text-dark">
                        <strong class="fs-6">${port.name}</strong><br>
                        <span>Country: <b>${port.country}</b></span><br>
                        <small class="text-muted">Coords: ${port.latitude}, ${port.longitude}</small>
                    </div>
                `);
                portsMarkersGroup.addLayer(marker);
            });
        }

        function filterPortsMap() {
            const query = document.getElementById('port-search-input').value.toLowerCase();
            const filtered = globalPortsData.filter(p => p.name.toLowerCase().includes(query) || p.country.toLowerCase().includes(query));
            renderPortsMarkers(filtered);
        }

        // 4. CHART.JS INITIALIZATION
        function initCharts() {
            // Sentiment Pie Chart
            const ctxSent = document.getElementById('sentimentPieChart').getContext('2d');
            sentimentChart = new Chart(ctxSent, {
                type: 'doughnut',
                data: {
                    labels: ['Positive', 'Neutral', 'Negative'],
                    datasets: [{
                        data: [60, 25, 15],
                        backgroundColor: ['#10b981', '#64748b', '#ef4444'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { labels: { color: '#cbd5e1' } } }
                }
            });

            // Currency Trend Line Chart
            const ctxCurr = document.getElementById('currencyTrendChart').getContext('2d');
            currencyChart = new Chart(ctxCurr, {
                type: 'line',
                data: {
                    labels: ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5', 'Today'],
                    datasets: [{
                        label: 'Exchange Rate Trend vs USD',
                        data: [0.91, 0.92, 0.915, 0.922, 0.918, 0.925],
                        borderColor: '#3b82f6',
                        backgroundColor: 'rgba(59, 130, 246, 0.15)',
                        fill: true,
                        tension: 0.3
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: { ticks: { color: '#94a3b8' } },
                        y: { ticks: { color: '#94a3b8' } }
                    },
                    plugins: { legend: { labels: { color: '#cbd5e1' } } }
                }
            });

            // GDP Comparison Chart
            const ctxGdp = document.getElementById('gdpComparisonChart').getContext('2d');
            gdpChart = new Chart(ctxGdp, {
                type: 'bar',
                data: {
                    labels: ['Germany', 'China', 'Indonesia', 'Australia', 'USA'],
                    datasets: [{
                        label: 'GDP Nominal ($ Trillion)',
                        data: [4.4, 17.7, 1.3, 1.7, 25.4],
                        backgroundColor: '#3b82f6'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: { x: { ticks: { color: '#94a3b8' } }, y: { ticks: { color: '#94a3b8' } } }
                }
            });

            // Inflation Trend Chart
            const ctxInf = document.getElementById('inflationTrendChart').getContext('2d');
            inflationChart = new Chart(ctxInf, {
                type: 'bar',
                data: {
                    labels: ['Germany', 'China', 'Indonesia', 'Australia', 'USA'],
                    datasets: [{
                        label: 'Inflation Rate (%)',
                        data: [2.2, 0.7, 2.8, 3.6, 3.1],
                        backgroundColor: '#f59e0b'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: { x: { ticks: { color: '#94a3b8' } }, y: { ticks: { color: '#94a3b8' } } }
                }
            });

            // Risk Trend Line Chart
            const ctxRisk = document.getElementById('riskTrendChart').getContext('2d');
            riskChart = new Chart(ctxRisk, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                    datasets: [
                        { label: 'Germany Risk Trend', data: [24, 22, 25, 21, 23, 22, 22], borderColor: '#10b981', tension: 0.3 },
                        { label: 'China Risk Trend', data: [42, 45, 48, 44, 46, 47, 47], borderColor: '#f59e0b', tension: 0.3 },
                        { label: 'Indonesia Risk Trend', data: [35, 36, 34, 38, 35, 33, 34], borderColor: '#3b82f6', tension: 0.3 }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: { x: { ticks: { color: '#94a3b8' } }, y: { ticks: { color: '#94a3b8' } } }
                }
            });
        }

        function updateSentimentChart(pos, neu, neg) {
            if (!sentimentChart) return;
            sentimentChart.data.datasets[0].data = [pos, neu, neg];
            sentimentChart.update();
        }

        // 5. COUNTRY COMPARISON ENGINE
        async function runCountryComparison() {
            const c1 = document.getElementById('compare-c1').value;
            const c2 = document.getElementById('compare-c2').value;

            try {
                const res = await fetch(`${API_BASE}/compare/${c1}/${c2}`);
                const data = await res.json();
                if (data.success) {
                    const row = document.getElementById('comparison-result-row');
                    row.style.display = 'flex';

                    const renderCountry = (prefix, d) => {
                        document.getElementById(`${prefix}-title`).innerText = d.info ? d.info.name : 'N/A';
                        document.getElementById(`${prefix}-gdp`).innerText = (d.economic && d.economic.gdp != null) ? '$' + Number(d.economic.gdp).toLocaleString() : 'N/A';
                        
                        const infVal = (d.economic && d.economic.inflation != null) ? Number(d.economic.inflation).toFixed(2) + '%' : 'N/A';
                        document.getElementById(`${prefix}-inf`).innerText = infVal;

                        const currRate = (d.currency && d.currency.rate != null) ? Number(d.currency.rate).toLocaleString() : 'N/A';
                        const currRisk = (d.currency && d.currency.risk_level) ? d.currency.risk_level : 'Low';
                        document.getElementById(`${prefix}-curr`).innerText = `${d.info ? d.info.currency : 'N/A'} (${currRate}) - Risk: ${currRisk}`;

                        const temp = (d.weather && d.weather.temperature != null) ? `${d.weather.temperature}°C` : 'N/A';
                        const wind = (d.weather && d.weather.wind_speed != null) ? `${d.weather.wind_speed} km/h` : 'N/A';
                        document.getElementById(`${prefix}-weather`).innerText = `${temp} - Wind: ${wind}`;

                        const pos = (d.news_sentiment && d.news_sentiment.positive != null) ? d.news_sentiment.positive : 0;
                        const neg = (d.news_sentiment && d.news_sentiment.negative != null) ? d.news_sentiment.negative : 0;
                        document.getElementById(`${prefix}-news`).innerText = `Pos: ${pos}%, Neg: ${neg}%`;

                        if (d.risk_score && d.risk_score.total_score != null) {
                            document.getElementById(`${prefix}-risk`).innerText = `${d.risk_score.total_score} (${d.risk_score.status || 'N/A'})`;
                        } else {
                            document.getElementById(`${prefix}-risk`).innerText = 'N/A';
                        }
                    };

                    renderCountry('comp-c1', data.country1);
                    renderCountry('comp-c2', data.country2);
                }
            } catch (err) {
                console.error("Comparison error:", err);
            }
        }

        // 6. WATCHLIST & BOOKMARKS
        async function loadWatchlistTab() {
            try {
                const res = await fetch(`${API_BASE}/watchlists`);
                const data = await res.json();
                if (data.success) {
                    const tbody = document.getElementById('watchlist-tbody');
                    tbody.innerHTML = '';
                    if (data.data.length === 0) {
                        tbody.innerHTML = '<tr><td colspan="6" class="text-center text-muted py-4">Belum ada negara yang ditambahkan ke watchlist.</td></tr>';
                    } else {
                        data.data.forEach(item => {
                            let badgeClass = item.risk_status.includes('High') ? 'badge-risk-high' : (item.risk_status.includes('Medium') ? 'badge-risk-medium' : 'badge-risk-low');
                            tbody.innerHTML += `
                                <tr>
                                    <td><strong class="text-white">${item.country_name}</strong></td>
                                    <td><code>${item.country_code}</code></td>
                                    <td>${item.currency}</td>
                                    <td><span class="fw-bold">${item.total_score !== null ? item.total_score : 'N/A'}</span></td>
                                    <td><span class="badge ${badgeClass} px-3 py-1">${item.risk_status}</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-danger" onclick="removeFromWatchlist(${item.id})"><i class="fa-solid fa-trash me-1"></i> Hapus</button>
                                    </td>
                                </tr>
                            `;
                        });
                    }
                }
            } catch (err) {
                console.error("Watchlist error:", err);
            }
        }

        async function toggleWatchlistCurrent() {
            try {
                const res = await fetch(`${API_BASE}/watchlists`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: JSON.stringify({ code: currentCountryCode })
                });
                const data = await res.json();
                if (data.success) {
                    alert(`Negara ${currentCountryCode} berhasil ditambahkan ke Watchlist!`);
                    loadWatchlistTab();
                }
            } catch (err) {
                console.error("Toggle watchlist error:", err);
            }
        }

        async function removeFromWatchlist(id) {
            try {
                const res = await fetch(`${API_BASE}/watchlists/${id}`, {
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                });
                const data = await res.json();
                if (data.success) {
                    loadWatchlistTab();
                }
            } catch (err) {
                console.error("Remove watchlist error:", err);
            }
        }

        // 7. ADMIN DASHBOARD DATA
        async function loadAdminData() {
            try {
                // Load Users
                const resU = await fetch(`${API_BASE}/admin/users`);
                const dataU = await resU.json();
                if (dataU.success) {
                    const tbodyU = document.getElementById('admin-users-tbody');
                    tbodyU.innerHTML = '';
                    dataU.data.forEach(u => {
                        tbodyU.innerHTML += `
                            <tr>
                                <td>${u.name}</td>
                                <td>${u.email}</td>
                                <td><span class="badge bg-secondary">${u.role}</span></td>
                                <td>
                                    <button class="btn btn-xs btn-outline-warning py-0" onclick="toggleUserRole(${u.id}, '${u.role === 'admin' ? 'user' : 'admin'}')">Switch Role</button>
                                </td>
                            </tr>
                        `;
                    });
                }

                // Load Articles
                const resA = await fetch(`${API_BASE}/admin/articles`);
                const dataA = await resA.json();
                if (dataA.success) {
                    const tbodyA = document.getElementById('admin-articles-tbody');
                    tbodyA.innerHTML = '';
                    dataA.data.forEach(a => {
                        tbodyA.innerHTML += `
                            <tr>
                                <td><strong class="text-white">${a.title}</strong></td>
                                <td>${a.user ? a.user.name : 'Admin'}</td>
                                <td>
                                    <button class="btn btn-xs btn-outline-danger py-0" onclick="deleteArticle(${a.id})">Hapus</button>
                                </td>
                            </tr>
                        `;
                    });
                }

                // Load Ports Dataset
                const resP = await fetch(`${API_BASE}/ports`);
                const dataP = await resP.json();
                if (dataP.success) {
                    const tbodyP = document.getElementById('admin-ports-tbody');
                    tbodyP.innerHTML = '';
                    dataP.data.forEach(p => {
                        tbodyP.innerHTML += `
                            <tr>
                                <td><strong class="text-white">${p.name}</strong></td>
                                <td>${p.country}</td>
                                <td><code>${p.latitude}</code></td>
                                <td><code>${p.longitude}</code></td>
                                <td>
                                    <button class="btn btn-xs btn-outline-danger py-0" onclick="deletePort(${p.id})">Hapus</button>
                                </td>
                            </tr>
                        `;
                    });
                }
            } catch (err) {
                console.error("Admin data error:", err);
            }
        }

        async function toggleUserRole(id, newRole) {
            try {
                const res = await fetch(`${API_BASE}/admin/users/${id}/role`, {
                    method: 'PUT',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: JSON.stringify({ role: newRole })
                });
                const data = await res.json();
                if (data.success) loadAdminData();
            } catch (err) {
                console.error("User role update error:", err);
            }
        }

        async function deleteArticle(id) {
            if (!confirm("Hapus artikel ini?")) return;
            try {
                const res = await fetch(`${API_BASE}/admin/articles/${id}`, {
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                });
                const data = await res.json();
                if (data.success) loadAdminData();
            } catch (err) {
                console.error("Delete article error:", err);
            }
        }

        async function deletePort(id) {
            if (!confirm("Hapus pelabuhan ini?")) return;
            try {
                const res = await fetch(`${API_BASE}/admin/ports/${id}`, {
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                });
                const data = await res.json();
                if (data.success) {
                    loadAdminData();
                    initPortsMap();
                }
            } catch (err) {
                console.error("Delete port error:", err);
            }
        }

        document.getElementById('add-article-form')?.addEventListener('submit', async function(e) {
            e.preventDefault();
            const title = document.getElementById('art-title').value;
            const content = document.getElementById('art-content').value;

            try {
                const res = await fetch(`${API_BASE}/admin/articles`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: JSON.stringify({ title, content })
                });
                const data = await res.json();
                if (data.success) {
                    const modalEl = document.getElementById('addArticleModal');
                    const modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
                    modal.hide();
                    document.getElementById('add-article-form').reset();
                    loadAdminData();
                } else {
                    alert(data.message || "Gagal menyimpan artikel");
                }
            } catch (err) {
                console.error("Add article error:", err);
                alert("Terjadi kesalahan saat menyimpan artikel");
            }
        });

        document.getElementById('add-port-form')?.addEventListener('submit', async function(e) {
            e.preventDefault();
            const name = document.getElementById('port-name').value;
            const country = document.getElementById('port-country').value;
            const latitude = parseFloat(document.getElementById('port-lat').value);
            const longitude = parseFloat(document.getElementById('port-lng').value);

            try {
                const res = await fetch(`${API_BASE}/admin/ports`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: JSON.stringify({ name, country, latitude, longitude })
                });
                const data = await res.json();
                if (data.success) {
                    const modalEl = document.getElementById('addPortModal');
                    const modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
                    modal.hide();
                    document.getElementById('add-port-form').reset();
                    loadAdminData();
                    initPortsMap();
                } else {
                    alert(data.message || "Gagal menyimpan pelabuhan");
                }
            } catch (err) {
                console.error("Add port error:", err);
                alert("Terjadi kesalahan saat menyimpan pelabuhan");
            }
        });

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
