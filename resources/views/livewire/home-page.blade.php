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
                <div class="swiper-slide">
                    <div class="story-view-area d-grid justify-content-center">
                        <div class="story-details-area position-relative">
                            <!-- Photo 1 -->
                            @if($user->photo1)
                            <div class="img-area">
                                <img class="w-100" src="{{ asset('storage/' . $user->photo1) }}" alt="{{ $user->username }}">
                            </div>
                            @endif

                            <!-- Photo 2 -->
                            @if($user->photo2)
                            <div class="img-area">
                                <img class="w-100" src="{{ asset('storage/' . $user->photo2) }}" alt="{{ $user->username }}">
                            </div>
                            @endif

                            <!-- Photo 3 -->
                            @if($user->photo3)
                            <div class="img-area">
                                <img class="w-100" src="{{ asset('storage/' . $user->photo3) }}" alt="{{ $user->username }}">
                            </div>
                            @endif

                            <div class="story-details d-between px-4 pb-5 w-100">
                                <div class="user-info">
                                    <button class="active fs-sm mb-2">Active</button>
                                    <a href="#">
                                        <div class="d-flex align-items-center gap-1 mb-3">
                                            <h3>{{ $user->username }}</h3>
                                            <img class="verified-badge" src="images/verified.png" alt="verified">
                                        </div>
                                    </a>
                                    <div class="d-flex align-items-center gap-3">
                                        <span>{{ $user->age }} age</span>
                                        <span><i class="bi bi-geo-alt"></i> {{ $user->city }}</span>
                                        <span>{{ $user->height }} cm</span>
                                        <span>{{ $user->weight }} kg</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-3 mt-2">
                                        <span>{{ ucfirst($user->gender) }}</span>
                                        <span>{{ $user->size }} cm</span>
                                        <span>{{ ucfirst($user->position) }}</span>
                                        <span>{{ strtoupper($user->language) }}</span>
                                    </div>
                                </div>
                                <div class="story-action-btn d-grid gap-3 position-relative">
                                    <a href="#" class="msg-btn tcn-1 rounded-circle d-center">
                                        <i class="bi bi-chat-square-dots"></i>
                                    </a>
                                    <button class="more-action-btn tcn-1">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <div class="button-action-area">
                                        <button class="d-block py-2 px-3 tcn-700 fs-sm">Remove</button>
                                        <div class="border-line"></div>
                                        <button class="d-block py-2 px-3 tcp-2-300 fs-sm">Report</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>

            <div class="button-area py-3 d-center align-items-end gap-3">
                <button class="close-story story-btn"><i class="bi bi-x-lg fs-2"></i></button>
                <button class="like-story story-btn"><i class="bi bi-suit-heart-fill fs-2"></i></button>
                <button class="star-story story-btn"><i class="bi bi-star-fill fs-2"></i></button>
            </div>
            <div class="d-flex justify-content-between mt-3">
                <div class="story-swiper-prev btn btn-light"><i class="bi bi-chevron-left"></i></div>
                <div class="story-swiper-next btn btn-light"><i class="bi bi-chevron-right"></i></div>
            </div>
            <div class="story-pagination text-center mt-2"></div>
        </div>
    </div>

</section>

<script>
document.addEventListener('DOMContentLoaded', () => {
    setTimeout(() => {
        const preloader = document.getElementById('preloader');
        if(preloader) preloader.style.display = 'none';
    }, 500);

    new Swiper('.story-slide', {
        slidesPerView: 1,
        effect: 'cards',
        grabCursor: true,
        loop: true,
        pagination: {
            el: '.story-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.story-swiper-next',
            prevEl: '.story-swiper-prev',
        },
        autoplay: {
            delay: 8000,
            disableOnInteraction: false,
        }
    });
});
</script>
