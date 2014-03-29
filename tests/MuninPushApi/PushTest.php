<?php

namespace MuninPushApi\Tests;

use MuninPushApi\Push;
use MuninPushApi\Config;

class PushTest extends \PHPUnit_Framework_TestCase {

    protected $push = NULL;

    public function setUp() {

        $category = 'testCategory';
        $prefix   = Config::getConfig()->redis->prefix;

        $this->push     = new Push($category);
        $this->redisKey = $prefix.':'.$category;

    }

    public function testKeyName() {

        $key = $this->push->getRedisKey('test');

        $this->assertEquals($this->redisKey.':test', $key);

    }

    public function testValidRedisInstance() {
        $this->assertInstanceOf('Redis', $this->push->getRedis());
    }

    /**
     * @todo improve methode name
     */
    public function testImport() {

        $fixure = __DIR__.'/../files/import_data.put';
        $this->push->import($fixure);

        $usage  = $this->push->getRedis()->get($this->redisKey.':usage');
        $system = $this->push->getRedis()->get($this->redisKey.':system');

        $this->assertEquals('10', $usage);
        $this->assertEquals('20', $system);

    }

}
