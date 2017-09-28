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
		global $DETECT_CURRENT_LANGUAGE;
		
		try {
		
			$this->defaultLocale = $DEFAULT_LANGUAGE;
			
			if ($DETECT_CURRENT_LANGUAGE == true){
				$this->currentLocale = $DEFAULT_LANGUAGE;
				$agentLanguage = $_SERVER["HTTP_ACCEPT_LANGUAGE"];
				if (isset($agentLanguage)){
					$agentLanguage = substr($agentLanguage, 0, 2);
					$availableLanguages = $this->getAvailableLanguages();
					if ( isset($availableLanguages[$agentLanguage]) ) {
						$this->currentLocale = $agentLanguage;
					}
				}			
				
				if ($this->defaultLocale != $this->currentLocale){
					$this->loadLocalization($this->currentLocale);
				}
			}
			
			$filename = $l10n_PATH . "strings_". $this->defaultLocale . ".l10n";
			$this->localizations[$this->defaultLocale] = new Localization($filename);
		} catch(Exception $e) {
			print($e->getMessage());
		}
	}
	
	/**
	 * 
	 * Returns a valid instance of Phpi18n
	 */
	public static function getInstance(){
		if ( !isset($_SESSION["PHPI18N_INSTANCE"]) ) {
			$instance = new Phpi18n();
			$_SESSION["PHPI18N_INSTANCE"] = $instance;
		} else {
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
        $val = str_replace('\n', "\n", $val);
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
            $str = call_user_func_array("sprintf",$args);
        }
        $str = str_replace('\n', "\n", $str);
        return $str;
	}
}
?>