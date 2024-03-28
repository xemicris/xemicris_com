//Initialize Swiper
  var swiper = new Swiper(".mySwiper", {
    effect: "coverflow",
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: "auto",
    mousewheel: true,
    coverflowEffect: {
      rotate: 5,
      stretch: 0,
      depth: 300,
      modifier: 1.5,
      slideShadows: false,
    },
    navigation: {
      nextEl: ".swiper-button-prev",
      prevEl: ".swiper-button-next",
    },
    pagination: {
      el: ".swiper-pagination",
    },
  });
