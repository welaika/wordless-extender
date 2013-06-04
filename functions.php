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

  echo '<div id="message" class="' . $class . '"><p>' . $message . '</p></div>';
}  
