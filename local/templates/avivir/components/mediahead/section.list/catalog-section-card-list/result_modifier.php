<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if( count($arResult['SECTIONS']) >= 1 )
{
	// Все ID разделов
	$sectionIDs = array();
	// Дочерние разделы
	$arResult['CHILDREN_SECTIONS'] = array();
	
	foreach( $arResult['SECTIONS'] as &$arItem )
	{
		/*
		if( !$arItem['~PICTURE'] )
		{
			$params = [
				'filter' => ['IBLOCK_SECTION_ID' => $arItem['ID']],
				'select' => ['IBLOCK_SECTION_ID','ID','DETAIL_PICTURE'],
				'limit' => 1
			];
			$firstItem = \Bitrix\Iblock\ElementTable::getList($params)->fetch();
			$arItem['~PICTURE'] = $firstItem['DETAIL_PICTURE'];
		}
		*/

		if( $arItem['~PICTURE'] )
		{
			$fileImg = CFile::ResizeImageGet($arItem['~PICTURE'], array("width" => 300, "height" => 400), BX_RESIZE_IMAGE_EXACT, true);
			$arItem['PICTURE']['SRC'] = $fileImg['src'];
		}
		
		// Запишем ID раздела в общий массив для последующей выборки внутренних разделов
		$sectionIDs[ $arItem['ID'] ] = $arItem['ID'];
	}
	
	// Найдем все дочерние разделы для родительских разделов
	if (count($sectionIDs) >= 1 )
	{
		$arFilter = array(
			'IBLOCK_TYPE' => $arResult['IBLOCK_TYPE'],
			'IBLOCK_ID' => $arResult['IBLOCK_ID'],
			'SECTION_ID' => $sectionIDs
		);
		$rsSections = CIBlockSection::GetList(array('LEFT_MARGIN' => 'ASC'), $arFilter);
		while ( $arSection = $rsSections->Fetch() )
		{
			$arResult['CHILDREN_SECTIONS'][ $arSection['IBLOCK_SECTION_ID'] ][] = $arSection;
		}
	}
	
	// Соберем
	foreach( $arResult['SECTIONS'] as &$arItem )
	{
		// Если есть внутренние разделы
		if ( !empty($arResult['CHILDREN_SECTIONS'][ $arItem['ID'] ]) )
		{
			// Если количество дочерних разделов больше 3-х
			if ( count( $arResult['CHILDREN_SECTIONS'][ $arItem['ID'] ] ) >= 4 )
			{
				// Покажем кнопку «Другие»
				$arItem['CHILDREN_SECTIONS']['OTHER'] = 'Y';
			}
			else
			{
				// Скроем кнопку «Другие»
				$arItem['CHILDREN_SECTIONS']['OTHER'] = 'N';
			}
			
			// Соберем массив с дочерними разделами в количестве от 1 до 3
			for ( $i = 0; $i < 3; $i++ )
			{
				$arItem['CHILDREN_SECTIONS']['LIST'][ $i ] = $arResult['CHILDREN_SECTIONS'][ $arItem['ID'] ][ $i ];
			}
		}
	}
}



?>
