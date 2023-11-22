<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if( count($arResult['SECTIONS']) >= 1 )
{
	// Основной список
	$arResult['LIST'] = array();
	// Сокращенный список
	$arResult['OTHER_LIST'] = array();
	
	foreach( $arResult['SECTIONS'] as $key => &$arItem )
	{
		//apre( $arItem );
		
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
		
		if( $arItem['~PICTURE'] )
		{
			$fileImg = CFile::ResizeImageGet($arItem['~PICTURE'], array("width" => 240, "height" => 320), BX_RESIZE_IMAGE_EXACT, true);
			$arItem['PICTURE']['SRC'] = $fileImg['src'];
		}
		
		// Основной список
		if ( empty($arItem['UF_OTHER']) || !$arItem['UF_OTHER'] )
		{
			$arResult['LIST'][] = $arItem;
		}
		// Сокращенный список
		elseif ( $arItem['UF_OTHER'] )
		{
			$arResult['OTHER_LIST'][] = $arItem;
		}
	}
	
	unset( $arResult['SECTIONS'] );
	
	//apre( $arResult['LIST'] );
	//apre( $arResult['OTHER_LIST'] );
}
?>