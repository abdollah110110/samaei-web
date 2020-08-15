<?php
//ob_start();
session_start();
require_once __DIR__ . '/init.php';
?>
<!DOCTYPE html>
<html lang="fa">
	<head>
		<title><?php echo $config['title']; ?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<?= Html::link('css/vazir.css') ?>
		<?= Html::link('font/fontawsome/css/all.min.css') ?>
		<?= Html::link('css/bootstrap.min.css') ?>
		<?= Html::link('css/bootstrap.rtl.css') ?>
		<?= Html::link('css/base-styles.css') ?>
		<?= Html::link('css/styles.css'); ?>
	</head>
	<body>
		<section class="container d-flex flex-column">
			<nav class="navbar navbar-expand-md navbar-light">
				<?= Html::a() ?>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
					<ul class="navbar-nav flex-fill">
						<li class="flex-fill nav-item active">
							<?= Html::a('صفحه اصلی', ['href' => 'index.php', 'class' => 'nav-link']) ?>
						</li>
						<li class="flex-fill nav-item">
							<?= Html::a('درباره ما', ['href' => 'about.php', 'class' => 'nav-link']) ?>
						</li>
						<li class="flex-fill nav-item">
							<?= Html::a('تماس با ما', ['href' => 'contact.php', 'class' => 'nav-link']) ?>
						</li>
						<li class="flex-fill nav-item dropdown">
							<?= Html::a('مدیریت', ['href' => '#', 'class' => 'nav-link dropdown-toggle', 'id' => 'navbarDropdown', 'data-toggle' => 'dropdown']) ?>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Another action</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#">Something else here</a>
							</div>
						</li>
						<li class="flex-fill nav-item">
							<a class="nav-link" href="#">Link</a>
						</li>
					</ul>
					<form class="form-inline d-lg-none my-2 my-lg-0">
						<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
						<button class="btn btn-danger my-2 my-sm-0" type="submit">Search</button>
					</form>
				</div>
			</nav>
			
			<div class="jumbotron d-flex flex-column align-items-center">
				<h1><?= Html::title() ?></h1>
				<p><?= Html::description() ?></p>
			</div>
		</section>


		<?= Html::script('js/jquery.min.js') ?>
		<?= Html::script('js/bootstrap.min.js') ?>
		<?= Html::script('js/scripts.js') ?>
	</body>
</html> 
<?php
session_regenerate_id();
//ob_end_flush();
?>