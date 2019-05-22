  <!-- snip header.php -->
  <?php get_header(); ?>
      <div class="row">
        <div class="col-sm-8 blog-main">
          <!-- snip content.php -->
          <?php
            if ( have_posts() ) : while ( have_posts() ) : the_post();
              get_template_part( 'content', get_post_format() );
            endwhile; ?>

              <nav>
              <ul class="pager">
                <li><?php next_posts_link( 'Previous' ); ?></li>
                <li><?php previous_posts_link( 'Next' ); ?></li>
              </ul>
            </nav>
          <?php
          endif;
          ?>
        </div><!-- /.blog-main -->
        <!-- snip sidebar.php -->
        <?php get_sidebar(); ?>
      </div><!-- /.row -->
  <!-- snip footer.php -->
  <?php get_footer(); ?>
