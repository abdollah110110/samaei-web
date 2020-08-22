<?php if ( $posts ): ?>
	<div class="row abstract-col">
		<?php foreach ( $posts as $post ): ?>
			<div class="col-12 col-md-6 col-lg-4 mb-4">

				<div class="mb-3">
					<a href="<?= Html::home() . 'post/' . $post[ 'id' ]; ?>">
						<?php
						if ( isset( $post[ 'image' ] ) ) {
							echo Html::img( Html::escap( $post[ 'image' ] ), Html::escap( $post[ 'title' ] ), [
									'class' => 'img-thumbnail' ] );
						} else {
							echo Html::img( Html::home() . 'images\\' . 'abstract-img.jpg', Html::escap( $post[ 'title' ] ), [
									'class' => 'img-thumbnail' ] );
						}
						?>
					</a>
				</div>
				<h3>
					<a href="<?= Html::home() . 'post/' . $post[ 'id' ]; ?>">
						<?= Html::getSubstr( $post[ 'title' ], 5 ) ?>
					</a>
				</h3>
				<div class="d-flex justify-content-between">
					<small class="text-muted">
						<strong>نوشته شده در: </strong>
						<span><?= Html::escap( Html::getDate( $post[ 'created_at' ] ) ) ?></span>
					</small>
					<small class="text-muted">
						<i class="fas fa-eye"></i>
						<?php (new Posts() ) -> counter( $post[ 'id' ] ); ?>
					</small>
				</div>
				<p class="text-justify abstract"><?= $post[ 'abstract' ] ?></p>
				<div class="text-left">
					<?=
					Html::a( 'مشاهده ادامه مطلب...', [
							'href' => 'post/' . $post[ 'id' ],
							'class' => 'btn btn-sm btn-primary' ], '_blank' )
					?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
<?php else: ?>
	<p class="alert alert-danger">هیچ پستی برای مشاهده وجود ندارد.</p>
<?php endif; ?>