<?php

namespace MuninPushApi;

use Redis;
use MuninPushApi\Config;

abstract class Base {

    protected static $redis = NULL;

    protected $name = '';

    public function __construct($name) {
        $this->name = $name;
    }

    public static function getRedis() {

        if (!self::$redis instanceof Redis) {
            self::$redis = new Redis();
            self::$redis->connect(Config::getConfig()->redis->connection);
        }

        return self::$redis;

    }

}
