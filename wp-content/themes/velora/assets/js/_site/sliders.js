import Swiper from "swiper/bundle";

'use strict';
const Sliders = {
    init: function () {
        var swiperProducts = new Swiper('.js-swiper-products', {
            slidesPerView: 1.6,
            spaceBetween: 10,

            navigation: {
                nextEl: '.swiper-button-next-products',
                prevEl: '.swiper-button-prev-products',
            },

			breakpoints: {
				576: {
					slidesPerView: 2.3
				},
				767: {
					slidesPerView: 4.3,
				},
				991: {
					slidesPerView: 4.3,
					spaceBetween: 20,
				}
			}
        });

        var swiperBlog = new Swiper('.js-swiper-blog', {
            slidesPerView: 1.6,
            spaceBetween: 10,
            pagination: {
              el: ".swiper-posts-pagination",
              clickable: true,
            },

            navigation: {
              nextEl: '.swiper-button-next-posts',
              prevEl: '.swiper-button-prev-posts',
          },

          breakpoints: {
            576: {
                slidesPerView: 2.3
            },
            767: {
                slidesPerView: 3,
            },
			991: {
				slidesPerView: 3,
                spaceBetween: 20,
            },
          }
        });

		var productMain = new Swiper(".js-product-main", {
			watchOverflow: true,
			watchSlidesVisibility: true,
			watchSlidesProgress: true,
			preventInteractionOnTransition: true,
			navigation: {
				nextEl: '.js-product-main-next-btn',
				prevEl: '.js-product-main-prev-btn',
			},
			effect: 'fade',
				fadeEffect: {
				crossFade: true
			},
		});

		// Dodajte funkcionalnost za sličice kao navigaciju
		const productThumbs = document.querySelectorAll('.js-product-gallery-thumb');

		if (productThumbs.length > 0) {
			productThumbs.forEach((thumb, index) => {
				thumb.addEventListener('click', () => {
					// Promenite glavni slajd
					productMain.slideTo(index);

					// Obeležite aktivnu sličicu
					productThumbs.forEach(t => t.classList.remove('active'));
					thumb.classList.add('active');
				});
			});

			// Sinhronizujte aktivnu sličicu kada se promeni slajd u glavnom slideru
			productMain.on('slideChange', () => {
				const activeIndex = productMain.activeIndex;

				productThumbs.forEach(t => t.classList.remove('active'));
				productThumbs[activeIndex].classList.add('active');
			});

			// Postavite početnu aktivnu sličicu
			productThumbs[0].classList.add('active');
		}

		// Custom fancybox - Product gallery slider in modal window
		const productGallery = document.querySelector('.js-product-gallery');
		const productGalleryImg = document.querySelector('.js-gallery-main-img');
		const productMainSlider = document.querySelector('.js-product-main');
		const galleryModalSliderSel = document.querySelector('.js-product-gallery-modal');
		const modalCloseBtn = document.querySelector('.js-product-gallery-modal-close-btn');

		var galleryModalSlider = new Swiper('.js-product-gallery-modal-slider', {
			spaceBetween: 10,
			navigation: {
				nextEl: '.js-product-modal-next-btn',
				prevEl: '.js-product-modal-prev-btn',
			}
		});

		if (productGallery) {
			if (productMainSlider) {
				productMainSlider.addEventListener('click', function(e) {
					e.preventDefault();
					var clickedSlideIndex = productMain.activeIndex;
					galleryModalSlider.update();
					galleryModalSlider.slideTo(clickedSlideIndex, 0);
					galleryModalSliderSel.classList.add('is-visible');
				});
			} else {
				productGalleryImg.addEventListener('click', function(e) {
					e.preventDefault();
					galleryModalSliderSel.classList.add('is-visible');
				});
			}
		
			modalCloseBtn.addEventListener('click', function() {
				galleryModalSliderSel.classList.remove('is-visible');
			});
			
			// Dodajte event listener na document za osluškivanje keydown događaja
			document.addEventListener('keydown', function(event) {
				// Proverite da li je pritisnut taster 'Esc'
				if (event.key === "Escape") {
					// Proverite da li je modal trenutno vidljiv pre nego što ga pokušate zatvoriti
					if (galleryModalSliderSel.classList.contains('is-visible')) {
						galleryModalSliderSel.classList.remove('is-visible');
					}
				}
			});
		}

    }
};

export default Sliders;
