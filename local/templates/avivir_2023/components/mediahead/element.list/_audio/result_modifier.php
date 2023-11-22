<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */


//apre($arResult['ITEMS'],'audioItems'); 
foreach($arResult["ITEMS"] as &$item)
{
	if ($item['DISPLAY_PROPERTIES']['AUDIO']['FILE_VALUE'])
	{
		$arResult['AUDIO'][] = [
			'ID' => $item['ID'],
			'NAME' => $item['NAME'],
			'SRC' => $item['DISPLAY_PROPERTIES']['AUDIO']['FILE_VALUE']['SRC'],
			'FILE' => $item['DISPLAY_PROPERTIES']['AUDIO']['FILE_VALUE'],
			'CODE' => $item['CODE']
		];
	}	
}

unset($arResult['ITEMS']); 

$section = array_reverse($arResult['SECTION']['PATH']);
$arResult["HEAD"] = [
	"NAME" => $section[0]["NAME"],
	"IMAGE" => CFile::ResizeImageGet($section[0]["PICTURE"], ["width" => 262, "height" => 262], BX_RESIZE_IMAGE_EXACT, true),
	"TEXT" =>  $section[0]["DESCRIPTION"], 
];

//apre($arResult);

$arResult["NAV_STRING"] = $arResult["NAV_RESULT"]->GetPageNavStringEx(
	$navComponentObject,
	$arParams["PAGER_TITLE"],
	$arParams["PAGER_TEMPLATE"],
	$arParams["PAGER_SHOW_ALWAYS"],
	$this->__component,
	$arResult["NAV_PARAM"]
);
