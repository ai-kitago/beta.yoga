<?php
if(!function_exists('org_share_site')):

function org_share_site(){
    $site_url = get_bloginfo('url');
?>
<section id="social-share" class="page-wrapper">
    <div class="container">
        <div class="social-area-academy">
            <ul class="social-button-academy">
                <!-- Twitter ([Tweet]の部分を[ツイート]にすると日本語にできます) -->
                <li class="sc-tw">
                    <a data-url="<?php echo $site_url; ?>" href="https://twitter.com/share" class="twitter-share-button" data-lang="ja" data-count="vertical" data-dnt="true" target="_blank">
                        <img src="<?php echo get_template_directory_uri() . '/images/share/share-twitter.png'; ?>" alt="twitter">
                    </a>
                </li>
    
                <!-- Facebook -->
                <li class="sc-fb"><div class="fb-like" data-href="<?php echo $site_url; ?>" data-layout="box_count" data-action="like" data-show-faces="true" data-share="false"></div></li>
    
                <!-- Google+ -->
                <li><div data-href="<?php echo $site_url; ?>" class="g-plusone" data-size="tall"></div></li>
    
                <!-- はてなブックマーク -->
                <li><a href="http://b.hatena.ne.jp/entry/<?php echo $site_url; ?>" class="hatena-bookmark-button" data-hatena-bookmark-layout="vertical-balloon" data-hatena-bookmark-lang="ja" title="このエントリーをはてなブックマークに追加"><img src="https://b.st-hatena.com/images/entry-button/button-only@2x.png" alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border:none;" /></a></li>
    
                <!-- pocket -->
                <li><a data-save-url="<?php echo $site_url; ?>" data-pocket-label="pocket" data-pocket-count="vertical" class="pocket-btn" data-lang="en"></a></li>
    
                <!-- LINE [画像は公式ウェブサイトからダウンロードして下さい] -->
                <li class="sc-li"><a href="http://line.me/R/msg/text/?<?php echo $site_url; ?>"><img src="<?php echo get_template_directory_uri() . '/images/share/linebutton_36x60.png'; ?>" width="36" height="60" alt="LINEに送る" class="sc-li-img"></a></li>

            </ul>
        <!-- Facebook用 -->
        <div id="fb-root"></div>
        </div>
    </div>
</section>
<?php
}

endif;

if(!function_exists('org_social_scripts')):

function org_social_scripts(){
	wp_enqueue_script(
		'sharejs',
		get_template_directory_uri() . '/js/share.js',
		array(),
		false,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'org_social_scripts' );
endif;
?>