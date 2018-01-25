<?php
	$title = get_the_title();
	$title = str_replace("｜", "<br />", $title);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">

        <?php if ( has_post_thumbnail() && ! post_password_required() ) { ?>
        <div class="entry-thumbnail">
            <?php the_post_thumbnail('full', array('class' => 'img-responsive','itemprop' => 'image')); ?>
        </div>
        <?php } //.entry-thumbnail ?>

        <h1 class="entry-title" itemprop="headline">
            <a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo $title ?></a>
            <?php if ( is_sticky() && is_home() && ! is_paged() ) { ?>
            <sup class="featured-post"><?php _e( 'Sticky', 'themeum' ) ?></sup>
            <?php } ?>
        </h1>
        <?php $tax = org_get_taxonomy('cat_class'); ?>
        <div class="entry-meta">
            <ul>
                <li class="date"><i class="fa fa-clock-o"></i> <time class="entry-date" datetime="<?php echo org_get_time('class_starts','class_start',get_the_ID()); ?>" itemprop="datePublished"><?php echo org_get_date('class_starts','class_start',get_the_ID()); ?></time></li>
                <li class="author"><i class="fa fa-user"></i> <a href="<?php echo org_get_category('link'); ?>"><?php echo org_get_category('name'); ?></a></li>
                <li class="category"><i class="fa fa-paperclip"></i> <a href="<?php echo $tax['link']; ?>"><?php echo $tax['name']; ?></a></li> 
                <?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
                <li class="comments-link">
                    <i class="fa fa-comments-o"></i> <?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'themeum' ) . '</span>', __( 'One comment', 'themeum' ), __( '% comments', 'themeum' ) ); ?>
                </li>
                <?php endif; //.comment-link ?>
                <li class="favorite"><?php wpfp_link() ?></li>
            </ul>
        </div> <!--/.entry-meta -->

    </header> <!--/.entry-header -->

    <div class="entry-content" itemprop="articleBody">
        <?php the_content(); ?>
        <?php wp_link_pages(); ?>
    </div> <!-- //.entry-content -->
    <?php if(get_field('class-content')){ ?>
    <div class="entry-subcontent">
        <h2 class="entry-h2">講座内容</h2>
        <?php echo get_field('class-content'); ?>
    </div>
    <?php } ?>
    
    <?php if(get_field('class-entry')){ ?>
    <div class="entry-application hidden-xs">
        <a href="<?php echo get_field('class-entry'); ?>" class="button button-application" target="_blank">講座お申し込み<small>予約サイトに遷移します</small></a>
    </div>
    <?php } ?>
    
    <div class="entry-detail">
        <h2 class="entry-h2">講座情報</h2>
        <dl>
            <?php if(get_field('class-schedule')){ ?>
            <dt>日程</dt>
            <dd>
                <?php echo get_field('class-schedule'); ?>
            </dd>
            <?php } ?>
            <?php if(get_field('class-time')){ ?>
            <dt>時間</dt>
            <dd>
                <?php echo get_field('class-time'); ?>
            </dd>
            <?php } ?>
            <?php if(get_field('class-price')){ ?>
            <dt>参加費</dt>
            <dd>
                <?php echo '￥'.number_format(get_field('class-price')).'-'; ?>
            </dd>
            <?php } ?>
            <?php if(get_field('class-capacity')){ ?>
            <dt>定員</dt>
            <dd>
                <?php echo get_field('class-capacity').'名'; ?>
            </dd>
            <?php } ?>
            <?php if(get_field('class-target')){ ?>
            <dt>参加対象</dt>
            <dd>
                <?php echo get_field('class-target'); ?>
            </dd>
            <?php } ?>
            <?php if(get_field('class-item')){ ?>
            <dt>持ち物・準備物</dt>
            <dd>
                <?php echo get_field('class-item'); ?>
            </dd>
            <?php } ?>
            <?php if(get_field('class-note')){ ?>
            <dt>注意事項</dt>
            <dd>
                <?php echo get_field('class-note'); ?>
            </dd>
            <?php } ?>
        </dl>
    </div>
    <?php if(get_field('class-entry')){ ?>
    <div class="entry-application hidden-xs">
        <a href="<?php echo get_field('class-entry'); ?>" class="button button-application" target="_blank">講座お申し込み<small>予約サイトに遷移します</small></a>
    </div>
    <?php } ?>
    <div class="entry-profile">
        <h2 class="entry-h2">講師紹介</h2>
        <?php
            $tax_name = 'tax_class_instructor';
            $terms = get_the_terms( get_the_ID(),$tax_name);
            if(is_array($terms)){
                foreach($terms as $term){
        ?>
            <div class="profile-header">
                <div class="profile-image-set">
                    <img src="<?php echo org_get_category('image',$term->term_id); ?>" itemprop="image">
                </div>
                <div class="profile-name-set">
                    <div class="profile-subname"><?php echo org_get_category('subname',$term->term_id); ?></div>
                    <div class="profile-name"><?php echo rtrim($term->name); ?></div>
                </div>
            </div>
            <div class="profile-text">
                <?php echo nl2br($term->description); ?>
            </div>
            <?php } ?>
        <?php } ?>
    </div>
    <?php the_tags( '<footer class="entry-meta"><span class="tag-links"><i class="fa fa-tags"></i>', ', ', '</span></footer>' ); ?>
</article> <!--/#post-->