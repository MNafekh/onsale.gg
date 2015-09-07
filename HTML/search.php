<?php 
	include('php/autocomplete.php');
	
	if (isset($_GET['search'])) {
		$term = "%" . $_GET['search'] . "%";
		$skinSearch = searchSkins($term);
		$champSearch = searchChampions($term);
		
		if (count($skinSearch) === 1) {
			$url = "single_project.php?skin=" . getSkinByName($skinSearch[0]['skin_name'])[0];
			header("Location: $url");
		} else if (count($champSearch) === 1) {
			$url = "single_project.php?champ=" . getChampByName($champSearch[0]['champion_name'])[0];
			header("Location: $url");
		}
	}
?>

<!DOCTYPE html>
<!--[if IE 7 ]><html class="ie ie7" lang="en"><![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"><!--<![endif]-->
<head>

<!-- Basic Page Needs
================================================== -->
<meta charset="utf-8">
<title>onsale.gg - Search Result</title>

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
			
			<!-- Social Icons -->
			<ul class="social-icons">
			    <li><a class="twitter" href="https://twitter.com/NSCGamers"><i class="icon-twitter"></i></a></li>
			    <li><a class="facebook" href="https://www.facebook.com/NSCGamers"><i class="icon-facebook"></i></a></li>
			    <li><a class="linkedin" href="https://www.linkedin.com/groups?viewMembers=&gid=8357058&sik=1437925921332"><i class="icon-linkedin"></i></a></li>
			    <li><a class="youtube" href="https://www.youtube.com/user/NotSoCasualGamers"><i class="icon-youtube"></i></a></li>
  	 		</ul>
			
			<div class="clear"></div>
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
<?php if (count($champSearch) > 0) : ?>
<!-- 960 Container -->
<div class="container">

	<div class="sixteen columns">
	
		<!-- Page Title -->
		<div id="page-title">
			<h2><span>Champions</span></h2>
			<div class="clear"></div>
		</div>
		<!-- Page Title / End -->

	</div>
</div>
<!-- 960 Container / End -->

<!-- 960 Container -->
<div class="container">
	
	<!-- Portfolio Content -->
	<div id="portfolio-wrapper">
			
	<?php
	
	//Show champion search results    
    for ($i = 0; $i < count($champSearch); $i++) {
		$champId = $champSearch[$i]['champion_id'];
        $champName = $champSearch[$i]['champion_name'];
        $champImg = getChampImgByName($champSearch[$i]['champion_name']);
        $price_ip = $champSearch[$i]['price_ip'];
        $price_rp = $champSearch[$i]['price_rp'];
        $released = $champSearch[$i]['release_date'];
        if (is_null($champSearch[$i]['last_on_sale']) || strcmp($champSearch[$i]['last_on_sale'],'0000-00-00') == 0)
            $lastSold = 'Never';
        else
            $lastSold = $champSearch[$i]['last_on_sale'];
        echo '<!-- 1/4 Column --> <div class="three columns portfolio-item ' . $price_ip . '">' 
		. '<div class="picture"><a href="single_project.php?champ=' . $champId . '">'
		. '<img src="images/champion/' . $champImg . '.png" alt=""/><div class="image-overlay-link"></div></a></div>'
		. '<div class="item-description alt">'
		. '<h5><a href="single_project.php?champ=' . $champId . '">' . $champName . '</a></h5>'
		. '<p>' . $price_ip . ' IP</p><b><p>' . $price_rp . ' RP</p><b><p>Released on ' . $released . '</p><b><p>Last sale: ' . $lastSold . '</p>'
		. '</div>'
		. '</div>';
    }
	?>

	</div>
	<!-- End Portfolio Content -->
		
</div>
<!-- End 960 Container -->
<?php endif; ?>
<?php if (count($skinSearch) > 0) : ?>
<!-- 960 Container -->
<div class="container">

	<div class="sixteen columns">
	
		<!-- Page Title -->
		<div id="page-title">
			<h2><span>Skins</span></h2>
			
			<div class="clear"></div>
		</div>
		<!-- Page Title / End -->

	</div>
</div>
<!-- 960 Container / End -->

<!-- 960 Container -->
<div class="container">
	
	<!-- Portfolio Content -->
	<div id="portfolio-wrapper">
			
	<?php
	
	//Show skin search results    
    for ($i = 0; $i < count($skinSearch); $i++) {
		$skinId = $skinSearch[$i]['skin_id'];
        $skinName = $skinSearch[$i]['skin_name'];
		$championImg = getChampImgById($skinSearch[$i]['champion_id']);
		$splash_num = $skinSearch[$i]['splash_num'];
        $tier = $skinSearch[$i]['tier'];
		$price = getPriceByTier($tier);
        $released = $skinSearch[$i]['released'];
        if (is_null($skinSearch[$i]['last_on_sale']) || strcmp($skinSearch[$i]['last_on_sale'],'0000-00-00') == 0)
            $lastSold = 'Never';
        else
            $lastSold = $skinSearch[$i]['last_on_sale'];
        echo '<!-- 1/4 Column --> <div class="three columns portfolio-item ' . $tier . '">' 
		. '<div class="picture"><a href="single_project.php?skin=' . $skinId . '">'
		. '<img src="images/champion/loading/' . $championImg . '_' . $splash_num . '.jpg" alt=""/><div class="image-overlay-link"></div></a></div>'
		. '<div class="item-description alt">'
		. '<h5><a href="single_project.php?skin=' . $skinId . '">' . $skinName . '</a></h5>'
		. '<p>' . $price . ' RP</p><b><p>Released on ' . $released . '</p><b><p>Last sale: ' . $lastSold . '</p><b>'
		. '</div>'
		. '</div>';
    }
	?>
	</div>
	<!-- End Portfolio Content -->
		
</div>
<!-- End 960 Container -->
<?php endif; ?>
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

</body>
</html>