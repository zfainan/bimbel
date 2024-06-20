@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card-group d-block d-md-flex row">
                    <div class="card mb-0 p-4">
                        <div class="card-body">
                            <h1 class="h2">Login</h1>
                            <p class="text-body-secondary">Sign In to your account</p>

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="input-group mb-3"><span class="input-group-text">
                                        <div class="icon">
                                            <i class="cil-user">
                                            </i>
                                        </div>
                                    </span>
                                    <input class="form-control @error('email') is-invalid @enderror" name="email"
                                        type="text" value="{{ old('email') }}" placeholder="Email" autocomplete="email"
                                        autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="input-group mb-4"><span class="input-group-text">
                                        <div class="icon">
                                            <i class="cil-lock-locked">
                                            </i>
                                        </div>
                                    </span>
                                    <input class="form-control @error('password') is-invalid @enderror" name="password"
                                        type="password" placeholder="Password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-check mb-4">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <button class="btn btn-primary px-4" type="submit">Login</button>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <div class="col-6 text-end">
                                            <a class="btn btn-link px-0" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
