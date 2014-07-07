Laravel BDD Helpers
===================

Stuff that helps you do BDD in a Laravel context.

_This is stil WIP, but feel free to start using it in your projects!_

## Content

1. [Installation](#installation)
2. [Laravel Behat Context](#laravel-behat-context)
3. [Environment Behat Context](#environment-behat-context)
3. [HTTP client Behat context](#http-client-behat-context)
4. [Real life examples](#real-life-examples)

## Installation

Install it trough Composer:

```
"suhm/laravel-bdd-helpers": "dev-master"
```

## Laravel Behat context

The Laravel Behat context trait makes a Laravel `Application` instance available to you in your Behat features.

Use it like this:

```php
<?php

use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Behat context class.
 */
class FeatureContext implements SnippetAcceptingContext
{
    use LaravelBdd\Behat\Laravel;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context object.
     * You can also pass arbitrary arguments to the context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->prepareApplication(__DIR__.'/../../bootstrap/start.php');
    }
}
```

Now you can interact with the `Application` instance like you can with Laravel's default `TestCase`.

## Environment Behat Context

By default, the Laravel context will set the environment to `testing`. If you need to set the environment to something else, or maybe you aren't using the Laravel context trait but still need to load your test configuration files (this is not yet tested with the Mink extension).

The `Environment` trait includes a method called `setEnvironment()`. The first parameter is the name of the environment, and defaults to `testing`. The second parameter is the name of the environment var to export, and defaults to `APP_ENV`.

You can set the environment name of your application and optionally export it:

```php
<?php

use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Behat context class.
 */
class FeatureContext implements SnippetAcceptingContext
{
    use LaravelBdd\Behat\Environment;
    use LaravelBdd\Behat\Laravel;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context object.
     * You can also pass arbitrary arguments to the context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->setEnvironment(); // Default env is 'testing', export 'APP_ENV=testing'
        $this->setEnvironment('acceptance'); // Set env to 'acceptance' and export 'APP_ENV=acceptance'
        $this->setEnvironment('testing', 'SOMETING'); // Set env to testing and export 'SOMETHING=testing'
        $this->prepareApplication(__DIR__.'/../../bootstrap/start.php');
    }
}
```

## HTTP client Behat context

If you need to hit routes and controller actions, you can use this trait to get an instance of the Laravel HTTP client.

You can then do stuff like this:

```php
<?php

use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Behat context class.
 */
class FeatureContext implements SnippetAcceptingContext
{
    use LaravelBdd\Behat\Laravel;
    use LaravelBdd\Behat\HttpClient;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context object.
     * You can also pass arbitrary arguments to the context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->prepareApplication(__DIR__.'/../../bootstrap/start.php');
        $this->createClient();
    }

    /**
     * @When I visit :uri
     */
    public function iVisit($uri)
    {
        $this->client->request('GET', $uri);
    }
```

## Real life examples

For real life examples of doing BDD in a Laravel context, please see this repository: https://github.com/petersuhm/laravel-bdd
