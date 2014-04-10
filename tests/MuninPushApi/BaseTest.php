<?php

namespace MuninPushApi\Tests;

use MuninPushApi\Base;
use MuninPushApi\Config;

class BaseTest extends \PHPUnit_Framework_TestCase {

    protected $name = 'testGraph';
    protected $base = null;

    public function setUp() {
        $this->base = $this->getMockForAbstractClass('MuninPushApi\Base', [$this->name]);
    }

    public function testConstructWithName() {
        $this->assertEquals($this->name, \PHPUnit_Framework_Assert::readAttribute($this->base, 'name'));
    }

    public function testGetRedisKeyReturnsKey() {

        $prefix = Config::getConfig()->redis->prefix;
        $key    = $this->base->getRedisKey('test');

        $this->assertEquals($prefix.':'.$this->name.':test', $key);

    }


}
