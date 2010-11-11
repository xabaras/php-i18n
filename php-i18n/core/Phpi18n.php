<?php
/*
 * This file is part of php-i18n Internationalization framework
 * Any use of this file is subject to authorization by copyright owner.
 * 
 */

include_once $phpi18n_PATH . "/core/Localization.php";

/**
 * A class implementing a Simple Localization Framework for PHP Web Apps
 * 
 * @author Paolo Montalto
 *
 */
class Phpi18n{
	private $currentLocale;
	private $defaultLocale;
	private $localizations = array();
	
	private function __construct() {
		global $l10n_PATH;
		global $DEFAULT_LANGUAGE;
		
		$this->defaultLocale = $DEFAULT_LANGUAGE;
		
		if ($DETECT_CURRENT_LANGUAGE == true){		
			$this->currentLocale = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"], 0, 2);
			
			if ($this->defaultLocale != $this->currentLocale){
				$this->loadLocalization($this->currentLocale);
			}
		}
		
		$filename = $l10n_PATH . "strings_". $this->defaultLocale . ".l10n";
		$this->localizations[$this->defaultLocale] = new Localization($filename);
	}
	
	/**
	 * 
	 * Returns a valid instance of Phpi18n
	 */
	public static function getInstance(){
		if (!isset($_SESSION["PHPI18N_INSTANCE"])){
			$instance = new Phpi18n();
			$_SESSION["PHPI18N_INSTANCE"] = $instance;
		}else{
			$instance = $_SESSION["PHPI18N_INSTANCE"];
		}
		return $instance;
	}
	
	public function setCurrentLanguage($code){
		if ($code != $this->currentLocale){
			if ($code != $this->defaultLocale){
				if ($this->loadLocalization($code)){
					$this->currentLocale = $code;
				}
			}else {
				unset($this->localizations[$this->currentLocale]);
				$this->currentLocale = $code;
			}
			$_SESSION["PHPI18N_INSTANCE"]  = $this;
		}
	}
	
	/**
	 * returns current language code
	 */
	public function getCurrentLanguage(){
		return $this->currentLocale;
	}
	
	/**
	 * Returns a localized string for the given key
	 * @param $key
	 */
	public function getString($key){
		$val = "";
		try {
			$val = $this->localizations[$this->currentLocale]->getString($key);
			if (($val == null) || ($val == "")){
				$val = $this->localizations[$this->defaultLocale]->getString($key);
			}	
		} catch (Exception $e) {
		}			
		return $val;
	}
	
	/**
	 * Return an associative array of language codes => Language Names
	 */
	public function getAvailableLanguages(){
		global $l10n_PATH;
		$availableLanguages = array();
		
		$l10nDirectory = opendir($l10n_PATH);

		while($entryName = readdir($l10nDirectory)) {
			if($entryName!="." && $entryName!=".."){
				$parts = explode(".", $entryName);
				if (count($parts) > 1){
					$parts = explode("_", $parts[0]);
					if (count($parts) > 1){
						$code = $parts[1];
						$availableLanguages[$code] = i18nUtils::getName($code);
					}
				}
			}
		}

		closedir($l10nDirectory);
		
		return $availableLanguages;
	}
	
	/**
	 * Return an associative array of language codes => Language native names
	 */
	public function getAvailableLanguagesNativeNames(){
		global $l10n_PATH;
		$availableLanguages = array();
		
		$l10nDirectory = opendir($l10n_PATH);

		while($entryName = readdir($l10nDirectory)) {
			if($entryName!="." && $entryName!=".."){
				$parts = explode(".", $entryName);
				if (count($parts) > 1){
					$parts = explode("_", $parts[0]);
					if (count($parts) > 1){
						$code = $parts[1];
						$availableLanguages[$code] = i18nUtils::getNativeName($code);
					}
				}
			}
		}

		closedir($l10nDirectory);
		
		return $availableLanguages;
	}
	
	/**
	 * Loads localization from file
	 * @param $code language code
	 */
	private function loadLocalization($code){
		global $l10n_PATH;
		$filename = $l10n_PATH . "strings_". $code . ".l10n";

		if (file_exists($filename)){
			$this->localizations[$code] = new Localization($filename);
			return true;
		}else{
			return false;
		}
	}
	
	/**
	 * 
	 * Returns a formatted localized string replacing
	 * placeholders with supplied values.
	 * It works like sprintf
	 * 
	 * @param $key the key identifing the localized string
	 * @param [, $args] optional, values to place inside the string
	 */
	public function getFormattedString($key){
		$str = $this->getString($key);
		$numargs = func_num_args();
		
		if ($numargs >= 2) {
			$args = func_get_args();
			$args[0] = $str;
			return call_user_func_array("sprintf",$args);
		}else {
			return $str;
		}
	}
}
?>