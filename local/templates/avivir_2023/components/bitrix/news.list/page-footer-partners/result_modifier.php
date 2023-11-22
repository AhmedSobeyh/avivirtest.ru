<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$width = 480;
$height = 480;

if( count($arResult["ITEMS"]) >= 1 )
{
	foreach($arResult["ITEMS"] as &$arItem)
	{
		// Если используется детальное изображение
		if( is_array($arItem["DETAIL_PICTURE"]) )
		{
			$file = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"], array("width" => $width, "height" => $height), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false);
			$arItem["DETAIL_PICTURE"]["SRC"] = $file["src"];
		}
	}
}
?>
