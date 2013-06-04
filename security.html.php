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
        <td>Make your .htaccess more solid.</td>
        <td>
          <?php 
            $true_htaccess = '';
            $false_htaccess = '';
            if (get_option('htaccess_fix') == 'true') $true_htaccess = 'checked';
            elseif (get_option('htaccess_fix') == 'false') $false_htaccess = 'checked';
          ?>
          <input type="radio" name="htaccess_fix" value="true" <?php echo $true_htaccess ?>> True 
          <input type="radio" name="htaccess_fix" value="false" <?php echo $false_htaccess ?>> False
        </td>
      </tr>
    </table>
    <p class="submit">
      <input type="submit" name="submit" id="submit" class="button-primary" value="Save security fixes">
    </p>
  </form>
</div>
