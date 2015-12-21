(function( $ ) {

    /*
    * Add Smooth Scrolling Transition */
    var smoothTarget = function(){

        $('a.target[href^="#"]').click(function(event) {

            var id      = $(this).attr("href"),
                target  = $(id).offset().top;

            $('html, body').animate({ scrollTop:target }, 500);

            event.preventDefault();
        });

    }

    smoothTarget();

    /* Affix.js
    * Activates your content as affixed content */
    var affixInit = function(){
        $('.affix-top').affix({
          offset: {
            top: 0,
            bottom: function () {
              return (this.bottom = $('.footer').outerHeight(true))
            }
          }
        });
    }

    affixInit();


    /* Tooltip.js
    * Hover over the links below to see tooltips */
    var toolTip = function(){
        $('[data-toggle="tooltip"]').tooltip();
    }

    toolTip();


    /* Popover.js
    * Add small overlays of content */
    var popOver = function(){
        $('[data-toggle="popover"]').popover()
    }
    
    popOver();

    /* Scrollspy.js
    * Automatically updating nav targets based on scroll position */

    var scrollSpy = function(){
        $('body').scrollspy({ target: '.sidebar' });
    }

    scrollSpy();

    
    /* Header
    * Target menu content for mobile view  */

    var slideMenu = function(){
        var toggle    =   $('.menu-toggle'),
            dismiss   =   $('.menu-dismiss'),
            body      =   $(document.body);

        toggle.on('click', function(){
           body.toggleClass('menu-opened');
            return false;
        });

        dismiss.on('click', function(){
           body.removeClass('menu-opened');
        });

        body.on('click', function(){
           body.removeClass('menu-opened');
        });
    }

    slideMenu();

    /* Header onScroll
    * Add Class to header on scroll  */

    var headerTheme = function(){
        var $header  = $('.header'),
            theme    = $header.data('theme');

         $(window).on('scroll', function(){
            if ( $(this).scrollTop() > 10 ) {
                if( theme == 'dark' ){
                    $header.addClass('bg-darker');
                }if( theme == 'light' ){
                    $header.addClass('bg-lighter');
                }
            } else {
                if( theme == 'dark' ){
                    $header.removeClass('bg-darker');
                }if( theme == 'light' ){
                    $header.removeClass('bg-lighter');
                }
            };
         });    
    }

    headerTheme();

})( jQuery );

// vertically center modal
(function ($) {
    "use strict";
    function centerModal() {
        $(this).css('display', 'block');
        var $dialog  = $(this).find(".modal-dialog"),
        offset       = ($(window).height() - $dialog.height()) / 2,
        bottomMargin = parseInt($dialog.css('marginBottom'), 10);

        // Make sure you don't hide the top part of the modal w/ a negative margin if it's longer than the screen height, and keep the margin equal to the bottom margin of the modal
        if(offset < bottomMargin) offset = bottomMargin;
        $dialog.css("margin-top", offset);
    }

    $(document).on('show.bs.modal', '.modal', centerModal);
    $(window).on("resize", function () {
        $('.modal:visible').each(centerModal);
    });
}(jQuery));
