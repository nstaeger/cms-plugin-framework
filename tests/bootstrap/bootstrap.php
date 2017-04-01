<?php

// Load composer
require getcwd() . '/vendor/autoload.php';

// Set Framework and WP Tests directories
$frameworkRootDir = getenv('FRAMEWORK_DIR') ?: dirname(dirname(__DIR__));
$wpTestsDir = getenv('WP_TESTS_DIR') ?: getcwd() .'/tmp/wordpress-tests-lib';

// Configure Plugin
if (!defined('PLUGIN_NAME'))
{
    define('PLUGIN_NAME', 'plugin-dummy.php');
    define('PLUGIN_FOLDER', $frameworkRootDir . '/tests/plugin-dummy');
    define('PLUGIN_PATH', PLUGIN_FOLDER . '/' . PLUGIN_NAME);
}

// Activates this plugin in WordPress
$GLOBALS['wp_tests_options'] = array(
    'active_plugins' => array(PLUGIN_PATH)
);

require_once $wpTestsDir . '/includes/functions.php';

tests_add_filter('muplugins_loaded', function ()
{
    require PLUGIN_PATH;
});

require $wpTestsDir . '/includes/bootstrap.php';
