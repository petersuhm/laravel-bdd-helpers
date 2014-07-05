<?php

namespace LaravelBdd\Behat;

/**
 * Behat context trait to initialize a Laravel HTTP client.
 */
trait HttpClient
{
    /**
     * The HttpKernel client instance.
     *
     * @var \Illuminate\Foundation\Testing\Client
     */
    protected $client;

    /**
     * Create a new HttpKernel client instance.
     *
     * @param  array  $server
     * @return \Symfony\Component\HttpKernel\Client
     */
    protected function createClient(array $server = array())
    {
        return new Client($this->app, $server);
    }
}
