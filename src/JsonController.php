<?php

namespace Fizz\Phalcon;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Dispatcher;

abstract class JsonController extends Controller
{
    public function afterExecuteRoute(Dispatcher $dispatcher)
    {
        $data = $dispatcher->getReturnedValue();
        $dispatcher->setReturnedValue(['data' => $data]);

        $dispatcher->setParam('pretty', $this->request->has('pretty'));
    }
}
