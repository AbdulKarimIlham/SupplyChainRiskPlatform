<x-guest-layout>
    <h4 class="fw-bold text-white mb-1">Masuk ke Akun</h4>
    <p class="text-muted small mb-4">Silakan masukkan email dan kata sandi Anda</p>

    <!-- Session Status -->
    @if (session('status'))
        <div class="alert alert-success bg-success bg-opacity-20 border-success text-success small rounded-3 mb-4">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ secure_url('/login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label text-light small fw-semibold">Alamat Email</label>
            <div class="input-group">
                <span class="input-group-text input-group-text-custom"><i class="fa-solid fa-envelope"></i></span>
                <input id="email" class="form-control form-control-custom" type="email" name="email" value="{{ old('email') }}" placeholder="admin@gmail.com" required autofocus autocomplete="username" />
            </div>
            @if ($errors->get('email'))
                <div class="text-danger small mt-1"><i class="fa-solid fa-circle-exclamation me-1"></i>{{ $errors->first('email') }}</div>
            @endif
        </div>

        <!-- Password -->
        <div class="mb-3">
            <div class="d-flex justify-content-between align-items-center mb-1">
                <label for="password" class="form-label text-light small fw-semibold mb-0">Kata Sandi</label>
                @if (Route::has('password.request'))
                    <a class="auth-link small text-xs" href="{{ route('password.request') }}">
                        Lupa sandi?
                    </a>
                @endif
            </div>
            <div class="input-group">
                <span class="input-group-text input-group-text-custom"><i class="fa-solid fa-lock"></i></span>
                <input id="password" class="form-control form-control-custom" type="password" name="password" placeholder="••••••••" required autocomplete="current-password" />
            </div>
            @if ($errors->get('password'))
                <div class="text-danger small mt-1"><i class="fa-solid fa-circle-exclamation me-1"></i>{{ $errors->first('password') }}</div>
            @endif
        </div>

        <!-- Remember Me -->
        <div class="form-check mb-4">
            <input id="remember_me" type="checkbox" class="form-check-input bg-dark border-secondary" name="remember">
            <label for="remember_me" class="form-check-label text-muted small ms-1">Ingat saya di perangkat ini</label>
        </div>

        <button type="submit" class="btn btn-auth-submit mb-3">
            <i class="fa-solid fa-right-to-bracket me-2"></i> Log In
        </button>

        <div class="text-center">
            <span class="text-muted small">Belum memiliki akun?</span>
            <a href="{{ route('register') }}" class="text-primary text-decoration-none fw-semibold small ms-1">Daftar Sekarang</a>
        </div>
    </form>
</x-guest-layout>
