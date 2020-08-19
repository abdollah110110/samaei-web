<?php

class Tools {

	public static function debug($param, $exit = false) {
		$style = ' style="direction:ltr;text-align:left;font-size:1.2rem;';
		$style .= 'background:#ECF0F1;padding:1rem"';
		echo '<div' . $style . '>' . PHP_EOL;
		echo '<h3>Debug:</h3>' . PHP_EOL;
		echo '<pre>' . PHP_EOL;
		echo Html::escap(print_r($param, true)) . PHP_EOL;
		echo '</pre>' . PHP_EOL;
		echo '<div>' . PHP_EOL;
		echo Html::escap(var_dump($param)) . PHP_EOL;
		echo '</div>' . PHP_EOL;
		echo '</div><br />' . PHP_EOL;
		if ($exit) {
			exit();
		}
	}

	/**
	 * @param string $dir directory path
	 * @param type $str Letter or letters that need to be replaced
	 * @param type $replace Letter or letters to be replaced
	 * @param type $extension file extension
	 * @param type $ucfirst If it is correct then the initials of the file name will be enlarged
	 */
	public static function renameAllFiles($dir, $newName = null, $extension = null, $ucfirst = false) {
		$dir = Html::basePath() . $dir . '\\';
		chdir($dir);
		$extension = $extension == '' ? '*.php' : '*' . $extension;
		$files = glob($extension);
		foreach ($files as $file) {
			if($newName != null){
				$explodeArray = explode('.', $file);
				$newFile = $newName . '.' . end($explodeArray);
				$newFile = (strtolower($newFile) == strtolower($file) ? $newName . '_.' . end($explodeArray) : $newFile);
			}
			else{
				$newFile = (strpos($file, '_.')) ? str_replace('_.', '.', $file) : str_replace('.', '_.', $file);
			}
			$newFile = ($ucfirst == true ? ucfirst($newFile) : strtolower($newFile));
			if (copy($file, $newFile)) {
				echo '<p class="ltr">Changed the file <span class="text-danger">' . $file . '</span> to <span class="text-success">' . $newFile . '</span></p>' . PHP_EOL;
				unlink($file);
			}
		}
		chdir(Html::basePath());
	}

}
