<?php
/*
 * This file is part of php-i18n Internationalization framework
 * Any use of this file is subject to authorization by copyright owner.
 * 
 */

include_once $phpi18n_PATH . "/core/i18nUtils.php";

/**
 * Stores Localization Data for a given language
 * 
 * @author Paolo Montalto
 *
 */
class Localization{
	public $code;
	public $name;
	public $nativeName;
	private $strings = array();

	/**
	 * 
	 * Creates a new Localization Object parsing the given file
	 * @param $path path of the properties file to parse
	 * @throws Exception
	 */
	public function __construct($path){
		$fileName = basename($path,".l10n");
		
		$errMsg = "Wrong file name \"" . $fileName . ".l10n\" or unsupported language.";		
		$parts = explode("_", $fileName);
				
		if (count($parts) > 1){
			$this->code = $parts[1];
			$this->name = i18nUtils::getName($this->code);
			if ($this->name == null)
				throw new Exception($errMsg);
			$this->nativeName = i18nUtils::getNativeName($this->code);
			if ($this->nativeName == null)
				throw new Exception($errMsg);
			$this->strings = i18nUtils::parse_properties($path);
		} else {
			throw new Exception($errMsg);
		}
	}

	/**
	 *
	 * Returns the localized string identified by $key
	 * @param $key
	 */
	public function getString($key){
		return $this->strings[$key];
	}
}
?>