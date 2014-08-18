<?php

/**
 * Registration handler for hybrid sessions
 */
class HybridSession {

	/**
	 * Gets the current session handler interface
	 *
	 * @return HybridSessionHandlerInterface
	 */
	protected static function instance() {
		return Injector::inst()->get('HybridSessionStore');
	}

	/**
	 * Register the session handler as the default
	 *
	 * @param string $key Desired session key
	 */
	public static function init($key = null) {
		$instance = self::instance();
		if(empty($key)) {
			user_error(
				'HybridSession::init() was not given a $key. Disabling cookie-based storage',
				E_USER_WARNING
			);
		} else {
			$instance->setKey($key);
		}
		register_sessionhandler($instance);
	}
}
