<?php

namespace Nstaeger\CmsPluginFramework\Tests;

use Nstaeger\CmsPluginFramework\Plugin;
use WP_UnitTestCase;

abstract class CmsPluginFrameworkTestCase extends WP_UnitTestCase
{
    /**
     * @return Plugin
     */
    public function plugin()
    {
        return Plugin::getInstance();
    }
}
