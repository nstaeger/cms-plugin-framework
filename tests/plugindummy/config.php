<?php
return [
    'plugin_dir'           => __DIR__,
    'plugin_main_file'     => __DIR__ . DIRECTORY_SEPARATOR,
    'plugin_url'           => plugin_dir_url(__FILE__),
    'controller_namespace' => "Nstaeger\\WpPostEmailNotification\\Controller",
    'option_prefix'        => 'wppen_',
    'rest_prefix'          => 'wppen_v1'
];
