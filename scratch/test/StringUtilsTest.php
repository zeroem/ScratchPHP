<?php

class StringUtilsTest extends PHPUnit_Framework_TestCase {
	/**
	 * @covers \scratch\util\StringUtils
	 */
	public function testStringUtils() {
		$null = NULL;
		$empty = "";
		$blank = "  ";
		$char = "abc";

		$this->assertTrue(\scratch\util\StringUtils::isEmpty($null));
		$this->assertTrue(\scratch\util\StringUtils::isEmpty($empty));
		$this->assertFalse(\scratch\util\StringUtils::isEmpty($blank));
		$this->assertFalse(\scratch\util\StringUtils::isEmpty($char));
		$this->assertTrue(\scratch\util\StringUtils::isNotEmpty($blank));


		$this->assertTrue(\scratch\util\StringUtils::isBlank($null));
		$this->assertTrue(\scratch\util\StringUtils::isBlank($empty));
		$this->assertTrue(\scratch\util\StringUtils::isBlank($blank));
		$this->assertFalse(\scratch\util\StringUtils::isBlank($char));
		$this->assertTrue(\scratch\util\StringUtils::isNotBlank($char));
	}
}