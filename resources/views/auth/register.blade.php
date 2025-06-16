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

                    <div class="love-shape d-flex justify-content-between px-3 pt-5">
                        <div class="shape-animation">
                            <img src="{{ asset('images/love-1.png') }}" alt="love">
                        </div>
                        <div class="shape-animation">
                            <img src="{{ asset('images/love-2.png') }}" alt="love">
                        </div>
                    </div>

                    <div class="app-heading second px-2">
                        <h1 class="text-center mb-2 tcn-800">{{ __('messages.create_account') }}</h1>
                        <span class="d-block text-center tcn-200">{{ __('messages.find_partner') }}</span>
                    </div>

                    <form method="POST" action="{{ route('register') }}" class="px-3 needs-validation" novalidate>
                        @csrf

                        <!-- Email -->
                        <div class="input-area mb-3">
                            <label for="email" class="fs-sm mb-2 tcn-500">{{ __('messages.email_address') }}</label>
                            <div class="input-box">
                                <img src="{{ asset('images/email.png') }}" alt="email">
                                <input type="email" id="email" name="email" class="form-control" placeholder="{{ __('messages.email_address') }}" value="{{ old('email') }}" required>
                                <div class="valid-feedback">{{ __('messages.email_valid_feedback') }}</div>
                                <div class="invalid-feedback">{{ __('messages.email_invalid_feedback') }}</div>
                            </div>
                            @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <!-- Username -->
                        <div class="input-area mb-3">
                            <label for="username" class="fs-sm mb-2 tcn-500">{{ __('messages.username') }}</label>
                            <div class="input-box">
                                <i class="bi bi-person fs-lg tcp-2-300"></i>
                                <input type="text" id="username" name="username" class="form-control" placeholder="{{ __('messages.username') }}" value="{{ old('username') }}" required minlength="3">
                                <div class="valid-feedback">{{ __('messages.username_valid_feedback') }}</div>
                                <div class="invalid-feedback">{{ __('messages.username_invalid_feedback') }}</div>
                            </div>
                            @error('username') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <!-- Password -->
                        <div class="input-area mb-4">
                            <label for="password" class="fs-sm mb-2 tcn-500">{{ __('messages.password') }}</label>
                            <div class="input-box mb-3 position-relative">
                                <img src="{{ asset('images/key.png') }}" alt="password">
                                <input type="password" id="password" name="password" class="form-control" placeholder="{{ __('messages.password_placeholder') }}" required minlength="6" autocomplete="new-password">
                                <div class="valid-feedback">{{ __('messages.password_valid_feedback') }}</div>
                                <div class="invalid-feedback">{{ __('messages.password_invalid_feedback') }}</div>
                                <span class="position-absolute end-0 top-50 translate-middle-y me-3" style="cursor:pointer;" onclick="togglePassword('password', this)">
                                    <i class="bi bi-eye"></i>
                                </span>
                            </div>
                            @error('password') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="input-area mb-4">
                            <label for="password_confirmation" class="fs-sm mb-2 tcn-500">{{ __('messages.confirm_password') }}</label>
                            <div class="input-box mb-3 position-relative">
                                <img src="{{ asset('images/key.png') }}" alt="confirm password">
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="{{ __('messages.confirm_password_placeholder') }}" required autocomplete="new-password">
                                <div class="valid-feedback">{{ __('messages.confirm_password_valid_feedback') }}</div>
                                <div class="invalid-feedback">{{ __('messages.confirm_password_invalid_feedback') }}</div>
                                <span class="position-absolute end-0 top-50 translate-middle-y me-3" style="cursor:pointer;" onclick="togglePassword('password_confirmation', this)">
                                    <i class="bi bi-eye"></i>
                                </span>
                            </div>
                            @error('password_confirmation') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="px-4">
                            <button type="submit" class="gradient-btn-full">{{ __('messages.sign_up') }}</button>
                        </div>
                    </form>

                    <div class="py-4 text-center">
                        <a href="{{ route('login') }}" class="text-gradient">{{ __('messages.already_registered') }}</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection

<script>
    // Bootstrap 5 live validation
    (function () {
        'use strict'
        const forms = document.querySelectorAll('.needs-validation')
        Array.from(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })

        // Live password confirmation check
        const password = document.getElementById('password');
        const confirm = document.getElementById('password_confirmation');
        confirm.addEventListener('input', function () {
            if (password.value === confirm.value) {
                confirm.setCustomValidity('');
            } else {
                confirm.setCustomValidity('{{ __("messages.confirm_password_invalid_feedback") }}');
            }
        });
    })()

    function togglePassword(fieldId, iconElement) {
        const input = document.getElementById(fieldId);
        const icon = iconElement.querySelector('i');
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        } else {
            input.type = "password";
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        }
    }
</script>
