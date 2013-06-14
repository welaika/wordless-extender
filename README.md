# Wordless Extender

![logo](http://welaika.github.com/wordless/assets/images/wordless-extender.png)

[Wordless](https://github.com/welaika/wordless) is the WP themes framework developed
and used in the real work life by yours at weLaika.

As we wrote in the Wordless README:

    « Wordless is not meant to be a bloated, all-included tool. This is why we recommend adding some other plugins to get 
    the most out of your beautiful WP developer life »

*Wordless Extender* (WlE from now on) is a starting point for every Wordlress theme
we develop at [weLaika](http://dev.welaika.com).
After years of hard work we have _starred_ a few plugins, best practices and security
enhacements. WlE is a collection of those and let you control all this so cool
things within the WordPress backend, in a fast and familiar way.

## EHY YA STOP! WE'RE IN YO-BUG!
![yobug](http://i.qkme.me/3qhvd1.jpg)

We are on the way to destroy them: we're refactoring ALL the old code, the new code
and while doing this we'll resolve serious bug out there. In the meantime you have to wait!

If interested in the refactoring work you can take a look [here](https://github.com/pioneerskies/wordless-extender/tree/refactor)

Stay tuned

## Good habits, fast kickstart

A strong and efficient workflow passes through consolidated practices, good coding
habits, fast and no-worries kickstart. We thought this plugin to achieve easily
this goals. Let's take a look in depth.

### Plugin Manager

Never change a winning team! These are our _starred_ and often used plugins; with these
we cover the 90% of our developing needs.
You'll have a control panel inside WlE to list, enable, disable and upgrade plugins
from the collection; never search that useful plugin crawling the WP.org repo and
have colleagues kickstart projects with always the same plugin set, making the
teamwork easier and more coherent over the time.

_Self made_:

* [Wordless](http://wordpress.org/plugins/wordless/)
* [Users to CSV](http://wordpress.org/plugins/users2csv/)

_Lovely crafted from others_:

* [Posts to Posts](http://wordpress.org/plugins/posts-to-posts/)
* [Options Framework](http://wordpress.org/plugins/options-framework/)
* [Simple Fields](http://wordpress.org/plugins/simple-fields/)
* [InfiniteWP Client](http://wordpress.org/plugins/iwp-client/)
* [White Label CMS](http://wordpress.org/plugins/white-label-cms/)
* [Debug Bar](http://wordpress.org/plugins/debug-bar/)
* [Debug Bar Console](http://wordpress.org/plugins/debug-bar-console/)
* [Debug Bar Extender](http://wordpress.org/plugins/debug-bar-extender/)
* [Formidable Forms](http://wordpress.org/plugins/formidable/)

### wp-config.php Constants Manager

Manage WP constants (stored in your wp-config.php) directly within the WP backend!

We got inspired by WordPress [guidelines](http://codex.wordpress.org/Editing_wp-config.php)
and we crafted this little control panel. It is intended for advanced users: we are
not interested in making things easy, with fluffy names or other strategies, but
we'd like to remember important/complex/abstruse settings and have them always just
one click away

Everytime you'll update these configs `wp-config.php` file will be backed-up in
`wp-config-backup.php`. Keep it safe in mind.

### Security fixes

This is the most important section in our hearts: improving WP security. Most of
the tricks are directly from [Hardening Wordpress](http://codex.wordpress.org/Hardening_WordPress)
guide; others are paranoid tricks discovered on battlefield.

Keep in mind that you have to know what you are doing; follow the comments in the
panel below if you are confused. Remind that when you'll let the plugin rewrite
your `.htaccess` file, it will take a backup copy of the last version in `htaccess_backup`.

If you are asking about what exoteric things are we doing with your `.htaccess`,
well, go read the template in `resources/htaccess`. Essentially we'll block access
to varius files and locations which is better if locked down (strange query strings,
access to txt files in core/theme/plugins, markdown files, wp debug error log, ecc)

We are always at work to improve this section, so if you have some tips open us an
issue or send us a pull request.

## Wordless integration

WlE menu in the WP backend, will be integrated with the Wordless new (will be in
the next tagged release 0.4) custom backend menu, creating one place to control 
them all!

Wordless has (and will have moar!) helpers dedicated to the WlE's plugin collection.
Let contribute to the helpers too, if interested!

## Licence

(The MIT License)

Copyright © 2013 weLaika

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the ‘Software’), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED ‘AS IS’, WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
