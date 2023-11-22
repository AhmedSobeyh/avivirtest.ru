<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */

if (!empty($arResult["DETAIL_PICTURE"])) 
{
	$arResult["DETAIL_PICTURE"] = \CFile::ResizeImageGet($arResult["DETAIL_PICTURE"],["width" => 260, "height" => 260], BX_RESIZE_IMAGE_EXACT,true);
	$arResult["DETAIL_PICTURE"]["SRC"] = $arResult["DETAIL_PICTURE"]["src"]; 
}

$arIblockIds = ["2","3","5","8"]; 
foreach($arIblockIds as $iblockId)
{
	$rs = CIBlockElement::GetList([],["PROPERTY_PERSONA" => $arResult["ID"], "IBLOCK_ID" =>  $iblockId],false,false,["ID","NAME","IBLOCK_ID","IBLOCK_NAME","DETAIL_PICTURE","PROPERTY_AUDIO","PROPERTY_VIDEO_LINK"]);
	while($item = $rs->GetNext())
	{
		if (!empty($item["PROPERTY_AUDIO_VALUE"]))
		{
			$arResult['FILTER_AUDIO'][] = $item["ID"];
		}
		elseif (!empty($item["PROPERTY_VIDEO_LINK_VALUE"]))
		{
			$arResult['FILTER_VIDEO'][] = $item["ID"];
		}
		elseif (!empty($item["DETAIL_PICTURE"]) && $item["IBLOCK_ID"] == 3)
		{
			$arResult['FILTER_PHOTO'][] = $item["ID"];
		}
		
		// Литература о поэте
		elseif ($item["IBLOCK_ID"] == 5)
		{
			$arResult['FILTER_ABOUT'][] = $item["ID"];
		}

		// Прямая речь
		elseif ($item["IBLOCK_ID"] == 2)
		{
			$arResult['FILTER_LIT'][] = $item["ID"];
		}

		// События
		elseif ($item["IBLOCK_ID"] == 8)
		{
			$arResult['FILTER_EVENT'][] = $item["ID"];
		}

		$arResult['SEARCH'][$item["IBLOCK_ID"]][] = $item;  
		
	} 
}

$this->__component->arResultCacheKeys = array_merge($this->__component->arResultCacheKeys, 
	array(
		'FILTER_AUDIO','FILTER_VIDEO','FILTER_PHOTO','FILTER_EVENT','FILTER_LIT','FILTER_ABOUT'
	)
);

apre($arResult);  
