<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */

//apre($arResult); 


// use Bitrix\Highloadblock\HighloadBlockTable as HLBT;

// CModule::IncludeModule('highloadblock');


// $highblock_ids = [8, 1, 4];

// foreach ($highblock_ids as $highblock_id) {
// 	$hl_block = HLBT::getById($highblock_id)->fetch();

// 	// Получение имени класса
// 	$entity = HLBT::compileEntity($hl_block);
// 	$entity_data_class = $entity->getDataClass();

// 	// Вывод элементов Highload-блока
// 	$rs_data = $entity_data_class::getList(array(
// 		'select' => array('*')
// 	));
// 	while ($el = $rs_data->fetch()) {
// 		$arResult["FILTER_VALUES"][$hl_block["NAME"]][] = $el['UF_NAME']; // имя
// 	}
// }

// $highblock_id = 8;

// $hl_block = HLBT::getById($highblock_id)->fetch();

// // Получение имени класса
// $entity = HLBT::compileEntity($hl_block);
// $entity_data_class = $entity->getDataClass();

// // Вывод элементов Highload-блока
// $rs_data = $entity_data_class::getList(array(
// 	'select' => array('*')
// ));
// while ($el = $rs_data->fetch()) {
// 	$arResult["FILTER_VALUES"]["INFECTION"][] = $el['UF_NAME']; // имя
// }


$arResult["NAV_STRING"] = $arResult["NAV_RESULT"]->GetPageNavStringEx(
	$navComponentObject,
	$arParams["PAGER_TITLE"],
	$arParams["PAGER_TEMPLATE"],
	$arParams["PAGER_SHOW_ALWAYS"],
	$this->__component,
	$arResult["NAV_PARAM"]
);
