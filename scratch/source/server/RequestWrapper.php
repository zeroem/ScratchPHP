<?php

namespace scratch\server;

class RequestWrapper implements ScratchRequest {
	/**
	 * Output attributes of the request
	 * @var array
	 */
	private $attributes = array();

	/**
	 * Request protocol, eg HTTP/1.1
	 * @var string
	 */
	private $protocol;

	/**
	 * List of acceptable locales the client will accept content in
	 * @var array \scratch\util\Locale
	 */
	private $locales;

	/**
	 * The host name of the server processing the request
	 * @var string
	 */
	private $serverName;

	/**
	 * The ip of the server processing the request
	 * @var string
	 */
	private $serverAddress;

	/**
	 * The port number on which the request was recieved
	 * @var integer
	 */
	private $serverPort;

	/**
	 * Whether or not this is a secure request
	 * @var boolean
	 */
	private $secure;

	private $remoteAddress;

	private $remotePort;

	public function getRemoteHost() {
		return $this->remoteHost;
	}

	public function setRemoteHost($value) {
		$this->remoteHost = $value;
	}

	public function getRemoteAddress() {
		return $this->remoteAddress;
	}

	public function setRemoteAddress($value) {
		$this->remoteAddress = $value;
	}

	public function getRemotePort() {
		return $this->remotePort;
	}

	public function setRemotePort($value) {
		$this->remotePort = $value;
	}

	public function getServerName() {
		return $this->serverName;
	}

	public function setServerName($value) {
		$this->serverName = $value;
	}

	public function getServerPort() {
		return $this->serverPort;
	}

	public function setServerPort($value) {
		$this->serverPort = $value;
	}

	public function isSecure() {
		return $this->secure;
	}

	public function setSecure($value) {
		$this->secure = $value;
	}

	public function getProtocol() {
		return $this->protocol;
	}

	public function setProtocol($value) {
		$this->protocol = $value;
	}

	/**
	 * Get the preferred Locale for this request
	 *
	 * @return \scratch\util\Locale
	 */
	public function getLocale() {
		if(!empty($this->locales)) {
			return reset($this->locales);
		} else {
			return null;
		}
	}

	/**
	 * Returns an array of Locales indicated as being supported by the client
	 *
	 * @return array
	 */
	public function getLocales() {
		return $this->locales;
	}

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