<?php

namespace MuninPushApi\Tests;

use MuninPushApi\Base;

class BaseTest extends \PHPUnit_Framework_TestCase {

    public function testValidRedisInstance() {
        $this->assertInstanceOf('Redis', Base::getRedis());
    }

}
