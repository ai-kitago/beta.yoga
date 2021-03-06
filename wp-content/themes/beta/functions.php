<?php

//add_filter('show_admin_bar', '__return_false');

define('THEMEUMNAME', wp_get_theme()->get( 'Name' ));

define('THMCSS', get_template_directory_uri().'/css/');

define('THMJS', get_template_directory_uri().'/js/');

// Re-define meta box path and URL

define( 'RWMB_URL', trailingslashit( get_stylesheet_directory_uri() . '/lib/meta-box' ) );
define( 'RWMB_DIR', trailingslashit(  get_stylesheet_directory() . '/lib/meta-box' ) );

// Include the meta box script
require_once RWMB_DIR . 'meta-box.php';
require_once (get_template_directory().'/lib/metabox.php');

require_once (get_template_directory().'/inc/custom-post-type.php');
$yoga_custom_post_type = new Custom_Post_Type_Org();
$yoga_custom_post_type->loaded();

require_once (get_template_directory().'/inc/custom-ad.php');
$custom_ad = new Custom_Ad_Org();
$custom_ad->loaded();

require_once (get_template_directory().'/inc/widget-ad.php');

// Create Thumbnail
add_image_size('thumb-class', 360, 240, true);
add_image_size('thumb-profile', 360, 360, true);
add_image_size('thumb-post', 375, 160, true);
/*
if(!function_exists('org_add_default_image')):
function org_add_default_image( $tags ) {
    // replace blank Jetpack default image with site header
    if ( substr($tags['og:image'], -9) == "blank.jpg" ) {
        // jetpackでブランク画像が指定されていたとき
        unset( $tags['og:image'] );
        // 表示したい画像のURLを指定する
        $tags['og:image'] = 'http://beta.yoga/wp-content/themes/beta/images/brata-fb-image.jpg';
    }

	unset( $tags['og:image'] );
	// 表示したい画像のURLを指定する
	$tags['og:image'] = 'http://beta.yoga/wp-content/themes/beta/images/brata-fb-image.jpg';

    // always remove useless HTTPS image tags
    unset( $tags['og:image:secure_url'] );
 
    return $tags;
}
add_filter( 'jetpack_open_graph_tags', 'org_add_default_image' );
endif;
*/
/*
 * コメント機能停止
 */
add_filter( 'comments_open', '__return_false');

register_nav_menu('classmenu', 'Class Menu');
register_nav_menu('floatmenu', 'Float Menu');

if(!function_exists('academy_scripts')):
	function academy_scripts(){

		wp_enqueue_style(
			'slickcss',
			 get_template_directory_uri() . '/slick/slick.css',
			 array(),
			 '1.5.9'
		);

		wp_enqueue_script(
			'slickjs',
			get_template_directory_uri() . '/slick/slick.min.js',
			array( 'jquery' ),
			'1.0',
			true
		);
		
		if(is_home() || is_front_page()){
			wp_enqueue_script(
				'slider',
				get_template_directory_uri() . '/js/topslider.js',
				array(),
				'1.0',
				true
			);
		}

		if(is_page('pamphlet') || is_page('contact')){
			wp_enqueue_script(
				'form',
				get_template_directory_uri() . '/js/form.js',
				array(),
				'1.0',
				true
			);
		}
		if(is_tax('tag_event_var')){
			wp_enqueue_style(
				'timelinecss',
				 get_template_directory_uri() . '/css/plugin/timeline.css',
				 array(),
				 '1.0'
			);
			wp_enqueue_script(
				'modernizrjs',
				get_template_directory_uri() . '/js/modernizr.custom.min.js',
				array(),
				'1.0',
				true
			);
			wp_enqueue_script(
				'timelinejs',
				get_template_directory_uri() . '/js/timeline.js',
				array(),
				'1.0',
				true
			);
		}
	}
add_action( 'wp_enqueue_scripts', 'academy_scripts' );
endif;

if(!function_exists('get_instagram')):
	function get_instagram($class){
		require_once (get_template_directory().'/inc/plugin-instagram.php');
		$instagramClass = new instagramClass;
		$images = $instagramClass->get_images($class);
		//wp_enqueue_script('lightbox-jquery',THMJS.'jquery.lightbox.js',array(),false,true);
	}
endif;

if(!function_exists('get_title_replace')):
	function get_title_replace(){
		$title = get_the_title();
		return str_replace("｜", "<br>", $title);
	}
endif;

if(!function_exists('get_application_button')):
	function get_application_button(){
		global $post_id;
		$html = NULL;
		if(is_single()){
			if(get_field('class-entry',$post_id)){
				$html .= '<div id="application" class="visible-xs-block">';
				$html .= '<a href="'.get_field('class-entry',$post_id).'" target="_blank">お申し込み</a>';
				$html .= '</div>';
			}
		}
		return $html;
	}
endif;

if(!function_exists('my_theme_setup')):
function my_theme_setup() {
    add_theme_support( 'html5', array(
        'search-form'
    ));
}
add_action( 'after_setup_theme', 'my_theme_setup', 9999);
endif;
/*
// 検索機能
function my_posts_per_page($query) {
	if( is_search() ) {
		$query->set( 'post_type', array('post', 'magazine') );
	}
	//return $query;
}
add_action( 'pre_get_posts', 'my_posts_per_page' );

if(!function_exists('custom_search')):
function custom_search($search) {
    //サーチページ以外だったら終了
    if(is_search()) {
	    //投稿記事のみ検索
	    $search .= " AND (post_type = 'post' OR post_type='magazine')";
    }
    return $search;
}
add_filter('posts_search', 'custom_search');
endif;
*/
function auto_post_slug( $slug, $post_ID, $post_status, $post_type ) {
	$nowPostId = 1;
	if ( preg_match( '/(%[0-9a-f]{2})+/', $slug ) ||  preg_match( '/[0-9]{4}/', $slug )) {
		if($post_ID > $nowPostId) {
			$slug = utf8_uri_encode( $post_type ) . '-' . $post_ID;
			//$slug = $post_ID . '.html';
		}
	}
	return $slug;
}
add_filter( 'wp_unique_post_slug', 'auto_post_slug', 10, 4  );

/**
 * Return array $post_types with custom post types
 * 
 * @param   $post_type Array
 * @return  $post_type Array
 */
function org_addquicktag_post_types( $post_types ) {
	$post_types[] = 'class';
	return $post_types;
}
add_filter( 'addquicktag_post_types', 'org_addquicktag_post_types' );

/**
 * 930 => 9:30,1200 => 12:00
 */ 
function org_timeChange($num){
	$txt = sprintf("%04d", $num);
	$h = substr($txt,0,2);
	$m = substr($txt,-2);
	return abs($h).':'.$m;
}

/**
 * Load Custom walker templates.
 */
require get_template_directory() . '/inc/custom-walker.php';

/**
 * Load Custom Category Profile.
 */
require get_template_directory() . '/inc/custom-category.php';

/**
 * Load Custom Search
 */
require (get_template_directory().'/inc/custom-search.php');

/**
 * Load Custom Plugin
 */
require (get_template_directory().'/inc/plugin-slider.php');

/**
 * Load Custom Plugin
 */
require (get_template_directory().'/inc/custom-seo.php');

/**
 * Load Custom Plugin
 */
require (get_template_directory().'/inc/plugin-amp.php');

/**
 * Load Custom Analytics
 */
require (get_template_directory().'/inc/custom-analytics.php');

/**
 * Load Custom Navigation
 */
//require (get_template_directory().'/inc/custom-navigation.php');

/**
 * Load Custom SNS
 */
require (get_template_directory().'/inc/plugin-share.php');

/**
 * 無限スクロール
 */
add_theme_support( 'infinite-scroll', array(
    'container' => 'content',
    'footer' => 'page',
));

function custom_author_archive( &$query ) {
	if ($query->is_author)
		$query->set( 'post_type', array('post','magazine'));
	}
add_action( 'pre_get_posts', 'custom_author_archive' );

/**
 * 
 */
/*
function event_pre_get_posts( $query ) {

	if(is_admin()) return $query;
	
	if(is_tax('tag_event_var')){
		$meta_query = $query->get('meta_query');
		$meta_query[] = array(
			'relation' => 'AND',
			array(
				'key' => 'tag_event_var_%_class_var',
			),
			array(
				'key' => 'tag_event_var_%_class_start'
			)
		);
		$query->set('order', 'DESC');
		$query->set('orderby', 'meta_value');
		$query->set('meta_query', $meta_query);
	}
	// return
	return $query;
}
add_action('pre_get_posts', 'event_pre_get_posts');
*/
/**
 * Load Custom Ad (Banner Image)
 */
//require (get_template_directory().'/inc/custom-ad.php');

/*-------------------------------------------------------
 *				SMOF Theme Options Added
 *-------------------------------------------------------*/

require_once( get_template_directory()  . '/admin/index.php');

/*-------------------------------------------*
 *				Register Navigation
 *------------------------------------------*/

register_nav_menu( 'primary','Primary Menu' );
register_nav_menu( 'secondary','Secondary Menu' );



function getContrast50($hexcolor){
    return (hexdec($hexcolor) > 0xffffff/2) ? 'light-bg':'dark-bg';
}


/*-------------------------------------------*
 *				Themeum setup
 *------------------------------------------*/

if(!function_exists('thmtheme_setup')):

	function thmtheme_setup()
	{
		// load textdomain
    	load_theme_textdomain('themeum', get_template_directory() . '/languages');

		add_theme_support( 'post-thumbnails' );

		add_image_size( 'blog-thumb', 750, 350, true );

		add_theme_support( 'post-formats', array( 'aside','audio','chat','gallery','image','link','quote','status','video' ) );

		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form' ) );

		add_theme_support( 'automatic-feed-links' );

		add_editor_style('');

		if ( ! isset( $content_width ) )
		$content_width = 660;
	}

	add_action('after_setup_theme','thmtheme_setup');

endif;


/*-------------------------------------------*
 *		Themeum Widget Registration
 *------------------------------------------*/

if(!function_exists('thmtheme_widdget_init')):

	function thmtheme_widdget_init()
	{

		register_sidebar(array( 'name' 			=> __( 'Sidebar', 'themeum' ),
							  	'id' 			=> 'sidebar',
							  	'description' 	=> __( 'Widgets in this area will be shown on Sidebar.', 'themeum' ),
							  	'before_title' 	=> '<h3  class="widget_title">',
							  	'after_title' 	=> '</h3>',
							  	'before_widget' => '<div id="%1$s" class="widget %2$s" >',
							  	'after_widget' 	=> '</div>'
					)
		);

		register_sidebar(array( 'name' 			=> __( 'Bottom', 'themeum' ),
							  	'id' 			=> 'bottom',
							  	'description' 	=> __( 'Widgets in this area will be shown before Footer.' , 'themeum'),
							  	'before_title' 	=> '<h3 class="widget_title">',
							  	'after_title' 	=> '</h3>',
							  	'before_widget' => '<div class="col-sm-3 col-xs-6 bottom-widget"><div id="%1$s" class="widget %2$s" >',
							  	'after_widget' 	=> '</div></div>'
				)
		);
	}
	
	add_action('widgets_init','thmtheme_widdget_init');

endif;


/*-------------------------------------------*
 *		Themeum Style
 *------------------------------------------*/

if(!function_exists('themeum_style')):

    function themeum_style(){

    	global $themeum;

        wp_enqueue_style('thm-style',get_stylesheet_uri());
        //wp_enqueue_style('font-awesome',THMCSS.'font-awesome.min.css');
        wp_enqueue_style('font-awesome','https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');

        if(isset($themeum['g_select'])):
			//wp_enqueue_style(themeum_slug($themeum['g_select']).'_one','//fonts.googleapis.com/css?family='.$themeum['g_select'].':100,200,300,400,500,600,700,800,900',array(),false,'all');
		endif;

		if(isset($themeum['head_font'])):
			//wp_enqueue_style(themeum_slug($themeum['head_font']).'_two','//fonts.googleapis.com/css?family='.$themeum['head_font'].':100,200,300,400,500,600,700,800,900',array(),false,'all');
		endif;

		if(isset($themeum['nav_font'])):
			//wp_enqueue_style(themeum_slug($themeum['nav_font']).'_three','//fonts.googleapis.com/css?family='.$themeum['nav_font'].':100,200,300,400,500,600,700,800,900',array(),false,'all');
		endif;

        wp_enqueue_script('jquery');
        wp_enqueue_script('bootstrap',THMJS.'bootstrap.min.js',array(),false,true);
        //wp_enqueue_script('SmoothScroll',THMJS.'SmoothScroll.js',array(),false,true);
        //wp_enqueue_script('scrollTo',THMJS.'jquery.scrollTo.js',array(),false,true);
        wp_enqueue_script('nav',THMJS.'jquery.nav.js',array(),false,true);
        //wp_enqueue_script('parallax',THMJS.'jquery.parallax.js',array(),false,true);
        wp_enqueue_script('main',THMJS.'main.js',array(),false,true);
        //wp_enqueue_style('quick-style',get_template_directory_uri().'/quick-style.php',array(),false,'all');


		if(isset($themeum['presets'])):
			if(!empty($themeum['presets'])):
				$style_name = $themeum['presets'];
			else:
				$style_name = 'preset1';
			endif;
		else:
			$style_name 	= 'preset1';
		endif;

		//wp_enqueue_style('sportson_'.$style_name,get_template_directory_uri().'/css/presets/'.$style_name.'.css');

    }

    add_action('wp_enqueue_scripts','themeum_style');

endif;


if(!function_exists('themeum_admin_style')):

	function themeum_admin_style()
	{
		if(is_admin())
		{
			wp_register_script('thmpostmeta', get_template_directory_uri() .'/js/admin/zee-post-meta.js');
			wp_enqueue_script('thmpostmeta');
		}
	}

	add_action('admin_enqueue_scripts','themeum_admin_style');

endif;

/*-------------------------------------------*
 *				Excerpt Length
 *------------------------------------------*/

if(!function_exists('new_excerpt_more')):

	function new_excerpt_more( $more )
	{
		//return '&nbsp;<br /><br /><a class="btn btn-success btn-lg" href="'. get_permalink( get_the_ID() ) . '">'.__('Continue Reading','themeum').' &rarr;</a>';
		return '<div class="more-box"><a class="read-more" href="'. get_permalink( get_the_ID() ) . '">続きを読む&nbsp;&gt;</a></div>';
	}
	add_filter( 'excerpt_more', 'new_excerpt_more' );

endif;



if(!function_exists('themeum_slug')):

	function themeum_slug($text)
{
	return preg_replace('/[^a-z0-9_]/i','-', strtolower($text));
}

endif;



/*-------------------------------------------------------
*			Include the TGM Plugin Activation class
*-------------------------------------------------------*/

require_once( get_template_directory()  . '/lib/class-tgm-plugin-activation.php');

add_action( 'tgmpa_register', 'themeum_plugins_include');

if(!function_exists('themeum_plugins_include')):

	function themeum_plugins_include()
	{
		$plugins = array(
				array(
					'name'                  => 'Starter Client', // The plugin name
					'slug'                  => 'starter-client', // The plugin slug (typically the folder name)
					'source'                => get_stylesheet_directory() . '/lib/plugins/starter-client.zip', // The plugin source
					'required'              => true, // If false, the plugin is only 'recommended' instead of required
					'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
					'force_activation'      => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
					'force_deactivation'    => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
					'external_url'          => '', // If set, overrides default API URL and points to an external URL
				),

				array(
					'name'                  => 'Starter Slider', // The plugin name
					'slug'                  => 'starter-slider', // The plugin slug (typically the folder name)
					'source'                => get_stylesheet_directory() . '/lib/plugins/starter-slider.zip', // The plugin source
					'required'              => true, // If false, the plugin is only 'recommended' instead of required
					'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
					'force_activation'      => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
					'force_deactivation'    => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
					'external_url'          => '', // If set, overrides default API URL and points to an external URL
				),

				array(
					'name'                  => 'Starter Team', // The plugin name
					'slug'                  => 'starter-team', // The plugin slug (typically the folder name)
					'source'                => get_stylesheet_directory() . '/lib/plugins/starter-team.zip', // The plugin source
					'required'              => true, // If false, the plugin is only 'recommended' instead of required
					'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
					'force_activation'      => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
					'force_deactivation'    => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
					'external_url'          => '', // If set, overrides default API URL and points to an external URL
				),



				array(
					'name'                  => 'Themeum Project', // The plugin name
					'slug'                  => 'themeum-project', // The plugin slug (typically the folder name)
					'source'                => get_stylesheet_directory() . '/lib/plugins/themeum-project.zip', // The plugin source
					'required'              => true, // If false, the plugin is only 'recommended' instead of required
					'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
					'force_activation'      => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
					'force_deactivation'    => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
					'external_url'          => '', // If set, overrides default API URL and points to an external URL
				)
			);

	$theme_text_domain = 'themeum';

	/**
	* Array of configuration settings. Amend each line as needed.
	* If you want the default strings to be available under your own theme domain,
	* leave the strings uncommented.
	* Some of the strings are added into a sprintf, so see the comments at the
	* end of each line for what each argument will be.
	*/
	$config = array(
			'domain'            => $theme_text_domain,           // Text domain - likely want to be the same as your theme.
			'default_path'      => '',                           // Default absolute path to pre-packaged plugins
			'parent_menu_slug'  => 'themes.php',         		 // Default parent menu slug
			'parent_url_slug'   => 'themes.php',         		 // Default parent URL slug
			'menu'              => 'install-required-plugins',   // Menu slug
			'has_notices'       => true,                         // Show admin notices or not
			'is_automatic'      => false,            			 // Automatically activate plugins after installation or not
			'message'           => '',               			 // Message to output right before the plugins table
			'strings'           => array(
						'page_title'                                => __( 'Install Required Plugins', $theme_text_domain ),
						'menu_title'                                => __( 'Install Plugins', $theme_text_domain ),
						'installing'                                => __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
						'oops'                                      => __( 'Something went wrong with the plugin API.', $theme_text_domain ),
						'notice_can_install_required'               => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
						'notice_can_install_recommended'            => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
						'notice_cannot_install'                     => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
						'notice_can_activate_required'              => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
						'notice_can_activate_recommended'           => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
						'notice_cannot_activate'                    => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
						'notice_ask_to_update'                      => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
						'notice_cannot_update'                      => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
						'install_link'                              => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
						'activate_link'                             => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
						'return'                                    => __( 'Return to Required Plugins Installer', $theme_text_domain ),
						'plugin_activated'                          => __( 'Plugin activated successfully.', $theme_text_domain ),
						'complete'                                  => __( 'All plugins installed and activated successfully. %s', $theme_text_domain ) // %1$s = dashboard link
				)
	);

	tgmpa( $plugins, $config );

	}

endif;



/*-------------------------------------------------------
 *			Themeum Pagination
 *-------------------------------------------------------*/

if(!function_exists('thm_pagination')):

	function thm_pagination($pages = '', $range = 2)
	{  
	     $showitems = ($range * 1)+1;  

	     global $paged;

	     if(empty($paged)) $paged = 1;

	     if($pages == '')
	     {
	         global $wp_query;
	         $pages = $wp_query->max_num_pages;

	         if(!$pages)
	         {
	             $pages = 1;
	         }
	     }   

	     if(1 != $pages)
	     {
			echo "<ul class='pagination'>";

			if($paged > 2 && $paged > $range+1 && $showitems < $pages){
				echo "<li><a href='".get_pagenum_link(1)."'>&laquo;</a></li>";
			}

			if($paged > 1 && $showitems < $pages){ 
				echo '<li>';
				previous_posts_link("前へ");
				echo '</li>';
			}

			for ($i=1; $i <= $pages; $i++)
			{
				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
				{
					echo ($paged == $i)? "<li class='active'><a href='#'>".$i."</a></li>":"<li><a href='".get_pagenum_link($i)."' >".$i."</a></li>";
				}
			}

			if ($paged < $pages && $showitems < $pages){
				echo '<li>';
				next_posts_link("次へ");
				echo '</li>';
			}

			if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages){
				echo "<li><a href='".get_pagenum_link($pages)."'>&raquo;</a></li>";
			}
			
			echo "</ul>";
	     }
	}

endif;


/*-------------------------------------------------------
 *				Themeum Comment
 *-------------------------------------------------------*/

if(!function_exists('themeum_comment')):

	function themeum_comment($comment, $args, $depth)
	{
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
			// Display trackbacks differently than normal comments.
		?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
			<p>Pingback: <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'themeum' ), '<span class="edit-link">', '</span>' ); ?></p>
		<?php
				break;
			default :
			
			global $post;
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<div id="comment-<?php comment_ID(); ?>" class="comment-body media">
				
					<div class="comment-avartar pull-left">
						<?php
							echo get_avatar( $comment, $args['avatar_size'] );
						?>
					</div>
					<div class="comment-context media-body">
						<div class="comment-head">
							<?php
								printf( '<span class="comment-author">%1$s</span>',
									get_comment_author_link());
							?>
							<span class="comment-date"><?php echo get_comment_date() ?></span><span class="comment-time"> at <?php echo get_comment_time()?></span>

							<?php edit_comment_link( __( 'Edit', 'themeum' ), '<span class="edit-link">', '</span>' ); ?>
							<span class="comment-reply">
								<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'themeum' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
							</span>
						</div>

						<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'themeum' ); ?></p>
						<?php endif; ?>

						<div class="comment-content">
							<?php comment_text(); ?>
						</div>
					</div>
				
			</div>
		<?php
			break;
		endswitch; 
	}

endif;

/*--------------------------------------------------------------
 *			Theme Shortcode
 *-------------------------------------------------------------*/

// service shortcode

add_shortcode('service','service_shortcode');

function service_shortcode($atts,$content = null)
{
	extract(shortcode_atts(array( 'icon' => '', 'title' => ''),$atts));

	$output = '';

	$output .= '<div class="service-box col-md-4 col-sm-6 col-xs-12">';
	$output .= '<div class="service-box-1 pull-left">';
	$output .= '<span><i class="fa fa-'.$icon.' icon-custom-style"></i></span>';
	$output .= '</div>';
	$output .= '<div class="service-box-2">';
	$output .= '<h3>'.$title.'</h3>';
	$output .= '<p>'.$content.'</p>';
	$output .= '</div>';
	$output .= '</div>';

	return $output;
}

// feature shortcode

add_shortcode('feature','feature_shortcode');

function feature_shortcode($atts,$content = null)
{
	extract(shortcode_atts(array( 'icon' => '', 'title' => '', 'color' => '1'),$atts));

	$output = '';
	$output .= '<div class="feature-box col-md-4 col-sm-6 col-xs-12">';
	$output .= '<div class="feature-box-1 pull-left color-'.$color.'">';
	$output .= '<span><i class="fa fa-'.$icon.' icon-custom-style"></i></span>';
	$output .= '</div>';
	$output .= '<div class="feature-box-2">';
	$output .= '<h3>'.$title.'</h3>';
	$output .= '<p>'.$content.'</p>';
	$output .= '</div>';
	$output .= '</div>';

	return $output;
}

// feature shortcode

add_shortcode('action','call_to_action_shortcode');

function call_to_action_shortcode($atts,$content = null)
{
	extract(shortcode_atts(array( 'title' => '', 'link' => '#', 'button' => 'Purchase Now'),$atts));

	$output = '';
	$output .= '<div id="call-to-action">';
	$output .= '<div class="container">';
	$output .= '<div class="row">';
	$output .= '<div class="col-xs-12 col-sm-7 col-md-9">';
	$output .= '<h2>'.$content.'</h2>';
	$output .= '</div>';
	$output .= '<div class="col-xs-12 col-sm-5 col-md-3">';
	$output .= '<a class="btn btn-success btn-lg pull-right" href="'.$link.'">'.$button.'</a>';
	$output .= '</div>';
	$output .= '</div>';
	$output .= '</div>';
	$output .= '</div>';

	return $output;
}


/*--------------------------------------------------------------
 * Get All Terms of Taxonomy 
 * @author : Themeum
 *-------------------------------------------------------------*/


function get_all_term_names( $post_id, $taxonomy = 'post_tag' )
{
	$terms = get_the_terms( $post_id, $taxonomy );

	$term_names = '';
    if ( $terms && ! is_wp_error( $terms ) )
    { 
        $term_name = array();

        foreach ( $terms as $term ) {
            $term_name[] = $term->name;
        }

        $term_names = join( ", ", $term_name );
    }

    return $term_names;
}


/*--------------------------------------------------------------
 *				One-Page Nav Walker
 *-------------------------------------------------------------*/
/*
class Onepage_Walker extends Walker_Nav_menu{

	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0){

		global $wp_query;

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = join(' ', $classes);

       	$class_names = ' class="'. esc_attr( $class_names ) . '"';

       
		$attributes 	= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes 	.= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';


		if($item->object == 'page')
		{
		    $post_object = get_post($item->object_id);

		    $separate_page = get_post_meta($item->object_id, "thm_no_hash", true);

		    $disable_item = get_post_meta($item->object_id, "thm_disable_menu", true);

			$current_page_id = get_option('page_on_front');

		    if ( ( $disable_item != true ) && ( $post_object->ID != $current_page_id ) ) {

		    	$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names.'>';

		    	if ( $separate_page == true )
		        	$attributes .= ! empty( $item->url ) ? ' href="'   . esc_attr( $item->url ) .'" class="no-scroll"' : '';
		        else{
		        	if (is_front_page()) 
		        		$attributes .= ' href="#' . $post_object->post_name . '"'; 
		        	else 
		        		$attributes .= ' href="' . home_url() . '#' . $post_object->post_name . '" class="no-scroll"';
		        }	

		        $item_output = $args->before;
		        $item_output .= '<a'. $attributes .'>';
		        $item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );
		        $item_output .= $args->link_after;
		        $item_output .= '</a>';
		        $item_output .= $args->after;

		        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );            	              	
		    }
		                             
		}
		else
		{

			$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names.'>';

		    $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'" class="no-scroll"' : '';

		    $item_output = $args->before;
	        $item_output .= '<a'. $attributes .'>';
	        $item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );
	        $item_output .= $args->link_after;
	        $item_output .= '</a>';
	        $item_output .= $args->after;

		    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}
}
*/