<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

//delayed function must return a string
if (empty($arResult))
	return "";

$strReturn = '';

//we can't use $APPLICATION->SetAdditionalCSS() here because we are inside the buffered function GetNavChain()

$strReturn .= '<div class="hidden-Hidden-module-desktop-hidden">';
$strReturn .= '<div class="product-Product-module-path">';

$itemSize = count($arResult);
for ($index = 0; $index < $itemSize; $index++) {
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);

	if (($index + 1) == $itemSize) {
		$strReturn .= '<span>' . $title . '</span>';
	} else {
		$strReturn .= '<span>' . $title . '</span>—';
	}
}

$strReturn .= '</div>';
$strReturn .= '</div>';

return $strReturn;
