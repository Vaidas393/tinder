<div class="account-setup position-relative z-1 overflow-hidden">
  <div class="container px-3">
    <span class="gradient-circle-3"></span>
    <span class="gradient-circle-4"></span>

    <div class="account-setup-area pt-4">
      <div class="page-title d-flex align-items-center gap-3 py-4">
        <a href="javascript:void(0)" onclick="history.back()" class="btn p-0">
          <i class="bi bi-arrow-left text-gradient fs-xl fw-500"></i>
        </a>
        <h3 class="tcn-800">{{ __('messages.select_city') }}</h3>
      </div>

      <form wire:submit.prevent="submit">
        {{-- Search input --}}
        <div class="input-box alt rounded-pill mb-4 position-relative">
          <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ps-3 tcn-200"></i>
          <input type="search"
                 wire:model.live="search"
                 class="form-control ps-5"
                 placeholder="{{ __('messages.search_city') }}" />
        </div>

        <ul id="city-list" class="country-list d-grid gap-3">
          @forelse($filteredCities as $name)
            <li>
              <div class="d-flex align-items-center justify-content-between p-2 rounded">
                <span>{{ $name }}</span>
                <input class="form-check-input" type="radio" wire:model="city" value="{{ $name }}" />
              </div>
            </li>
          @empty
            <li class="text-center text-muted">{{ __('No cities found') }}</li>
          @endforelse
        </ul>

        @error('city')
          <div class="text-danger small mt-2">{{ $message }}</div>
        @enderror

        <div class="px-4 py-2">
          <button type="submit" class="gradient-btn-full alt-btn-full2 w-100">
            {{ __('messages.next') }} <i class="bi bi-chevron-right"></i>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
