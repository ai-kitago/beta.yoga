<?php
/*
 * Template Name: 講師一覧
 */

$terms = get_terms('tax_class_instructor');
get_header(); ?>
<section id="main" class="container">
    <div class="row">
        <div id="content" class="site-content col-md-8" role="main">
            <header class="page-header">
                <h1 class="page-title"><?php wp_title(' '); ?></h1>
            </header> <!-- .page-header -->
            <div class="row">
            <?php foreach($terms as $term){ ?>
                <article id="instructor-<?php echo $term->term_id; ?>" class="col-md-4 col-xs-6">
                    <div class="instructor-box">
                        <header class="instructor-header">
                            <div class="instructor-image">
                                <a href="<?php echo org_get_category('link',$term->term_id); ?>"><img src="<?php echo org_get_category('image',$term->term_id); ?>" class="suck-image" itemprop="image"></a>
                            </div>
                        </header>
                        <div class="instructor-content">
                            <div class="instructor-name">
                                <p><a href="<?php echo org_get_category('link',$term->term_id); ?>"><?php echo $term->name; ?><small><?php echo org_get_category('subname',$term->term_id); ?></small></a></p>
                            </div>
                        </div>
                        <footer>
    
                        </footer>
                    </div>
                </article>
            <?php } ?>
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