<?php

namespace Nstaeger\CmsPluginFramework\Tests\Framework\Integration;

use Nstaeger\CmsPluginFramework\Broker\OptionBroker;
use Nstaeger\CmsPluginFramework\Tests\CmsPluginFrameworkTestCase;

class OptionsBrokerTest extends CmsPluginFrameworkTestCase
{
    /**
     * @var OptionBroker
     */
    private $options;

    /**
     * @before
     */
    public function before()
    {
        $this->options = $this->plugin()->make(OptionBroker::class);
    }

    /**
     * @test
     */
    public function deleteValue()
    {
        $this->options->store('foo', 'bar');
        $this->options->delete('foo');

        $this->assertEquals(false, $this->options->get('foo'));
    }

    /**
     * @test
     */
    public function getValue()
    {
        $this->assertEquals(false, $this->options->get('foo'));
    }

    /**
     * @test
     */
    public function getValueWithDefault()
    {
        $this->assertEquals('default', $this->options->get('foo', 'default'));
    }

    /**
     * @test
     */
    public function storeValue()
    {
        $this->options->store('foo', 'bar');

        $this->assertEquals('bar', $this->options->get('foo'));
    }

    /**
     * @test
     */
    public function storeValueWithDefault()
    {
        $this->options->store('foo', 'bar');

        $this->assertEquals('bar', $this->options->get('foo', 'default'));
    }
}
