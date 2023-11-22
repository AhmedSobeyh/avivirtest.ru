<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Page\AssetLocation;
use Bitrix\Main\Page\Asset;

Asset::getInstance()->addString('<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js" integrity="sha384-FzT3vTVGXqf7wRfy8k4BiyzvbNfeYjK+frTVqZeNDFl8woCbF0CYG6g2fMEFFo/i" crossorigin="anonymous"></script>', false, AssetLocation::AFTER_JS);

// Обрабатываем AJAX-запрос
if ($_SERVER["HTTP_X_REQUESTED_WITH"] == "XMLHttpRequest" && $arParams["AJAX_CALL"] != "Y" && $_REQUEST["subscribe"] == "Y")
{
	// Сбрасываем буффер, чтобы убрать всё, что до этого формировал битрикс на запрос страницы
	$APPLICATION->RestartBuffer();
	
	// Добавляем параметры для обработки компонентом
	$arParams["AJAX_CALL"] = "Y";
	$arParams["POST"] = $_POST;
		
	// И вызываем текущий компонент с новыми параметрами
	$APPLICATION->IncludeComponent("mediahead:subscribe", "", $arParams, false); 
	
	// Это важно, т.к. иначе вместе с компонентом подгрузится футер
	exit();
}
?>