<?php
  $pluginManager = new WordlessExtenderPluginManager(WordlessExtender::$to_be_installed_plugins);
  $pluginManager->initialize_plugins();
  $plugin_data = $pluginManager->get_plugin_istances();

  wp_enqueue_script( 'plugin-install' );
  add_thickbox();

?>

<div class="wrap">
  <div id="icon-themes" class="icon32"><br></div>
  <h2>Plugin Manager</h2>

  <div class="description">
    <p>
      Developed by <a href='http://dev.welaika.com'>weLaika</a>. View <a href="<?php print WordlessExtender::$url; ?>/README.md">README</a> for more details.
    </p>
    <p>
      WordPress' plugins community contribuited are an essential part of WP itself. You probably wont reinvent the wheel
      every time you'll build a new project, but will be convenient for you and your clients to use some of them...if they are
      good enaugh! We consider plugins as good ones if they
    </p>
      <ul>
        <li>* are tested</li>
        <li>* are actively contribuited</li>
        <li>* are doing well a single task</li>
        <li>* have readable code</li>
      </ul>
    <p>
      A list of tested-by-welaika plugins follow, to quickly kickstart your project with a dedicated control panel.
    </p>
  </div>

  <h3>Plugin list</h3>


  <table id="wordless-extender" class="wp-list-table widefat">
    <colgroup>
      <col class="status" />
      <col class="name" />
      <col class="version" />
      <col class="install" />
      <col class="upgrade" />
      <col class="activate" />
      <col class="deactivate" />
      <col class="delete" />
      <col class="details" />
    </colgroup>
    <thead>
      <tr>
        <th class="status">Status</th>
        <th class="name">Name</th>
        <th class="version">Version</th>
        <th colspan="6">Options</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($plugin_data as $p) : ?>
        <tr class="<?php print $p->get_data('Slug'); ?>">
          <td class="status"><?php print $p->get_status(); ?></td>

          <td class="name"><?php print $p->get_data('Name'); ?></td>

          <td class="version">
            <?php if ($p->is_installed()) : ?>
              <?php print $p->get_data('Version'); ?>
            <?php endif; ?>
          </td>

          <td class="install">
            <?php if (!$p->is_installed()) : ?>
              <a href="<?php print $p->get_urls('install'); ?>">Install</a>
            <?php endif; ?>
          </td>

          <td class="upgrade">
            <?php if ($p->is_installed()) : ?>
              <a href="<?php print $p->get_urls('update'); ?>">Update</a>
            <?php endif; ?>
          </td>

          <td class="activate">
            <?php if ($p->is_installed() && !$p->is_active()) : ?>
              <a href="<?php print $p->get_urls('activate'); ?>">Activate</a>
            <?php endif; ?>
          </td>

          <td class="deactivate">
            <?php if ($p->is_active()) : ?>
              <a href="<?php print $p->get_urls('deactivate'); ?>">Deactivate</a>
            <?php endif; ?>
          </td>

          <td class="delete">
            <?php if ($p->is_installed() && !$p->is_active()) : ?>
              <a href="<?php print $p->get_urls('delete'); ?>">Delete</a>
            <?php endif; ?>
          </td>

          <td class="details">
            <a href="<?php print $p->get_urls('details'); ?>" class="thickbox">Details</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

</div>

<?php include_once('footer.html.php'); ?>

