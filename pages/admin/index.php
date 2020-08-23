<?php
if ( ! Session::get( 'login' ) ) {
	Html::redirect( 'login' );
}
?>
<?php Registry::set( 'pageTitle', Html::escap( 'مدیریت سایت' ) ); ?>
<div class="jumbotron d-flex flex-column align-items-center">
	<h1><i class="fas fa-user-cog ml-2"></i>مدیریت سایت </h1>
	<h3>سلام <span class="text-success"><?= Session::get( 'name' ); ?></span></h3>
</div>
<div class="container-fluid">
	<div class="row">
		<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
			<span>منوی مدیریت</span>
			<i class="fas fa-caret-left mr-2"></i>
		</button>
		<div class="row w-100 mt-3">
			<div class="collapse col" id="collapseExample">
				<div class="list-group">
					<?= Html::a( 'داشبرد', [ 'href' => 'admin', 'class' => 'list-group-item list-group-item-action' ] ) ?>
					<?= Html::a( 'موضوعات', [ 'href' => 'categories', 'class' => 'list-group-item list-group-item-action' ] ) ?>
					<?= Html::a( 'پست ها', [ 'href' => 'posts', 'class' => 'list-group-item list-group-item-action' ] ) ?>
					<?= Html::a( 'کاربران', [ 'href' => 'profile', 'class' => 'list-group-item list-group-item-action' ] ) ?>
					<?= Html::a( 'خروج', [ 'href' => 'logout', 'class' => 'list-group-item list-group-item-action' ] ) ?>
				</div>
			</div>
		</div>
	</div>
</div>
