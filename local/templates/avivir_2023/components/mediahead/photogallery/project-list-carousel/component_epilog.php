<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Page\Asset;
Asset::getInstance()->addCss('https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css');
Asset::getInstance()->addJs('https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js');
Asset::getInstance()->addJs('https://cdnjs.cloudflare.com/ajax/libs/jcarousel/0.3.8/jquery.jcarousel.min.js');
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/js/jquery.jcarousel-swipe.min.js');
//Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/js/jquery.touchSwipe.min.js');
//Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/js/scrollspy.js');
?>