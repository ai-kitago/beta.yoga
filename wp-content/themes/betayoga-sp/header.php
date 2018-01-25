<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package betayoga
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="content-language" content="ja">
        <title>Beta Yoga</title>
        <meta name="description" content="<?php bloginfo('description'); ?>">
        <meta name="keywords" content="男,ヨガ,yoga">
        <meta name="page-topic" content="男のためのヨガ">
        <meta name="classification" content="ヨガ,フィットネス">
        <meta name="Targeted Geographic Area" content="Japan">
        <meta name="coverage" content="Japan">
        <meta name="rating" content="general">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="alternate" href="http://beta.yoga/" media="only screen and (max-width: 640px)">
        <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" type="image/x-icon" />
        <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/betayoga-home-icon.png">
        <meta name="google" content="notranslate">
        <meta name="author" content="ヨガジェネレーション">
        <?php wp_head(); ?>
        <!--[if lt IE 9]>
            <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>
    
    <body <?php body_class(); ?>>
        <header class="container-fluid">
        	<!--<div class="container">-->
        		<div class="row">
        			<div class="col-xs-4">
        				<a href="<?php echo site_url( '/' ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/mainlogo.png" alt="<?php bloginfo( 'name' ); ?>" class="logo"></a>
        			</div>
        			<nav class="hidden-xs">
        				<?php
        				    wp_nav_menu(
        				        array(
        				            'theme_location' => 'mainNav',
        				            'items_wrap' =>'<ul id="mainNav">%3$s</ul>'
        				        )
        				    );
        				?>
        			</nav>
        		</div>
        	<!--</div>-->
        </header>
        <section id="top" class="container-fluid">
            <!--<div class="row">-->
                <ul class="bxslider">
        	<?php
        	    $args = array(
                    'post_type' => 'topslide',
                    'post_status' => 'publish',
                    'posts_per_page' => 4,
                    'order' => 'DESC',
                    'orderby' => 'menu_order'
                );
                $the_query = new WP_Query( $args );
                if ( $the_query->have_posts() ) :
                    while ( $the_query->have_posts() ) : $the_query->the_post();
                        //画像(返り値は「画像ID」)
                        $bgImage = wp_get_attachment_image_src(get_field('bgImage'),'full'); //サイズは自由に変更してね
                        $textImage = wp_get_attachment_image_src(get_field('textImage'),'full'); //サイズは自由に変更してね
                        $frontImage = wp_get_attachment_image_src(get_field('frontImage'),'full'); //サイズは自由に変更してね
                        if($bgImage){
                            echo '<li>
                                <img src="'.$bgImage[0].'" alt="'.get_the_title().' class="bgImage">
                                <div class="container"><div class="row">';
                            if($textImage){
                                echo '<div class="col-xs-6"><img src="'.$textImage[0].'" alt="'.get_the_title().'" class="textImage"></div>';
                            }
                            if($frontImage){
                                echo '<div class="col-xs-6 pull-right"><img src="'.$frontImage[0].'" alt="'.get_the_title().'" class="frontImage"></div>';
                            }
                            echo '</div></div></li>';
                        }
                    endwhile;
                endif;
                wp_reset_postdata();
            ?>
                </ul>
            <!--</div>-->
        </section>