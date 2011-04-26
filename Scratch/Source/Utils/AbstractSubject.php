<?php

namespace Scratch\Utils;

abstract class AstractSubject {
	private $observers = array();

	/**
	 * Helper function for creating events
	 *
	 * @param string $type
	 * @param mixed $data
	 * @return \Scratch\Utils\Event
	 */
	protected function makeEvent($type,$data) {
		return new \Scratch\Utils\Event($this,$type,$data);
	}

	
	/**
	 * Attaches an observer
	 *
	 * @param string $type type of event to listen for
	 * @param \Scratch\Observer $observer Object that will react to the event
	 */
	public function observe($type,\Scratch\Observer $observer) {
		if(Utils\ArrayUtils::get($this->observers,$type)===false) {
			$this->observers[$type] = array();
		}

		$this->observers[$type][] = $observer;
	}

	/**
	 * Notify all observers of the event.  Returns false if one of the
	 * observers fails (returns false).  Otherwise returns true upon completion
	 *
	 * @param \Scratch\Utils\Event $event the event that occurred
	 * @return boolean
	 */
	protected function notify(\Scratch\Utils\Event $event) {
		$ret = true;
		$observers = &\Scratch\Utils\ArrayUtils::get($this->observers,$event->getType(),false);
		
		if($observers !== false) {
			foreach($observers as $obs) {
				$ret &= $obs->handle($event);
			}
		}

		return $ret;
	}

	/**
	 * Notify observers of the event until one fails (returns false).  Execution will then stop
	 * and false will be returned.
	 *
	 * @param \Scratch\Utils\Event $event the event that occurred
	 * @return boolean
	 */
	protected function notifyUntil(\Scratch\Utils\Event $event) {
		$ret = true;
		$observers = &\Scratch\Utils\ArrayUtils::get($this->observers,$event->getType(),false);
		
		if($observers !== false) {
			foreach($observers as $obs) {
				$ret = $obs->handle($event);

				if($ret === false) {
					break;x
				}
			}
		}

		return $ret;
	}
}