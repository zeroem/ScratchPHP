<?php

namespace scratch\utils;

class StringUtils {
	/**
	 * Determines if a string is blank.  
	 * 
	 * A blank string is one that is equal to null, an empty string,
	 * or only contains whitespace characters
	 *
	 * @param string $val Value to test
	 * @return boolean
	 */
	static function isBlank(&$val) {
		if(is_null($val)) {
			return true;
		} else {
			return trim($val) == "";
		}
	}

	/**
	 * Convenience function for !StringUtils::isBlank()
	 *
	 * @param string $val
	 * @return boolean
	 */
	static function isNotBlank(&$val) {
		return !self::isBlank($val);
	}

	/**
	 * Determine if a string is empty.
	 *
	 * A string is considered empty if it is null or contains
	 * no characters.
	 *
	 * @param string $val value to test
	 * @return boolean
	 */
	static function isEmpty(&$val) {
		if(is_null($val)) {
			return true;
		} else {
			return $val == "";
		}
	}

	/**
	 * Convenience function for !StringUtils::isEmpty()
	 *
	 * @param string $val value to test
	 * @return boolean
	 */
	static function isNotEmpty(&$val) {
		return !self::isEmpty($val);
	}
}