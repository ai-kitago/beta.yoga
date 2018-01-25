<?php
if(!function_exists('add_slider_script')):
function add_slider_script() {
    wp_enqueue_script(
		'bgswitcher',
		get_template_directory_uri() . '/js/jquery.bgswitcher.js',
		array(),
		//date(),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'add_slider_script' );
endif;

if(!function_exists('create_slider_post_type')):
function create_slider_post_type() {
    register_post_type(
		'topslide',
		array(
			'label' => 'トップスライド',
			'hierarchical' => false,
			'public' => false,
			'show_ui' => true,
			'has_archive' => false,
			'supports' => array('title','editor','excerpt','author','thumbnail','revisions'),
			'menu_position' => 10
		)
	);
	register_taxonomy(
		'tax_slide',
		'topslide',
		array(
			'label' => 'カテゴリー',
			'hierarchical' => true,
			'rewrite' => array('slug' => 'slide')
		)
	);
}
add_action('init','create_slider_post_type');
endif;

if ( ! function_exists( 'create_slider_acf()' ) ) :
function create_slider_acf(){
    // for ヘッダースライドエリア
    register_field_group(array (
        'id' => 'acf_acf_slide',
        'title' => 'ヘッダースライドエリア',
        'fields' => array (
            array (
                'key' => 'field_master-slide',
                'label' => '画像 for PC',
                'name' => 'master-slide',
                'type' => 'image',
                'instructions' => '画像を指定（横幅：1200px　縦幅：360px）',
                'required' => 1,
                'save_format' => 'id',
                'preview_size' => 'medium',
                'library' => 'all',
            ),
            array (
                'key' => 'field_master-slide-sp',
                'label' => '画像 for SP',
                'name' => 'master-slide-sp',
                'type' => 'image',
                'instructions' => '画像を指定（横幅：750px　縦幅：300px）',
                'required' => 1,
                'save_format' => 'id',
                'preview_size' => 'medium',
                'library' => 'all',
            ),
            array (
                'key' => 'field_master-slide-link',
                'label' => 'スライド画像のリンク先URL',
                'name' => 'master-slide-link',
                'type' => 'text',
                'required' => 1,
                'default_value' => '',
                'placeholder' => 'リンク先URLを入力（例：http://www.yoga-gene.com/workshop/◯◯◯.html）',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_master-slide-target',
                'label' => 'スライド画像のリンク先URLは外部ドメイン？',
                'name' => 'master-slide-target',
                'type' => 'checkbox',
                'choices' => array (
                    '外部ドメインの場合はチェック（target="_blank"が付きます）' => '外部ドメインの場合はチェック（target="_blank"が付きます）',
                ),
                'default_value' => '',
                'layout' => 'vertical',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'slide',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'acf_after_title',
            'layout' => 'default',
            'hide_on_screen' => array (
                0 => 'the_content',
                1 => 'excerpt',
                2 => 'custom_fields',
                3 => 'discussion',
                4 => 'comments',
                5 => 'author',
                6 => 'format',
                7 => 'featured_image',
                8 => 'tags',
                9 => 'send-trackbacks',
            ),
        ),
        'menu_order' => 0,
    ));
}
//add_action('init','create_acf');
endif;

if ( ! function_exists( 'get_topslide' ) ) :
function get_topslide() {
    $tax_slide_term = 'master';
    if($tax_slide_term != 'master'){
		$termsArray = array($tax_slide_term,'master');
	}else{
		$termsArray = array($tax_slide_term);
	}
    
    $args = array(
        'posts_per_page' => 5,
        'post_type'      => 'topslide',
        'post_status'      => 'publish',
        /*
        'tax_query' => array(
            array(
                'taxonomy' => 'tax_slide',
                'field'    => 'slug',
                //'terms' => $termsArray
            ),
        ),
        */
    );
    $the_query = new WP_Query( $args );
    if ( $the_query->have_posts() ) :
        echo '<script>
            jQuery(function($){
                $(".topslider").bgswitcher({
                    interval: 5000,
                    shuffle: true,
                    effect: "drop",
                    duration: 2000,
                    images: [';
                    while ( $the_query->have_posts() ) : $the_query->the_post();
                        $imageID = get_field( 'master-image' );
                        $size = 'full';
                        $image_attributes = wp_get_attachment_image_src( $imageID, $size );
                        echo '"'.$image_attributes[0].'",';
                    endwhile;
                    echo ']
                });
            });
        </script>';
        
        if(is_home() || is_front_page()){
        
        echo '<section class="header-slide-area">
            <div class="topslider">
                <div class="container">
                    <div class="cell">
                        <img src="'.get_stylesheet_directory_uri().'/images/top/top-image-text.png" alt="経営者やアスリートが求める男のヨガ 精神面に与えるバツグンの効果 | 集中力、平常心、直感">
                    </div>
                </div>
            </div>
            </section>';
        
        }elseif(is_single() || is_page()){
        
        }else{
            
        echo '<section class="header-slide-area">
            <div class="topslider">';
                
                echo '<div class="container">
                    <div class="cell">
                        <img src="'.get_stylesheet_directory_uri().'/images/top/sub-image-text.png" alt="経営者やアスリートが求める男のヨガ">
                    </div>
                </div>';
                
            echo '</div>
            </section>';

        }
            
    endif;
    wp_reset_postdata();
}
endif;
?>