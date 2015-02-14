<?php
class Autoload {
	// 为了演示方便，这里采用了最简单的方式
	public static function loader($className) {
		include_once './class/' . $className . '.php';
	}
}

spl_autoload_register ( array ('Autoload', 'loader' ) );