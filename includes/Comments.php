<?php
class Comments extends Database {

	public function __construct() {
		$this -> table = strtolower( get_class( $this ) );
	}

	public function showAll( $post_id, $parentId = null ) {
		$this -> sql = $this -> selectAll();
		if ( $parentId == null ) {
			$result = $this -> where( [
							[ 'post_id', '=', $post_id ],
							[ 'parent_id', ' IS ', 'NULL' ],
							[ 'active', '=', 1 ],
					] ) -> query();
		} elseif ( $parentId != null ) {
			$result = $this -> where( [
							[ 'post_id', '=', $post_id ],
							[ 'parent_id', '=', $parentId ],
							[ 'active', '=', 1 ],
					] ) -> query();
		}
		if ( count( $result ) > 0 ) {
			foreach ( $result as $comment ) {
				echo '<div class="comments">' . PHP_EOL;
				echo '<strong class="ml-1">' . $comment[ 'name' ] . ':</strong>' . $comment[ 'body' ];
				echo ' <small class="text-muted mr-1">' . Html::getDate( $comment[ 'created_at' ] ) . '</small>';
				echo $this -> showAll( $post_id, $comment[ 'id' ] );
				echo '</div>' . PHP_EOL;
			}
		}
	}

}
