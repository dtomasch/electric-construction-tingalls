// Add "external" to external links
jQuery( document ).ready( function( $ ) {
  $('a').not('.button').filter(function() {
   return this.hostname && this.hostname !== location.hostname;
}).attr('target','_blank');
});


// Slick Slider
jQuery( document ).ready( function( $ ) {
  $('.slider').slick({
    dots: true,
    autoplay: true,
    centerPadding: 50,
    adaptiveHeight: true,
    autoplaySpeed: 7500,
    pauseOnHover:true,
    responsive: [
      {
        breakpoint: 800,
        settings: {
          arrows: false,
        }
      }
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ]

  });
});

// This seems to be the code that works best on This
// https://theme.co/forum/t/scroll-to-anchor-with-offset-when-coming-from-another-page/26622/7
jQuery( document ).ready( function( $ ) {
var hash= window.location.hash
if ( hash == '' || hash == '#' || hash == undefined ) return false;
      var target = $(hash);
      target = target.length ? target : $('[name=' + hash.slice(1) +']');
      if (target.length) {
        $('html,body').stop().animate({
          scrollTop: target.offset().top - 50 //offsets for fixed header
        }, 'linear');
      }
} );



jQuery( document ).ready( function( $ ) {
  if( acf.fields.color_picker ) {
    // custom colors
    var palette = ['#111111', '#333333', '#555555', '#777777', '#999999', '#cccccc'];

    // when initially loaded find existing colorpickers and set the palette
    acf.add_action('load', function() {
      $('input.wp-color-picker').each(function() {
        $(this).iris('option', 'palettes', palette);
      });
    });

    // if appended element only modify the new element's palette
    acf.add_action('append', function(el) {
      $(el).find('input.wp-color-picker').iris('option', 'palettes', palette);
    });
  }
});
