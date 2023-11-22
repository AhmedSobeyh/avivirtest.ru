<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */


// apre($arResult['ITEMS'],'photoItems');

foreach($arResult["ITEMS"] as $arItem) {
	$fileImg = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array("width" => 320, "height" => 560), BX_RESIZE_IMAGE_PROPORTIONAL, true);
	$arItem['PREVIEW_PICTURE']['SRC'] = $fileImg['src'];
	$arItem['PREVIEW_PICTURE']['HEIGHT'] = $fileImg['height'];
	$arItem['PREVIEW_PICTURE']['WIDTH'] = $fileImg['width'];
}

$arResult["NAV_STRING"] = $arResult["NAV_RESULT"]->GetPageNavStringEx(
	$navComponentObject,
	$arParams["PAGER_TITLE"],
	$arParams["PAGER_TEMPLATE"],
	$arParams["PAGER_SHOW_ALWAYS"],
	$this->__component,
	$arResult["NAV_PARAM"]
);
