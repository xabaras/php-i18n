<?php
/*
 * This file is part of php-i18n Internationalization framework
 * Any use of this file is subject to authorization by copyright owner.
 * 
 */

$relativePath = str_replace($_SERVER["DOCUMENT_ROOT"], "", $phpi18n_PATH);
?>
<script type="text/javascript">
<!--
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
 * @param optional args a comma separated list of arguments
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
//-->
</script>