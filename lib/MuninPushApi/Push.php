<?php

namespace MuninPushApi;

use MuninPushApi\Config;

/**
 *
 */
class Push extends Base {

    const PHP_PUTDATA = 'php://input';
    const PHP_STDIN   = 'php://stdin';

    /**
     * Write data from given filename to redis
     *
     * @param string $filename
     */
    public function import($filename = self::PHP_PUTDATA) {

        $fh = fopen($filename, 'r');

        while (($row = fgets($fh)) !== false) {

            if (!empty($row)) {
                $data = explode(' ', $row);
                self::getRedis()->set($this->getRedisKey(trim($data[0])), trim($data[1]), Config::getConfig()->redis->ttl);
            }

        }

    }

}

