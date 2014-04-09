<?php

namespace MuninPushApi\Tests;

use MuninPushApi\Config;
use \Zend\Config\Config as ZendConfig;

class ConfigTest extends \PHPUnit_Framework_Testcase {

    public function testYamlInstalled() {
        $this->assertTrue(function_exists('yaml_parse'), 'Install YAML http://www.php.net/manual/en/book.yaml.php');
    }

    public function testGetConfigReturnZendConfig() {
        $this->assertInstanceOf('Zend\Config\Config', Config::getConfig());
    }

    public function testConfigSinglton() {
        $this->assertEquals(spl_object_hash(Config::getConfig()), spl_object_hash(Config::getConfig()));
    }

    public function testSetConfig() {

        $zfConfig = new ZendConfig([]);

        Config::setConfig($zfConfig);

        $this->assertEquals(spl_object_hash($zfConfig), spl_object_hash(Config::getConfig()));

    }

}
