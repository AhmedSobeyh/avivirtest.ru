<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */



foreach($arResult["ITEMS"] as &$item)
{
	$item['MINUTS'] = floor(strlen($item['DETAIL_TEXT'])/1000); 
	
	if ($item['IBLOCK_SECTION_ID'] > 0)
	{
		$sectionIds[] = $item['IBLOCK_SECTION_ID'];
		$item['SECTION_ID'] = $item['IBLOCK_SECTION_ID'];
	}

	if ($item['PROPERTIES']['DATE']['VALUE'])
		$item['DATE'] = $item['PROPERTIES']['DATE']['VALUE'];
	
	if (empty($item['PREVIEW_PICTURE']))
	{
		$item['PREVIEW_PICTURE'] = $item['DETAIL_PICTURE'];
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
