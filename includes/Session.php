<?php
class Session {

	public static function start() {
		if ( session_id() == '' || session_status() == PHP_SESSION_NONE ) {
			session_start();
		}
	}
	public static function regenerateId() {
		return session_regenerate_id() ;
	}

	public static function set( $name, $value ) {
		$_SESSION[ $name ] = $value;
	}

	public static function get( $name ) {
		return isset( $_SESSION[ $name ] ) ? $_SESSION[ $name ] : null;
	}

	public static function clear( $name ) {
		if ( isset( $_SESSION[ $name ] ) ) {
			unset( $_SESSION[ $name ] );
		}
	}

}
