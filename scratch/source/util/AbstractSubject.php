<?php

namespace scratch\util;

abstract class AbstractSubject {
	private $observers = array();

	/**
	 * Returns how many observers are currently attached to this Subject
	 * @return integer
	 */
	public function countObservers() {
		$count = 0;
		foreach($this->observers as $row) {
			$count += count($row);
		}

		return $count;
	}

	/**
	 * Removes all instances of the given Observer
	 */
	public function removeObserver($type, \scratch\util\IObserver $obs = NULL) {
		
		if($obs !== NULL) {
			$list = &ArrayUtils::get($this->observers,$type,false);;
			if($list !== false) {
				foreach($list as $k=>$observer) {
					if($observer == $obs) {
						unset($list[$k]);
					}
				}
			}
		} else {
			$this->observers[$type] = array();
		}
	}

	/**
	 * detaches all observers from this subject.
	 */
	public function clearObservers() {
		$this->observers = array();
	}

	/**
	 * Helper function for creating events
	 *
	 * @param string $type
	 * @param mixed $data
	 * @return \scratch\util\Event
	 */
	protected function makeEvent($type,$data) {
		return new \scratch\util\Event($this,$type,$data);
	}

	
	/**
	 * Attaches an observer
	 *
	 * @param string $type type of event to listen for
	 * @param \Scratch\Observer $observer Object that will react to the event
	 */
	public function observe($type,\scratch\util\IObserver $observer) {
		if(ArrayUtils::get($this->observers,$type,false)===false) {
			$this->observers[$type] = array();
		}

		$this->observers[$type][] = $observer;
	}

	/**
	 * Notify all observers of the event.  Returns false if one of the
	 * observers fails (returns false).  Otherwise returns true upon completion
	 *
	 * @param \scratch\util\Event $event the event that occurred
	 * @return boolean
	 */
	protected function notify(\scratch\util\Event $event) {
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
	 * @param \scratch\util\Event $event the event that occurred
	 * @return boolean
	 */
	protected function notifyUntil(\scratch\util\Event $event) {
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