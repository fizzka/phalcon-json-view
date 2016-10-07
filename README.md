# phalcon-json-view

Little stuff to make json responses in phalcon

## Installation

clone repo or `composer require fizzka/phalcon-json-view`

## Usage

### Step 1
Customize your phalcon events manager:

```php
use Fizz\Phalcon\JsonView\JsonView;
use Phalcon\Mvc\Dispatcher;

$di->set('dispatcher', function () use ($di) {
    $eventsManager = $di->getShared('eventsManager');

    $json = new JsonView();

    $eventsManager->attach('dispatch:afterDispatchLoop', $json);

    $dispatcher = new Dispatcher();

    $dispatcher->setEventsManager($eventsManager);
    return $dispatcher;
}, true);
```

### Step 2
Disable view:

```php
use Phalcon\Mvc\View;

$di->set('view', function () {
    $view = new View();
    $view->disable();
    return $view;
}, true);
```

### Step 3
Extend abstract class Fizz\Phalcon\JsonView\Controller;

```php
use Fizz\Phalcon\JsonView\Controller;

class ExampleController extends Controller
{
	public function indexAction()
	{
		return ['foo' => 'baz'];
	}
}
```

## Code example

Full-working example @see [example.php](example.php)

## License

MIT
