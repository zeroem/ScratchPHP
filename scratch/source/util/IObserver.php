<?php

namespace scratch\utils;

interface IObserver {
	public function doObserve(\scratch\utils\Event $event);
}