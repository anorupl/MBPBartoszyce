/*!
 *  MBP Bartoszyce 0.1.0
 *  Main javascript for Theme.
 */
(function ($) {
  /*
   * Function Test if inline SVGs are supported.
   * @link https://github.com/Modernizr/Modernizr/
   */
  function supportsInlineSVG() {
    var div = document.createElement('div');
    div.innerHTML = '<svg/>';
    return 'http://www.w3.org/2000/svg' === ('undefined' !== typeof SVGRect && div.firstChild && div.firstChild.namespaceURI);
  }

/**
 * Function rwd nav.
 */
$.fn.nav = function (nav) {
  return this.each(function () {

    var $this = $(this);

    $(window).on('resize orientationchange', function () {

      var window_width = $(window).width();

      if (window_width > 992) {

        $classes = $this.data("class");

        // Usuwanie classy z menu
        if ($this.hasClass("small-menu")) {
          $('#site-header').removeClass("menu-active");
          $this.removeClass();
          $this.addClass($classes);
        }
      }
    }).resize();
  });
};

$.fn.slick_small_sllider = function(setting) {

  return this.each(function () {
      var $this = $(this);

        if ($(window).width() < 992) {
             $this.slick(setting);
        };

      $(window).on('resize orientationchange', function () {
           if ($(window).width() < 992) {

              if (!$this.hasClass('slick-initialized')) {
                 $this.slick(setting);
              }
              return;
           };
           if ($this.hasClass('slick-initialized')) {
              return $this.slick('unslick');
          };
      });
  });
};



  /*********************************************************
   * Document ready (jQuery)
   * Fire on document ready.
   *********************************************************/
  $(document).ready(function () {
    //Test inline SVGs are supported.
    if (true === supportsInlineSVG()) {
      document.documentElement.className = document.documentElement.className.replace(/(\s*)no-svg(\s*)/, '$1svg$2');
    }

    /**
    *  function menu
    */
    //if resize window
    $('#header-menu').nav();

    // if click button menu
    $('button.icon-button-small-menu').on('click', function(e){

        var item = $(this).next();

        item.toggleClass( item.data("class") + " small-menu" );
        $( '#site-header' ).toggleClass( "menu-active" );
        e.preventDefault();
    });

    // If Menu focus
    $( function() {
        $( '.h-nav' ).find( 'a' ).on( 'focus blur', function() {
            $( this ).parents().toggleClass( 'focus' );
        });
    });

    // Search toggle.
		$( '#top-bar__btn-search' ).on( 'click', function( event ) {
			var that    = $( this ),
				  wrapper = $( '#top-bar__search' ),
				  container = that.find( 'a' );

			that.toggleClass( 'active' );
			wrapper.toggleClass( 'hide' );

			if ( that.hasClass( 'active' ) ) {
				container.attr( 'aria-expanded', 'true' );
			} else {
				container.attr( 'aria-expanded', 'false' );
			}

			if ( that.is( '.active' )) {
				wrapper.find( '.search-field' ).focus();
			}
		} );















    $('#header-content').slick_small_sllider(settings = {});
    $('#partner-slider').slick({
         dots: false,
         arrows: false,
         centerMode: true,
         slidesToShow: 5,
         autoplay: true,
         pauseOnHover: false,
         responsive: [
             {
                 breakpoint: 480,
                 settings: {
                     centerPadding: '40px',
                     slidesToShow: 1
                 }
             }
         ]
     });

  });
})(jQuery);
