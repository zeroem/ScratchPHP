<?php

class StringTokenizerTest extends PHPUnit_Framework_TestCase {
	public function testNext() {
		$tokenizer = new \scratch\util\StringTokenizer("a.b.c@");
		$last = null;
		$first_token = ".";
		$next_token = "@";

		// Do normal next calls work
		$this->assertEquals("a",$tokenizer->next($first_token));
		$this->assertEquals("b",$tokenizer->next());
		
		// does changing the delimiter work?
		$this->assertEquals("c",$tokenizer->next($next_token,$last));

		// does returning the last delimiter work?
		$this->assertEquals($first_token,$last);
		
		// does the tokenizer return false once past the end of the input?
		$this->assertFalse($tokenizer->next());
	}
}