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
        <?php
            $instructor = org_get_taxonomy('tax_event_instructor');
            $tag = org_get_taxonomy('tax_event_purpose');
        ?>
        <div class="entry-meta">
            <ul>
                <li class="date"><i class="fa fa-clock-o"></i> <time class="entry-date" datetime="<?php echo org_get_time('class_starts','class_start',get_the_ID()); ?>" itemprop="datePublished"><?php echo org_get_date('class_starts','class_start',get_the_ID()); ?></time></li>
                <li class="author"><i class="fa fa-user"></i> <a href="<?php echo $instructor['link']; ?>"><?php echo $instructor['name']; ?></a></li>
                <li class="category"><i class="fa fa-paperclip"></i> <a href="<?php echo $tag['link']; ?>"><?php echo $tag['name']; ?></a></li> 
                <?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
                <li class="comments-link">
                    <i class="fa fa-comments-o"></i> <?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'themeum' ) . '</span>', __( 'One comment', 'themeum' ), __( '% comments', 'themeum' ) ); ?>
                </li>
                <?php endif; //.comment-link ?>
                <li class="favorite"><?php //wpfp_link() ?></li>
            </ul>
        </div> <!--/.entry-meta -->

    </header> <!--/.entry-header -->

    <div class="entry-content" itemprop="articleBody">
        <?php the_content(); ?>
        <?php
            $sets = get_field('class_set');
            $taxname = 'tag_event_var';
            foreach($sets as $set){
                $var = get_term($set['class_var']);
                $term_idsp = $taxname . '_' . esc_html($var->term_id);
                $url = get_field('holding_url',$term_idsp);
                $target_day = get_field('holding_date',$term_idsp);
                $today = date("Y-m-d");
                if(strtotime($today) < strtotime($target_day)){
                    $studio_id = get_field('holding_studio',$term_idsp);
                    $studio = get_term($studio_id);
                    echo '<div class="class-contact">';
                    echo '<div class="col-sm-7"><p>'.date('Y年m月d日',strtotime($target_day)).'<br>'.$var->name.' '.$studio->name.'</p></div>';
                    echo '<div class="col-sm-5"><a href="'.$url.'" target="_blank" class="button button-active">お申し込み</a></div>';
                    echo '</div>';
                }
            }
        ?>
        <?php wp_link_pages(); ?>
    </div> <!-- //.entry-content -->

    <?php if(get_field('class-entry')){ ?>
    <div class="entry-application hidden-xs">
        <a href="<?php echo get_field('class-entry'); ?>" class="button button-application" target="_blank">お申し込み<small>予約サイトに遷移します</small></a>
    </div>
    <?php } ?>
    <div class="entry-profile">
        <h2 class="entry-h2">講師紹介</h2>
        <?php
            $tax_name = 'tax_event_instructor';
            $terms = get_the_terms( get_the_ID(),$tax_name);
            if(is_array($terms)){
                foreach($terms as $term){
        ?>
            <div class="profile-header">
                <div class="profile-image-set">
                    <img src="<?php echo org_get_category('profile-image',$tax_name,$term->term_id); ?>" itemprop="image">
                </div>
                <div class="profile-name-set">
                    <div class="profile-subname"><?php echo org_get_category('subname',$term->term_id); ?></div>
                    <div class="profile-name"><?php echo rtrim($term->name); ?></div>
                </div>
            </div>
            <div class="profile-text">
                <?php echo nl2br(org_get_category('profile-text','tax_event_instructor',$term->term_id)); ?>
            </div>
            <?php } ?>
        <?php } ?>
    </div>
    <?php the_tags( '<footer class="entry-meta"><span class="tag-links"><i class="fa fa-tags"></i>', ', ', '</span></footer>' ); ?>
</article> <!--/#post-->