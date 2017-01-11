# Wordless Extender

![logo](http://welaika.github.com/wordless-extender/assets/images/wordless-extender.png)

[Wordless](https://github.com/welaika/wordless) is the WP themes framework developed and used by [weLaika](http://dev.welaika.com).

As we wrote in the Wordless README:

    « Wordless is not meant to be a bloated, all-included tool.
    This is why we recommend adding some other plugins
    to get the most out of your beautiful WP developer life »

*Wordless Extender* (WLE from now on) is a starting point for every Wordless theme.
Let's take a look in depth.

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

## Author

made with ❤️ and ☕️ by [weLaika](http://dev.welaika.com)

## License

(The MIT License)

Copyright © 2014-2017 [weLaika](http://dev.welaika.com)

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the ‘Software’), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED ‘AS IS’, WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
