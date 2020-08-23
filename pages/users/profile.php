<?php
if ( ! Session::get( 'login' ) ) {
	Html::redirect( 'login' );
}
?>
<?php Registry::set( 'pageTitle', Html::escap( 'پروفایل' . Session::get( 'name' ) ) ); ?>
<div class="jumbotron d-flex flex-column align-items-center">
	<h1><i class="fas fa-user-cog ml-2"><?= Registry::get( 'pageTitle' ) ?></h1>
</div>
<div class="container-fluid">
	<div class="row">

	</div>
</div>
