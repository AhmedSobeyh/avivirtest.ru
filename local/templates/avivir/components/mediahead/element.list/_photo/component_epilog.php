<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */

use Bitrix\Main\Page\AssetLocation;
use Bitrix\Main\Page\Asset;

$assets = Asset::getInstance();

// PhotoSwipe core CSS file
$assets->addCss(SITE_TEMPLATE_PATH.'/vendors/photoswipe/dist/photoswipe.css', false, AssetLocation::BEFORE_CSS);

// PhotoSwipe skin CSS file (styling of UI - buttons, caption, etc.)
$assets->addCss(SITE_TEMPLATE_PATH.'/vendors/photoswipe/dist/default-skin/default-skin.css', false, AssetLocation::BEFORE_CSS);

// PhotoSwipe Core JS file
$assets->addJs(SITE_TEMPLATE_PATH.'/vendors/photoswipe/dist/photoswipe.min.js', false, AssetLocation::AFTER_JS);

// PhotoSwipe UI JS file
$assets->addJs(SITE_TEMPLATE_PATH.'/vendors/photoswipe/dist/photoswipe-ui-default.min.js', false, AssetLocation::AFTER_JS);
