<?php if (isset($params[0])): ?>
	<?php
	$category = (new Categories())->findFields(['id', 'name'])
					->where([
							['id', '=', $params[0]],
							['active', '=', 1],
					])->query();
	?>

	<?php if ($category): ?>
	<?php Registry::set('pageTitle', Html::escap($category[0]['name'])); ?>
		<div class="jumbotron">
			<h1>نام موضوع: <small><?= $category[0]['name'] ?></small></h1>
		</div>
		<?php
		$posts = (new Posts())->findFields(['id', 'title', 'abstract', 'created_at'])->where([
						['category_id', '=', $category[0]['id']],
						['active', '=', 1],
				])->query();
		?>
		<div class="row">
			<?php foreach ($posts as $post): ?>
				<div class="col-4">
					<h3><?= Html::escap($post['title']) ?></h3>
					<p><?= Html::escap($post['abstract']) ?></p>
					<p><?= Html::escap($post['created_at']) ?></p>
					<p><?= Html::a('مشاهده ادامه مطلب...', ['href' => 'post/' . $post['id'], 'class' => 'btn btn-sm btn-primary'], '_blank') ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	<?php else: ?>
		<p class="alert alert-danger">موضوع یافت نشد.</p>
	<?php endif; ?>

<?php else: ?>
	<p class="alert alert-danger">موضوع یافت نشد.</p>
<?php endif; ?>
