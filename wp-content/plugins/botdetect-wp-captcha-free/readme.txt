=== BotDetect WordPress CAPTCHA ===
Contributors: botdetect.support@captcha.com
Donate link: http://captcha.com/doc/php/wordpress-captcha.html
Tags: captcha, wordpress captcha, comment, comments, form, forms, lost password, register, registration, login, Contact Form 7, spam, multilingual
Requires at least: 3.3
Tested up to: 4.5.2
Stable tag: trunk
License: This Plugin and each software packaged with this Plugin comes under its own license (license.txt in subfolders of the Plugin's root)
License url: none


== Description ==

BotDetect Captcha WordPress Plugin is a powerful captcha protection for WordPress login, lost password, registration, and comment forms.

BotDetect is unique among Captcha solutions in offering many Captcha image and sound styles. While each of them is easily comprehensible to human users, randomly using multiple Captcha styles makes the Captcha challenge practically impossible to pass automatically.

BotDetect Captcha is ADA and Section 508 compliant and provides an audio Captcha alternative to keep your forms accessible to the blind and other people for whom reading the Captcha code could be a problem.

Features:

* 60 secure & readable Captcha image styles
* 10 secure & accessible audio Captcha sound styles
* Localized Captcha generation, using various Unicode character sets and downloadable multi-language sound pronunciations
* Custom Captcha image size, color scheme, complexity (code length), support for filtering out offensive words, tabindex control, customizing CSS, and many other captcha customization options
* Produces XHTML 1.1 Strict and WCAG AAA compliant markup
* Validates properly when CAPTCHA forms are simultaneously open in multiple browser tabs
* Tested in IE, Firefox, Chrome, Safari and Opera browsers released since 2001.
* Full support for popular Android & iOS & BlackBerry devices

Check for more information about this plugin on [BotDetect Captcha WordPress Plugin section](http://captcha.com/doc/php/wordpress-captcha.html) on our website.


== Installation ==

In most cases you will be able to install automatically from WordPress.

Alternatively, you can:

* upload wp-botdetect-captcha-free folder to the /wp-content/plugins/ directory
* and activate the plugin through the 'Plugins' menu in WordPress

Note 1) If you are using iThemes Security plugin, you should disable 'Filter Suspicious Query Strings in the URL' because it filters Captcha image url.
Note 2) If PHP Sessions are disabled on your server,  Captcha validation (in any form) cannot work until you (or your administrator) enable them.

== Frequently Asked Questions ==

= What is the fastest way to get help with this plugin? =

Please contact us using the form here:
[Contact BotDetect WordPress Captcha plugin developers](http://captcha.com/support)

== Screenshots ==

1. BotDetect WordPress Captcha in action
2. WordPress Login Captcha
3. WordPress User Register Captcha
4. WordPress Comments Captcha
5. Contact Form 7 Captcha

== Changelog ==

= 4.1.0 =
* UPDATE: Captchas are generated with the newest BotDetect PHP Captcha library (v4.1.0)

= 4.0.0 =
* UPDATE: Captchas are generated with the newest BotDetect PHP Captcha library (v4.0.0)
* UPDATE: Moved Captcha below the Comments form to be compatible with WordPress 4.4+

= 3.0.3.0 =
* NEW: Support for different Captcha code length depending if user is logged in
* NEW: Captcha on WordPress Comments form and Contact Form 7 can be turned off if user is logged in
* BUGFIX: Fixed an "Use of undefined constant WPCF7_VERSION - assumed 'WPCF7_VERSION'" message occuring in Admin dashboard if user removes Contact Form 7 plugin, while still having BotDetect set to protect its forms
* UPDATE: Captchas are generated with the newest BotDetect PHP Captcha library (v3.0.3)

= 3.0.1.2 =
* UPDATE: Moved Captcha below the Comments form

= 3.0.1.1 =
* UPDATE: Sorted compatibility issues with the 4.2.2+ version of Contact Form 7 plugin
* BUGFIX: Fixed the bug which required repeated registration after plugin updates

= 3.0.1.0 =
* NEW: Added Contact Form 7 integration
* BUGFIX: Fixed bug which caused problems with updating other plugins
* UPDATE: Upgrade procedure is improved
* UPDATE: Improved check of generating Captcha images during activation
* UPDATE: Captchas are generated with the newest BotDetect PHP Captcha library (v3.0.1)

= 3.0.0.0 =
* UPDATE: Captchas are generated with the newest BotDetect PHP Captcha library (v3.0.0)
* UPDATE: Plugin uses jQuery version that ships with WordPress
* UPDATE: Upgrade procedure is improved

= 3.0.Beta3.5 =
* BUGFIX: Fixed breaking of WP4.0 procedure for getting a plugin list from a WordPress.org website (and making installing new plugins on WP4.0 impossible)

= 3.0.Beta3.4 =
* NEW: BotDetect Captcha WP Plugin is dependent of and packaged with the BotDetect PHP CAPTCHA library
* NEW: BotDetect Captcha WP Plugin is updated from captcha.com website
* UPDATE: If there are issues with persisting data in PHP Session, login form Captcha is initially disabled
* UPDATE: If user uses iThemes Security plugin, and "Filter Suspicious Query Strings in the URL" setting is turned on, login form Captcha is initially disabled

= 3.0.Beta3.3 =
* BUGFIX: Fixed bug causing upgrading error on PHP 5.2.*

= 3.0.Beta3.2 =
* UPDATE: Improved BotDetect Captcha WP Plugin backwards compatibility management
* UPDATE: Improved BotDetect PHP Captcha Library installation procedure
* UPDATE: Improved user friendliness of BotDetect Captcha WP Plugin error messages
* NEW: Added support for BotDetect Captcha WP Plugin localization
* NEW: Added Vietnamese localization of the BotDetect Captcha WP Plugin UI

= 3.0.Beta3.1 =
* BUGFIX: Fixed the issue with BotDetect Captcha WP Plugin preventing tags adding into posts while enabled
* BUGFIX: Fixed the issue with BotDetect Captcha WP Plugin preventing media adding into posts while enabled
* BUGFIX: Fixed the issue with broken saving of Captcha and BotDetect Captcha WP Plugin settings
* UPDATE: Improved support for BotDetect WP Captcha backwards compatibility management

= 3.0.Beta3.0 =
* NEW: Added support for automated BotDetect PHP Captcha library deployment to the current WordPress server
* UPDATE: If there are issues with generating Captcha images, login form Captcha is initially disabled
* UPDATE: Captcha code length is randomized by default (Captcha codes are randomly 3-5 characters long)

= 3.0.Beta1.7 =
* UPDATE: Fixed the user interface option related to Comments Captcha, which was not correct for all BotDetect Captcha WP Plugin versions since version 3.0.Beta1.4

= 3.0.Beta1.6 =
* UPDATE: Fixed directory separator inconsistency in the BotDetect Captcha library path option

= 3.0.Beta1.5 =
* UPDATE: Improved notifications to make BotDetect Captcha library deployment easier
* BUGFIX: Fixed a bug with missing Captcha in Comments for logged-in users (not completed in latest update)

= 3.0.Beta1.4 =
* UPDATE: Fixed a bug with missing Captcha in Comments for logged-in users

= 3.0.Beta1.3 =
* UPDATE: BotDetect Captcha WP Plugin options are spellchecked now :)

= 3.0.Beta1.2 =
* BUGFIX: Fixed the "you do not have enough permissions" bug on BotDetect Captcha WP Plugin plugin activation

= 3.0.Beta1.1 =
* UPDATE: Minor BotDetect Captcha WP Plugin options change

= 3.0.Beta1.0 =
* UPDATE: Fixed BotDetect Captcha WP Plugin versioning issues

= 3.0.0.Beta1 =
* NEW: WP login form Captcha
* NEW: WP lost password Captcha
* NEW: WP user register Captcha
* NEW: WP comments Captcha

== Upgrade Notice ==

The first official release on WordPress.org