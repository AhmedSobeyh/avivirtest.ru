<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
// линейный массив с адресами каждого свойства по одному
// ключи массива - КОД_СВОЙСТВА . КОД_ЗНАЧЕНИЯ
$arUrls = array();
// линейный с ключами КОД_СВОЙСТВА . КОД_ЗНАЧЕНИЯ
$checkedValues = array();

foreach ($arResult['ITEMS'] as $k => &$item)
{
    $isUnset = true;
    $isExpanded = $item['DISPLAY_EXPANDED'] === 'Y';

    $item['CHECKED_COUNT'] = 0;
    $lastCode = false;

    $sortedItems = resortArrayByParam($item['VALUES'], array("CHECKED" => "Y"));

    foreach ($sortedItems as $code => $value)
    {
        if ($value['VALUE'] == 'default')
        {
            unset($item['VALUES'][$code]);
            continue 2;
        }

        if (!$value['DISABLED'] && $value['VALUE'])
        {
            $isUnset = false;
        }

        $value["URL"] = $arParams['REQUESTED_PAGE'] . 'filter/' . strtolower($item["CODE"]) . "-is-" . $value["URL_ID"] /* . "/" */;

        if ($lastCode != $item["CODE"])
        {
            $arUrls[$item["CODE"] . $code] = '/' . strtolower($item["CODE"]) . "-is-" . $value["URL_ID"];
        }
        else
        {
            $arUrls[$item["CODE"] . $code] = "-or-" . $value["URL_ID"];
        }

        if ($value['CHECKED'])
        {
            $lastCode = $item["CODE"];
            $lastSelectedValue = $code;
            $isExpanded = true;
            $checkedValues[$item["CODE"] . $code] = strtolower($item["CODE"]) . "-is-" . $value["URL_ID"];
            $item['CHECKED_COUNT'] ++;
        }
    }
    $lastCode = false;

    if ($item['CHECKED_COUNT'] > 1)
    {
        $setCanonicalInFilter = false;
    }


    $item['VALUES'][$code]['DISPLAY_EXPANDED'] = $isExpanded;
    
    if ($item['CODE'] == 'obj_lot')
    {
        $item["DISPLAY_TYPE"] = "T";
    }
    
    if ($isUnset || in_array($item['CODE'], $curSection['UF_FILTER_OUT']))
    {
        unset($arResult['ITEMS'][$k]);
    }
}

$GLOBALS['filterIsEmpty'] = true;

foreach ($arResult['ITEMS'] as $k => &$item)
{
    foreach ($item['VALUES'] as $code => &$itemValue)
    {
        if ($itemValue['VALUE'])
        {
            $GLOBALS['filterIsEmpty'] = false;
            break 2;
        }
    }
}

if ($GLOBALS['filterIsEmpty'] != false)
{
    return;
}


foreach ($arResult['ITEMS'] as $k => &$item)
{
    foreach ($item['VALUES'] as $code => &$itemValue)
    {

        if ($itemValue['CHECKED'] == '1')
        {
            $GLOBALS['filterHasCheckedValues'] = true;
            break 2;
        }
    }
}

// попытка сбора адресов для ссылок
$arLogicUrls = array();
foreach ($arResult['ITEMS'] as $k => &$item)
{
    foreach ($item['VALUES'] as $code => &$itemValue)
    {
        $arLogicUrls[$item['CODE'] . $code] = $arParams['REQUESTED_PAGE'] . 'filter';
        foreach ($arUrls as $urlId => $propVal)
        {
            if (array_key_exists($urlId, $checkedValues) || $urlId == $item['CODE'] . $code)
            {
                $arLogicUrls[$item['CODE'] . $code] .= $arUrls[$urlId];
            }
        }
        $arLogicUrls[$item['CODE'] . $code] .= '/';
    }
}
$arResult["LOGIC_URLS"] = $arLogicUrls;

$arResult["HTML_TAGS"] = "";
foreach($arResult["ITEMS"] as $arItem):
	$arCur = current($arItem["VALUES"]);
	if ($arItem["VALUES"] && ($arItem["DISPLAY_TYPE"] === "F" || $arItem["DISPLAY_TYPE"] === "P")) :
		foreach($arItem["VALUES"] as $val):
			if (is_array($val) && $val["CHECKED"]) :
				$value = $val["VALUE"] === "Y" ? $arItem["NAME"] : $val["VALUE"];
				if ($arItem["DISPLAY_TYPE"] === "P"):
					$arResult["HTML_TAGS"] .= '<span class="tags__item line line_1" name="'.CUtil::JSEscape("arrFilter_".$arItem["ID"]).'" data-index="'.CUtil::JSEscape($val["CONTROL_ID"]).'" onclick="smartFilter.deleteTagItem(\''.CUtil::JSEscape($arCur["CONTROL_ID"]).'\',\''.CUtil::JSEscape($arItem["DISPLAY_TYPE"]).'\')">'.$value.'</span>';
				else:
					$arResult["HTML_TAGS"] .= '<span class="tags__item line line_1" data-index="'.CUtil::JSEscape($val["CONTROL_ID"]).'" onclick="smartFilter.deleteTagItem(\''.CUtil::JSEscape($val["CONTROL_ID"]).'\',\''.CUtil::JSEscape($arItem["DISPLAY_TYPE"]).'\')">'.$value.'</span>';
				endif;
			endif;
		endforeach;
	elseif($arItem["VALUES"] && $arItem["DISPLAY_TYPE"] === "A"):
		$value = "";
		if ($arItem["VALUES"]["MIN"]["HTML_VALUE"] > 0) :
			$value .= " ".GetMessage("CT_BCSF_FILTER_FROM")." ". $arItem["VALUES"]["MIN"]["HTML_VALUE"];
		endif;
		if ($arItem["VALUES"]["MAX"]["HTML_VALUE"] > 0) :
			$value .= " ".GetMessage("CT_BCSF_FILTER_TO")." ". $arItem["VALUES"]["MAX"]["HTML_VALUE"];
		endif;
		if ($value):
			$arResult["HTML_TAGS"] .= '<span class="tags__item line line_1" data-index="'.CUtil::JSEscape("arrFilter_".$arItem["ID"]).'" onclick="smartFilter.deleteTagItem(\''.CUtil::JSEscape("arrFilter_".$arItem["ID"]).'\',\''.CUtil::JSEscape($arItem["DISPLAY_TYPE"]).'\')">'.$arItem["NAME"].$value.'</span>';
		endif;
	endif;
endforeach;

global $sotbitFilterResult;  
$sotbitFilterResult = $arResult;

//apre($arParams);

/**
 * Пересортировка массива по заполненному значению (дописал Захваткин)
 * сохраняет исходные ключи массива
 *  
 * @param array $array - массив, который надо пересортировать
 * @param array $param - пара из ключа и значения, элементы с которыми надо поместить в начале
 * 
 * @return array - пересортированный массив
 */
function resortArrayByParam($array, $param)
{

    $sortKey = key($param);
    $sortValue = $param[$sortKey];

    $sortedArray = array();

    foreach ($array as $key => $arValue)
    {
        if (array_key_exists($sortKey, $arValue) && $arValue[$sortKey] == $sortValue)
        {
            $sortedArray[$key] = $arValue;
            unset($array[$key]);
        }
    }

    foreach ($array as $key => $arValue)
    {
        $sortedArray[$key] = $arValue;
    }

    if (count($sortedArray) > 0)
    {
        return $sortedArray;
    }
    else
    {
        return $array;
    }
}
