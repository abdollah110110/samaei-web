<?php
class Posts extends Database {

	public function __construct() {
		$this->table = strtolower( get_class( $this ) );
	}

	/**
	 * This method shows the number of hits(views) and adds to it
	 * @param type $postId Record ID to be found
	 * @param type $add If it is equal to True, a unit is added to the field view
	 */
	public function counter( $postId, $add = false ) {
		$record = $this->findOne( [ 'id' => $postId ] );
		if ( count( $record ) > 0 ) {
			echo ( $add == true ? $record[ 'view' ] ++ : $record[ 'view' ] );
			$sql = 'UPDATE ' . $this->table . ' SET view=' . $record[ 'view' ] . ' WHERE id=' . $record[ 'id' ] . ' AND active=1';
			$this->queryUpdate( $sql );
		}
	}

}
