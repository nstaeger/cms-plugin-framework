<?php

namespace Nstaeger\CmsPluginFramework\Tests\Framework\Unit;

use Nstaeger\CmsPluginFramework\Support\Time;
use PHPUnit_Framework_TestCase;

class TimeTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function asSqlTimestamp()
    {
        $this->assertEquals(date('Y-m-d G:i:s', 123), Time::of(123)->asSqlTimestamp());
    }

    /**
     * @test
     */
    public function addMinutes()
    {
        $this->assertEquals(220, Time::of(100)->addMinutes(2)->getTimestamp());
    }

    /**
     * @test
     */
    public function addMinutesAsString()
    {
        $this->assertEquals(220, Time::of(100)->addMinutes("2")->getTimestamp());
    }

    /**
     * @test
     */
    public function addSeconds()
    {
        $this->assertEquals(160, Time::of(100)->addSeconds(60)->getTimestamp());
    }

    /**
     * @test
     */
    public function addSecondsAsString()
    {
        $this->assertEquals(160, Time::of(100)->addSeconds("60")->getTimestamp());
    }

    /**
     * @test
     */
    public function now()
    {
        $this->assertEquals(time(), Time::now()->getTimestamp());
    }

    /**
     * @test
     */
    public function ofGivenTimestamp()
    {
        $this->assertEquals(123, Time::of(123)->getTimestamp());
    }
}