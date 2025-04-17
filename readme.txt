=== Loginator ===
Contributors: polyplugins
Tags: log, debug, logger, error, error handling, developer, dev, dev tool, developer tool
Requires at least: 4.0
Tested up to: 5.5.1
Requires PHP: 5.4
Stable tag: 1.0.0
License: GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Adds a simple global function for logging to files for developers. 

== Description ==
[youtube https://youtu.be/k1o4zZC6dzs]

Debugging WordPress can sometimes be a pain, our goal is to make it easy, which is why Loginator was built with this in mind. From creating a log folder, to securing it from prying eyes, Loginator is here to save you time and resources, so you can focus on creating astonishing applications. Once activated, Loginator essentially becomes a core part of WordPress, which is why we disable deactivation as it is highly recommended to not uninstall Loginator until you have removed all references to the loginator function inside your WordPress installation.

Free Features:
* Global Enable/Disable
* Flags for Errors, Debug, and Info
* Creates separate files based on flags
Our beautiful comments follow WordPress Developer Standards, that when paired with Visual Studio Code or other supporting IDE\'s will elaborately explain how to use the loginator function
* Auto detect if data being logged is an array and pretty prints it to the file
* Disable Loginator deactivation to prevent function not existing errors

[Donate Features](https://www.polyplugins.com/product/loginator/ "Poly Plugins"):
* Email on CRITICAL flag
* Pipe Dream logging

== Installation ==
1. Backup WordPress
1. Upload the plugin files to the /wp-content/plugins/ directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the ‘Plugins’ screen in WordPress

== Frequently Asked Questions ==
= How do I deactivate/uninstall? =
Either rename or remove the Loginator plugin from `/wp-content/plugins/`

== Screenshots ==
1. Settings
2. IDE

== Changelog ==
= 1.0.0 =
* Initial Release