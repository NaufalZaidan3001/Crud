@props(['errors' => null, 'old' => null, 'title' => 'Login to your account', 'showRegisterLink' => true])

<div class="card mb-0">
    <div class="card-body">
        <div class="text-center mb-3">
            <i class="icon-reading icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
            <h5 class="mb-0">{{ $title }}</h5>
            <span class="d-block text-muted">Enter your credentials below</span>
        </div>

        <div class="form-group form-group-feedback form-group-feedback-left">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   placeholder="Email" value="{{ old('email') }}" required autofocus>
            <div class="form-control-feedback">
                <i class="icon-mail5 text-muted"></i>
            </div>
            @error('email')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group form-group-feedback form-group-feedback-left">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                   placeholder="Password" required>
            <div class="form-control-feedback">
                <i class="icon-lock2 text-muted"></i>
            </div>
            @error('password')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    Remember me
                </label>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">
                Sign in <i class="icon-circle-right2 ml-2"></i>
            </button>
        </div>

        <div class="text-center">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">Forgot password?</a>
            @endif
            @if($showRegisterLink)
                <br>
                <a href="{{ route('register') }}">Didn't have an account yet?</a>
            @endif
        </div>
    </div>
</div>