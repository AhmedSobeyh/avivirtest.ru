<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if( count($arResult["ITEMS"]) >= 1 )
{
	foreach ( $arResult['ITEMS'] as &$arItem )
	{
		// Файл
		if ( $arItem['PROPERTIES']['FILE']['VALUE'] )
		{
			$arFile = CFile::GetFileArray( $arItem['PROPERTIES']['FILE']['VALUE'] );
			$arItem['FILE'] = $arFile['SRC'];
		}
	}
}
?>
