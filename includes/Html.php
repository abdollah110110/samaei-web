<?php
class Html {

	/**
	 *
	 * @param type $string A string or text
	 * @return type Returns an encoded string or text
	 */
	public static function escap ( $text ) {
		return htmlentities ( $text, ENT_QUOTES, 'utf-8' );
	}

	/**
	 *
	 * @global type $config The global variable includes the project settings
	 * @return type project name
	 */
	public static function title () {
		global $config;
		return self::escap ( $config[ 'title' ] );
	}

	/**
	 *
	 * @global type $config The global variable includes the project settings
	 * @return type project description
	 */
	public static function description () {
		global $config;
		return self::escap ( $config[ 'description' ] );
	}

	/**
	 *
	 * @global type $config The global variable includes the project settings
	 * @return type home url == index.php
	 */
	public static function home () {
		global $config;
		return self::escap ( $config[ 'homeUrl' ] );
	}

	/**
	 * @global type $config The global variable includes the project settings
	 * @param type $path File path
	 * @return type File path from site root
	 */
	public static function basePath ( $path = '' ) {
		global $config;
		if ( $path == '' ) {
			return self::escap ( $config[ 'basePath' ] );
		}
		return self::escap ( $config[ 'basePath' ] . $path );
	}

	/**
	 * @global type $config The global variable includes the project settings
	 * @return type get language
	 */
	public static function lang () {
		global $config;
		return self::escap ( $config[ 'lang' ] );
	}

	/**
	 * @global type $config The global variable includes the project settings
	 * @return type Returns the charset specified in the settings
	 */
	public static function charset () {
		global $config;
		return self::escap ( $config[ 'charset' ] );
	}

	/**
	 * @global type $config The global variable includes the project settings
	 * @param type $format It is a string that takes the form of time
	 * @param type $timestamp Current or string time stamp
	 * @return type A string containing the date format
	 */
	public static function getDate ( $timestamp = '', $format = '' ) {
		global $config;
		date_default_timezone_set ( $config[ 'timezone' ] );
		$format = ($format == '' ? 'H:i:s Y/m/d l' : $format);
		if ( $timestamp == '' ) {
			return date ( $format );
		}
		return date ( $format, strtotime( $timestamp) );
	}

	/**
	 * @param string $href URL to file path
	 * @param type $rel
	 * @param type $type File type
	 * @return type the tag link
	 */
	public static function link ( $href, $rel = 'stylesheet', $type = 'text/css' ) {
		$href = self::home () . self::escap ( $href );
		return '<link href="' . $href . '" rel="' . self::escap ( $rel ) . '" type="' . self::escap ( $type ) . '" />' . PHP_EOL;
	}

	/**
	 * @param string $src URL to file path
	 * @param type $type File type
	 * @return type Returns the tag script
	 */
	public static function script ( $src, $type = 'text/javascript' ) {
		$src = self::home () . self::escap ( $src );
		return '<script src="' . $src . '" type="' . self::escap ( $type ) . '"></script>' . PHP_EOL;
	}

	/**
	 * @param type $string A string of words
	 * @param type $array Takes tag attributes
	 * @param type $target Takes the target
	 * @return string Returns the tag a
	 */
	public static function a ( $string = '', $array = [], $target = '' ) {
		if ( $string == '' && count ( $array ) <= 0 ) {
			$href = self::home ();
			$string = self::title ();
			$class = 'navbar-brand';
			$a = '<a href="' . $href . '"';
			$a .= ($class != '' ? ' class="' . self::escap ( $class ) . '"' : '');
			$a .= ($target != '' ? ' target="' . self::escap ( $target ) . '"' : '');
			$a .= '>' . $string . '</a>' . PHP_EOL;
			return $a;
		}
		$a = '<a ';
		foreach ( $array as $key => $value ) {
			if ( $key == 'href' ) {
				$a .= self::escap ( $key ) . '="' . self::home () . self::escap ( $value ) . '" ';
				continue;
			}
			$a .= self::escap ( $key ) . '="' . self::escap ( $value ) . '" ';
		}
		$a .= '>' . self::escap ( $string ) . '</a>' . PHP_EOL;
		return $a;
	}

	/**
	 * @param type $src Path to image file
	 * @param type $alt A string to describe the photo
	 * @param type $attributes Specifies the attributes of the image tag
	 * @return string Tag img
	 */
	public static function img ( $src, $alt = 'image', $attributes = [] ) {
		$img = '<img src="' . $src . '" ';
		foreach ( $attributes as $key => $value ) {
			$img .= self::escap ( $key ) . '="' . self::escap ( $value ) . '" ';
		}
		$img .= ' />' . PHP_EOL;
		return $img;
	}

	/**
	 * @param type $text Is a text that the method must return part of
	 * @param type $len Number of words to be returned and its default value is 50
	 * @return type Is a text or string of words
	 */
	public static function getSubstr ( $text, $len = 50 ) {
		$array = explode ( ' ', $text );
		$sub = '';
		if ( $len <= count ( $array ) ) {
			for ( $i = 0; $i < $len; $i ++ ) {
				$sub .= $array[ $i ] . ' ';
			}
			$sub .= '...';
		} else {
			$sub = $text;
		}
		return self::escap ( $sub );
	}

}
