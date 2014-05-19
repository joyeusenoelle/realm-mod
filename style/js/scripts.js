/*-----------------------------------------------------------------------------------*/
/*	CUT EMPTY SPACE
/*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function(){
	$lastwrapper = jQuery(".light-wrapper").last();
	if(($lastwrapper=== 'undefined') && $lastwrapper.find(".inner").html().length<85) $lastwrapper.remove();
	$firstwrapper = jQuery(".light-wrapper").first();
	if($firstwrapper.find(".inner").length && $firstwrapper.find(".inner").html().length<78){
		if($firstwrapper.find(".inner").html().lastIndexOf("section")<0)
			$firstwrapper.remove();
		else{
			//$firstwrapper.after($firstwrapper.find(".inner").html());
			$html = $firstwrapper.find(".inner").html()
			$firstwrapper.remove();
			jQuery(".onepagecontent .inner").first().html($html+jQuery(".onepagecontent .inner").first().html());
		}
	}
});
/*-----------------------------------------------------------------------------------*/
/*	RETINA.JS
/*-----------------------------------------------------------------------------------*/
(function () {
    function t(e) {
        this.path = e;
        var t = this.path.split("."),
            n = t.slice(0, t.length - 1).join("."),
            r = t[t.length - 1];
        this.at_2x_path = n + "@2x." + r
    }
    function n(e) {
        this.el = e, this.path = new t(this.el.getAttribute("src"));
        var n = this;
        this.path.check_2x_variant(function (e) {
            e && n.swap()
        })
    }
    var e = typeof exports == "undefined" ? window : exports;
    e.RetinaImagePath = t, t.confirmed_paths = [], t.prototype.is_external = function () {
        return !!this.path.match(/^https?\:/i) && !this.path.match("//" + document.domain)
    }, t.prototype.check_2x_variant = function (e) {
        var n, r = this;
        if (this.is_external()) return e(!1);
        if (this.at_2x_path in t.confirmed_paths) return e(!0);
        n = new XMLHttpRequest, n.open("HEAD", this.at_2x_path), n.onreadystatechange = function () {
            return n.readyState != 4 ? e(!1) : n.status >= 200 && n.status <= 399 ? (t.confirmed_paths.push(r.at_2x_path), e(!0)) : e(!1)
        }, n.send()
    }, e.RetinaImage = n, n.prototype.swap = function (e) {
        function n() {
            t.el.complete ? (t.el.setAttribute("width", t.el.offsetWidth), t.el.setAttribute("height", t.el.offsetHeight), t.el.setAttribute("src", e)) : setTimeout(n, 5)
        }
        typeof e == "undefined" && (e = this.path.at_2x_path);
        var t = this;
        n()
    }, e.devicePixelRatio > 1 && (window.onload = function () {
        var e = document.getElementsByTagName("img"),
            t = [],
            r, i;
        for (r = 0; r < e.length; r++) i = e[r], t.push(new n(i))
    })
})();
/*-----------------------------------------------------------------------------------*/
/*	ISOTOPE PORTFOLIO
/*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function () {

  //! Portfolio Lightbox
    jQuery('.portfolio-wrapper.portfolio_lightbox .items').each(function(){
    	var $portfolio_container = jQuery(this);
	    $portfolio_container.imagesLoaded(function () {
	        $portfolio_container.isotope({
	            itemSelector: '.item',
	            layoutMode: 'fitRows'
	        });
	    });
	    
	    var $parent_container = $portfolio_container.parent();
	    $parent_container.find('.filter li a').click(function () {
		    $parent_container.find('.filter li a').removeClass('active');
	        jQuery(this).addClass('active');
	        var selector = jQuery(this).attr('data-filter');
	        $portfolio_container.isotope({
	            filter: selector
	        });
	        return false;
	    });
    });


	
    //! Portfolio Classic
    jQuery('.portfolio-wrapper.portfolio_classic .items').each(function(){
    	var $portfolio_container = jQuery(this);
	    $portfolio_container.imagesLoaded(function () {
	        $portfolio_container.isotope({
	            itemSelector: '.item',
	            layoutMode: 'fitRows'
	        });
	    });
	    
	    var $parent_container = $portfolio_container.parent();
	    $parent_container.find('.filter li a').click(function () {
		    $parent_container.find('.filter li a').removeClass('active');
	        jQuery(this).addClass('active');
	        var selector = jQuery(this).attr('data-filter');
	        $portfolio_container.isotope({
	            filter: selector
	        });
	        return false;
	    });
    });


    //! Portfolio Showcase
    jQuery('.portfolio-wrapper.showcase .items').each(function(){
    	var $portfolio_container = jQuery(this);
    	$portfolio_container.imagesLoaded(function () {
	        $portfolio_container.isotope({
	            itemSelector: '.item',
	            layoutMode: 'fitRows'
	        });
	    });
	    
	    var $parent_container = $portfolio_container.parent();
	    $parent_container.find('.filter li a').click(function () {
		    $parent_container.find('.filter li a').removeClass('active');
	        jQuery(this).addClass('active');
	        var selector = jQuery(this).attr('data-filter');
	        $portfolio_container.isotope({
	            filter: selector
	        });
	        return false;
	    });
    });

    
});
/*-----------------------------------------------------------------------------------*/
/*	FANCYBOX
/*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function() {
	jQuery(".fancybox-media").fancybox({
		arrows: true,
		padding: 0,
		closeBtn: true,
		openEffect: 'fade',
		closeEffect: 'fade',
		prevEffect: 'fade',
		nextEffect: 'fade',
		helpers: {
			media: {},
			overlay: {
		        locked: false
		    },
			buttons: false,
			thumbs: {
				width: 50,
				height: 50
			},
			title: {
				type: 'inside'
			}
		},
		beforeLoad: function() {
			var el, id = jQuery(this.element).data('title-id');
			if (id) {
				el = jQuery('#' + id);
				if (el.length) {
					this.title = el.html();
				}
			}
		}
	});
});
/*-----------------------------------------------------------------------------------*/
/*	FORM
/*-----------------------------------------------------------------------------------*/

jQuery(document).ready(function () {
    jQuery('#comment-form input[title], #comment-form textarea').each(function () {
        if (jQuery(this).val() === '') {
            jQuery(this).val(jQuery(this).attr('title'));
        }

        jQuery(this).focus(function () {
            if (jQuery(this).val() == jQuery(this).attr('title')) {
                jQuery(this).val('').addClass('focused');
            }
        });
        jQuery(this).blur(function () {
            if (jQuery(this).val() === '') {
                jQuery(this).val(jQuery(this).attr('title')).removeClass('focused');
            }
        });
    });
});
/*-----------------------------------------------------------------------------------*/
/*	TABS
/*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function () {
    
    jQuery('.tabs').each(function(){
	    jQuery(this).easytabs({
	        animationSpeed: 300,
	        updateHash: false
	    });
	});
});
/*-----------------------------------------------------------------------------------*/
/*	TESTIMONIALS
/*-----------------------------------------------------------------------------------*/
 jQuery(document).ready( function() {
      jQuery('.testimonials').each(function(){
      	
	      	jQuery(this).easytabs({
		      	animationSpeed: 500,
		      	updateHash: false,
		      	cycle: 5000
		     });
	   
      });
    });
/*-----------------------------------------------------------------------------------*/
/*	TOGGLE
/*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function () {
    //Hide the tooglebox when page load
    jQuery(".togglebox").hide();
    //slide up and down when click over heading 2
    jQuery("h4").click(function () {
        // slide toggle effect set to slow you can set it to fast too.
        jQuery(this).toggleClass("active").next(".togglebox").slideToggle("slow");
        return true;
    });
});
/*-----------------------------------------------------------------------------------*/
/*	VIDEO
/*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function () {
	jQuery('body').find('iframe').each(function() {
	    if ((jQuery(this).attr('src').split("youtube").length>1 || jQuery(this).attr('src').split("vimeo").length>1) && !jQuery(this).parent().hasClass("tp-caption")) {
				jQuery(this).wrap('<div class="item video" />');
	    }
	});


    jQuery('.video').fitVids();
});
/*-----------------------------------------------------------------------------------*/
/*	HOVER OPACITY
/*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function ($) {
    jQuery("ul.client-list li").css("opacity", "0.70");
    jQuery("ul.client-list li").hover(function () {
        jQuery(this).stop().animate({
            opacity: 1.0
        }, "fast");
    },

    function () {
        jQuery(this).stop().animate({
            opacity: 0.70
        }, "fast");
    });
});

/*-----------------------------------------------------------------------------------*/
/*	IMAGE HOVER
/*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function() {
	jQuery('.overlay a').prepend('<span class="more"></span>');
});
jQuery(document).ready(function() {
	jQuery('.overlay').mouseenter(function(e) {
		jQuery(this).children('a').children('span').fadeIn(300);
	}).mouseleave(function(e) {
		jQuery(this).children('a').children('span').fadeOut(200);
	});
});
jQuery(document).ready(function() {
        jQuery('.items li').mouseenter(function(e) {

            jQuery(this).children('a').children('div').fadeIn(300);
        }).mouseleave(function(e) {

            if (!jQuery(this).hasClass("active")) jQuery(this).children('a').children('div').fadeOut(200);
        });
    });
/*-----------------------------------------------------------------------------------*/
/*	TOUCH CAROUSEL
/*-----------------------------------------------------------------------------------*/
jQuery(function($) {
			jQuery(".touch-carousel").touchCarousel({
				pagingNav: false,
				snapToItems: false,
				itemsPerMove: 4,
				scrollToLast: false,
				loopItems: false,
				scrollbar: true
		    });
		});
/*-----------------------------------------------------------------------------------*/
/*	PORTFOLIO SHOWCASE
/*-----------------------------------------------------------------------------------*/
/**************************************************************************
 * jQuery Plugin for Showcase
 * @version: 1.0
 * @requires jQuery v1.8 or later
 * @author ThunderBudies http://themeforest.net/user/Thunderbuddies/portfolio
 **************************************************************************/
jQuery(document).ready(function() {
	 var $portfolio_container = jQuery('.portfolio-wrapper.showcase .items');
	 var speed = 600;
	 var header_offset = 0;
	 var scrollspeed = 600;
	 var force_scrolltotop = false;


	 ///////////////////////////
	// GET THE URL PARAMETER //
	///////////////////////////
	function getUrlVars(hashdivider)
			{

				try { var vars = [], hash;
					var hashes = window.location.href.slice(window.location.href.indexOf(hashdivider) + 1).split('_');
					for(var i = 0; i < hashes.length; i++)
					{
						hashes[i] = hashes[i].replace('%3D',"=");
						hash = hashes[i].split('=');
						vars.push(hash[0]);
						vars[hash[0]] = hash[1];
					}
					return vars;
				} catch(e) { }

			}


	////////////////////////
	// GET THE BASIC URL  //
	///////////////////////
    function getAbsolutePath() {
		    var loc = window.location;
		    var pathName = loc.pathname.substring(0, loc.pathname.lastIndexOf('/') + 1);
		    return loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search + loc.hash).length - pathName.length));
    }

    //////////////////////////
	// SET THE URL PARAMETER //
	///////////////////////////
    function updateURLParameter(paramVal){
    		var yScroll=document.body.scrollTop;
	    	var baseurl = window.location.pathname.split("#")[0];
	    	var url = baseurl.split("#")[0];
	    	if (paramVal==undefined) paramVal="";

	    	if (paramVal.length==0)
		    	par="#"
	   		else
 		  		par='#'+paramVal;

		    //window.location.replace(url+par);

		    if(history.pushState) {
			    history.pushState(null, null, par);
			}
			else {
			    location.hash = par;
			}

	}


	 var deeplink = getUrlVars("#");
	 var ie = !jQuery.support.opacity;
	 var ie9 = (document.documentMode == 9);

	 $portfolio_container.each(function(){
	 	var $container = jQuery(this);
	 	$container.find('.item').click(function() {
		 	
		 	// The CLicked Thumb
		 	var thumb = jQuery(this);

		 	jQuery('.portfolio-wrapper.showcase .items').each(function(){
		 		if(jQuery(this) != $container) jQuery(this).height(jQuery(this).data("height"));
		 	});
		 	

		 	// IF THE CLICKED THUMB IS ALREADY SELECTED, WE NEED TO CLOSE THE WINDOWS SIMPLE
		 	if (thumb.hasClass("active")) {
			 	thumb.removeClass("active");
			 	
		 		closeDetailView($container);

			// OTHER WAY WE CLOSE THE WINDOW (IF NECESsARY, OPEN AGAIN, AND DESELET / SELECT THE RIGHT THUMBS
		 	}  else {
		 		//updateURLParameter("entry-"+thumb.index());
			 	thumb.addClass("latest-active");
			 	removeActiveThumbs($container);

			 	thumb.removeClass("latest-active");
			 	thumb.addClass("active");

			 	// CHECK IF WE ALREADY HAVE THE DETAIL WINDOW OPEN
			 	var pdv = jQuery('body').find('.portfolio-detail-view');

			 	if (pdv.length) {
			 		var fade=false;
			 		clearInterval(pdv.data('interval'));
			 		pdv.addClass("portfolio-detail-view-remove").removeClass('portfolio-detail-view');
				 	pdv.animate({'height':'0px','opacity':'0'},{duration:speed, complete:function() { jQuery(this).remove();}});

				 	var delay=speed+50;
				 	//if (thumb.position().top<pdv.position().top) {
			 		// 	delay=0;
				 	//} else {
				 	moveThumbs($container,pdv.data('itemstomove'),0);
			 		setTimeout(function() {$container.isotope( 'reLayout');},speed+50);
			 		// }
				 	setTimeout(function() {
				 			jQuery('body,html').animate({
                                scrollTop: thumb.offset().top-(header_offset+10)
                            }, {
                                duration: scrollspeed,
                                queue: false
                            });
                             if (force_scrolltotop) {

	                             openDetailView($container,thumb,fade);
			                    } else {
				                    setTimeout(function () {
									 	openDetailView($container,thumb,fade);
				                    },scrollspeed)
			                    }
				 	},delay)
			 	} else {
				 	jQuery('body,html').animate({
                                scrollTop: thumb.offset().top-(header_offset+10)
                            }, {
                                duration: scrollspeed,
                                queue: false
                            });
                    if (force_scrolltotop) {
						 	openDetailView($container,thumb);
                    } else {
	                    setTimeout(function () {
						 	openDetailView($container,thumb);
	                    },scrollspeed)
                    }
			 	}
			}
			return false;
	 }) // END OF CLICK ON PORTFOLIO ITEM
	 
	 	// DEEPLINK START IF NECESSARY
		 /*if (deeplink[0].split('entry-').length>1) {
		 	var thmb = parseInt(deeplink[0].split('entry-')[1],0)+1;
			 $container.find('.item:nth-child('+thmb+')').click();
			 $container.find('.item:nth-child('+thmb+')').addClass("active").children('a').children('div').fadeIn(300);;

		}*/
		
		var $parent_container = $container.parent();
	
	
		 // CLICK ON FILTER SHOULD CLOSE THE DETAIL PAGE ALSO
		 $parent_container.find('.filter li a').each(function() {
			 jQuery(this).click(function() {
				closeDetailView($container)
			 })
		 })
	
		 // ON RESIZE REMOVE THE DETAIL VIEW CONTAINER
	
		 if (!ie) {
			 jQuery(window).bind('resize',function()  {
				if (!isiPhone()) {
					closeDetailView($container);
					centerpdv($container);
	
				}
			 });
		} else {
	
			$container.isotope( 'option', {resizable:false});
		}
	});
	 //  CHECK IPHONE
	// Return boolean TRUE/FALSE
		function isiPhone(){
			return (
				(navigator.platform.indexOf("iPhone") != -1) ||
				(navigator.platform.indexOf("iPod") != -1) ||
    			(navigator.platform.indexOf("iPad") != -1)
			);
		}


	 // REMOVE ACTIVE THUMB EFFECTS
	 function removeActiveThumbs($container) {
		 	var $container = jQuery('.portfolio-wrapper.showcase .items');
		 	$container.find('.item').each(function() {
					jQuery(this).removeClass('active');
					if (!jQuery(this).hasClass('latest-active')) jQuery(this).children('a').children('div').fadeOut(200);
			 	});
	 }

	 // CLOSE DETAILVIEW
	 function closeDetailView($container) {
	 	 
		 jQuery('.portfolio-wrapper.showcase .items').each(function(){
			 var $container = jQuery(this);
			 var pdv = jQuery('body').find('.portfolio-detail-view');
			 $container.height($container.data('height'));
		 	 setTimeout(function() {
				 if (pdv.length) {
				 		removeActiveThumbs($container);
				 		clearInterval(pdv.data('interval'));
					 	pdv.animate({'height':'0px','opacity':'0'},{duration:speed, complete:function() { jQuery(this).remove();}});
					 	moveThumbs($container,pdv.data('itemstomove'),0);
				}
				setTimeout(function() {
						$container.isotope( 'reLayout',function() {
							$container.data('height',$container.height());
							setTimeout(function() {
								$container.data('height',$container.height());
							},speed);  //500 old value
						});
				},speed+50);
				if (!ie && !ie9) updateURLParameter("");
	
			},150)
		});
	 }

	 function centerpdv($container) {
		try {
			var pdv = jQuery('body').find('.portfolio-detail-view');
			var pleft=jQuery('body').width()/2 - pdv.width()/2;

			pdv.css({'left':pleft+"px"});

		} catch(e) { }
	 }


	 // OPEN THE DETAILVEW AND CATCH THE THUMBS BEHIND THE CURRENT THUMB
	 function openDetailView($container,thumb,fadeit) {
		 	// The Top Position of the Current Item.
		 	currentTop= thumb.position().top;
		 	thumbOffsetTop= thumb.offset().top;
		 	
		 	$container.data('height',$container.height());

			 // ALL ITEM WE NEED TO MOVE SOMEWHERE
		 	var itemstomove =[];

		 	$container.find('.item').each(function() {
			 	var curitem = jQuery(this);
			 	if (curitem.position().top>currentTop) itemstomove.push(curitem);

		 	})

		 	// Reset CurrentPositions

		 	jQuery.each(itemstomove,function() {
			 	var thumb = jQuery(this);
			 	thumb.data('oldPos',thumb.position().top);

		 	})

		 	// We Save the Height Of the current Container here.
		 	if ($container.data('height')!=undefined) {
			 	if ($container.height()<$container.data('height')) 	$container.data('height',$container.height());
		 	} else {
			 	$container.data('height',$container.height());
			 }
			 
		 	// ADD THE NEW CONTENT IN THE DETAIL VIEW WINDOW.
		 	jQuery('body').append(
				'<div class="portfolio-detail-view">'+
		 		'<div class="inner">'+
		 		'<div class="portfolio-detail-content-container">'+
		 		thumb.data('detailcontent')+
		 		'</div>'+
		 		'</div>'+
		 		'<div class="closebutton"><i class="icon-cancel-1"></i></div>'+
		 		'</div>');

		 	// CATCH THE DETAIL VIEW AND CONTENT CONTAINER
		 	var pdv = jQuery('body').find('.portfolio-detail-view');
		 	var closeb = pdv.find('.closebutton');
		 	var pdcc = pdv.find('.portfolio-detail-content-container');
		 	var pdvpad = parseInt(pdcc.css('paddingBottom'),0) + parseInt(pdcc.css('paddingTop'),0);

		 	var offset = pdcc.height()+pdvpad + parseInt(pdv.css('marginBottom'),0);


		 	closeb.click(function() {
			 	closeDetailView($container);
		 	})

		 	// ANIMATE THE OPENING OF THE CONTENT CONTAINER

			pdv.animate({'height':(pdcc.outerHeight(true)+pdvpad)+"px"},{duration:speed,queue:false});


		 	// SAVE THE ITEMS TO MOVE IN THE PDV
		 	pdv.data('itemstomove',itemstomove);



		 	//PUT THE CONTAINER IN THE RIGHT POSITION
		 	pdv.css({'top':(thumbOffsetTop+thumb.height()+parseInt(thumb.css('marginBottom'),0))+"px"});

			centerpdv($container);

			// FIRE THE CALLBACK HERE
			try{
				var callback = new Function(thumb.data('callback'));

				callback();
			} catch(e) {}

			//INITIALISE THE CAROUSEL HERE
			pdv.find('.carousel').each(function() {

				jQuery(this).carousel({
					interval: 2000
				})
			});



			jQuery.each(itemstomove,function() {
				var thumb = jQuery(this);
				if (ie ||ie9)
					thumb.data('top',parseInt(thumb.position().top,0));
				else
					thumb.data('top',0);
			});
		 	// MOVE THE REST OF THE THUMBNAILS
		 	moveThumbs($container,itemstomove,offset);

		 	pdv.data('interval',setInterval(function() {
			 	var pdv = jQuery('body').find('.portfolio-detail-view');
			 	var closeb = pdv.find('.closebutton');
			 	var pdcc = pdv.find('.portfolio-detail-content-container');
			 	var pdvpad =  parseInt(pdcc.css('paddingBottom'),0) + parseInt(pdcc.css('paddingTop'),0);
			 	var offset = pdcc.height()+pdvpad + parseInt(pdv.css('marginBottom'),0);
			 	moveThumbs($container,itemstomove,offset);
			 	pdv.animate({'height':Math.round(pdcc.height()+pdvpad)+"px"},{duration:speed,queue:false});

		 	},100));

	 }

	 // MOVE THE THUMBS
	 function moveThumbs($container,itemstomove,offset) {
		 	jQuery.each(itemstomove,function() {
			 	var thumb = jQuery(this);
			 	thumb.stop(true);
			 	thumb.animate({'top':(thumb.data('top')+offset)+"px"},{duration:speed,queue:false});
		 	})


			if (ie || ie9) {
				$container.stop(true);
				$container.animate({'height':($container.data('height')+offset)+"px"}, {duration:speed,queue:false});
			} else {
				$container.css({'height':Math.round($container.data('height')+offset)+"px"});
			}
	 }
});
/*-----------------------------------------------------------------------------------*/
/*	CALL PORTFOLIO SCRIPTS
/*-----------------------------------------------------------------------------------*/
function callPortfolioScripts() {
	jQuery('body').find('iframe').each(function() {
	    if ((jQuery(this).attr('src').split("youtube").length>1 || jQuery(this).attr('src').split("vimeo").length>1) && !jQuery(this).parent().hasClass("tp-caption")) {
				jQuery(this).wrap('<div class="single vid" />');
	    }
	});
    jQuery('.vid').fitVids();
};
/*-----------------------------------------------------------------------------------*/
/*	SELECTNAV
/*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function () {
    selectnav('tiny', {
        label: '--- Navigation --- ',
        indent: '-'
    });
});