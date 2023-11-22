<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */

$width = 480;
$height = 480;

foreach($arResult["ITEMS"] as &$item) {
	// Если используется детальное изображение
	if( is_array($item["DETAIL_PICTURE"]) )
	{
		$file = CFile::ResizeImageGet($item["DETAIL_PICTURE"], array("width" => $width, "height" => $height), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false);
		$item["DETAIL_PICTURE"]["SRC"] = $file["src"];
	}
}