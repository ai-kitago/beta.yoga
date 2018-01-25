<?php
class Custom_Ad_Org {
    
    

    public function loaded() {
    	// add post types
        add_action( 'init', array( $this, 'create_ad' ));
        //add_action( 'init', array( $this, 'create_acf' ));
        //add_filter( 'acf/create_field/type=radio', array( $this, 'action_function_class_acf' ), 10, 1 );
    }

    public function create_ad() {
        register_post_type(
            'ad-bnr',
            array(
                'label' => 'バナー登録',
                'hierarchical' => false,
                'public' => false,
                'show_ui' => true,
                'has_archive' => false,
                'supports' => array(
                    'title',
                    //'editor',
                    'author',
                    //'thumbnail',
                    'revisions'
                )
            )
        );
        register_taxonomy(
            'tax_ad',
            'ad-bnr',
            array(
                'label' => '表示位置',
                'hierarchical' => true,
                'public' => false,
                'show_ui' => true,
                'show_tagcloud' => false,
                'show_admin_column' => true
            )
        );
    }
}

if ( ! function_exists( 'get_ad_page' ) ) :
/**
 * Display Ad to post lists.
 */
function get_ad_page( $offset = 0 ) {

    $adcnt = 2;
    if ( is_child_theme() ) {
        $adcnt = 1;
    }
    $args = array(
        'posts_per_page'   => $adcnt,
        'post_type'        => 'ad-bnr',
        'post_status'      => 'publish',
        'offset'           => $offset,
        'orderby'          => 'rand',
        'tax_query' => array(
            array(
                'taxonomy' => 'tax_ad',
                'field'    => 'slug',
                'terms'    => 'page',
            ),
        ),
    );
    $the_query = new WP_Query( $args );
    if ( $the_query->have_posts() ) :
?>
    <section class="ad-single-post-content col-xs-12">
        <div class="row">
        <?php
            while ( $the_query->have_posts() ) : $the_query->the_post();
                // 画像
                $imageID = get_field( 'ad-banner' );
                $size    = 'full';
                $image_attributes = wp_get_attachment_image_src( $imageID, $size );
                $alt = get_the_title();

                $slide = "";
                if ( $image_attributes ) {
                    $slide = '<img src="' . $image_attributes[0] . '" width="' . $image_attributes[1] . '" height="' . $image_attributes[2] . '" alt="' . esc_attr( $alt ) . '" class="suck-image">';
                }

                $link = "#";
                if ( get_field( 'ad-link' ) ) {
                    $link = get_field( 'ad-link' );
                }
                
                $target = "";
                if ( get_field( 'ad-blank' ) ) {
                    $target = ' target="_blank"';
                }
            ?>
            <div class="col-md-6 col-xs-12">
                <a href="<?php echo esc_url( $link ); ?>"<?php echo $target; ?>><?php echo $slide; ?></a>
            </div>

        <?php endwhile; ?>
        </div>
    </section><!-- .ad-single-post-content -->
<?php
    endif;
    wp_reset_postdata();
}

endif;

if ( ! function_exists( 'get_ad_front' ) ) :
/**
 * Display Ad to post lists.
 */
function get_ad_front( $offset = 0 ) {

    $adcnt = 6;
    if ( is_child_theme() ) {
        $adcnt = 1;
    }
    $args = array(
        'posts_per_page'   => $adcnt,
        'post_type'        => 'ad-bnr',
        'post_status'      => 'publish',
        'offset'           => $offset,
        'tax_query' => array(
            array(
                'taxonomy' => 'tax_ad',
                'field'    => 'slug',
                'terms'    => 'front',
            ),
        ),
    );
    $the_query = new WP_Query( $args );
    if ( $the_query->have_posts() ) :
?>
    <section id="ad-front" class="ad-front-post-content page-wrapper">
        <div class="container">
            <div class="title-area">
                <h2 class="title">おすすめ講座情報</h2>
                <p class="subtitle">ヨガアカデミーのおすすめ講座</p>
            </div>
            <div class="row">
            <?php
                while ( $the_query->have_posts() ) : $the_query->the_post();
                    // 画像
                    $imageID = get_field( 'ad-banner' );
                    $size    = 'full';
                    $image_attributes = wp_get_attachment_image_src( $imageID, $size );
                    $alt = get_the_title();
    
                    $slide = "";
                    if ( $image_attributes ) {
                        $slide = '<img src="' . $image_attributes[0] . '" width="' . $image_attributes[1] . '" height="' . $image_attributes[2] . '" alt="' . esc_attr( $alt ) . '" class="suck-image">';
                    }
    
                    $link = "#";
                    if ( get_field( 'ad-link' ) ) {
                        $link = get_field( 'ad-link' );
                    }
                    
                    $target = "";
                    if ( get_field( 'ad-blank' ) ) {
                        $target = ' target="_blank"';
                    }
                ?>
                <div class="col-md-4 col-xs-6 ad-front-banner">
                    <a href="<?php echo esc_url( $link ); ?>"<?php echo $target; ?>><?php echo $slide; ?></a>
                </div>
    
            <?php endwhile; ?>
            </div>
            <div class="row">
                <div class="col-md-6 col-md-offset-3 col-xs-12">
                    <a href="/class/" class="button button-document button-s">講座一覧<small>すべての講座を確認できます</small></a>
                </div>
            </div>
        </div>
    </section><!-- .ad-single-post-content -->
<?php
    endif;
    wp_reset_postdata();
}

endif;

?>