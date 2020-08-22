<?php
class Registry {

	public static $values = [];

	public static function set ( $name, $value ) {
		self::$values[ $name ] = $value;
	}

	public static function check ( $name ) {
		return (isset ( self::$values[ $name ] ));
	}

	public static function get ( $name ) {
		return (isset ( self::$values[ $name ] ) ? self::$values[ $name ] : null);
	}

}
