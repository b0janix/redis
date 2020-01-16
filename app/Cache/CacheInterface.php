<?php

namespace App\Cache;

interface CacheInterface{

    public function get($key);
    public function put($key, $value, $minutes = null);
    public function forever($key, $value);
    public function remember($key, callable $callback, $minutes = null);
    public function forget($key);

}
