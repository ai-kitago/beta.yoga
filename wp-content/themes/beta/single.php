<?php get_header(); ?>

    <section id="main" class="container">
        <div class="row">
            <div id="content" class="site-content col-md-8" role="main">

                <?php if ( have_posts() ) : ?>

                    <?php while ( have_posts() ) : the_post(); ?>
                    
                        <?php 
                            if(get_post_type() == "class"){
                                get_template_part( 'post-format/single', "class");
                            }elseif(get_post_type() == "event"){
                                get_template_part( 'post-format/single', get_post_type());
                            }else{
                                get_template_part( 'post-format/single', get_post_format() );
                            }
                        ?>

                        <div class="clearfix post-navigation">
                        <?php
                            $prevpost = get_adjacent_post(true, '', true); //前の記事
                            $nextpost = get_adjacent_post(true, '', false); //次の記事
                            if( $prevpost or $nextpost ){ //前の記事、次の記事いずれか存在しているとき
                                if ( $prevpost ) { //前の記事が存在しているとき 
                                    echo '
                                    <div class="previous-post pull-left pn-set">
                                        <div class="pn-thumbnail">'
                                            . get_the_post_thumbnail($prevpost->ID, 'thumbnail') . '
                                        </div>
                                        <a href="' . get_permalink($prevpost->ID) . '" class="pn-link">' . get_the_title($prevpost->ID) . '</a>
                                    </div>';

                                } else { //前の記事が存在しないとき
                                    echo '
                                    <div class="previous-post pull-left pn-set">
                                        <div class="pn-home">
                                            <a href="' . network_site_url('/') . '">ホームへ戻る</a>
                                        </div>
                                    </div>';
                                }

                                if ( $nextpost ) { //次の記事が存在しているとき
                                    echo '
                                    <div class="next-post pull-right pn-set">
                                        <div class="pn-thumbnail">'
                                            . get_the_post_thumbnail($nextpost->ID, 'thumbnail') . '
                                        </div>
                                        <a href="' . get_permalink($nextpost->ID) . '" class="pn-link">' . get_the_title($nextpost->ID) . '</a>
                                    </div>';
                                } else { //次の記事が存在しないとき
                                    echo '
                                    <div class="next-post pull-right pn-set">
                                        <div class="pn-home">
                                            <a href="' . network_site_url('/') . '">ホームへ戻る</a>
                                        </div>
                                    </div>';
                                }
                        ?>
                            
                            <?php //previous_post_link('<span class="previous-post pull-left">%link</span>','<i class="fa fa-angle-double-left"></i> %title'); ?>
                            <?php //next_post_link('<span class="next-post pull-right">%link</span>','%title <i class="fa fa-angle-double-right"></i>'); ?>
                        <?php
                            }
                        ?>
                        </div> <!-- .post-navigation -->

                        <?php
                            if ( comments_open() || get_comments_number() ) {
                                    comments_template();
                            }
                        ?>
                    <?php endwhile; ?>

                <?php else: ?>
                    <?php get_template_part( 'post-format/single', 'none' ); ?>
                <?php endif; ?>
                
                <?php get_ad_page(); ?>

            </div> <!-- #content -->

            <div id="sidebar" class="col-md-4" role="complementary">
                <div class="sidebar-inner">
                    <aside class="widget-area">
                        <?php dynamic_sidebar( 'sidebar' ); ?>
                    </aside>
                </div>
            </div> <!-- #sidebar -->

        </div> <!-- .row -->
    </section> <!-- .container -->

<?php get_footer();