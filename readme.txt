=== WP Idea Stream ===
Contributors: imath
Donate link: http://imathi.eu/donations/
Tags: idea, innovation, management, ideas, ideation, sharing, post-type, rating
Requires at least: 3.5
Tested up to: 3.5
Stable tag: 1.1
License: GNU/GPL 2

Adds an Idea Management System to your WordPress!

== Description ==

WP Idea Stream adds a light Idea Management System to your WordPress Blog. Your members will be able to submit ideas from the front end.
A star rating system and 4 widgets to display Ideas related content are included.

In IdeaStream admin menu, you'll be able to customize the behavior of the plugin thanks to the submenu IdeaStream Options.

Once the plugin is installed, simply add at least one category of the Idea Post Type from the back end in order to activate the submit form.
You can specify the IdeaStream list of ideas to show directly on your blog home from the reading options.

Since version 1.1, **this plugin requires WordPress 3.5** and is optimized for twentytwelve theme.

If you are still using twentyten or twentyeleven with WordPress 3.5, please go to the FAQ section of this plugin.

If you're using another theme, i advise you to copy the templates of WP Idea Stream templates dir and then paste them into your theme's folder.
Then you can edit the copy you put in your theme's folder to suit your design. If an IdeaStream template is found in active theme dir, it overrides the one in the plugin dir.

WP Idea Stream is available in French and English.

Here's a very long demo of it (sorry for my english) :
http://vimeo.com/55241231

== Installation ==

You can download and install WP Idea Manager using the built in WordPress plugin installer. If you download WP Idea Manager manually, make sure it is uploaded to "/wp-content/plugins/wp-idea-stream/".

Activate WP Idea Manager in the "Plugins" admin panel using the "Activate" link.

== Frequently Asked Questions ==

= I'm not using WordPress 3.5, is this plugin compatible with an older version ? =
Version 1.1 of the plugin requires WordPress 3.5, if you want to use this plugin with an earlier version of WordPress, you'll need to download a previous version of the plugin.
I advise you to browse the [different versions](http://wordpress.org/extend/plugins/wp-idea-stream/developers/ "Other version") available and choose version 1.0.3 if you run a WordPress from 3.1 to 3.4.2.

= I'm still using the twentyeleven or twentyten theme with WordPress 3.5, how can i make the different templates go along with it ? =
You can download from my dorpbox a [zip file](https://dl.dropbox.com/u/2322874/templates-2010-11.zip "my dropbox") containing the idea templates optimized for this 2 themes. Once you've downloaded them, simply copy and paste them
in your twentyeleven or twentyten (child) theme directory.

= When on front end, idea category or tag are displaying a 404 ? =

To fix this, you can go to your permalinks settings and simply click on the "save changes" button to update your permalinks settings

= If you have any other questions =

Please add a comment [here](http://imathi.eu/tag/wp-idea-stream/ "my blog") or use this plugin forum.

== Screenshots ==

1. form to submit ideas.
2. Ratings, Admin Bar shortcuts, reading settings
3. IdeaStream Options
4. Widgets

== Changelog ==

= 1.1 =

* requires WordPress 3.5
* now uses wp_editor to fix some ugly javascript warnings
* adds 2 tinyMCE plugins to improve image and link management when adding an idea.
* templates are now optimized for twentytwelve theme.

= 1.0.3 =

* fixes a trouble appeared in WP 3.4 on the wysiwyg editor
* fixes a redirect trouble once the idea is posted if plugin is activated in a child blog
* adds status header to avoid 404 in several templates

= 1.0.2 =

* adds a filter on comment notification text when post author can't edit comment in order to avoid displaying the trash and spam link in the author's mail

= 1.0.1 =

* fixes the 'edit description link' bug on author idea template
* adds titles on browser header by filtering wp_title and bp_page_title (BuddyPress)
* it's now possible to feature ideas from BuddyPress comment template.

= 1.0 =

* Plugin birth..

== Upgrade Notice ==

= 1.1 =
Please be sure to use at least WordPress 3.5 before upgrading/downloading this plugin.

= 1.0.3 =
no particular notice for this upgrade.

= 1.0.2 =
no particular notice for this upgrade.

= 1.0.1 =
no particular notice for this upgrade.

= 1.0 =
no upgrades, just a beta version.