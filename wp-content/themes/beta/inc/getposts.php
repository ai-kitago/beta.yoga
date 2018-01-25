<?php
/*
 Version: 1.0
Author: Yuki Yoshikawa
Author URI: http://www.cona.bz/
License: GPLv2 or later
*/
require_once("../../../../wp-config.php");
//require_once('inc/dataClass.php');
//include 'inc/argsClass.php';
//--------------------------------------------------
//レスポンスヘッダーを設定
//--------------------------------------------------
header("Content-Type: application/json; charset=utf-8");

//--------------------------------------------------
//POSTされたデータを変数に格納
//--------------------------------------------------
$schedule = $_REQUEST['schedule'].'01';
/*
$args = array(
    'posts_per_page' =>'-1',
    'post_type' => 'class',
    'post_status' => 'publish',
    'orderby' => 'meta_value',
    'order' => 'ASC',
    'meta_query' => array(
        'relation' => 'AND',
        array(
            'value' => date("Ymd",strtotime($schedule)),  // 現在の日付
			'key' => 'start_date', // 比較するmeta_key
			'compare' => '>=', // '!='、'>'、'>='、'<'、'='
			'type' => 'NUMERIC', // ’NUMERIC’(数値)、’BINARY’(バイナリ)、’CHAR’(文字列)、’DATE’(日付)、’DATETIME’(日時)、’DECIMAL’(少数)、’SIGNED’(符号付き整数)、’TIME’(時間)、’UNSIGNED’(符号なし整数)
        ),
        array(
			'value' => date("Ymt",strtotime($schedule)),  // 現在の日付を基準に末日
			'key' => 'start_date', // 比較するmeta_key
			'compare' => '<=', // '!='、'>'、'>='、'<'、'='
			'type' => 'NUMERIC', // ’NUMERIC’(数値)、’BINARY’(バイナリ)、’CHAR’(文字列)、’DATE’(日付)、’DATETIME’(日時)、’DECIMAL’(少数)、’SIGNED’(符号付き整数)、’TIME’(時間)、’UNSIGNED’(符号なし整数)
		),
    ),
);
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) :
    while ( $the_query->have_posts() ) : $the_query->the_post();
        get_template_part( 'post-format/content','class');
    endwhile;
endif;
*/
$dataArray = org_Query();
foreach($dataArray as $dataKey => $dataValue){
    echo $dataValue;
}
exit;
?>