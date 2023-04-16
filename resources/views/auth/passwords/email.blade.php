<x-auth-layout>
    <div class="card border-0">
        <div class="card-body">
            <div class="card border-0">
                <div class="card-body">
                    <div class="card-title">{{ __('Reset Password') }}</div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-floating mb-3">
                            <input id="email" type="email" class="form-control form-orange @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <label for="email" class="text-orange">{{ __('Email Address') }}</label>
                        </div>

                        <button type="submit" class="btn btn-orange mb-3">
                            {{ __('Send Password Reset Link') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-auth-layout>
