<?php
/**
 * Cube Widget for this theme.
 *
 * @package yoga-gene.com
 */
add_action('widgets_init',
     create_function('', 'return register_widget("aD_Widget_Org");')
);
class Ad_Widget_Org extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'ad_widget_org', // Base ID
			__( 'Widget ad banner', 'ad_org' ), // Name
			array( 'description' => __( 'Widget ad banner', 'ad_org' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
/*
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}
*/
		$num   = ! empty( $instance['num'] ) ? $instance['num'] : 4;
		$pargs = array(
			'posts_per_page'   => $num,
			'post_type'        => 'ad-bnr',
			'post_status'      => 'publish',
			'tax_query' => array(
				array(
					'taxonomy' => 'tax_ad',
					'field'    => 'slug',
					'terms'    => 'sidebar',
				),
			),
		);
		$the_query = new WP_Query( $pargs );
		?>
		<?php if ( $the_query->have_posts() ) : ?>
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
				<?php
					// 画像
					$imageID = get_field( 'ad-banner' );
					$size    = 'widget-bnr';
					$image_attributes = wp_get_attachment_image_src( $imageID, $size );
					$alt = get_the_title();

					$link = "#";
					if ( get_field( 'ad-link' ) ) {
						$link = get_field( 'ad-link' );
					}
					
                    $target = "";
                    if ( get_field( 'ad-blank' ) ) {
                        $target = ' target="_blank"';
                    }
				?>
				<div class="item-image"><a href="<?php echo esc_url( $link ); ?>">
					<img src="<?php echo $image_attributes[0]; ?>" alt="<?php echo esc_attr( $alt ) ?>" width="<?php echo $image_attributes[1]; ?>" height="<?php echo $image_attributes[2]; ?>"<?php echo $target; ?>/>
				</a></div>
			<?php endwhile; ?>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
		
		<?php
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'バナー ウィジェット', 'ad_org' );
		$num   = ! empty( $instance['num'] ) ? $instance['num'] : 3;
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'num' ); ?>"><?php _e( '表示数:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'num' ); ?>" name="<?php echo $this->get_field_name( 'num' ); ?>" type="text" value="<?php echo esc_attr( $num ); ?>">
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['num'] = ( ! empty( $new_instance['num'] ) ) ? strip_tags( $new_instance['num'] ) : 3;

		return $instance;
	}

} // Yoga_Cube_A_Widget

/**
 * Cube Widget for this theme.
 *
 * @package yoga-gene.com
 */
add_action('widgets_init',
     create_function('', 'return register_widget("aD_Widget_sidebar_b");')
);
class Ad_Widget_Sidebar_B extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'ad_widget_sidebar_b', // Base ID
			__( 'Widget ad sidebar B', 'ad_sidebar_b' ), // Name
			array( 'description' => __( 'Widget ad banner B', 'ad_sidebar_b' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
/*
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}
*/
		$num   = ! empty( $instance['num'] ) ? $instance['num'] : 4;
		$pargs = array(
			'posts_per_page'   => $num,
			'post_type'        => 'ad-bnr',
			'post_status'      => 'publish',
			'tax_query' => array(
				array(
					'taxonomy' => 'tax_ad',
					'field'    => 'slug',
					'terms'    => 'sidebar-b',
				),
			),
		);
		$the_query = new WP_Query( $pargs );
		?>
		<?php if ( $the_query->have_posts() ) : ?>
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
				<?php
					// 画像
					$imageID = get_field( 'ad-banner' );
					$size    = 'widget-bnr';
					$image_attributes = wp_get_attachment_image_src( $imageID, $size );
					$alt = get_the_title();

					$link = "#";
					if ( get_field( 'ad-link' ) ) {
						$link = get_field( 'ad-link' );
					}
					
                    $target = "";
                    if ( get_field( 'ad-blank' ) ) {
                        $target = ' target="_blank"';
                    }
				?>
				<div class="item-image"><a href="<?php echo esc_url( $link ); ?>">
					<img src="<?php echo $image_attributes[0]; ?>" alt="<?php echo esc_attr( $alt ) ?>" width="<?php echo $image_attributes[1]; ?>" height="<?php echo $image_attributes[2]; ?>"<?php echo $target; ?>/>
				</a></div>
			<?php endwhile; ?>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
		
		<?php
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'バナー ウィジェット', 'ad_org' );
		$num   = ! empty( $instance['num'] ) ? $instance['num'] : 3;
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'num' ); ?>"><?php _e( '表示数:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'num' ); ?>" name="<?php echo $this->get_field_name( 'num' ); ?>" type="text" value="<?php echo esc_attr( $num ); ?>">
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['num'] = ( ! empty( $new_instance['num'] ) ) ? strip_tags( $new_instance['num'] ) : 3;

		return $instance;
	}

} // Yoga_Cube_A_Widget