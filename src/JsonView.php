<?php

namespace Fizz\Phalcon;

use Phalcon\Mvc\User\Plugin;
use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;
use Fizz\Phalcon\Filter\Unicode as FilterUnicode;

class JsonView extends Plugin {
	public function afterDispatchLoop(Event $event, Dispatcher $dispatcher) {
		$data = $dispatcher->getReturnedValue();
		if (is_array($data)) {
			$f = new FilterUnicode();
			$data = $f->filter(json_encode($data));
		}

		$this->response->setContentType('application/json', 'UTF-8');
		$this->response->setContent($data);
		$dispatcher->setReturnedValue($this->response);
	}
}
