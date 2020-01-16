<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "vendor/autoload.php";

$client = new \Predis\Client([
    'scheme' => 'tcp',
    'host' => '127.0.0.1',
    'port' => '6379',
    'password' => null
]);

$client->set('name', 'Bojan');

$cache = new \App\Cache\RedisAdapter($client);

//$cache->put('job', 'developer',1);

echo $cache->get('job');

//echo $cache->remember('name', function (){
//    return "Pero";
//});