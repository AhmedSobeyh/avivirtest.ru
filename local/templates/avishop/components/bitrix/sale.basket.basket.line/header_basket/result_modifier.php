<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (!CModule::IncludeModule("sale")) {
    ShowError(GetMessage("SALE_MODULE_NOT_INSTALL"));
    return;
}

$cp = $this->__component; // объект компонента

if (is_object($cp)) {
    // Получаем товары в корзине
    $dbBasketItems = CSaleBasket::GetList(
        array(
            "NAME" => "ASC",
            "ID" => "ASC"
        ),
        array(
            "FUSER_ID" => CSaleBasket::GetBasketUserID(),
            "LID" => SITE_ID,
            "ORDER_ID" => "NULL"
        )
    );

    $totalAmount = $count = 0;
    while ($arItem = $dbBasketItems->GetNext()) {
        $count += $arItem["QUANTITY"];
    }

    //Кол-во товаров
    $cp->arResult['PRODUCT_COUNT'] = $count;
}
