<?php
/**
 * yoga-gene.com functions and definitions
 *
 * @package betayoga
 */

function betayoga_scripts() {

	$theme_data = wp_get_theme();
	$theme_ver  = $theme_data->get( 'Version' );

	$stylesheet = get_stylesheet_uri();
	$directory = get_template_directory_uri();
	

	if ( defined( 'WP_DEBUG' ) && ( WP_DEBUG == true ) && file_exists( get_stylesheet_directory() . '/css/style.css' ) ) { // WP_DEBUG = ture
		$stylesheet = get_stylesheet_directory_uri() . '/css/style.css';
	}

	wp_enqueue_style(
		'Roboto',
		'//fonts.googleapis.com/css?family=Roboto:400,700,400italic,700italic',
		array(),
		$theme_ver
	);

	wp_enqueue_style(
		'Roboto',
		'//fonts.googleapis.com/css?family=Roboto:400,700,400italic,700italic',
		array(),
		$theme_ver
	);
	
	wp_enqueue_script(
		'google-map',
		'//maps.google.com/maps/api/js',
		array( 'jquery' ),
		true
	);

	// fortawesome
	wp_enqueue_style(
		'fortawesome',
		'//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css',
		array(),
		'4.4.0'
	);
	
	// Load our main stylesheet.
	if(!is_multi_device('smart')){
		wp_enqueue_style( 'betayoga-style', get_stylesheet_uri() );
	}else{
		wp_enqueue_style(
			'betayoga-parent',
			get_template_directory_uri() . '/style.css',
			array(),
			$theme_ver
		);
		wp_enqueue_style(
			'betayoga-child',
			get_stylesheet_directory_uri() . '/style.css',
			array(),
			$theme_ver
		);
	}
	/*
	if(!is_multi_device('smart')){
		// non-responsive
		wp_enqueue_style(
			'non-responsive',
			$directory . '/css/non-responsive.css',
			array(),
			$theme_ver
		);
	}
	*/
	// fortawesome
	wp_enqueue_style(
		'component',
		$directory . '/css/component.css',
		array(),
		$theme_ver
	);

	// jquery BxSlider
	wp_enqueue_script(
		'jquery-easing',
		$directory . '/lib/bxslider/plugins/jquery.easing.1.3.js',
		array( 'jquery' ),
		'v4.1.2',
		true
	);
	wp_enqueue_script(
		'jquery-BxSlider',
		$directory . '/lib/bxslider/jquery.bxslider.min.js',
		array( 'jquery' ),
		'v4.1.2',
		true
	);
	wp_enqueue_style(
		'BxSlider',
		$directory . '/lib/bxslider/jquery.bxslider.css',
		array(),
		'v4.1.2'
	);

	// Lightbox
	wp_enqueue_style(
		'Lightbox',
		get_template_directory_uri() . '/lightbox2/css/lightbox.css',
		array(),
		'v2.1.4'
	);
	wp_enqueue_script(
		'Lightbox',
		get_template_directory_uri() . '/lightbox2/js/lightbox.min.js',
		array( 'jquery' ),
		'v2.1.4',
		true
	);

	// jquery UI Tabs
	wp_enqueue_script(
		'jquery-ui-tabs'
	);
	
	wp_enqueue_script(
		'modernizr-custom',
		$directory . '/js/modernizr.custom.js',
		array(),
		$theme_ver,
		true
	);

	wp_enqueue_script(
		'yoga-script',
		$directory . '/js/script.js',
		array( 'jquery', 'jquery-ui-tabs' ),
		$theme_ver,
		true
	);
	
	wp_enqueue_script(
		'map-script',
		$directory . '/js/googlemap.js',
		array(),
		$theme_ver,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'betayoga_scripts' );
/*
// カスタムヘッダーを有効にする
$custom_header_defaults = array(
	'default-image' => get_bloginfo('template_url').'/images/topdefault.png',
	'width' => 1500,
	'height' => 600,
	'header-text' => false,	//ヘッダー画像上にテキストをかぶせる
);
add_theme_support( 'custom-header', $custom_header_defaults );
*/
register_nav_menus(
	array(
		'mainNav' => 'Primary Navigation',
		'footerNav' => 'Footer Navigation'
	)
);
/**
 * オリジナル投稿タイプ
 */
function original_post_type(){
	register_post_type(
		'topslide',
		array(
			'label' => 'トップスライド',
			'hierarchical' => false,
			'public' => false,
			'show_ui' => true,
			'has_archive' => false,
			'supports' => array('title','author',)
		)
	);
	register_taxonomy(
		'tax_topslide',
		'topslide',
		array(
			'label' => 'カテゴリー',
			'hierarchical' => true,
			'rewrite' => array('slug' => 'topslide')
		)
	);
}
add_action('init', 'original_post_type');

?>