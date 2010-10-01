<?php
/*
 * This file is part of php-i18n Internationalization framework
 * Any use of this file is subject to authorization by copyright owner.
 * 
 */
include_once '../../php-i18n.php';

if (isset($_POST["key"])){
	$key = $_POST["key"];	
	if (isset($_POST["args"])){
		$args = explode(",",$_POST["args"]);

		$strEval = "print Phpi18n::getInstance()->getFormattedString(\"" . $key . "\",\"" . implode("\",\"",$args) . "\");";

		eval($strEval);
	}else{			
		$str = Phpi18n::getInstance()->getString($key);
		print $str;
	}
}
?>