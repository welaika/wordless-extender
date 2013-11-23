<?php

function _wle_calculate_slug($plugin) {
  if (strpos($plugin, '/'))
    $slug = dirname($plugin);
  else
    $slug = str_replace(' ', '-', strtolower($plugin));
  
  return $slug;
}

$pluginlist = WordlessExtender::$to_be_installed_plugins;
function _we_preprocess_to_be_installed($pluginlist) {
  foreach ($pluginlist as &$p) {
    if (!is_array($p)) {
      $p = array(
        "Name" => $p,
        "Slug" => _wle_calculate_slug($p)
      );
    }
  }

  usort($pluginlist, function($a, $b) {
    return strcmp($a['Name'], $b['Name']);
  });
}

function _we_preprocess_current_plugins(&$plugins) {
  foreach ($plugins as $path => &$i) {
    $i['Slug'] = _wle_calculate_slug($path);
    $i['Path'] = $path;
  }
  $plugins = array_values($plugins);
}

function _we_merge($to_be, $plugins) {
  $count_plugins = count($plugins);
  for ($i = 0; $i < $count_plugins; $i++) {
    $p = $plugins[$i];
    
    foreach ($to_be as &$value) {
      if ($value['Slug'] == $p['Slug']) {
        $value = $p;
      }
    }
    
  }

  return $to_be;
}
