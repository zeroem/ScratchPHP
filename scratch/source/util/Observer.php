<?php

namespace scratch\util;

interface Observer {
	public function doObserve(\scratch\util\Event $event);
}