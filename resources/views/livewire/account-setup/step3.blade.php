<div class="account-setup position-relative z-1 overflow-hidden">
  <div class="container px-3">
    <span class="gradient-circle-3"></span>
    <span class="gradient-circle-4"></span>
    <div class="account-setup-area alt py-4">

      <div class="py-4">
        <a href="javascript:void(0)" onclick="history.back()">
          <i class="bi bi-arrow-left text-gradient fs-xl fw-500"></i>
        </a>
      </div>

      <div class="page-title pt-3 pb-4">
        <h2 class="tcn-800 text-center fw-600">{{ __('messages.whats_your_gender') }}</h2>
      </div>

      <form wire:submit.prevent="submit" class="gender-form d-grid justify-content-center gap-3">

        <div class="select-gender select-option {{ $gender === 'male' ? 'option-selected' : '' }}" wire:click="$set('gender','male')">
          <label for="male" class="d-between flex-column">
            <span class="text-gradient py-4">{{ __('messages.male') }}</span>
            <span class="img-area">
              <img class="img-fluid" src="{{ asset('images/male.png') }}" alt="male">
            </span>
            <input type="radio" id="male" name="gender" value="male" class="d-none">
          </label>
        </div>

        <div class="select-gender select-option {{ $gender === 'female' ? 'option-selected' : '' }}" wire:click="$set('gender','female')">
          <label for="female" class="d-between flex-column">
            <span class="text-gradient py-4">{{ __('messages.female') }}</span>
            <span class="img-area">
              <img class="img-fluid" src="{{ asset('images/female.png') }}" alt="female">
            </span>
            <input type="radio" id="female" name="gender" value="female" class="d-none">
          </label>
        </div>

        @error('gender')
          <div class="text-danger text-center mt-2">{{ $message }}</div>
        @enderror

        <div class="position-absolute arrow-btn">
          <button type="submit" class="gradient-btn">
            <i class="bi bi-chevron-right"></i>
          </button>
        </div>

        <div class="position-absolute progress-area w-100 translate-middle-x start-50 px-sm-4 px-3">
          <span class="tcn-900-2">3<span class="text-gradient">/5</span></span>
          <div class="progress">
            <div class="progress-bar" role="progressbar" data-value="28%" style="width: 28%;"></div>
          </div>
        </div>
      </form>

    </div>
  </div>
</div>
