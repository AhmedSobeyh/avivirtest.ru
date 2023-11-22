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

$strReturn .= '<ul class="breadcrumbs-Breadcrumbs-module-list breadcrumbs-Breadcrumbs-module-avishop">';

$itemSize = count($arResult);
for ($index = 0; $index < $itemSize; $index++) {
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	$p = explode('/', $arResult[$index]["LINK"]);

	$strReturn .= '<li class="breadcrumbs-Breadcrumbs-module-item"><a href="' . $arResult[$index]["LINK"] . '">' . $title . '</a></li>';
}

$strReturn .= '</ul>';

return $strReturn;
