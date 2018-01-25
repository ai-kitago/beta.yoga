<?php get_header(); ?>
<section id="main" class="container">
    <div class="row">
        <div id="content" class="site-content col-md-8" role="main">
            <?php if ( have_posts() ) : ?>

                <header class="page-header entry-profile">
                    <h1 class="page-title mincho">aaaa<?php wp_title(' '); ?></h1>
                </header> <!-- .page-header -->
                
                <?php $term = org_term_obj(); ?>
                <?php if(is_tax('tag_event_var')): ?>
                <div class="timeline">
                    <?php
                        while ( have_posts() ) : the_post();
                            $sets = get_field('class_set');
                            foreach($sets as $row){
                                if($row['class_var'] == $term->term_id){
                                    $tax_name = 'tax_event_instructor';
                                    $image = org_get_category('profile-image',$tax_name,$term->term_id);
                                    $post_data[$row['class_start']] = array(
                                        'id' => get_the_ID(),
                                        'title' => get_the_title(),
                                        'description' => get_the_excerpt(),
                                        'link' => get_permalink(),
                                        'start' => $row['class_start'],
                                        'end' => $row['class_end'],
                                        'capacity' => $row['class_capacity'],
                                        'profile_image' => $image,
                                        'checked' => NULL
                                    );
                                }
                            }
                        // get_template_part( 'post-format/content', 'var' );
                        endwhile;
                        ksort($post_data);
                        $i = 1;
                        $cnt = count($post_data);
                        foreach($post_data as $row){
                            if($i == 1){
                                $row['checked'] = 'checked';
                            }
                            include TEMPLATEPATH .'/post-format/content-var.php';
                            $i++;
                        }
                    ?>
                </div>
                <?php endif; ?>

                <?php echo thm_pagination(); ?>

            <?php else: ?>
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
</section> <!-- .container -->

<?php get_footer();