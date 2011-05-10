<?php

namespace scratch\util;

interface Context {
	public function get($name,$default);
}