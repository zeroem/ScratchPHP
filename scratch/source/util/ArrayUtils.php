<?php

namespace scratch\utils;

class ArrayUtils {
	static function &get(&$arr,$key,$default=null) {
		$ret = null;
		if(array_key_exists($key,$arr)) {
			$ret = &$arr[$key];
		} else if(func_num_args() > 2) {
			$ret = $default;
		} else {
			throw new \Exception("The key '{$key}' does not exist in the given array");
		}

		return $ret;
	}
}