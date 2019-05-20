<?php
 $madarlite_args = array(
 	'type'            => 'post',
    'orderby'         => 'post_date',
    'order'           => 'DESC',
    'post_status'     => 'publish',
	'ignore_sticky_posts'=> 1,
	'posts_per_page'  => 4,
	'suppress_filters' => true );
				$madarlite_query = new WP_Query( $madarlite_args );	
				if ( $madarlite_query->have_posts() ) {
				?>
				<section class="one-column section">
                <div class="home-box">
				<div class="home-box-header">
						<h2><?php _e('Recent Posts', 'madar-lite'); ?></h2>						
				<div class="clearfix"></div></div>
				<?php while ( $madarlite_query->have_posts() ) : $madarlite_query->the_post(); ?>
                     <div class="recentbox">
					 <?php madarlite_colored_category(); ?>
					<div class="slidy-copy">
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>	
						<p class="post-meta">
							<i class="fa fa-clock-o"></i><?php the_time('F j, Y'); ?>
							<?php echo madarlite_getcomment_count(get_the_ID()); ?>
						 </p>
					</div>
					 <a href="<?php the_permalink();?>" class="post-thumbnail">
						<?php echo madarlite_thumbnail('recent'); ?>
                     </a>

                <?php endwhile;?></div>
                </div> 
				</section>
                <?php }
				wp_reset_postdata();
?>