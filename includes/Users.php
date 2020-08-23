<?php
class Users extends Database {

	public function __construct() {
		$this->table = strtolower( get_class( $this ) );
	}

	public function login( $email, $pass, $remember = null ) {
		$sql = $this->findAll() . $this->where( [
						[ 'email', '=', $this->singleQuote( $email ) ],
						[ 'active', '=', 1 ],
				] );
		$user = $this->queryOneRow( $sql );
		if ( count( $user ) > 0 && password_verify( $pass, $user[ 'password' ] ) ) {
			Session::set( 'login', true );
			Session::set( 'id', $user[ 'id' ] );
			Session::set( 'name', $user[ 'name' ] );
			if ( $user[ 'is_admin' ] == 1 ) {
				Session::set( 'admin', true );
			}
			if ( $remember == 1 ) {
				$data = [
					'login' => true,
					'id' => $user[ 'id' ],
					'name' => $user[ 'name' ],
					'admin' => ($user[ 'is_admin' ] == 1 ? true : false),
				];
				setcookie( 'data', json_encode( $data ), time() + (3600) );
			}
			Html::redirect();
		} else {
			echo '<p class="alert alert-danger">ایمیل یا رمز عبور اشتباه است.</p>';
		}
	}

}
