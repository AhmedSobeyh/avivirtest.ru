<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */


if (!empty($arResult["DETAIL_PICTURE"]))
{
	$arResult["DETAIL_PICTURE"] = \CFile::ResizeImageGet($arResult["DETAIL_PICTURE"],["width" => 730, "height" => 760], BX_RESIZE_IMAGE_PROPORTIONAL, true);
	$arResult["DETAIL_PICTURE"]["SRC"] = $arResult["DETAIL_PICTURE"]["src"]; 
}

if (!empty($arResult["PROPERTIES"]["GALLERY"]["VALUE"]))
{
	foreach($arResult["PROPERTIES"]["GALLERY"]["VALUE"] as $id)
	{
		$image = \CFile::GetFileArray($id);
		$image['RESIZE'] = \CFile::ResizeImageGet($id,["width" => 1280, "height" => 2500], BX_RESIZE_IMAGE_PROPORTIONAL, true);

		$arResult["GALLERY"][] = $image;
	}
		
	
}