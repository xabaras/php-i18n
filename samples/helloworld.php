<?php include_once "../php-i18n/php-i18n.php";
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
 * helloworld v1.1
 */
?>
<html>
	<head>
	<?php
		// js-i18n extension
		include_once '../php-i18n/ext/js-i18n/js-i18n.php';
		
		if (isset($_POST["lang"])){
			$code = $_POST["lang"];
			Phpi18n::getInstance()->setCurrentLanguage($code);	
		}
		$current = Phpi18n::getInstance()->getCurrentLanguage();
	?>
		<title>php-i18n Hello World</title>
		<script type="text/javascript" src="js/jquery-1.4.2.min.js" ></script>
	</head>
	<body>
		<h2>
			<?php printFormattedString("hello_world","Paolo"); ?>
		</h2>
		<p>
			<?php printString("lblYourLanguage"); ?>&nbsp;<?php print i18nUtils::getNativeName($current); ?>
		</p>
		<p>
			<?php printString("lblAvailable"); ?>
		</p>
		<form method="post" action="" >
			<select name="lang">
				<?php
					$lingue =  Phpi18n::getInstance()->getAvailableLanguages();
					foreach ($lingue as $key => $value){
						if ($key == $current){
							print "<option value=\"" . $key . "\" selected=\"selected\" >" . $value . "</option>";
						}else{
							print "<option value=\"" . $key . "\">" . $value . "</option>";	
						}	
					}
				?>
			</select>
			<input type="submit" value"<?php printString("lblChangeLanguage"); ?>" />
		</form>
		<p>
			<input type="button" value="<?php printString("lblJsSample")?>" onclick="getFormattedStringAsync('msgJsSample', 'Paolo').then(
		function(value) {alert(value});"/>
		</p>
	</body>
</html>
