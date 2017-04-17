<?php
/**
 * Plugin Name:       Plugin Dummy
 * Description:       This is a plugin dummy, that acts as base for the framework's tests.
 * Version:           1.0.0
 */

use Nstaeger\CmsPluginFramework\Configuration;
use Nstaeger\CmsPluginFramework\Creator\WordpressCreator;
use Nstaeger\CmsPluginFramework\Plugin;

$config = require __DIR__ . '/config.php';

$plugin = new Plugin(new Configuration($config), new WordpressCreator());
