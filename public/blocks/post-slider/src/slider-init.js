(function (window) {

    window.initBldpstSlider = function (scope) {

        const wraps = (scope || document).querySelectorAll(
            '.bldpst-post-slider-block-wrap'
        );

        wraps.forEach(function (wrap) {

            // Check if Swiper is available
            if (typeof Swiper === 'undefined') {
                console.warn('Bold Post: Swiper is not defined. Retrying later or check enqueue.');
                return;
            }

            const unique = wrap.dataset.unique;
            const sliderElement = wrap.querySelector('.bldpst-post-slider-' + unique);

            // already initialized or no slider element
            if (wrap.dataset.initialized === 'true' || !sliderElement) {
                return;
            }

            // Initialize Swiper with element reference
            try {
                new Swiper(sliderElement, {
                    slidesPerView: Number(wrap.dataset.slidesPerView) || 1,
                    spaceBetween: Number(wrap.dataset.spaceBetween) || 15,
                    centeredSlides: wrap.dataset.centeredSlides === 'true',
                    loop: wrap.dataset.loop === 'true',
                    effect: wrap.dataset.effect || 'slide',
                    speed: Number(wrap.dataset.speed) || 300,
                    autoplay: wrap.dataset.autoplay !== 'false' ? {
                        delay: Number(wrap.dataset.speed) || 3000,
                        disableOnInteraction: wrap.dataset.pauseOnInter === 'true',
                        pauseOnMouseEnter: wrap.dataset.pauseOnHover === 'true',
                    } : false,

                    navigation: {
                        nextEl: wrap.querySelector('.swiper-button-next'),
                        prevEl: wrap.querySelector('.swiper-button-prev'),
                    },

                    // Ensure we use the specific pagination inside this wrap if it exists
                    pagination: {
                        el: wrap.querySelector('.swiper-pagination'),
                        clickable: true,
                    },

                    breakpoints: {
                        0: { slidesPerView: 1, spaceBetween: 10 },
                        360: { slidesPerView: 1, spaceBetween: 10 },
                        375: { slidesPerView: 1, spaceBetween: 10 },
                        480: { slidesPerView: 1, spaceBetween: 10 },
                        520: { slidesPerView: 1, spaceBetween: 10 },
                        575: {
                            slidesPerView: Number(wrap.dataset.slidesPerViewMobileSmall) || 1,
                            spaceBetween: 10,
                        },
                        767: {
                            slidesPerView: Number(wrap.dataset.slidesPerViewMobile) || 1,
                            spaceBetween: 10,
                        },
                        991: {
                            slidesPerView: Number(wrap.dataset.slidesPerViewTablet) || 2,
                            spaceBetween: 10,
                        },
                        1199: {
                            slidesPerView: Number(wrap.dataset.slidesPerView) || 3,
                            spaceBetween: 20,
                        },
                        1600: {
                            slidesPerView: Number(wrap.dataset.slidesPerView) || 3,
                            spaceBetween: 30,
                        },
                    },
                    on: {
                        init: function () {
                            wrap.dataset.initialized = 'true';
                        }
                    }
                });
            } catch (e) {
                console.error('Bold Post: Swiper init failed', e);
            }

            // Mark as initialized immediately to avoid double calls before Swiper finishes
            wrap.dataset.initialized = 'true';
        });
    };

    // Frontend initial load
    document.addEventListener('DOMContentLoaded', function () {
        window.initBldpstSlider(document);
    });

})(window);