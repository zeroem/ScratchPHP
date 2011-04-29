<?php

namespace scratch\util;

/**
 * Object representation of a standard BCP 47 Locale
 */
class Locale extends AbstractLocale {
	/**
	 * Two letter language code
	 * @var string
	 */
	private $language = "";
	
	/**
	 * Two letter country code
	 * @var string
	 */
	private $country = "";

	/**
	 * Character Encoding
	 * @var string
	 */
	private $codeset = "";

	/**
	 * The modifier (not really sure what this is for...)
	 * @var string
	 */
	private $modifier = "";

	public function __construct($language = "",$country = "",$codeset = "",$modifier = "") {
		$this->language = $language;
		$this->country = $country;
		$this->codeset = $codeset;
		$this->modifier = $modifier;
	}

	/**
	 * Converts a formatted string into a Locale Object
	 */
	public static function makeLocale($str) {
		
	}

	public function getLanguage() {
		return $this->language;
	}

	public function getCountry() {
		return $this->country;
	}

	public function getCodeset() {
		return $this->codeset;
	}

	public function getModifier() {
		return $this->modifier;
	}
}