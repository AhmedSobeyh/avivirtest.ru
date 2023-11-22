<? require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */


//Получение информации о разделах инфоблока
$s = new CIBlockSection;
$rs = $s->GetList(array(), array('IBLOCK_ID' => $arParams['IBLOCK_ID'], ["ID", "IBLOCK_ID", "NAME", "SECTION_PAGE_URL"]));
while ($section = $rs->GetNext()) {
	$arResult['SECTIONS'][$section['ID']] = $section;
}

foreach ($arResult["ITEMS"] as &$item) {
	$background_rand = (bool)random_int(0, 1);

	if ($item['IBLOCK_SECTION_ID'] > 0) {
		$item_section = $arResult['SECTIONS'][$item['IBLOCK_SECTION_ID']];
		$item['SECTION']['NAME'] =  $item_section['NAME'];
		$item['SECTION']['SECTION_PAGE_URL'] =  $item_section['SECTION_PAGE_URL'];
		$item['SECTION']['CODE'] =  $item_section['CODE'];
	}

	if (empty($item['PREVIEW_PICTURE'])) {
		$background_rand = false;
	}

	$arResult["DATA"][] = array(
		"section_name" => $item['SECTION']['NAME'],
		"sectionURL" => $item['SECTION']['SECTION_PAGE_URL'],
		"title" =>  strip_tags($item['NAME']),
		"text" => strip_tags($item["PREVIEW_TEXT"]),
		"detailPageURL" => $item["DETAIL_PAGE_URL"],
		"image" =>  $item['PREVIEW_PICTURE']['SRC'],
		"date" => $item['ACTIVE_FROM'],
		"background" => $background_rand
	);
}



// $arResult["NAV_STRING"] = $arResult["NAV_RESULT"]->GetPageNavStringEx(
// 	$navComponentObject,
// 	$arParams["PAGER_TITLE"],
// 	$arParams["PAGER_TEMPLATE"],
// 	$arParams["PAGER_SHOW_ALWAYS"],
// 	$this->__component,
// 	$arResult["NAV_PARAM"]
// );
