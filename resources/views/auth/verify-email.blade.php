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

                    <div class="app-heading second px-3">
                        <h1 class="text-center mb-2 tcn-800">{{ __('messages.verify_email_title') }}</h1>
                        <span class="d-block text-center tcn-200">{{ __('messages.verify_email_subtitle') }}</span>
                    </div>

                    @if (session('status') == 'verification-link-sent')
                        <div class="alert alert-success text-center my-3">
                            {{ __('messages.verification_link_sent') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('verification.send') }}" class="px-3 mb-3">
                        @csrf
                        <button type="submit" class="gradient-btn-full w-100 mb-3">
                            {{ __('messages.resend_verification_email') }}
                        </button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}" class="px-3">
                        @csrf
                        <button type="submit" class="btn btn-link w-100 text-gradient fw-bold">
                            {{ __('messages.logout') }}
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection
