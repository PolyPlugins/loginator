### About
Debugging WordPress can sometimes be a pain, our goal is to make it easy, which is why Loginator was built with this in mind. From creating a log folder to securing it from prying eyes, Loginator is here to save you time and resources, so you can focus on creating astonishing applications. Once activated, Loginator essentially becomes a core part of WordPress, which is why we disable deactivation as it is highly recommended to not uninstall Loginator until you have removed all references to the `loginator` function inside your WordPress installation.

## Demo
[![YouTube Video](https://img.youtube.com/vi/k1o4zZC6dzs/maxresdefault.jpg)](https://youtu.be/k1o4zZC6dzs)

### Update
2.0 has been released with backwards compatibility with 1.0. Your `loginator` function calls will still work so you can continue to use it, or our new static methods.

### Functional Example

```php
loginator('Logging this message', array('flag' => 'd', 'id' => '', 'file' => 'logger', 'pipedream' => 'https://your-id-here.m.pipedream.net'));
```

### Static Method Examples

```php
Loginator::emergency('log data here'); // Email triggers to site admin or configured emails
Loginator::alert('log data here');
Loginator::critical('log data here'); // Email triggers to site admin or configured emails
Loginator::error('log data here');
Loginator::warning('log data here');
Loginator::notice('log data here');
Loginator::info('log data here');
Loginator::debug('log data here'); // PipeDream flag is set to true by default
Loginator::success('log data here');
```

You can also pass arguments:

```php
$args = array(
  'flag'      => 'd',
  'id'        => 23,
  'file'      => 'test',
  'pipedream' => false,
);

Loginator::info('log data here', $args);
```

### Features

- Global Enable/Disable
- Flags for Errors, Debug, and Info
- Creates separate files based on flags
- Our beautiful comments follow WordPress Developer Standards, that when paired with Visual Studio Code or other supporting IDEs will elaborately explain how to use the `loginator` function
- Auto detect if data being logged is an array and pretty prints it to the file
- Disable Loginator deactivation to prevent function not existing errors
- Email on CRITICAL flag
- Pipe Dream logging

## Installation

1. Backup WordPress
2. Upload the plugin files to the `/wp-content/plugins/` directory, or install the plugin through the WordPress plugins screen directly.
3. Activate the plugin through the 'Plugins' screen in WordPress

## Frequently Asked Questions

### How do I deactivate/uninstall?
Either rename or remove the Loginator plugin from `/wp-content/plugins/`

## Screenshots

1. Settings
2. IDE

## Changelog

### 2.0.1

- **Added**: Emergency, alert, critical, error, warning, notice, info, debug, and success static methods
- **Added**: Email on CRITICAL flag
- **Added**: Pipe Dream logging
- **Added**: Backwards compatibility with `loginator` function
- **Integrated**: [Reusable Admin Panel](https://wordpress.org/plugins/reusable-admin-panel/)

### 1.0.1

- **Bugfix**: Added object handling to log the accessible non-static properties.
- **Bugfix**: Line breaks and white space formatting

### 1.0.0

- Initial Release
