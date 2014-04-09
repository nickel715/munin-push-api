<?php

namespace MuninPushApi\Tests;

use MuninPushApi\Push;
use MuninPushApi\Config;
use MuninPushApi\Redis;

class PushTest extends \PHPUnit_Framework_TestCase {

    protected $push = NULL;

    public function setUp() {

        $graph = 'testGraph';
        $prefix   = Config::getConfig()->redis->prefix;

        $this->push     = new Push($graph);
        $this->redisKey = $prefix.':'.$graph;

    }

    public function testKeyName() {

        $key = $this->push->getRedisKey('test');

        $this->assertEquals($this->redisKey.':test', $key);

    }

    public function testImportWithTestFile() {

        $fixure = __DIR__.'/../files/import_data.put';
        $this->push->import($fixure);

        $usage  = Redis::getRedis()->get($this->redisKey.':usage');
        $system = Redis::getRedis()->get($this->redisKey.':system');

        $this->assertEquals('10', $usage);
        $this->assertEquals('20', $system);

    }

}
