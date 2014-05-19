//JSHint Validated Custom JS Code by Designova


jQuery(document).ready(function($) {
    
    (function(){
      "use strict";


    $(function ($) {

        
         //Detecting viewpot dimension and calculating the adjustments of components   
         var viewportHeight = $(window).height();
         //alert(viewportHeight);
         $('#header, .realm-heading, .home-page-view-port').css('height',viewportHeight);


         //TWITTER INIT (Updated with compatibility on Twitter's new API):
         //PLEASE READ DOCUMENTATION FOR INFO ABOUT SETTING UP YOUR OWN TWITTER CREDENTIALS:
          


      //Parallax Init
        $(window).stellar({
            responsive: false,
            horizontalScrolling: false,
            parallaxBackgrounds: true,
            parallaxElements: true,
            hideDistantElements: true
        });


        //Scrolling Trigger
        $(".scroll-link").click(function() {
            var ScrollOffset = $(this).attr('data-soffset');
            //alert(ScrollOffset);
            $("html, body").animate({
                scrollTop: $($(this).attr("href")).offset().top-ScrollOffset+1 + "px"
            }, {
                duration: 2000,
                easing: "easeOutExpo"
            });
            return false;
        });
        
        if($('ul#desktop-nav').hasClass('inner-page').toString() == 'true')
        {
          
          var site_url = $('#site-logo').data('site-url');
          $('ul#desktop-nav li a').each (function(){
            if($(this).hasClass('is_onepage').toString() == 'true')
            {
              var old_url = $(this).attr('href');
              $(this).attr('href',site_url + '/' + old_url); 
            }
          });
        }

        if($('#mob-nav').hasClass('inner-page').toString() == 'true')
        {
          
          var site_url = $('#site-logo').data('site-url');
          $('#mob-nav li a').each (function(){
            if($(this).hasClass('is_onepage').toString() == 'true')
            {
              var old_url = $(this).attr('href');
              $(this).attr('href',site_url + '/' + old_url); 
            }
          });
        }

        var page_stack = $.makeArray();
        var stack_top = 0;

        $('.page-section').waypoint(function (event, direction) {
          //alert(1);
            if (direction === 'down') 
            {
                
                $('#desktop-nav li a').removeClass('active');
                $('#desktop-nav li a[href=#'+$(this).attr('id')+']').addClass('active'); 
                stack_top = stack_top+1; 
                page_stack[stack_top] = $(this).attr('id');
                
            } 
            else 
            {
                stack_top = stack_top-1;
                $('#desktop-nav li a').removeClass('active');
                $('#desktop-nav li a[href=#'+page_stack[stack_top]+']').addClass('active');
                
            }
        },{ offset: 100 });
        
        //News Section - Click n Scroll
        

    $('a.news-scroll-link').live('click',function() {
    				$('html, body').animate({
    					scrollTop: $($(this).attr('href')).offset().top-76 + 'px'
    				},{
    					duration: 1000
    					
    				});
    				return false;
    			});
        

        //News Plugin
        var title = $(".news-img-section .imgs:first-child a").data('title');
    		var blog_posted_date = $(".news-img-section .imgs:first-child a").data('news-date');
        var blog_post_category = $(".news-img-section .imgs:first-child .dummy-post-categories").html();
    		var txt = $(".news-img-section .imgs:first-child a").find('.blog-post-dummy-content').html();
    		var img = $(".news-img-section .imgs:first-child a img").attr('src');
    		var href = $(".news-img-section .imgs:first-child a").data('permalink');
    		

    		$(".news-main-space h1").html(title);
    		$(".news-main-space h3 .posted-date").html(blog_posted_date);
        $(".news-main-space h3 .post-categories").html(blog_post_category);
    		$(".news-main-space p").html(txt);
    		$(".news-main-space img").attr('src', img);
    		$(".news-main-space .news-main-learn-more a").attr('href',href);
    		

    		$(".news-img-section .imgs a").click (function () {
    			var title = $(this).data('title');
    			var blog_posted_date = $(this).data('news-date');
          var blog_post_category = $(this).next('.dummy-post-categories').html();
    			var txt = $(this).find('.blog-post-dummy-content').html();
    			var img = $(this).children('img').attr('src');
    			var href = $(this).data('permalink');

    			$(".news-main-space h1").html(title);
    			$(".news-main-space h3 .posted-date").html(blog_posted_date);
          $(".news-main-space h3 .post-categories").html(blog_post_category);
    			$(".news-main-space p").html(txt);
    			$(".news-main-space img").attr('src', img);
    			$(".news-main-space .news-main-learn-more a").attr('href',href);
    			
    		});

    //Bootstrap Carousel
    $('.carousel').carousel({
        interval: 6000,
        pause: "none"
        });

    $('.carousel-inner div:first-child').addClass('active');


    //Lightbox for portfolio
    $(".portfolio a[data-gal^='prettyPhoto']").prettyPhoto({
    				theme:'light_square', 
    				autoplay_slideshow: false, 
    				overlay_gallery: false, 
    				show_title: true
    			});

    $(".featured-image a[data-gal^='prettyPhoto']").prettyPhoto({
            theme:'light_square', 
            autoplay_slideshow: false, 
            overlay_gallery: false, 
            show_title: true
          });

    var deviceAgent = navigator.userAgent.toLowerCase();
    var isTouchDevice = Modernizr.touch || 
    (deviceAgent.match(/(iphone|ipod|ipad)/) || 
      deviceAgent.match(/(android)/) || 
      deviceAgent.match(/(iemobile)/) || 
      deviceAgent.match(/iphone/i) ||
      deviceAgent.match(/ipad/i) || 
      deviceAgent.match(/ipod/i) || 
      deviceAgent.match(/blackberry/i) || 
      deviceAgent.match(/bada/i));

    if (isTouchDevice) { 
      $('.portfolio .element').click(function(){
        $('.portfolio-visibility').css('visibility', 'hidden');
        $('.element-image img').removeClass('element-onhover');
        $(this).find('.element-image img').addClass('element-onhover');
        $(this).children('.portfolio-visibility').css('visibility', 'visible');
      });  

      //Portfolio Filter On Click
      $('.inner-link').find('a').click(function(){
        $('.inner-link').find('a').removeClass('.selected');
        $(this).addClass('.selected');
        $('.portfolio-visibility').css('visibility', 'hidden');
        $('.element-image img').removeClass('element-onhover');
      });

     /* $('.portfolio-visibility').css('visibility', 'visible');
      $('.element .element-image img').css('opacity','0.3');*/
    } 
    else { 

      $('.portfolio .element').mouseenter(function(){
        $('.portfolio-visibility').css('visibility', 'hidden');
        $('.element-image img').removeClass('element-onhover');
        $(this).find('.element-image img').addClass('element-onhover');
        $(this).children('.portfolio-visibility').css('visibility', 'visible');
      });

      $('.portfolio .element').mouseleave(function(){
        $('.element-image img').removeClass('element-onhover');
        $(this).children('.portfolio-visibility').css('visibility', 'hidden');
      });

      //Portfolio Filter On Click
    $('.inner-link').find('a').click(function(){
            $('.inner-link').find('a').removeClass('.selected');
            $(this).addClass('.selected');
          });

    }


    	
    });


    })();

    var navigation = responsiveNav("#nav", { // Selector: The ID of the wrapper
      animate: true, // Boolean: Use CSS3 transitions, true or false
      transition: 400, // Integer: Speed of the transition, in milliseconds
      label: "Menu", // String: Label for the navigation toggle
      insert: "after", // String: Insert the toggle before or after the navigation
      customToggle: "", // Selector: Specify the ID of a custom toggle
      openPos: "relative", // String: Position of the opened nav, relative or static
      jsClass: "js", // String: 'JS enabled' class which is added to <html> el
      init: function(){}, // Function: Init callback
      open: function(){}, // Function: Open callback
      close: function(){} // Function: Close callback
    });

    $(window).load(function() {
      $('.flexslider').flexslider({
        animation: "slide",
        controlNav: false
      });
    });

    $('.realm-contact-button').click(function(){
      $('#realm-contact-button-dummy').trigger('click');
      return false;
    });

    $('#contactForm').submit(function(){
        
        $.ajax({
          type: $("#contactForm").attr('method'),
          url: $("#contactForm").attr('action'),
          data: $("#contactForm").serialize(),
          success: function(data) {
            if(data == 'success')
            {
                $('#contactForm').each (function(){
                    this.reset();
                });
                $('.launch_modal').trigger("click");
              
            }
            else
            {
              $("#infomsg").fadeIn();
            }
          }
        });
        return false;
    });



    //Masonry Filterable Portfolio
    $(function(){
      
      var $container = $('#container');

      $container.isotope({
        itemSelector : '.element',
        layoutMode : 'masonry' 
      });
      
      
      var $optionSets = $('#options .option-set'),
          $optionLinks = $optionSets.find('a');

      $optionLinks.click(function(){
        var $this = $(this);
        // don't proceed if already selected
        if ( $this.hasClass('selected') ) {
          return false;
        }
        var $optionSet = $this.parents('.option-set');
        $optionSet.find('.selected').removeClass('selected');
        $this.addClass('selected');
  
        // make option object dynamically, i.e. { filter: '.my-filter-class' }
        var options = {},
            key = $optionSet.attr('data-option-key'),
            value = $this.attr('data-option-value');
        // parse 'false' as false boolean
        value = value === 'false' ? false : value;
        options[ key ] = value;
        if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
          // changes in layout modes need extra logic
          changeLayoutMode( $this, options )
        } else {
          // creativewise, apply new options
          $container.isotope( options );
        }
        
        return false;
      });
     
    });

    $('p').each(function(){
        var valid_content = $(this).html();
        if(valid_content == '')
        $(this).css('display','none');
    });

    $('.sidebar li').each(function(){
        var valid_content = $(this).html();
        if(valid_content == '')
        $(this).css('display','none');
    });

    $('#searchform #searchsubmit').addClass('realm-button');
    $('#post-comment').addClass('realm-button');
    $('.comment-reply-link').addClass('realm-button light-txt');
    $('input[type="submit"]').addClass('realm-button light-txt');
    
    $('.blog_pagination a').addClass('realm-button');

});








	

