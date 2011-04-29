<?php

namespace scratch\util;

abstract class AbstractLocale {
	abstract public function getLanguage();
	abstract public function getCountry();
	abstract public function getCodeset();
	abstract public function getModifier();

	final public function __toString() {
		$ret = "";
		if(StringUtils::isNotBlank($this->getLanguage())) {
			$ret .= $this->getLanguage();

			if(StringUtils::isNotBlank($this->getCountry())) {
				$ret .= "_{$this->getCountry()}";

				if(StringUtils::isNotBlank($this->getCodeset())) {
					$ret .= ".{$this->getCodeset()}";

					if(StringUtils::isNotBlank($this->getModifier())) {
						$ret .= "@{$this->getModifier()}";
					}
				}
			}
		}

		return $ret;
	}
}