<?php
class Comments extends Database {

	public function __construct() {
		$this->table = strtolower( get_class( $this ) );
	}

	public function showAll( $post_id, $parentId = null, $attributes = '' ) {
		if ( $parentId == null ) {
			$sql = $this->selectAll() . $this->where( [
							[ 'post_id', '=', $post_id ],
							[ 'parent_id', ' IS ', 'NULL' ],
							[ 'active', '=', 1 ],
					] );
			$result = $this->query( $sql );
		} elseif ( $parentId != null ) {
			$sql = $this->selectAll() . $this->where( [
							[ 'post_id', '=', $post_id ],
							[ 'parent_id', '=', $parentId ],
							[ 'active', '=', 1 ],
					] );
			$result = $this->query( $sql );
		}
		if ( count( $result ) > 0 ) {
			foreach ( $result as $comment ) {
				echo '<div' . $attributes . '>' . PHP_EOL;
				echo '<strong>' . Html::escap( $comment[ 'name' ]) . ':</strong> ' . Html::escap( $comment[ 'body' ]);
				echo ' <small class="text-muted">' . Html::getDate( $comment[ 'created_at' ] ) . '</small>';
				echo $this->showAll( $post_id, $comment[ 'id' ], $attributes );
				echo '</div>' . PHP_EOL;
			}
		}
	}

}
