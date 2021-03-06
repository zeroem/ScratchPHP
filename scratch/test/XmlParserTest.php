<?php

class XmlParserTest extends PHPUnit_Framework_TestCase {

	static $xml_document;

	public static function setUpBeforeClass() {
		self::$xml_document = <<<XML
<?xml version="1.0" ?>

<root>
<element attr="attribute">
<child>with cdata</child>
</element>
</root>
XML;
	}

	public static function tearDownAfterClass() {
		self::$xml_document = NULL;
	}


	public function testTags() {
		$parser = new \scratch\util\xml\Parser();
		$observer = new XmlObserver();
		$parser->observe(\scratch\util\xml\Parser::XML_TAG_OPEN, $observer);
		$parser->observe(\scratch\util\xml\Parser::XML_TAG_CLOSE, $observer);
		$parser->observe(\scratch\util\xml\Parser::XML_CDATA, $observer);
		$parser->parse(self::$xml_document);
		$this->assertEquals(3,$observer->events[\scratch\util\xml\Parser::XML_TAG_OPEN]);
		$this->assertEquals(3,$observer->events[\scratch\util\xml\Parser::XML_TAG_CLOSE]);
		$this->assertEquals(1,$observer->events[\scratch\util\xml\Parser::XML_CDATA]);
	}
}

class XmlObserver implements \scratch\util\Observer {
	public $events = array();
	public function doObserve(\scratch\util\Event $event) {
		if(\scratch\util\ArrayUtils::get($this->events,$event->getType(),false) === false) {
			$this->events[$event->getType()] = 0;
		}
		$this->events[$event->getType()]++;
	}
}