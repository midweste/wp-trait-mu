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
 * Version:           2025.01.29.23.25.01
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

file_exists(__DIR__ . '/../vendor/autoload.php') && require_once __DIR__ . '/../vendor/autoload.php';
return;

call_user_func(function () {
    return;
    $plugin_files = [
        'wp-trait-mu/wp-trait-mu.php'
    ];

    foreach ($plugin_files as $plugin_file) {
        $plugin_file_abs = trailingslashit(WP_PLUGIN_DIR) . $plugin_file;
        if (!file_exists($plugin_file_abs)) {
            continue;
        }

        require $plugin_file_abs;

        // remove plugin action links
        add_filter('network_admin_plugin_action_links_' . $plugin_file, function ($actions) {
            unset($actions['activate'], $actions['delete']);
            return $actions;
        });
        add_filter('plugin_action_links_' . $plugin_file, function ($actions) {
            unset($actions['activate'], $actions['delete']);
            return $actions;
        });

        // show as active and disable checkbox
        add_action('after_plugin_row_' . $plugin_file, function ($plugin_file) {
            $html = <<<HTML
                <script>jQuery('.inactive[data-plugin="{$plugin_file}"]').attr('class','active');</script>
                <script>jQuery('.active[data-plugin="{$plugin_file}"] .check-column input').attr( 'disabled','disabled' );</script>
            HTML;
            echo $html;
        });

        // show as mu-plugin
        add_action('after_plugin_row_meta', function ($plugin_file) use ($plugin_files) {
            if (!in_array($plugin_file, (array) $plugin_files, true)) {
                return;
            }
            printf('<br>%s', esc_html__('Activated as a mu-plugin', 'wp-git-plugin-repository'));
        });
    }

    // mark as active plugin
    add_filter('option_active_plugins', function ($active_plugins) use ($plugin_files) {
        return array_unique(array_merge($active_plugins, $plugin_files));
    }, PHP_INT_MIN, 1);

    file_exists(__DIR__ . '/../vendor/autoload.php') && require_once __DIR__ . '/../vendor/autoload.php';
});
