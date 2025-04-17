<?php

/**
 * Plugin Name: Loginator
 * Plugin URI: https://wordpress.org/plugins/loginator/
 * Description: Adds a simple global function for logging to files for developers. 
 * Version: 1.0.1
 * Author: Poly Plugins
 * Author URI: https://www.polyplugins.com
 * License: GPL3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 */

defined('ABSPATH') || exit;

define('LOGINATOR_PLUGIN', __FILE__);
define('LOGINATOR_BASENAME', plugin_basename(LOGINATOR_PLUGIN));

// Activation Checks
function loginator_activation()
{
  add_option('loginator_version', '1.0.1');
  add_option('loginator_enabled', 1);
  $dir_logs = ABSPATH . '/wp-logs';
  $index = $dir_logs . '/index.php';
  $htaccess = $dir_logs . '/.htaccess';

  // Check if logs directory exists
  if (!file_exists($dir_logs)) {
    // Make the directory, allow writing so we can add a file
    mkdir($dir_logs, 0755, true);
    // Shhh we don't need script kiddies looking at our logs
    $contents = '<?php' . PHP_EOL . '// Silence is golden';
    file_put_contents($index, $contents);
    // Apache directory blocking
    $contents = 'Order Allow,Deny' . PHP_EOL . 'Deny from All';
    file_put_contents($htaccess, $contents);
  }
}
register_activation_hook(__FILE__, 'loginator_activation');

// Plugin Page CTAs
function plugin_action_links_loginator($links)
{
  // Prevent uninstallation as once developers start using this plugin, it should never be uninstalled as it will result in errors anywhere you are logging.
  unset($links['deactivate']);
  // Add settings CTA
  $settings_cta = '<a href="' . admin_url('/options-general.php?page=loginator') . '" style="color: orange; font-weight: 700;">Settings</a>';
  $donate_cta = '<a href="https://www.polyplugins.com/product/loginator/" style="color: green; font-weight: 700;" target="_blank">Donate</a>';
  array_unshift($links, $settings_cta, $donate_cta);
  return $links;
}
add_action('plugin_action_links_' . LOGINATOR_BASENAME, 'plugin_action_links_loginator');

function plugin_meta_links_loginator($links, $plugin_base_name)
{
  if ($plugin_base_name === LOGINATOR_BASENAME) {
    $links[] = '<a href="https://wordpress.org/support/plugin/loginator/" style="font-weight: 700;" target="_blank">Support</a>';
  }
  return $links;
}
add_action('plugin_row_meta', 'plugin_meta_links_loginator', 10, 4);

/**
 * Log data
 * @param string|array $log  The message you want to display in the logs.
 * @param string       $flag Optional. 'c' for critical, 'e' for error, 'd' for debug, or 'i' for info. Default is 'd'.
 * @param string       $file Optional. The name of the log file. It would be best to put the name of the file you are adding logging in. Default empty, if empty returns $flag.
 * @param string|int   $id   Optional. The unique identifier, this is added to the file name, this is useful for debugging orders by attaching order ids. Default empty.
 */
function loginator($log, $flag = 'd', $file = '', $id = '')
{
  // Log if enabled
  if (get_option('loginator_enabled')) {
    // Sanitize
    if (is_object($log)) {
      $log = get_object_vars($log);
      $log = array_map('esc_attr', $log);
      $log = (object) $log;
    } else {
      $log  = (is_array($log)) ? array_map('esc_attr', $log) : sanitize_textarea_field($log);
    }
    $file = sanitize_file_name($file);
    $flag = sanitize_text_field($flag);
    $id   = ($id) ? '-' . sanitize_text_field($id) : '';

    // Flag Handling
    switch ($flag) {
      case "c":
        $flag = "CRITICAL";
        break;
      case "e":
        $flag = "ERROR";
        break;
      case "d":
        $flag = "Debug";
        break;
      case "i":
        $flag = "Info";
        break;
    }

    // Use flag if file empty
    if (empty($file)) {
      $file = strtolower($flag);
    }

    // Save logs
    $dir = ABSPATH . '/wp-logs';
    if (is_object($log) || is_array($log)) {
      file_put_contents($dir . '/' . $file . $id . '.log', $flag . ' ' . date('m-d-y h:i:s') . ': ' . print_r($log, true) . PHP_EOL, FILE_APPEND);
    } else {
      file_put_contents($dir . '/' . $file . $id . '.log', $flag . ' ' . date('m-d-y h:i:s') . ': ' . $log . PHP_EOL, FILE_APPEND);
    }
  }
}

// Register settings page
function loginator_register_settings_page()
{
  add_submenu_page('options-general.php', 'Loginator Settings', 'Loginator', 'administrator', 'loginator', 'loginator_settings_page');
}
add_action('admin_menu', 'loginator_register_settings_page');

// Build the settings page
function loginator_settings_page()
{
?>
  <div class="wrap">
    <h2>Loginator Settings</h2>
    <?php settings_errors(); ?>
    <form method="post" action="<?php echo esc_url(admin_url('options.php')); ?>">
      <?php
      // General Settings
      settings_fields('loginator-general-settings');
      do_settings_sections('loginator');
      submit_button();
      ?>
    </form>
  </div>
<?php
}

// Register fields
function loginator_register_fields()
{
  // Define args for saving the settings, using this for sanitize callback.
  $checked = array(
    'type' => 'boolean',
    'sanitize_callback' => 'sanitize_text_field',
    'default' => 1,
  );

  // Add Section
  add_settings_section('loginator-general-settings', 'General Settings', null, 'loginator');
  // Display Enabled Settings
  add_settings_field('loginator_enabled', 'Enabled', 'loginator_enabled_setting', 'loginator', 'loginator-general-settings');
  // Save Enabled Settings
  register_setting('loginator-general-settings', 'loginator_enabled', $checked);
}
add_action('admin_init', 'loginator_register_fields');

// Create options on settings page
function loginator_enabled_setting()
{
?>
  <input type="checkbox" name="loginator_enabled" id="loginator_enabled" value="1" <?php checked(1, get_option('loginator_enabled'), true); ?> />
  Enable the logging?
<?php
}
