<?php

namespace Scratch\Utils;

class Event {
	/**
	 * Source of the event
	 * @var \Scratch\Utils\Subject
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

	public function __construct(\Scratch\Utils\Subject $src, $type, $data = null) {
		$this->src = $src;
		$this->type = $type;
		$this->data = $data;
	}

	public function getSource() {
		return $this->src;
	}

	public function getType() {
		return $this->type;
	}

	public function getData() {
		return $this->data;
	}
}