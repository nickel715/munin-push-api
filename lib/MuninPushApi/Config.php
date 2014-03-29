<?php

namespace MuninPushApi;

use Zend\Config\Factory as ConfigFactory;

/**
 *
 */
class Config {

    /**
     * Config object
     *
     * @var \Zend\Config\Config
     */
    protected static $config = NULL;

    public static function getConfig() {

        if (empty(self::$config)) {
            self::$config = ConfigFactory::fromFile(__DIR__.'/../../config.yaml', true);
        }

        return self::$config;

    }

}
