<?php

/**
 * Subscribe form and list of subscribers.
 *
 * Plugin Name:         Subscribe
 * Description:         The plugin creates a subscribe form and store subscribers into database.
 * Version:             1.0.0
 * Requires at least:   4.9
 * Requires PHP:        5.5
 * Author:              wppunk
 * License:             MIT
 * Text Domain:         subscribe
 *
 * @package     Subscribe
 */

namespace Subscribe;

// Exit if accessed directly.
if (!defined('ABSPATH')) {
	exit;
}

define('SUBSCRIBE_VERSION', '1.0.0');
define('SUBSCRIBE_PATH', plugin_dir_path(__FILE__));
define('SUBSCRIBE_URL', plugin_dir_url(__FILE__));

require_once(SUBSCRIBE_PATH . 'Table.php');
require_once(SUBSCRIBE_PATH . 'Vue.php');
require_once(SUBSCRIBE_PATH . 'SaveBD.php');

$vue = new \Vue();
$subscribe = new \SaveBD();


register_activation_hook(__FILE__, ['Table', 'create_table']);
