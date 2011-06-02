<?php

namespace scratch\util;

class AssertionException extends \RuntimeException {
	public function __construct($msg=null,$code=0,$prev=null) {
		parent::__construct($msg,$code,$prev);
	}
}