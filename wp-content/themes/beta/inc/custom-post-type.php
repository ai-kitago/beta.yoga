<?php
class Custom_Post_Type_Org {

    public function loaded() {
    	// add post types
        add_action( 'init', array( $this, 'create_post_type' ));
        add_action( 'init', array( $this, 'create_magazine_type' ));
        //add_action( 'init', array( $this, 'create_acf' ));
        //add_filter( 'acf/create_field/type=radio', array( $this, 'action_function_class_acf' ), 10, 1 );
    }
    
    public function create_magazine_type(){
        register_post_type(
            'magazine',
            array(
                'label' => 'マガジン',
                'description' => '経営者・トップアスリート、できる男は既にやっている！美容やダイエットだけではない、男には男のヨガがある。ベータヨガマガジンでは、ビジネスで活かす、身体を鍛える、生活を向上させる、効果につなげるためのメンズヨガの情報を紹介・提案しています。',
                'hierarchical' => true,
                'public' => true,
                'show_ui' => true,
                'show_in_menu' => true,
                //'capability_type' => 'post',
                'query_var' => true,
                'has_archive' => true,
                'exclude_from_search' => false,
                'supports' => array('title','editor','excerpt','author','thumbnail','revisions'),
                'rewrite' => array(
                    'slug' => 'magazine/post',
                    'with_front' => false,
                    'hierarchical' => true,
                    'pages' => true
                ),
                //'taxonomies' => array('magazine'),
                'menu_position' => 20
            )
        );
        register_taxonomy(
            'magazine_cat',
            'magazine',
            array(
                'label' => 'カテゴリ',
                'hierarchical' => true,
                'query_var' => true,
                'rewrite' => array(
                    'slug' => 'magazine/categorys',
                    'with_front' => true,
                    'feeds' => false,
                    'hierarchical' => true,
                    //'pages' => true
                ),
                'show_admin_column' => true
            )
        );
        register_taxonomy(
            'magazine_tag',
            'magazine',
            array(
                'label' => 'タグ',
                'hierarchical' => false,
                'rewrite' => array(
                    'slug' => 'magazine/tags'
                )
            )
        );
    }

    public function create_post_type() {
        register_post_type(
            'event',
            array(
                'label' => 'トレーニング',
                'hierarchical' => true,
                'public' => true,
                'show_ui' => true,
                'show_in_menu' => true,
                //'capability_type' => 'post',
                'query_var' => true,
                'has_archive' => true,
                'exclude_from_search' => false,
                'supports' => array('title','editor','excerpt','author','thumbnail','revisions'),
                'rewrite' => array(
                    'slug' => 'training/class',
                    'with_front' => true,
                    'hierarchical' => true,
                    'pages' => true
                ),
                'taxonomies' => array('event'),
                'menu_position' => 20
            )
        );
        register_taxonomy(
            'tag_event_var',
            'event',
            array(
                'label' => '開催',
                'hierarchical' => true,
                'query_var' => true,
                'rewrite' => array(
                    'slug' => 'training/version',
                    'with_front' => true,
                    'feeds' => false,
                    'hierarchical' => true,
                    //'pages' => true
                ),
                'show_in_nav_menus' => true,
                'show_admin_column' => true
            )
        );
        register_taxonomy(
    		'tax_event_area',
    		'event',
    		array(
    			'label' => '都道府県',
    			'hierarchical' => true,
    			'rewrite' => array('slug' => 'training/area'),
    			'show_admin_column' => false
    		)
    	);
        register_taxonomy(
    		'tax_event_studio',
    		'event',
    		array(
    			'label' => 'スタジオ',
    			'hierarchical' => true,
    			'query_var' => true,
    			'rewrite' => array(
                    'slug' => 'training/studio',
                    'with_front' => true,
                    'feeds' => false,
                    'pages' => true
                ),
    			'show_admin_column' => false
    		)
    	);
    	register_taxonomy(
    		'tax_event_instructor',
    		'event',
    		array(
    			'label' => '講師',
    			'hierarchical' => true,
    			'query_var' => true,
    			'rewrite' => array(
                    'slug' => 'training/instructor',
                    'with_front' => true,
                    'feeds' => false,
                    'pages' => true
                ),
                'show_in_nav_menus' => true,
    			'show_admin_column' => true
    		)
    	);
    	register_taxonomy(
    		'tax_event_interpreter',
    		'event',
    		array(
    			'label' => '通訳',
    			'hierarchical' => true,
    			'query_var' => true,
    			'rewrite' => array(
                    'slug' => 'training/interpreter',
                    'with_front' => true,
                    'feeds' => false,
                    'pages' => true
                ),
    			'show_admin_column' => true
    		)
    	);
    	register_taxonomy(
    		'tax_event_purpose',
    		'event',
    		array(
    			'label' => '目的',
    			'hierarchical' => true,
    			'rewrite' => array('slug' => 'training/purpose'),
    			'show_admin_column' => true
    		)
    	);
    	register_taxonomy(
    		'tag_event',
    		'event',
    		array(
    			'label' => 'タグ',
    			'hierarchical' => false,
    			'rewrite' => array('slug' => 'training/tag')
    		)
    	);
    }
}
?>