<?php

namespace scratch\util;

interface IObserver {
	public function doObserve(\scratch\util\Event $event);
}