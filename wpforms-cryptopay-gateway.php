<?php

declare(strict_types=1);

defined('ABSPATH') || exit;

// @phpcs:disable PSR1.Files.SideEffects
// @phpcs:disable PSR12.Files.FileHeader
// @phpcs:disable Generic.Files.InlineHTML
// @phpcs:disable Generic.Files.LineLength

/**
 * Plugin Name: WPForms - CryptoPay Gateway
 * Version:     1.0.0
 * Plugin URI:  https://beycanpress.com/cryptopay/
 * Description: Adds Cryptocurrency payment gateway (CryptoPay) for WPForms.
 * Author:      BeycanPress LLC
 * Author URI:  https://beycanpress.com
 * License:     GPLv3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: wpforms-cryptopay
 * Tags: Cryptopay, Cryptocurrency, WooCommerce, WordPress, MetaMask, Trust, Binance, Wallet, Ethereum, Bitcoin, Binance smart chain, Payment, Plugin, Gateway, Moralis, Converter, API, coin market cap, CMC
 * Requires at least: 5.0
 * Tested up to: 6.4.3
 * Requires PHP: 8.1
*/

// Autoload
require_once __DIR__ . '/vendor/autoload.php';

define('WPFORMS_CRYPTOPAY_FILE', __FILE__);
define('WPFORMS_CRYPTOPAY_VERSION', '1.0.0');
define('WPFORMS_CRYPTOPAY_KEY', basename(__DIR__));
define('WPFORMS_CRYPTOPAY_URL', plugin_dir_url(__FILE__));
define('WPFORMS_CRYPTOPAY_DIR', plugin_dir_path(__FILE__));
define('WPFORMS_CRYPTOPAY_SLUG', plugin_basename(__FILE__));

use BeycanPress\CryptoPay\Integrator\Helpers;

Helpers::registerModel(BeycanPress\CryptoPay\WPForms\Models\TransactionsPro::class);
Helpers::registerLiteModel(BeycanPress\CryptoPay\WPForms\Models\TransactionsLite::class);

load_plugin_textdomain('wpforms-cryptopay', false, basename(__DIR__) . '/languages');

if (!defined('WPFORMS_VERSION')) {
    add_action('admin_notices', function (): void {
        ?>
            <div class="notice notice-error">
                <p><?php echo sprintf(esc_html__('WPForms - CryptoPay Gateway: This plugin requires WPForms to work. You can download WPForms by %s.', 'wpforms-cryptopay'), '<a href="https://wordpress.org/plugins/wpforms-lite/" target="_blank">' . esc_html__('clicking here', 'wpforms-cryptopay') . '</a>'); ?></p>
            </div>
        <?php
    });
} elseif (Helpers::bothExists()) {
    new BeycanPress\CryptoPay\WPForms\Loader();
} else {
    add_action('admin_notices', function (): void {
        ?>
            <div class="notice notice-error">
                <p><?php echo sprintf(esc_html__('WPForms - CryptoPay Gateway: This plugin is an extra feature plugin so it cannot do anything on its own. It needs CryptoPay to work. You can buy CryptoPay by %s.', 'wpforms-cryptopay'), '<a href="https://beycanpress.com/product/cryptopay-all-in-one-cryptocurrency-payments-for-wordpress/?utm_source=wp_org_addons&utm_medium=wpforms" target="_blank">' . esc_html__('clicking here', 'wpforms-cryptopay') . '</a>'); ?></p>
            </div>
        <?php
    });
}
