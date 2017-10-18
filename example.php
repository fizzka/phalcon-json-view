<?php

use Fizz\Phalcon\JsonView\JsonView;
use Fizz\Phalcon\JsonView\Controller;

use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\View;

use Phalcon\DI\FactoryDefault as DI;
use Phalcon\Mvc\Application as PhalconApp;

include 'vendor/autoload.php';

$di = new DI();

# Step 1
$di->set('dispatcher', function () use ($di) {
    $eventsManager = $di->getShared('eventsManager');

    $json = new JsonView();

    $eventsManager->attach('dispatch:afterDispatchLoop', $json);

    $dispatcher = new Dispatcher();

    $dispatcher->setEventsManager($eventsManager);
    return $dispatcher;
}, true);

# Step 2
$di->set('view', function () {
    $view = new View();
    $view->disable();
    return $view;
}, true);

# Step 3
class ExampleController extends Controller
{
    public function indexAction()
    {
        return ['foo' => 'baz'];
    }
}

$app = new PhalconApp($di);
echo $app->handle('/example/index')->getContent();
