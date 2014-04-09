<?php

namespace MuninPushApi\Tests;

use MuninPushApi\Redis;
use MuninPushApi\Config;

class RedisTest extends \PHPUnit_Framework_Testcase {

    public function testGetRedisReturnsRedisInstance() {
        $this->assertInstanceOf('Redis', Redis::getRedis());
    }

    public function testGetRedisSinglton() {
        $this->assertEquals(spl_object_hash(Redis::getRedis()), spl_object_hash(Redis::getRedis()));
    }

    public function testSetRedis() {

        $redis = new \Redis;

        Redis::setRedis($redis);

        $this->assertEquals(spl_object_hash($redis), spl_object_hash(Redis::getRedis()));

        Redis::setRedis();

    }

}
