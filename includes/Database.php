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
			exit( 'Error database connect: ' . $ex -> getMessage() );
		}
	}

	public function query() {
		$pdo = $this -> connect();
		try {
			$st = $pdo -> prepare( $this -> sql );
			$st -> execute();
			$result = $st -> fetchAll( PDO::FETCH_ASSOC );
			return $result;
		} catch ( PDOException $ex ) {
			exit( 'Error database query: ' . $ex -> getMessage() );
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
		if ( is_array( $params ) ) {
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
		$this -> sql .= $Where;
		return $this;
	}

	protected function selectAll() {
		return 'SELECT * FROM ' . $this -> table;
	}

	protected function selectFields( $fields = [] ) {
		return 'SELECT ' . $this -> checkfields( $fields ) . 'FROM ' . $this -> table;
	}

	protected function selectOneRecord( $params = [] ) {
		$i = count( $params );
		$sql = 'SELECT * FROM ' . $this -> table;
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
		$this -> sql .= $this -> selectAll();
		return $this;
	}

	/**
	 *
	 * @param type $params values for where
	 * @param type $fields values for choise fields
	 * @return type  a array result of query contain several records
	 */
	public function findFields( $fields = [] ) {
		$this -> sql = $this -> selectFields( $fields );
		return $this;
	}

	public function findOne( $params = [] ) {
		$this -> sql = $this -> selectOneRecord( $params );
		$record = $this -> query();
		return $record[ 0 ];
	}

}
