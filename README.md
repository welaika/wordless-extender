# Pimp My WordPress

Pimp My WordPress is a starting point for every WordPress we develop at 
[weLaika](http://welaika.com). Performs some default security action and 
optimization and give a list of plugin we usually install on every installation,
or we need to remember to install!

## Security

* Disable theme and plugin editor
* Remove `generator` meta tag

## Optimization

* Set download method to `direct`, to enforce WP to use PHP to download 
  core/plugins/themes
* Remove update check if logged in user is not `admin`, removes update 
  notification from admin interface and admin bar

## Plugin list

* [Better WP Security](http://wordpress.org/extend/plugins/better-wp-security/)
* [InfiniteWP Client](http://wordpress.org/extend/plugins/iwp-client/)
* [Options Framework](http://wordpress.org/extend/plugins/options-framework/)
* [Posts to Posts](http://wordpress.org/extend/plugins/posts-to-posts/)
* [Simple Fields](http://wordpress.org/extend/plugins/simple-fields/)
* [White Label CMS](http://wordpress.org/extend/plugins/white-label-cms/)
* [Wordless](http://wordpress.org/extend/plugins/wordless/)
