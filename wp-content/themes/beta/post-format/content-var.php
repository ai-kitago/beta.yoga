<article id="post-<?php the_ID(); ?>" <?php post_class('event'); ?>>
    <input type="radio" name="tl-group" <?php echo $row['checked'] ?>/>
    <label></label>
    <?php
        echo '<style type="text/css">';
        $tax_name = 'tax_event_instructor';
        $terms = get_the_terms( $row['id'],$tax_name);
        if(is_array($terms)){
            foreach($terms as $term){
                echo '.user-' . $row['id'] . '{ background-image: url(' . org_get_category('profile-image',$tax_name,$term->term_id) . '); background-size: contain;}';
            }
        }
        echo '</style>';
    ?>
    <div class="thumb user-<?php echo $row['id']; ?>"><span><?php echo org_timeChange($row['start']); ?>～<?php echo org_timeChange($row['end']); ?></span></div>
    <div class="content-perspective">
        <div class="content">
            <div class="content-inner">
                <h3><?php echo $row['title']; ?></h3>
                <p><?php echo $row['description']; ?><a href="<?php echo $row['link'] ?>" class="button button-orange button-xs">さらに詳しく</a></p>
            </div>
        </div>
    </div>
</article>