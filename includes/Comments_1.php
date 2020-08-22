<?php
class Comments extends Database {

	public function __construct() {
		$this -> table = strtolower( get_class( $this ) );
	}

	private function children( $result, $parentId, $attributes = '' ) {
		foreach ( $result as $comment ) {
			if ( $comment[ 'parent_id' ] == $parentId ) {
				echo '<div ' . $attributes . '>';
				echo '<strong class="ml-1">' . $comment[ 'name' ] . ':</strong>' . $comment[ 'body' ];
				echo ' <small class="text-muted mr-1">' . Html::getDate(
						$comment[ 'created_at' ] ) . '</small>';
				echo $this -> children( $result, $comment[ 'id' ], $attributes );
				echo '</div>' . PHP_EOL;
			}
		}
	}

	public function showAll( $post_id, $tagAttributes = [ 'class' => '' ] ) {
		$this -> sql = $this -> selectAll();
		$result = $this -> where( [
						[ 'post_id', '=', $post_id ],
						[ 'active', '=', 1 ],
				] ) -> query();
		echo '<div ';
		if ( count( $result ) > 0 ) {
			$attributes = '';
			foreach ( $tagAttributes as $key => $value ) {
				$attributes .= $key . '="' . $value . '"';
			}
			echo $attributes . '>' . PHP_EOL;
			foreach ( $result as $comment ) {
				if ( is_null( $comment[ 'parent_id' ] ) ) {
					echo '<strong class="ml-1">' . $comment[ 'name' ] . ':</strong>' . $comment[ 'body' ];
					echo ' <small class="text-muted mr-1">' . Html::getDate( $comment[ 'created_at' ] ) . '</small>';
					echo $this -> children( $result, $comment[ 'id' ], $attributes );
				}
			}
			echo '</div>' . PHP_EOL;
		}
	}

}
