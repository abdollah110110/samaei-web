<?php
class Categories extends Database {

	public function __construct() {
		$this -> table = strtolower( get_class( $this ) );
	}

}
