<?php 
	include('php/autocomplete.php');	
?>
<!DOCTYPE html>
<!--[if IE 7 ]><html class="ie ie7" lang="en"><![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"><!--<![endif]-->
<head>

<!-- Basic Page Needs
================================================== -->
<meta charset="utf-8">
<title>onsale.gg - Contact Us</title>

<!-- Mobile Specific
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS
================================================== -->
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/boxed.css" id="layout">
<link rel="stylesheet" type="text/css" href="css/colors/green.css" id="colors">

<!-- Java Script
================================================== -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="js/custom.js"></script>
<script src="js/selectnav.js"></script>
<script src="js/flexslider.js"></script>
<script src="js/twitter.js"></script>
<script src="js/tooltip.js"></script>
<script src="js/effects.js"></script>
<script src="js/fancybox.js"></script>
<script src="js/carousel.js"></script>
<script src="js/isotope.js"></script>
<script src="js/jquery-easing-1.3.js"></script>
<script src="js/jquery-transit-modified.js"></script>
<script src="js/layerslider.transitions.js"></script>
<script src="js/layerslider.kreaturamedia.jquery.js"></script>
<script src="js/greensock.js"></script>

<!-- load jquery ui css-->
<link href="css/jquery-ui.min.css" rel="stylesheet" type="text/css" />
<!-- load jquery library -->
<script src="js/jquery-1.10.2.js"></script>
<!-- load jquery ui js file -->
<script src="js/jquery-ui.min.js"></script>

<script type="text/javascript">
$(function() {
	var availableTags = <?php echo getNames(); ?>;
	$("#search").autocomplete({
		source: availableTags
	});
});
</script>
</head>
<body>

<!-- Wrapper Start -->
<div id="wrapper">


<!-- Header
================================================== -->

<!-- 960 Container -->
<div class="container ie-dropdown-fix">

	<!-- Header -->
	<div id="header">

		<!-- Logo -->
		<div class="eight columns">
			<div id="logo">
				<a href="index.php"><img src="images/logo.png" alt="logo" id="logoTop" /></a>
				<div class="clear"></div>
			</div>
		</div>

		<!-- Social / Contact -->
		<div class="eight columns">
			
			<!-- Social Icons 
			<ul class="social-icons">
			    <li><a class="twitter" href="https://twitter.com/NSCGamers"><i class="icon-twitter"></i></a></li>
			    <li><a class="facebook" href="https://www.facebook.com/NSCGamers"><i class="icon-facebook"></i></a></li>
			    <li><a class="linkedin" href="https://www.linkedin.com/groups?viewMembers=&gid=8357058&sik=1437925921332"><i class="icon-linkedin"></i></a></li>
			    <li><a class="youtube" href="https://www.youtube.com/user/NotSoCasualGamers"><i class="icon-youtube"></i></a></li>
  	 		</ul>-->
			
			<div class="clear"></div>
			
			<!-- Contact Details -->
			<div id="contact-details">
				<ul>
					<li><i class="fa fa-envelope"></i><a href="mailto:support@onsale.gg">support@onsale.gg</a></li>
				</ul>
			</div>
		</div>

	</div>
	<!-- Header / End -->
	
	<!-- Navigation -->
	<div class="sixteen columns">

		<div id="navigation">
			<ul id="nav">

				<li><a href="index.php">Champions</a></li>
				<li><a href="single_project.php?champ=1">Skins</a></li>
				<li><a href="contact_us.php">Contact Us</a></li>
			</ul>

			<!-- Search Form -->
			<div class="search-form">
				<form method="get" action="search.php">
					<input type="text" name="search" class="search-text-box" id="search" />
				</form>
			</div>

		</div> 
		<div class="clear"></div>
		
	</div>
	<!-- Navigation / End -->

</div>
<!-- 960 Container / End -->


<!-- Content
================================================== -->

<!-- 960 Container -->
<div class="container">

	<div class="sixteen columns">
	
		<!-- Page Title -->
		<div id="page-title">
			<h2>Contact Us</h2>
			<div id="bolded-line"></div>
		</div>
		<!-- Page Title / End -->

	</div>
</div>
<!-- 960 Container / End -->


<!--  960 Container Start -->
<div class="container">

	<!-- Text -->
	<div class="sixteen columns">
		<p>We are a couple of Computer Science undergrads making websites to pad our resumes. 
			If you have any comments or suggestions, please drop us a line using the form below!</p>
	</div>

	<!-- Contact Form -->
	<div class="twelve columns">
		<div class="headline"><h3>Contact Form</h3></div>
		
		<div class="form-spacer"></div>
		
		<!-- Success Message -->
		<div class="success-message">
			<div class="notification success closeable">
				<p><span>Success!</span> Your message has been sent.</p>
			</div>
		</div>

		<!-- Form -->
		<div id="contact-form">
			<form method="post" action="contact.php">
				
				<div class="field">
					<label>Name:</label>
					<input type="text" name="name" class="text" />
				</div>
				
				<div class="field">
					<label>Email: <span>*</span></label>
					<input type="text" name="email" class="text" />
				</div>
				
				<div class="field">
					<label>Message: <span>*</span></label>
					<textarea name="message" class="text textarea" ></textarea>
				</div>
				
				<div class="field">
					<input type="button" id="send" value="Send Message"/>
					<div class="loading"></div>
				</div>
				
			</form>
		</div>

</div>
	
	<!-- Contact Details -->
	<div class="four columns google-map">

		<div class="headline"><h3>Our Location</h3></div>
			
		<!-- Google Maps -->
		<div id="googlemaps" class="google-map google-map-full" style="height:250px"></div>

		<script src="http://maps.google.com/maps/api/js?sensor=true"></script>
		<script src="js/jquery.gmap.min.js"></script>
		
		<script type="text/javascript">
		jQuery('#googlemaps').gMap({
			maptype: 'ROADMAP',
			scrollwheel: false,
			zoom: 13,
			markers: [
				{
					address: 'Montreal, Canada',
					html: '',
					popup: false,
				}

			],
			
		});
		</script>
		
	</div>

	<!-- Contact Details -->
	<div class="four columns">
		<br>
		<div class="headline"><h3>Social</h3></div>

			<!-- Social Icons -->
			<ul class="social-icons">
			    <li><a class="twitter" href="https://twitter.com/NSCGamers"><i class="icon-twitter"></i></a></li>
			    <li><a class="facebook" href="https://www.facebook.com/NSCGamers"><i class="icon-facebook"></i></a></li>
			    <li><a class="linkedin" href="https://www.linkedin.com/groups?viewMembers=&gid=8357058&sik=1437925921332"><i class="icon-linkedin"></i></a></li>
			    <li><a class="youtube" href="https://www.youtube.com/user/NotSoCasualGamers"><i class="icon-youtube"></i></a></li>
  	 		</ul>
		
	</div>

</div>
<!-- End 960 Container -->

</div>
<!-- Wrapper / End -->

<!-- Footer
================================================== -->

<!-- Footer Start -->
<div id="footer">
<div class="container">
 <div class="sixteen columns">
   <div id="footer-bottom" style="padding-top:12px;">
    <div id="scroll-top-top"><a href="#"></a></div>
    <div id="donate" style="height:0px;display:inline-block"><form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
     <input type="hidden" name="cmd" value="_s-xclick">
     <input type="hidden" name="hosted_button_id" value="DHB88LMXL77S2">
     <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
     <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1" style="height:0px">
     </form>
    </div>
    <div style="display:inline-block; padding-left:8px;"> to help two broke university students keep this website up and running. </div>
   </div>
  </div>
  </div>
</div>
<!-- Footer / End -->


<!-- Styles Switcher
================================================== 
<link rel="stylesheet" type="text/css" href="css/switcher.css">
<script src="js/switcher.js"></script>

<div id="style-switcher">
	<h2>Style Switcher <a href="#"></a></h2>
	
	<div><h3>Predefined Colors</h3>
		<ul class="colors" id="color1">
			<li><a href="#" class="green" title="Green"></a></li>
			<li><a href="#" class="blue" title="Blue"></a></li>
			<li><a href="#" class="orange" title="Orange"></a></li>
			<li><a href="#" class="navy" title="Navy"></a></li>
			<li><a href="#" class="yellow" title="Yellow"></a></li>
			<li><a href="#" class="peach" title="Peach"></a></li>
			<li><a href="#" class="beige" title="Beige"></a></li>
			<li><a href="#" class="purple" title="Purple"></a></li>
			<li><a href="#" class="red" title="Red"></a></li>
			<li><a href="#" class="pink" title="Pink"></a></li>
			<li><a href="#" class="celadon" title="Celadon"></a></li>
			<li><a href="#" class="brown" title="Brown"></a></li>
			<li><a href="#" class="cherry" title="Cherry"></a></li>
			<li><a href="#" class="gray" title="Gray"></a></li>
			<li><a href="#" class="dark" title="Dark"></a></li>
			<li><a href="#" class="cyan" title="Cyan"></a></li>
			<li><a href="#" class="olive" title="Olive"></a></li>
			<li><a href="#" class="dirty-green" title="Dirty Green"></a></li>
		</ul>
		
	<h3>Layout Style</h3>
	<div class="layout-style">
		<select id="layout-switcher">
			<option value="css/boxed">Boxed</option>
			<option value="css/wide">Wide</option>
		</select>
	</div>
	
	<h3>Background Image</h3>
		 <ul class="colors bg" id="bg">
			<li><a href="#" class="bg1"></a></li>
			<li><a href="#" class="bg2"></a></li>
			<li><a href="#" class="bg3"></a></li>
			<li><a href="#" class="bg4"></a></li>
			<li><a href="#" class="bg5"></a></li>
			<li><a href="#" class="bg6"></a></li>
			<li><a href="#" class="bg7"></a></li>
			<li><a href="#" class="bg8"></a></li>
			<li><a href="#" class="bg9"></a></li>
			<li><a href="#" class="bg10"></a></li>
			<li><a href="#" class="bg11"></a></li>
			<li><a href="#" class="bg12"></a></li>
			<li><a href="#" class="bg13"></a></li>
			<li><a href="#" class="bg14"></a></li>
			<li><a href="#" class="bg15"></a></li>
			<li><a href="#" class="bg16"></a></li>
			<li><a href="#" class="bg17"></a></li>
			<li><a href="#" class="bg18"></a></li>
		</ul>
		
	<h3>Background Color</h3>
		<ul class="colors bgsolid" id="bgsolid">
			<li><a href="#" class="green-bg" title="Green"></a></li>
			<li><a href="#" class="blue-bg" title="Blue"></a></li>
			<li><a href="#" class="orange-bg" title="Orange"></a></li>
			<li><a href="#" class="navy-bg" title="Navy"></a></li>
			<li><a href="#" class="yellow-bg" title="Yellow"></a></li>
			<li><a href="#" class="peach-bg" title="Peach"></a></li>
			<li><a href="#" class="beige-bg" title="Beige"></a></li>
			<li><a href="#" class="purple-bg" title="Purple"></a></li>
			<li><a href="#" class="red-bg" title="Red"></a></li>
			<li><a href="#" class="pink-bg" title="Pink"></a></li>
			<li><a href="#" class="celadon-bg" title="Celadon"></a></li>
			<li><a href="#" class="brown-bg" title="Brown"></a></li>
			<li><a href="#" class="cherry-bg" title="Cherry"></a></li>
			<li><a href="#" class="gray-bg" title="Gray"></a></li>
			<li><a href="#" class="dark-bg" title="Dark"></a></li>
			<li><a href="#" class="cyan-bg" title="Cyan"></a></li>
			<li><a href="#" class="olive-bg" title="Olive"></a></li>
			<li><a href="#" class="dirty-green-bg" title="Dirty Green"></a></li>
		</ul></div>
	
		<div id="reset"><a href="#" class="button color green boxed">Reset</a></div>
		
</div>-->


</body>
</html>