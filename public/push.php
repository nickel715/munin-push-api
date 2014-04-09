<?php

require_once __DIR__.'/../vendor/autoload.php';

use MuninPushApi\Push;

if (!empty($_GET['name'])) {
    $name = $_GET['name'];
} else {
    die('name required');
}

$push = new Push($name);
$push->import(Push::PHP_PUTDATA);
