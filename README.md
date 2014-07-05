Laravel BDD Helpers
===================

Stuff that helps you do BDD in a Laravel context.

_This is stil WIP, but feel free to start using it in your projects!_

## Content

1. [Installation](#installation)
2. [Laravel Behat Context](#laravel-behat-context)
3. [Laravel HTTP client context](#laravel-http-client-context)
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

## Laravel HTTP client context

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
