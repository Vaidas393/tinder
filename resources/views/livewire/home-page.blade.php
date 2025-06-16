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

        <div class="swiper story-slide">
            <div class="swiper-wrapper position-relative">

                @foreach ($users as $user)
                    @foreach (['photo1', 'photo2', 'photo3'] as $photo)
                        @if($user->$photo)
                            <div class="swiper-slide">
                                <div class="phone-container">

                                    <div class="image-container">
                                        <img src="{{ asset('storage/' . $user->$photo) }}" alt="{{ $user->username }}">
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
                                            <div class="d-flex justify-content-center align-items-center gap-3 pt-4">
                                              <button class="story-btn"><i class="bi bi-x-lg fs-2"></i></button>
                                              <button class="story-btn"><i class="bi bi-suit-heart-fill fs-2"></i></button>
                                              <button class="story-btn"><i class="bi bi-star-fill fs-2"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-3">
                                        <div class="story-swiper-prev btn btn-light"><i class="bi bi-chevron-left"></i></div>
                                        <div class="story-swiper-next btn btn-light"><i class="bi bi-chevron-right"></i></div>
                                    </div>
                                    <div class="story-pagination text-center mt-2"></div>
                                    <!-- <div class="button-area py-3 d-flex justify-content-center align-items-center gap-3">

                                    </div> -->

                                </div>
                            </div>
                        @endif
                    @endforeach
                @endforeach

            </div>


        </div>
    </div>
</section>


<script>
document.addEventListener('DOMContentLoaded', () => {
    setTimeout(() => {
        const preloader = document.getElementById('preloader');
        if(preloader) preloader.style.display = 'none';
    }, 500);

    const swiper = new Swiper('.story-slide', {
        slidesPerView: 1,
        effect: 'cards',
        grabCursor: true,
        loop: false,
        pagination: {
            el: '.story-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.story-swiper-next',
            prevEl: '.story-swiper-prev',
        }
    });
});
</script>
