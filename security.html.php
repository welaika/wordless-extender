<?php
if ( isset( $_GET['message'] ) )
  wle_show_message(WordlessExtender::get_message($_GET['message']));
?>

<div class="wrap">

    <div id="icon-themes" class="icon32"><br></div>
    <h2>Security Fixes</h2>
    <div class="description">
        <p>
            This is a collection of security tricks.<br />
            These are taken from <a href="http://codex.wordpress.org/Hardening_WordPress">Hardening Wordpress</a> and from our WP experience.<br />
            Please, pay attention to the <span class="red">warnings</span>.
        </p>
    </div>

    <form method="post" action="admin.php?action=update_securities">
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
                    <td>Make your .htaccess more solid. A backup is stored in .htaccess.orig</td>
                    <td>
                        <?php
                        if ( WordlessExtenderDB::take('HARDEN_HTACCESS') === 'true' ) :

                            echo WordlessExtender::get_message(2);

                        else :

                            ?> <input type="checkbox" name="HARDEN_HTACCESS" value="true"> Sure? <?php

                        endif;
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Plugins and themes</td>
                    <td>Remove default WordPress plugins and themes. <span class="red">Warning: you can't undo this action!</span></td>
                    <td>
                        <?php
                        $tw10 = ( !file_exists( WP_CONTENT_DIR .'/themes/twentyten' ) ) ? 'disabled' : '';
                        $tw11 = ( !file_exists( WP_CONTENT_DIR .'/themes/twentyeleven' ) ) ? 'disabled' : '';
                        $tw12 = ( !file_exists( WP_CONTENT_DIR .'/themes/twentytwelve' ) ) ? 'disabled' : '';
                        $tw13 = ( !file_exists( WP_CONTENT_DIR .'/themes/twentyrhirteen' ) ) ? 'disabled' : '';
                        $tw14 = ( !file_exists( WP_CONTENT_DIR .'/themes/twentyfourteen' ) ) ? 'disabled' : '';
                        $tw15 = ( !file_exists( WP_CONTENT_DIR .'/themes/twentyfifteen' ) ) ? 'disabled' : '';
                        $tw16 = ( !file_exists( WP_CONTENT_DIR .'/themes/twentysixteen' ) ) ? 'disabled' : '';
                        $tw17 = ( !file_exists( WP_CONTENT_DIR .'/themes/twentyseventeen' ) ) ? 'disabled' : '';
                        $hello = ( !file_exists( WP_CONTENT_DIR .'/plugins/hello.php' ) ) ? 'disabled' : '';
                        ?>
                        <input type="checkbox" name="REMOVE_DEFAULT_THEMES_AND_PLUGINS[]" value="<?php echo WP_CONTENT_DIR .'/themes/twentyten'; ?>" <?php echo $tw10; ?>> Theme: TwentyTen<br />
                        <input type="checkbox" name="REMOVE_DEFAULT_THEMES_AND_PLUGINS[]" value="<?php echo WP_CONTENT_DIR .'/themes/twentyeleven'; ?>" <?php echo $tw11; ?>> Theme: TwentyEleven<br />
                        <input type="checkbox" name="REMOVE_DEFAULT_THEMES_AND_PLUGINS[]" value="<?php echo WP_CONTENT_DIR .'/themes/twentytwelve'; ?>" <?php echo $tw12; ?>> Theme: TwentyTwelve<br />
                        <input type="checkbox" name="REMOVE_DEFAULT_THEMES_AND_PLUGINS[]" value="<?php echo WP_CONTENT_DIR .'/themes/twentythirteen'; ?>" <?php echo $tw13; ?>> Theme: TwentyThirteen<br />
                        <input type="checkbox" name="REMOVE_DEFAULT_THEMES_AND_PLUGINS[]" value="<?php echo WP_CONTENT_DIR .'/themes/twentyfourteen'; ?>" <?php echo $tw14; ?>> Theme: TwentyFourteen<br />
                        <input type="checkbox" name="REMOVE_DEFAULT_THEMES_AND_PLUGINS[]" value="<?php echo WP_CONTENT_DIR .'/themes/twentyfifteen'; ?>" <?php echo $tw15; ?>> Theme: TwentyFifteen<br />
                        <input type="checkbox" name="REMOVE_DEFAULT_THEMES_AND_PLUGINS[]" value="<?php echo WP_CONTENT_DIR .'/themes/twentysixteen'; ?>" <?php echo $tw16; ?>> Theme: TwentySixteen<br />
                        <input type="checkbox" name="REMOVE_DEFAULT_THEMES_AND_PLUGINS[]" value="<?php echo WP_CONTENT_DIR .'/themes/twentyseventeen'; ?>" <?php echo $tw17; ?>> Theme: TwentySeventeen<br />
                        <input type="checkbox" name="REMOVE_DEFAULT_THEMES_AND_PLUGINS[]" value="<?php echo WP_CONTENT_DIR .'/plugins/hello.php'; ?>" <?php echo $hello; ?>> Plugin: Hello Dolly
                    </td>
                </tr>

                <tr>
                    <td>XMLRPC</td>
                    <td>Remove xmlrpc.php file. <span class="red">Warning: you can't undo this action!</span></td>
                    <td>
                        <?php if ( file_exists( WordlessExtenderSecurity::$xmlrpc_path ) ) : ?>
                            <input type="checkbox" name="REMOVE_XMLRPC" value="true"> Sure?
                        <?php else :
                            echo WordlessExtender::get_message(2);
                        endif; ?>
                    </td>
                </tr>

                <tr>
                    <td>README</td>
                    <td>Remove readme.html file. <span class="red">Warning: you can't undo this action!</span></td>
                    <td>
                        <?php if ( file_exists( WordlessExtenderSecurity::$readme_path ) ) : ?>
                            <input type="checkbox" name="REMOVE_README" value="true"> Sure?
                        <?php else :
                            echo WordlessExtender::get_message(2);
                        endif; ?>
                    </td>
                </tr>

                <tr>
                    <td>License</td>
                    <td>Remove license.txt file. <span class="red">Warning: you can't undo this action!</span></td>
                    <td>
                        <?php if ( file_exists( WordlessExtenderSecurity::$license_path ) ) : ?>
                            <input type="checkbox" name="REMOVE_LICENSE" value="true"> Sure?
                        <?php else :
                            echo WordlessExtender::get_message(2);
                        endif; ?>
                    </td>
                </tr>

                <tr>
                    <td>Meta infos</td>
                    <td>Remove Wordpress meta info from header and feeds.</td>
                    <td>
                        <?php
                        $true_rmmetas = '';
                        $false_rmmetas = '';
                        if ( WordlessExtenderDB::take('REMOVE_META_INFOS') === 'true' )
                            $true_rmmetas = 'checked';
                        else
                            $false_rmmetas = 'checked';
                        ?>
                        <input type="radio" name="REMOVE_META_INFOS" value="false" <?php echo $false_rmmetas ?>> False
                        <input type="radio" name="REMOVE_META_INFOS" value="true" <?php echo $true_rmmetas ?>> True
                    </td>
                </tr>

        </table>

        <p class="submit">
            <input type="submit" name="submit" id="submit" class="button-primary" value="Save security fixes">
        </p>

    </form>

</div>

<?php include_once('footer.html.php'); ?>
