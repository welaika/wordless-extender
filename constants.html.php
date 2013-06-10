<?php 
  
?>
<!-- style for generate button -->
<style type="text/css">
  a.generate{
    background-color: lightgray;
    border: 1px solid darkgray;
    color: black;
    float: right;
    padding: 2px 10px;
  }
  a.generate:hover{
    cursor: pointer;
    background-color: darkgray;
    color: white;
  }
</style>

<div class="wrap">
  <div id="icon-themes" class="icon32"><br></div>
  <h2>Config Constants</h2>
  <div class="description">
    <p>
      Developed by <a href='http://dev.welaika.com'>weLaika</a>.
    </p>
    <p>
      You WordPress wp-config.php has a bounch of constants that you absolutely don't want to forget! <br />
      Someone are security related, others a utility. You can discover and manage them directly within this panel.

      At every update of the configuration, a wp-config-backup.php with previous config version will be created as your personal parachute.

      Use the power with care! ;)
    </p>
  </div>


  <h3>Constants list</h3>
  <form method="post">
    <table id="wordless-extender" class="wp-list-table widefat">
    <thead>
      <tr>
        <th class="constant">Constant Name</th>
        <th class="description">Description</th>
        <th class="value">Value</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>WP_SITEURL</td>
        <td>define the WP_SITEURL. </td>
        <td><input type="text" name="WP_SITEURL" value="<?php echo get_option('WP_SITEURL'); ?>"></td>
      </tr>
      <tr>
        <td>AUTH_KEY</td>
        <td>define the AUTH_KEY. Here to generate it: <a href="https://api.wordpress.org/secret-key/1.1/salt/">https://api.wordpress.org/secret-key/1.1/salt/</a><a data-target="input[name='AUTH_KEY']" class="generate">Generate!</a></td>
        <td><input type="text" name="AUTH_KEY" value="<?php echo get_option('AUTH_KEY'); ?>"></td>
      </tr>
      <tr>
        <td>SECURE_AUTH_KEY</td>
        <td>define the SECURE_AUTH_KEY. Here to generate it: <a href="https://api.wordpress.org/secret-key/1.1/salt/">https://api.wordpress.org/secret-key/1.1/salt/</a><a data-target="input[name='SECURE_AUTH_KEY']" class="generate">Generate!</a></td>
        <td><input type="text" name="SECURE_AUTH_KEY" value="<?php echo get_option('SECURE_AUTH_KEY'); ?>"></td>
      </tr>
      <tr>
        <td>LOGGED_IN_KEY</td>
        <td>define the LOGGED_IN_KEY. Here to generate it: <a href="https://api.wordpress.org/secret-key/1.1/salt/">https://api.wordpress.org/secret-key/1.1/salt/</a><a data-target="input[name='LOGGED_IN_KEY']" class="generate">Generate!</a></td>
        <td><input type="text" name="LOGGED_IN_KEY" value="<?php echo get_option('LOGGED_IN_KEY'); ?>"></td>
      </tr>
      <tr>
        <td>NONCE_KEY</td>
        <td>define the NONCE_KEY. Here to generate it: <a href="https://api.wordpress.org/secret-key/1.1/salt/">https://api.wordpress.org/secret-key/1.1/salt/</a><a data-target="input[name='NONCE_KEY']" class="generate">Generate!</a></td>
        <td><input type="text" name="NONCE_KEY" value="<?php echo get_option('NONCE_KEY'); ?>"></td>
      </tr>
      <tr>
        <td>AUTH_SALT</td>
        <td>define the AUTH_SALT. Here to generate it: <a href="https://api.wordpress.org/secret-key/1.1/salt/">https://api.wordpress.org/secret-key/1.1/salt/</a><a data-target="input[name='AUTH_SALT']" class="generate">Generate!</a></td>
        <td><input type="text" name="AUTH_SALT" value="<?php echo get_option('AUTH_SALT'); ?>"></td>
      </tr>
      <tr>
        <td>SECURE_AUTH_SALT</td>
        <td>define the SECURE_AUTH_SALT. Here to generate it: <a href="https://api.wordpress.org/secret-key/1.1/salt/">https://api.wordpress.org/secret-key/1.1/salt/</a><a data-target="input[name='SECURE_AUTH_SALT']" class="generate">Generate!</a></td>
        <td><input type="text" name="SECURE_AUTH_SALT" value="<?php echo get_option('SECURE_AUTH_SALT'); ?>"></td>
      </tr>
      <tr>
        <td>LOGGED_IN_SALT</td>
        <td>define the LOGGED_IN_SALT. Here to generate it: <a href="https://api.wordpress.org/secret-key/1.1/salt/">https://api.wordpress.org/secret-key/1.1/salt/</a><a data-target="input[name='LOGGED_IN_SALT']" class="generate">Generate!</a></td>
        <td><input type="text" name="LOGGED_IN_SALT" value="<?php echo get_option('LOGGED_IN_SALT'); ?>"></td>
      </tr>
      <tr>
        <td>NONCE_SALT</td>
        <td>define the NONCE_SALT. Here to generate it: <a href="https://api.wordpress.org/secret-key/1.1/salt/">https://api.wordpress.org/secret-key/1.1/salt/</a><a data-target="input[name='NONCE_SALT']" class="generate">Generate!</a></td>
        <td><input type="text" name="NONCE_SALT" value="<?php echo get_option('NONCE_SALT'); ?>"></td>
      </tr>
      <tr>
        <td>WPLANG</td>
        <td>define the WPLANG. Here the WordPress languages: <a href="http://codex.wordpress.org/WordPress_in_Your_Language">http://codex.wordpress.org/WordPress_in_Your_Language</a></td>
        <td><input type="text" name="WP_LANG" value="<?php echo get_option('WP_LANG'); ?>"></td>
      </tr>
      <tr>
        <td>DISALLOW_FILE_EDIT</td>
        <td>define the DISALLOW_FILE_EDIT. If TRUE you can't edit files in the WordPress backend.</td>
        <td>
          <?php 
            $true_disallowfileedit = '';
            $false_disallowfileedit = '';
            if (get_option('DISALLOW_FILE_EDIT') == 'true') $true_disallowfileedit = 'checked';
            elseif (get_option('DISALLOW_FILE_EDIT') == 'false') $false_disallowfileedit = 'checked';
          ?>
          <input type="radio" name="DISALLOW_FILE_EDIT" value="true" <?php echo $true_disallowfileedit ?>> True 
          <input type="radio" name="DISALLOW_FILE_EDIT" value="false" <?php echo $false_disallowfileedit ?>> False 
        </td>
      </tr>
      <tr>
        <td>EMPTY_TRASH_DAYS</td>
        <td>define the EMPTY_TRASH_DAYS. Must be an integer.</td>
        <td><input type="text" name="EMPTY_TRASH_DAYS" value="<?php echo get_option('EMPTY_TRASH_DAYS'); ?>"></td>
      </tr>
      <tr>
        <td>WP_ALLOW_REPAIR</td>
        <td>define the WP_ALLOW_REPAIR. If TRUE allow automatic database optimizing.</td>
        <td>
          <?php 
            $true_wpallowrepair = '';
            $false_wpallowrepair = '';
            if (get_option('WP_ALLOW_REPAIR') == 'true') $true_wpallowrepair = 'checked';
            elseif (get_option('WP_ALLOW_REPAIR') == 'false') $false_wpallowrepair = 'checked';
          ?>
          <input type="radio" name="WP_ALLOW_REPAIR" value="true" <?php echo $true_wpallowrepair ?>> True 
          <input type="radio" name="WP_ALLOW_REPAIR" value="false" <?php echo $false_wpallowrepair ?>> False 
        </td>
      </tr>
      <tr>
        <td>WP_POST_REVISIONS</td>
        <td>define the WP_POST_REVISIONS. Must be an integer.</td>
        <td><input type="text" name="WP_POST_REVISIONS" value="<?php echo get_option('WP_POST_REVISIONS'); ?>"></td>
      </tr>
      <tr>
        <td>DISABLE_WP_CRON</td>
        <td>define the DISABLE_WP_CRON. If TRUE disable cron.</td>
        <td>
          <?php 
            $true_disablewpcron = '';
            $false_disablewpcron = '';
            if (get_option('DISABLE_WP_CRON') == 'true') $true_disablewpcron = 'checked';
            elseif (get_option('DISABLE_WP_CRON') == 'false') $false_disablewpcron = 'checked';
          ?>
          <input type="radio" name="DISABLE_WP_CRON" value="true" <?php echo $true_disablewpcron ?>> True 
          <input type="radio" name="DISABLE_WP_CRON" value="false" <?php echo $false_disablewpcron ?>> False 
        </td>
      </tr>
      <tr>
        <td>FS_METHOD</td>
        <td>define the FS_METHOD. forces the filesystem method. It should only be "direct", "ssh2", "ftpext", or "ftpsockets". For details <a href="http://codex.wordpress.org/Editing_wp-config.php#WordPress_Upgrade_Constants">http://codex.wordpress.org/Editing_wp-config.php#WordPress_Upgrade_Constants</a></td>
        <td><input type="text" name="FS_METHOD" value="<?php echo get_option('FS_METHOD'); ?>"></td>
      </tr>
      <tr>
        <td>WP_CONTENT_DIR</td>
        <td>define the WP_CONTENT_DIR. Without /</td>
        <td><input type="text" name="WP_CONTENT_DIR" value="<?php echo get_option('WP_CONTENT_DIR'); ?>"></td>
      </tr>
    </table>
    <p class="submit">
      <input type="submit" name="submit" id="submit" class="button-primary" value="Save constants">
      Remember that a backup of wp-config is stored in a new file named wp-config-backup.php in site root.
    </p>
  </form>
</div>

<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js'></script>
<!-- Generate random key -->
<script type="text/javascript">
  function randomString(length, chars) {
      var result = '';
      for (var i = length; i > 0; --i) result += chars[Math.round(Math.random() * (chars.length - 1))];
      return result;
  }

  $(document).ready(function(){

    $('.generate').click(function(){
      $target = $($(this).data('target'));
      $target.val(randomString(65, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'));
    });

  });
</script>

