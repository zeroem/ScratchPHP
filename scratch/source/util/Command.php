<?php

  /**
   * @package scratch
   * @subpackage util
   */
namespace scratch\util;

/**
 * Command Interface
 *
 * @author Darrell Hamilton
 */
interface Command {
	abstract function execute();
}