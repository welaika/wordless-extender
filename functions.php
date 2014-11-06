<?php

/**
 * Generic function to show a message to the user using WP's
 * standard CSS classes to make use of the already-defined
 * message colour scheme.
 *
 * @param $message
 *    The message you want to tell the user.
 * @param $is_error
 *    If true, the message is an error, so use the red message style. If false,
 *    the message is a status message, so use the yellow information message
 *    style.
 */
function wle_show_message($message, $is_error = false) {
  $class = ($is_error) ? "error" : "updated fade";

  if (empty($message))
    return false;
  echo '<div id="message" class="' . $class . '"><p>' . $message . '</p></div>';
}


// Enqueue constants javascript
function wle_constants_scripts(){
  wp_register_script("wle_constants", WordlessExtender::$url ."/javascripts/constants.js", 'jquery', false, true);
  wp_enqueue_script("wle_constants");
}

add_action('admin_enqueue_scripts', 'wle_constants_scripts' );

// Enqueue WLE stylesheets
function wle_stylesheets(){
  wp_register_style("wle_style", WordlessExtender::$url ."/stylesheets/wordless-extender.css");
  wp_enqueue_style("wle_style");
}

add_action('admin_enqueue_scripts', 'wle_stylesheets' );
