<?php

/*
  Administration page
 */
function wle_admin_actions() {  
  global $plugin_dir, $plugin_url;
  
  // check if Wordless is already active
  if (is_plugin_active('wordless/wordless.php')){

    add_submenu_page( 
      'wordless', 
      'Plugin Manager',
      'Plugin Manager', 
      'install_plugins', 
      'plugin_manager', 
      'wle_plugin_manager' 
    );
  } elseif (!is_plugin_active('wordless/wordless.php')){
     add_menu_page( 
      'Wordless',
      'Wordless',
      'install_plugins',
      'wordless-extender',
      'wle_plugin_manager',
      $plugin_url . '/images/welaika.16x16.png',
      59
    ); 
  }  
}  

add_action('admin_menu', 'wle_admin_actions', 10);

// Plugin Manager
function wle_plugin_manager() {
  global $plugin_dir, $plugin_url;

  require_once $plugin_dir . 'functions.admin.php';

  # add thickbox
  wp_enqueue_script('thickbox', null, array('jquery'));
  wp_enqueue_style('thickbox.css', '/' . WPINC . '/js/thickbox/thickbox.css', null, '1.0');
  wp_enqueue_style('wp-admin.css', '/' . WPINC . '/css/wp-admin.css', null, '1.0');

  # get plugin which we'd like to install ( 'interesting' plugins )
  global $wle_to_be_installed_plugins;
  # for each plugin create an array of name => slug
  _we_preprocess_to_be_installed($wle_to_be_installed_plugins);
  // echo "<pre>", var_dump($wle_to_be_installed_plugins)< "</pre>";
  
  # get all installed plugin
  $plugins = get_plugins();
  // echo "<pre>", var_dump($plugins)< "</pre>";
  
  # add Slug and Path to plugin array items
  _we_preprocess_current_plugins($plugins);
  // echo "<pre>", var_dump($plugins), "</pre>";

  $wle_to_be_installed_plugins = _we_merge($wle_to_be_installed_plugins, $plugins);
  // echo "<pre>", var_dump($wle_to_be_installed_plugins)< "</pre>";

  $plugin_data = array();
  foreach ($wle_to_be_installed_plugins as $value) {
    $plug = array(
      'status' => 'Not installed',
      'name' => 'Unknown',
      'version' => 'Unknown',
      'install' => NULL,
      'activate' => NULL,
      'deactivate' => NULL,
      'delete' => NULL,
      'details' => NULL,
    );

    # the current status of the plugin: Active, Not active, Not installed
    $plug['status'] = 
      (in_array($value['Slug'], array_map(function($i) { return $i['Slug']; }, $plugins)))
      ? ((is_plugin_active($value['Path']))
        ? 'Active'
        : 'Not active')
      : 'Not installed';

    # plugin readable name
    $plug['name'] = $value['Name'];

    # version ( if installed )
    if ($plug['status'] != 'Not installed') {
      $plug['version'] = $value['Version'];
    }

    $plugin_url_common = '&plugin_status=all&paged=1&s';

    # build link for installation    
    $plug['install'] = wle_SITE_URL . '/wp-admin/' . wp_nonce_url(
        'update.php?action=install-plugin&amp;plugin=' . $value['Slug'], 
        'install-plugin_' . $value['Slug']);

    if ($plug['status'] != 'Not installed') {
      $plug ['upgrade'] = wle_SITE_URL . '/wp-admin/' . wp_nonce_url(
        'update.php?action=upgrade-plugin&plugin=' . $value['Slug'], 
        'upgrade-plugin_' . $value['Slug'] );

      $plug['activate'] = wle_SITE_URL . '/wp-admin/' .  wp_nonce_url(
        'plugins.php?action=activate&plugin=' . $value['Path'] . $plugin_url_common, 
        'activate-plugin_' . $value['Path']);

      $plug['deactivate'] = wle_SITE_URL . '/wp-admin/' .  wp_nonce_url(
        'plugins.php?action=deactivate&plugin=' . $value['Path'] . $plugin_url_common, 
        'deactivate-plugin_' . $value['Path']);

      $plug['delete'] = wle_SITE_URL . '/wp-admin/' .  wp_nonce_url(
        'plugins.php?action=delete-selected&amp;checked[]=' . $value['Path'] . $plugin_url_common,
        'bulk-plugins');
    }
    
    if ($plug['status'] == 'Not installed'){
      $plug ['upgrade'] = '';
    }

    $plug['details'] = PMW_SITE_URL . '/wp-admin/' .  'plugin-install.php?tab=plugin-information&amp;plugin=' . $value['Slug'] . '&amb;TB_iframe=true&amb;width=600&amb;height=550';

    // echo "<pre>", var_dump($plug), "</pre>";
    $plugin_data[] = $plug;
  }
  // echo "<pre>", var_dump($plugin_data), "</pre>";

  // include HTML template
  include "plugins.html.php";
}
