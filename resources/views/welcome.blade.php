@extends('layouts.app')

@section('content')
<section class="login gradient-1 position-relative">
  <div class="container px-0">
      <div class="login-box">
          <div class="login-box-img d-flex justify-content-center">
              <img src="{{ asset('images/welcome-silde3.png') }}" alt="slider img">
          </div>
          <div class="gradient-overlay">
              <div class="position-absolute bottom-0 start-50 translate-middle-x w-100 overflow-x-hidden overflow-y-auto py-4 z-3">
                  <span class="gradient-circle-1"></span>
                  <span class="gradient-circle-2"></span>
                  <div class="logo mb-3 mx-auto">
                      <img class="img-fluid" src="{{ asset('images/logo.png') }}" alt="logo">
                  </div>
                  <div class="love-shape second d-between px-3 gap-3">
                      <div class="shape-animation mb-3">
                          <img src="{{ asset('images/love-1.png') }}" alt="love">
                      </div>
                      <div class="site-heading mx-auto mb-0">
                          <img class="img-fluid" src="{{ asset('images/title-logo.png') }}" alt="logo">
                      </div>
                      <div class="shape-animation mt-3">
                          <img src="{{ asset('images/love-2.png') }}" alt="love">
                      </div>
                  </div>
                  <div class="px-4 login-btn-area">
                      <a href="{{ route('login') }}" class="gradient-btn-full mb-4">{{ __('messages.sign_in') }}</a>
                      <a href="{{ route('register') }}" class="gradient-btn-full alt-btn-full">
                          <span class="text-gradient">{{ __('messages.create_account') }}</span>
                      </a>
                  </div>
                  <a href="javascript:void(0)" class="text-gradient text-center d-block fs-xs">
                      {{ __('messages.privacy_policy') }}
                  </a>
              </div>
          </div>
      </div>
  </div>
</section>
@endsection
