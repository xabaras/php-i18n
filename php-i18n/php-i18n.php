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

/* CONFIGURATION SECTION */

/* Path where php-i18n library is placed */
$phpi18n_PATH = $_SERVER["DOCUMENT_ROOT"] . "/php-i18n/php-i18n/";

/* Path where localization files (es: string_en.i10n) are placed */
$l10n_PATH = $_SERVER["DOCUMENT_ROOT"] . "/php-i18n/php-i18n/l10n/";

/* Default language for the webapp (the matching file must exist) */
$DEFAULT_LANGUAGE="en";

/* Says whether to choose current language based on client or not  */
$DETECT_CURRENT_LANGUAGE=true;

/* DO NOT EDIT UNDER THIS LINE */
require_once $phpi18n_PATH . "core/Phpi18n.php";

session_start();

/**
 * Returns a localized string for the given key
 * (is a wrapper for the matching method in the Phpi18n class)
 * 
 * @param $key
 */
function getString($key){
	return Phpi18n::getInstance()->getString($key);
}

/**
 * Prints a localized string for the given key
 * @param $key
 */
function printString($key){
	print Phpi18n::getInstance()->getString($key);
}

/**
 * 
 * Returns a formatted localized string replacing
 * placeholders with supplied values.
 * It works like sprintf
 * (is a wrapper for the matching method in the Phpi18n class)
 * 
 * @param $key the key identifing the localized string
 * @param [, $args] optional, values to place inside the string
 */
function getFormattedString($key){
	$numargs = func_num_args();
	$args = func_get_args();
	$str = "";
	
	$strEval = "\$str =  Phpi18n::getInstance()->getFormattedString(\"" . implode("\",\"",$args) . "\");";
	
	eval($strEval);
	
	return $str;
}

/**
 * 
 * Prints a formatted localized string replacing
 * placeholders with supplied values.
 * 
 * @param $key the key identifing the localized string
 * @param [, $args] optional, values to place inside the string
 */
function printFormattedString($key){
	$numargs = func_num_args();
	$args = func_get_args();
	
	$strEval = "print Phpi18n::getInstance()->getFormattedString(\"" . implode("\",\"",$args) . "\");";
	
	eval($strEval);
}
?>