<?php

namespace Nstaeger\CmsPluginFramework\Tests;

class PluginWasActivatedTest extends CmsPluginFrameworkTestCase
{
    /**
     * @test
     */
    function pluginWasActivated()
    {
        $this->assertTrue(is_plugin_active(PLUGIN_PATH));
    }
}
