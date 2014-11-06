<?php
  $cmanager = WordlessExtenderConstantManager::get_instance();
  $form = new WordlessExtenderConstantForm;
  if ( isset( $_GET['message'] ) )
    wle_show_message(WordlessExtender::get_message($_GET['message']));

?>
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
                </tbody>
            </table>

            <p class="submit">
                <input type="submit" id="submit" class="button-primary" value="Save constants">
                Remember that a backup of wp-config is stored in a new file named wp-config.orig.php in site root.
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

<?php include_once('footer.html.php'); ?>
