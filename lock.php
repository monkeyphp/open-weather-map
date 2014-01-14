<?php
require 'vendor/autoload.php';

use OpenWeatherMap\Lock\Lock;

$lock = Lock::getInstance();
$lock->setLockFile('./my.lock');
$lock->setLockLifetime(10);


for ($i = 0; $i < 1000; $i++) {
    echo '[' . $i . ']';
    if ($lock->lock() === false) {
        echo 'Could not get the lock' . PHP_EOL;
    } else {
        echo 'Got the lock' . PHP_EOL;
        sleep(rand(2, 4));
        $lock->unlock();
    }
    usleep(rand(100000, 500000));
}
