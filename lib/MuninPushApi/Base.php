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

    /**
     * Get redis key
     *
     * @param  string $key
     * @return string
     */
    public function getRedisKey($key) {

        $prefix = Config::getConfig()->redis->prefix;

        $parts = [];

        if (!empty($prefix)) {
            $parts[] = $prefix;
        }

        $parts[] = $this->name;
        $parts[] = $key;

        return implode(':', $parts);
    }

}
