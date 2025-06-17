<div>
<section class="home-page position-relative z-1 overflow-hidden">
  <div class="container px-0">

    @if($users->count())
      @php
        $user   = $users->first();
        $photos = array_filter([$user->photo1, $user->photo2, $user->photo3]);
      @endphp

      <!-- Bootstrap Carousel for user images, styled as a mobile card -->
      <div class="d-flex justify-content-center">
        <div class="card shadow-lg" style="width: 340px; border-radius: 2.5rem; overflow: hidden;">
          <div class="user-info px-3 py-2 text-center" style="border-radius: 2.5rem 2.5rem 0 0; background: rgba(255,255,255,0.98); box-shadow: 0 2px 12px rgba(0,0,0,0.04); position: relative; z-index: 2;">
            <div class="d-flex align-items-center gap-1 mb-2 justify-content-center">
              <h3 class="mb-0">{{ $user->username }}</h3>
              <span>{{ $user->age }}</span>
              <span>{{ ucfirst($user->gender) }}</span>
            </div>
            <div class="d-flex flex-wrap gap-2 small justify-content-center">
              <span><i class="bi bi-geo-alt"></i> {{ $user->city }}</span>
              <span>{{ $user->height }} cm</span>
              <span>{{ $user->weight }} kg</span>
              <span>{{ $user->size }} cm</span>
              <span>{{ $user->position }}</span>
            </div>
            <!-- Like/Dislike buttons -->
            <div class="d-flex justify-content-center gap-5">
              <button wire:click="like('dislike')" class="story-btn">
                <i class="bi bi-x-lg fs-2"></i>
              </button>
              <button wire:click="like('like')" class="story-btn">
                <i class="bi bi-suit-heart-fill fs-2"></i>
              </button>
            </div>

          </div>
          <div class="carousel-indicators mb-0" style="position: relative; top: 0; bottom: unset; margin-bottom: 10px; z-index: 3;">
            @foreach($photos as $i => $photo)
              <button type="button" data-bs-target="#userPhotoCarousel" data-bs-slide-to="{{ $i }}" @if($i === 0) class="active" aria-current="true" @endif aria-label="Slide {{ $i+1 }}"></button>
            @endforeach
          </div>
          <div id="userPhotoCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              @foreach($photos as $i => $photo)
                <div class="carousel-item @if($i === 0) active @endif">
                  <div class="phone-container" style="background: #f8f9fa; border-radius: 2.5rem;">
                    <div class="image-container" style="height: 420px; display: flex; align-items: center; justify-content: center;">
                      <img src="{{ asset('storage/'.$photo) }}" class="d-block" alt="{{ $user->username }}" style="max-width: 90%; max-height: 90%; border-radius: 1.5rem; box-shadow: 0 4px 24px rgba(0,0,0,0.10);">
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
            @if(count($photos) > 1)
            <button class="carousel-control-prev" type="button" data-bs-target="#userPhotoCarousel" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#userPhotoCarousel" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
            @endif
          </div>
        </div>
      </div>


      <div class="text-center mt-2">
        User {{ $users->currentPage() }} of {{ $users->lastPage() }}
      </div>
    @else
      <p class="text-center">No more users found.</p>
    @endif
  </div>
  @include('partials.bottom-navbar')

</section>
<!-- Bootstrap JS (required for carousel) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</div>
