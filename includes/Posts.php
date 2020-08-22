<?php
class Posts extends Database {

	public function __construct() {
		$this -> table = strtolower( get_class( $this ) );
	}

	public function counter( $id, $add = false ) {
		$record = $this -> findOne( [ 'id' => $id, 'active' => 1 ] );
		echo ($add == true ? $record[ 'view' ] ++ : $record[ 'view' ]);
		$this -> sql = 'UPDATE ' . $this -> table . ' SET view=' . $record[ 'view' ] . ' WHERE ( id=' . $record[ 'id' ] . ' )';
		$this -> query();
	}

}
