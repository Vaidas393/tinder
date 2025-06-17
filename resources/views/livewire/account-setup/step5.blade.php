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
        <h2 class="tcn-800 text-center fw-600">{{ __('messages.upload_photos') }}</h2>
      </div>

      <form wire:submit.prevent="submit" class="d-grid justify-content-center">

        <div class="grid-container">

          {{-- Photo 1 --}}
          <div class="grid-item1 grid-area position-relative">
            <div class="add-profile position-relative">
              <div class="upload">
                <div class="upload-btn-area position-absolute">
                  <i class="bi bi-plus-circle plus-button tcp-2-300 mb-2 text-center"></i>
                  <label class="gradient-btn fs-xs">
                    <i class="bi bi-camera text-gradient camera-icon"></i>
                    <span class="text-nowrap">{{ __('messages.upload_image') }}</span>
                    <input type="file" class="input-file" accept="image/*" wire:model="photo1" hidden>
                  </label>
                </div>
                @if ($photo1)
                  <div class="preview-img mt-2 text-center">
                    <img src="{{ $photo1->temporaryUrl() }}" alt="Preview" style="max-width: 100px; max-height: 100px; border-radius: 1rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                  </div>
                @endif
              </div>
            </div>
          </div>

          {{-- Photo 2 --}}
          <div class="grid-item2 grid-area position-relative">
            <div class="upload">
              <label class="btn-2 mb-2">
                <i class="bi bi-camera text-gradient camera-icon"></i><span>{{ __('messages.add') }}</span>
                <input type="file" class="input-file" accept="image/*" wire:model="photo2" hidden>
              </label>
              @if ($photo2)
                <div class="preview-img mt-2 text-center">
                  <img src="{{ $photo2->temporaryUrl() }}" alt="Preview" style="max-width: 100px; max-height: 100px; border-radius: 1rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                </div>
              @endif
            </div>
          </div>

          {{-- Photo 3 --}}
          <div class="grid-item3 grid-area position-relative">
            <div class="upload">
              <label class="btn-2 mb-2">
                <i class="bi bi-camera text-gradient camera-icon"></i><span>{{ __('messages.add') }}</span>
                <input type="file" class="input-file" accept="image/*" wire:model="photo3" hidden>
              </label>
              @if ($photo3)
                <div class="preview-img mt-2 text-center">
                  <img src="{{ $photo3->temporaryUrl() }}" alt="Preview" style="max-width: 100px; max-height: 100px; border-radius: 1rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                </div>
              @endif
            </div>
          </div>

        </div>

        @error('photo1') <div class="text-danger small mt-2">{{ $message }}</div> @enderror
        @error('photo2') <div class="text-danger small mt-2">{{ $message }}</div> @enderror
        @error('photo3') <div class="text-danger small mt-2">{{ $message }}</div> @enderror

        <div class="py-3 px-3">
          <button type="submit" class="gradient-btn-full alt-btn-full2 w-100">
            {{ __('messages.next') }} <i class="bi bi-chevron-right"></i>
          </button>
        </div>

      </form>

      <div class="position-absolute progress-area w-100 translate-middle-x start-50 px-sm-4 px-3">
        <span class="tcn-900-2">5<span class="text-gradient">/7</span></span>
        <div class="progress">
          <div class="progress-bar" role="progressbar" style="width: 70%;"></div>
        </div>
      </div>

    </div>
  </div>
</div>
