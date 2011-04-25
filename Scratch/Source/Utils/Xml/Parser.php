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
class Parser extends \Scratch\Utils\Subject {
	const XML_TAG_OPEN = "xml.tag.open";
	const XML_TAG_CLOSE = "xml.tag.close";
	const XML_CDATA = "xml.cdata";
	const XML_NS_START = "xml.namespace.start";
	const XML_NS_END = "xml.namespace.end";
	const XML_EXTERNAL_ENTITY = "xml.external_entity";
	const XML_UNPARSED_ENTITY = "xml.unparsed_entity";
	const XML_NOTATION = "xml.notation";
	const XML_PI = "xml.processing_instructions";
	const XML_DEFAULT = "xml.default";


	/**
	 * XML Parser Resource
	 * @var resource
	 */
	private $parser;
	private $chunkSize = 4096;

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
		xml_set_notation_decl_handler($this->parser,"notation");

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

	private function tagOpen($parser,$name,$attr) {
		$this->notify($this->makeEvent(self::XML_TAG_OPEN,array("name"=>$name,"attributes"=>$attr)));
	}
	
	private function tagClose($parser,$name) {
		$this->notify($this->makeEvent(self::XML_TAG_CLOSE,array("name"=>$name)));
	}

	private function cdata($parser,$data) {
		$this->notify($this->makeEvent(self::XML_CDATA,$data));
	}

	private function misc($parser,$data) {
		$this->notify($this->makeEvent(self::XML_DEFAULT,$data));
	}

	private function startNamespaceDeclaration($parser,$prefix,$uri) {
		$this->notify($this->makeEvent(self::XML_NS_START,array("prefix"=>$prefix,"uri"=>$uri)));
	}

	private function endNamespaceDeclaration($parser,$prefix,$uri) {
		$this->notify($this->makeEvent(self::XML_NS_START,array("prefix"=>$prefix,"uri"=>$uri)));
	}

	private function notation($parser,$name,$base,$sys_id,$pub_id) {
		$this->notify($this->makeEvent(self::XML_NS_START,array("name"=>$name,
																"base"=>$base,
																"system_id"=>$sys_id,
																"public_id"=>$pub_id
																)));
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