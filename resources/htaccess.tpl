# BEGIN wordless-extender

  <Files wp-config.php>
    Order Allow,Deny
    Deny from all
  </Files>

  <IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteBase /
    RewriteCond %{REQUEST_METHOD} ^(HEAD|TRACE|DELETE|TRACK) [NC]
    RewriteRule ^(.*)$ - [F,L]
    RewriteCond %{QUERY_STRING} \.\.\/ [NC,OR]
    RewriteCond %{QUERY_STRING} boot\.ini [NC,OR]
    RewriteCond %{QUERY_STRING} tag\= [NC,OR]
    RewriteCond %{QUERY_STRING} ftp\: [NC,OR]
    RewriteCond %{QUERY_STRING} http\: [NC,OR]
    RewriteCond %{QUERY_STRING} https\: [NC,OR]
    RewriteCond %{QUERY_STRING} (\<|%3C).*script.*(\>|%3E) [NC,OR]
    RewriteCond %{QUERY_STRING} mosConfig_[a-zA-Z_]{1,21}(=|%3D) [NC,OR]
    RewriteCond %{QUERY_STRING} base64_encode.*\(.*\) [NC,OR]
    RewriteCond %{QUERY_STRING} ^.*(\[|\]|\(|\)|<|>|ê|"|;|\?|\*|=$).* [NC,OR]
    RewriteCond %{QUERY_STRING} ^.*(&#x22;|&#x27;|&#x3C;|&#x3E;|&#x5C;|&#x7B;|&#x7C;).* [NC,OR]
    RewriteCond %{QUERY_STRING} ^.*(%24&x).* [NC,OR]
    RewriteCond %{QUERY_STRING} ^.*(%0|%A|%B|%C|%D|%E|%F|127\.0).* [NC,OR]
    RewriteCond %{QUERY_STRING} ^.*(globals|encode|localhost|loopback).* [NC,OR]
    RewriteCond %{QUERY_STRING} ^.*(request|select|insert|union|declare).* [NC]
    RewriteCond %{HTTP_COOKIE} !^.*wordpress_logged_in_.*$
    RewriteRule ^(.*)$ - [F,L]
  </IfModule>

  Options +FollowSymLinks
   
  RewriteEngine On
  RewriteCond %{QUERY_STRING} (\&lt;|%3C).*script.*(\&gt;|%3E) [NC,OR]
  RewriteCond %{QUERY_STRING} GLOBALS(=|\[|\%[0-9A-Z]{0,2}) [OR]
  RewriteCond %{QUERY_STRING} _REQUEST(=|\[|\%[0-9A-Z]{0,2})
  RewriteRule ^(.*)$ index.php [F,L]

  Options All -Indexes
  <files .htaccess>
    Order allow,deny
    Deny from all
  </files>
  <files .htaccess_backup>
    Order allow,deny
    Deny from all
  </files>
  <files .htaccess.orig>
    Order allow,deny
    Deny from all
  </files>
  <files wp-config-backup.php>
    Order allow,deny
    Deny from all
  </files>
  <files wp-config.php.orig>
    Order allow,deny
    Deny from all
  </files>
  <files error.log>
    Order allow,deny
    Deny from all
  </files>
  <files readme.html>
    Order allow,deny
    Deny from all
  </files>
  <files license.txt>
    Order allow,deny
    Deny from all
  </files>
  <files install.php>
    Order allow,deny
    Deny from all
  </files>
  <files wp-config.php>
    Order allow,deny
    Deny from all
  </files>
  <files error_log>
    Order allow,deny
    Deny from all
  </files>
  <files fantastico_fileslist.txt>
    Order allow,deny
    Deny from all
  </files>
  <files fantversion.php>
    Order allow,deny
    Deny from all
  </files>
  <files ~ "\.md$">
    Order allow,deny
    Deny from all
  </files>
  <files ~ "\.txt$">
    Order allow,deny
    Deny from all
  </files>

  # Block the include-only files.
  RewriteEngine On
  RewriteBase /
  RewriteRule ^wp-admin/includes/ - [F,L]
  RewriteRule !^wp-includes/ - [S=3]
  RewriteRule ^wp-includes/[^/]+\.php$ - [F,L]
  RewriteRule ^wp-includes/js/tinymce/langs/.+\.php - [F,L]
  RewriteRule ^wp-includes/theme-compat/ - [F,L]

# END wordless-extender
