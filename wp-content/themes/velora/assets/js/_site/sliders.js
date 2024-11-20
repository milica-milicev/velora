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
                  slidesPerView: 3.3,
                  spaceBetween: 20,
              },
              1199: {
                  slidesPerView: 4.3
              },
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
                spaceBetween: 20,
            },
          }
        });

        const swiper = new Swiper('.swiper-container', {
          slidesPerView: 1,
          spaceBetween: 20,
          // loop: true,
          pagination: {
              el: '.swiper-pagination',
              clickable: true,
          },
          // navigation: {
          //     nextEl: '.swiper-button-next',
          //     prevEl: '.swiper-button-prev',
          // },
          breakpoints: {
              640: {
                  slidesPerView: 1,
                  spaceBetween: 10,
              },
              768: {
                  slidesPerView: 2,
                  spaceBetween: 15,
              },
              1024: {
                  slidesPerView: 4,
                  spaceBetween: 20,
              },
          }
      });
    }
};

export default Sliders;
