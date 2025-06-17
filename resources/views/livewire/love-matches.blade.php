<section class="home-page position-relative pb-120 z-1 overflow-hidden">
  <span class="gradient-circle-3"></span>
  <span class="gradient-circle-4 position-fixed"></span>
  <div class="container px-3">

    {{-- nav pills --}}
    <ul class="nav nav-pills justify-content-between mb-3" role="tablist">
      @foreach([
        'all' => __('messages.all'),
        'like' => __('messages.like'),
        'likeSent' => __('messages.like_sent'),
        'dislike' => __('messages.dislike'),
        'match' => __('messages.match')
      ] as $key => $label)
        <li class="nav-item">
          <button
            wire:click="setTab('{{ $key }}')"
            class="nav-link @if($tab === $key) active @endif"
            type="button"
          >{{ $label }}</button>
        </li>
      @endforeach
    </ul>
    <div class="border-line"></div>

    {{-- tab content --}}
    <div class="tab-content mt-4">
      <div class="row g-3">
        @forelse($users[$tab] as $other)
          @php $photos = array_filter([$other->photo1, $other->photo2, $other->photo3]); @endphp
          <div class="col-12 col-md-6">
            <div class="d-flex justify-content-center">
              <div class="card shadow-lg" style="width: 340px; border-radius: 2.5rem; overflow: hidden;">
                <div class="user-info px-3 py-2 text-center" style="border-radius: 2.5rem 2.5rem 0 0; background: rgba(255,255,255,0.98); box-shadow: 0 2px 12px rgba(0,0,0,0.04); position: relative; z-index: 2;">
                  <div class="d-flex align-items-center gap-1 mb-2 justify-content-center">
                    <h3 class="mb-0">{{ $other->username }}</h3>
                    <span>{{ $other->age }}</span>
                    <span>{{ ucfirst(__('messages.' . $other->gender)) }}</span>
                  </div>
                  <div class="d-flex flex-wrap gap-2 small justify-content-center">
                    <span><i class="bi bi-geo-alt"></i> {{ $other->city }}</span>
                    <span>{{ $other->height }} {{ __('messages.cm') }}</span>
                    <span>{{ $other->weight }} {{ __('messages.kg') }}</span>
                    <span>{{ $other->size }} {{ __('messages.cm') }}</span>
                    <span>{{ __('messages.' . $other->position) }}</span>
                  </div>
                  <div class="d-flex justify-content-center gap-5 mt-2">
                    <button wire:click="react({{ $other->id }}, 'dislike')" class="story-btn">
                      <i class="bi bi-x-lg fs-2" title="{{ __('messages.dislike') }}"></i>
                    </button>
                    <button wire:click="react({{ $other->id }}, 'like')" class="story-btn">
                      <i class="bi bi-suit-heart-fill fs-2" title="{{ __('messages.like') }}"></i>
                    </button>
                    @if($tab === 'match')
                      <div class="text-center mt-2">
                        <button wire:click="startChat({{ $other->id }})" class="btn btn-outline-primary rounded-pill px-4 py-1">
                          <i class="bi bi-chat-dots me-1"></i> {{ __('messages.chat') }}
                        </button>
                      </div>
                    @endif
                  </div>
                </div>

                <div id="carousel-{{ $other->id }}" class="carousel slide" data-bs-ride="carousel">
                  <div class="carousel-inner">
                    @foreach($photos as $i => $photo)
                      <div class="carousel-item @if($i === 0) active @endif">
                        <div class="phone-container" style="background: #f8f9fa; border-radius: 2.5rem;">
                          <div class="image-container" style="height: 420px; display: flex; align-items: center; justify-content: center;">
                            <img src="{{ asset('storage/'.$photo) }}" class="d-block" alt="{{ $other->username }}" loading="lazy" style="max-width: 90%; max-height: 90%; border-radius: 1.5rem; box-shadow: 0 4px 24px rgba(0,0,0,0.10);">
                          </div>
                        </div>
                      </div>
                    @endforeach
                  </div>

                  @if(count($photos) > 1)
                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $other->id }}" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">{{ __('messages.previous') }}</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $other->id }}" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">{{ __('messages.next') }}</span>
                    </button>
                  @endif
                </div>
              </div>
            </div>
          </div>
        @empty
          <p class="text-center w-100">{{ __('messages.no_users_here') }}</p>
        @endforelse
      </div>
    </div>

  </div>
  @include('partials.bottom-navbar')

</section>
