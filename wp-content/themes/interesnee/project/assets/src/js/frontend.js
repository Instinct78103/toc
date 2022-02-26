const mobileMenu = {
  status: false,
  currentScroll: 0,
  get isOn() {
    return this.status;
  },
  set isOn(val) {
    this.status = val;
    if (this.status) {
      this.currentScroll = jQuery(window).scrollTop();
      jQuery('.site-header').css({backgroundColor: '#b71c1c'});
      jQuery('.mobile-menu-container').addClass('open');
      jQuery('#content, #colophon').css({
        display: 'none',
      });
    } else {
      jQuery('.site-header').css({backgroundColor: '#931314'});
      jQuery('.mobile-menu-container').removeClass('open');
      jQuery('#content, #colophon').css({
        display: 'block',
      });
      jQuery(document).scrollTop(this.currentScroll);
    }
  },
};

/**
 * @typedef {Object} jQuery
 */

(function ($) {
  $('.site-header').css({
    top: parseInt($('html').css('marginTop')) + 'px',
  });

  function isTocOnScreen(element) {
    const curPos = element.offset();
    const curTop = curPos.top - $(window).scrollTop();
    const screenHeight = $(window).height();
    return !(curTop > screenHeight || curTop < $(window).scrollTop());
  }

  if ($('.toc_block').length) {
    $(window).on('scroll', function (e) {
      if ($('.toc-item.active').length) {
        const toc_active = $('.toc-item.active');
        if (!isTocOnScreen(toc_active)) {
          $('.toc_block').css({
            top: `${(jQuery('.toc-item.active').offset().top - jQuery('.toc_block').offset().top - 200) * -1}px`,
          });
        }
      }
    });
  }

  const headerOffset = $('.site-header').innerHeight() + parseInt($('.site-header').css('top'));

  $('.mobile-menu-toggle').on('click', function (e) {
    e.preventDefault();
    e.stopPropagation();

    const offset =
      $('#masthead').innerHeight() +
      parseInt($('html').css('marginTop')) +
      'px';

    $('.mobile-menu-container').css({
      top: offset,
      height: `calc(100vh - ${offset})`,
    });

    mobileMenu.isOn = !mobileMenu.isOn;
  });

  [...$('a[href^="#"]')].forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
      scrollToElem(this.getAttribute('href'));
    });
  });

  function scrollToElem(elem) {
    if ($(elem).length) {
      $([document.documentElement, document.body]).animate({
        scrollTop: $(elem).offset().top - headerOffset + 2,
      }, 800);
    }
  }

  if ($('body').hasClass('single-post')) {
    const hash_obj = {
      hash: '',
    };

    const hash_proxy = new Proxy(hash_obj, {
      set: function (target, key, value) {
        if (key === 'hash') {
          if (target[key] !== value) {
            if (value) {
              const hash = '#' + value;
              history.replaceState(null, null, hash);
              $(`.toc-item a`).parent('.toc-item').removeClass('active');
              $(`.toc-item a[href="${hash}"]`).parent('.toc-item').addClass('active');
            } else {
              const uri = window.location.toString();
              const uri_no_hash = uri.substring(0, uri.indexOf('#'));
              history.replaceState(null, null, uri_no_hash);
              $(`.toc-item a`).parent('.toc-item').removeClass('active');
            }
          }
        }
        target[key] = value;
        return true;
      },
    });

    $(document).on('scroll', function (e) {
      const q = Array.from($('.heading')).reverse().find(item => item.offsetTop < window.pageYOffset + headerOffset);
      hash_proxy.hash = q ? q.id : '';
    });
  }

  function user_voted(post_id) {
    const cookie = document.cookie;

    const like_yes = `rating[${post_id}][like]=yes`;
    const dislike_yes = `rating[${post_id}][dislike]=yes`;

    const like_exists = cookie.split('; ').some(item => item === like_yes);
    const dislike_exists = cookie.split('; ').some(item => item === dislike_yes);

    if (like_exists) {
      $('button[data-button="like"]').addClass('active');
    } else {
      $('button[data-button="like"]').removeClass('active');
    }

    if (dislike_exists) {
      $('button[data-button="dislike"]').addClass('active');
    } else {
      $('button[data-button="dislike"]').removeClass('active');
    }
  }

  if ($('.postid').length) {
    user_voted($('.postid').val());
  }

  $('button[data-button]').on('click', function (e) {
    const $link = e.target;
    e.preventDefault();

    if (!$link.dataset.lockedAt || +new Date() - $link.dataset.lockedAt > 1000) {
      const ajaxurl = '/wp-admin/admin-ajax.php';
      const data = {
        action: 'refresh_post_rating',
        param: {
          button_clicked: $(this).data('button'),
          postid: $('.postid').val(),
        },
      };

      jQuery.post(
        ajaxurl,
        data,
        resp => {
          const respParsed = JSON.parse(resp);

          $('button[data-button="like"] > .like').text(respParsed.likes);
          $('button[data-button="dislike"] > .dislike').text(respParsed.dislikes);

          user_voted(data.param.postid);
        },
      );
    }

    e.target.dataset.lockedAt = +new Date();
  });

  document.querySelector('.expand').addEventListener('click', function (e) {
    if (window.innerWidth <= 1000) {

      $('.toc_block').toggleClass('open');

      document.querySelector('.expand > .far').classList.contains('fa-list')
        ? document.querySelector('.expand > .far').classList.replace('fa-list', 'fa-mark')
        : document.querySelector('.expand > .far').classList.replace('fa-mark', 'fa-list');
    }
  });

})(jQuery);