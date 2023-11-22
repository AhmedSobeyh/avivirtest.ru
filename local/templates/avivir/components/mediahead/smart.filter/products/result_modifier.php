<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

\CModule::IncludeModule("mediahead.helpers");

// линейный массив с адресами каждого свойства по одному
// ключи массива - КОД_СВОЙСТВА . КОД_ЗНАЧЕНИЯ
$arUrls = array();
// линейный с ключами КОД_СВОЙСТВА . КОД_ЗНАЧЕНИЯ
$checkedValues = array();

foreach ($arResult['ITEMS'] as $k => &$item)
{
    
    if (count($item['VALUES']) < 1)
    {
        unset($arResult['ITEMS'][$k]);
        continue;
    }
    
    $isUnset = true;
    $isExpanded = $item['DISPLAY_EXPANDED'] === 'Y';

    $item['CHECKED_COUNT'] = 0;
    $lastCode = false;

    $sortedItems = resortArrayByParam($item['VALUES'], array("CHECKED" => "Y"));

    foreach ($sortedItems as $code => $value)
    {
        
        if (!$value['DISABLED'] && $value['VALUE'])
        {
            $isUnset = false;
        }
       
        if ($value['DISABLED'])
        {
            $item['VALUES'][$code]['CSS_CLASS'] = 'disabled';  
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

    if ($item['CHECKED_COUNT'] > 0)
    {
        $item['CSS_CLASS'] = 'is-active';
    }


    $item['VALUES'][$code]['DISPLAY_EXPANDED'] = $isExpanded;
    
    if ($item['CODE'] == 'PEREVOD')
    {
        $item["NAME"] = "Перевод";
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
            $arResult['filterHasCheckedValues'] = true;
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


$arResult["SORT"] = $arParams["SORT"];
$arResult["FORM_ACTION"] = explode('?', $arResult["FORM_ACTION"])[0]; 


//apre($arParams);
foreach ($arResult['ITEMS'] as &$item)
{
    \Mediahead\Helpers\Tools::obtainDirectoryProp($item); 
    if (count($item['HL_DATA']) > 0)
    {
        foreach($item['HL_DATA'] as $key => $value)
        {
            $item['VALUES'][$key]['VALUE'] = $value['NAME'];
        }
    }       
}



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


