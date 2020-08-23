<?php Registry::set( 'pageTitle', Html::escap( 'ورود کاربران' ) ); ?>
<div class="jumbotron d-flex flex-column align-items-center">
	<h1><i class="fas fa-sign-in-alt ml-2"></i>ورود کاربران </h1>
</div>
<div class="row justify-content-center">
	<div class="col-md-8 col-lg-6">
		<form action="" method="POST" class="form-horizontal bg-light p-5 mb-5">
			<?php
			if ( isset( $_POST[ 'email' ], $_POST[ 'password' ] ) ) {
				$email = $_POST[ 'email' ];
				$pass = $_POST[ 'password' ];
				$re = isset($_POST[ 'remember' ]) ? 1 : null;
				( new Users )->login( $email, $pass, $re );
			}
			?>
			<div class="form-group row">
				<label for="email" class="col-lg-12 col-form-label text-lg-right">ایمیل:</label>
				<div class="col">
					<input class="form-control" type="email" id="email" name="email" value="" placeholder="نام کاربری را وارد کنید...">
				</div>
				<div class="col-lg-12 text-center mt-sm-1">
				</div>
			</div>
			<div class="form-group row">
				<label for="password" class="col-lg-12 col-form-label text-lg-right">رمز عبور:</label>
				<div class="col">
					<input class="form-control" type="password" id="password" name="password" placeholder="رمز عبور را وارد کنید...">
				</div>
				<div class="col-lg-12 text-center mt-sm-1">
				</div>
			</div>
			<div class="form-group row">
				<div class="col-lg-6">
					<span class="form-inline">
						<input type="checkbox" class="form-check ml-2" name="remember" value="1" > مرا به خاطر بسپار
					</span>
				</div>
				<div class="col-lg-6 d-flex align-items-lg-start mt-sm-1">
					<a href="">فراموشی یا تغییر رمز عبور</a>
				</div>
			</div>
			<div class="d-flex justify-content-center mt-4">
				<button type="submit" class="btn btn-success btn-block">ورود</button>
			</div>
		</form>
	</div>
</div>