<?php
/*
 * Template Name: 目的検索
 */
/*
$custom_query = new WP_Query(
    array(
        'post_type' => 'class',
        'meta_key' => 'wpfp_favorites',
        'orderby' => 'meta_value',
    )
);
*/
$terms = get_terms('tax_class_purpose');
get_header(); ?>

<section id="main" class="container">
    <div class="row">
        <div id="content" class="site-content col-md-8" role="main">
            <header class="page-header">
                <h1 class="page-title"><?php wp_title(' '); ?></h1>
            </header> <!-- .page-header -->
            <div class="row">
                <ul id="purpose-list">
                <?php foreach($terms as $term){ ?>
                    <li id="purpose-<?php echo $term->term_id; ?>">
                        <a href="<?php echo org_get_category('link',$term->term_id); ?>"><?php echo $term->name; ?></a>
                    </li>
            <?php } ?>
                </ul>
            </div>
            
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
</section> <!-- .container -->
<?php get_footer();