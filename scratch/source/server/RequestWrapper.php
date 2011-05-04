<?php

namespace scratch\server;

class RequestWrapper implements ScratchRequest {
	/**
	 * Output attributes of the request
	 * @var array
	 */
	private $attributes = array();

	/**
     * Get the value of the named attribute or null if the attribute does not exist
	 * 
	 * @param $name name of the attribute to retrieve
	 * @return mixed
	 */
	public function getAttribute($name) {
		return \scratch\util\ArrayUtils::get($this->attributes,$name,null);
	}

	/**
	 * Retrieve an array of all currently set attributes
	 *
	 * @return array
	 */
	public function getAttributeNames() {
		return array_keys($this->attributes);
	}

	/**
	 * Set the named attribute to the given value
	 *
	 * @param string $name name of the attribute to set
	 * @param mixed $value value to set the attribute to
	 */
	public function setAttribute($name,$value) {
		$this->attributes[$name] = $value;
	}

	/**
	 * Remove the attribute with the given name
	 * 
	 * @param string $name attribute to remove
	 */
	public function removeAttribute($name) {
		unset($this->attributes[$name]);
	}
}