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
use Bitrix\Highloadblock as HL;
use Mediahead\Helpers\Lang;

class Tools 
{

    const TEASER_IBLOCK = 3;
    const PARTNER_IBLOCK = 2;
	
	public static function getHlClass($table)
    {
        return HL\HighloadBlockTable::compileEntity($table)->getDataClass(); 
    }
	
	
	/*
	* Получает корректные поля из справочника
	* Принимает массив свойства, возвращаемый методом CIBlockElement->GetProperties()
	* Учитывает язык 
	*/
	public static function obtainDirectoryProp(&$property)
	{
		
		if ($property['USER_TYPE'] != 'directory' || empty($property['USER_TYPE_SETTINGS']['TABLE_NAME']))
		{
			return;
		}
		
		$lang = Lang::getLang();
		
		try 
		{
			$hlblock = HL\HighloadBlockTable::query()->addSelect('*')->where('TABLE_NAME', $property['USER_TYPE_SETTINGS']['TABLE_NAME'])->exec()->fetch();
			$class = static::getHlClass($hlblock['NAME']);
			
			if (!empty($property['VALUE']))
			{
				$params = [
					'filter' => ['UF_XML_ID' => $property['VALUE']]
				];
			}
			elseif (!empty($property['VALUES']))
			{
				$params = [
					'filter' => ['UF_XML_ID' => array_keys($property['VALUES'])]
				];
			}
			
			if (!$params)
			{
				return;
			}

			$res = $class::getList($params);
			while ($data = $res->fetch())
			{
				
				if (!empty($data["UF_".$lang."_NAME"]))
				{
					$property['VALUE'] = $data["UF_".$lang."_NAME"];
				}
				else 
				{
					$property['VALUE'] = $data["UF_NAME"];
				}
				
				$save = [];
				foreach($data as $code => $value)
				{
					$baseCode = str_replace("UF_", "", $code);
					if (array_key_exists("UF_".$lang."_".$baseCode, $data))
					{
						$save[$baseCode] = $data["UF_".$lang."_".$baseCode];
					}
					else 
					{
						$save[$baseCode] = $data[$code];
					}
					
					// Пока просто по имени, если там файл. В идеале надо проверять тип поля
					if ($baseCode == 'FILE' && (int)$value > 0)
					{
						$save['FILE_VALUE'] = \CFile::GetFileArray($value);
					}
					
				}

				$key = $data['UF_XML_ID'];
				$arData[$key] = $save;

			}
			
			
			if (count($arData) == 1)
				$property['HL_DATA'] = current($arData);  
			else 
				$property['HL_DATA'] = $arData; 	
			//$property['HL_DATA_RAW'] = $data;  
			
		}
		catch (Exception $e)	
		{
			$property['ERROR'] = $e;
			$property['DATA_CLASS'] = $property['USER_TYPE_SETTINGS']['TABLE_NAME'];
		}
		
	}
	
	/*
	* Получает тизеры по массиву ID элементов инфоблока
	* Поддерживает языковые поля
	* Иконкой приоритетно является свойство SVG. 
	* Еси оно пусто - берет картинку для анонса
	* 
	* Возвращает массив, в порядке сортировки переданных ID
	* 
	* @param array $ids - массив ID партнеров
	* @return array | false
	*/ 
	public static function getTeasers($ids)
	{
		
		
		if (empty($ids))
		{
			return false;
		}		

		$sortArr = $ids;	
		
		$lang = Lang::getLang();
		
		$iblock = \Bitrix\Iblock\Iblock::wakeUp(static::TEASER_IBLOCK);
		$class = $iblock->getEntityDataClass();
		
		$params = [
			'filter' => [
				'ID' => $ids
			],
			'select' => [
				'ID', 'NAME', 'PREVIEW_PICTURE', 'PREVIEW_TEXT', 'ICON_ID' => 'SVG.VALUE'
			]
		];
		
		$arFields = ['NAME','DETAIL_TEXT','PREVIEW_TEXT']; 
		
		if ($lang != 'RU')
		{
			$params['select'][$lang.'__NAME'] = $lang."_NAME.VALUE"; 
			//$params['select'][$lang.'__DETAIL_TEXT'] = $lang.'_DETAIL_TEXT.VALUE';
			$params['select'][$lang.'__PREVIEW_TEXT'] = $lang.'_PREVIEW_TEXT.VALUE';
		}
		
		$rs = $class::getList($params);
		while ($item = $rs->fetch()) 
		{
			
			//$perf['DETAIL_PAGE_URL'] = \CIBlock::ReplaceDetailUrl($perf['DETAIL_PAGE_URL'], $perf, false, 'E'); 
			
			// Костыль для китайского или любого языка, кроме русского и английского
			if ($lang != 'RU' && $lang != 'EN')
			{
				
				foreach($arFields as $field)
				{
					$langKey = $lang."__".$field; 
					if (array_key_exists($langKey, $item) && empty($item[$langKey]) && !empty($item["EN__".$field]))
					{
						$item[$langKey] = $item["EN__".$field];						
					}
				}
			}
			
			foreach($arFields as $field)
			{
				
				$langKey = $lang."__".$field;

				if (array_key_exists($langKey, $item) && !empty($item[$langKey]))
				{
					
					if ($field != 'NAME')
					{
						$val = unserialize($item[$langKey]);
						
						if ($val['TEXT'] == 'Array')
							 $val['TEXT'] = '';
						
						$item[$field] = $val['TEXT'];
						
					}
					else 
						$item[$field] = $item[$langKey];
					
					unset($item[$langKey]);
				}
				
			}
			 
			 
			$iconId = (int)$item['ICON_ID'] > 0 ? $item['ICON_ID'] : $item['PREVIEW_PICTURE'];
				
			if ((int)$iconId > 0)
			{
				$item['ICON'] = \CFile::GetFileArray((int)$iconId);	
			} 
			
			$result[$item['ID']] = $item;
			
		}
		
		$sortedResult = [];
		
		foreach($sortArr as $id)
		{
			if ($result[$id])
				$sortedArr[] = $result[$id];
		}
		
		$result = $sortedArr;
		
		if (!count($result))
			return false;
		
		return $result;			 
			 
		
	}
	


	/*
	* Получает партнеров по массиву ID элементов инфоблока
	* Поддерживает языковые поля
	* !!Иконкой приоритетно является свойство SVG (пока нет такого свойства - если добавить, то будет так). 
	* Еси оно пусто - берет картинку для анонса
	* 
	* Возвращает массив, в порядке сортировки переданных ID
	* 
	* @param array $ids - массив ID партнеров
	* @return array | false
	*/ 
	public static function getPartners($ids, $customSettings = false)
	{
		
		
		if (empty($ids))
		{
			return false;
		}		

		if (is_array($ids))
			$sortArr = $ids;	
		
		$lang = Lang::getLang();
		
		$iblock = \Bitrix\Iblock\Iblock::wakeUp(static::PARTNER_IBLOCK);
		$class = $iblock->getEntityDataClass();
		
		$params = [
			'filter' => [
				'ID' => $ids
			],
			'select' => [
				'ID', 'NAME', 'PREVIEW_PICTURE', 'PREVIEW_TEXT', 'CODE', 'IBLOCK_SECTION_ID',
				'ICON_ID' => 'SVG.VALUE', 'LINK' => 'WEBSITE.VALUE', 
				'DETAIL_PAGE_URL' => 'IBLOCK.DETAIL_PAGE_URL'
			]
		];
		
		$arFields = ['NAME','DETAIL_TEXT','PREVIEW_TEXT']; 
		
		if ($lang != 'RU')
		{
			$params['select'][$lang.'__NAME'] = $lang."_NAME.VALUE"; 
			//$params['select'][$lang.'__DETAIL_TEXT'] = $lang.'_DETAIL_TEXT.VALUE';
			$params['select'][$lang.'__PREVIEW_TEXT'] = $lang.'_PREVIEW_TEXT.VALUE';
		}
		
		$rs = $class::getList($params);
		while ($item = $rs->fetch()) 
		{
			
			//$perf['DETAIL_PAGE_URL'] = \CIBlock::ReplaceDetailUrl($perf['DETAIL_PAGE_URL'], $perf, false, 'E'); 
			
			// Костыль для китайского или любого языка, кроме русского и английского
			if ($lang != 'RU' && $lang != 'EN')
			{
				
				foreach($arFields as $field)
				{
					$langKey = $lang."__".$field; 
					if (array_key_exists($langKey, $item) && empty($item[$langKey]) && !empty($item["EN__".$field]))
					{
						$item[$langKey] = $item["EN__".$field];						
					}
				}
			}
			
			foreach($arFields as $field)
			{
				
				$langKey = $lang."__".$field;

				if (array_key_exists($langKey, $item) && !empty($item[$langKey]))
				{
					
					if ($field != 'NAME')
					{
						$val = unserialize($item[$langKey]);
						
						if ($val['TEXT'] == 'Array')
							 $val['TEXT'] = '';
						
						$item[$field] = $val['TEXT'];
						
					}
					else 
						$item[$field] = $item[$langKey];
					
					unset($item[$langKey]);
				}
				
			}
			 
			 
			$iconId = (int)$item['ICON_ID'] > 0 ? $item['ICON_ID'] : $item['PREVIEW_PICTURE'];
				
			if ((int)$iconId > 0)
			{
				$item['ICON'] = \CFile::GetFileArray((int)$iconId);	
			} 
			
			$item['DETAIL_PAGE_URL'] = \CIBlock::ReplaceDetailUrl($item['DETAIL_PAGE_URL'], $item, false, 'E');
			
			$result[$item['ID']] = $item;
			
		}
		
		
		if ($sortArr)
		{
			$sortedResult = [];
			
			foreach($sortArr as $key => $id)
			{
				if ($result[$id])
					$sortedArr[$key] = $result[$id];

				if ($customSettings[$key])
					$sortedArr[$key]['CUSTOM'] = unserialize($customSettings[$key]);
			}
			
			$result = $sortedArr;
		}
		
		if (!count($result))
			return false;
		
		return $result;
			 
		
	}


}
