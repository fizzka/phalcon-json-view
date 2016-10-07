<?php

namespace Fizz\Phalcon\JsonView;

use Phalcon\Mvc\Controller as PhalconController;
use Phalcon\Mvc\Dispatcher;

abstract class Controller extends PhalconController
{
    public function afterExecuteRoute(Dispatcher $dispatcher)
    {
        $data = $dispatcher->getReturnedValue();
        $dispatcher->setReturnedValue(['data' => $data]);

        $dispatcher->setParam('pretty', $this->request->has('pretty'));
    }
}
