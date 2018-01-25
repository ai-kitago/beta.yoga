<?php
$taxname = 'tag_event_var';
$terms = get_terms($taxname);
//var_dump($terms);
//$sets = get_field('class_set');
// クラス設定取得
$sets = get_field('class_set');
//var_dump($sets);
for($i = 0;count($sets) > $i;$i++){
	//if($sets[$i]['class_var'] == $termArray[$tab]){
	$set = $sets[$i];
	$start = org_timeChange($set['class_start']);
	$end = org_timeChange($set['class_end']);
	$term_idsp = $taxname . '_' . esc_html($set['class_var']);
	$date = get_field('holding_date',$term_idsp);
	$studio_id = get_field('holding_studio',$term_idsp);
	$studio_obj = get_term($studio_id);
    $studio = $studio_obj->name;
	//}
}
//var_dump($date);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('small'); ?>>
    <header class="entry-header col-md-6 col-xs-12 pull-right">
    <?php if ( has_post_thumbnail() && ! post_password_required() ) { ?>
        <div class="entry-thumbnail">
            <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail('thumb-post', array('class' => 'img-responsive')); ?></a>
        </div>
    <?php } //.entry-thumbnail ?>
        <div class="entry-tag">
        <?php
            $tax = org_get_taxonomy('tax_event_purpose');
            echo '<a href="'.$tax['link'].'">'.$tax['name'].'</a>';
        ?>
        </div>
    </header>
    <div class="entry-content col-md-6 col-xs-12">
        <p class="publish-date">
            <time class="entry-date"><?php echo date('Y年m月d日',strtotime($date)); ?></time>
        </p>
        <h2 class="entry-title">
            <a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo get_title_replace(); ?></a>
        </h2>
        <ul class="entry-list">
            <li><p><span>会場：</span><?php echo $studio; ?></p>
            <li><p><span>時間：</span><?php echo $start; ?>～<?php echo $end; ?></p>
        </ul>
    </div>
    <footer class="entry-footer col-xs-12">
        <div class="entry-author">
            <?php echo get_avatar( get_the_author_meta( 'ID' ), 75 ); ?>
            <?php the_author_posts_link(); ?>
        </div>
    </footer>
</article>