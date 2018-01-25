    <?php org_share_site(); ?>

    <section id="group" class="page-wrapper full-width">
        <div class="container">
            <div class="row">
                <ul>
                    <li>
                        <a href="https://www.yoga-gene.com/" target="_blank"><img src="<?php echo get_template_directory_uri().'/images/logo/logo-yoga-gene-com.png' ?>" alt="ヨガジェネレーション" class="suck-image"></a>
                    </li>
                    <li>
                        <a href="http://www.ohanasmile.jp/" target="_blank"><img src="<?php echo get_template_directory_uri().'/images/logo/logo-ohanasmile-jp.png' ?>" alt="オハナスマイル ヨガスタジオ" class="suck-image"></a>
                    </li>
                    <li>
                        <a href="http://www.tokyo-yogawear.jp/" target="_blank"><img src="<?php echo get_template_directory_uri().'/images/logo/logo-tokyo-yogawear-jp.png' ?>" alt="東京ヨガウェア2.0" class="suck-image"></a>
                    </li>
                    <li>
                        <a href="https://www.yoga-academy.jp/"><img src="<?php echo get_template_directory_uri().'/images/logo/logo-yoga-academy-jp.png' ?>" alt="ヨガアカデミー大阪" class="suck-image"></a>
                    </li>
                </ul>
                <p class="text-center">ベータヨガのグループサイトもご覧ください。</p>
            </div>
        </div>
    </section>

    <section id="bottom" class="footer-wiget-area">
        <div class="container">
            <div class="row">
               <?php dynamic_sidebar('bottom'); ?>
            </div>
        </div>
    </section>
    <?php global $themeum; ?>
    <footer id="footer" class="midnight-blue">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <?php if(has_nav_menu('secondary')): ?>
                        <?php
                            wp_nav_menu(
                                array(
                                    'theme_location' => 'secondary',
                                    'container'  => false,
                                    'menu_class' => 'footer-menu',
                                    'depth' => 1
                                )
                            );
                        ?>
                    <?php endif; ?>
                </div>
                <div class="col-xs-12 text-center">
                  <?php if(isset($themeum['copyright_text'])) echo $themeum['copyright_text']; ?>
                </div>
            </div>
        </div>
        <a id="gototop" class="gototop" href="#"><i class="icon-chevron-up"></i></a><!--#gototop-->
    </footer><!--/#footer-->
    <?php echo get_application_button(); ?>
    <?php if(is_single() || is_archive() || is_category() || is_page('schedule') || is_page('instructor')){ ?>
    <nav class="container-fulid visible-xs-block float-menu">
    <?php
        wp_nav_menu(
		    array(
			    'theme_location'=>'floatmenu',
				'container'     => false,
				'depth' => 1,
				'walker'=> new Custom_Float_Walker_Nav_Menu,
				'items_wrap'    =>'<ul class="slide-menu">%3$s</ul>',
				'fallback_cb'=> false
			)
		);
	?>
	</nav>
    <?php } ?>
</div>

<?php if(isset($themeum['before_body']))  echo $themeum['before_body']; ?>
<?php if(isset($smof_data['google_analytics'])) echo $smof_data['google_analytics'];?>

    <?php if(isset($smof_data['custom_css'])): ?>
        <?php if(!empty($smof_data['custom_css'])): ?>
            <style>
                <?php echo $smof_data['custom_css']; ?>
            </style>
        <?php endif; ?>
    <?php endif; ?>
<?php wp_footer(); ?>

</body>
</html>