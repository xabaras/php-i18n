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
 
 /***
  * js-i18n v1.1
  */

$relativePath = str_replace($_SERVER["DOCUMENT_ROOT"], "", $phpi18n_PATH);
?>
<script type="text/javascript">
<!--

/**
 * @param key the key identifying the localized string
 * @return the localized string
 */
function getString(key){
	var str = $.ajax({
		type: "post",
		url: "<?php print $relativePath; ?>ext/js-i18n/getString.php",
		data: {key: key},
		async: false
		}).responseText;
	return str;
}

/**
 * @param key the key identifying the localized string
 * @return a Promise for the localized string
 */
function getStringAsync(key){
	return new Promise(function(resolve, reject) {
		$.post({
			url: "<?php print $relativePath; ?>ext/js-i18n/getString.php",
			data: {key: key},
			success: function(data) {
				resolve(data);
			}
		}).fail(function() {
			reject(null);
		});
	});
}

/**
 * @param key the key identifying the localized string
 * @param optional args a comma separated list of arguments
 * @return the localized formatted string
 */
function getFormattedString(){
	var key = arguments[0];
	var argsArr = [].splice.call(arguments,0);
	var args="";
	for (var i = 1; i < argsArr.length; i++){
		args = args + argsArr[i];
		if (i!=argsArr.length-1)
			args = args + ",";
	}
	var str = $.ajax({
		type: "post",
		url: "<?php print $relativePath; ?>ext/js-i18n/getString.php",
		data: {key: key, args: args},
		async: false
		}).responseText;
	return str;
}

/**
 * @param key the key identifying the localized string
 * @param optional args a comma separated list of arguments
 * @return a Promise for the localized formatted string
 */
function getFormattedStringAsync(){
	var key = arguments[0];
	var argsArr = [].splice.call(arguments,0);
	var args="";
	for (var i = 1; i < argsArr.length; i++){
		args = args + argsArr[i];
		if (i!=argsArr.length-1)
			args = args + ",";
	}
		
	return new Promise(function(resolve, reject) {
		$.post({
			url: "<?php print $relativePath; ?>ext/js-i18n/getString.php",
			data: {key: key, args: args},
			success: function(data) {
				resolve(data);
			}
		}).fail(function() {
			reject(null);
		});
	});
}

/**
 * @return the currrent language
 */
function getCurrentLanguage() {
	var str = $.ajax({
		type: "post",
		url: "<?php print $relativePath; ?>ext/js-i18n/getString.php",
		data: {cmd: "getCurrentLanguage"},
		async: false
		}).responseText;
	return str;
}

/**
 * @return a Promise for the current language
 */
function getCurrentLanguageAsync() {
	return new Promise(function(resolve, reject) {
		$.post({
			url: "<?php print $relativePath; ?>ext/js-i18n/getString.php",
			data: {cmd: "getCurrentLanguage"},
			success: function(data) {
				resolve(data);
			}
		}).fail(function() {
			reject(null);
		});
	});
}
//-->
</script>