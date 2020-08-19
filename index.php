<?php require_once __DIR__ . '/init.php'; ?>
<?php
ob_start();
if (isset($_GET['r'])) {
	Page::loadPage($_GET['r']);
} else {
	Page::loadPage();
}
//$hash = password_hash('123456', PASSWORD_DEFAULT);
//echo $hash;
$content = ob_get_clean();
?>
<!DOCTYPE html>
<html lang="<?= Html::lang() ?>">
	<head>
		<title><?= Html::escap($config['title']) . (Registry::check('pageTitle') ? ' - ' . Registry::get('pageTitle') : '') ?></title>
		<meta charset="<?= Html::charset() ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<?= Html::link('images/favicon.png', 'shortcut icon', 'image/png') ?>
		<?= Html::link('css/vazir.css') ?>
		<?= Html::link('font/fontawsome/css/all.min.css') ?>
		<?= Html::link('css/bootstrap.min.css') ?>
		<?= Html::link('css/bootstrap.rtl.css') ?>
		<?= Html::link('css/base-styles.css') ?>
		<?= Html::link('css/styles.css'); ?>
	</head>
	<body>
		<section class="container">
			<nav class="navbar navbar-expand-lg navbar-light">
				<?= Html::a() ?>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
					<ul class="navbar-nav flex-fill">
						<li class="flex-fill nav-item active">
							<?= Html::a('صفحه اصلی', ['href' => 'index.php', 'class' => 'nav-link']) ?>
						</li>
						<li class="flex-fill nav-item dropdown">
							<?= Html::a('موضوعات', ['class' => 'nav-link dropdown-toggle', 'id' => 'categories', 'data-toggle' => 'dropdown']) ?>
							<div class="dropdown-menu" aria-labelledby="categories">
								<?php
								$categories = new Categories();
								$result = $categories->findFields(['id', 'name'])->where(['active', '=', 1])->query();
								foreach ($result as $category) {
									echo Html::a($category['name'], ['href' => 'category/' . $category['id'], 'class' => 'dropdown-item']);
								}
								?>
							</div>
						</li>
						<li class="flex-fill nav-item dropdown">
							<?= Html::a('مدیریت', ['class' => 'nav-link dropdown-toggle', 'id' => 'navbarDropdown', 'data-toggle' => 'dropdown']) ?>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Another action</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#">Something else here</a>
							</div>
						</li>
					</ul>
					<form class="form-inline my-2 my-lg-0">
						<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
						<button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
					</form>
					<div class="mr-2">
						<?= Html::a('عضویت', ['href' => 'register.php']) ?>
						<span> / </span>
						<?= Html::a('ورود', ['href' => 'login.php']) ?>
						<span> / </span>
						<?= Html::a('خروج', ['href' => 'logout.php', 'class' => 'btn btn-sm btn-danger']) ?>
					</div>
				</div>
			</nav>

			<div class="content">
				<?= $content; ?>
			</div>

			<footer class="footer">
				<p>&copy <?= Html::getDate('Y') ?></p>
			</footer>
		</section>


		<?= Html::script('js/jquery.min.js') ?>
		<?= Html::script('js/bootstrap.min.js') ?>
		<?= Html::script('js/scripts.js') ?>
	</body>
</html> 