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
     * @param string $env
     * @param string $export optional
     * @return void
     */
    protected function setEnvironment($env = 'testing', $export = 'APP_ENV')
    {
        $this->env = $env;

        if ( ! is_null($export)) {
            putenv("{$export}={$env}");
        }
    }
}
