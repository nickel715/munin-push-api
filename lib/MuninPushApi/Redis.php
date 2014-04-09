<?php

namespace MuninPushApi;


/**
 *
 */
class Redis {

    /**
     * Redis object
     *
     * @var \Redis
     */
    protected static $redis = NULL;

    public static function getRedis() {

        if (!static::$redis instanceof \Redis) {
            static::$redis = new \Redis();
            static::$redis->connect(Config::getConfig()->redis->connection);
        }

        return static::$redis;

    }

    public static function setRedis(\Redis $redis = null) {
        static::$redis = $redis;
    }

}
