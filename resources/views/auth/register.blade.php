<x-guest-layout>
    <h4 class="fw-bold text-white mb-1">Buat Akun Baru</h4>
    <p class="text-muted small mb-4">Daftar untuk mengakses platform pemantauan risiko rantai pasok</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label text-light small fw-semibold">Nama Lengkap</label>
            <div class="input-group">
                <span class="input-group-text input-group-text-custom"><i class="fa-solid fa-user"></i></span>
                <input id="name" class="form-control form-control-custom" type="text" name="name" value="{{ old('name') }}" placeholder="John Doe" required autofocus autocomplete="name" />
            </div>
            @if ($errors->get('name'))
                <div class="text-danger small mt-1"><i class="fa-solid fa-circle-exclamation me-1"></i>{{ $errors->first('name') }}</div>
            @endif
        </div>

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label text-light small fw-semibold">Alamat Email</label>
            <div class="input-group">
                <span class="input-group-text input-group-text-custom"><i class="fa-solid fa-envelope"></i></span>
                <input id="email" class="form-control form-control-custom" type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required autocomplete="username" />
            </div>
            @if ($errors->get('email'))
                <div class="text-danger small mt-1"><i class="fa-solid fa-circle-exclamation me-1"></i>{{ $errors->first('email') }}</div>
            @endif
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label text-light small fw-semibold">Kata Sandi</label>
            <div class="input-group">
                <span class="input-group-text input-group-text-custom"><i class="fa-solid fa-lock"></i></span>
                <input id="password" class="form-control form-control-custom" type="password" name="password" placeholder="Minimal 8 karakter" required autocomplete="new-password" />
            </div>
            @if ($errors->get('password'))
                <div class="text-danger small mt-1"><i class="fa-solid fa-circle-exclamation me-1"></i>{{ $errors->first('password') }}</div>
            @endif
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <label for="password_confirmation" class="form-label text-light small fw-semibold">Konfirmasi Kata Sandi</label>
            <div class="input-group">
                <span class="input-group-text input-group-text-custom"><i class="fa-solid fa-shield-halved"></i></span>
                <input id="password_confirmation" class="form-control form-control-custom" type="password" name="password_confirmation" placeholder="Ulangi kata sandi" required autocomplete="new-password" />
            </div>
            @if ($errors->get('password_confirmation'))
                <div class="text-danger small mt-1"><i class="fa-solid fa-circle-exclamation me-1"></i>{{ $errors->first('password_confirmation') }}</div>
            @endif
        </div>

        <button type="submit" class="btn btn-auth-submit mb-3">
            <i class="fa-solid fa-user-plus me-2"></i> Register Akun
        </button>

        <div class="text-center">
            <span class="text-muted small">Sudah memiliki akun?</span>
            <a href="{{ route('login') }}" class="text-primary text-decoration-none fw-semibold small ms-1">Log In</a>
        </div>
    </form>
</x-guest-layout>
