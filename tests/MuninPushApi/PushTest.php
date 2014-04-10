<?php

namespace MuninPushApi\Tests;

use MuninPushApi\Push;
use MuninPushApi\Config;
use MuninPushApi\Redis;

class PushTest extends \PHPUnit_Framework_TestCase {

    protected $push = NULL;
    protected $redisKey = '';

    public function setUp() {

        $graph    = 'diskstation_diskusage';
        $prefix   = Config::getConfig()->redis->prefix;

        $this->push     = new Push($graph);
        $this->redisKey = $prefix.':'.$graph;

    }

    public function testImportWithTestFile() {

        $fixure = __DIR__.'/../files/import_data.put';
        $this->push->import($fixure);

        $usage  = Redis::getRedis()->get($this->redisKey.':usage');
        $system = Redis::getRedis()->get($this->redisKey.':system');

        $this->assertEquals('10', $usage);
        $this->assertEquals('20', $system);

    }

    public function testImportExpire() {

        $redisMock = $this->getMock('Redis');

        $redisMock->expects($this->atLeastOnce())
                  ->method('set')
                  ->with($this->anything(),
                         $this->anything(),
                         $this->equalTo(Config::getConfig()->redis->ttl));

        Redis::setRedis($redisMock);

        $fixure = __DIR__.'/../files/import_data.put';
        $this->push->import($fixure);

    }

    public function testImportPersitent() {

        $redisMock = $this->getMock('Redis');

        $redisMock->expects($this->atLeastOnce())
                  ->method('set')
                  ->with($this->anything(),
                         $this->anything());

        Redis::setRedis($redisMock);

        $fixure = __DIR__.'/../files/import_data.put';
        $this->push->import($fixure);

    }

}
