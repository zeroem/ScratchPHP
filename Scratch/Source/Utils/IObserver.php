<?php

interface IObserver {
	public function doObserve(\Scratch\Utils\Event $event);
}