<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

// Время кэширования
//$arParams["CACHE_TIME"] = 3600000;

$TITLE = trim($arParams["TITLE"]);
$PHOTOS = $arParams["PHOTOS"];
$PHOTOS_DESC = $arParams["PHOTOS_DESC"];
$VIDEOS = $arParams["VIDEOS"];
$VIDEOS_DESC = $arParams["VIDEOS_DESC"];
$YOUTUBE = $arParams["YOUTUBE"];
$MAIN_PHOTO = $arParams["MAIN_PHOTO"];
$WIDTH = intval($arParams["WIDTH"]);
$HEIGHT = intval($arParams["HEIGHT"]);
$NO_CLICK = boolval($arParams["NO_CLICK"]);
$arParams["AUTOPLAY"] == true ? true : false;
$arParams["NAV_BUT"] == true ? true : false;
$arParams["RESIZE_TYPE"] = $arParams["RESIZE_TYPE"] == 'EXACT' ? 'EXACT' : 'PROPORTIONAL';

// Кэшируем все данные, но перезаписываем кэш каждый час
if($this->StartResultCache())
{
	$arResult["ITEMS"] = array();
	
	// Обработка фотографий
	if( !function_exists('ResizePhoto') )
	{
		function ResizePhoto( $img_ID, $WIDTH, $HEIGHT, $DESC, $key, $type = 'EXACT')
		{
			//BX_RESIZE_IMAGE_PROPORTIONAL_ALT
			$fileBig = CFile::GetFileArray($img_ID);
			
			if ($type == 'EXACT')
				$fileMini = CFile::ResizeImageGet($img_ID, array("width" => $WIDTH, "height" => $HEIGHT), BX_RESIZE_IMAGE_EXACT, true);
			else 
				$fileMini = CFile::ResizeImageGet($img_ID, array("width" => $WIDTH, "height" => $HEIGHT), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);

			$arItem["ID"] = $img_ID;
			$arItem["BIG"] = $fileBig["SRC"];
			$arItem["MINI"]["SRC"] = $fileMini["src"];
			$arItem["MINI"]["WIDTH"] = $fileMini["width"];
			$arItem["MINI"]["HEIGHT"] = $fileMini["height"];
			$arItem["DESC"] = $DESC[ $key ];
	
			return $arItem;
		}
	}
	
	// Обработка видео
	if( !function_exists('ResizeVideo') )
	{
		function ResizeVideo( $img_ID, $WIDTH, $HEIGHT, $DESC, $key )
		{
			//BX_RESIZE_IMAGE_PROPORTIONAL_ALT
			$fileMini = CFile::ResizeImageGet($img_ID, array("width" => $WIDTH, "height" => $HEIGHT), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);
	
			$arItem["ID"] = $img_ID;
			$arItem["LINK"] = $DESC[ $key ];
			$arItem["MINI"]["SRC"] = $fileMini["src"];
			$arItem["MINI"]["WIDTH"] = $fileMini["width"];
			$arItem["MINI"]["HEIGHT"] = $fileMini["height"];
	
			return $arItem;
		}
	}
	
	/*
	//
	//
	//
	*/
	
	// YouTube
	if( count($YOUTUBE) >= 1 )
	{
		foreach( $YOUTUBE as $url )
		{
			$rx = "/^(?:https?:\/\/)?(?:www[.])?(?:youtube[.]com\/watch[?]v=|youtu[.]be\/)([^&]{11})/";
			$has_match = preg_match($rx, $url, $matches);
			
			$video["TYPE"] = "YOUTUBE";
			$video["DATA"] = $matches[1];
			
			$arParams["ITEMS"][] = $video;
		}
	}
	
	// Видео
	if( count($VIDEOS) >= 1 )
	{
		foreach($VIDEOS as $key => $item)
		{
			$itm["TYPE"] = "VIDEO";
			$itm["DATA"] = ResizeVideo( $item, $WIDTH, $HEIGHT, $VIDEOS_DESC, $key );
			
			$arParams["ITEMS"][] = $itm;
		}
	}
	
	// Главная фотография
	if( $MAIN_PHOTO )
	{
		$itm["TYPE"] = "PHOTO";
		$itm["DATA"] = ResizePhoto( $MAIN_PHOTO, $WIDTH, $HEIGHT, 0, $arParams["RESIZE_TYPE"] );
			
		$arParams["ITEMS"][] = $itm;
	}
	
	// Доп. фотографии
	if( count($PHOTOS) >= 1 )
	{
		foreach($PHOTOS as $key => $item)
		{
			$itm["TYPE"] = "PHOTO";
			$itm["DATA"] = ResizePhoto( $item, $WIDTH, $HEIGHT, $PHOTOS_DESC, $key, $arParams["RESIZE_TYPE"] );
			
			$arParams["ITEMS"][] = $itm;
		}
	}
	
	// Выводим конечные массивы
	$arResult["ITEMS"] = $arParams["ITEMS"];
	$arResult["HEIGHT"] = $arParams["HEIGHT"];
	$arResult["TITLE"] = $TITLE;
	$arResult["AUTOPLAY"] = $arParams["AUTOPLAY"];
	$arResult["NAV_BUT"] = $arParams["NAV_BUT"];
	$arResult["NO_CLICK"] = $NO_CLICK;
		
	$this->SetResultCacheKeys(array(
		"ITEMS",
		"HEIGHT",
		"TITLE",
		"AUTOPLAY",
		"NAV_BUT",
	));

	$this->IncludeComponentTemplate();
} 
?>
