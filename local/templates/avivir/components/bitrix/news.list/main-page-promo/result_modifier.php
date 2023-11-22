<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if( count($arResult["ITEMS"]) >= 1 )
{
	$rand = rand( 0, count($arResult["ITEMS"]) );
	$proze = $arResult["ITEMS"][ $rand ];
	
	$arResult['PROZE_NAME'] = $proze['NAME'];
	$arResult['PROZE_TEXT'] = explode('<br />', $proze['DETAIL_TEXT']);
	$arResult['PROZE_TEXT'] = array_slice( $arResult['PROZE_TEXT'], 0, 18 );
}
?>
