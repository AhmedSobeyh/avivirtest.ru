<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if( count($arResult['SECTIONS']) >= 1 )
{
	foreach( $arResult['SECTIONS'] as &$arItem )
	{
		
		if( !$arItem['~PICTURE'] )
		{
			$params = [
				'filter' => ['IBLOCK_SECTION_ID' => $arItem['ID'], '!PREVIEW_PICTURE' => false],
				'select' => ['IBLOCK_SECTION_ID','ID','DETAIL_PICTURE','PREVIEW_PICTURE'],
				'limit' => 1
			];
			$firstItem = \Bitrix\Iblock\ElementTable::getList($params)->fetch();
			$arItem['~PICTURE'] = $firstItem['PREVIEW_PICTURE'];
		}
		
		if( $arItem['~PICTURE'] )
		{
			$fileImg = CFile::ResizeImageGet($arItem['~PICTURE'], array("width" => 340, "height" => 340), BX_RESIZE_IMAGE_EXACT, true);
			$arItem['PICTURE']['SRC'] = $fileImg['src']; 
		}
	}
}
?>