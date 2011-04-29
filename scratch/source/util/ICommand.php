<?php

  /**
   * @package scratch
   * @subpackage utils
   */
namespace scratch\utils;

/**
 * Command Interface
 *
 * @author Darrell Hamilton
 */
interface ICommand {
	abstract function execute();
}