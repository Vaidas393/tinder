@extends('layouts.guest')

@section('content')

<section class="login gradient-1 position-relative">
    <div class="container px-0">
        <div class="login-box">
            <div class="login-box-img d-flex justify-content-center">
                <img src="{{ asset('images/welcome-silde3.png') }}" alt="slider img">
            </div>

            <div class="gradient-overlay">
                <div class="position-absolute bottom-0 start-50 translate-middle-x w-100 overflow-x-hidden overflow-y-auto py-4 z-2">

                    <span class="gradient-circle-1"></span>
                    <span class="gradient-circle-2"></span>

                    <div class="love-shape d-flex justify-content-between px-3 gap-3">
                        <div class="shape-animation">
                            <img src="{{ asset('images/love-1.png') }}" alt="love">
                        </div>
                        <div class="shape-animation">
                            <img src="{{ asset('images/love-2.png') }}" alt="love">
                        </div>
                    </div>

                    <div class="app-heading second px-2">
                        <h1 class="text-center mb-2 tcn-800">{{ __('messages.forgot_password_title') }}</h1>
                        <span class="d-block text-center tcn-200">{{ __('messages.forgot_password_subtitle') }}</span>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success text-center my-2">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}" class="px-3">
                        @csrf

                        <div class="input-area mb-3">
                            <label for="email" class="fs-sm mb-2 tcn-500">{{ __('messages.email_address') }}</label>
                            <div class="input-box">
                                <img src="{{ asset('images/email.png') }}" alt="email">
                                <input type="email" id="email" name="email" placeholder="example@email.com" value="{{ old('email') }}" required autofocus>
                            </div>
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="px-4">
                            <button type="submit" class="gradient-btn-full">{{ __('messages.send_password_link') }}</button>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        <a href="{{ route('login') }}" class="text-gradient fw-bold">{{ __('messages.back_to_login') }}</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection
