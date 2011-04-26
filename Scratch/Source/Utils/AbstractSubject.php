<?php

namespace Scratch\Utils;

abstract class AbstractSubject {
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
	public function observe($type,\Scratch\Utils\IObserver $observer) {
		if(ArrayUtils::get($this->observers,$type,false)===false) {
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
		$observers = &ArrayUtils::get($this->observers,$event->getType(),false);
		
		if($observers !== false) {
			foreach($observers as $obs) {
				$val = $obs->doObserve($event);
				if($val !== NULL) {
					$ret = $ret && $val;
				}
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
		$observers = &ArrayUtils::get($this->observers,$event->getType(),false);
		
		if($observers !== false) {
			foreach($observers as $obs) {
				if($obs->doObserve($event) === false) {
					$ret = false;
					break;
				}
			}
		}

		return $ret;
	}
}