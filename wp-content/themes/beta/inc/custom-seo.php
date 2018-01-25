<?php
if(!function_exists('org_seo_title')):

function org_seo_title(){
    if(is_home() || is_front_page()){
        echo '<title>男性限定のメンズヨガイベント | BETAYOGA</title>';
        echo "\n";
    }elseif(is_archive()){
        if (( get_post_type() == 'magazine')){
            if(is_tax('magazine_cat')){
                $term = org_term_obj();
                echo '<title>メンズヨガ情報 ベータヨガマガジン：'.$term->name.' | BETAYOGA</title>';
            }else{
                $obj = get_post_type_object('magazine');
                echo '<title>メンズヨガ情報 ベータヨガマガジン | BETAYOGA</title>';
                echo "\n";
            }
        }elseif(is_tax('tag_event_var')){
            $term = org_term_obj();
            $taxname = 'tag_event_var';
            $term_idsp = $taxname . '_' . esc_html($term->term_id);
            $area_id = get_field('holding_area',$term_idsp);
            $area = get_term($area_id);
            echo '<title>'.$term->name.' '.$area->name.'開催 ベータヨガトレーニング | BETAYOGA</title>';
        }else{
            echo '<title>' . wp_title(' ',false) .' | ' . get_bloginfo('name') .'</title>';
            echo "\n";
        }
    }else{
        echo '<title>' . wp_title(' ',false) .' | ' . get_bloginfo('name') .'</title>';
        echo "\n";
    }
}

endif;

if(!function_exists('org_seo_description')):

function org_seo_description(){
    if(is_home() || is_front_page()){
        echo '<meta name="description" content="ベータヨガトレーニングは男性だけが参加できるメンズヨガイベント。経営者やエグゼクティブ、トップアスリートが身体と精神面に効果を感じるヨガを東京・大阪にて定期開催中！1クラス2500円のお手頃価格でヨガ初心者でも安心して参加可能！">';
        echo "\n";
    }elseif(is_archive()){
        if (( get_post_type() == 'magazine')){
            $obj = get_post_type_object('magazine');
            echo '<meta name="description" content="'.$obj->description.'">';
            echo "\n";
        }elseif(is_tax('tag_event_var')){
            $term = org_term_obj();
            $taxname = 'tag_event_var';
            $term_idsp = $taxname . '_' . esc_html($term->term_id);
            $area_id = get_field('holding_area',$term_idsp);
            $area = get_term($area_id);
            $date = get_field('holding_date',$term_idsp);
            $studio_tax = 'tax_event_studio';
            $studio_id = get_field('holding_studio',$term_idsp);
            $studio = get_term($studio_id);
            $weekday = array( '日', '月', '火', '水', '木', '金', '土' );
            echo '<meta name="description" content="'.date("Y年m月d日",strtotime($date)).'（'.$weekday[date( 'w',strtotime( $date ) )].'曜）に'.$area->name.'で開催される'.$term->name.'『ベータヨガトレーニング』は男性限定のヨガイベント！参加したいクラスを選択してヨガの効果を実感してください。'.str_replace('｜',' ',$studio->name).'でお待ちしています。">';
            echo "\n";
        }
    }elseif(is_category()){
        
    }elseif(is_page() || is_single()){
        $p = get_post(get_the_ID());
        $content = strip_shortcodes( $p->post_content );
        echo '<meta name="description" content="' .wp_html_excerpt($content, 140, '...'). '">';
        echo "\n";
    }else{
        
    }
}

endif;

if(!function_exists('org_title_fix')):
//wp_titleの$sepが空文字または半角スペースの場合は余分な空白削除
function org_title_fix($title, $sep, $seplocation){
    if(!$sep || $sep == " "){
        $title = str_replace(' '.$sep.' ', $sep, $title);
    }
    return $title;
}
add_filter('wp_title', 'org_title_fix', 10, 3);
endif;
/*
if(!function_exists('org_custom_post_thumbnail')):
// post_thumbnailにitemprop="image"を追加する
function org_custom_post_thumbnail($html){
    return str_replace('&lt;img','&lt;img itemprop="image"',$html);
}
add_filter('post_thumbnail_html','org_custom_post_thumbnail',10,5); 
endif;

if(!function_exists('org_img_additemprop')):
// imgタグにitemprop="image"を追加する 
function org_img_additemprop($html){
    return str_replace('/&gt;','itemprop="image"/&gt;',$html);
}
add_filter('get_image_tag','org_img_additemprop', 10, 5);
endif;
*/
?>