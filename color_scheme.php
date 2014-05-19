<?php 
	$options = get_option('realm');

	$rgb_code = get_rgb($options['highlight_color']);

	$rgb = $rgb_code[0].','.$rgb_code[1].','.$rgb_code[2];

	$menu_main = str_replace("#", "", $options['highlight_color']);
	$grad = gradient($menu_main,'FFFFFF',30);
	
?>
	<style>
		#mobile-header{ background: <?php echo $options['highlight_color']; ?> url('<?php echo $options['mobile_logo'];?>') left center no-repeat;}
		/*Retina ready*/
		@media only screen and (-Webkit-min-device-pixel-ratio: 1.5),only screen and (-moz-min-device-pixel-ratio: 1.5),only screen and (-o-min-device-pixel-ratio: 3/2),only screen and (min-device-pixel-ratio: 1.5) {
			#mobile-header{ background: <?php echo $options['highlight_color']; ?> url('<?php echo $options['mobile_logo2x'];?>') left center no-repeat;}

		}
		#nav a {background: <?php echo $options['highlight_color']; ?>;}
		.intermediate-page{background: rgba(<?php echo $rgb; ?>,0.7);}
		.realm-button{background: <?php echo $options['highlight_color']; ?>; }
		
		.realm-button.dark:hover{ border: 3px solid <?php echo $options['highlight_color']; ?> !important;}
		.highlight-txt {color: <?php echo $options['highlight_color']; ?> !important;}
		.highlight-bg {background: <?php echo $options['highlight_color']; ?> !important;}
		a.active {	color: <?php echo $options['highlight_color']; ?> !important;}
		.nav2 a:hover {	color: <?php echo $options['highlight_color']; ?> !important;}
		.nav ul li ul li:hover > a{color: #FFF !important;}
		.nav ul li ul:before{background: <?php echo $options['highlight_color']; ?> !important;}
		.nav ul li ul {background: <?php echo $options['highlight_color']; ?> !important;}
		.navbar-widget .twitter-handle > span{border-bottom: solid 3px <?php echo $options['highlight_color']; ?> !important;}
		.realm-heading h2 > span{background: <?php echo $options['highlight_color']; ?> !important;}
		.page-style-details h3 {background: <?php echo $options['highlight_color']; ?> !important;}
		.page-style-details p{border-top: solid 1px <?php echo $options['highlight_color']; ?> !important;}
		.service-details .service-hover-text{background: <?php echo $options['highlight_color']; ?> !important;}
		.service-details:hover .service-hover-text{background:rgba(<?php echo $rgb; ?>,0.85) !important;}
		.service-details .service-text a , .service-white .service-text{color: <?php echo $options['highlight_color']; ?> !important;}
		.testimonial-spec{background: rgba(<?php echo $rgb; ?>,0.4) !important;}
		#filters .selected {background: <?php echo $options['highlight_color']; ?> !important;}
		.element{background: <?php echo $options['highlight_color']; ?> !important;}
		.realm-service{	background: <?php echo $options['highlight_color']; ?> !important;}
		.realm-service.dark-bg{background: #231F20 !important;}
		.realm-service-details{border-bottom: 5px solid <?php echo $options['highlight_color']; ?> !important;}
		.realm-service.dark-bg + .realm-service-details{border-bottom: 5px solid #231F20 !important;}
		.news-main-space{background-color: <?php echo $options['highlight_color']; ?> !important;}
		.news-img-section .imgs{}
		.news-img-section .imgs a .blog-attr{background: rgba(<?php echo $rgb; ?>,0.85);}
		.news-more:hover{background-color: rgba(<?php echo $rgb; ?>,1);}
		.post-type-quote { border-left: 5px solid <?php echo $options['highlight_color']; ?> !important; }
		.post-type-link{background: <?php echo $options['highlight_color']; ?> !important;}
		.contact-bgcolor-highlight {background: <?php echo $options['highlight_color']; ?> !important;}
		#contactForm input:focus, #contactForm textarea:focus { background: <?php echo $options['highlight_color']; ?> !important;}
		#get-ready a.realm-button {background-color: <?php echo $options['highlight_color']; ?> !important;}

		/*calendar*/

		#wp-calendar{
			width:100%;
			padding: 0px 0px;
			margin:0px 0px;
			border: <?php echo $options['highlight_color']; ?> solid 3px !important;
			color: #FFF !important;
			
			
		}
		#calendar_wrap{

			margin:0px auto;
			margin-top: 10px;
			
		}

		#wp-calendar caption{
			padding: 10px 5px 10px 5px ;
			font-size:22px;
			color:#FFF;
			text-transform: uppercase;
			border-bottom: rgba(0,0,0,.2) solid 3px;
			background: <?php echo $options['highlight_color']; ?> !important;
			
		}
		#wp-calendar thead{
			margin-bottom: 10px;
			background: <?php echo $options['highlight_color']; ?> !important;
		}
		
		#wp-calendar th{
			color: #FFF !important;
			
		}

		#wp-calendar th, #wp-calendar td{
			padding: 5px;
			text-align:center;
			
			background: #<?php echo $grad[4]; ?>;
		}
		#wp-calendar td{
			color:#333 !important;
		}

		#wp-calendar td a{

			padding: 0px;
			border:none;
			color:<?php echo $options['highlight_color']; ?> !important;
			
		}
		#wp-calendar td a:hover{text-shadow:0px 0px 6px #FFF; text-decoration: none;}
		#wp-calendar td{
			background:transparent;
			border:none;
			color:#CCC;
		}
		#wp-calendar td, table#wp-calendar th{
			padding: 2px 0;
		}

		#searchform input[type="text"], #comments-form input[type="text"], #comments-form textarea
		{
		    border-radius:0px;
		    border: 3px solid <?php echo $options['highlight_color']; ?> !important;
		    color: <?php echo $options['highlight_color']; ?> !important;
		    font-family: "Open_Sans_R";
		    font-size: 16px;
		    font-weight: normal;
		    line-height: 27px;
		    padding: 11px 10px;
		    width: 60%;
		    box-shadow: none !important;
		    margin-top: 10px;
		}
		
		@-moz-document url-prefix(){
			#searchform input[type="text"]{
				padding: 14px 10px !important;
			}
		}
		#searchform .realm-button{border: 0px; margin-top: 0px;}
		.sidebar ul li a:hover{color: <?php echo $options['highlight_color']; ?>;}
		.featured_attr{padding: 7px 10px; background: <?php echo $options['highlight_color']; ?>; color: #FFF;}
		.featured_attr a{color: #FFF !important;}
		.cmntbox a:hover, .post-tags a:hover{color: <?php echo $options['highlight_color']; ?>;}
		.logged-in-as a:hover{color: <?php echo $options['highlight_color']; ?> !important;}
		.post-tags{border-top: #EEE solid 2px; padding-top: 15px;}
		.tagcloud a:hover{color: <?php echo $options['highlight_color']; ?>;}
	</style>