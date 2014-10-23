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






// remove Folders (recursive) and Files
function deleteDirAndFile($dirPath){
  if (is_dir($dirPath)) {
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (is_dir($file)) {
            deleteDir($file);
        } else {
            unlink($file);
        }
    }
    rmdir($dirPath);
  } else {
    unlink($dirPath);
  }
}

/**
 * Remove scripts version (js & css)
 */
function remove_ver_scripts($src){
  if ( strpos( $src, 'ver=' ) )
    $src = remove_query_arg( 'ver', $src );
  return $src;
}

/*
 * Settings
 */

function get_values(){
  $get['key'] = 'access';
  $get['value'] = 'allow';
  $get['url'] = get_bloginfo('url') ."/error-404";
  return $get;
}

/**
 * Add key to wp-login url
 */

function add_key_to_url($url, $redirect='0'){
  $get = get_values();
  if ($url)
    return add_query_arg($get['key'], $get['value'], $url);
}

/**
 * Block access to wp-login.php, wp-admin/
 * only for guest users
 */

function block(){
  // block works  only for guest users
  if (!is_user_logged_in()){
    $get = get_values();
    if ((($_SERVER['PHP_SELF'] == '/wp-login.php') || ($_SERVER['PHP_SELF'] == '/admin')) && (!isset($_GET[$get['key']]) || ($_GET[$get['key']] != $get['value']))){
      echo "qui";
      // set 404 header and redirect to home site
      header("HTTP/1.1 404 File not found");
      header("location:". $get['url']);
    }
  }
}
