<?php
/*
 * Template Name: 日程検索
 */

$str = '-1 month'; //-1 month など設定可能
$start = date('Ym01',strtotime($str));
$end = date('Ymt',strtotime('+1 year'));

$date1=strtotime($end);
$date2=strtotime($start);
$month1=date("Y",$date1)*12+date("m",$date1);
$month2=date("Y",$date2)*12+date("m",$date2);

$diff = $month1 - $month2;

/*
$args = array(
    'posts_per_page' =>'-1',
    'post_type' => 'class',
    'post_status' => 'publish',
    //'orderby' => 'meta_value',
    //'order' => 'ASC',
    'post__in' => $postArray,

    'meta_query' => array(
        'relation' => 'AND',
        array(
            'value' => date("Ymd",strtotime("now")),  // 現在の日付
			'key' => 'class_start', // 比較するmeta_key
			'compare' => '>=', // '!='、'>'、'>='、'<'、'='
			'type' => 'NUMERIC', // ’NUMERIC’(数値)、’BINARY’(バイナリ)、’CHAR’(文字列)、’DATE’(日付)、’DATETIME’(日時)、’DECIMAL’(少数)、’SIGNED’(符号付き整数)、’TIME’(時間)、’UNSIGNED’(符号なし整数)
        ),
        array(
			'value' => date("Ymt",strtotime("now")),  // 現在の日付を基準に末日
			'key' => 'class_start', // 比較するmeta_key
			'compare' => '<=', // '!='、'>'、'>='、'<'、'='
			'type' => 'NUMERIC', // ’NUMERIC’(数値)、’BINARY’(バイナリ)、’CHAR’(文字列)、’DATE’(日付)、’DATETIME’(日時)、’DECIMAL’(少数)、’SIGNED’(符号付き整数)、’TIME’(時間)、’UNSIGNED’(符号なし整数)
		),
    ),
);
*/
//$the_query = new WP_Query( $args );

$dataArray = org_Query();
get_header(); ?>
<section id="main" class="container">
    <div class="row">
        
        <div id="sidebar" class="col-md-4 pull-right hidden-xs" role="complementary">
            <div class="sidebar-inner">
                <aside class="widget-area">
                    <?php dynamic_sidebar('sidebar');?>
                </aside>
            </div>
        </div> <!-- #sidebar -->
        
        <div class="site-content col-md-8">
            <header class="page-header">
                <h1 class="page-title"><?php wp_title(' '); ?></h1>
            </header> <!-- .page-header -->
        </div>
        <nav class="schedule-nav col-md-8">
            <ul class="slider-nav">
            <?php for($i=0;$diff > $i;$i++){ ?>
                <li><?php echo date('n',strtotime("+".$i." month",strtotime($str))) ?>月</li>
            <?php } ?>
            </ul>
        </nav>
        <div class="site-content slider-for col-md-8" role="main">
            <?php
                for($i=0;$diff > $i;$i++){
                    if($i == 1){
                        echo '<div class="row schedule-'.date('n',strtotime("+".$i." month",strtotime($str))).' display" data-schedule="'.date('Ym',strtotime("+".$i." month",strtotime($str))).'">';
                        foreach($dataArray as $dataKey => $dataValue){
                            echo $dataValue;
                        }
                    }else{
                        echo '<div class="row schedule-'.date('n',strtotime("+".$i." month",strtotime($str))).'" data-schedule="'.date('Ym',strtotime("+".$i." month",strtotime($str))).'">';
                        echo '<div class="loading"><img src="'.get_template_directory_uri().'/images/loading.gif" alt="loading"><p>読み込み中</p></div>';
                    }
                    echo '</div>';
                }
            ?>
            
        </div> <!-- #content -->

        <?php //get_ad_page(); ?>
        
        <div id="sidebar" class="col-xs-12 visible-xs-block" role="complementary">
            <div class="sidebar-inner">
                <aside class="widget-area">
                    <?php dynamic_sidebar('sidebar');?>
                </aside>
            </div>
        </div> <!-- #sidebar -->

    </div> <!-- .row -->
</section> <!-- .container -->
<?php get_footer();