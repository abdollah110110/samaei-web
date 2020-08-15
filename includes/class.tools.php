<?php

class Tools {

	public static function debug($param, $exit = true) {
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
		if($exit){
			exit();
		}
	}
	
}
