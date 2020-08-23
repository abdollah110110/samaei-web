<?php
class Database {

	protected $table;
	protected $sql = '';

	/**
	 * @return \PDO connection to database
	 */
	protected function connect() {
		global $config;
		$attributes = [
			PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
			PDO::ATTR_ERRMODE,
			PDO::ERRMODE_EXCEPTION
		];
		try {
			return new PDO( 'mysql:dbname=' . $config[ 'db' ][ 'name' ] . ';host=' . $config[ 'db' ][ 'host' ] . ';', $config[ 'db' ][ 'user' ], $config[ 'db' ][ 'password' ], $attributes );
		} catch ( PDOException $ex ) {
			exit( 'Error database connect: ' . $ex->getMessage() );
		}
	}

	public function query( $sql ) {
		$pdo = $this->connect();
		try {
			$st = $pdo->prepare( $sql );
			$st->execute();
			$result = $st->fetchAll( PDO::FETCH_ASSOC );
			return $result;
		} catch ( PDOException $ex ) {
			exit( 'Error database query: ' . $ex->getMessage() );
		}
	}

	public function queryOneRow( $sql ) {
		$pdo = $this->connect();
		try {
			$st = $pdo->prepare( $sql );
			$st->execute();
			$result = $st->fetch( PDO::FETCH_ASSOC );
			return $result;
		} catch ( PDOException $ex ) {
			exit( 'Error database query: ' . $ex->getMessage() );
		}
	}

	public function queryUpdate( $sql ) {
		$pdo = $this->connect();
		try {
			$st = $pdo->prepare( $sql );
			$st->execute();
//			echo $st->rowCount() . " records UPDATED successfully";
		} catch ( PDOException $ex ) {
			exit( 'Error database query update: ' . $ex->getMessage() );
		}
	}

	private function checkfields( $fields = [] ) {
		$selectFields = '';
		$count = count( $fields );
		if ( $count <= 0 ) {
			return '* ';
		}
		for ( $i = 0; $i < $count; $i ++ ) {
			$selectFields .= $fields[ $i ] . ($i < ($count - 1) ? ',' : ' ');
		}
		return $selectFields;
	}

	/**
	 * @param type $params an array with three values or an array contain another arrays with three values
	 * @return $this object
	 */
	public function where( $params = [] ) {
		$Where = ' WHERE ( ';
		if ( is_array( $params[ 0 ] ) ) {
			$count = count( $params );
			for ( $i = 0; $i < $count; $i ++ ) {
				foreach ( $params[ $i ] as $value ) {
					$Where .= $value;
				}
				$Where .= ($i < ($count - 1) ? ' AND ' : '');
			}
		} else {
			foreach ( $params as $value ) {
				$Where .= $value;
			}
		}
		$Where .= ' )';
		return $Where;
	}

	/**
	 * @return type Returns all records and table fields
	 */
	protected function selectAll() {
		return 'SELECT * FROM ' . $this->table;
	}

	protected function selectFields( $fields = [] ) {
		return 'SELECT ' . $this->checkfields( $fields ) . 'FROM ' . $this->table;
	}

	/**
	 * @param type $params Condition parameters for performing a query
	 * @return string Returns a string that is a MySQL command
	 */
	protected function selectOneRecord( $params = [] ) {
		$i = count( $params );
		$sql = 'SELECT * FROM ' . $this->table;
		$sql .= ' WHERE ( ';
		foreach ( $params as $key => $value ) {
			if ( $i > 1 ) {
				$sql .= $key . '=' . $value . ' AND ';
			} else {
				$sql .= $key . '=' . $value;
			}
			$i --;
		}
		$sql .= ' ) LIMIT 0,1';
		return $sql;
	}

	/**
	 *
	 * @param type $params values for where
	 * @return type a array result of query contain several records
	 */
	public function findAll() {
		return $this->selectAll();
	}

	/**
	 * @param type $fields The names of the table fields that need to be returned
	 * @param type $whereParams Condition parameters for performing a query
	 * @return type Returns several records as a query result
	 */
	public function findFields( $fields = [], $whereParams = [] ) {
		$sql = $this->selectFields( $fields ) . $this->where( $whereParams );
//		Tools::debugPre($sql,true);
		return $this->query( $sql );
	}

	/**
	 * @param type $whereParams Condition parameters for performing a query
	 * @return type Returns a record that is the result of a query
	 */
	public function findOne( $whereParams = [] ) {
		$sql = $this->selectOneRecord( $whereParams );
		$record = $this->query( $sql );
		return $record[ 0 ];
	}

	/**
	 * @param type $string A string to which a single quotation must be added
	 * @return type Returns a string with a single quotation
	 */
	public static function singleQuote( $string ) {
		return '\'' . $string . '\'';
	}

}
