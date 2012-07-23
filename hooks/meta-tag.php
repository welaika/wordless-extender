<?php

// Remove the WordPress Generator Meta Tag
function we_edit_generator_filter() { return ''; }
if (function_exists('add_filter')) {
  $types = array('html', 'xhtml', 'atom', 'rss2', /*'rdf',*/ 'comment', 'export');

  foreach ($types as $type)
    add_filter('get_the_generator_' . $type, 'we_edit_generator_filter');
}
