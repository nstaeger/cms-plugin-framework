<?php

namespace Nstaeger\CmsPluginFramework\Tests\Framework\Integration;

use Nstaeger\CmsPluginFramework\Tests\CmsPluginFrameworkTestCase;

class PluginWasActivatedTest extends CmsPluginFrameworkTestCase
{
    /**
     * @test
     */
    function pluginWasActivated()
    {
        $this->assertTrue(is_plugin_active(PLUGIN_PATH));
        $this->assertNotNull($this->plugin());
    }
}
