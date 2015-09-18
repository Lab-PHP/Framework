<?php 
class Config
{
	public static function get($path=null){
		if($path){
			$app = require __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR .'..'.DIRECTORY_SEPARATOR .'app'.DIRECTORY_SEPARATOR.'app.php';
			$path = explode('/',$path);
			foreach ($path as $bit) {
				if(isset($app[$bit])){
					$app = $app[$bit];
				}
			}
			return $app;
		}
		return false;
	}
	public static function path($path=null){
		if($path){
			$app = require __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR .'..'.DIRECTORY_SEPARATOR .'app'.DIRECTORY_SEPARATOR.'paths.php';
			$path = explode('/',$path);
			foreach ($path as $bit) {
				if(isset($app[$bit])){
					$app = $app[$bit];
				}
			}
			return $app;
		}
		return false;
	}
}
?>