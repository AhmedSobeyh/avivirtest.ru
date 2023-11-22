<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

//Получаем фотографии и файлы

if ($arResult["PROPERTIES"]["PRODUCT_GALLERY"]["VALUE"] != '') {
    foreach ($arResult["PROPERTIES"]["PRODUCT_GALLERY"]["VALUE"] as $PHOTO) {
        $file = CFile::GetFileArray($PHOTO);
        $arResult["PRODUCT_GALLERY"][] = $file;
    }
}

if ($arResult["PROPERTIES"]["PRODUCT_INFORMATION"]["VALUE"] != '') {
    $file = CFile::GetFileArray($arResult["PROPERTIES"]["PRODUCT_INFORMATION"]["VALUE"]);
    $arResult["PRODUCT_INFORMATION"][] = $file;
}

if ($arResult["PROPERTIES"]["PRODUCT_DOCUMENTS"]["VALUE"] != '') {
    foreach ($arResult["PROPERTIES"]["PRODUCT_DOCUMENTS"]["VALUE"] as $DOCUMENT) {
        $file = CFile::GetFileArray($DOCUMENT);
        $arResult["PRODUCT_DOCUMENTS"][] = $file;
    }
}
