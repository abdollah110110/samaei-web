<div class="jumbotron d-flex flex-column align-items-center">
	<h1><?= Html::title() ?></h1>
	<p><?= Html::description() ?></p>
</div>

<?php
$posts = (new Posts())->findFields(['id', 'title', 'abstract', 'created_at'])->where([
				['active', '=', 1],
		])->query();
?>
<?php if($posts): ?>
<div class="row">
	<?php foreach ($posts as $post): ?>
		<div class="col-12 col-md-6 col-lg-4">
			<h3><?= $post['title'] ?></h3>
			<p><?= $post['abstract'] ?></p>
			<p><?= $post['created_at'] ?></p>
			<p><?= Html::a('مشاهده ادامه مطلب...', ['href' => 'post/' . $post['id'], 'class' => 'btn btn-sm btn-primary'], '_blank') ?></p>
		</div>
	<?php endforeach; ?>
</div>
<?php else: ?>
	<p class="alert alert-danger">هیچ پستی برای مشاهده وجود ندارد.</p>
<?php endif; ?>
