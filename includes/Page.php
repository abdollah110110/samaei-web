<?php

class Page {

	public static function route($r) {
		$r = str_replace('//', '/', $r);
		$routeParts = explode('/', $r);
		$page = array_shift($routeParts);
		$params = array_values($routeParts);
		return [$page, $params];
	}

	public static function loadPage($r = '', $page = '') {
		if (trim($r) != '') {
			list($page, $params) = self::route($r);
		}
		if (trim($page) == '' || trim(strtolower($page)) == 'site') {
			$page = 'index';
		}
		switch (strtolower($page)) {
			case 'index':
				require_once Html::basePath('pages\site\index.php');
				break;
			case 'category':
				require_once Html::basePath('pages\category\index.php');
				break;
			case 'post':
				require_once Html::basePath('pages\post\show.php');
				break;
		}
	}

}
