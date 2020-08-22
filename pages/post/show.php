<?php if ( isset( $params[ 0 ] ) ): ?>
	<?php
	$post = (new Posts() ) -> findOne( [ 'id' => $params[ 0 ], 'active' => 1 ] );
	?>

	<?php if ( $post ): ?>
		<?php Registry::set( 'pageTitle', Html::escap( $post[ 'title' ] ) ); ?>
		<div class="jumbotron">
			<h1>عنوان پست: <?= Html::escap( $post[ 'title' ] ) ?></h1>
		</div>
		<div class="row mb-4 justify-content-end">
			<div class="col-sm-12">
				<?php
				if ( isset( $post[ 'image' ] ) ) {
					echo Html::img( Html::escap( $post[ 'image' ] ), Html::escap( $post[ 'title' ] ), [
							'class' => 'img-thumbnail' ] );
				} else {
					echo Html::img( Html::home() . 'images\\' . 'abstract-img.jpg', Html::escap( $post[ 'title' ] ), [
							'class' => 'img-thumbnail' ] );
				}
				?>
			</div>
		</div>
		<div class="row">
			<div class="col-12 text-justify">
				<h3><?= Html::escap( $post[ 'title' ] ) ?></h3>
				<p><?= Html::escap( $post[ 'body' ] ) ?></p>
				<div class="d-flex justify-content-end">
					<small class="text-muted ml-5">
						<strong>نوشته شده در: </strong>
						<span><?= Html::escap( Html::getDate( $post[ 'created_at' ] ) ) ?></span>
					</small>
					<small class="text-muted">
						<i class="fas fa-eye"></i>
						<?php (new Posts() ) -> counter( $post[ 'id' ] ); ?>
					</small>
				</div>
			</div>
		</div>
		<?php (new Comments())-> showAll( $post['id']); ?>
	<?php else: ?>
		<p class="alert alert-danger">پست یافت نشد.</p>
	<?php endif; ?>

<?php else: ?>
	<p class="alert alert-danger">پست یافت نشد.</p>
<?php endif; ?>