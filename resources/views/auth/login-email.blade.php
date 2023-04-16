<x-auth-layout>
    <div class="card border-0">
        <div class="card-body">
            <div class="card-title">{{ __('Login') }}</div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-floating mb-3">
                    <input id="email" type="email" class="form-control form-orange @error('email') is-invalid @enderror " name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <label for="email" class="text-orange">{{ __('Email Address') }}</label>
                </div>

                <div class="form-floating mb-3">
                    <input id="password" type="password" class="form-control form-orange @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <label for="password" class="text-orange">{{ __('Password') }}</label>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>


                <button type="submit" class="btn btn-orange mb-3">
                    {{ __('Login') }}
                </button>
                @if (Route::has('password.request'))
                    <a class="btn btn-link mb-3" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
                <a class="btn btn-link mb-3" href="{{ route('register') }}">
                    {{ __('Create account') }}
                </a>

            </form>
        </div>
    </div>
</x-auth-layout>
