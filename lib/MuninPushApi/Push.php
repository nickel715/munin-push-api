<?php

namespace MuninPushApi;

use Redis;
use SplFileObject;
use MuninPushApi\Config;

/**
 *
 */
class Push {

    protected $category = 'other';
    protected $redis = NULL;

    const PHP_PUTDATA = 'php://input';
    const PHP_STDIN   = 'php://stdin';

    public function __construct($category = 'other') {
        $this->category = $category;
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

        $parts[] = $this->category;
        $parts[] = $key;

        return implode(':', $parts);
    }

    public function getRedis() {

        if (!$this->redis instanceof Redis) {
            $this->redis = new Redis();
            $this->redis->connect(Config::getConfig()->redis->connection);
        }

        return $this->redis;

    }

    /**
     * Write data from given filename to redis
     *
     * @param string $filename
     */
    public function import($filename = self::PHP_PUTDATA) {

        $input = new SplFileObject($filename);
        $redis = $this->getRedis();
        $ttl   = Config::getConfig()->redis->ttl;

        foreach ($input as $row) {

            if (!empty($row)) {
                $data = explode(' ', $row);
                echo $redis->set($this->getRedisKey(trim($data[0])), trim($data[1]), $ttl);
            }

        }

    }

}

