<?php if ( isset( $params[ 0 ] ) ): ?>
	<?php
	$category = (new Categories() ) -> findOne( ['id'=>$params[0],'active'=>1]);
	?>

	<?php if ( $category ): ?>
		<?php Registry::set( 'pageTitle', Html::escap( $category[ 'name' ] ) ); ?>
		<div class="jumbotron">
			<h1>نام موضوع: <?= $category[ 'name' ] ?></h1>
		</div>
		<?php
		$posts = (new Posts() ) -> findFields( [ 'id', 'title', 'abstract', 'created_at' ] ) -> where( [
								[ 'category_id', '=', $category[ 'id' ] ],
								[ 'active', '=', 1 ],
				] ) -> query();
		?>
		<?php
		require_once Html::basePath( 'includes\views\\show-posts.php' );
		?>
	<?php else: ?>
		<p class="alert alert-danger">موضوع یافت نشد.</p>
	<?php endif; ?>

<?php else: ?>
	<p class="alert alert-danger">موضوع یافت نشد.</p>
<?php endif; ?>
