<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    <h6 class="publish-date">
        <time class="entry-date" datetime="<?php the_time( 'c' ); ?>"><?php the_time('Y年m月d日'); ?></time>
    </h6>
    
    <header class="entry-header">

        <?php if ( has_post_thumbnail() && ! post_password_required() ) { ?>
        <div class="entry-thumbnail">
            <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail('medium', array('class' => 'img-responsive suck-image','itemprop' => 'image')); ?></a>
        </div>
        <?php }else{ //.entry-thumbnail ?>
        <div class="entry-thumbnail">
            <img src="<?php echo get_template_directory_uri().'/images/404/not-found-image.gif'; ?>" class="img-responsive suck-image" itemprop="image">
        </div>
        <?php } ?>
        <div class="entry-author">
            <?php echo get_avatar( get_the_author_meta( 'ID' ), 75 ); ?>
        </div>

    </header> <!--/.entry-header -->

    <div class="clearfix post-content media">
        <div class="media-body">
            <h2 class="entry-title">
                <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                <?php if ( is_sticky() && is_home() && ! is_paged() ) { ?>
                <sup class="featured-post"><?php _e( 'Sticky', 'themeum' ) ?></sup>
                <?php } ?>
            </h2> <!-- //.entry-title -->

            <div class="clearfix entry-meta">
                <i class="fa fa-pencil"></i> <?php the_author_posts_link(); ?>
            </div> <!--/.entry-meta -->
            <div class="entry-summary">
                <?php the_excerpt(); ?>
            </div> <!-- //.entry-summary -->
        </div>
    </div>

    <?php the_tags( '<footer class="entry-meta"><span class="tag-links">', '', '</span></footer>' ); ?>

</article> <!--/#post-->