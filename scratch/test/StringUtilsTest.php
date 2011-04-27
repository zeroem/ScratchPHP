<?php

class StringUtilsTest extends PHPUnit_Framework_TestCase {
	/**
	 * @covers \scratch\utils\StringUtils
	 */
	public function testStringUtils() {
		$null = NULL;
		$empty = "";
		$blank = "  ";
		$char = "abc";

		$this->assertTrue(\scratch\utils\StringUtils::isEmpty($null));
		$this->assertTrue(\scratch\utils\StringUtils::isEmpty($empty));
		$this->assertFalse(\scratch\utils\StringUtils::isEmpty($blank));
		$this->assertFalse(\scratch\utils\StringUtils::isEmpty($char));

		$this->assertTrue(\scratch\utils\StringUtils::isBlank($null));
		$this->assertTrue(\scratch\utils\StringUtils::isBlank($empty));
		$this->assertTrue(\scratch\utils\StringUtils::isBlank($blank));
		$this->assertFalse(\scratch\utils\StringUtils::isBlank($char));
	}
}