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

/**
 * 
 * Utility class for working with internationalization
 * @author Xabaras
 *
 */
class i18nUtils{
	/**
	 * Reads a Java Style Properties file and returns an associative array
	 * @param String $path path of the properties file
	 */
public static function parse_properties($path){
		$result = array();
		$isMultiline = false;
		$key="";
		
		$fd = fopen($path, "r");
		while ( !feof($fd) ){
			$line = fgets($fd);
			$line = str_replace("\n", "", $line);
			
			$len = strlen($line);
			$diesisPos = strpos($line, "#");
			
			if (empty($line) || (!$isMultiline && $diesisPos === 0)){
				continue;
			}
			
			if (!$isMultiline){
				$splitterPos = strpos($line, "=");
				$key = substr($line, 0, $splitterPos);
				$value = substr($line, $splitterPos + 1, $len - $splitterPos - 1);
			}else {
				$value .= $line;
			}
			
			// Check whether is multi line or not
			$lineDelimiterPos = strpos($line, "\\");
			$lineEnd = strlen($line) - 1 - strlen("\\");
			if ($lineDelimiterPos === $lineEnd){
				$value = substr($value, 0, strlen($value) - 2);
				$isMultiline = true;	
			}else {
				$isMultiline = false;
				$result[$key] = $value;
			}
		}
		fclose($fd);
		return $result;
	}
	
	/**
	 * Returns the language name in english given the language code
	 * @param $code language code
	 */
	public static function getName($code){
		return self::$languages[$code];
	}
	
	/**
	 * Array di coppie codice lingua => nome in inglese delle lingua
	 */
	private static $languages = array(
			'ab' => 'Abkhaz', 
			'aa' => 'Afar', 
			'af' => 'Afrikaans', 
			'ak' => 'Akan', 
			'sq' => 'Albanian', 
			'am' => 'Amharic', 
			'ar' => 'Arabic', 
			'an' => 'Aragonese', 
			'hy' => 'Armenian', 
			'as' => 'Assamese', 
			'av' => 'Avaric', 
			'ae' => 'Avestan', 
			'ay' => 'Aymara', 
			'az' => 'Azerbaijani', 
			'bm' => 'Bambara', 
			'ba' => 'Bashkir', 
			'eu' => 'Basque', 
			'be' => 'Belarusian', 
			'bn' => 'Bengali', 
			'bh' => 'Bihari', 
			'bi' => 'Bislama', 
			'bs' => 'Bosnian', 
			'br' => 'Breton', 
			'bg' => 'Bulgarian', 
			'my' => 'Burmese', 
			'ca' => 'Catalan; Valencian', 
			'ch' => 'Chamorro', 
			'ce' => 'Chechen', 
			'ny' => 'Chichewa; Chewa; Nyanja', 
			'zh' => 'Chinese', 
			'cv' => 'Chuvash', 
			'kw' => 'Cornish', 
			'co' => 'Corsican', 
			'cr' => 'Cree', 
			'hr' => 'Croatian', 
			'cs' => 'Czech', 
			'da' => 'Danish', 
			'dv' => 'Divehi; Dhivehi; Maldivian;', 
			'nl' => 'Dutch', 
			'dz' => 'Dzongkha', 
			'en' => 'English', 
			'eo' => 'Esperanto', 
			'et' => 'Estonian', 
			'ee' => 'Ewe', 
			'fo' => 'Faroese', 
			'fj' => 'Fijian', 
			'fi' => 'Finnish', 
			'fr' => 'French', 
			'ff' => 'Fula; Fulah; Pulaar; Pular', 
			'gl' => 'Galician', 
			'ka' => 'Georgian', 
			'de' => 'German', 
			'el' => 'Greek, Modern', 
			'gn' => 'Guaraní', 
			'gu' => 'Gujarati', 
			'ht' => 'Haitian; Haitian Creole', 
			'ha' => 'Hausa', 
			'he' => 'Hebrew (modern)', 
			'hz' => 'Herero', 
			'hi' => 'Hindi', 
			'ho' => 'Hiri Motu', 
			'hu' => 'Hungarian', 
			'ia' => 'Interlingua', 
			'id' => 'Indonesian', 
			'ie' => 'Interlingue', 
			'ga' => 'Irish', 
			'ig' => 'Igbo', 
			'ik' => 'Inupiaq', 
			'io' => 'Ido', 
			'is' => 'Icelandic', 
			'it' => 'Italian', 
			'iu' => 'Inuktitut', 
			'ja' => 'Japanese', 
			'jv' => 'Javanese', 
			'kl' => 'Kalaallisut, Greenlandic', 
			'kn' => 'Kannada', 
			'kr' => 'Kanuri', 
			'ks' => 'Kashmiri', 
			'kk' => 'Kazakh', 
			'km' => 'Khmer', 
			'ki' => 'Kikuyu, Gikuyu', 
			'rw' => 'Kinyarwanda', 
			'ky' => 'Kirghiz, Kyrgyz', 
			'kv' => 'Komi', 
			'kg' => 'Kongo', 
			'ko' => 'Korean', 
			'ku' => 'Kurdish', 
			'kj' => 'Kwanyama, Kuanyama', 
			'la' => 'Latin', 
			'lb' => 'Luxembourgish, Letzeburgesch', 
			'lg' => 'Luganda', 
			'li' => 'Limburgish, Limburgan, Limburger', 
			'ln' => 'Lingala', 
			'lo' => 'Lao', 
			'lt' => 'Lithuanian', 
			'lu' => 'Luba-Katanga', 
			'lv' => 'Latvian', 
			'gv' => 'Manx', 
			'mk' => 'Macedonian', 
			'mg' => 'Malagasy', 
			'ms' => 'Malay', 
			'ml' => 'Malayalam', 
			'mt' => 'Maltese', 
			'mi' => 'Māori', 
			'mr' => 'Marathi (Marāṭhī)', 
			'mh' => 'Marshallese', 
			'mn' => 'Mongolian', 
			'na' => 'Nauru', 
			'nv' => 'Navajo, Navaho', 
			'nb' => 'Norwegian Bokmål', 
			'nd' => 'North Ndebele', 
			'ne' => 'Nepali', 
			'ng' => 'Ndonga', 
			'nn' => 'Norwegian Nynorsk', 
			'no' => 'Norwegian', 
			'ii' => 'Nuosu', 
			'nr' => 'South Ndebele', 
			'oc' => 'Occitan', 
			'oj' => 'Ojibwe, Ojibwa', 
			'cu' => 'Old Church Slavonic, Church Slavic, Church Slavonic, Old Bulgarian, Old Slavonic', 
			'om' => 'Oromo', 
			'or' => 'Oriya', 
			'os' => 'Ossetian, Ossetic', 
			'pa' => 'Panjabi, Punjabi', 
			'pi' => 'Pāli', 
			'fa' => 'Persian', 
			'pl' => 'Polish', 
			'ps' => 'Pashto, Pushto', 
			'pt' => 'Portuguese', 
			'qu' => 'Quechua', 
			'rm' => 'Romansh', 
			'rn' => 'Kirundi', 
			'ro' => 'Romanian, Moldavian, Moldovan', 
			'ru' => 'Russian', 
			'sa' => 'Sanskrit (Saṁskṛta)', 
			'sc' => 'Sardinian', 
			'sd' => 'Sindhi', 
			'se' => 'Northern Sami', 
			'sm' => 'Samoan', 
			'sg' => 'Sango', 
			'sr' => 'Serbian', 
			'gd' => 'Scottish Gaelic; Gaelic', 
			'sn' => 'Shona', 
			'si' => 'Sinhala, Sinhalese', 
			'sk' => 'Slovak', 
			'sl' => 'Slovene', 
			'so' => 'Somali', 
			'st' => 'Southern Sotho', 
			'es' => 'Spanish; Castilian', 
			'su' => 'Sundanese', 
			'sw' => 'Swahili', 
			'ss' => 'Swati', 
			'sv' => 'Swedish', 
			'ta' => 'Tamil', 
			'te' => 'Telugu', 
			'tg' => 'Tajik', 
			'th' => 'Thai', 
			'ti' => 'Tigrinya', 
			'bo' => 'Tibetan Standard, Tibetan, Central', 
			'tk' => 'Turkmen', 
			'tl' => 'Tagalog', 
			'tn' => 'Tswana', 
			'to' => 'Tonga (Tonga Islands)', 
			'tr' => 'Turkish', 
			'ts' => 'Tsonga', 
			'tt' => 'Tatar', 
			'tw' => 'Twi', 
			'ty' => 'Tahitian', 
			'ug' => 'Uighur, Uyghur', 
			'uk' => 'Ukrainian', 
			'ur' => 'Urdu', 
			'uz' => 'Uzbek', 
			've' => 'Venda', 
			'vi' => 'Vietnamese', 
			'vo' => 'Volapük', 
			'wa' => 'Walloon', 
			'cy' => 'Welsh', 
			'wo' => 'Wolof', 
			'fy' => 'Western Frisian', 
			'xh' => 'Xhosa', 
			'yi' => 'Yiddish', 
			'yo' => 'Yoruba', 
			'za' => 'Zhuang, Chuang', 
			'zu' => 'Zulu' 
			);
	
			/**
			 * returns language name in that language given the language code
			 * @param $code language code
			 */
			public static function getNativeName($code){
				return self::$nativeNames[$code];
			}
	
			/**
			 * Array di coppie codice lingua => nome in lingua delle lingua
			 */
			private static $nativeNames = array(
			'ab' => 'аҧсуа', 
			'aa' => 'Afaraf', 
			'af' => 'Afrikaans', 
			'ak' => 'Akan', 
			'sq' => 'Shqip', 
			'am' => 'አማርኛ', 
			'ar' => 'العربية', 
			'an' => 'Aragonés', 
			'hy' => 'Հայերեն', 
			'as' => 'অসমীয়া', 
			'av' => 'авар мацӀ, магӀарул мацӀ', 
			'ae' => 'avesta', 
			'ay' => 'aymar aru', 
			'az' => 'azərbaycan dili', 
			'bm' => 'bamanankan', 
			'ba' => 'башҡорт теле', 
			'eu' => 'euskara, euskera', 
			'be' => 'Беларуская', 
			'bn' => 'বাংলা', 
			'bh' => 'भोजपुरी', 
			'bi' => 'Bislama', 
			'bs' => 'bosanski jezik', 
			'br' => 'brezhoneg', 
			'bg' => 'български език', 
			'my' => 'ဗမာစာ', 
			'ca' => 'Català', 
			'ch' => 'Chamoru', 
			'ce' => 'нохчийн мотт', 
			'ny' => 'chiCheŵa, chinyanja', 
			'zh' => '中文 (Zhōngwén), 汉语, 漢語', 
			'cv' => 'чӑваш чӗлхи', 
			'kw' => 'Kernewek', 
			'co' => 'corsu, lingua corsa', 
			'cr' => 'ᓀᐦᐃᔭᐍᐏᐣ', 
			'hr' => 'hrvatski', 
			'cs' => 'česky, čeština', 
			'da' => 'dansk', 
			'dv' => 'ދިވެހި', 
			'nl' => 'Nederlands, Vlaams', 
			'dz' => 'རྫོང་ཁ', 
			'en' => 'English', 
			'eo' => 'Esperanto', 
			'et' => 'eesti, eesti keel', 
			'ee' => 'Eʋegbe', 
			'fo' => 'føroyskt', 
			'fj' => 'vosa Vakaviti', 
			'fi' => 'suomi, suomen kieli', 
			'fr' => 'français, langue française', 
			'ff' => 'Fulfulde, Pulaar, Pular', 
			'gl' => 'Galego', 
			'ka' => 'ქართული', 
			'de' => 'Deutsch', 
			'el' => 'Ελληνικά', 
			'gn' => 'Avañe\'ẽ', 
			'gu' => 'ગુજરાતી', 
			'ht' => 'Kreyòl ayisyen', 
			'ha' => 'Hausa, هَوُسَ', 
			'he' => 'עברית', 
			'hz' => 'Otjiherero', 
			'hi' => 'हिन्दी, हिंदी', 
			'ho' => 'Hiri Motu', 
			'hu' => 'Magyar', 
			'ia' => 'Interlingua', 
			'id' => 'Bahasa Indonesia', 
			'ie' => 'Originally called Occidental; then Interlingue after WWII', 
			'ga' => 'Gaeilge', 
			'ig' => 'Asụsụ Igbo', 
			'ik' => 'Iñupiaq, Iñupiatun', 
			'io' => 'Ido', 
			'is' => 'Íslenska', 
			'it' => 'Italiano', 
			'iu' => 'ᐃᓄᒃᑎᑐᑦ', 
			'ja' => '日本語 (にほんご／にっぽんご)', 
			'jv' => 'basa Jawa', 
			'kl' => 'kalaallisut, kalaallit oqaasii', 
			'kn' => 'ಕನ್ನಡ', 
			'kr' => 'Kanuri', 
			'ks' => 'कश्मीरी, كشميري‎', 
			'kk' => 'Қазақ тілі', 
			'km' => 'ភាសាខ្មែរ', 
			'ki' => 'Gĩkũyũ', 
			'rw' => 'Ikinyarwanda', 
			'ky' => 'кыргыз тили', 
			'kv' => 'коми кыв', 
			'kg' => 'KiKongo', 
			'ko' => '한국어 (韓國語), 조선말 (朝鮮語)', 
			'ku' => 'Kurdî, كوردی‎', 
			'kj' => 'Kuanyama', 
			'la' => 'latine, lingua latina', 
			'lb' => 'Lëtzebuergesch', 
			'lg' => 'Luganda', 
			'li' => 'Limburgs', 
			'ln' => 'Lingála', 
			'lo' => 'ພາສາລາວ', 
			'lt' => 'lietuvių kalba', 
			'lu' => '', 
			'lv' => 'latviešu valoda', 
			'gv' => 'Gaelg, Gailck', 
			'mk' => 'македонски јазик', 
			'mg' => 'Malagasy fiteny', 
			'ms' => 'bahasa Melayu, بهاس ملايو‎', 
			'ml' => 'മലയാളം', 
			'mt' => 'Malti', 
			'mi' => 'te reo Māori', 
			'mr' => 'मराठी', 
			'mh' => 'Kajin M̧ajeļ', 
			'mn' => 'монгол', 
			'na' => 'Ekakairũ Naoero', 
			'nv' => 'Diné bizaad, Dinékʼehǰí', 
			'nb' => 'Norsk bokmål', 
			'nd' => 'isiNdebele', 
			'ne' => 'नेपाली', 
			'ng' => 'Owambo', 
			'nn' => 'Norsk nynorsk', 
			'no' => 'Norsk', 
			'ii' => 'ꆈꌠ꒿ Nuosuhxop', 
			'nr' => 'isiNdebele', 
			'oc' => 'Occitan', 
			'oj' => 'ᐊᓂᔑᓈᐯᒧᐎᓐ', 
			'cu' => 'ѩзыкъ словѣньскъ', 
			'om' => 'Afaan Oromoo', 
			'or' => 'ଓଡ଼ିଆ', 
			'os' => 'ирон æвзаг', 
			'pa' => 'ਪੰਜਾਬੀ, پنجابی‎', 
			'pi' => 'पाऴि', 
			'fa' => 'فارسی', 
			'pl' => 'polski', 
			'ps' => 'پښتو', 
			'pt' => 'Português', 
			'qu' => 'Runa Simi, Kichwa', 
			'rm' => 'rumantsch grischun', 
			'rn' => 'kiRundi', 
			'ro' => 'română', 
			'ru' => 'русский язык', 
			'sa' => 'संस्कृतम्', 
			'sc' => 'sardu', 
			'sd' => 'सिन्धी, سنڌي، سندھی‎', 
			'se' => 'Davvisámegiella', 
			'sm' => 'gagana fa\'a Samoa', 
			'sg' => 'yângâ tî sängö', 
			'sr' => 'српски језик', 
			'gd' => 'Gàidhlig', 
			'sn' => 'chiShona', 
			'si' => 'සිංහල', 
			'sk' => 'slovenčina', 
			'sl' => 'slovenščina', 
			'so' => 'Soomaaliga, af Soomaali', 
			'st' => 'Sesotho', 
			'es' => 'español, castellano', 
			'su' => 'Basa Sunda', 
			'sw' => 'Kiswahili', 
			'ss' => 'SiSwati', 
			'sv' => 'svenska', 
			'ta' => 'தமிழ்', 
			'te' => 'తెలుగు', 
			'tg' => 'тоҷикӣ, toğikī, تاجیکی‎', 
			'th' => 'ไทย', 
			'ti' => 'ትግርኛ', 
			'bo' => 'བོད་ཡིག', 
			'tk' => 'Türkmen, Түркмен', 
			'tl' => 'Wikang Tagalog, ᜏᜒᜃᜅ᜔ ᜆᜄᜎᜓᜄ᜔', 
			'tn' => 'Setswana', 
			'to' => 'faka Tonga', 
			'tr' => 'Türkçe', 
			'ts' => 'Xitsonga', 
			'tt' => 'татарча, tatarça, تاتارچا‎', 
			'tw' => 'Twi', 
			'ty' => 'Reo Tahiti', 
			'ug' => 'Uyƣurqə, ئۇيغۇرچە‎', 
			'uk' => 'українська', 
			'ur' => 'اردو', 
			'uz' => 'O\'zbek, Ўзбек, أۇزبېك‎', 
			've' => 'Tshivenḓa', 
			'vi' => 'Tiếng Việt', 
			'vo' => 'Volapük', 
			'wa' => 'Walon', 
			'cy' => 'Cymraeg', 
			'wo' => 'Wollof', 
			'fy' => 'Frysk', 
			'xh' => 'isiXhosa', 
			'yi' => 'ייִדיש', 
			'yo' => 'Yorùbá', 
			'za' => 'Saɯ cueŋƅ, Saw cuengh', 
			'zu' => 'isiZulu'
			);
}
?>