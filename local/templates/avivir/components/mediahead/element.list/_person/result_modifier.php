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


	if ($item['PROPERTIES']['PERSONA']['VALUE'])
	{
		$personIds[] = $item['PROPERTIES']['PERSONA']['VALUE'];
		$item['PERSONA_ID'] = $item['PROPERTIES']['PERSONA']['VALUE'];
	}

}

if ($personIds)
{
	$e = new CIBlockElement;
	$rs = $e->GetList([],["ID" => $personIds], false, false, ["ID","NAME","DETAIL_PICTURE","PREVIEW_TEXT"]);
	while ($persona = $rs->Fetch())
	{
		$arResult["PERSONA"][$persona["ID"]] = $persona;
	}
}

$obParser = new CTextParser;

foreach($arResult["ITEMS"] as &$item)
{
	if ($item["PERSONA_ID"])
	{

		$item["PERSONA"] = $arResult["PERSONA"][$item["PERSONA_ID"]];

		if ($item["PERSONA"]["DETAIL_PICTURE"])
		{
			$item["PERSONA"]["IMAGE"] = CFile::ResizeImageGet($item["PERSONA"]["DETAIL_PICTURE"], ["width" => 540, "height" => 420],BX_RESIZE_IMAGE_EXACT,true);
		}

		if (empty($item["PREVIEW_PICTURE"]) && !empty($item["PERSONA"]["IMAGE"]))
		{
			$item["PREVIEW_PICTURE"] = $item["PERSONA"]["IMAGE"];
			$item["PREVIEW_PICTURE"]["SRC"] = $item["PERSONA"]["IMAGE"]["src"];
		}

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
