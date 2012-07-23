<?php

// Remove WP update notifications
add_action( 'init', 'we_remove_update_notifications' );
function we_remove_update_notifications() {
  if ( !current_user_can('administrator') ) {
    add_action( 'init', function($a) { remove_action('init', 'wp_version_check'); }, 2 );
    add_filter( 'pre_option_update_core', function($a) { return null; } );
  }
}
// Remove WP visual feedback for updates in admin
add_action( 'admin_head', 'we_remove_update_feedback' );
function we_remove_update_feedback() {
    ?>
    <style type="text/css" media="screen">
      /*a[href="update-core.php"],*/
      .update-nag,
      span#wp-version-message a.button,
      span.update-plugins,
      div.update-message {
        display: none !important;
      }
    </style>
<?php }
// Remove WP visual feedback for updates in admin bar
add_action( 'wp_before_admin_bar_render', 'we_admin_bar_remove_update_notifications' ); 
function we_admin_bar_remove_update_notifications() {
  global $wp_admin_bar;
  $wp_admin_bar->remove_menu('updates');
}
