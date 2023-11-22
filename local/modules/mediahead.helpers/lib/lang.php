<?
/**
 * Mediahead Agency
 * @package mediahead
 * @subpackage mediahead.helpers
 * @copyright 2007-2020 Mediahead
 */
namespace Mediahead\Helpers;

use Bitrix\Iblock;
use Bitrix\Main\Context;

class Lang 
{
	
	/**
	*
	* Метод модифицирует массив arResult компонента
	* Подменяет базовые поля на их языковые значения
	* По префиксу в названии свойства
	*
	*/
	public static function obtainLangFields(&$result)
	{
		
		if (static::isList($result))
		{
			foreach($result['ITEMS'] as $i => &$item)
			{
				if (static::hasLangProps($item))
				{
					static::obtainItemLangFields($item); 
				}
			}
			
			foreach($result['SECTIONS'] as $i => &$section)
			{
				if (static::hasLangProps($section))
				{
					static::obtainSectionLangFields($section); 
				}
			}
			
		}
		else
		{
			
			// Если элемент
			if (static::hasLangProps($result)) 
			{
				static::obtainItemLangFields($result);
			}
			
			// Если раздел
			if (static::hasUserFieldLangName($result))
			{
				static::obtainSectionLangFields($result);
			}
		}
		
	}
	
	/**
	*
	* Метод модифицирует массив arResult Элемента инфоблока
	* Подменяет базовые поля на их языковые значения 
	* По префиксу в названии свойства
	*
	*/
	public static function obtainItemLangFields(&$item)
	{
		
		$lang = static::getLang();
		
		$arFields = ['NAME','DETAIL_TEXT','PREVIEW_TEXT']; 
		foreach($item['PROPERTIES'] as $prop)
		{
			
			$propCode = str_replace("{$lang}_", "", $prop['CODE']);

			// Небольшой костыль. Заполняем пустые поля в китайском на английском
			if (mb_strpos($prop['CODE'], "CN") !== false && empty($prop['~VALUE']) && !empty($item['PROPERTIES']['EN_'.$propCode]['~VALUE']))
			{
				$prop['~VALUE'] = $item['PROPERTIES']['EN_'.$propCode]['~VALUE'];
				$prop['VALUE'] = $item['PROPERTIES']['EN_'.$propCode]['VALUE'];
			}
			
			// И записываем языыковые данные в свойства без префиксов
			if (mb_strpos($prop['CODE'], $lang) !== false)
			{
				
				if (in_array($propCode, $arFields))
				{
					$item[$propCode] = !empty($prop['~VALUE']['TEXT']) ? $prop['~VALUE']['TEXT'] : $prop['VALUE'];
				}
				else
				{
					$item['PROPERTIES'][$propCode]['VALUE'] = !empty($prop['~VALUE']) ? $prop['~VALUE'] : $prop['VALUE'];
					
					if ($prop['DISPLAY'])
					{
						$item['PROPERTIES'][$propCode]['DISPLAY'] = $prop['DISPLAY'];
					}

					if ($prop['DESCRIPTION'])
					{
						$item['PROPERTIES'][$propCode]['DESCRIPTION'] = $prop['DESCRIPTION'];
					}

				}
				
				
				
			}
		}
		
	} 
	
	/**
	*
	* Метод модифицирует массив arResult Раздела инфоблока
	* Подменяет базовые поля на их языковые значения 
	* По префиксу в названии свойства (UF_EN_NAME, например)
	* Выбрать значения нужно в компоненте!
	*
	*/
	public static function obtainSectionLangFields(&$section)
	{
		
		$lang = static::getLang();
		
		$arFields = ['NAME','DESCRIPTION']; 
		foreach($section as $code => $value)
		{
			
			$keyCode = str_replace("UF_{$lang}_", "", $code);

			// Небольшой костыль. Заполняем пустые поля в китайском на английском
			if (mb_strpos($code, "CN") !== false && empty($value) && !empty($section['UF_EN_'.$keyCode]))
			{
				$prop['~VALUE'] = $item['PROPERTIES']['EN_'.$propCode]['~VALUE'];
				$prop['VALUE'] = $item['PROPERTIES']['EN_'.$propCode]['VALUE'];
				$section["UF_CN_$keyCode"] = $value;
			}
			
			// И записываем языыковые данные в свойства без префиксов
			if (mb_strpos($code, $lang) !== false)
			{
				$section[$keyCode] = $value;
			}
		}
		
	} 
	
	/**
	* Проверяет является ли массив arResult списочным
	*
	*/
	private function isList($result)
	{
		
		if (is_array($result['ITEMS']) && count($result['ITEMS']) > 0 || is_array($result['SECTIONS']) && count($result['SECTIONS']) > 0)
		{
			return true;
		}
		
		return false;
		
	}
	
	
	/**
	* Проверяет наличие свойств с префиксами в массиве элемента
	* Или поле UF_{LANG}_NAME для раздела
	*
	*/
	private function hasLangProps($item)
	{
		
		$lang = static::getLang();
		
		// Для элементов
		if (is_array($item['PROPERTIES']) && count($item['PROPERTIES']) > 0)
		{
			
			foreach($item['PROPERTIES'] as $prop)
			{
				if (mb_strpos($prop['CODE'], $lang) !== false)
				{
					return true;
				}
			}
		}
		
		// Для разделов (проверим только название)
		if (array_key_exists("UF_".$lang."_NAME",$item))
		{
			return true;
		}		
		
		return false;
		
	}
	
	
	/**
	* Проверяет наличие пользовательских свойств 
	* с префиксами в массиве элемента UF_{LANG}_NAME
	* Применимо, чтобы определить является ли массив разделом или выборкой из HL
	*/
	private function hasUserFieldLangName($item)
	{
		
		$lang = static::getLang();
		
		// Для разделов (проверим только название)
		if (array_key_exists("UF_".$lang."_NAME",$item))
		{
			return true;
		}		
		
		return false;
		
	}
	
	
	/**
	* 
	* Возвращает текущий язык в верхнем регистре
	*
	*/
	public static function getLang()
	{
		
		return mb_strtoupper(Context::getCurrent()->getLanguage());
	}
	
	
}