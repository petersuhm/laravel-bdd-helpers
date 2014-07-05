Laravel BDD Helpers
===================

Stuff that helps you do BDD in a Laravel context.

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

Now you can interact with the `Application` instance like you can in Laravel's default `TestCase`.
