<?php

namespace scratch\util;
/**
 * Various tools for runtime logic checking via assertions
 */
class RuntimeUtils {
	/**
	 * Assert that the given value evaulates to true.  Throws an
	 * AssertionException if it fails.
	 *
	 * @param mixed $value value to test
	 * @param string $msg optional message to use with the exception
	 */
	static function assert($value,$msg=null) {
		if(!$value) {
			if(!isset($msg)) {
				$msg = "Failed call to " . __FUNCTION__;
			}
			throw new \scratch\util\AssertionException($msg);
		}
	}

	/**
	 * Assert that the given value is equal to (===) true. Throws an
	 * AssertionException if it fails.
	 *
	 * @param mixed $value value to test
	 * @param string $msg optional message to use with the exception
	 */
	static function assertTrue($value,$msg=null) {
		if($value!==true) {
			if(!isset($msg)) {
				$msg = "Failed call to " . __FUNCTION__ . " with value: " . var_export($value,true);
			}
			throw new \scratch\util\AssertionException($msg);
		}
	}

	/**
	 * Assert that the given value is equal to (===) false. Throws an
	 * AssertionException if it fails.
	 *
	 * @param mixed $value value to test
	 * @param string $msg optional message to use with the exception
	 */
	static function assertFalse($value,$msg=null) {
		if($value!==false) {
			if(!isset($msg)) {
				$msg = "Failed call to " . __FUNCTION__ . " with value: " . var_export($value,true);
			}
			throw new \scratch\util\AssertionException($msg);
		}
	}
}