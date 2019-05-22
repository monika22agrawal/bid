/*=================================
  Home Banner Slider
=================================*/
$(document).ready(function() {    
  $("#HomeSlider").owlCarousel({     
      navigation : true, // Show next and prev buttons
      smartSpeed:450,
      slideSpeed: 300,
      paginationSpeed : 400,
      items:1,
      autoPlay: true,
      animateIn: 'fadeIn',
      animateOut: 'fadeOut',
      transitionStyle : "fade",
      singleItem:true    
  });    
});
/*=================================
  Menu Fixed class Add
=================================*/
$(window).scroll(function() {    
    var scroll = $(window).scrollTop();
    if (scroll >= 50) {
        $(".MainHeader").addClass("fixed");
    } else {
        $(".MainHeader").removeClass("fixed");
    }
});

/*=================================
  Menu Click Smooth Scroll
=================================*/
function scrollNav() {
    $('.ScrollMenu a').click(function(){  
      //Animate
      $('html, body').stop().animate({
          scrollTop: $( $(this).attr('href') ).offset().top - 100
      }, 400);
      return false;
    });
  }
  scrollNav();
/*=================================
  Parallax Background
=================================*/
(function( $ ) {
  "use strict";
    $('.parallax').each(function(){
        var $el = $(this),
            speed = 0.4,
            elOffset = $el.offset().top;

        $(window).scroll(function() {
          var diff = $(window).scrollTop() - elOffset;
          var yPos = -(diff*speed);

          var coords = '50% '+ yPos + 'px';
          $el.css({ backgroundPosition: coords });
        });
    });
}(jQuery));

$('.pr-carousel').owlCarousel({   
    margin:20,
    nav:true,
    dots:false,
    navText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        991:{
            items:3
        },
        1200:{
            items:4
        }
    }
})
$('.Team-slider').owlCarousel({   
    margin:20,
    nav:true,
    dots:false,
    navText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        991:{
            items:3
        },
        1200:{
            items:3
        }
    }
})
// $('.client-slider').owlCarousel({   
//     nav:true,
//     navText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
//     items:1,
//     autoPlay: true,
//     singleItem:true
// })
function clientSlider () {
    $('.client-slider').owlCarousel({
        animateOut: 'fadeOutLeft',
        animateIn: 'fadeOutRight',
        loop:true,
        nav:false,
        navText:false,
        dots:true,
        autoplay:true,
        autoplayTimeout:4000,
        autoplaySpeed:1500,
        lazyLoad:true,
        items:1,
    })
}
clientSlider ();



$(document).ready(function () {
  $('.selectcs').selectpicker({
    liveSearch: false
  });
});


function priceRange () {
  if ($('.price-ranger').length) {
      $( '.price-ranger #slider-range' ).slider({
        range: true,
        min: 15000,
        max: 25000,
        values: [ 0, 25000 ],
        slide: function( event, ui ) {
          $( '.price-ranger .min' ).val( '$' + ui.values[ 0 ] );
          $( '.price-ranger .max' ).val( '$' + ui.values[ 1 ] );
        }
      });
        $( '.price-ranger .min' ).val( '$' + $( '.price-ranger #slider-range' ).slider( 'values', 0 ) );
      $( '.price-ranger .max' ).val( '$' + $( '.price-ranger #slider-range' ).slider( 'values', 1 ) );        
    };
}
priceRange ();

function areaRange () {
  if ($('.price-ranger').length) {
      $( '.price-ranger #area-range' ).slider({
        range: true,
        min: 1000,
        max: 25000,
        values: [ 0, 25000 ],
        slide: function( event, ui ) {
          $( '.price-ranger .Amin' ).val( ui.values[ 0 ] );
          $( '.price-ranger .Amax' ).val( ui.values[ 1 ] );
        }
      });
        $( '.price-ranger .Amin' ).val( $( '.price-ranger #area-range' ).slider( 'values', 0 ) );
      $( '.price-ranger .Amax' ).val( $( '.price-ranger #area-range' ).slider( 'values', 1 ) );        
    };
}
areaRange ();

$(document).ready(function() {

  var sync1 = $(".single-gallery-carousel-content-box");
  var sync2 = $(".single-gallery-carousel-thumbnail-box");
  var slidesPerPage = 4; //globaly define number of elements per page
  var syncedSecondary = true;

  sync1.owlCarousel({
    items : 1,
    slideSpeed : 2000,
    nav: true,   
    navText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
    autoplay: true,
    dots: true,
    loop: true,
    responsiveRefreshRate : 200,
  }).on('changed.owl.carousel', syncPosition);

  sync2
    .on('initialized.owl.carousel', function () {
      sync2.find(".owl-item").eq(0).addClass("current");
    })
    .owlCarousel({
    margin: 8,
    dots: false,
    nav: false,
    smartSpeed: 200,
    slideSpeed : 500,
    slideBy: slidesPerPage, //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel
    responsiveRefreshRate : 100,
    responsive:{
        0:{
            items:2
        },
        600:{
            items:3
        },
        991:{
            items:4
        },
        1200:{
            items:6
        }
    }
  }).on('changed.owl.carousel', syncPosition2);

  function syncPosition(el) {
    //if you set loop to false, you have to restore this next line
    //var current = el.item.index;
    
    //if you disable loop you have to comment this block
    var count = el.item.count-1;
    var current = Math.round(el.item.index - (el.item.count/2) - .5);
    
    if(current < 0) {
      current = count;
    }
    if(current > count) {
      current = 0;
    }
    
    //end block

    sync2
      .find(".owl-item")
      .removeClass("current")
      .eq(current)
      .addClass("current");
    var onscreen = sync2.find('.owl-item.active').length - 1;
    var start = sync2.find('.owl-item.active').first().index();
    var end = sync2.find('.owl-item.active').last().index();
    
    if (current > end) {
      sync2.data('owl.carousel').to(current, 100, true);
    }
    if (current < start) {
      sync2.data('owl.carousel').to(current - onscreen, 100, true);
    }
  }
  
  function syncPosition2(el) {
    if(syncedSecondary) {
      var number = el.item.index;
      sync1.data('owl.carousel').to(number, 100, true);
    }
  }
  
  sync2.on("click", ".owl-item", function(e){
    e.preventDefault();
    var number = $(this).index();
    sync1.data('owl.carousel').to(number, 300, true);
  });
});

// Single gallery slider
// function singleGalleryCarousel () {
//   if ($('.single-gallery-carousel-content-box').length && $('.single-gallery-carousel-thumbnail-box').length) {

//     var $sync1 = $(".single-gallery-carousel-content-box"),
//       $sync2 = $(".single-gallery-carousel-thumbnail-box"),
//       flag = false,
//       duration = 500;

//       $sync1
//         .owlCarousel({
//           items: 1,
//           margin: 0,
//           nav: false,
//           dots: false,
//           loop: true,
//           autoplay:true,
//         autoplaySpeed:1500,
//           singleItem:true
//         })
//         .on('changed.owl.carousel', function (e) {
//           if (!flag) {
//             flag = true;
//             $sync2.trigger('to.owl.carousel', [e.item.index, duration, true]);
//             flag = false;
//           }
//         });

//       $sync2
//         .owlCarousel({
//           margin: 8,
//           items: 7,
//           nav: true,
//           navText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],        
//           dots: false,
//           center: false,
//           responsive: {
//             0:{
//                     items:2,
//                     autoWidth: false
//                 },
//                 400:{
//                     items:3,
//                     autoWidth: false
//                 },
//                 768:{
//                     items:4,
//                     autoWidth: false
//                 }
//             },
//         })
//         .on('click', '.owl-item', function () {
//           $sync1.trigger('to.owl.carousel', [$(this).index(), duration, true]);

//         })
//         .on('changed.owl.carousel', function (e) {
//           if (!flag) {
//             flag = true;    
//             $sync1.trigger('to.owl.carousel', [e.item.index, duration, true]);
//             flag = false;
//           }
//         });
//   };
// }
// singleGalleryCarousel ();


$(document).ready(function () {
  var navListItems = $('div.setup-panel div a'),
          allWells = $('.setup-content'),
          allNextBtn = $('.nextBtn');

  allWells.hide();

  navListItems.click(function (e) {
      e.preventDefault();
      var $target = $($(this).attr('href')),
              $item = $(this);

      if (!$item.hasClass('disabled')) {
          navListItems.removeClass('btn-act').addClass('btn-default');
          $item.addClass('btn-act');
          allWells.hide();
          $target.show();
          $target.find('input:eq(0)').focus();
      }
  });

  allNextBtn.click(function(){
      var curStep = $(this).closest(".setup-content"),
          curStepBtn = curStep.attr("id"),
          nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
          curInputs = curStep.find("input[type='text'],input[type='url']"),
          isValid = true;

      $(".form-group").removeClass("has-error");
      for(var i=0; i<curInputs.length; i++){
          if (!curInputs[i].validity.valid){
              isValid = false;
              $(curInputs[i]).closest(".form-group").addClass("has-error");
          }
      }

      if (isValid)
          nextStepWizard.removeAttr('disabled').trigger('click');
  });

  $('div.setup-panel div a.btn-act').trigger('click');
});


/*==============
modal animation
==============*/
// function testAnim(x) {
//     $('.modal .modal-dialog').attr('class', 'modal-dialog  ' + x + '  animated');
// };
// $('#bidUser').on('show.bs.modal', function (e) {
//     $('.modal .modal-dialog').attr('class', 'modal-dialog  zoomIn  animated');
// })
// $('#bidUser').on('hide.bs.modal', function (e) {
//     $('.modal .modal-dialog').attr('class', 'modal-dialog  zoomOut animated');
// })


function testAnim(x) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog  ' + x + '  animated');
};
$('#bidUser').on('show.bs.modal', function (e) {
      testAnim("zoomIn");
})
$('#bidUser').on('hide.bs.modal', function (e) {
      testAnim("zoomOut");
})

