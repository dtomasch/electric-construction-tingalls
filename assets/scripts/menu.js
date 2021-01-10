// JS megamenu
jQuery( document ).ready( function( $ ) {

var win = $(this); //this = window
  //--------------------------------------------------------------
  // We want the menu to use flex, but we have to keep it hidden on load
  //--------------------------------------------------------------
  //
  // $(window).width() > 800 && ($(".megamenu > ul > li > ul").css('display', 'flex').hide()),




  //--------------------------------------------------------------
  // Solves odd behavior if window is resized, bc of flex
  //--------------------------------------------------------------

  $(".megamenu-container").css("position", 'fixed');
  var topOffset = $('.without-featured-image .megamenu-container').height();
  $("#site-content").css("margin-top", topOffset);





  //--------------------------------------------------------------
  // Add a dropdown icon if we want it
  //--------------------------------------------------------------

  // $(".megamenu > ul > li:has( > ul)").addClass("megamenu-dropdown-icon"),




  //--------------------------------------------------------------
  // Allows "normal" menus
  //--------------------------------------------------------------

  // $(".megamenu > ul > li > ul:not(:has(ul))").addClass("normal-sub"),


  //--------------------------------------------------------------
  // Solves odd behavior if window is resized, bc of flex
  //--------------------------------------------------------------

  // $(window).on('resize', function() {
  //   if (win.width() > 800) {
  //     $(".megamenu > ul").css('display', 'flex')
  //   } else {
  //     $(".megamenu > ul").css('display', 'none')
  //   };
  // });




  //--------------------------------------------------------------
  // Adds the mobile menu.
  //--------------------------------------------------------------
  // if (win.width() < 800) {
  // $(".megamenu > ul").before('<a href="#" class="megamenu-mobile"> <div class="hamburger"><div></div></div></a>');
  // };

    //--------------------------------------------------------------
    // Show the mobile menu
    //--------------------------------------------------------------

    $(".hamburger").click(function(e) {
      $('.hamburger').toggleClass("active");
      $(".megamenu").toggleClass("show-on-mobile"), e.preventDefault();
      $(".megamenu > ul").fadeToggle(150), e.preventDefault();
      $(".open").slideToggle(150).removeClass('open');

    });

  //--------------------------------------------------------------
  // This adds the mobile sections that slide down the sub menu
  //--------------------------------------------------------------


  $(".megamenu > ul > li").click(function() {
    $(window).width() <= 800 && $(this).children("ul").slideToggle(250).addClass("open");
    $(window).width() <= 800 && $(".open").not($(this).children("ul")).slideUp(250).removeClass('open');
  });



  //--------------------------------------------------------------
  // Search Icon Stuff
  //--------------------------------------------------------------

  $(".fa-search").click(function() {
    $(".containersearch, .inputnui").toggleClass("active"),
      $("input[type='text']").focus();
  });


  //--------------------------------------------------------------
  // On scroll
  //--------------------------------------------------------------


  //caches a jQuery object containing the header element
  // https://stackoverflow.com/questions/12558311/add-remove-class-with-jquery-based-on-vertical-scroll

  var header = $("#page-header");

    $(window).scroll(function() {
      var scroll = $(window).scrollTop();
      header.addClass("scroll-header");
      if (scroll >= 250) {
        header.removeClass('start-header').addClass("scroll-header");
      } else {
        header.removeClass("scroll-header").addClass('start-header');
      }
    });

});
