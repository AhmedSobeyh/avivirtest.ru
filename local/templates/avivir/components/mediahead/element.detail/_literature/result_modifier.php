<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */

if (!empty($arResult["DETAIL_PICTURE"])) 
{
	$arResult["DETAIL_PICTURE"] = \CFile::ResizeImageGet($arResult["PERSONA"]["DETAIL_PICTURE"],["width" => 260, "height" => 260], BX_RESIZE_IMAGE_EXACT,true);
	$arResult["DETAIL_PICTURE"]["SRC"] = $arResult["DETAIL_PICTURE"]["src"]; 
}

if ($arResult["PROPERTIES"]["PERSONA"]["VALUE"])
{
	$arResult['PERSON'] = array();

	$arPersonSelect = array(
		"ID",
		"IBLOCK_ID",
		"NAME",
		"PREVIEW_TEXT",
		"DETAIL_PICTURE"
	);

	$arPersonFilter = array(
		"ID" => $arResult["PROPERTIES"]["PERSONA"]["VALUE"],
		"IBLOCK_ID" => 11,
		"ACTIVE" => "Y"
	);

	$arResult["PERSONA"] = \CIBlockElement::GetList([], $arPersonFilter, false, false, $arPersonSelect)->GetNext();
	if ($arResult["PERSONA"]["DETAIL_PICTURE"] && empty($arResult["DETAIL_PICTURE"]))
	{
		$arResult["DETAIL_PICTURE"] = \CFile::ResizeImageGet($arResult["PERSONA"]["DETAIL_PICTURE"],["width" => 260, "height" => 260], BX_RESIZE_IMAGE_EXACT,true);
		$arResult["DETAIL_PICTURE"]["SRC"] = $arResult["DETAIL_PICTURE"]["src"]; 
	}
}

