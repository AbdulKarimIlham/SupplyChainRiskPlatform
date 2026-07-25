<x-guest-layout>
    <h4 class="fw-bold text-white mb-1">Lupa Kata Sandi?</h4>
    <p class="text-muted small mb-4">Masukkan alamat email Anda dan kami akan mengirimkan link untuk mereset kata sandi.</p>

    <!-- Session Status -->
    @if (session('status'))
        <div class="alert alert-success bg-success bg-opacity-20 border-success text-success small rounded-3 mb-4">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="form-label text-light small fw-semibold">Alamat Email</label>
            <div class="input-group">
                <span class="input-group-text input-group-text-custom"><i class="fa-solid fa-envelope"></i></span>
                <input id="email" class="form-control form-control-custom" type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required autofocus />
            </div>
            @if ($errors->get('email'))
                <div class="text-danger small mt-1"><i class="fa-solid fa-circle-exclamation me-1"></i>{{ $errors->first('email') }}</div>
            @endif
        </div>

        <button type="submit" class="btn btn-auth-submit mb-3">
            <i class="fa-solid fa-paper-plane me-2"></i> Kirim Link Reset Sandi
        </button>

        <div class="text-center">
            <a href="{{ route('login') }}" class="text-muted text-decoration-none small"><i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Log In</a>
        </div>
    </form>
</x-guest-layout>
