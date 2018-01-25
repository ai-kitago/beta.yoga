<?php get_header(); ?>
<section id="main" class="container">
    <div class="row">
        <div id="content" class="site-content col-md-8" role="main">
            <?php if ( have_posts() ) : ?>
                <?php $term = org_term_obj(); ?>
                <header class="page-header entry-profile">
                <?php if(is_tax('tag_event_var')): ?>
                    <?php
                        $taxname = 'tag_event_var';
                        $term_idsp = $taxname . '_' . esc_html($term->term_id);
                        $area_id = get_field('holding_area',$term_idsp);
                        $area = get_term($area_id);

                        $date = get_field('holding_date',$term_idsp);
                        
                        $studio_tax = 'tax_event_studio';
                        $studio_id = get_field('holding_studio',$term_idsp);
                        $studio = get_term($studio_id);
                        
                        $url = get_field('holding_url',$term_idsp);
                    ?>
                    <h1 class="page-title mincho"><?php wp_title(' '); ?><br>ベータヨガトレーニング</h1>
                    <b class="subtitle mincho"><?php echo date("Y年m月d日",strtotime($date)); ?><br><?php echo str_replace("｜", "<br />", $studio->name); ?></b>
                <?php else: ?>
                    <h1 class="page-title"><?php wp_title(' '); ?></h1>
                <?php endif; ?>
                </header> <!-- .page-header -->

                <?php if(is_tax('tax_event_instructor')): ?>
                <div class="entry-profile">
                    <div class="profile-header">
                        <div class="profile-image-set">
                            <img src="<?php echo org_get_category('profile-image','tax_event_instructor',$term->term_id); ?>">
                        </div>
                        <div class="profile-name-set">
                            <div class="profile-subname"><?php echo org_get_category('profile-subname','tax_event_instructor',$term->term_id); ?></div>
                            <div class="profile-name"><?php echo rtrim($term->name); ?></div>
                        </div>
                    </div>
                </div>
                <h2 class="entry-h2">関連講座</h2>
                <?php endif; ?>
                
                
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
                <?php
                    $studio_image = org_get_category('studio_image',$studio_tax,$studio->term_id);
                ?>
                <div class="timeline-contact">
                    <h4><?php wp_title(' '); ?> 【<?php echo $area->name; ?>】<br><?php echo $studio->name; ?></h4>
                    <div class="col-sm-8 col-sm-offset-2 col-xs-12">
                        <a href="<?php echo $url; ?>" target="_blank" class="button button-active">お申し込み<small>予約ショップに移動します</small></a>
                    </div>
                </div>
                <div class="timeline-studio">
                    <div class="row">
                        <header class="studio-header col-sm-7">
                            <img src="<?php echo $studio_image; ?>" alt="<?php echo $studio->name; ?>" class="suck-image">
                        </header>
                        <div class="studio-content col-sm-5">
                            <div class="studio-name">
                                <p><a href="<?php echo org_get_category('studio_url',$studio_tax,$studio->term_id); ?>" target="_blank">
                                <?php echo str_replace("｜", "<br />", $studio->name); ?>
                                <?php
                                    if(org_get_category('shop_name',$studio_tax,$studio->term_id)){
                                        echo '<small>'.org_get_category('shop_name',$studio_tax,$studio->term_id).'</small>';
                                    }
                                ?>
                                </a></p>
                            </div>
                        </div>
                        <footer class="studio-footer col-sm-5">
                            <a href="tel:<?php echo str_replace(array('-', 'ー'), '',org_get_category('studio_tel',$studio_tax,$studio->term_id)); ?>"><i class="fa fa-2x fa-phone"></i><?php echo org_get_category('studio_tel',$studio_tax,$studio->term_id); ?></a>
                            <a href="<?php echo org_get_category('studio_map',$studio_tax,$studio->term_id); ?>" class="button button-orange" target="_blank">地図アプリで確認</a>
                        </footer>
                    </div>
                </div>
                <?php else: ?>
                <?php $p = 1; ?>
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php 
                    if(is_tax('magazine_cat')):
                        if($p == 1){
                            get_template_part( 'post-format/content', 'magazine-large');
                        }else{
                            get_template_part( 'post-format/content', 'magazine-small');
                        }
                        $p++;
                    ?>
                    <?php elseif(is_tax('tax_event_instructor')): ?>
                        <?php get_template_part( 'post-format/content', 'relation'); ?>
                    <?php elseif(is_tax('tax_event_purpose')): ?>
                        <?php get_template_part( 'post-format/content', 'magazine-small'); ?>
                    <?php else: ?>
                        <div class="row">
                        <?php get_template_part( 'post-format/content', 'var' ); ?>
                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>
                
                <?php endif; ?>

                <?php echo thm_pagination(); ?>
                
                <?php if(is_tax('tax_event_instructor')): ?>
                <h2 class="entry-h2">プロフィール</h2>
                <div class="entry-profile">
                    <div class="profile-text">
                        <?php echo nl2br(org_get_category('profile-text','tax_event_instructor',$term->term_id)); ?>
                    </div>
                </div>
                <?php endif; ?>

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