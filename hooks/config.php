<?php

# Remove theme editor
// http://wpmututorials.com/plugins/disabling-the-plugintheme-editor-3-0/
define( 'DISALLOW_FILE_EDIT', true );

# Make WP use 'direct' dowload method for install/update
// http://stackoverflow.com/questions/640409/can-i-install-update-wordpress-plugins-without-providing-ftp-access/#5650020
define('FS_METHOD', 'direct');
