<script src="<?= base_url('aset/js/jquery.min.js'); ?>"></script>
<script src="<?= base_url('aset/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?= base_url('aset/js/aos.js'); ?>"></script>
<script src="<?= base_url('aset/plugin/sweetalert/sweetalert.min.js'); ?>"></script>
<script src="<?= base_url('aset/plugin/jssocial/jssocials.min.js'); ?>"></script>
<script src="<?= base_url('aset/plugin/jssocial/jssocials.shares.js'); ?>"></script>
<script src="<?= base_url('aset/js/main.js'); ?>"></script>
<script src="<?= base_url('aset/js/custom.js'); ?>"></script>
<script src="<?= base_url('aset/js/frontend/swiper.min.js'); ?>"></script>
<script src="<?= base_url('aset/js/frontend/velocity.js'); ?>"></script>
<script src="<?= base_url('aset/js/frontend/velocity.ui.js'); ?>"></script>
<script src="<?= base_url('aset/js/frontend/slick.min.js'); ?>"></script>
<script src="<?= base_url('aset/js/frontend/clipboard.min.js'); ?>"></script>  
<script src="<?= base_url('aset/js/frontend/TweenMax.min.js'); ?>"></script>  
<script src="<?= base_url('aset/js/frontend/base.js'); ?>"></script>  
<script src="<?= base_url('aset/js/frontend/www-embed-player.js'); ?>"></script>  
<script type="text/javascript">
// demos.js

var clipboardDemos = new Clipboard('[data-clipboard-demo]');

clipboardDemos.on('success', function(e) {
    e.clearSelection();

    console.info('Action:', e.action);
    console.info('Text:', e.text);
    console.info('Trigger:', e.trigger);

    showTooltip(e.trigger, 'Copied!');
});

clipboardDemos.on('error', function(e) {
    console.error('Action:', e.action);
    console.error('Trigger:', e.trigger);

    showTooltip(e.trigger, fallbackMessage(e.action));
});

// tooltips.js

var btns = document.querySelectorAll('.btn');

for (var i = 0; i < btns.length; i++) {
    btns[i].addEventListener('mouseleave', clearTooltip);
    btns[i].addEventListener('blur', clearTooltip);
}

function clearTooltip(e) {
    e.currentTarget.setAttribute('class', 'btn');
    e.currentTarget.removeAttribute('aria-label');
}

function showTooltip(elem, msg) {
    elem.setAttribute('class', 'btn tooltipped tooltipped-s');
    elem.setAttribute('aria-label', msg);
}
</script>

<!-- testimony -->
<script type="text/javascript">
  var prevButton = '',
      nextButton = '';

    $('.single-item').slick({
      infinite: true,
      dots: true,
      autoplay: true,
      autoplaySpeed: 4000,
      speed: 1000,
      cssEase: 'ease-in-out',
      prevArrow: prevButton,
      nextArrow: nextButton
    });

    $('.quote-container').mousedown(function(){
      $('.single-item').addClass('dragging');
    });
    $('.quote-container').mouseup(function(){
      $('.single-item').removeClass('dragging');
    });
</script>
<!-- end testimony -->

<!-- slider 1 -->
<script type="text/javascript">
  /**
  * Velocity Effects
  */

  var scaleDownAmnt = 0.7;
  var boxShadowAmnt = '40px';


  //scale down
  $.Velocity.RegisterEffect("scaleDown", {
    defaultDuration: 1,
    calls: [
      [{
        opacity: '0',
        scale: '0.7',
   
      }, 1]
    ]
  });

  //gallery
  $.Velocity.RegisterEffect("scaleDown.moveUp", {
    defaultDuration: 1,
    calls: [
      [{
        translateY: '0%',
        scale: scaleDownAmnt,
   
      }, 0.20],
      [{
        translateY: '-100%'
      }, 0.60],
      [{
        translateY: '-100%',
        scale: '1',
        // boxShadowBlur: '0'
      }, 0.20]
    ]
  });
  $.Velocity.RegisterEffect("scaleDown.moveUp.scroll", {
    defaultDuration: 1,
    calls: [
      [{
        translateY: '-100%',
        scale: scaleDownAmnt,
   
      }, 0.60],
      [{
        translateY: '-100%',
        scale: '1',
        // boxShadowBlur: '0'
      }, 0.40]
    ]
  });
  $.Velocity.RegisterEffect("scaleUp.moveUp", {
    defaultDuration: 1,
    calls: [
      [{
        translateY: '90%',
        scale: scaleDownAmnt,
        // boxShadowBlur: boxShadowAmnt     
      }, 0.20],
      [{
        translateY: '0%'
      }, 0.60],
      [{
        translateY: '0%',
        scale: '1',
        // boxShadowBlur: '0'
      }, 0.20]
    ]
  });
  $.Velocity.RegisterEffect("scaleUp.moveUp.scroll", {
    defaultDuration: 1,
    calls: [
      [{
        translateY: '0%',
        scale: scaleDownAmnt,
        // boxShadowBlur: boxShadowAmnt
      }, 0.60],
      [{
        translateY: '0%',
        scale: '1',
        // boxShadowBlur: '0'
      }, 0.40]
    ]
  });
  $.Velocity.RegisterEffect("scaleDown.moveDown", {
    defaultDuration: 1,
    calls: [
      [{
        translateY: '0%',
        scale: scaleDownAmnt,
        // boxShadowBlur: boxShadowAmnt
      }, 0.20],
      [{
        translateY: '100%'
      }, 0.60],
      [{
        translateY: '100%',
        scale: '1',
        // boxShadowBlur: '0'
      }, 0.20]
    ]
  });
  $.Velocity.RegisterEffect("scaleDown.moveDown.scroll", {
    defaultDuration: 1,
    calls: [
      [{

      }, 0.60],
      [{
        translateY: '100%',
        scale: '1',
        // boxShadowBlur: '0'
      }, 0.40]
    ]
  });
  $.Velocity.RegisterEffect("scaleUp.moveDown", {
    defaultDuration: 1,
    calls: [
      [{
        translateY: '-90%',
        scale: scaleDownAmnt,
        // boxShadowBlur: boxShadowAmnt
      }, 0.20],
      [{
        translateY: '0%'
      }, 0.60],
      [{
        translateY: '0%',
        scale: '1',
        // boxShadowBlur: '0'
      }, 0.20]
    ]
  });


  /**
   * Velo Slider
   * A Custom Slider using Velocity and Velocity UI effects
   */

  var VeloSlider = (function() {

    /**
     * Global Settings 
     */
    var settings = {
      veloInit: $('.velo-slides').data('velo-slider'),
      veloSlide: $('.velo-slide'),
      veloSlideBg: '.velo-slide__bg',
      navPrev:  $('.velo-slides-nav').find('a.js-velo-slides-prev'),
      navNext:  $('.velo-slides-nav').find('a.js-velo-slides-next'),
      veloBtn:   $('.velo-slide__btn'),
      delta: 0,
      scrollThreshold: 7,
      currentSlide: 1,
      animating: false,
      animationDuration: 2000
    };


    // Flags
    var delta = 0,
        animating = false;

    return {
     
        /**
         * Init 
         */
        init: function() {
          this.bind();
        },
      
      /**
       * Bind our click, scroll, key events
       */
      bind: function(){
   
        //  Add active to first slide to set it off
        settings.veloSlide.first().addClass('is-active');

        //  Init with a data attribute, 
        //  Binding the animation to scroll, arrows, keys
        if (settings.veloInit == 'on') {
          VeloSlider.initScrollJack();
          // $(window).on('DOMMouseScroll mousewheel', VeloSlider.scrollJacking);
        }

        // Arrow / Click Nav
        settings.navPrev.on('click', VeloSlider.prevSlide);
        settings.navNext.on('click', VeloSlider.nextSlide);
      
        // Key Nav
        $(document).on('keydown', function(e) {
          var keyNext = (e.which == 39 || e.which == 40),
              keyPrev = (e.which == 37 || e.which == 38);

          if (keyNext && !settings.navNext.hasClass('inactive')) {
            e.preventDefault();
            VeloSlider.nextSlide();

          } else if (keyPrev && (!settings.navPrev.hasClass('inactive'))) {
            e.preventDefault();
            VeloSlider.prevSlide();
          }
        });
      
        //set navigation arrows visibility
        VeloSlider.checkNavigation();

        // Call Button Hover animation
        VeloSlider.hoverAnimation();
       
      },

      /**
       * Hover Animation
       * Adds 'is-hovering' class to the current slide
       * when hovering over the button.
       */
      hoverAnimation: function(){
        settings.veloBtn.hover(function (){
          $(this).closest(settings.veloSlide).toggleClass('is-hovering');
        });
      },

      /** 
       * Set Animation
       * Defines the animation sequence, calling our registered velocity effects
       * @see js/components/_velocity-effects.js
       */
      setAnimation: function(midStep, direction) {
        
        // Vars for our velocity effects
        var animationVisible = 'translateNone',
            animationTop = 'translateUp',
            animationBottom = 'translateDown',
            easing = 'ease',
            animDuration = settings.animationDuration;

        // Middle Step
        if (midStep) {
          animationVisible = 'scaleUp.moveUp.scroll';
          animationTop = 'scaleDown.moveUp.scroll';
          animationBottom = 'scaleDown.moveDown.scroll';
        
        } else {
          animationVisible = (direction == 'next') ? 'scaleUp.moveUp' : 'scaleUp.moveDown';
          animationTop = 'scaleDown.moveUp';
          animationBottom = 'scaleDown.moveDown';
        }

        return [animationVisible, animationTop, animationBottom, animDuration, easing];
      },

      /** 
       * Init Scroll Jaclk
       */
      initScrollJack: function() {

        var visibleSlide = settings.veloSlide.filter('.is-active'),
            topSection = visibleSlide.prevAll(settings.veloSlide),
            bottomSection = visibleSlide.nextAll(settings.veloSlide),
            animationParams = VeloSlider.setAnimation(false),
            animationVisible = animationParams[0],
            animationTop = animationParams[1],
            animationBottom = animationParams[2];
            // console.log(animationParams);
            console.log(animationParams[4]);

        visibleSlide.children('div').velocity(animationVisible, 1, function() {
          visibleSlide.css('opacity', 1);
          topSection.css('opacity', 1);
          bottomSection.css('opacity', 1);
        });

        topSection.children('div').velocity(animationTop, 0);
        bottomSection.children('div').velocity(animationBottom, 0);
      },

      /**
       * Scroll Jack
       * On Mouse Scroll
       */
      scrollJacking: function(e) {
        if (e.originalEvent.detail < 0 || e.originalEvent.wheelDelta > 0) {
          delta--;
          (Math.abs(delta) >= settings.scrollThreshold) && VeloSlider.prevSlide();
        } else {
          delta++;
          (delta >= settings.scrollThreshold) && VeloSlider.nextSlide();
        }
        return false;
      },

      /**
       * Previous Slide
       */
      prevSlide: function(e) {
        //go to previous section
        typeof e !== 'undefined' && e.preventDefault();
        
        var visibleSlide = settings.veloSlide.filter('.is-active'),
            animationParams = VeloSlider.setAnimation(midStep, 'prev'),
            midStep = false;
        
        visibleSlide = midStep ? visibleSlide.next(settings.veloSlide) : visibleSlide;

        console.log(midStep);

        if (!animating && !visibleSlide.is(":first-child")) {
          animating = true;
          
          visibleSlide
            .removeClass('is-active')
            .children(settings.veloSlideBg)
            .velocity(animationParams[2], animationParams[3], animationParams[4])
            .end()
            .prev(settings.veloSlide)
            .addClass('is-active')
            .children(settings.veloSlideBg)
            .velocity(animationParams[0], animationParams[3], animationParams[4], function() {
              animating = false;
            });
          currentSlide = settings.currentSlide - 1;
        }
        VeloSlider.resetScroll();
      },


      /** 
       * Next Slide
       */
      nextSlide: function(e) {
        
        //go to next section
        typeof e !== 'undefined' && e.preventDefault();
        
        var visibleSlide = settings.veloSlide.filter('.is-active'),
            animationParams = VeloSlider.setAnimation(midStep, 'next'),
            midStep = false;

        if (!animating && !visibleSlide.is(":last-of-type")) {
          animating = true;

          visibleSlide.removeClass('is-active')
            .children(settings.veloSlideBg)
            .velocity(animationParams[1], animationParams[3])
            .end()
            .next(settings.veloSlide)
            .addClass('is-active')
            .children(settings.veloSlideBg)
            .velocity(animationParams[0], animationParams[3], function() {
              animating = false;
          });
          currentSlide = settings.currentSlide + 1;
        }
        VeloSlider.resetScroll();
      },

      /**
       * Reset SCroll
       */
      resetScroll: function() {
        delta = 0;
        VeloSlider.checkNavigation();
      },

      /**
       * Check Nav
       * Adds / hides nav based on first/last slide
       * @todo - loop slides, without cloning if possible
       */
      checkNavigation: function() {
        //update navigation arrows visibility
        (settings.veloSlide.filter('.is-active').is(':first-of-type')) ? settings.navPrev.addClass('inactive'): settings.navPrev.removeClass('inactive');
        (settings.veloSlide.filter('.is-active').is(':last-of-type')) ? settings.navNext.addClass('inactive'): settings.navNext.removeClass('inactive');

      },
    };
  })();

  // INIT
  VeloSlider.init();

  setInterval(function(){ 
    test();
    // console.log("looping");
  }, 13000);

  var slide_type = "down";
  function test(){
    slide_index_active = $('.velo-slide.is-active').index();
    slide_length = $('.velo-slide').length - 1;
    if(slide_type == "down"){
      if(slide_length == slide_index_active){
        slide_type = "up";
        VeloSlider.prevSlide();
      }else{
        VeloSlider.nextSlide();
      }
    }else{
      if(0 == slide_index_active){
        slide_type = "down";
        VeloSlider.nextSlide();
      }else{
        VeloSlider.prevSlide();
      }
    }
    // console.log(slide_type);
  }
</script>
<!-- end slider 1 -->

<!-- slider 2 -->
<script type="text/javascript">
  /*
Check out the original dribbble shot
https://dribbble.com/shots/2797559-Mr-bara-Split-Screen
*/



const up = $('.nav-up');
const down = $('.nav-down');
let counter = 1;
let number = $('.number');

function moveDown(currentSlide) {
  
  var nextSlide = currentSlide.next();
  var currentSlideUp = currentSlide.find('.txt');
  var currentSlideDown = currentSlide.find('.img');
  var nextSlideUp = nextSlide.find('.img');
  var nextSlideDown = nextSlide.find('.txt');
  let currentCopy = currentSlide.find('.copy'); 
  let nextCopy = nextSlide.find('.copy'); 
  
  if( nextSlide.length !== 0 ) {
    
    counter = counter + 1;
    
    if( counter % 2 === 0 ) {
      
      TweenMax.to(number, 0.3, {x: '-100%'})
      TweenMax.to( currentSlideUp, 0.4, { y: '-100%', delay:0.15 });
      TweenMax.to( currentSlideDown, 0.4, { y: '100%', delay:0.15 });
      setTimeout(function() {number.html('')},300);
      
    } else {
      
      number.html('0'+counter);
      TweenMax.to(number, 0.3, {x: '0%', delay:1})
      TweenMax.to( currentSlideUp, 0.4, { y: '100%', delay:0.15 });
      TweenMax.to( currentSlideDown, 0.4, { y: '-100%', delay:0.15 });
    }
    
    TweenMax.to( currentCopy, 0.3, {autoAlpha: 0, delay:0.15});
    TweenMax.to( nextCopy, 0.3, {autoAlpha: 1, delay:1});
    TweenMax.to( nextSlideUp, 0.4, { y: '0%', delay:0.15 });
    TweenMax.to( nextSlideDown, 0.4, { y: '0%', delay:0.15 });
    
    $(currentSlide).removeClass('active');
    $(nextSlide).addClass('active');
    
  } 
}

function moveUp(currentSlide) {
  
  var prevSlide = currentSlide.prev();
  var currentSlideUp = currentSlide.find('.img');
  var currentSlideDown = currentSlide.find('.txt');
  var prevSlideUp = prevSlide.find('.txt');
  var prevSlideDown = prevSlide.find('.img');
  let currentCopy = currentSlide.find('.copy');
  let prevCopy = prevSlide.find('.copy'); 
  
  if( prevSlide.length !== 0 ) {
    
    counter = counter - 1;
    
    if( counter % 2 === 0 ) {
      
      
      TweenMax.to(number, 0.3, {x: '-100%'});
      TweenMax.to( currentSlideUp, 0.4, { y: '-100%', delay:0.15 });
      TweenMax.to( currentSlideDown, 0.4, { y: '100%', delay:0.15 });
      setTimeout(function() {number.html('')},300);

      
    }else {
      
      number.html('0'+counter);
      TweenMax.to(number, 0.3, {x: '0%', delay:1})
      TweenMax.to( currentSlideUp, 0.4, { y: '100%', delay:0.15 });
      TweenMax.to( currentSlideDown, 0.4, { y: '-100%', delay:0.15 });
    }
    
    TweenMax.to( currentCopy, 0.3, {autoAlpha: 0, delay:0.15});
    TweenMax.to( prevCopy, 0.3, {autoAlpha: 1, delay:1});
    TweenMax.to( prevSlideUp, 0.4, { y: '0%', delay:0.15 });
    TweenMax.to( prevSlideDown, 0.4, { y: '0%', delay:0.15 });
    
    $(currentSlide).removeClass('active');
    $(prevSlide).addClass('active');
    
  }
  
}

function hideNav() {
  
  if( counter == $('.slide').length) {    
    TweenMax.to($('.nav-down'),0.5, {autoAlpha: 0, delay:0.5} );
  }else {
     TweenMax.to($('.nav-down'),0.5, {autoAlpha: 1, delay:0.5} );
  }
  if( counter === 1) {    
    TweenMax.to($('.nav-up'),0.5, {autoAlpha: 0, delay:0.5} );
  }else {
     TweenMax.to($('.nav-up'),0.5, {autoAlpha: 1, delay:0.5} );
  }
  
}


down.on('click', function() {
  
  var currentSlide = $('.active');
  moveDown(currentSlide); 
  hideNav();
  
});

up.on('click', function() {
  
  var currentSlide = $('.active');
  moveUp(currentSlide);
  hideNav();

});

setInterval(function(){ 
  test1();
  // console.log("looping");
}, 13000);

var slide_type = "down";
function test1(){
  slide_index_active = $('.slide active').index();
  slide_length = $('.slide').length - 1;
  if(slide_type == "down"){
    if(slide_length == slide_index_active){
      slide_type = "up";
      VeloSlider.prevSlide();
    }else{
      VeloSlider.nextSlide();
    }
  }else{
    if(0 == slide_index_active){
      slide_type = "down";
      VeloSlider.nextSlide();
    }else{
      VeloSlider.prevSlide();
    }
  }
  // console.log(slide_type);
}

</script>
<!-- end slider 2 -->
<script type="text/javascript">
var swiper = new Swiper('.blog-slider', {
  spaceBetween: 30,
  effect: 'fade',
  loop: true,
  mousewheel: {
    invert: false,
  },
  // autoHeight: true,
  pagination: {
    el: '.blog-slider__pagination',
    clickable: true,
  }
});
</script>