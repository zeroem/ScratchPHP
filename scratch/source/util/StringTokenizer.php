<?php

namespace scratch\util;

class StringTokenizer implements ITokenize {
	private $delimiter = null;
	private $data;
	private $finished = false;

	private $offset = 0;

	public function __construct( $data ) {
		$this->data = $data;
	}

	public function next($delim = null, &$last=null) {
		$ret = false;

		if(func_num_args() > 0) {
			$last = $this->getDelimiter();
			$this->setDelimiter($delim);
		}

		if(!is_null($this->getDelimiter()) && !$this->isFinished()) {
			$off = $this->getOffset();
			$end = strpos($this->data,$this->getDelimiter(),$off);

			// If there's another instance of the delimiter before the end of the string
			if($end !== false) {
				$ret = substr($this->data,$this->getOffset(),$end - $off);
				$this->moveOffset($end - $off + 1);
			} else {
				$this->finish();
				$ret = substr($this->data,$this->getOffset());
			}
		}

		return $ret;
	}
	
	protected function finish() {
		$this->finished = true;
	}

	public function isFinished() {
		return $this->finished;
	}

	protected function getOffset() {
		return $this->offset;
	}

	protected function setOffset($off) {
		$this->offset = $off;
	}

	protected function moveOffset($off) {
		$this->offset += $off;
	}

	public function getDelimiter() {
		return $this->delimiter;
	}

	protected function setDelimiter($str) {
		$this->delimiter = $str;
	}
}