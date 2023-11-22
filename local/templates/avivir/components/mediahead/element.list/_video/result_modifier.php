<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */


foreach($arResult["ITEMS"] as &$item)
{
	if ($item['DISPLAY_PROPERTIES']['VIDEO_LINK']['VALUE'])
	{
		$arResult['VIDEO'][] = [
			'ID' => $item['ID'],
			'NAME' => $item['NAME'],
			'SRC' => $item['DISPLAY_PROPERTIES']['VIDEO_LINK']['VALUE'],
			'EDIT_LINK' => $item['EDIT_LINK'],
			'DELETE_LINK' => $item['DELETE_LINK'], 
			'POSTER' =>  $item['PREVIEW_PICTURE']['SRC'],
			'CODE' =>  $item['CODE'], 
		];
	}	
}

//unset($arResult['ITEMS']); 

$arResult["NAV_STRING"] = $arResult["NAV_RESULT"]->GetPageNavStringEx(
	$navComponentObject,
	$arParams["PAGER_TITLE"],
	$arParams["PAGER_TEMPLATE"],
	$arParams["PAGER_SHOW_ALWAYS"],
	$this->__component,
	$arResult["NAV_PARAM"]
);
