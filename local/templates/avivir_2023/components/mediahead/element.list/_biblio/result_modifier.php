<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */



foreach($arResult["ITEMS"] as &$item)
{
	if ($item['IBLOCK_SECTION_ID'] > 0)
	{
		$sectionIds[] = $item['IBLOCK_SECTION_ID'];
		$item['SECTION_ID'] = $item['IBLOCK_SECTION_ID'];
	}	
}


$obParser = new CTextParser;

foreach($arResult["ITEMS"] as &$item)
{
	
	if (!empty($item["DETAIL_PICTURE"]))
	{
		$item["PREVIEW_PICTURE"] = \CFile::ResizeImageGet($item["DETAIL_PICTURE"],["width" => 220, "height" => 298], BX_RESIZE_IMAGE_EXACT,true);
		$item["PREVIEW_PICTURE"]["SRC"] = $item["PREVIEW_PICTURE"]["src"];
	}

	if (empty($item['PREVIEW_TEXT']))
	{
		$item['PREVIEW_TEXT'] = $obParser->html_cut($item["DETAIL_TEXT"], 150); 
	}

}

if ($sectionIds)
{
	$sectionIds = array_unique($sectionIds);
	$s = new CIBlockSection;
	$rs = $s->GetList(["SORT" => "ASC"], ['ID' => $sectionIds], true, ["ID","IBLOCK_ID","NAME","SECTION_PAGE_URL"]);
	while($section = $rs->GetNext())
	{
		$arResult['SECTIONS'][$section['ID']] = $section;
	}
}

$arResult["NAV_STRING"] = $arResult["NAV_RESULT"]->GetPageNavStringEx(
	$navComponentObject,
	$arParams["PAGER_TITLE"],
	$arParams["PAGER_TEMPLATE"],
	$arParams["PAGER_SHOW_ALWAYS"],
	$this->__component,
	$arResult["NAV_PARAM"]
);
