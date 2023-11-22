<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if( count($arResult["ITEMS"]) >= 1 )
{
	foreach ( $arResult['ITEMS'] as &$arItem )
	{
		// Языка
		if ( LANGUAGE_ID == 'ru' )
		{
			// Название
			$arItem['NAME'] = $arItem['NAME'];
			// Должность
			$arItem['REGALIA'] = $arItem['PREVIEW_TEXT'];
		}
		else
		{
			// Название
			if ( $arItem['PROPERTIES']['EN_NAME']['VALUE'] )
			{
				$arItem['NAME'] = $arItem['PROPERTIES']['EN_NAME']['VALUE'];
			}
			else
			{
				$arItem['NAME'] = $arItem['NAME'];
			}

			// Должность
			if ( $arItem['PROPERTIES']['EN_PREVIEW_TEXT']['~VALUE']['TEXT'] )
			{
				$arItem['REGALIA'] = $arItem['PROPERTIES']['EN_PREVIEW_TEXT']['~VALUE']['TEXT'];
			}
			else
			{
				$arItem['REGALIA'] = $arItem['PREVIEW_TEXT'];
			}
		}

		// Изображение
		if ( count($arItem['DETAIL_PICTURE']) >= 1 )
		{
			$file = CFile::ResizeImageGet($arItem['DETAIL_PICTURE'], array('width' => 600, 'height' => 600), BX_RESIZE_IMAGE_EXACT, false);
			$arItem['DETAIL_PICTURE']['NEW_SRC'] = $file['src'];
			unset($file);
		}
		
	}
}
?>
