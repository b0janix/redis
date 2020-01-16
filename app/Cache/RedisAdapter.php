<?php

namespace App\Cache;

use App\Cache\CacheInterface;
use Predis\Client;

class RedisAdapter implements CacheInterface{

    protected $client;

    public function __construct(Client $client)
    {
        //comment added
        $this->client = $client;

    }

    public function get($key)
    {
        return $this->client->get($key);
    }
    public function put($key, $value, $minutes = null)
    {
        if($minutes === null)
        {
            return $this->forever($key, $value);
        }

        $seconds = (int) max(1,$minutes*60);

        return $this->client->setex($key, $seconds, $value);
    }
    public function forever($key, $value)
    {
        return $this->client->set($key,$value);
    }
    public function remember($key, callable $callback, $minutes = null)
    {
        if(!is_null($value = $this->client->get($key)))
        {
            return $value;
        }

        $this->client->put($key, $value = $callback(), $minutes);

        return $value;

    }
    public function forget($key)
    {
        return $this->client-del($key);
    }

}
