<?php

class RuntimeUtilsTest extends PHPUnit_Framework_TestCase {
	public function testAssertions() {
		\scratch\util\RuntimeUtils::assert("1");
		\scratch\util\RuntimeUtils::assert(true);
		\scratch\util\RuntimeUtils::assert("afadf");
		\scratch\util\RuntimeUtils::assertTrue(true);
		\scratch\util\RuntimeUtils::assertFalse(false);
	}
	/**
	 * @expectedException \scratch\util\AssertionException
	 */
	public function testAssertException() {
		\scratch\util\RuntimeUtils::assert("0");
	}

	/**
	 * @expectedException \scratch\util\AssertionException
	 */
	public function testAssertTrueException() {
		\scratch\util\RuntimeUtils::assertTrue(false);
	}

	/**
	 * @expectedException \scratch\util\AssertionException
	 */
	public function testAssertFalseException() {
		\scratch\util\RuntimeUtils::assertFalse(true);
	}
}