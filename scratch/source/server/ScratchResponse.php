<?php

namespace scratch\server;

interface ScratchResponse {
	public function flush();
	public function flushBuffer();
	public function getBufferSize();
	public function isCommitted();
	public function reset();
	public function resetBuffer();
	public function append($data);
}