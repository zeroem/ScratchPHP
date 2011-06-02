<?php

namespace scratch\server;

interface ScratchRequest {
	/**
	 * Get the preferred Locale for this request
	 * @return \scratch\util\Locale
	 */
	public function getLocale();

	/**
	 * Returns an array of Locales indicated as being supported by the client
	 * @return array
	 */
	public function getLocales();

	/**
     * Get the value of the named attribute or null if the attribute does not exist
	 * @param $name name of the attribute to retrieve
	 * @return mixed
	 */
	public function getAttribute($name);


	/**
	 * Retrieve an array of all currently set attributes
	 * @return array
	 */
	public function getAttributeNames();

	/**
	 * Set the named attribute to the given value
	 * @param string $name name of the attribute to set
	 * @param mixed $value value to set the attribute to
	 */
	public function setAttribute($name,$value);

	/**
	 * Remove the attribute with the given name
	 * @param string $name attribute to remove
	 */
	public function removeAttribute($name);
}