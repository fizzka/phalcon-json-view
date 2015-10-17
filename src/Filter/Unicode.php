<?php

namespace Fizz\Phalcon\Filter;

/**
 * filter to refine non-latin1 characters in json, produced php < 5.5
 */
class Unicode {

	public function filter($input) {
		return self::removeUnicodeSequences($input);
	}

	protected function removeUnicodeSequences($string) {
		return preg_replace_callback('/\\\\u([a-f0-9]{4})/i', function($m) {
			return mb_convert_encoding(pack('H*', strtolower($m[1])), 'UTF-8', 'UTF-16');
		}, $string);
	}
}
