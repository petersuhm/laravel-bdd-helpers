<?php

namespace LaravelBdd\Behat;

/**
 * Behat context trait to set the environment to be used by Laravel.
 */
trait Environment
{
    /**
     * The name of the environment.
     *
     * @var string
     */
    protected $env;

    /**
     * Set the name of the environment to use.
     *
     * @param  string  $env
     * @return void
     */
    protected function setEnvironment($env)
    {
        $this->env = $env;
    }
}
