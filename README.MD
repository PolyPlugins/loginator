

[![Loginator Demo](https://img.youtube.com/vi/k1o4zZC6dzs/0.jpg)](https://youtu.be/k1o4zZC6dzs)

Debugging WordPress can sometimes be a pain, which is why **Loginator** was built to simplify the process. From automatically creating and securing a log folder to intelligently handling different types of logs, Loginator helps you save time and focus on building great applications.

Once activated, Loginator essentially becomes a core part of WordPress, which is why **plugin deactivation is disabled** to prevent runtime errors from missing log functions.

## Features

### ✅ Free Features
- Global enable/disable switch
- Logging flags: `error`, `debug`, and `info`
- Automatically creates separate log files per flag
- Pretty prints arrays for better readability
- Inline documentation for use in IDEs like Visual Studio Code
- Prevents plugin deactivation to avoid fatal errors if log function is still in use

### 💎 Premium Features
Available via [Loginator on PolyPlugins](https://www.polyplugins.com/product/loginator/)
- Email alerts on `CRITICAL` log entries
- Pipe Dream logging support

## Installation

1. **Backup WordPress**
2. Upload the plugin to the `/wp-content/plugins/` directory, or install it via the WordPress plugin manager.
3. Activate the plugin through the WordPress **Plugins** menu.

## FAQ

### How do I deactivate/uninstall Loginator?

Because deactivation is disabled to protect your site from runtime errors, you'll need to manually remove or rename the plugin folder:

/wp-content/plugins/loginator/
