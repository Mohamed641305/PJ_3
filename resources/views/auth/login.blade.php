@extends('layouts.app')

@section('content')
    <style>
        body {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            min-height: 100vh;
        }

        .login-card {
            border: none;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0, 0, 0, .15);
        }

        .login-left {
            text-align: center;
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: white;
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .login-right {
            padding: 50px;
            background: #fff;
        }

        .brand-icon {
            width: 90px;
            height: 90px;
            background: rgba(255, 255, 255, .15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            margin-bottom: 25px;
        }

        .form-control {
            height: 50px;
            border-radius: 12px;
        }

        .btn-login {
            height: 50px;
            border-radius: 12px;
            font-weight: 600;
        }

        .login-title {
            font-weight: 700;
        }

        @media(max-width:768px) {
            .login-left {
                display: none;
            }
        }
    </style>

    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">

            <div class="col-lg-10">

                <div class="login-card card">

                    <div class="row g-0">

                        <!-- Left Side -->
                        <div class="col-lg-5 login-left">

                            <div class="brand-icon">
                                <i class="fas fa-user-shield"></i>
                            </div>

                            <h2 class="mb-3 fw-bold">Welcome Back 👋</h2>

                            <p class="opacity-75">
                                Login to access your dashboard and manage your system easily.
                            </p>

                        </div>

                        <!-- Right Side -->
                        <div class="col-lg-7 login-right">

                            <h3 class="mb-4 text-center login-title">
                                Login
                            </h3>

                            {{-- Error Message --}}
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <!-- Email -->
                                <div class="mb-3">
                                    <label class="form-label">Email Address</label>

                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autofocus>

                                    @error('email')
                                        <span class="invalid-feedback d-block">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="mb-3">
                                    <label class="form-label">Password</label>

                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required>

                                    @error('password')
                                        <span class="invalid-feedback d-block">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <!-- Remember -->
                                <div class="mb-4 form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        Remember Me
                                    </label>
                                </div>

                                <!-- Login Button -->
                                <div class="mb-3 d-grid">
                                    <button type="submit" class="btn btn-primary btn-login">
                                        <i class="fas fa-sign-in-alt me-2"></i>
                                        Login
                                    </button>
                                </div>

                                <!-- Register -->
                                <div class="mt-4 text-center">
                                    <p class="mb-0 text-muted">
                                        Don’t have an account?
                                        <a href="{{ route('register') }}" class="fw-bold text-decoration-none">
                                            Create Account
                                        </a>
                                    </p>
                                </div>

                                <!-- Forgot Password -->
                                @if (Route::has('password.request'))
                                    <div class="mt-2 text-center">
                                        <a href="{{ route('password.request') }}" class="text-decoration-none">
                                            Forgot Your Password?
                                        </a>
                                    </div>
                                @endif

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>
@endsection
