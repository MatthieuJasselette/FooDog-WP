<?php
add_action( 'widgets_init', 'madarlite_slider_widget' );
function madarlite_slider_widget() {
	register_widget( 'madarlite_slider' );
}
class madarlite_slider extends WP_Widget {

	function madarlite_slider() {
		$widget_ops = array( 'classname' => 'widget_featured_posts widget_featured_meta', 'description' =>__( 'Display Posts Slider of specific category.' , 'madar-lite') );
		$control_ops = array( 'width' => 200, 'height' =>250 );
		parent::__construct( false,$name= __( 'Madar Lite: Slider', 'madar-lite' ),$widget_ops);
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$no_of_posts 	= $instance['no_of_posts'];
		$cats_id 		= $instance['cats_id'];

		global $post;
		$original_post = $post;

		$argss 			= array('posts_per_page'=> $no_of_posts , 'cat' => $cats_id, 'no_found_rows' => 1 );
		$featured_query = new WP_Query( $argss );
		
	if( $featured_query->have_posts() ) : ?>
		<div id="sldiery-container">
			<ul id="sldiery">
			<?php while ( $featured_query->have_posts() ) : $featured_query->the_post()?>
				<li class="slidy">
					<div class="slidy-copy">
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>	
						<p class="post-meta">
							<i class="fa fa-clock-o"></i><?php the_time('F j, Y'); ?>
							<?php echo madarlite_getcomment_count(get_the_ID()); ?>
						 </p>
					</div>
					<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>			
				<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'madar-small-box-thumbnail' ); ?>
				</a>
			<?php endif; ?>
				</li>
            <?php endwhile;?>
			</ul>
		</div>
	<?php endif;

	$post = $original_post;
	wp_reset_postdata();
	?>

	<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance 						= $old_instance;
		$instance['cat_posts_title'] 	= strip_tags( $new_instance['cat_posts_title'] );
		$instance['no_of_posts'] 		= strip_tags( $new_instance['no_of_posts'] );

		$instance['cats_id'] 			= implode(',' , $new_instance['cats_id']  );

		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'no_of_posts' => '5' , 'cats_id' => '1' );
		$instance = wp_parse_args( (array) $instance, $defaults );
		
		$categories_obj = get_categories();
		$categories 	= array();

		foreach ($categories_obj as $pn_cat) {
			$categories[$pn_cat->cat_ID] = $pn_cat->cat_name;
		}

		global $post;
		$original_post = $post;
		
		$sliders = array();
		
		$post = $original_post;
		wp_reset_postdata();
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'no_of_posts' ); ?>"><?php _e( 'Number of posts to show:' , 'madar-lite') ?> </label>
			<input id="<?php echo $this->get_field_id( 'no_of_posts' ); ?>" name="<?php echo $this->get_field_name( 'no_of_posts' ); ?>" value="<?php if( !empty($instance['no_of_posts']) ) echo $instance['no_of_posts']; ?>" type="text" size="3" />
		</p>
		<p>
			<?php $cats_id = explode ( ',' , $instance['cats_id'] ) ; ?>
			<label for="<?php echo $this->get_field_id( 'cats_id' ); ?>"><?php _e( 'Category:' , 'madar-lite') ?></label>
			<select multiple="multiple" id="<?php echo $this->get_field_id( 'cats_id' ); ?>[]" name="<?php echo $this->get_field_name( 'cats_id' ); ?>[]">
				<?php foreach ($categories as $key => $option) { ?>
				<option value="<?php echo $key ?>" <?php if ( in_array( $key , $cats_id ) ) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
				<?php } ?>
			</select>
		</p>
	<?php
	}
}
?>