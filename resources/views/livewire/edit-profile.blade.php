<section class="home-page position-relative z-1 overflow-hidden">
    <span class="gradient-circle-3"></span>
    <span class="gradient-circle-4"></span>
    <div class="container px-3 mt-5">

        <div class="header-area mt-5 mb-4">
            <div class="d-between">
                <a href="{{ route('home') }}"><i class="bi bi-arrow-left text-gradient fs-xl fw-500"></i></a>
                <h3 class="tcn-800">{{ __('messages.edit_profile') }}</h3>
            </div>
        </div>

        @if (session()->has('message'))
            <div class="alert alert-success">{{ __('messages.' . session('message')) }}</div>
        @endif

        <form wire:submit.prevent="saveProfile">

          <div class="grid-container mb-4">
              <!-- Photo 1 -->
              <div class="grid-item1 grid-area position-relative">
                  <div class="add-profile position-relative">
                      <div class="upload">
                          <label class="gradient-btn fs-xs">
                              <i class="bi bi-camera text-gradient camera-icon"></i>
                              <span class="text-nowrap">{{ __('messages.upload_image') }}</span>
                              <input type="file" wire:model="photo1" class="input-file" accept="image/*" hidden>
                          </label>
                          @if ($user->photo1)
                              <img class="preview-img preview-big" src="{{ asset('storage/' . $user->photo1) }}" alt="{{ __('messages.photo') }} 1">
                          @else
                              <img class="preview-img preview-big" src="{{ asset('assets/img/preview1.png') }}" alt="{{ __('messages.photo') }} 1">
                          @endif
                      </div>
                      @error('photo1') <div class="text-danger small text-center mt-1">{{ $message }}</div> @enderror
                  </div>
              </div>

              <!-- Photo 2 -->
              <div class="grid-item2 grid-area position-relative">
                  <div class="upload">
                      <label class="btn-2 mb-2">
                          <i class="bi bi-camera text-gradient camera-icon"></i><span>{{ __('messages.add') }}</span>
                          <input type="file" wire:model="photo2" class="input-file" accept="image/*" hidden>
                      </label>
                      @if ($user->photo2)
                          <img class="preview-img preview-small" src="{{ asset('storage/' . $user->photo2) }}" alt="{{ __('messages.photo') }} 2">
                      @else
                          <img class="preview-img preview-small" src="{{ asset('assets/img/preview2.png') }}" alt="{{ __('messages.photo') }} 2">
                      @endif
                  </div>
                  @error('photo2') <div class="text-danger small text-center mt-1">{{ $message }}</div> @enderror
              </div>

              <!-- Photo 3 -->
              <div class="grid-item3 grid-area position-relative">
                  <div class="upload">
                      <label class="btn-2 mb-2">
                          <i class="bi bi-camera text-gradient camera-icon"></i><span>{{ __('messages.add') }}</span>
                          <input type="file" wire:model="photo3" class="input-file" accept="image/*" hidden>
                      </label>
                      @if ($user->photo3)
                          <img class="preview-img preview-small" src="{{ asset('storage/' . $user->photo3) }}" alt="{{ __('messages.photo') }} 3">
                      @else
                          <img class="preview-img preview-small" src="{{ asset('assets/img/preview3.png') }}" alt="{{ __('messages.photo') }} 3">
                      @endif
                  </div>
                  @error('photo3') <div class="text-danger small text-center mt-1">{{ $message }}</div> @enderror
              </div>
          </div>


            <div class="account-setting mb-4">
                <ul class="d-grid gap-4">
                    <li>
                        <div class="d-between">
                            <span class="tcn-90-2">{{ __('messages.username') }}</span>
                            <input type="text" wire:model.defer="username" class="form-control w-50">
                        </div>
                        @error('username')<div class="text-danger small">{{ $message }}</div>@enderror
                        <div class="hr-line mt-3"></div>
                    </li>
                    <li>
                        <div class="d-between">
                            <span class="tcn-90-2">{{ __('messages.email') }}</span>
                            <input type="email" wire:model.defer="email" class="form-control w-50">
                        </div>
                        @error('email')<div class="text-danger small">{{ $message }}</div>@enderror
                        <div class="hr-line mt-3"></div>
                    </li>
                    <li>
                        <div class="d-between">
                            <span class="tcn-90-2">{{ __('messages.city') }}</span>
                            <select wire:model.defer="city" class="form-control w-50">
                                <option value="">{{ __('messages.select_city') }}</option>
                                @foreach($cities as $c)
                                    <option value="{{ $c }}" @if($c ===
$this->city) selected @endif>{{ $c }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('city')<div class="text-danger small">{{ $message }}</div>@enderror
                        <div class="hr-line mt-3"></div>
                    </li>
                    <li>
                        <div class="d-between">
                            <span class="tcn-90-2">{{ __('messages.age') }}</span>
                            <input type="number" wire:model.defer="age" class="form-control w-50" min="18" max="100">
                        </div>
                        @error('age')<div class="text-danger small">{{ $message }}</div>@enderror
                        <div class="hr-line mt-3"></div>
                    </li>
                    <li>
                        <div class="d-between">
                            <span class="tcn-90-2">{{ __('messages.height_cm') }}</span>
                            <input type="number" wire:model.defer="height" class="form-control w-50">
                        </div>
                        @error('height')<div class="text-danger small">{{ $message }}</div>@enderror
                        <div class="hr-line mt-3"></div>
                    </li>
                    <li>
                        <div class="d-between">
                            <span class="tcn-90-2">{{ __('messages.weight_kg') }}</span>
                            <input type="number" wire:model.defer="weight" class="form-control w-50">
                        </div>
                        @error('weight')<div class="text-danger small">{{ $message }}</div>@enderror
                        <div class="hr-line mt-3"></div>
                    </li>
                    <li>
                        <div class="d-between">
                            <span class="tcn-90-2">{{ __('messages.size_cm') }}</span>
                            <input type="number" wire:model.defer="size" class="form-control w-50">
                        </div>
                        @error('size')<div class="text-danger small">{{ $message }}</div>@enderror
                        <div class="hr-line mt-3"></div>
                    </li>
                    <li>
                        <div class="d-between">
                            <span class="tcn-90-2">{{ __('messages.gender') }}</span>
                            <select wire:model.defer="gender" class="form-control w-50">
                                <option value="">{{ __('messages.select_gender') }}</option>
                                <option value="male">{{ __('messages.male') }}</option>
                                <option value="female">{{ __('messages.female') }}</option>
                            </select>
                        </div>
                        @error('gender')<div class="text-danger small">{{ $message }}</div>@enderror
                        <div class="hr-line mt-3"></div>
                    </li>
                    <li>
                        <div class="d-between">
                            <span class="tcn-90-2">{{ __('messages.position') }}</span>
                            <select wire:model.defer="position" class="form-control w-50">
                                <option value="">{{ __('messages.select_position') }}</option>
                                <option value="active">{{ __('messages.active') }}</option>
                                <option value="passive">{{ __('messages.passive') }}</option>
                                <option value="versatile">{{ __('messages.versatile') }}</option>
                            </select>
                        </div>
                        @error('position')<div class="text-danger small">{{ $message }}</div>@enderror
                        <div class="hr-line mt-3"></div>
                    </li>
                    <li>
                      <div class="d-between">
                            <span class="tcn-90-2">{{ __('messages.language') }}</span>
                            <select wire:model.defer="language" class="form-control w-50">
                                <option value="">{{ __('messages.select_language') }}</option>
                                <option value="lt">{{ __('messages.lt') }}</option>
                                <option value="en">{{ __('messages.en') }}</option>
                            </select>
                      </div>
                        @error('language')<div class="text-danger small">{{ $message }}</div>@enderror
                    </li>
                </ul>
            </div>

            <div class="account-setting mb-4">
                <ul class="d-grid gap-3">
                    <li>
                        <div class="d-between">
                            <span class="tcn-90-2">{{ __('messages.current_password') }}</span>
                            <input type="password" wire:model.defer="current_password" class="form-control w-50">
                        </div>
                        @error('current_password')<div class="text-danger small">{{ $message }}</div>@enderror
                        <div class="hr-line mt-3"></div>
                    </li>
                    <li>
                        <div class="d-between">
                            <span class="tcn-90-2">{{ __('messages.new_password') }}</span>
                            <input type="password" wire:model.defer="new_password" class="form-control w-50">
                        </div>
                        @error('new_password')<div class="text-danger small">{{ $message }}</div>@enderror
                        <div class="hr-line mt-3"></div>
                    </li>
                    <li>
                        <div class="d-between">
                            <span class="tcn-90-2">{{ __('messages.confirm_password') }}</span>
                            <input type="password" wire:model.defer="new_password_confirmation" class="form-control w-50">
                        </div>
                    </li>
                </ul>
            </div>

            <div class="pt-2 px-5 d-justify-between">
                <button type="submit" class="gradient-btn-full mt-4">{{ __('messages.save') }}</button>
                <button type="button" wire:click="deleteProfile" class="btn btn-danger gradient-btn-full mt-4" onclick="return confirm('{{ __('messages.confirm_delete_profile') }}')">{{ __('messages.delete_profile') }}</button>
            </div>
        </form>
    </div>
</section>
