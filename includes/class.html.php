<?php

class Html {

	/**
	 * 
	 * @param type $string a string
	 * @return type a string escaped
	 */
	public static function escap($string) {
		return htmlentities($string, ENT_QUOTES, 'utf-8');
	}

	/**
	 * 
	 * @global type $config
	 * @return type project name
	 */
	public static function title() {
		global $config;
		return self::escap($config['title']);
	}

	/**
	 * 
	 * @global type $config
	 * @return type project description
	 */
	public static function description() {
		global $config;
		return self::escap($config['description']);
	}

	/**
	 * 
	 * @global type $config
	 * @return type home url == index.php
	 */
	public static function home() {
		global $config;
		return self::escap($config['homeUrl']);
	}

	/**
	 * @global type $config
	 * @return type get language
	 */
	public static function lang() {
		global $config;
		return self::escap($config['lang']);
	}
	
	/**
	 * 
	 * @global type $config
	 * @return type get charset
	 */
	public static function charset() {
		global $config;
		return self::escap($config['charset']);
	}
	
	/**
	 * 
	 * @global type $config
	 * @return type get date
	 */
	public static function getDate($str = 'Y/m/d - h:i:s a') {
		global $config;
		date_default_timezone_set($config['timezone']);
		return date($str);
	}

	/**
	 * 
	 * @global type $config
	 * @return type get timestamp
	 */
	public static function getTime() {
		global $config;
		date_default_timezone_set($config['timezone']);
		return time();
	}

	/**
	 * 
	 * @return type link tag
	 */
	public static function link($href, $rel = 'stylesheet', $type = 'text/css') {
		$href = self::home() . self::escap($href);
		return '<link href="' . $href . '" rel="' . self::escap($rel) . '" type="' . self::escap($type) . '" />' . PHP_EOL;
	}

	/**
	 * 
	 * @return type script tag
	 */
	public static function script($src, $type = 'text/javascript') {
		$src = self::home() . self::escap($src);
		return '<script src="' . $src . '" type="' . self::escap($type) . '"></script>' . PHP_EOL;
	}

	/**
	 * 
	 * @return string a tag
	 */
	public static function a($string = '', $array = [], $target = '') {
		if ($string == '' && count($array) <= 0) {
			$href = self::home();
			$string = self::title();
			$class = 'navbar-brand';
			$a = '<a href="' . $href . '"';
			$a .= ($class != '' ? ' class="' . self::escap($class) . '"' : '');
			$a .= ($target != '' ? ' target="' . self::escap($target) . '"' : '');
			$a .= '>' . $string . '</a>' . PHP_EOL;
			return $a;
		}
		$a = '<a ';
		foreach ($array as $key => $value) {
			if($key == 'href'){
				$a .= self::escap($key) . '="' . self::home() . self::escap($value) . '" ';
				continue;
			}
			$a .= self::escap($key) . '="' . self::escap($value) . '" '; 
		}
		$a .= '>' . self::escap($string) . '</a>' . PHP_EOL;
		return $a;
	}

}
