// https://swiperjs.com/ 
// ===================== -->

var mySwiper = new Swiper('.main-slider', {
  // Optional parameters
  direction: 'horizontal',
  loop: true,
  speed: 1200,
  grabCursor: true,
  mousewheel: false,
  disableOnInteraction: false,
  autoplay: true,
  // If we need pagination
  // pagination: {
  //   el: '.swiper-pagination',
  //   type: 'bullets',
  //   clickable: true,
  //   dynamicBullets: true,
  // },

  // Navigation arrows
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },

  on: {
    slideChangeTransitionStart: function () {
      // Slide captions
      var swiper = this;
      setTimeout(function () {
        var currentTitle = $(swiper.slides[swiper.activeIndex]).attr("data-title");
        var currentSubtitle = $(swiper.slides[swiper.activeIndex]).attr("data-subtitle");
      }, 500);
      gsap.to($(".current-title"), 0.4, { autoAlpha: 0, y: -40, ease: Power1.easeIn });
      gsap.to($(".current-subtitle"), 0.4, { autoAlpha: 0, y: -40, delay: 0.15, ease: Power1.easeIn });
    },
    slideChangeTransitionEnd: function () {
      // Slide captions
      var swiper = this;
      var currentTitle = $(swiper.slides[swiper.activeIndex]).attr("data-title");
      var currentSubtitle = $(swiper.slides[swiper.activeIndex]).attr("data-subtitle");
      $(".slide-captions").html(function () {
        return "<h2 class='current-title'>" + currentTitle + "</h2>" + "<h3 class='current-subtitle'>" + currentSubtitle + "</h3>";
      });
      gsap.from($(".current-title"), 0.4, { autoAlpha: 0, y: 40, ease: Power1.easeOut });
      gsap.from($(".current-subtitle"), 0.4, { autoAlpha: 0, y: 40, delay: 0.15, ease: Power1.easeOut });
    }
  }
});

// Slide captions
var currentTitle = $(mySwiper.slides[mySwiper.activeIndex]).attr("data-title");
var currentSubtitle = $(mySwiper.slides[mySwiper.activeIndex]).attr("data-subtitle");
$(".slide-captions").html(function () {
  return "<h2 class='current-title'>" + currentTitle + "</h2>" + "<h3 class='current-subtitle'>" + currentSubtitle + "</h3>";
});


var swiper = new Swiper(".newSlider", {
  slidesPerView: 1,
  spaceBetween: 10,
  loop: true,
  autoplay: {
    delay: 2500,
    disableOnInteraction: false

  },
  breakpoints: {
    640: {
      slidesPerView: 1,
      spaceBetween: 20,
    },
    768: {
      slidesPerView: 1,
      spaceBetween: 20,
    },
    1024: {
      slidesPerView: 3,
      spaceBetween: 20,
    },
    1200: {
      slidesPerView: 4,
      spaceBetween: 20,
    },
  },
});


var swiper = new Swiper(".managementTeam", {
  slidesPerView: 1,
  spaceBetween: 10,
  loop: true,
  autoplay: {
    delay: 2500,
    disableOnInteraction: false

  },
  breakpoints: {
    640: {
      slidesPerView: 1,
      spaceBetween: 20,
    },
    768: {
      slidesPerView: 1,
      spaceBetween: 20,
    },
    1024: {
      slidesPerView: 3,
      spaceBetween: 20,
    },
    1200: {
      slidesPerView: 2,
      spaceBetween: 20,
    },
  },
});


var swiper = new Swiper(".managementTeam2", {
  slidesPerView: 1,
  spaceBetween: 10,
  loop: true,
  autoplay: {
    delay: 2500,
    disableOnInteraction: false

  },
  breakpoints: {
    640: {
      slidesPerView: 1,
      spaceBetween: 20,
    },
    768: {
      slidesPerView: 1,
      spaceBetween: 20,
    },
    1024: {
      slidesPerView: 2,
      spaceBetween: 20,
    },
    1200: {
      slidesPerView: 3,
      spaceBetween: 20,
    },
  },
});


var swiper = new Swiper(".testimonialSwiper", {
  slidesPerView: 1,
  spaceBetween: 10,
  loop: true,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  autoplay: {
    delay: 2500,
    disableOnInteraction: false

  },
  breakpoints: {
    640: {
      slidesPerView: 1,
      spaceBetween: 20,
    },
    768: {
      slidesPerView: 1,
      spaceBetween: 20,
    },
    1024: {
      slidesPerView: 2,
      spaceBetween: 20,
    },
    1200: {
      slidesPerView: 4,
      spaceBetween: 45,
    },
  },
});

var swiper = new Swiper(".facilitiesOne", {
  loop: true,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  autoplay: {
    delay: 2500,
    disableOnInteraction: false,
  },
});
var swiper = new Swiper(".facilitiesTwo", {
  loop: true,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  autoplay: {
    delay: 2500,
    disableOnInteraction: false,
  },
});