<?php

namespace scratch\server;

interface ScratchRequest {

	/**
	 * Retrieve the IP Address of the remote client connection
	 * @return string
	 */
	public function getRemoteAddress();

	/**
	 * Retrieve the port number of the remote client connection
	 * @return integer
	 */
	public function getRemotePort();

	/**
	 * Retrieve the host name of the server processing the request
	 * @return string
	 */
	public function getServerName();

	/** 
	 * Retrieve the port number of the server connectio processing the request
	 * @return integer
	 */
	public function getServerPort();

	/**
	 * Indicates whether or not we're using a secure protocol (eg https)
	 * @return boolean
	 */
	public function isSecure();

	/**
	 * Retrieve the protocol being used for the current request, eg HTTP/1.1
	 * @return string
	 */
	public function getProtocol();

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