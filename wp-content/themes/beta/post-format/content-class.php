<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header col-md-3 col-xs-4">
    <?php if ( org_field_image() ) { ?>
        <div class="entry-thumbnail">
            <a href="<?php the_permalink(); ?>" rel="bookmark"><img src="<?php echo org_field_image(); ?>" class="suck-image" itemprop="image"></a>
        </div>
    </header>
    <?php } //.entry-thumbnail ?>
    <div class="entry-content col-md-9 col-xs-8">
        <div class="row">
        <p class="publish-date">
            直近の講座：<time class="entry-date" datetime="<?php echo org_get_time('class_starts','class_start',get_the_ID()); ?>"><?php echo org_get_date('class_starts','class_start',get_the_ID()); ?></time>
        </p>
        <h2 class="entry-title">
            <a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo get_title_replace(); ?></a>
        </h2>
        </div>
    </div>
    <footer class="entry-footer col-md-9 col-xs-12">
            <dl>
                <dt>担当講師</dt>
                <dd>
                    <div class="row">
                <?php
                    $tax_name = 'tax_class_instructor';
                    $terms = get_the_terms( get_the_ID(),$tax_name);
                    foreach($terms as $term){
                ?>
                <div class="entry-profile col-md-4 col-xs-6">
                    <div class="profile-image">
                        <a href="<?php echo org_get_category('link',$term->term_id); ?>"><img src="<?php echo org_get_category('thumbnail',$term->term_id); ?>" class="suck-image"></a>
                    </div>
                    <div class="profile-name">
                        <p><a href="<?php echo org_get_category('link',$term->term_id); ?>"><?php echo rtrim($term->name); ?></a></p>
                    </div>
                </div>
                <?php } ?>
                    </div>
                </dd>
            </dl>
    </footer>
</article>