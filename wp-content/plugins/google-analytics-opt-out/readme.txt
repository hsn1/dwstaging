=== Google Analytics Opt-Out ===
Contributors: wp-buddy, floriansimeth
Donate link: https://wp-buddy.com/products/plugins/google-analytics-opt-out/
Tags: google analytics, analytics, analytics opt-out, analytics opt out, monster insights, monster insight, yoast analytics
Version: 2.0.1
Requires at least: 3.7
Stable tag: 2.0.1
Tested up to: 4.8
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html


Provides an Opt-Out functionality for Google Analytics

== Description ==

This plugin provides an Opt-Out functionality for Google Analytics by setting a cookie that prevents analytics.js to collect data.

Works perfectly together with the [Google Analytics by MonsterInsights Plugin](http://wordpress.org/plugins/google-analytics-for-wordpress/ "Google Analytics by MonsterInsights Plugin").

The free and the pro version have now been merged together. So you now can have the option to activate a banner, too! Enjoy!

== Installation ==

* Install and activate the plugin via your WordPress Administration panel
* Go the "Settings" -> "Analytics Opt Out" and enter your UA-code (you don't need this step if MonsterInsights plugin is active)
* IMPORTANT: Check the sourcecode of your website and make sure that the Analytics code is entered AFTER the opt-out code. Otherwise the Opt-Out feature will not work.
* Read the FAQ for more information.

== Frequently Asked Questions ==


== Screenshots ==

1. The Opt-Out link can be added with this little button (shortcode)

2. This is how the code looks like

3. This is the settings page

== Changelog ==

= 2.0.2 =
* Make plugin compatible with the latest version of MonsterInsights.
* Remove/deprecate all functions that have been used when the old Yoast Analytics plugin was active.
* Remove the 'gaoop_stop_head' filter as it's no longer needed.
* Display the options submenu under "Insights" menu.

= 2.0.1 =
* Plugin can now be translated via [translate.wordpress.org](https://translate.wordpress.org/projects/wp-plugins/google-analytics-opt-out)

= 2.0.0 =
* The pro version is now free (this is it!)
* New: allow the complete deactivation of the banner.

= 0.1.5 =
* Added Spanish translation

= 0.1.4 =
* Solves the issue that the opt-out link does not appear when the UA-Code was entered manually.
* Also fixes an issue that the tracking code could not be found due to some code changes of the Yoast Google Analytics for WordPress Plugin (Yoast_GA_Frontend class no longer extends Yoast_GA_Options)

= 0.1.3 =
* Made the plugin compatible with the latest version of the Google Analytics plugin by Yoast

= 0.1.2 =
* Works again with the Google Analytics plugin by Yoast

= 0.1.1 =
* Fixed the issue that error message still shows shows up
* Added/replaced some translations
* Fixed an issue that Yoasts Analytics for WordPress plugin has changed the option name

= 0.1 =
* The first version

== Upgrade Notice ==