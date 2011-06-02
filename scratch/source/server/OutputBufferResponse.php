<?php

namespace scratch\server;

class OutputBufferResponse implements ScratchResponse {
	private $committed = false;

	public function __construct(ResponseFilter $filter=null, $chunkSize = 0, $eraseOnFlush = true ) {
		ob_start($filter,$chunkSize,$eraseOnFlush);
	}

	public function flush() {
		$this->flushBuffer();
	}

	public function flushBuffer() {
		$this->committed = true;
		ob_flush();
	}

	public function getBufferSize() {
		return ob_get_length();
	}

	public function isCommitted() {
		return $this->committed;
	}

	public function reset() {
		$this->resetBuffer();
	}

	public function resetBuffer() {
		ob_clean();		
	}

	public function append($data) {
		echo $data;
	}

	public function __destruct() {
		$this->flushBuffer();
		ob_end();
	}
}