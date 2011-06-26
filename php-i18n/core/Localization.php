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