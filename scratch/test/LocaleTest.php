<?php

class LocaleTest extends PHPUnit_Framework_TestCase {
	public function testLocale() {
		$lang = "en";
		$coun = "US";
		$char = "UTF-8";
		$mod = "derp";

		$locale_l = new \scratch\util\Locale($lang);
		$locale_lc = new \scratch\util\Locale($lang,$coun);
		$locale_lcc = new \scratch\util\Locale($lang,$coun,$char);
		$locale_lccm = new \scratch\util\Locale($lang,$coun,$char,$mod);

		$this->assertEquals($lang,$locale_lccm->getLanguage());
		$this->assertEquals($coun,$locale_lccm->getCountry());
		$this->assertEquals($char,$locale_lccm->getCodeset());
		$this->assertEquals($mod,$locale_lccm->getModifier());

		$this->assertEquals("{$lang}","{$locale_l}");
		$this->assertEquals("{$lang}_{$coun}","{$locale_lc}");
		$this->assertEquals("{$lang}_{$coun}.{$char}","{$locale_lcc}");
		$this->assertEquals("{$lang}_{$coun}.{$char}@{$mod}","{$locale_lccm}");
	}
}