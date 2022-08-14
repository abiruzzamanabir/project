(function($){

  'use strict';

  function initNavbar () {
    if (!$('section:first').is('.parallax, #home, .splash')) {
      $('#topnav').addClass('scroll');
      $('body').addClass('top-padding');
    }

    if ($('section:first').is('#home') && $('#home').hasClass('bordered')) {
      $('#topnav').addClass('top-space');
    }

    $(window).scroll(function() {
      
      if($('section:first').is('.parallax, #home, .splash')){
        if ($(window).scrollTop() >= 100 ) {
          $('#topnav').addClass('scroll');
        } else{
          $('#topnav').removeClass('scroll');
        }
      }

      var filters = $('#filters');
      if(filters.length && !filters.hasClass('no-fix')){
        if ($(window).scrollTop() >= $('.page-title:first').height() + 30) {
          filters.addClass('fixed');
        } else{
          filters.removeClass('fixed');
        }
      }

    }).trigger('scroll');

    $('.navbar-toggle').on('click', function(event) {
      $(this).toggleClass('open');
      $('#navigation').slideToggle(400);
      $('.cart, .search').removeClass('open');
    });

    $('.cart').on('click', function(event) {
      event.preventDefault();
      event.stopPropagation();
      if ($(window).width() < 768) {
        if ($('#navigation').is(':visible')) {
          $('.navbar-toggle').click();
        }
        $('.search').removeClass('open');
        $(this).toggleClass('open');
      }
    });

    $('.search').on('click', function(event) {
      event.preventDefault();
      event.stopPropagation();
      if ($(window).width() < 768) {
        if ($('#navigation').is(':visible')) {
          $('.navbar-toggle').click();
        }
        $('.cart').removeClass('open');
        $(this).toggleClass('open');
      }
    });

    $('.shopping-cart, .search-form').on('click', function(e) {
      event.stopPropagation();
    });

    $('body').on('click', function(event) {
      $('.cart, .search').removeClass('open');
    });

    $('.navigation-menu>li').slice(-2).addClass('last-elements');

    $('.navigation-menu li.has-submenu a[href="#"]').on('click', function(e) {
      if ($(window).width() < 992) {
        e.preventDefault();
        $(this).parent('li').toggleClass('open').find('.submenu:first').toggleClass('open');
      }
    });
  }

  function initHomeSlider() {

    $('#home-slider img').each(function(index, el) {
      var slide = $(this).parent('li');
      var image = $(this).attr('src');

      $(slide).prepend($('<div class="slide-image"></div>').css('background-image', 'url('+image+')'));

      if (navigator.userAgent.indexOf("Firefox") != -1 && $('#home').hasClass('bordered')) {
        $('.slide-image').addClass('ff-fix');
      }

      $(this).remove();
    });

    var options = {
      prevText: '<i class="ti-angle-left"></i>',
      nextText: '<i class="ti-angle-right"></i>',
      keyboard: false,
    };

    if ($('#home-slider .slides > li').length < 2) {
      options.directionNav = false
    }

    if ($('#home-slider').hasClass('kenburn')) {

      options.start = function () {
        $('#home-slider').find(".slides > li.flex-active-slide > .slide-image").each(function () {
          var $content = $(this);
          $content.css({
            '-webkit-transform': 'scale(1.2)',
            '-moz-transform': 'scale(1.2)',
            'transform': 'scale(1.2)',
          });
        })
      }

      options.before = function () {
        $('#home-slider').find(".slides > li > .slide-image").each(function () {
          var $content = $(this);
          $content.css({
            '-webkit-transform': 'scale(1)',
            '-moz-transform': 'scale(1)',
            'transform': 'scale(1)',
          });
        })
      }

      options.after = function () {
        $('#home-slider').find(".slides > li.flex-active-slide > .slide-image").each(function () {
          var $content = $(this);
          $content.css({
            '-webkit-transform': 'scale(1.2)',
            '-moz-transform': 'scale(1.2)',
            'transform': 'scale(1.2)',
          });
        })
      }
    }

    $('#home-slider').flexslider(options);

    $('#text-rotator').flexslider({
      controlNav: false,
      directionNav: false
    })
  }

  function initCarousels () {
    $('.owl-carousel').each(function(index, el) {
      var dataOptions = $(this).data('options') || {};

      var options = {
        items: dataOptions.items || 4,
        loop: dataOptions.loop || true,
        dots: dataOptions.dots || false,
        margin: dataOptions.margin || 10,
        autoplay: dataOptions.autoplay || false,
        responsiveClass: true,
        responsive:{
          0:{
            items: dataOptions.xsItems || 1,
            margin: 25
          },
          768:{
            items: dataOptions.smItems || 2,
          },
          992:{
            items:dataOptions.mdItems || 3,
          },
          1200: {
            items: dataOptions.items || 4
          }
        }
      }

      if (options.autoplay) {
        options.autoplayTimeout = dataOptions.autoplayTimeout || 2000;
        options.autoplayHoverPause = true;
      }


      $(el).owlCarousel(options);
    });
  }

  function initSliders () {
    $('.flexslider').each(function(index, el) {
      var dataOptions = $(this).data('options') || {};

      var options = {
        animation: dataOptions.animation === 'slide' ? 'slide' : 'fade',
        controlNav: dataOptions.controlNav === true ? true : false,
        directionNav: dataOptions.directionNav === true ? true : false,
        prevText: '<i class="ti-arrow-left"></i>',
        nextText: '<i class="ti-arrow-right"></i>',
      };

      $(el).flexslider(options);
    });
  }

  function initMap() {

    var lat = $('#map').data('lat');
    var lang = $('#map').data('lang');

    var myLatlng = new google.maps.LatLng(lat, lang);

    var styles = [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}];

    var mapOptions = {
      zoom: 12,
      center: myLatlng,
      mapTypeControl: false,
      disableDefaultUI: true,
      zoomControl: false,
      scrollwheel: false,
      styles: styles
    }

    var map = new google.maps.Map(document.getElementById('map'), mapOptions);

    var infowindow = new google.maps.InfoWindow({
      content: "We are here!"
    });

    var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      icon: 'images/marker.svg',
      title: 'We are here!'
    });

    google.maps.event.addListener(marker, 'click', function() {
      infowindow.open(map,marker);
    });
  }

  function initCountdowns () {
    var theDate = $('.countdown').data('date');
    $(".countdown").downCount({
      date: theDate,
      offset: 0
    });
  }

  function initAccordions () {
    $('.accordion-title').on('click', function(event) {
      var accordion = $(this).parents('.accordion');

      if (!accordion.data('multiple')) {
        accordion.find('li').not($(this).parent()).removeClass('active');
        accordion.find('li').not($(this).parent()).find('.accordion-content').slideUp(300);
      }

      $(this).parent('li').toggleClass('active');
      $(this).next().slideToggle(300, function () {
        fixScroll();
      });

    });
  }

  function initLoad () {
    $(window).load(function() {

      $("#loader").delay(500).fadeOut();
      $("#mask").delay(1000).fadeOut("slow");

      var $grid = $('#works').isotope({
        masonry: {
         columnWidth: 0
        },
        itemSelector: '.work-item'
      });

      $grid.on('layoutComplete', function(event) {
        $(window).trigger('resize');
        fixScroll();
      });;

      $('.blog-masonry').isotope({
        masonry: {
         columnWidth: 0
        },
        itemSelector: '.masonry-post'
      });

      $('#filters').on('click', 'li', function() {
        $('#filters li').removeClass('active');
        $(this).addClass('active');
        var filterValue = $(this).attr('data-filter');
        $('#works').isotope({ filter: filterValue });
        $(window).trigger('resize');
      });

    });
  }

  function initVideoModal () {
    $('.play-button').on('click', function(e) {
      var videoUrl = $(this).data('src');

      var template = '<div id="gallery-modal">';
      template += '<div class="centrize">';
      template += '<div class="v-center">';
      template += '<div class="gallery-image">';
      template += '<div class="media-video">';
      template += '<a href="#" id="gallery-close"><i class="ti-close"></i></a>';
      template += '<iframe src="'+ videoUrl +'" frameborder="0">';
      template += '</div>';
      template += '</div>';
      template += '</div>';
      template += '</div>';
      template += '</div>';

      $('body').append(template);

      $('body').addClass('modal-open');

      $('#gallery-modal').fadeIn(300);

    });
  }

  function initVideoBg(){

    if ($('.player').length) {
      $('.player').mb_YTPlayer({
        containment: '#video-wrapper',
        autoPlay: true,
        mute: true
      });

      if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
        $('#video-wrapper').append('<div id="fallback-bg"></div>');
        $('#fallback-bg').css('background-image', 'url('+$('#video-wrapper').data('fallback-bg')+')');
      }
    }

    var videoEl = $('#video-wrapper video');

    var setProportion = function () {
      var proportion = getProportion();
      videoEl.width(proportion*1280);
      videoEl.height(proportion*780);

      centerVideo();
    }

    var getProportion = function () {
      var windowWidth = $(window).width();
      var windowHeight = $(window).height();
      var windowProportion = windowWidth / windowHeight;
      var origProportion = 1280 / 720;
      var proportion = windowHeight / 720;

      if (windowProportion >= origProportion) {
        proportion = windowWidth / 1280;
      }

      return proportion;
    }

    var centerVideo = function() {
      var centerX = (($(window).width() >> 1) - (videoEl.width() >> 1)) | 0;
      var centerY = (($(window).height() >> 1) - (videoEl.height() >> 1)) | 0;

      videoEl.css({ 'left': centerX, 'top': centerY });
        
    }

    if (videoEl.length) {
      $(window).resize(function() {
        setProportion();
      }).trigger('resize');
    }
  }

  function initPhotoGallery () {

    var imagesArray = [];

    $('.photo-gallery').on('click', '.gallery-item a', function(event) {
      event.preventDefault();

      var gallery = $(this).parents('.photo-gallery');
      var galleryElements = gallery.find('.gallery-item>a');

      for (var i = 0; i < galleryElements.length; i++) {
        imagesArray.push($(galleryElements[i]).attr('href'));
      };

      var image = $(this).attr('href');

      var template = '<div id="gallery-modal">';
      template += '<div class="centrize">';
      template += '<div class="v-center">';
      template += '<div class="gallery-image">';
      template += '<a href="#" id="gallery-close"><i class="ti-close"></i></a>';
      template += '<a href="#" class="gallery-control gallery-prev"><i class="ti-angle-left"></i></a>';
      template += '<img src="'+imagesArray[imagesArray.indexOf(image)]+'" alt="">';
      template += '<a href="#" class="gallery-control gallery-next"><i class="ti-angle-right"></i></a>';
      template += '</div>';
      template += '</div>';
      template += '</div>';
      template += '</div>';

      $('body').append(template);
      $('body').addClass('modal-open');

      $('#gallery-modal').fadeIn(300);

    });

    $('body').on('click', '.gallery-control', function(event) {
      event.preventDefault();
      event.stopPropagation();

      var currentImage = $('.gallery-image').find('img');

      if ($(this).hasClass('gallery-next')) {
        if (imagesArray.indexOf(currentImage.attr('src')) >= (imagesArray.length - 1)) {
          return false;
        }

        currentImage.fadeOut(300, function() {
          var nextImage = imagesArray[imagesArray.indexOf(currentImage.attr('src')) + 1]
          $(currentImage).attr('src', nextImage);
        }).fadeIn(300);
      }

      else if ($(this).hasClass('gallery-prev')) {
        if (imagesArray.indexOf(currentImage.attr('src')) < 1) {
          return false;
        }

        currentImage.fadeOut(300, function() {
          var nextImage = imagesArray[imagesArray.indexOf(currentImage.attr('src')) - 1]
          $(currentImage).attr('src', nextImage);
        }).fadeIn(300);

      }

    });

    $('body').on('click', '#gallery-close', function(event) {
      event.preventDefault();
      $('#gallery-modal').fadeOut(300, function() {
        $('#gallery-modal').remove();
      });
      $('body').removeClass('modal-open');
    });

    $('body').on('click', '.gallery-image', function(event) {
      event.stopPropagation();
    });

    $('body').on('click', '#gallery-modal', function(event) {
      $('#gallery-close').trigger('click');
    });

    $(document).keyup(function(e) {
      if (e.keyCode == 27) {
        $('#gallery-close').trigger('click');
      }
      if (e.keyCode == 37) {
        $('.gallery-control.gallery-prev').trigger('click');
      }
      if (e.keyCode == 39) {
        $('.gallery-control.gallery-next').trigger('click');
      }
    });
  }

  function initContactForm() {

    var requiredInputs = $('#contact-form').find('input[data-required="true"], textarea[data-required="true"]').toArray();

    var isValidForm = function() {
      var toReturn;

      requiredInputs.forEach(function(element, index){
        if (!$(element).val()) {
          toReturn = false;
        } else{
          toReturn = true;
        }
      });

      return toReturn;
    }

    $('#contact-form').on('submit', function(event) {

      event.preventDefault();

      requiredInputs.forEach(function(element, index){
        if (!$(element).val()) {
          $(element).parent('.form-group').addClass('has-error');
        } else{
          $(element).parent('.form-group').removeClass('has-error');
        }
      });

      if (isValidForm()) {
        $.ajax({
          url: $(this).attr('action'),
          type: 'POST',
          data: $(this).serialize(),
        })
        .done(function() {
          var message = $('#contact-form').data('success-text') || 'Your message has been sent. We will get back to you shortly!';
          var succesTemplate = '<div role="alert" class="alert alert-success alert-outline">'+ message +'</div>';
          $('#contact-form input, #contact-form textarea, #contact-form button').attr('disabled', 'disabled');
          $('#contact-form .alert').fadeOut(300);
          $(succesTemplate).insertBefore($('#contact-form button'));
        })
        .fail(function() {
          var message = $('#contact-form').data('error-text') || 'There was an error. Try again later.';
          var errorTemplate = '<div role="alert" class="alert alert-danger alert-outline">'+ message +'</div>';
          $('#contact-form .alert').fadeOut(300);
          $(errorTemplate).insertBefore($('#contact-form button'));
        })        
      }

    });

    $('#contact-form input, #contact-form textarea').on('keyup', function(event) {
      event.preventDefault();
      if ($(this).val()) {
        $(this).parent('.form-group').removeClass('has-error');
      }
    });
  }

  function initCounters () {
    
    $('.counter').appear(function() {
      var counter = $(this).find('.number-count');
      var toCount = counter.data('count');
      
      $(counter).countTo({
        from: 0,
        to: toCount,
        speed: 1000,
        refreshInterval: 50
      })

    });
  }

  function fixScroll() {
    $('#sscr').css('height', 0);
    $('#sscr').css('height', document.documentElement.scrollHeight + 'px');
  }

  function initForms () {

    $('form[data-mailchimp]').each(function(index, el) {
      $(el).ajaxChimp({
        url: 'http://hody.us12.list-manage.com/subscribe/post?u=d9d1052c1b2ba81576842a9fb&id=c70c5d0c82',
        callback: function (res) {
          var template = '<div class="modal fade" id="modal" tabindex="-1" role="dialog">';
          template += '<div class="centrize">';
          template += '<div class="v-center">';
          template += '<div class="modal-dialog">';
          template += '<div class="modal-content">';
          template += '<div class="modal-header">';
          template += '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="ti-close"></i></span></button>';
          if (res.result === 'success') {
            template += '<h4 class="modal-title">Thank you!</h2>';
          } else{
            template += '<h4 class="modal-title">There was an error.</h2>';          }

          template += '</div>';
          template += '<div class="modal-body">';
          template += '<p>' + res.msg + '</p>';
          template += '</div>';
          template += '</div>';
          template += '</div>';
          template += '</div>';
          template += '</div>';
          template += '</div>';

          $(template).modal().on('hidden.bs.modal', function () {
            $(this).remove();      
          });
        }
      });
    });
  }

  function initGeneral () {

    $("a[href='#top']").on('click', function() {
      $("html, body").animate({ scrollTop: 0 }, 1000);
      return false;
    });

    $('a[data-scroll="true"]').on('click', function() {
      if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
        if (target.length) {
          $('html,body').animate({
            scrollTop: target.offset().top
          }, 1000);
          return false;
        }
      }
    });

    if ($('#navigation').data('onepage')) {
      $('body').scrollspy({
        target: '#navigation'
      });
    }

    $('.bg-img, .thumb-placeholder').each(function(index, el) {
      var image = $(el).attr('src');
      $(el).parent().css('background-image', 'url(' + image + ')');
      $(el).remove();
    });

    $('.alert').on('closed.bs.alert', function () {
      fixScroll();
    });

    $('body').on('click', '.alert', function() {
      $(this).on('closed.bs.alert', function() {
        fixScroll();
      });
    });

    var parallaxZIndex = -100;

    if (navigator.userAgent.indexOf("Firefox") != -1 || navigator.userAgent.indexOf("MSIE ") != -1 || navigator.userAgent.match(/Trident.*rv\:11\./) != null){
      parallaxZIndex = 11;
      $('section.parallax').css('z-index', 20);
    }

    $('.parallax-bg').parallax({
      speed: 0.5,
      zIndex: parallaxZIndex
    });

    $('#login-tabs a:first').tab('show');

    $('#login-content .tab-pane:first').addClass('fade in');

    $('#login-tabs li a').on('click', function (e) {
      e.preventDefault();
      $(this).tab('show');
    });

    $('a[data-toggle=tab]').on('click', function(event) {
      $(window).trigger('resize');      
    }).on('shown.bs.tab', function(e) {
      var container = $($(this).attr('href'));

      if (container.find('.progress-bar').length) {
        container.find('.progress-bar').each(function(index, el) {
          $(el).css('width', $(this).data('progress') + '%');
          $(el).parents('.skill').find('.skill-perc').css('right', 100 - $(el).data('progress') + '%');
        });
      }

    });

    $('.particles-bg').particleground({
      dotColor: '#EF2D56',
      particleRadius: 5
    });

    $('.boxes [data-bg-color]').each(function(index, el) {
      $(el).css('background-color', $(el).data('bg-color'));  
    });

    $('.progress-bar').appear(function() {
      $(this).css('width', $(this).data('progress') + '%');
      $(this).parents('.skill').find('.skill-perc').css('right', 100 - $(this).data('progress') + '%');
    });

    $('[data-animated=true]').addClass('invisible');

    $('[data-animated=true]').appear(function(){
      var el = $(this);
      if (el.data('delay')) {
        setTimeout(function(){
          el.removeClass('invisible').addClass('fade-in-top');
        }, parseInt(el.data('delay')));
      } else{
        $(this).removeClass('invisible').addClass('fade-in-top');
      }
    }, {accX: 0, accY: 0});

    $('.client-image').hover(function() {
      $(this).removeClass('fade-in-top')
    }, function() {
      //
    });
  }

  function initCustom () {
    // Your custom code here.
  }

  function init () {
    initNavbar();
    initHomeSlider();
    initCarousels();
    initSliders();
    initAccordions();
    initLoad();
    initVideoBg();
    initVideoModal();
    initPhotoGallery();
    initContactForm();
    initCounters();
    initForms();
    initGeneral();
    initCustom();

    if ($('#map').length) {
      google.maps.event.addDomListener(window, 'load', initMap);
      $('#map').css('position', 'absolute');
    }

    if ($('.countdown').length) {
      initCountdowns();
    }
  }

  init();

})(jQuery)
