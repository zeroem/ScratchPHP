<?php

namespace scratch\server\http;

interface ScratchHttpRequest extends \scratch\server\ScratchRequest {

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
}