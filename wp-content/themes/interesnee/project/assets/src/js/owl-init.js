(function ($) {
  const allCarouselsOnPage = $('.owl-carousel');
  const initCarouselWithProps = elem => {
    elem.owlCarousel({
      slideSpeed: elem.data('settings').speed,
      loop: true,
      rewind: true,
      autoplay: elem.data('settings').autorotate,
      autoplayHoverPause: true,
      center: true,
      nav: elem.data('settings').nav,
      dots: elem.data('settings').dots,
      responsive: {
        0: {
          items: elem.data('settings').mobile,
        },
        641: {
          items: elem.data('settings').tablet,
        },
        1000: {
          items: elem.data('settings').desktop,
        },
      },
    });
  };

  [...allCarouselsOnPage].forEach(item => {
    item = $(item);
    if (item.data('settings').screen_resolution_to_off !== '') {
      if (window.innerWidth < item.data('settings').screen_resolution_to_off) {
        initCarouselWithProps(item);
      } else {
        item.owlCarousel('destroy');
        item.addClass('off');
        item.find('.carousel-item').css({width: 100 / item.data('settings').desktop + '%'});
      }

      $(window).resize(() => {
        if (window.innerWidth < item.data('settings').screen_resolution_to_off) {
          initCarouselWithProps(item);
          item.removeClass('off');
          $('.carousel-item', item).css({width: ''});
        } else {
          item.owlCarousel('destroy');
          item.addClass('off');
          item.find('.carousel-item').css({width: 100 / item.data('settings').desktop + '%'});
        }
      });
    } else {
      initCarouselWithProps(item);
    }
    // slideChangedEvent(item);
  });
})(jQuery);