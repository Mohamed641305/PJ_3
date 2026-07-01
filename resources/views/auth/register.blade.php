@extends('layouts.app')

@section('content')
    <style>
        body {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            font-family: 'Segoe UI', sans-serif;
        }

        .register-wrapper {
            min-height: calc(100vh - 100px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px 15px;
        }

        .register-card {
            border: none;
            border-radius: 25px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, .2);
            max-width: 900px;
            width: 100%;
            overflow: hidden;
        }

        .register-left {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: white;
            padding: 40px 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .brand-icon {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, .15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 34px;
            margin-bottom: 20px;
        }

        .register-right {
            background: #fff;
            padding: 30px;
        }

        .register-title {
            font-weight: 700;
            font-size: 22px;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-label {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .form-control {
            height: 42px;
            border-radius: 10px;
        }

        .mb-3 {
            margin-bottom: 12px !important;
        }

        .btn-register {
            height: 45px;
            border-radius: 10px;
            font-weight: 600;
        }

        @media(max-width:768px) {
            .register-left {
                display: none;
            }
        }
    </style>

    <div class="register-wrapper">

        <div class="register-card card">

            <div class="row g-0">

                {{-- ERRORS
            @if ($errors->any())
                <div class="m-3 alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif --}}

                {{-- LEFT --}}
                <div class="col-lg-5 register-left">

                    <div class="brand-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>

                    <h3 class="fw-bold">Create Account</h3>

                    <p style="font-size:14px; opacity:.8;">
                        Join us and manage your system easily.
                    </p>

                </div>

                {{-- RIGHT --}}
                <div class="col-lg-7 register-right">

                    <h4 class="register-title">Register</h4>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control  @error('email') is-invalid @enderror" name="name"
                                value="{{ old('name') }}" required autofocus required>

                            @error('name')
                                <span class="invalid-feedback d-block">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required>
                            @error('email')
                                <span class="invalid-feedback d-block">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control  @error('password') is-invalid @enderror"
                                name="password" required>
                            @error('password')
                                <span class="invalid-feedback d-block">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password"
                                class="form-control  @error('password_confirmation') is-invalid @enderror"
                                name="password_confirmation" required>
                                
                            @error('password_confirmation')
                                <span class="invalid-feedback d-block">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control  @error('phone_number') is-invalid @enderror"
                                name="phone_number" value="{{ old('phone_number') }}" required>
                            @error('phone_number')
                                <span class="invalid-feedback d-block">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control  @error('address') is-invalid @enderror"
                                name="address" value="{{ old('address') }}" required>
                            @error('address')
                                <span class="invalid-feedback d-block">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-register w-100">
                            <i class="fas fa-user-plus me-2"></i>
                            Create Account
                        </button>

                    </form>

                    <div class="mt-3 text-center">
                        <a href="{{ route('login') }}" class="text-decoration-none">
                            Already have an account? Login
                        </a>
                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
