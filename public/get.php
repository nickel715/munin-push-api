#!/bin/env php
<?php

require_once __DIR__.'/../vendor/autoload.php';

use MuninPushApi\Get;
use MuninPushApi\Config;

if (!empty($argv[1])) {
    $name = $argv[1];
} else {
    die('Arg1');
}

$get = new Get($name);
if (!empty($argv[2]) && $argv[2] === 'config') {
    echo $get->getRawConfig();
} else {
    echo $get->getRawValues();
}
