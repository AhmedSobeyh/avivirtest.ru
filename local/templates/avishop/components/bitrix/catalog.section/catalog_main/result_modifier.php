<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

//Получаем названия разделов для js фильтра
$arFilter = array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'GLOBAL_ACTIVE' => 'Y');
$db_list = CIBlockSection::GetList(array($by => $order), $arFilter, true);

while ($ar_result = $db_list->GetNext()) {
    $arResult['SECTION_NAMES'][] = $ar_result['NAME'];
}
