<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

//You may customize user card fields to display
$arResult['USER_PROPERTY'] = array(
	"UF_DEPARTMENT",
);

//Code below searches for appropriate icon for search index item.
//All filenames should be lowercase.

//1
//Check if index item is information block element with property DOC_TYPE set.
//This property should be type list and we'll take it's values XML_ID as parameter
//iblock_doc_type_<xml_id>.png

//2
//When no such fle found we'll check for section attributes
//iblock_section_<code>.png
//iblock_section_<id>.png
//iblock_section_<xml_id>.png

//3
//Next we'll try to detect icon by "extention".
//where extension is all a-z between dot and end of title
//iblock_type_<iblock type id>_<extension>.png

//4
//If we still failed. Try to match information block attributes.
//iblock_iblock_<code>.png
//iblock_iblock_<id>.png
//iblock_iblock_<xml_id>.png

//5
//If indexed item is section when checkj for
//iblock_section.png
//If it is an element when chek for
//iblock_element.png

//6
//If item belongs to main module (static file)
//when check is done by it's extention
//main_<extention>.png

//7
//For blog module we'll check if icon for post or user exists
//blog_post.png
//blog_user.png

//8, 9 and 10
//forum_message.png
//intranet_user.png
//socialnetwork_group.png

//11
//In case we still failed to find an icon
//<module_id>_default.png

//12
//default.png

$arIBlocks = array();

$image_path = $this->GetFolder()."/images/";
$abs_path = $_SERVER["DOCUMENT_ROOT"].$image_path;

$arResult["SEARCH"] = array();

foreach($arResult["CATEGORIES"] as $category_id => &$arCategory)
{
	
	if ($arCategory["TITLE"] == "PERSON")
	{
		// Сбор данных для поиска контента по связям с персонами
		foreach($arCategory["ITEMS"] as $i => $arItem)
		{
			$personIds[] = $arItem['ITEM_ID'];
		}	
		$arCategory["TYPE"] = "PERSON";
		unset($arCategory["TITLE"]);
		$personCategory = $arCategory;
		unset($arResult["CATEGORIES"][$category_id]);		
	}

	foreach($arCategory["ITEMS"] as $i => &$arItem)
	{
		
		if(isset($arItem["ITEM_ID"]))
			$arResult["SEARCH"][] = &$arResult["CATEGORIES"][$category_id]["ITEMS"][$i];

		if (strpos($arItem["URL"], 'audio') !== false) 
		{
			$arAudio['ITEMS'][] = $arItem;  
			unset($arCategory["ITEMS"][$i]);
		}

		if (strpos($arItem["URL"], 'video') !== false) 
		{
			$arVideo['ITEMS'][] = $arItem;  
			unset($arCategory["ITEMS"][$i]);
		}

		if (strpos($arItem["URL"], 'foto') !== false) 
		{
			$arPhoto['ITEMS'][] = $arItem;  
			unset($arCategory["ITEMS"][$i]);
		}
	}
}

if ($arVideo) 
{
	$arVideo['TITLE'] = "Видео";
	array_unshift($arResult["CATEGORIES"], $arVideo);
}

if ($arAudio) 
{
	$arAudio['TITLE'] = "Аудиозаписи";
	array_unshift($arResult["CATEGORIES"], $arAudio);
}

if ($arPhoto) 
{
	$arPhoto['TITLE'] = "Фотографии";
	array_unshift($arResult["CATEGORIES"], $arPhoto); 
}

if ($personCategory && $personIds)
{
	
	$rs = CIBlockElement::GetList([],["ID" => $personIds],false,false,["ID","NAME","PREVIEW_TEXT","DETAIL_PICTURE","IBLOCK_ID"]);
	while($item = $rs->GetNext())
	{
		if ($item["DETAIL_PICTURE"])
		{
			$image = CFile::ResizeImageGet($item["DETAIL_PICTURE"], ["width" => 50, "height" => 50], BX_RESIZE_IMAGE_EXACT, false);
		}
		
		$persons[$item["ID"]] = [
			"NAME" => $item["PREVIEW_TEXT"],
			"ICON" => $image["src"],
		];
	}
	
	foreach($personCategory["ITEMS"] as &$person)
	{
		if (array_key_exists($person["ITEM_ID"], $persons))
		{
			$person["NAME"] = $persons[$person["ITEM_ID"]]["NAME"];
			$person["ICON"] = $persons[$person["ITEM_ID"]]["ICON"];
		}
	}

	array_unshift($arResult["CATEGORIES"], $personCategory); 

}

foreach($arResult["CATEGORIES"] as $i => &$category)
{
	if ($category["TITLE"] == "Медиатека" && count($category["ITEMS"]) < 2)
		unset($arResult["CATEGORIES"][$i]);
}
	 
//apre($arResult["CATEGORIES"], '$Categories'); 

?>