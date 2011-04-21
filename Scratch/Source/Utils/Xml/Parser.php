<?php

  /*
	xml parser wrapper

	this really needs to be converted into a standard subject/observer pattern
	rather than these hard set functions

	Event Functions:
	    startTag - on encountering an opening tag
		endTag - on encoutnering a closing tag
		cdata - on encountering a text node
		startNamespace - on encountering the start of a namespace
		endNamespace - on encountering the end of a namespace
		externalEntity - on encountering an external entity
		notation - on encountering a notation, only found in DTDs
		default - on anything that isn't matched above, eg doc type, xml declaration, etc
   */
namespace Scratch\Utils\Xml;

/**
 * An Object Oriented Wrapper on PHP's XML Parser module
 */
class Parser {
	/**
	 * XML Parser Resource
	 * @var resource
	 */
	private $parser;
	private $chunkSize = 4096;

	/**
	 * List of Xml Event Listeners
	 * @var array
	 */
	private $listeners = array();

	public function __construct($encoding="UTF-8",$ns=false,$separator=":") {
		if($ns) {
			$this->parser = xml_parser_create_ns($encoding,$separator);
		} else {
			$this->parser = xml_parser_create($encoding);
		}

		// Register the xml even handlers
		xml_set_object($this->parser,$this);
		xml_set_element_handler($this->parser,"tagOpen","tagClose");
		xml_set_character_data_handler($this->parser,"cdata");
		xml_set_default_handler($this->parser,"misc");
		xml_set_start_namespace_decl_handler($this->parser,"startNamespaceDeclaration");
		xml_set_end_namespace_decl_handler($this->parser,"endNamespaceDeclaration");

		// Disable forced uppercase tag names
		$this->setOption(XML_OPTION_CASE_FOLDING,0);
		// Ignore Purely whitespace nodes
		$this->setOption(XML_OPTION_SKIP_WHITE,1);
	}

	public function parseStream(resource $res) {
		while(!feof($res)) {
			$data = fread($res,$this->chunkSize);
			$this->parse($data);
		}
	}

	public function parseUri($path) {
		$res = fopen($path,"r");
		if($res !== false) {
			$this->parseStream($res);
			fclose($res);
		} else {
			// throw file not found exception
		}
	}

	/**
	 * Wrapper on the xml_parse function.  Throws an exception on bad data
	 */
	public function parse($data) {
		$result = xml_parse($this->parser,$data);
		if($result === 0) {
			$code = xml_get_error_code($this->parser);
			$msg = xml_error_string($code);
			$byte = xml_get_current_byte_index($this->parser);
			$line = xml_get_current_line_number($this->parser);
			$column = xml_get_current_column_number($this->parser);

			// debate the merits of what type of exception should be thrown here...
			throw new \Exception(
			    "Error {$code}: {$msg}, at Byte {$byte}, Line {$line}, Column {$column}"
			);
		}
	}

	/**
	 * Add an Xml Event Parser to this parser
	 */
	public function addListener(\Scratch\Xml\BasicParserListener $parser) {
		$this->listeners[] = $parser;
	}

	private function tagOpen($parser,$name,$attr) {
		foreach($this->listeners as $listener) {
			$listener->tagOpen($this,$name,$attr);
		}
	}
	
	private function tagClose($parser,$name,$attr) {
		foreach($this->listeners as $listener) {
			$listener->tagClose($this,$name,$attr);
		}
	}

	private function cdata($parser,$data) {
		foreach($this->listeners as $listener) {
			$listener->cdata($this,$data);
		}
	}

	private function misc($parser,$data) {
		foreach($this->listeners as $listener) {
			$listener->misc($this,$data);
		}
	}

	private function startNamespaceDeclaration($parser,$prefix,$uri) {
		foreach($this->listeners as $listener) {
			$listener->startNamespaceDeclaration($this,$prefix,$uri);
		}
	}

	private function endNamespaceDeclaration($parser,$prefix,$uri) {
		foreach($this->listeners as $listener) {
			$listener->endNamespaceDeclaration($this,$prefix,$uri);
		}
	}



	public function __destruct() {
		xml_parser_free($this->parser);
	}

	/**
	 * Wrapper on xml_parser_set_option
	 * @param int  $option
	 * @param mixed $value
	 * @return boolean
	 */
	public function setOption($option,$value) {
		return xml_parser_set_option($this->parser,$option,$value);
	}

	/**
	 * Wrapper on xml_parser_get_option
	 * @param int  $option
	 * @return mixed
	 */
	public function getOption($option) {
		return xml_parser_get_option($this->parser,$option);
	}

	/**
	 * Retrieve the xml parser resource backing this object
	 * @return resource
	 */
	public function getParser() {
		return $this->parser;
	}

	public function setChunkSize($size) {
		$this->chunkSize = $size;
	}

	public function getChunkSize() {
		return $this->chunkSize;
	}

	public function getListeners() {
		return $this->listeners;
	}
}