jQuery(document).ready((function(e){var a=e(this);e(".megamenu-container").css("position","fixed");var s=e(".without-featured-image .megamenu-container").height();e("#site-content").css("margin-top",s),e(".hamburger").click((function(a){e(".hamburger").toggleClass("active"),e(".megamenu").toggleClass("show-on-mobile"),a.preventDefault(),e(".megamenu > ul").fadeToggle(150),a.preventDefault(),e(".open").slideToggle(150).removeClass("open")})),e(".megamenu > ul > li").click((function(){e(window).width()<=800&&e(this).children("ul").slideToggle(250).addClass("open"),e(window).width()<=800&&e(".open").not(e(this).children("ul")).slideUp(250).removeClass("open")})),e(".fa-search").click((function(){e(".containersearch, .inputnui").toggleClass("active"),e("input[type='text']").focus()}));var n=e("#page-header");e(window).scroll((function(){var a=e(window).scrollTop();n.addClass("scroll-header"),a>=250?n.removeClass("start-header").addClass("scroll-header"):n.removeClass("scroll-header").addClass("start-header")}))}));