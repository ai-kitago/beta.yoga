<?php
/*
 * Template Name: Frontpage
 */

get_header(); 
?>

<section id="reserved" class="page-wrapper gray">
	<div class="container">
		<div class="row">
		<div class="col-sm-8 col-xs-12">
			<h2><?php echo get_field('obi-label',get_the_ID()); ?></h2>
			<img src="<?php echo get_stylesheet_directory_uri().'/images/reserved-image-text.png'; ?>">
			<p>※お申込み受付中！人数制限がございますのでお申込みはお早めに。</p>
		</div>
		<div class="col-sm-4 col-xs-12">
			<a href="<?php echo get_field('obi-link',get_the_ID()); ?>" target="_blank" class="button button-orange">お申し込み</a>
		</div>
		</div>
	</div>
</section>

<section id="class" class="page-wrapper gray">
	<div class="container">
		<div class="title-area">
			<h2 class="title"><img src="<?php echo get_stylesheet_directory_uri().'/images/front/front-class-h2.gif'; ?>" alt="目的・効果にあわせて選べる5クラス"></h2>
			<p class="subtitle">ベータヨガでは、肉体改造、意識改革、生活改善、精神強化など様々な目的・効果に合わせたヨガクラスを用意しております。</p>
		</div>
		<div class="row page-content">
			<ul class="tab nav nav-tabs">
			<?php
			
				// 最新のn個を取得
				$num = 2; //設定
				$taxname = 'tag_event_var';
				$termArray = array();
				$terms = get_terms($taxname);
				$i = 1;
				$tab = 1;
				$cnt = count($terms) - $num;
				$arr_i = 1;

				foreach($terms as $term){
					//if($arr_i != 1){
						if($cnt < $i){
							$term_idsp = $taxname . '_' . esc_html($term->term_id);
							$area_id = get_field('holding_area',$term_idsp);
							$area = get_term($area_id);
							$date = get_field('holding_date',$term_idsp);

							echo '<li><a href="#tab'.$tab.'">';
							echo $term->name.'【'.$area->name.'】<span class="hidden-xs">'.date("Y年m月d日",strtotime($date)).'</span>';
							echo '</a></li>';
							$termArray[$tab] = $term->term_id;
							$slugArray[$tab] = $term->slug;
							$tab++;
						}
						$i++;
					//}
					//$arr_i++;
				}
			?>
			</ul>
			<?php
				for($tab=1;$tab <= $num;$tab++){
					$args = array(
						//'posts_per_page' => 5,
						'post_type' => 'event',
						'tax_query' => array(
							'relation' => 'AND',
							array(
								'taxonomy' => $taxname,
								'field' => 'id',
								'terms' => $termArray[$tab],
								'operator' => 'IN'
							)
						)
					);
					$the_query = new WP_Query( $args );
					// ループ
					$n = 1;
					if ( $the_query->have_posts() ) :
					echo '<div class="tab_area" id="tab'.$tab.'">';
					while ( $the_query->have_posts() ) : $the_query->the_post();
					
						// クラス設定取得
						$sets = get_field('class_set');
						for($i = 0;count($sets) > $i;$i++){
							if($sets[$i]['class_var'] == $termArray[$tab]){
								$set = $sets[$i];
								$start = org_timeChange($set['class_start']);
								$end = org_timeChange($set['class_end']);
							}
						}
					
						echo '<div class="col-md-4">';
							echo '<header class="entry-header">'; ?>
							
							<div class="entry-thumbnail">
								<?php if (has_post_thumbnail() && !post_password_required()) { ?>
									<a href="<?php echo get_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail('thumb-class', array('class' => 'img-responsive')); ?></a>
								<?php } else { ?>
									<a href="<?php echo get_permalink(); ?>" rel="bookmark"><img src="<?php echo get_stylesheet_directory_uri().'/images/no-thumbnail-01.png'; ?>" class="img-responsive"></a>
								<?php } ?>
							</div>
							<?php //} //.entry-thumbnail ?>
							<div class="entry-tag">
							<?php
								$tax = org_get_taxonomy('tax_event_purpose');
								echo '<a href="'.$tax['link'].'">'.$tax['name'].'</a>';
							?>
							</div>
							</header> <!--/.entry-header -->
							<?php echo '<a href="'.get_permalink().'" rel="bookmark">'; ?>
							<div class="class-set">
								<h3><?php echo get_the_title(); ?></h3>
								<ul>
									<li><p><span>講師：</span><?php echo org_get_category('name','tax_event_instructor'); ?></p>
									<li><p><span>時間：</span><?php echo $start; ?>～<?php echo $end; ?></p>
								</ul>
							</div>
							</a>
						</div>
					<?php
					$n++;
					endwhile;
					?>
						<div class="col-md-4">
							<div class="last-box">
								<div class="circle">
									<p>全<span><?php echo $n - 1; ?></span></p>
									<p>クラス</p>
								</div>
								<p class="">お客様の受けたいクラスを自由に<br>組み合わせて受講していただけます。</p>
								<a href="/training/version/<?php echo $slugArray[$tab]; ?>/" class="button button-active">タイムラインを確認</a>
							</div>
						</div>
					<?php
					echo '</div>';
					endif;
					// 投稿データをリセット
					wp_reset_postdata();
				}
			?>
		</div>
	</div>
</section>

<section id="concept" class="page-wrapper black">
	<div class="container">
		<div class="title-area">
			<h2 class="title"><img src="<?php echo get_stylesheet_directory_uri().'/images/front/front-character-h2.gif'; ?>" alt="BetaYogaの特徴"></h2>
			<p class="subtitle">ベータヨガは「男性が受けたくなる」をコンセプトにしたメンズヨガイベント。目的・効果から選んで、男性限定なので初心者でも安心してご参加いただけます。</p>
		</div>
		<div class="row page-content">
			<ul>
				<li class="col-sm-3 col-xs-6">
					<h3><img src="<?php echo get_stylesheet_directory_uri().'/images/concept/concept-image-01.png'; ?>" alt="男性限定"></h3>
					<p>男性ONLYのヨガクラス<br>だから、参加しやすい！</p>
				</li>
				<li class="col-sm-3 col-xs-6">
					<h3><img src="<?php echo get_stylesheet_directory_uri().'/images/concept/concept-image-02.png'; ?>" alt="初心者"></h3>
					<p>ヨガ未経者・カラダが<br>硬い方も大歓迎！</p>
				</li>
				<li class="col-sm-3 col-xs-6">
					<h3><img src="<?php echo get_stylesheet_directory_uri().'/images/concept/concept-image-03.png'; ?>" alt="効果"></h3>
					<p>目的別にヨガの効果を<br>体感できる！</p>
				</li>
				<li class="col-sm-3 col-xs-6">
					<h3><img src="<?php echo get_stylesheet_directory_uri().'/images/concept/concept-image-04.png'; ?>" alt="料金"></h3>
					<p>始めやすい、<br>リーズナブルな受講料！</p>
				</li>
			</ul>
		</div>
	</div>
</section>

<section id="toha" class="page-wrapper">
	<div class="container">
		<div class="title-area">
			<h2 class="title"><img src="<?php echo get_stylesheet_directory_uri().'/images/front/front-toha-h2.gif'; ?>" alt="なぜ今メンズがヨガ!?"></h2>
			<p class="subtitle">経営者・トップアスリート、できる男は既にやっている！ メンズが求める効果をもたらすヨガをベータヨガは提案します！</p>
		</div>
		<div class="page-content">
			<p>ヨガは本来、インドの王族や武士家系の若い男性だけが学ぶ事をゆるされたものだった。<br>
一人の女性の登場によりいつしか「女性もできるもの」になったヨガだが、<br>
現代では「女性がやるのもの」になっている。</p>

<p>しかし、本来男性の生活を支えてきたヨガの力を、<br>
現代を生きる男性が知らないまま暮らしていくのは<br>
なんとももったいないことではないだろうか？</p>

<p>事実、経営者やトップアスリート、各界の著名人、Google、Facebookなどの外資系企業など<br>
感度の高い人や結果を求める人たちは既にヨガや瞑想の効果を実感している。</p>

<p>肉体・精神・生活の向上などヨガがもたらす効果を知らずに<br>
「ヨガは女性のものだ」<br>
なんて言っていると気づけば時代遅れ。</p>

<p>周りが「ヨガ始めた」「ヨガ最高！」と言い出す前に、一歩リードしておきませんか？</p>
		</div>
	</div>
</section>

<section id="access" class="page-wrapper black">
	<div class="container">
		<div class="title-area">
			<h2 class="title"><img src="<?php echo get_stylesheet_directory_uri().'/images/front/front-access-h2.png'; ?>" alt="会場へのアクセス"></h2>
			<p class="subtitle">ベータヨガは東京では祐天寺、駒沢大学に位置するオハナスマイル ヨガスタジオ、大阪では本町に位置するヨガアカデミー大阪にて開催しております。</p>
		</div>
		<div class="row page-content">
			<div class="access-slider">
		<?php
			$taxname = 'tax_event_studio';
			$terms = get_terms($taxname,'get=all');
			foreach($terms as $term){
		?>
			<div id="studio-<?php echo $term->term_id; ?>" class="studio col-sm-4 col-xs-12">
				<header class="studio-header">
					<div class="studio-image">
						<a href="<?php echo org_get_category('studio_url',$taxname,$term->term_id); ?>" target="_blank"><img src="<?php echo org_get_category('studio_image',$taxname,$term->term_id); ?>" class="suck-image" itemprop="image"></a>
					</div>
				</header>
				<div class="studio-content">
					<div class="studio-name">
						<p><a href="<?php echo org_get_category('studio_url',$taxname,$term->term_id); ?>" target="_blank">
						<?php echo str_replace("｜", "<br />", $term->name); ?>
						<?php
							if(org_get_category('shop_name',$taxname,$term->term_id)){
								echo '<small>'.org_get_category('shop_name',$taxname,$term->term_id).'</small>';
							}
						?>
						</a></p>
					</div>
				</div>
				<footer class="studio-footer">
					<a href="tel:<?php echo str_replace(array('-', 'ー'), '',org_get_category('studio_tel',$taxname,$term->term_id)); ?>"><i class="fa fa-2x fa-phone"></i><?php echo org_get_category('studio_tel',$taxname,$term->term_id); ?></a>
					<a href="<?php echo org_get_category('studio_map',$taxname,$term->term_id); ?>" class="button button-orange" target="_blank">地図アプリで確認</a>
				</footer>
			</div>
		<?php } ?>
			</div>
		</div>
	</div>
</section>
<?php
$args = array();
$args = array(
	'posts_per_page' => 4,
	'post_type' => 'magazine',
	//'category_name' => 'blog,report,column'
);
$the_query = new WP_Query( $args );
?>
<?php if ( $the_query->have_posts() ){ ?>
<section id="news" class="page-wrapper gray">
	<div class="container">
		<div class="title-area">
			<h2 class="title"><img src="<?php echo get_stylesheet_directory_uri().'/images/front/front-provide-h2.gif'; ?>" alt="メンズヨガ情報配信"></h2>
			<p class="subtitle">ベータヨガのクラスレポートや講師インタビューをはじめ、メンズ向けヨガの最新情報、使えるノウハウを配信中。</p>
		</div>
		<div class="row page-content">
		<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			<div class="col-sm-3 col-xs-12">
				<header class="entry-header">
				<?php if ( has_post_thumbnail() && ! post_password_required() ) { ?>
					<div class="entry-thumbnail">
						<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail('blog-thumb', array('class' => 'img-responsive')); ?></a>
					</div>
				<?php } //.entry-thumbnail ?>
				</header> <!--/.entry-header -->
				<div class="media-body">
					<h6 class="publish-date">
						<time class="entry-date" datetime="<?php the_time( 'c' ); ?>"><?php the_time('Y年m月d日'); ?></time>
					</h6>
					<h3 class="entry-title">
						<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
						<?php if ( is_sticky() && is_home() && ! is_paged() ) { ?>
							<sup class="featured-post"><?php _e( 'Sticky', 'themeum' ) ?></sup>
						<?php } ?>
					</h3> <!-- //.entry-title -->
				</div>
			</div>
		<?php endwhile; ?>
		</div>
	</div>
</section>
<?php } ?>
<section id="company" class="page-wrapper black">
	<div class="container">
		<div class="title-area">
			<h2 class="title"><img src="<?php echo get_stylesheet_directory_uri().'/images/front/front-company-h2.png'; ?>" alt="会社概要"></h2>
			<p class="subtitle">ベータヨガはヨガ専門メディア「ヨガジェネレーション」やヨガウェアセレクトショップ「東京ヨガウェア2.0」、ヨガスタジオやヨガ専門の学校を運営する株式会社オハナスマイルが運営。</p>
		</div>
		<div class="row page-content">
			<?php echo do_shortcode('[table id=1 /]'); ?>
		</div>
	</div>
</section>

<?php get_ad_front(); ?>

<?php get_footer(); ?>