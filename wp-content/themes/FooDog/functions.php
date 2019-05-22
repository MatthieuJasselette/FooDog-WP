<?php
/*** THe right way to add a css file or script */
function wpdocs_theme_name_scripts() {
  wp_register_style(‘main-style’, get_template_directory_uri().’/style.css’, array(), true);
  wp_enqueue_style(‘main-style’);
  wp_register_style(‘bootstrap-style’, "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js", array(), true);
  wp_enqueue_style(‘bootstrap-style’);
}
// add_action( ‘wp_enqueue_scripts’, ‘wpdocs_theme_name_scripts’ );
