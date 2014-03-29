<?php

require_once __DIR__.'/../vendor/autoload.php';

use MuninPushApi\Push;

$category = 'other';

if (!empty($_GET['category'])) {
    $category = $_GET['category'];
}

$push = new Push($category);
$push->import(Push::PHP_PUTDATA);
