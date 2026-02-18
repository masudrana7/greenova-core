(function ($) {
    "use strict";

    $(window).on('elementor/frontend/init', function () {

        //Testimonial Carousel
        elementorFrontend.hooks.addAction("frontend/element_ready/rt-testimonial-carousel.default", function (scope, $) {
            var carousel = scope.find('.rt-owl-carousel');
            var carouselOption = carousel.data('carousel-options');
            carousel.owlCarousel(carouselOption);
        });

        //Team Carousel
        elementorFrontend.hooks.addAction("frontend/element_ready/rt-team-carousel.default", function (scope, $) {
            var carousel = scope.find('.rt-owl-carousel');
            var carouselOption = carousel.data('carousel-options');
            carousel.owlCarousel(carouselOption);
        });

        //Main Carousel
        elementorFrontend.hooks.addAction("frontend/element_ready/rt-main-slider.default", function (scope, $) {
            var swiperSlider = scope.find('.swiper-container');
            var sliderOptions = swiperSlider.data('option');
            var swiper = new Swiper(swiperSlider, sliderOptions);
        });

        //Project Carousel
        elementorFrontend.hooks.addAction("frontend/element_ready/rt-project-carousel.default", function (scope, $) {
            var carousel = scope.find('.rt-owl-carousel');
            var carouselOption = carousel.data('carousel-options');
            carousel.owlCarousel(carouselOption);
        });

        //Post Carousel
        elementorFrontend.hooks.addAction("frontend/element_ready/rt-post-carousel.default", function (scope, $) {
            var carousel = scope.find('.rt-owl-carousel');
            var carouselOption = carousel.data('carousel-options');
            carousel.owlCarousel(carouselOption);
        });

        //Counter
        elementorFrontend.hooks.addAction("frontend/element_ready/rt-counter.default", function (scope, $) {
            var counterWrap = scope.find('.rt-counter');
            var counterData = counterWrap.data();
            counterWrap.counterUp({
                delay: counterData.rtSteps,
                time: counterData.rtspeed
            });
        });

        //Project IsoTop
        elementorFrontend.hooks.addAction("frontend/element_ready/rt-project-grid.default", function (scope, $) {
            var $container = scope.find('#inner-isotope');
            if ($container.length > 0) {
                // Isotope initialization
                var $isotope = $container.find('.featuredContainer, .featuredContainer2 , .featuredContainerrr, .featuredContainer3').isotope({
                    filter: '*',
                    animationOptions: {
                        duration: 750,
                        easing: 'linear',
                        queue: false
                    }
                });

                // Isotope filter
                $container.find('.rt-portfolio-tab').on('click', 'a', function () {

                    var $this = $(this);
                    $this.parent('.rt-portfolio-tab').find('a').removeClass('current');
                    $this.addClass('current');
                    var selector = $this.attr('data-filter');
                    $isotope.isotope({
                        filter: selector,
                        animationOptions: {
                            duration: 750,
                            easing: 'linear',
                            queue: false
                        }
                    });
                    return false;

                });
            }
        });


    });

})(jQuery);