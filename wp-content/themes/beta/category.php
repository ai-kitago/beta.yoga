<?php get_header(); ?>

<section id="main" class="container">
    <div class="row">
        <div id="content" class="site-content col-md-8" role="main">

            <?php if ( have_posts() ) : ?>

                <header class="page-header">
                    <h1 class="page-title"><?php wp_title(' '); ?></h1>
                </header> <!-- .page-header -->

                <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'post-format/content', 'large' ); ?>
                <?php endwhile; ?>

                <?php echo thm_pagination(); ?>

            <?php else: ?>
                <?php echo 'OK'; ?>
                <?php get_template_part( 'post-format/content', 'none' ); ?>
            <?php endif; ?>
            
            <?php get_ad_page(); ?>

        </div> <!-- #content -->

        <div id="sidebar" class="col-md-4" role="complementary">
            <div class="sidebar-inner">
                <aside class="widget-area">
                    <?php dynamic_sidebar('sidebar');?>
                </aside>
            </div>
        </div> <!-- #sidebar -->

    </div> <!-- .row -->
</section> <!-- .contaainer -->

<?php get_footer();