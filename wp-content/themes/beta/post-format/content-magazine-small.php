<article id="post-<?php the_ID(); ?>" <?php post_class('small'); ?>>
    <header class="entry-header col-xs-6 pull-right">
    <?php if ( has_post_thumbnail() && ! post_password_required() ) { ?>
        <div class="entry-thumbnail">
            <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail('thumb-post', array('class' => 'img-responsive')); ?></a>
        </div>
    <?php } //.entry-thumbnail ?>
    </header>
    <div class="entry-content col-xs-6">
        <p class="publish-date">
            <time class="entry-date" datetime="<?php the_time( 'c' ); ?>"><?php the_time('Y年m月d日'); ?></time>
        </p>
        <h2 class="entry-title">
            <a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo get_title_replace(); ?></a>
        </h2>
    </div>
    <footer class="entry-footer col-sm-6 col-xs-12">
        <div class="entry-author">
            <?php echo get_avatar( get_the_author_meta( 'ID' ), 75 ); ?>
            <?php the_author_posts_link(); ?>
        </div>
    </footer>
</article>