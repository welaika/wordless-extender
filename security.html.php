<div class="wrap">
  <div id="icon-themes" class="icon32"><br></div>
  <h2>Security Fixes</h2>
  <div class="description">
    <p>
      Developed by <a href='http://dev.welaika.com'>weLaika</a>.
    </p>
  </div>

    <form method="post">
    <table id="wordless-extender" class="wp-list-table widefat">
    <thead>
      <tr>
        <th class="action">Fix</th>
        <th class="description">Description</th>
        <th class="value">Value</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>.htaccess</td>
        <td>Make your .htaccess more solid. A backup is stored in .htaccess_backup</td>
        <td>
          <?php 
            $true_htaccess = '';
            $false_htaccess = '';
            if (get_option('htaccess_fix') == 'true') $true_htaccess = 'checked';
            elseif (get_option('htaccess_fix') == 'false') $false_htaccess = 'checked';
          ?>
          <input type="radio" name="htaccess_fix" value="false" <?php echo $false_htaccess ?>> False
          <input type="radio" name="htaccess_fix" value="true" <?php echo $true_htaccess ?>> True 
        </td>
      </tr>
      <tr>
        <td>Plugins and themes</td>
        <td>Remove default WordPress plugins and themes. <span style="color:red">Warning: you can't undo this action!</span></td>
        <td>
          <?php 
          if (!file_exists(WP_CONTENT_DIR .'/themes/twentyten')) $tw10 = 'disabled';
          else $tw10 = '';
          if (!file_exists(WP_CONTENT_DIR .'/themes/twentyeleven')) $tw11 = 'disabled';
          else $tw11 = '';
          if (!file_exists(WP_CONTENT_DIR .'/themes/twentytwelve')) $tw12 = 'disabled';
          else $tw12 = '';
          if (!file_exists(WP_CONTENT_DIR .'/plugins/hello.php')) $hello = 'disabled';
          else $hello = '';
          ?>
          <input type="checkbox" name="plugins_and_themes[]" value="<?php echo WP_CONTENT_DIR .'/themes/twentyten'; ?>" <?php echo $tw10; ?>> Theme: TwentyTen<br />
          <input type="checkbox" name="plugins_and_themes[]" value="<?php echo WP_CONTENT_DIR .'/themes/twentyeleven'; ?>" <?php echo $tw11; ?>> Theme: TwentyEleven<br />
          <input type="checkbox" name="plugins_and_themes[]" value="<?php echo WP_CONTENT_DIR .'/themes/twentytwelve'; ?>" <?php echo $tw12; ?>> Theme: TwentyTwelve<br />
          <input type="checkbox" name="plugins_and_themes[]" value="<?php echo WP_CONTENT_DIR .'/plugins/hello.php'; ?>" <?php echo $hello; ?>> Plugin: Hello Dolly
        </td>
      </tr>
      <tr>
        <td>XMLRPC</td>
        <td>Empty xmlrpc.php file. <span style="color:red">Warning: you can't undo this action!</span></td>
        <td>
         <input type="checkbox" name="xmlrpc" value="<?php echo ABSPATH .'xmlrpc.php'; ?>"> Sure?
        </td>
      </tr>
      <tr>
        <td>README</td>
        <td>Empty readme.html file. <span style="color:red">Warning: you can't undo this action!</span></td>
        <td>
         <input type="checkbox" name="readme" value="<?php echo ABSPATH .'readme.html'; ?>"> Sure?
        </td>
      </tr>
      <tr>
        <td>DEBUG</td>
        <td>Enable or disable WP_DEBUG. <strong>If "All" option is selected enable all error reporting 
          <br />and write a log file (error.log), if "All with GET" option is selected it works <span style="color:red">everytime</span> you pass via GET <span style="color:red">?debug=debug</span>.</strong><br />Will be created a backup file in wp-config-backup.php</td>
        <td>
          <?php 
            $false_debug = '';
            $true_debug = '';
            $all_debug = '';
            $custom_debug = '';
            if (get_option('debug') == 'false') $false_debug = 'checked';
            elseif (get_option('debug') == 'true') $true_debug = 'checked';
            elseif (get_option('debug') == 'all') $all_debug = 'checked';
            elseif (get_option('debug') == 'custom') $custom_debug = 'checked';
          ?>
          <input type="radio" name="debug" value="false" <?php echo $false_debug; ?>> False
          <input type="radio" name="debug" value="true" <?php echo $true_debug; ?>> True<br />
          <input type="radio" name="debug" value="all" <?php echo $all_debug; ?>> All
          <input type="radio" name="debug" value="custom" <?php echo $custom_debug; ?>> All with GET 
        </td>
      </tr>
      <tr>
        <td>Meta infos</td>
        <td>Remove Wordpress meta info from header and feeds.</td>
        <td>
          <?php 
            $true_rmmetas = '';
            $false_rmmetas = '';
            if (get_option('rmmetas') == 'true') $true_rmmetas = 'checked';
            elseif (get_option('rmmetas') == 'false') $false_rmmetas = 'checked';
          ?>
          <input type="radio" name="rmmetas" value="false" <?php echo $false_rmmetas ?>> False
          <input type="radio" name="rmmetas" value="true" <?php echo $true_rmmetas ?>> True 
        </td>
      </tr>
    </table>
    <p class="submit">
      <input type="submit" name="submit" id="submit" class="button-primary" value="Save security fixes">
    </p>
  </form>
</div>
