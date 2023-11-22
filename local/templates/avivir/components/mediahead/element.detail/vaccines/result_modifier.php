<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */


if (!empty($arResult["DETAIL_PICTURE"]))
{
	$arResult["DETAIL_PICTURE"] = \CFile::ResizeImageGet($arResult["DETAIL_PICTURE"],["width" => 400, "height" => 400], BX_RESIZE_IMAGE_PROPORTIONAL, true);
	$arResult["DETAIL_PICTURE"]["SRC"] = $arResult["DETAIL_PICTURE"]["src"];
}

if (!empty($arResult['PROPERTIES']['BANNER_PICTURE']['VALUE']))
{
	$arResult['PROPERTIES']['BANNER_PICTURE']['VALUE'] = \CFile::ResizeImageGet($arResult['PROPERTIES']['BANNER_PICTURE']['VALUE'],["width" => 640, "height" => 640], BX_RESIZE_IMAGE_PROPORTIONAL, true);
	$arResult['PROPERTIES']['BANNER_PICTURE']['VALUE'] = $arResult['PROPERTIES']['BANNER_PICTURE']['VALUE'];
}
