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

// Hook into plugin activation
register_activation_hook(__FILE__, function () {
    $source = plugin_dir_path(__FILE__) . '/mu/wp-trait-mu-loader.php';
    $destination = WPMU_PLUGIN_DIR . '/wp-trait-mu-loader.php';

    if (!file_exists($destination)) {
        if (!symlink($source, $destination)) {
            add_action('admin_notices', function () {
                echo '<div class="notice notice-error"><p>Failed to create a symlink for mu/wp-trait-mu.php in the mu-plugins directory. Please create it manually.</p></div>';
            });
            deactivate_plugins(plugin_basename(__FILE__));
        }
    }
});

// Hook into plugin deactivation
register_deactivation_hook(__FILE__, function () {
    $destination = WPMU_PLUGIN_DIR . '/wp-trait-mu-loader.php';

    if (file_exists($destination) && is_link($destination)) {
        unlink($destination);
    }
});

// Hook into plugin uninstall
// register_uninstall_hook(__FILE__, function () {
//     $destination = WPMU_PLUGIN_DIR . '/wp-trait-mu-loader.php';

//     if (file_exists($destination) && is_link($destination)) {
//         unlink($destination);
//     }
// });

if (!defined('WPMU_PLUGIN_DIR') || !file_exists(WPMU_PLUGIN_DIR . '/wp-trait-mu-loader.php')) {
    add_action('admin_notices', function () {
        echo '<div class="notice notice-error"><p>This plugin can only be activated by creating a symlink in the mu-plugins directory or copying mu/wp-trait-mu-loader.php to the mu-plugins directory.</p></div>';
    });
    deactivate_plugins(plugin_basename(__FILE__));
    return;
}
