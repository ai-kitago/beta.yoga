<?php
/*
 * Template Name: お気に入り
 */

$custom_query = new WP_Query(
    array(
        'post_type' => 'class',
        'meta_key' => 'wpfp_favorites',
        'orderby' => 'meta_value',
    )
);

get_header(); ?>

<section id="main" class="container">
    <div class="row">
        <div id="content" class="site-content col-md-8" role="main">

            <?php if ( $custom_query->have_posts() ) : ?>

                <header class="page-header">
                    <h1 class="page-title"><?php wp_title(' '); ?></h1>
                </header> <!-- .page-header -->

                <?php while ($custom_query->have_posts()) : $custom_query->the_post(); ?>
                    <?php get_template_part( 'post-format/content','class'); ?>
                <?php endwhile; ?>

                <?php echo thm_pagination(); ?>

            <?php else: ?>
                <?php get_template_part( 'post-format/content', 'none' ); ?>
            <?php endif; ?>

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