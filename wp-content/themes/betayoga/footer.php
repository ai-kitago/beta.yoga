<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package betayoga
 */
?>

        <footer class="container-fluid">
            <div class="container">
                <div class="row">
                    <nav class="col-xs-10">
                        <?php
        				    wp_nav_menu(
        				        array(
        				            'theme_location' => 'footerNav',
        				            'items_wrap' =>'<ul id="footerNav">%3$s</ul>'
        				        )
        				    );
        				?>
                    </nav>
                    <div class="col-xs-2">
                        <a href="<?php echo site_url( '/' ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/mainlogo.png" alt="<?php bloginfo( 'name' ); ?>" class="logo"></a>
                    </div>
                </div>
                <div class="col-xs-12">
                    <p class="copy">&copy;Beta Yoga</p>
                </div>
            </div>
        </footer>
        <div id="btn-up">
            <img src="<?php echo get_template_directory_uri(); ?>/images/btn-up.png">
        </div>
        <?php wp_footer(); ?>
    </body>
</html>