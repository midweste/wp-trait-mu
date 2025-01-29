<?php

declare(strict_types=1);

/*
 *
 * @link              https://github.com/midweste
 * @since             1.0.0
 * @package           WP-Trait Mu
 *
 * @wordpress-plugin
 * Plugin Name:       WP-Trait Mu
 * Plugin URI:        https://github.com/midweste/wp-trait-mu/
 * Description:       A mu-plugin for adding the https://github.com/mehrshaddarzi/wp-trait library for fast and standard development of WordPress plugins.  This plugin does nothing on its own.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Midweste
 * Author URI:        https://github.com/midweste/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://api.github.com/repos/midweste/wp-trait-mu/commits/main
 * Text Domain:       wp-trait-mu
 * Domain Path:       /languages
 * Requires Plugins:
 */

// Prevent the plugin from being loaded normally
if (strpos(__DIR__, WPMU_PLUGIN_DIR) !== 0) {
    // Deactivate the plugin if it is activated as a regular plugin
    add_action('admin_init', function () {
        deactivate_plugins(plugin_basename(__FILE__));
        add_action('admin_notices', function () {
            echo '<div class="error"><p><strong>WP-Trait Mu</strong> must be placed in the <code>mu-plugins</code> directory and cannot be activated as a regular plugin.</p></div>';
        });
    });
    return;
}

file_exists(__DIR__ . '/vendor/autoload.php') && require_once __DIR__ . '/vendor/autoload.php';
