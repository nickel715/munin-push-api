<?php

namespace MuninPushApi;

use Redis;
use MuninPushApi\Config;

abstract class Base {

    protected $name = '';

    public function __construct($name) {
        $this->name = $name;
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

    protected function getGraph() {
        return Config::getConfig()->graphs->get($this->name);
    }

}
