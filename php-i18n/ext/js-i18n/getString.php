<?php
/*
 * This file is part of php-i18n.
 *
 * php-i18n is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * php-i18n is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with php-i18n.  If not, see <http://www.gnu.org/licenses/>.
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
} elseif ( isset($_POST["cmd"]) ) {
	$cmd = $_POST["cmd"];
	switch($cmd) {
		case 'getCurrentLanguage':
			$str = Phpi18n::getInstance()->getCurrentLanguage();
			break;
		default:
			$str = "";
	}
	print($str);
}
?>