<?php

namespace Nstaeger\CmsPluginFramework\Tests\Framework\Integration;

use Nstaeger\CmsPluginFramework\Configuration;
use Nstaeger\CmsPluginFramework\Tests\CmsPluginFrameworkTestCase;

class PluginConfigurationTest extends CmsPluginFrameworkTestCase
{
    /**
     * @var Configuration
     */
    private $configuration;
    private $initialConfiguration;

    /**
     * @before
     */
    public function before()
    {
        $this->configuration = $this->plugin()->make(Configuration::class);
        $this->initialConfiguration = require PLUGIN_FOLDER . '/config.php';
    }

    /**
     * @test
     */
    public function configurationIsAvailable()
    {
        $this->assertNotNull($this->configuration);
    }

    /**
     * @test
     */
    public function configurationContainsCorrectData()
    {
        $this->assertEquals($this->initialConfiguration['plugin_dir'], $this->configuration->getDirectory());
        $this->assertEquals($this->initialConfiguration['plugin_main_file'], $this->configuration->getMainPluginFile());
        $this->assertEquals($this->initialConfiguration['plugin_url'], $this->configuration->getUrl());
        $this->assertEquals($this->initialConfiguration['controller_namespace'],
                            $this->configuration->getControllerNamespace());
        $this->assertEquals($this->initialConfiguration['option_prefix'], $this->configuration->getOptionPrefix());
        $this->assertEquals($this->initialConfiguration['rest_prefix'], $this->configuration->getRestPrefix());
    }
}
