=== Google AdSense ===
Contributors: google
Tags: adsense, google adsense, adsense plugin, ads, advertising, google ads,  advertisement, advertising, google
Requires at least: 3.5
Tested up to: 4.2
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

The official AdSense Plugin, written by Google. Supported products include AdSense and Webmaster Tools. Previously Google Publisher Plugin.

== Description ==

The AdSense Plugin enables you to easily use Google's products - including Webmaster Tools - with your WordPress site.

** Now with Automated Mobile Ads! **

To insert AdSense ads without the plugin would first involve generating the AdSense snippet and then pasting the Adsense snippet into either the text of the site or directly into the PHP. This plugin lets you place AdSense ads using a simple point-and-click UI rather than manually inserting snippets yourself. Google automatically determines potential placements for AdSense ads, suggests an initial ad layout, and allows you to lay out ads on your site.

This version of the AdSense Plugin allows you to:

* Easily add AdSense ads to your site to make money from advertising.
* With one click, enable mobile-specific ad layouts with the new Automated Mobile Ads. [Learn more](https://support.google.com/adsense/answer/3380277)
* Manage your ads quickly and easily through a point-and-click interface.
* [Manually insert ads](https://support.google.com/adsense/answer/6051417) in locations that you determine yourself. This gives you the power of manual insertion of snippets while also being able to use the plugin’s great UI. You can specify precise layout locations in HTML as well as interact with them through a point-and-click interface.
* [Exclude pages](https://support.google.com/adsense/answer/6023216#disable) from having ads on them.
* Verify your site with Webmaster Tools with just one click.

[Visit Google Help Center](https://support.google.com/adsense/answer/3380626) for more information.

== Installation ==

Also see the [AdSense help documentation on installing the AdSense Plugin](https://support.google.com/adsense/answer/3380627).

After installation, you can [set up the plugin](https://support.google.com/adsense/answer/3380277).

Make sure you meet the minimum system requirements.

* PHP version 5.2.0 or greater.
* WordPress version 3.5 or greater.
* Ability to install third-party WordPress plugins.
* Site hosted outside WordPress.com. WordPress.com [does not allow](http://en.support.wordpress.com/plugins/) this plugin on its hosted sites.

Sign in to your WordPress account and visit the site admin page. You can quickly view this page if you click the WordPress icon in the upper left corner of your WordPress site. Note that you must have permission as an admin of your site to install plugins. If you need help, try [WordPress support](http://wordpress.org/support/).

In the site admin sidebar, click Plugins and select Add New. Enter “Google AdSense Plugin” in the search bar and click Search Plugins.

Find the Google AdSense Plugin in the list of results and click the Install Now link.

At this point, WordPress should automatically install the plugin.

If you have any trouble with automatic installation, you can try it manually. To do this:

* Visit the [WordPress plugin directory](http://wordpress.org/plugins/google-publisher/) page for the AdSense Plugin. If you don't see the plugin page, enter "Google AdSense Plugin" in the Search Plugins box on the left and click Search.
* Download the plugin. It should come in the form of a .zip file.
* Sign in to your WordPress account and visit the site admin page.
* In the site admin sidebar, click Plugins and select Add New.
* Select Upload near the top of the plugins page. Click Choose file and upload your .zip file. Then click Install Now.

Move on to [plugin setup](https://support.google.com/adsense/answer/answer.py?answer=3380277).

== Frequently Asked Questions ==

= Is this an official Google plugin? =

Yes, this plugin is developed and supported by Google. [Visit Google Help Center](https://support.google.com/adsense/answer/3380626) for more information.

= Can I use the AdSense Plugin on WordPress.com? =

At this time, the AdSense Plugin cannot be used on WordPress.com. WordPress.com [does not allow](http://en.support.wordpress.com/plugins/) this plugin on its hosted sites.

= What are Automated Mobile Ads? =

Google will create mobile-specific ad placements automatically with one click. All ads will have locations and formats that are appropriate for mobile.

= The plugin didn’t find a location where I want to put an ad. How do I insert AdSense ads in those locations? =

You can now [manually insert ads](https://support.google.com/adsense/answer/6051417?hl=en&ref_topic=3380274) in locations that you determine yourself. This is an easy-to-use compromise between manual insertion of snippets yourself and the plugin’s easy-to-use UI. You get full control plus point-and-click. See the [help documentation](https://support.google.com/adsense/answer/6051417?hl=en&ref_topic=3380274) for more information.

= Why should I use this plugin as opposed to others? =

Google officially supports this plugin and any other method of putting the AdSense snippet on your page. This is the only plugin that delivers the Google-suggested ad experience for your site.

All plugins and placements must still adhere to the [AdSense Terms and Conditions](https://www.google.com/adsense/localized-terms) and it is the responsibility of the publisher to ensure that any tools used for AdSense obey those terms and conditions. It is usually up to the publisher to determine if your content violates ad policy or a placement is deceptive.

== Screenshots ==

1. Manage your AdSense account and access Webmaster Tools from the plugin. Use Automated Mobile Ads for one-click mobile ad layouts and formats.
2. Click to add advertisements to your site. Create different placements for each page template.
3. View the layout for each page, with advertisement areas visualized next to your content flow.
4. Preview example advertisements alongside your content.

== Changelog ==

= 20 Feb 2015, Plugin version 1.1.0 =
* Ads can now be placed on custom page templates.

= 13 Jan 2015, Plugin version 1.0.2 =
* Fixed a bug that caused newly created pages on some themes to be incorrectly recognized as using custom page templates.

= 16 Dec 2014, Plugin version 1.0.1 =
* Fixed two remaining occurrences of the previous plugin name.

= 11 December 2014  =
The following change does not require a plugin update, and was fixed server-side.

* Full roll out of Automated Mobile Ads.

= 8 December 2014, Plugin version 1.0.0 =
Renamed the plugin from "Google Publisher Plugin" to "AdSense Plugin", and moved it out of beta.

= 10 November 2014 =
The following changes do not require a plugin update, and were fixed server-side.

* Link units are no longer recognized as regular ad units by the plugin. This makes it possible to place three ads on a template using the plugin regardless of the number of link units.
* It is now possible to temporarily place more than three ads per template in design mode. The additional ad units must be removed before saving.
* Fixed a bug that made it impossible to remove or modify a placement placed above a paragraph that no longer existed. Posts and pages with a small number of paragraphs will now have additional placeholder paragraphs in design mode.

= 2 October 2014 =
The following changes do not require a plugin update, and were fixed server-side.

* Added more ad placements options between sidebar widgets.
* Fixed a common incompatibility with the "WordPress SEO by Yoast" plugin. This bug made page analysis fail with a "cache error" when the date-based archives were disabled.

= 19 Aug 2014, Plugin version 0.3.0  =
* [Exclude pages](https://support.google.com/adsense/answer/6023216#disable) from having ads on them.
* Support to deliver ad layout updates from Google in order to, for example, fix broken layouts.

The following changes do not require a plugin update, and have been fixed server-side.

* Ad placements are automatically populated for each template for new users.
* [Manually insert ads](https://support.google.com/adsense/answer/6051417?hl=en&ref_topic=3380274) in locations that you determine yourself. This gives you all the power of manually adding ad slots, yet retains the ease of use of the plugin.

= 27 May 2014, Plugin version 0.2.0 =
* A notification will now be shown on the WordPress dashboard when one or more ads are not appearing correctly (for example, because the theme has changed). Note that these notifications are currently only updated once a day.
* Ads will now only be shown on the theme they were placed on. For example, when a separate theme is used for mobile devices, ads will no longer be shown on that theme.
* Fixed an incompatibility with a number of other plugins.
* Extended the nonce lifetime, which should reduce the number of failed saves.

= 1 May 2014 =
The following changes do not require a plugin update, and were fixed server-side.

 * Ad units created by the plugin now have understandable names in AdSense, such as "Front page - 1 (yoursite.com)".
 * Added support for placing ads on "Tags" and "Category" pages.
 * Fixed miscellaneous errors when computing possible placements.
 * Improved error messages for various failures.

= 30 Jan 2014 =
The following changes do not require a plugin update, and were fixed server-side.

* No longer show dynamicgoogletags.update() in post content if the theme incorrectly strips HTML.
* Added support for sites with mixed case URLs.
* Fixed bug related to preview of vertical ads.
* Improved margins on ad placements.
* Inverted marker for placement at the top of the page to point at the correct location for placement.
* Added support for sites that use HTTPS but are administered over HTTP.
* Update the view, specifically ad sizes, when user resizes the window in preview mode.
* Fixed miscellaneous errors when computing possible placements.
* Localized AdSense help center pages for the plugin.

= 15 Jan 2014, Plugin version 0.1.0 =
* Initial release.

== Terms of service ==

The plugin source code is GPL, however use of Google Services through the plugin is governed by [Google's Terms of Service](http://www.google.com/policies/terms/) and [Privacy Policy](http://www.google.com/policies/privacy/). For products and services that can be used with the AdSense Plugin, such as AdSense, additional Terms of Service may also apply.

== HTML5 Local Storage ==

Google uses HTML5 Local Storage in the end-user's browser to record which kind of ad layout it serves to each browser; this includes the number of ads served and their position on the site. This helps Google compare ad performance across different ad layouts. The information is anonymous and is not personally identifiable. Do not use this Google-managed value for your own tracking; it may prevent the plugin from gathering reliable data about ad layouts. Your site should already include the appropriate disclosures about cookie usage, but please ensure that you [make the disclosures required by AdSense terms and conditions](https://support.google.com/adsense/answer/1348695).
