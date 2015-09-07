<?php 
	include('php/statistics.php');	
?>
<!DOCTYPE html>
<!--[if IE 7 ]><html class="ie ie7" lang="en"><![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"><!--<![endif]-->
<head>

<!-- Basic Page Needs
================================================== -->
<meta charset="utf-8">
<?php
	if (isset($_GET['champ'])) {
		$title = "onsale.gg - " . getChampById($_GET['champ'])[1];
	} else if (isset($_GET['skin'])) {
		$title = "onsale.gg - " . getSkinById($_GET['skin'])[1];
	}
	echo '<title>' . $title . '</title>';
?>

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

<!-- 960 Container -->
<div class="container">

	<div class="sixteen columns">
	
		<!-- Page Title -->
		<div id="page-title">
			<h2><span>
			<?php 
				if (isset($_GET['champ'])) {
					$champId = $_GET['champ']; 
					echo getChampById($champId)[1];
				} else if (isset($_GET['skin'])) {
					$skinId = $_GET['skin'];
					echo getSkinById($skinId)[1];
				}
				
			?></span></h2>
			<?php if (isset($_GET['champ'])) : ?>
			<!-- Portfolio Navi -->
			<div id="portfolio-navi">
				<ul>
					<?php
						// Iterate through champion IDs using left + right arrows 
						$ids = getChampIds();
						for ($i = 0; $i < count($ids);$i++) {
							if (strcmp($ids[$i],$_GET['champ']) === 0)
								$index = $i;
						}
						
						if ($index >= 1)
							echo "<li><a class='prev' href=single_project.php?champ=" . ($ids[$index-1]) . "></a></li>";
						
						if ($index <= endc($ids))
							echo "<li><a class='next' href=single_project.php?champ=" . ($ids[$index+1]) . "></a></li>";	
					?>
					
				</ul>
			</div>
			<?php endif; ?>
			<?php if (isset($_GET['skin'])) : ?>
			<!-- Portfolio Navi -->
			<div id="portfolio-navi">
				<ul>
					<?php
						// Iterate through skin IDs using left + right arrows
						$champId = getChampIdBySkinId($_GET['skin']); 
						$skins = getSkinsByChampId($champId);
						$ids = array();
						for ($i = 0; $i < count($skins); $i++) {
							array_push($ids, $skins[$i][0]);
						}
						for ($i = 0; $i < count($ids);$i++) {
							if (strcmp($ids[$i],$_GET['skin']) === 0)
								$index = $i;
						}
						
						if ($index >= 1)
							echo "<li><a class='prev' href=single_project.php?skin=" . ($ids[$index-1]) . "></a></li>";
						else
							echo "<li><a class='prev' href=single_project.php?champ=" . $champId . "></a></li>";
							
						if ($index !== count($ids) - 1)
							echo "<li><a class='next' href=single_project.php?skin=" . ($ids[$index+1]) . "></a></li>";						
					?>
				</ul>
			</div>
			<?php endif; ?>
			<div class="clear"></div>
			
		</div>
		<!-- Page Title / End -->

	</div>
</div>
<!-- 960 Container / End -->


<!-- 960 Container -->
<div class="container">

	<!-- Slider -->
	<div class="sixteen columns">
		<div class="flexslider home">
			<ul class="slides">
				<?php 
					if (isset($_GET['champ'])) {
						echo "<li><img src='images/champion/splash/" . getChampImgById($_GET['champ']) . "_0.jpg' alt='' /></li>";
					} else if (isset($_GET['skin'])) {
						$skinId = $_GET['skin'];
						$champImg = getChampImgById(getChampIdBySkinId($skinId));
						$splash = getSkinById($skinId)[3];
						echo "<li><img src='images/champion/splash/" . $champImg . "_" . $splash . ".jpg' alt='' /></li>";
					}
					
				?>
			</ul>
		</div>
	</div>
	
</div>
<!-- End 960 Container -->


<!-- 960 Container -->
<div class="container" style="margin-top: 30px;">

	<div class="four columns">
		<ul class="project-info">
			<?php
				if (isset($_GET['champ'])) {
					$champ = getChampById($_GET['champ']);
					echo '<li><strong>Price (IP):</strong> ' . $champ[3] . '</li>
						<li><strong>Price (RP):</strong> ' . $champ[4] . '</li>
						<li><strong>Released:</strong> ' . $champ[5] . '</li>';
					if (strcmp($champ[6],'0000-00-00') === 0)
						$champ[6] = "Never";
					echo '<li><strong>Last Sold:</strong> ' . $champ[6] . '</li>';
				} else if (isset($_GET['skin'])) {
					$champ = getChampById(getChampIdBySkinId($_GET['skin']));
					$skin = getSkinById($_GET['skin']);
					echo '<li><strong>Price:</strong> ' . getPriceByTier($skin[4]) . ' RP</li>
						<li><strong>Released:</strong> ' . $skin[6] . '</li>';
					if (strcmp($skin[7],'0000-00-00') === 0) 
						$skin[7] = "Never";
					echo '<li><strong>Last Sold:</strong> ' . $skin[7] . '</li><li><strong>In Store:</strong> ';
					if ($skin[8]) {
						echo "Yes";
					} else {
						echo "No";
					}
					echo '</li>';
					if (!is_null($skin[9]))
						echo '<li><strong>Note:</strong> ' . $skin[9] . '</li>';
					if ($skin[8])
						echo '<li><strong>Sale Estimate:</strong> ' . getSkinSaleEstimate($skin) . '</li>';
				}
			?>
		</ul>
	</div>

	<div class="twelve columns tooltips">
		<div class="six columns alpha"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum id ligula felis euismod semper. Donec ullamcorper nulla non metus auctor fringilla. Nullam quis risus eget urna mollis ornare vel eu leo. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Vestibulum id ligula porta felis euismod semper. Sed posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum.Nullam quis risus eget urna mollis ornare.</p></div>
		<div class="six columns alpha"><p>Donec sed odio dui. Nulla vitae elit libero, a pharetra augue. Nullam id dolor id ultricies vehicula ut id elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Aenean lacinia bibendum nulla sed consectetur. Cras mattis consectetur purus sit amet fermentum. Donec id elit non mi porta gravida at eget metus. Duis mollis, est non commodo luctus, nisi erat porttitor.</p></div>
	</div>
	
</div>
<!-- End 960 Container -->


<!-- 960 Container -->
<div class="container">

	<div class="sixteen columns">
		<!-- Headline -->
		<div class="headline" style="margin-top: 5px;"><h3>Other Skins</h3></div>
	</div>
	
	<?php
		if (isset($_GET['champ'])) {
			$champId = $_GET['champ'];
			$skinId = 0;
		} else if (isset($_GET['skin'])) {
			$skinId = $_GET['skin'];
			$champId = getChampIdBySkinId($skinId);
		}
		$champImg = getChampImgById($champId);
		
		$skins = getSkinsByChampId($champId);		
		
		for ($i = 0; $i < count($skins); $i++) {
			if (isset($_GET['skin']) && $i == 0) {
				$champ = getChampById($champId);
				echo '<div class="four columns">
					<div class="picture"><a href="single_project.php?champ=' . $champ[0] . '"><img src="images/champion/splash/' . $champImg . '_0.jpg" alt=""/>
					<div class="image-overlay-link"></div></a></div>
					<div class="item-description related">
						<h5><a href="single_project.php?champ=' . $champ[0] . '">' . $champ[1] . '</a></h5>
						<p>Released: ' . $champ[5] . '</p><p></p></div></div>';
			} 
			if (strcmp($skins[$i][0],$skinId) !== 0) {
				echo '<div class="four columns">
					<div class="picture"><a href="single_project.php?skin=' . $skins[$i][0] . '"><img src="images/champion/splash/' . $champImg . '_' . $skins[$i][3] . '.jpg" alt=""/>
					<div class="image-overlay-link"></div></a></div>
					<div class="item-description related">
						<h5><a href="single_project.php?skin=' . $skins[$i][0] . '">' . $skins[$i][1] . '</a></h5>
						<p>Released: ' . $skins[$i][6] . '</p>';
				
				if (!is_null($skins[$i][4]))		
					echo '<p>Price: ' . getPriceByTier($skins[$i][4]) . ' RP</p>';
						
				if (strcmp($skins[$i][7],'0000-00-00') !== 0)
					echo '<p>Last sold: ' . $skins[$i][7] . '</p>';
				else
					echo '<p>Last sold: Never</p>';
				echo '<p></p></div></div>';
			}
		}
		
	?>
	
	<!-- 1/4 Column 
	<div class="four columns">
		<div class="picture"><a href="single_project.html"><img src="images/portfolio/portoflio-01.jpg" alt=""/><div class="image-overlay-link"></div></a></div>
		<div class="item-description related">
			<h5><a href="single_project.html">Maritime Details</a></h5>
			<p>Mauris sit amet ligula est, eget conseact etur lectus maecenas hendrerit suscipit</p>
		</div>
	</div>
	-->
	
</div>
<!-- 960 Container / End -->


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