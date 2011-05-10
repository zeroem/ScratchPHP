<?php

namespace scratch\server\http;

interface ScratchHttpResponse extends \scratch\server\ScratchResponse {
	public function getCharacterEncoding();
	public function setContentType();
	public function getLocale();
	public function setLocale(\scratch\util\Locale $locale);
	public function addHeader($name, $value);
}