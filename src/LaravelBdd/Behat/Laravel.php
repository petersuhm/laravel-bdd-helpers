<?php

namespace LaravelBdd\Behat;

/**
 * Behat context trait to initialize a Laravel testing environment.
 */
trait Laravel
{
    /**
     * The Illuminate application instance.
     *
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * Path to Laravel's 'bootstrap/start.php' file.
     *
     * @var string
     */
    protected $pathToStartFile;

    /**
     * Prepare the test environment.
     *
     * @return void
     */
    public function prepareApplication($pathToStartFile)
    {
        if ( ! file_exists($pathToStartFile))
        {
            throw new \Exception("File {$pathToStartFile} does not exists. Please provide the path to 'bootstrap/start.php'.");
        }

        $this->pathToStartFile = $pathToStartFile;

        if ( ! $this->app)
        {
            $this->refreshApplication();
        }
    }

    /**
     * Creates the application.
     *
     * @return \Symfony\Component\HttpKernel\HttpKernelInterface
     */
    public function createApplication()
    {
        $unitTesting = true;

        $testEnvironment = (isset($this->env)) ? $this->env : 'testing';

        return require $this->pathToStartFile;
    }

    /**
     * Refresh the application instance.
     *
     * @return void
     */
    protected function refreshApplication()
    {
        $this->app = $this->createApplication();

        $this->app->setRequestForConsoleEnvironment();

        $this->app->boot();
    }
}
