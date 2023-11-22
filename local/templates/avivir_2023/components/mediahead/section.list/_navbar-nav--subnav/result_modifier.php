<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if( count($arResult['SECTIONS']) >= 1 )
{
	//apre( intval($arParams['COUNT_SECTIONS']) );
	
	if ( intval($arParams['COUNT_SECTIONS']) >= 1 )
	{
		array_splice( $arResult['SECTIONS'], intval($arParams['COUNT_SECTIONS']) );
	}
}
?>