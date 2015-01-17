<?php

namespace MuninPushApi\Tests;

use MuninPushApi\Get;
use MuninPushApi\Config;

class GetTest extends \PHPUnit_Framework_Testcase {

    protected $get = NULL;
    protected $redisKey = '';

    public function setUp() {

        $graph  = 'diskusage';
        $prefix = 'munin-push-api'; #Config::getConfig()->redis->prefix;

        $this->get  = $this->getMock('MuninPushApi\Get', array(), array($graph));

        #$this->get      = new Get($graph);
        $this->redisKey = $prefix.':'.$graph;

    }


    public function testGetRawValues() {

        $this->get->expects($this->any())
                  ->method('getGraph');

        $this->get->getRawValues();
        #$rawValues = 'usage.value 10'.PHP_EOL.'system.value 20';
        #$this->assertEquals($rawValues, $this->get->getRawValues());
    }

    public function testGetRawConfig() {
        #$rawConfig = 'graph_title diskusage'.PHP_EOL;
        #$this->assertEquals($rawConfig, $this->get->getRawValues());
    }


}
