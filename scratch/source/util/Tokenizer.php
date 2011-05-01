<?php

namespace scratch\util;

interface Tokenizer {
	public function next($token=null,&$last=null);
}