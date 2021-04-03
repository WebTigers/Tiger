(function ($) {
  "use strict";
  /*--------------- slick js--------*/
  if ($(".doc_feedback_slider").length) {
    $(".doc_feedback_slider").slick({
      autoplay: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplaySpeed: 2000,
      rtl: true,
      speed: 1000,
      dots: false,
      arrows: true,
      prevArrow: ".prev",
      nextArrow: ".next",
    });
  }
})(jQuery);
