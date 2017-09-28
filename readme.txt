=== Wordless Extender ===
Contributors: welaika
Tags: security, configuration, wordless, htaccess, wp-config, development
Requires at least: 4.0
Tested up to: 4.7
Stable tag: 1.2.1
License: MIT

Wordless Extender is a starting point for everyone: list of commonly used plugins, wp-config.php / .htaccess configuration and security improvements.

== Description ==

[Wordless](https://github.com/welaika/wordless) is the WP themes framework developed and used by [weLaika](http://dev.welaika.com).

As we wrote in the Wordless README:

    « Wordless is not meant to be a bloated, all-included tool.
    This is why we recommend adding some other plugins
    to get the most out of your beautiful WP developer life »

*Wordless Extender* (WLE from now on) is a starting point for every Wordless theme.
Let's take a look in depth.

### Plugin Manager

Never change a winning team! These are our _starred_ plugins; with these we cover the 90% of our developing needs.
You'll have a control panel inside WLE to list, enable, disable and upgrade plugins from the collection; never search that useful plugin crawling the WP.org repo and have team kickstart projects with always the same plugin set.

### Config Constants

Manage WP constants (stored in your wp-config.php) directly within the WP backend.

We got inspired by WordPress [guidelines](http://codex.wordpress.org/Editing_wp-config.php) and we crafted this little control panel. It is intended for advanced users: we are not interested in making things easy, but we'd like to remember important/complex/abstruse settings and have them always just one click away.

Everytime you'll update these configs `wp-config.php` file will be backed-up in `wp-config.php.orig`. Keep in mind.

### Security fixes

This is the most important section: improving security.
Most of the tricks are directly from [Hardening Wordpress](http://codex.wordpress.org/Hardening_WordPress) guide; others are tricks discovered on battlefield.

You have to know what you are doing. Follow the comments in the panel if you are confused. Remind that when you'll let the plugin rewrite your `.htaccess` file, it will take a backup copy of the last version in `.htaccess.orig`.

If you are asking about the things are we doing with your `.htaccess` go read the template in `resources/htaccess.tpl`.
Essentially we'll block access to various files and locations.
We are always at work to improve this section, so if you have some tips open an issue or send a pull request.

## Wordless integration

WLE menu in the WP backend, will be integrated with the Wordless 0.4+ backend menu, creating _one place to rule them all!_

## Need more tools?
Visit [Wordpress Tools](http://wptools.it).

## Licence

(The MIT License)

Copyright © 2014-2015 weLaika

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the ‘Software’), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED ‘AS IS’, WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.


== Installation ==

1. Install Wordless Extender either via the WordPress.org plugin directory, or by uploading the files to your server.
2. Activate the plugin.
3. Manage plugin settings.
4. That's it. You are ready to go!

== Changelog ==

= 1.2.1 =
* minor fix

= 1.2.0 =
* update constants manager
* add twentyseventeen theme to security-fixes options
* minor fixes

= 1.1.3 =
* univocal htaccess

= 1.1.2 =
* fix htaccess hardening

= 1.1.1 =
* minor fixes

= 1.1.0 =
* autoload table prefix
* disabled: plugin manager

= 1.0.8 =
* fix wp-config update functions
* fix deploy script

= 1.0.7 =
* update plugins names in plugin manager section
* fix rrmdir function call
* add 2015 and 2016 themes remover to security-fixes options
* updated deprecated autoload method - and so fix on latest WP with latest PHP

= 1.0.6 =
* Update documentation

= 1.0.5 =
* Add plugin logo

= 1.0.4 =
* Update documentation

= 1.0.3 =
* Update documentation

= 1.0.2 =
* First stable and wordpress.org-ready release

== Upgrade Notice ==

= 1.0.2 =
* Actually nothing :)
