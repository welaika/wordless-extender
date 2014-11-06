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
        <strong>wp-config.php</strong> has a lot of configurations that you want to remember. <br />
        You can discover and manage them within this panel. <br />

        At every update a wp-config.php.orig with previous version will be created.<br />
        <span class="red">Remember to delete your cookies and don't worry about new login requests after keys updates.</span><br />

        Use the power with care!
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
