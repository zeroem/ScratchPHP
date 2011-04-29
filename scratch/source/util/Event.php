<?php

namespace scratch\util;

class Event {
	/**
	 * Source of the event
	 * @var \scratch\util\Subject
	 */
	private $src;

	/**
	 * The type of event
	 * @var string
	 */
	private $type;

	/**
	 * Data related to the event
	 * @var mixed
	 */
	private $data = null;

	public function __construct(\scratch\util\AbstractSubject $src, $type, $data = null) {
		$this->src = $src;
		$this->type = $type;
		$this->data = $data;
	}

	/**
	 * @return AbstractSubject
	 */
	public function getSource() {
		return $this->src;
	}

	/**
	 * @return string
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * @return mixed
	 */
	public function getData() {
		return $this->data;
	}

	public function isType($str) {
		return $str === $this->getType();
	}
}