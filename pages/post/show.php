<?php if (isset($params[0])): ?>
	<?php
	$posts = (new Posts())->findFields(['id', 'title', 'body', 'created_at'])
					->where([
							['id', '=', $params[0]],
							['active', '=', 1],
					])->query();
	?>
	<?php Registry::set('pageTitle', Html::escap($posts[0]['title'])); ?>

	<?php if ($posts): ?>
		<div class="jumbotron">
			<h1>عنوان پست: <small><?= $posts[0]['title'] ?></small></h1>
		</div>
		<div class="row">
			<?php foreach ($posts as $post): ?>
				<div class="col-12 text-justify">
					<h3><?= $post['title'] ?></h3>
					<p><?= $post['body'] ?></p>
					<p class="text-left"><small><strong>نوشته شده در: </strong><?= $post['created_at'] ?></small></p>
				</div>
			<?php endforeach; ?>
		</div>
	<?php else: ?>
		<p class="alert alert-danger">پست یافت نشد.</p>
	<?php endif; ?>

<?php else: ?>
	<p class="alert alert-danger">پست یافت نشد.</p>
<?php endif; ?>