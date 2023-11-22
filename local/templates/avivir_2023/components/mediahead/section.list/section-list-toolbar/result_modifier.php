<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if( count($arResult['SECTIONS']) >= 1 )
{
	foreach( $arResult['SECTIONS'] as &$arItem )
	{
		
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
	}
}
?>