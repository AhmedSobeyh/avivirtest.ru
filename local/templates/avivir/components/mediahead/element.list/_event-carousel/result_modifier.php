<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */

$obParser = new CTextParser;

foreach($arResult["ITEMS"] as &$item) {
	if (empty($item['PREVIEW_TEXT'])) {
		$item['PREVIEW_TEXT'] = $obParser->html_cut($item["DETAIL_TEXT"], 150);
	}

	$itemImg = CFile::ResizeImageGet($item['PREVIEW_PICTURE'], ["width" => 540, "height" => 420], BX_RESIZE_IMAGE_EXACT, true);
	$item['PREVIEW_PICTURE']['SRC'] = $itemImg['src'];
	$item['PREVIEW_PICTURE']['HEIGHT'] = $itemImg['height'];
	$item['PREVIEW_PICTURE']['WIDTH'] = $itemImg['width'];
}

$arResult["NAV_STRING"] = $arResult["NAV_RESULT"]->GetPageNavStringEx(
	$navComponentObject,
	$arParams["PAGER_TITLE"],
	$arParams["PAGER_TEMPLATE"],
	$arParams["PAGER_SHOW_ALWAYS"],
	$this->__component,
	$arResult["NAV_PARAM"]
);
