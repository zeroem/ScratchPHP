<?php

namespace Scratch\Utils;

interface IObserver {
	public function doObserve(\Scratch\Utils\Event $event);
}