<div class="account-setup position-relative z-1 overflow-hidden">
  <div class="container px-3">
    <span class="gradient-circle-3"></span>
    <span class="gradient-circle-4"></span>

    <div class="account-setup-area py-4">

      <div class="py-4">
        <a href="javascript:void(0)" onclick="window.history.back()">
          <i class="bi bi-arrow-left text-gradient fs-xl fw-500"></i>
        </a>
      </div>

      <div class="page-title pt-3 pb-4">
        <h2 class="tcn-800 text-center fw-600">{{ __('messages.profile_details') }}</h2>
      </div>

      <form wire:submit.prevent="submit" class="px-3 d-grid gap-3">

        <div>
          <label class="form-label">{{ __('messages.age') }}</label>
          <input type="number" class="form-control" wire:model="age" min="18" max="80" />
          @error('age') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div>
          <label class="form-label">{{ __('messages.height') }}</label>
          <input type="number" class="form-control" wire:model="height" min="100" max="250" />
          @error('height') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div>
          <label class="form-label">{{ __('messages.weight') }}</label>
          <input type="number" class="form-control" wire:model="weight" min="30" max="250" />
          @error('weight') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div>
          <label class="form-label">{{ __('messages.size') }}</label>
          <input type="number" class="form-control" wire:model="size" min="10" max="30" />
          @error('size') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div>
          <label class="form-label">{{ __('messages.position') }}</label>
          <select class="form-select" wire:model="position">
            <option value="">{{ __('messages.select_position') }}</option>
            <option value="active">{{ __('messages.position_top') }}</option>
            <option value="passive">{{ __('messages.position_bottom') }}</option>
            <option value="versatile">{{ __('messages.position_versatile') }}</option>
          </select>
          @error('position') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="py-2">
          <button type="submit" class="gradient-btn-full alt-btn-full2 w-100">
            {{ __('messages.next') }} <i class="bi bi-chevron-right"></i>
          </button>
        </div>

      </form>

      <div class="position-absolute progress-area w-100 translate-middle-x start-50 px-sm-4 px-3">
        <span class="tcn-900-2">4<span class="text-gradient">/5</span></span>
        <div class="progress">
          <div class="progress-bar" role="progressbar" style="width: 56%;"></div>
        </div>
      </div>

    </div>
  </div>
</div>
