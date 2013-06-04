<div class="wrap">
  <div id="icon-themes" class="icon32"><br></div>
  <h2>Plugin Manager</h2>

  <div class="description">
    <p>
      Developed by <a href='http://dev.welaika.com'>weLaika</a>. View <a href="<?php print $plugin_url; ?>/README.md">README</a> for more details.
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
        <th class="install"></th>
        <th class="upgrade"></th>
        <th class="activate"></th>
        <th class="deactivate"></th>
        <th class="delete"></th>
        <th class="details"></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($plugin_data as $p) : ?>
        <tr class="<?php print str_replace(' ', '-', strtolower($p['status'])); ?>">
          <td class="status"><?php print $p['status']; ?></td>
          
          <td class="name"><?php print $p['name']; ?></td>
          
          <td class="version">
            <?php if ($p['status'] != 'Not installed') : ?>
              <?php print $p['version']; ?>
            <?php endif; ?>
          </td>
          
          <td class="install">
            <?php if ($p['status'] == 'Not installed') : ?>
              <a href="<?php print $p['install']; ?>">Install</a>
            <?php endif; ?>
          </td>

          <td class="upgrade">
            <?php if ($p['upgrade'] && $p['status'] != 'Not installed') : ?>
              <a href="<?php print $p['upgrade']; ?>">Upgrade</a>
            <?php endif; ?>
          </td>
          
          <td class="activate">
            <?php if ($p['activate'] && $p['status'] == 'Not active') : ?>
              <a href="<?php print $p['activate']; ?>">Activate</a>
            <?php endif; ?>
          </td>

          <td class="deactivate">
            <?php if ($p['deactivate'] && $p['status'] == 'Active') : ?>
              <a href="<?php print $p['deactivate']; ?>">Deactivate</a>
            <?php endif; ?>
          </td>

          <td class="delete">
            <?php if ($p['delete'] && $p['status'] == 'Not active') : ?>
              <a href="<?php print $p['delete']; ?>">Delete</a>
            <?php endif; ?>
          </td>
        
          <td class="details">
            <a href="<?php print $p['details']; ?>" class="thickbox" target="_blank">Details</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

</div>

