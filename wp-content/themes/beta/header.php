<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php global $themeum; ?>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php 
		org_seo_title();
		org_seo_description();
	?>
	<meta name="apple-mobile-web-app-title" content="BETAYOGA" />
	<meta name="theme-color" content="#333333">
	<?php //iOS Safari ?>
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri().'/images/home-icon.png'; ?>">
	<?php //iOS Safari(旧) / Android標準ブラウザ(一部) ?>
	<link rel="apple-touch-icon-precomposed" href="<?php echo get_template_directory_uri().'/images//home-icon.png'; ?>">
	<?php //Android標準ブラウザ(一部) ?>
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri().'/images//home-icon.png'; ?>">
	<?php //Android Chrome ?>
	<link rel="icon" sizes="192x192" href="<?php echo get_template_directory_uri().'/images//home-icon.png'; ?>">
	<?php if(isset($themeum['favicon'])){ ?>
		<link rel="shortcut icon" href="<?php echo $themeum['favicon']; ?>" type="image/x-icon"/>
	<?php }else{ ?>
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri().'/images/plus.png' ?>" type="image/x-icon"/>
	<?php } ?>
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php if(isset($themeum['before_head'])) echo $themeum['before_head'];?>
	<?php wp_head(); ?>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri().'/css/styles.css?var='.time(); ?>">
	<?php org_analytics(); ?>
</head>
<body <?php body_class() ?>>
	<div id="page" class="hfeed site">
		<header id="masthead" class="site-header" role="banner">
			<div id="navigation" class="navbar">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<!--
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							-->
							<i class="fa fa-2x fa-bars"></i>
						</button>
						<a class="navbar-brand scroll" href="<?php echo site_url(); ?>">
							<?php
								if (isset($themeum['logo_image'])){
									if(!empty($themeum['logo_image'])){
							?>
										<img src="<?php echo $themeum['logo_image']; ?>" alt="ベータヨガ | BetaYoga Training">
							<?php
									}else{
										echo '<span>'.get_bloginfo('name').'<span>'; 
									}
								}else{
									echo '<span>'.get_bloginfo('name').'<span>';
								}
							?>
						</a>
						<?php
							if(is_front_page()){
								echo '<h1 class="site-title hidden-xs">ベータヨガトレーニング<br>男性のためのメンズヨガイベント</h1>';
							}else{
								echo '<p class="site-title hidden-xs">ベータヨガトレーニング<br>男性のためのメンズヨガイベント</p>';
							}
						?>
					</div>
					<div class="navbar-collapse collapse">
						<?php if(has_nav_menu('primary')): ?>
							<?php
								wp_nav_menu(
									array(
										'theme_location' => 'primary',
										'container' => false,
										'menu_class' => 'nav navbar-nav',
										//'walker' => new Onepage_Walker()
									)
								);
							?>
						<?php endif; ?>
					</div>
				</div>  
			</div>
		</header><!--/#header-->

		<?php get_topslide(); ?>
		
		<nav id="breadcrumb">
		<?php
			if(function_exists('bcn_display') && !is_front_page()){
				echo '<ol class="breadcrumbs container">';
					bcn_display();
				echo '</ol>';
			}
			if(is_front_page()){
				//echo '<p class="site-description visible-xs-block text-center">ベータヨガトレーニングは男性だけが参加できるメンズヨガイベント。経営者やエグゼクティブ、トップアスリートが身体と精神面に効果を感じるヨガを東京・大阪にて定期開催中！1クラス2500円のお手頃価格でヨガ初心者でも安心して参加可能！</p>';
			}
		?>
		</nav>