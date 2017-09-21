<?php

namespace Nstaeger\CmsPluginFramework\Tests\Framework\Unit;

use Nstaeger\CmsPluginFramework\Event\EventDispatcher;
use PHPUnit_Framework_TestCase;

class EventDispatcherTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var EventDispatcher
     */
    private $dispatcher;

    /**
     * @before
     */
    public function before()
    {
        $this->dispatcher = new EventDispatcher();
    }

    /**
     * @test
     */
    public function registeredListenerIsCalled()
    {
        $count = 0;
        $this->dispatcher->on('simple', function() use (&$count) {
            $count += 1;
        });
        $this->dispatcher->fire('simple');

        $this->assertEquals(1, $count);
    }

    /**
     * @test
     */
    public function listenerForOtherEventIsNotCalled()
    {
        $count = 0;
        $this->dispatcher->on('other', function() use (&$count) {
            $count += 1;
        });
        $this->dispatcher->fire('simple');

        $this->assertEquals(0, $count);
    }

    /**
     * @test
     */
    public function priorityIsConsidered()
    {
        $one = false;
        $two = false;
        $three = false;

        $this->dispatcher->on('simple', function() use (&$three) {
            $three = microtime();
        }, 3);

        $this->dispatcher->on('simple', function() use (&$one) {
            $one = microtime();
        }, 1);
        $this->dispatcher->on('simple', function() use (&$two) {
            $two = microtime();
        }, 2);

        $this->dispatcher->fire('simple');

        $this->assertGreaterThan($three, $two);
        $this->assertGreaterThan($two, $one);
    }
}
