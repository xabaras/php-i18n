<?php include_once "../php-i18n/php-i18n.php"; ?>
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
			<input type="button" value="<?php printString("lblJsSample")?>" onclick="alert(getFormattedString('msgJsSample','Paolo'));"/>
		</p>
	</body>
</html>
