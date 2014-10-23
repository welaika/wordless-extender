<?php
  $cmanager = WordlessExtenderConstantManager::get_instance();
  $form = new WordlessExtenderConstantForm;
  wle_show_message(WordlessExtender::get_message($_GET['message']));

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

    <?php
      if ( $cmanager->initialized ){

    ?>

        <form method="post" action="admin.php?action=update_constants">

            <h3>Constants list</h3>

            <table id="wordless-extender" class="wp-list-table widefat">
                <thead>
                    <tr>
                        <th class="constant">Constant Name</th>
                        <th class="description">Description</th>
                        <th class="value">Value</th>
                        <th class="extra">Extra Controls</th>
                    </tr>
                </thead>

                <tbody>
    <?php

                    $constants_collection = WordlessExtenderConstantCollection::get_list();

                    foreach ( $constants_collection as $name => $args ) {
                        $form->print_row( $name, $args );
                    }

    ?>

                    <!--

                      <td>WP_POST_REVISIONS</td>
                      <td>define the WP_POST_REVISIONS. Must be an integer.</td>
                      <td><input type="text" name="WP_POST_REVISIONS" value="<?php echo get_option('WLE_WP_POST_REVISIONS'); ?>"></td>
                    </tr>
                    <tr>
                      <td>FS_METHOD</td>
                      <td>define the FS_METHOD. forces the filesystem method. It should only be "direct", "ssh2", "ftpext", or "ftpsockets". For details <a href="http://codex.wordpress.org/Editing_wp-config.php#WordPress_Upgrade_Constants">http://codex.wordpress.org/Editing_wp-config.php#WordPress_Upgrade_Constants</a></td>
                      <td><input type="text" name="FS_METHOD" value="<?php echo get_option('WLE_FS_METHOD'); ?>"></td>
                    </tr>
                    <tr>
                      <td>WP_CONTENT_DIR</td>
                      <td>define the WP_CONTENT_DIR. Without /</td>
                      <td><input type="text" name="WP_CONTENT_DIR" value="<?php echo get_option('WLE_WP_CONTENT_DIR'); ?>"></td>
                    </tr> -->

                </tbody>
            </table>

            <p class="submit">
                <input type="submit" id="submit" class="button-primary" value="Save constants">
                Remember that a backup of wp-config is stored in a new file named wp-config.php.bak in site root.
            </p>

        </form>
    <?php
      }
    ?>

  <form method="post">
      <?php
        $cmanager->print_inconsistences();
        $cmanager->print_init_buttons();
      ?>
  </form>
</div>

