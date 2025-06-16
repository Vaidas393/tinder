<section class="home-page position-relative pb-120 z-1 overflow-hidden">
  <div class="container px-0">
    <div class="header-area mt-5 mb-3 px-3">
      <div class="d-between">
        <a href="account.html">
          <div class="profile-thumb d-flex align-items-center gap-2">
            <div class="img-area active">
              <img class="w-100" src="images/mr-x.png" alt="user">
            </div>
            <span class="fs-sm tcn-700">Jon L.</span>
          </div>
        </a>
        <div class="line-bar rounded bgp2-50 py-1 px-2">
          <i class="bi bi-text-center fs-lg tcp-2-300"></i>
        </div>
      </div>
    </div>

    @if($users->count())
      @php
        $user   = $users->first();
        $photos = array_filter([$user->photo1, $user->photo2, $user->photo3]);
      @endphp

      <!-- Photo-only Swiper -->
      <div class="swiper photo-slider">
        <div class="swiper-wrapper">
          @foreach($photos as $photo)
            <div class="swiper-slide">
              <div class="phone-container">
                <div class="image-container">
                  <img src="{{ asset('storage/'.$photo) }}" alt="{{ $user->username }}">
                </div>
                <div class="user-info px-3 py-2">
                  <div class="d-flex align-items-center gap-1 mb-2">
                    <h3>{{ $user->username }}</h3>
                    <span>{{ $user->age }}</span>
                    <span>{{ ucfirst($user->gender) }}</span>
                  </div>
                  <div class="d-flex flex-wrap gap-2 small">
                    <span><i class="bi bi-geo-alt"></i> {{ $user->city }}</span>
                    <span>{{ $user->height }} cm</span>
                    <span>{{ $user->weight }} kg</span>
                    <span>{{ $user->size }} cm</span>
                    <span>{{ ucfirst($user->position) }}</span>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
        <div class="swiper-pagination photo-pagination"></div>
      </div>

      <!-- User navigation (full page reload) -->
      <div class="d-flex justify-content-center gap-5 mt-4">
        @if($users->previousPageUrl())
          <a href="{{ $users->previousPageUrl() }}" class="story-btn">
            <i class="bi bi-x-lg fs-2"></i>
          </a>
        @else
          <button class="story-btn disabled"><i class="bi bi-x-lg fs-2"></i></button>
        @endif

        @if($users->nextPageUrl())
          <a href="{{ $users->nextPageUrl() }}" class="story-btn">
            <i class="bi bi-suit-heart-fill fs-2"></i>
          </a>
        @else
          <button class="story-btn disabled"><i class="bi bi-suit-heart-fill fs-2"></i></button>
        @endif
      </div>

      <div class="text-center mt-2">
        User {{ $users->currentPage() }} of {{ $users->lastPage() }}
      </div>
    @else
      <p class="text-center">No more users found.</p>
    @endif
  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', () => {
  // hide preloader
  setTimeout(() => {
    const pre = document.getElementById('preloader')
    if (pre) pre.style.display = 'none'
  }, 500)

  // initialize only the photo swiper
  new Swiper('.photo-slider', {
    slidesPerView: 1,
    effect: 'cards',
    grabCursor: true,
    loop: false,
    pagination: {
      el: '.photo-pagination',
      clickable: true
    }
  })
})
</script>
