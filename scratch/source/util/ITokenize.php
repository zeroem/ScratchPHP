<?php

namespace scratch\util;

interface ITokenize {
	public function next($token=null,&$last=null);
}