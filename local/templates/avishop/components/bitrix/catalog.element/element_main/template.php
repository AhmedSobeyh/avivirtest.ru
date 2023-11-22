<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

$this->setFrameMode(true);

$templateLibrary = array('popup', 'fx');
$currencyList = '';

if (!empty($arResult['CURRENCIES'])) {
	$templateLibrary[] = 'currency';
	$currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}

$templateData = array(
	'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
	'TEMPLATE_LIBRARY' => $templateLibrary,
	'CURRENCIES' => $currencyList,
	'ITEM' => array(
		'ID' => $arResult['ID'],
		'IBLOCK_ID' => $arResult['IBLOCK_ID'],
		'OFFERS_SELECTED' => $arResult['OFFERS_SELECTED'],
		'JS_OFFERS' => $arResult['JS_OFFERS']
	)
);
unset($currencyList, $templateLibrary);

$mainId = $this->GetEditAreaId($arResult['ID']);
$itemIds = array(
	'ID' => $mainId,
	'DISCOUNT_PERCENT_ID' => $mainId . '_dsc_pict',
	'STICKER_ID' => $mainId . '_sticker',
	'BIG_SLIDER_ID' => $mainId . '_big_slider',
	'BIG_IMG_CONT_ID' => $mainId . '_bigimg_cont',
	'SLIDER_CONT_ID' => $mainId . '_slider_cont',
	'OLD_PRICE_ID' => $mainId . '_old_price',
	'PRICE_ID' => $mainId . '_price',
	'DISCOUNT_PRICE_ID' => $mainId . '_price_discount',
	'PRICE_TOTAL' => $mainId . '_price_total',
	'SLIDER_CONT_OF_ID' => $mainId . '_slider_cont_',
	'QUANTITY_ID' => $mainId . '_quantity',
	'QUANTITY_DOWN_ID' => $mainId . '_quant_down',
	'QUANTITY_UP_ID' => $mainId . '_quant_up',
	'QUANTITY_MEASURE' => $mainId . '_quant_measure',
	'QUANTITY_LIMIT' => $mainId . '_quant_limit',
	'BUY_LINK' => $mainId . '_buy_link',
	'ADD_BASKET_LINK' => $mainId . '_add_basket_link',
	'BASKET_ACTIONS_ID' => $mainId . '_basket_actions',
	'NOT_AVAILABLE_MESS' => $mainId . '_not_avail',
	'COMPARE_LINK' => $mainId . '_compare_link',
	'TREE_ID' => $mainId . '_skudiv',
	'DISPLAY_PROP_DIV' => $mainId . '_sku_prop',
	'DESCRIPTION_ID' => $mainId . '_description',
	'DISPLAY_MAIN_PROP_DIV' => $mainId . '_main_sku_prop',
	'OFFER_GROUP' => $mainId . '_set_group_',
	'BASKET_PROP_DIV' => $mainId . '_basket_prop',
	'SUBSCRIBE_LINK' => $mainId . '_subscribe',
	'TABS_ID' => $mainId . '_tabs',
	'TAB_CONTAINERS_ID' => $mainId . '_tab_containers',
	'SMALL_CARD_PANEL_ID' => $mainId . '_small_card_panel',
	'TABS_PANEL_ID' => $mainId . '_tabs_panel'
);
$obName = $templateData['JS_OBJ'] = 'ob' . preg_replace('/[^a-zA-Z0-9_]/', 'x', $mainId);
$name = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
	: $arResult['NAME'];
$title = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE']
	: $arResult['NAME'];
$alt = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT']
	: $arResult['NAME'];

$haveOffers = !empty($arResult['OFFERS']);
if ($haveOffers) {
	$actualItem = $arResult['OFFERS'][$arResult['OFFERS_SELECTED']] ?? reset($arResult['OFFERS']);
	$showSliderControls = false;

	foreach ($arResult['OFFERS'] as $offer) {
		if ($offer['MORE_PHOTO_COUNT'] > 1) {
			$showSliderControls = true;
			break;
		}
	}
} else {
	$actualItem = $arResult;
	$showSliderControls = $arResult['MORE_PHOTO_COUNT'] > 1;
}

$skuProps = array();
$price = $actualItem['ITEM_PRICES'][$actualItem['ITEM_PRICE_SELECTED']];
$measureRatio = $actualItem['ITEM_MEASURE_RATIOS'][$actualItem['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'];
$showDiscount = $price['PERCENT'] > 0;

if ($arParams['SHOW_SKU_DESCRIPTION'] === 'Y') {
	$skuDescription = false;
	foreach ($arResult['OFFERS'] as $offer) {
		if ($offer['DETAIL_TEXT'] != '' || $offer['PREVIEW_TEXT'] != '') {
			$skuDescription = true;
			break;
		}
	}
	$showDescription = $skuDescription || !empty($arResult['PREVIEW_TEXT']) || !empty($arResult['DETAIL_TEXT']);
} else {
	$showDescription = !empty($arResult['PREVIEW_TEXT']) || !empty($arResult['DETAIL_TEXT']);
}
$showBuyBtn = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION']);
$buyButtonClassName = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-primary' : 'btn-link';
$showAddBtn = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION']);
$showButtonClassName = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-primary' : 'btn-link';
$showSubscribe = $arParams['PRODUCT_SUBSCRIPTION'] === 'Y' && ($arResult['PRODUCT']['SUBSCRIBE'] === 'Y' || $haveOffers);

$arParams['MESS_BTN_BUY'] = $arParams['MESS_BTN_BUY'] ?: Loc::getMessage('CT_BCE_CATALOG_BUY');
$arParams['MESS_BTN_ADD_TO_BASKET'] = $arParams['MESS_BTN_ADD_TO_BASKET'] ?: Loc::getMessage('CT_BCE_CATALOG_ADD');
$arParams['MESS_NOT_AVAILABLE'] = $arParams['MESS_NOT_AVAILABLE'] ?: Loc::getMessage('CT_BCE_CATALOG_NOT_AVAILABLE');
$arParams['MESS_BTN_COMPARE'] = $arParams['MESS_BTN_COMPARE'] ?: Loc::getMessage('CT_BCE_CATALOG_COMPARE');
$arParams['MESS_PRICE_RANGES_TITLE'] = $arParams['MESS_PRICE_RANGES_TITLE'] ?: Loc::getMessage('CT_BCE_CATALOG_PRICE_RANGES_TITLE');
$arParams['MESS_DESCRIPTION_TAB'] = $arParams['MESS_DESCRIPTION_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_DESCRIPTION_TAB');
$arParams['MESS_PROPERTIES_TAB'] = $arParams['MESS_PROPERTIES_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_PROPERTIES_TAB');
$arParams['MESS_COMMENTS_TAB'] = $arParams['MESS_COMMENTS_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_COMMENTS_TAB');
$arParams['MESS_SHOW_MAX_QUANTITY'] = $arParams['MESS_SHOW_MAX_QUANTITY'] ?: Loc::getMessage('CT_BCE_CATALOG_SHOW_MAX_QUANTITY');
$arParams['MESS_RELATIVE_QUANTITY_MANY'] = $arParams['MESS_RELATIVE_QUANTITY_MANY'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_MANY');
$arParams['MESS_RELATIVE_QUANTITY_FEW'] = $arParams['MESS_RELATIVE_QUANTITY_FEW'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_FEW');

?>

<main class="page-Page-module-content">
	<div class="content-block-ContentBlock-module-block product-Product-module-preview">
		<div class="content-block-ContentBlock-module-info" id="<?= $itemIds['ID'] ?>" itemscope itemtype="http://schema.org/Product">
			<? $APPLICATION->IncludeComponent(
				"bitrix:breadcrumb",
				"breadcrumb",
				array(
					"COMPONENT_TEMPLATE" => "breadcrumb",
					"START_FROM" => "0",
					"PATH" => "",
					"SITE_ID" => ""
				),
				false
			); ?>
			<h2 class="content-block-ContentBlock-module-title content-block-ContentBlock-module-title-big">
				<?= $name ?>
			</h2>
			<div class="content-block-ContentBlock-module-content product-Product-module-wrapper content-block-ContentBlock-module-last">
				<? $APPLICATION->IncludeComponent(
					"bitrix:breadcrumb",
					"breadcrumb_mobile",
					array(
						"COMPONENT_TEMPLATE" => "breadcrumb",
						"START_FROM" => "0",
						"PATH" => "",
						"SITE_ID" => ""
					),
					false
				); ?>
				<div class="product-Product-module-sliders" id="<?= $itemIds['BIG_SLIDER_ID'] ?>">
					<div class="swiper product-Product-module-swiper" data-entity="images-slider-block">
						<div class="swiper-wrapper" data-entity="images-container">
							<?
							if (!empty($actualItem['MORE_PHOTO'])) {
								foreach ($actualItem['MORE_PHOTO'] as $key => $photo) {
							?>
									<div class="swiper-slide product-Product-module-slide" data-entity="image" data-id="<?= $photo['ID'] ?>">
										<img class="product-Product-module-image" src="<?= $arResult['DETAIL_PICTURE']['SRC'] ?>" alt="<?= $alt ?>" title="<?= $title ?>" />
									</div>
							<?
								}
							} ?>

							<? if (array_key_exists('PRODUCT_GALLERY', $arResult)) : ?>
								<? foreach ($arResult['PRODUCT_GALLERY'] as $picture) : ?>
									<div class="swiper-slide product-Product-module-slide">
										<img class="product-Product-module-image" src="<?= $picture['SRC'] ?>" />
									</div>
								<? endforeach ?>
							<? endif ?>

						</div>
						<div class="swiper-pagination"></div>
					</div>
					<div class="thumb product-Product-module-thumb">
						<div class="swiper-wrapper">
							<div class="swiper-slide product-Product-module-slide">
								<img src="<?= $arResult['DETAIL_PICTURE']['SRC'] ?>" />
							</div>

							<? if (array_key_exists('PRODUCT_GALLERY', $arResult)) : ?>
								<? foreach ($arResult['PRODUCT_GALLERY'] as $picture) : ?>
									<div class="swiper-slide product-Product-module-slide">
										<img src="<?= $picture['SRC'] ?>" />
									</div>
								<? endforeach ?>
							<? endif ?>
						</div>
					</div>
					<div class="product-Product-module-buttons">
						<button class="swiper-button-prev product-Product-module-button">
							<svg width="6" height="15" viewBox="0 0 6 15" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M4.98974 14.9155C5.1871 14.9155 5.38001 14.829 5.54409 14.667C5.70817 14.5051 5.83605 14.2749 5.91157 14.0056C5.98709 13.7363 6.00685 13.44 5.96836 13.1541C5.92987 12.8683 5.83485 12.6057 5.69532 12.3995L2.40894 7.54592L5.69532 2.6923C5.79064 2.55633 5.86667 2.39369 5.91898 2.21387C5.97128 2.03405 5.99881 1.84064 5.99996 1.64493C6.00111 1.44923 5.97586 1.25514 5.92568 1.074C5.8755 0.892861 5.8014 0.728295 5.7077 0.589904C5.61399 0.451514 5.50256 0.342071 5.37991 0.267961C5.25726 0.193851 5.12585 0.156558 4.99334 0.158259C4.86082 0.159959 4.72987 0.200619 4.60811 0.277866C4.48635 0.355113 4.37623 0.4674 4.28416 0.608174L0.292198 6.50386C0.105104 6.78026 0 7.15509 0 7.54592C0 7.93675 0.105104 8.31158 0.292198 8.58798L4.28416 14.4837C4.47128 14.7601 4.72508 14.9154 4.98974 14.9155Z" fill="#94BBAB"></path>
							</svg></button><button class="swiper-button-next product-Product-module-button product-Product-module-button-next">
							<svg width="6" height="15" viewBox="0 0 6 15" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M4.98974 14.9155C5.1871 14.9155 5.38001 14.829 5.54409 14.667C5.70817 14.5051 5.83605 14.2749 5.91157 14.0056C5.98709 13.7363 6.00685 13.44 5.96836 13.1541C5.92987 12.8683 5.83485 12.6057 5.69532 12.3995L2.40894 7.54592L5.69532 2.6923C5.79064 2.55633 5.86667 2.39369 5.91898 2.21387C5.97128 2.03405 5.99881 1.84064 5.99996 1.64493C6.00111 1.44923 5.97586 1.25514 5.92568 1.074C5.8755 0.892861 5.8014 0.728295 5.7077 0.589904C5.61399 0.451514 5.50256 0.342071 5.37991 0.267961C5.25726 0.193851 5.12585 0.156558 4.99334 0.158259C4.86082 0.159959 4.72987 0.200619 4.60811 0.277866C4.48635 0.355113 4.37623 0.4674 4.28416 0.608174L0.292198 6.50386C0.105104 6.78026 0 7.15509 0 7.54592C0 7.93675 0.105104 8.31158 0.292198 8.58798L4.28416 14.4837C4.47128 14.7601 4.72508 14.9154 4.98974 14.9155Z" fill="#94BBAB"></path>
							</svg>
						</button>
					</div>
				</div>
				<div class="product-Product-module-info">
					<p class="product-Product-module-text">
						<?= $arResult['DETAIL_TEXT'] ?>
					</p>
					<p hidden id="<?= $itemIds['PRICE_ID'] ?>"><?= $price['PRINT_RATIO_PRICE'] ?></p>
					<p class="product-Product-module-price"><?= $price['RATIO_PRICE'] . " р/шт" ?></p>
					<div class="product-Product-module-buy">
						<div class="product-Counter-module-panel">
							<span class="product-Counter-module-panel-elem" id="<?= $itemIds['QUANTITY_DOWN_ID'] ?>">-</span>
							<input class="product-Counter-module-panel-elem" id="<?= $itemIds['QUANTITY_ID'] ?>" type="number" value="<?= $price['MIN_QUANTITY'] ?>">
							<span class="product-Counter-module-panel-elem" id="<?= $itemIds['QUANTITY_UP_ID'] ?>">+</span>
						</div>

						<div id="<?= $itemIds['BASKET_ACTIONS_ID'] ?>">
							<a class="button-Button-module-button product-Product-module-button" id="<?= $itemIds['ADD_BASKET_LINK'] ?>" href="javascript:void(0);">
								Купить
							</a>
						</div>

					</div>
					<div class="product-Product-module-tags">
						<? if ($arResult['PROPERTIES']['PRODUCT_SAMPLE']['VALUE'] != '') : ?>
							<div class="product-Product-module-tag">
								<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
									<circle cx="4.63196" cy="4.63196" r="4.25455" stroke="#5A808C" stroke-width="0.754839" stroke-linecap="round" stroke-linejoin="round"></circle>
									<path d="M7.71973 7.71973L9.17296 9.13849M9.17296 9.13849L8.31463 9.97097L9.07759 10.7109M9.17296 9.13849L9.93591 8.39851L10.6989 9.13849M9.07759 10.7109L11.7479 13.3009C12.0022 13.5167 12.6444 13.8189 13.1785 13.3009C13.8651 12.6349 13.5599 11.9134 13.1785 11.5434L10.6989 9.13849M9.07759 10.7109L10.6989 9.13849" stroke="#5A808C" stroke-width="0.754839" stroke-linecap="round" stroke-linejoin="round"></path>
									<circle cx="4.63188" cy="4.63188" r="1.35528" stroke="#69BA94" stroke-width="0.377419"></circle>
									<circle cx="3.39669" cy="2.16134" r="0.18871" stroke="#69BA94" stroke-width="0.240176"></circle>
									<circle cx="7.10225" cy="4.01436" r="0.18871" stroke="#69BA94" stroke-width="0.240176"></circle>
									<circle cx="5.24923" cy="2.77901" r="0.18871" stroke="#69BA94" stroke-width="0.240176"></circle>
									<circle cx="6.48458" cy="5.24923" r="0.18871" stroke="#69BA94" stroke-width="0.240176"></circle>
									<circle cx="3.39669" cy="6.48458" r="0.18871" stroke="#69BA94" stroke-width="0.240176"></circle>
									<circle cx="2.77901" cy="3.39669" r="0.18871" stroke="#69BA94" stroke-width="0.240176"></circle>
									<path d="M2.16113 5.2496L3.2119 5.09823M3.39632 6.48479L4.01392 5.86719M5.33556 5.86114L5.43438 6.28498M5.94006 5.09823L6.48429 5.2496M5.94006 4.38541L7.10188 4.01441M5.11063 3.23333L5.2491 2.77922M4.01392 3.39681L3.39631 2.16162M3.39632 4.01441L2.77873 3.39681" stroke="#69BA94" stroke-width="0.377419"></path>
									<circle cx="5.55802" cy="6.79338" r="0.428886" stroke="#69BA94" stroke-width="0.377419"></circle>
									<circle cx="2.16134" cy="5.24923" r="0.18871" stroke="#69BA94" stroke-width="0.240176"></circle>
								</svg><?= $arResult['PROPERTIES']['PRODUCT_SAMPLE']['VALUE'] ?>
							</div>
						<? endif ?>

						<? if ($arResult['PROPERTIES']['PRODUCT_MARKER']['VALUE'] != '') : ?>
							<div class="product-Product-module-tag">
								<svg width="14" height="11" viewBox="0 0 14 11" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M5.5293 4.52881L9.30349 4.90623" stroke="#62C393" stroke-width="0.754839" stroke-linecap="round" stroke-linejoin="round"></path>
									<path d="M10.0581 8.26878C10.0581 7.58256 11.0646 6.35309 11.5678 6.03857C12.071 6.29591 13.0775 7.66834 13.0775 8.26878C13.0775 9.43535 12.367 9.81277 11.5678 9.81277C10.8573 9.81277 10.0581 9.29811 10.0581 8.26878Z" stroke="#62C393" stroke-width="0.754839" stroke-linecap="round" stroke-linejoin="round"></path>
									<path d="M1.15651 8.39963L7.54323 2.39892L8.06817 0.754883L11.5677 4.04295L9.90544 4.45396L3.60621 10.3725C3.19792 10.5643 2.20638 10.7835 1.50646 10.1259C0.806548 9.46826 0.981527 8.70104 1.15651 8.39963Z" stroke="#5A808C" stroke-width="0.754839" stroke-linecap="round" stroke-linejoin="round"></path>
								</svg><?= $arResult['PROPERTIES']['PRODUCT_MARKER']['VALUE'] ?>
							</div>
						<? endif ?>

						<? if ($arResult['PROPERTIES']['PRODUCT_INFECTION']['VALUE'] != '') : ?>
							<div class="product-Product-module-tag">
								<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
									<circle cx="6.00033" cy="6.00033" r="3.14463" stroke="#69BA94" stroke-width="0.377419"></circle>
									<circle cx="3.33366" cy="0.666668" r="0.477959" stroke="#69BA94" stroke-width="0.377419"></circle>
									<circle cx="11.3332" cy="4.66716" r="0.477959" stroke="#69BA94" stroke-width="0.377419"></circle>
									<circle cx="7.33317" cy="2.00016" r="0.477959" stroke="#69BA94" stroke-width="0.377419"></circle>
									<circle cx="9.99968" cy="7.33317" r="0.477959" stroke="#69BA94" stroke-width="0.377419"></circle>
									<circle cx="3.33366" cy="9.99968" r="0.477959" stroke="#69BA94" stroke-width="0.377419"></circle>
									<circle cx="2.00016" cy="3.33366" r="0.477959" stroke="#69BA94" stroke-width="0.377419"></circle>
									<path d="M0.666992 7.33368L2.93551 7.00688M3.33367 10.0003L4.667 8.66701M7.52032 8.65394L7.73365 9.56898M8.82539 7.00688L10.0003 7.33368M8.82539 5.46797L11.3337 4.667M7.03471 2.98072L7.33365 2.00033M4.667 3.33367L3.33364 0.666992M3.33367 4.667L2.00033 3.33367" stroke="#69BA94" stroke-width="0.377419"></path>
									<circle cx="7.99984" cy="10.6663" r="1.14463" stroke="#69BA94" stroke-width="0.377419"></circle>
									<circle cx="0.666668" cy="7.33317" r="0.477959" stroke="#69BA94" stroke-width="0.377419"></circle>
								</svg><?= $arResult['PROPERTIES']['PRODUCT_INFECTION']['VALUE'] ?>
							</div>
						<? endif ?>

					</div>
				</div>
			</div>
			<div class="content-block-ContentBlock-module-bottom"></div>
		</div>
	</div>
	<div class="content-block-ContentBlock-module-block">
		<div class="content-block-ContentBlock-module-info">
			<div class="content-block-ContentBlock-module-content product-Product-module-tabs content-block-ContentBlock-module-last">
				<div class="product-Product-module-buttons">
					<svg width="10" height="30" viewBox="0 0 10 30" fill="none" xmlns="http://www.w3.org/2000/svg" class="product-Product-module-arrow-prev">
						<path d="M1.68376 0.557421C1.35484 0.557543 1.03332 0.725893 0.759853 1.04119C0.486387 1.35649 0.273251 1.80457 0.147388 2.3288C0.0215235 2.85303 -0.0114145 3.42986 0.0527353 3.98638C0.116885 4.5429 0.275245 5.05411 0.507792 5.45539L5.9851 14.9041L0.507792 24.3529C0.348928 24.6176 0.222213 24.9342 0.135039 25.2843C0.0478668 25.6344 0.00198078 26.0109 6.19888e-05 26.3919C-0.0018568 26.7728 0.0402279 27.1507 0.123861 27.5033C0.207495 27.8559 0.331001 28.1763 0.487175 28.4457C0.643349 28.7151 0.829062 28.9282 1.03348 29.0725C1.23789 29.2167 1.45692 29.2893 1.67777 29.286C1.89863 29.2827 2.11689 29.2036 2.31982 29.0532C2.52275 28.9028 2.70629 28.6842 2.85973 28.4102L9.513 16.9328C9.82483 16.3947 10 15.665 10 14.9041C10 14.1433 9.82483 13.4136 9.513 12.8755L2.85973 1.39814C2.54786 0.859993 2.12486 0.557583 1.68376 0.557421Z" fill="#294453"></path>
					</svg>
					<button class="button-Button-module-button product-Product-module-button">Описание</button>
					<button class="button-Button-module-button product-Product-module-button button-Button-module-inversed">Характеристики</button>
					<svg width="10" height="30" viewBox="0 0 10 30" fill="none" xmlns="http://www.w3.org/2000/svg" class="product-Product-module-arrow-next">
						<path d="M1.68376 0.557421C1.35484 0.557543 1.03332 0.725893 0.759853 1.04119C0.486387 1.35649 0.273251 1.80457 0.147388 2.3288C0.0215235 2.85303 -0.0114145 3.42986 0.0527353 3.98638C0.116885 4.5429 0.275245 5.05411 0.507792 5.45539L5.9851 14.9041L0.507792 24.3529C0.348928 24.6176 0.222213 24.9342 0.135039 25.2843C0.0478668 25.6344 0.00198078 26.0109 6.19888e-05 26.3919C-0.0018568 26.7728 0.0402279 27.1507 0.123861 27.5033C0.207495 27.8559 0.331001 28.1763 0.487175 28.4457C0.643349 28.7151 0.829062 28.9282 1.03348 29.0725C1.23789 29.2167 1.45692 29.2893 1.67777 29.286C1.89863 29.2827 2.11689 29.2036 2.31982 29.0532C2.52275 28.9028 2.70629 28.6842 2.85973 28.4102L9.513 16.9328C9.82483 16.3947 10 15.665 10 14.9041C10 14.1433 9.82483 13.4136 9.513 12.8755L2.85973 1.39814C2.54786 0.859993 2.12486 0.557583 1.68376 0.557421Z" fill="#294453"></path>
					</svg>
				</div>
				<div class="product-Product-module-wrapper">
					<div class="button-block-js">
						<div class="product-Product-module-text">
							<p>
								<?= $arResult['PROPERTIES']['PRODUCT_DESCRIPTION']['~VALUE']['TEXT'] ?>
							</p>
						</div>
						<div class="product-Product-module-additional-wrapper">
							<div class="product-Product-module-additional">
								<? if (array_key_exists('PRODUCT_DOCUMENTS', $arResult)) : ?>
									<div class="product-Product-module-documents">
										<p class="product-Product-module-subtitle">Документы</p>
										<? foreach ($arResult['PRODUCT_DOCUMENTS'] as $document) : ?>
											<a href="<?= $document['SRC'] ?>" target="_blank" rel="noreferrer">
												<div class="product-Product-module-file">
													<img src="/upload/images/static_media/icons/file.png" alt="file image" />
													<div class="product-Product-module-info">
														<span><?= $document['ORIGINAL_NAME'] ?></span><span><?= round(($document['FILE_SIZE'] / 1000000), 2) ?>мб</span>
													</div>
												</div>
											</a>
										<? endforeach ?>
									</div>
								<? endif ?>
								<? if (array_key_exists('PRODUCT_INFORMATION', $arResult)) : ?>
									<div class="product-Product-module-image">
										<p class="product-Product-module-subtitle">Справочная информация</p>
										<img src="<?= $arResult['PRODUCT_INFORMATION'][0]['SRC'] ?>" alt="information" />
									</div>
								<? endif ?>
							</div>
						</div>
					</div>
					<div class="button-block-js product-Product-module-characteristic" style="display: none">
						<?
						$char_descriptions = $arResult['PROPERTIES']['PRODUCT_CHARACTERISTICS']['DESCRIPTION'];
						foreach ($arResult['PROPERTIES']['PRODUCT_CHARACTERISTICS']['VALUE'] as $key => $value) : ?>
							<div class="product-Product-module-line">
								<p class="product-Product-module-text"><?= $value['TEXT'] ?></p>
								<div class="product-Product-module-dots"></div>
								<p class="product-Product-module-text product-Product-module-text-right"><?= $char_descriptions[$key] ?></p>
							</div>
						<? endforeach ?>
					</div>
				</div>
			</div>
			<div class="content-block-ContentBlock-module-bottom"></div>
		</div>
	</div>



	<?
	$APPLICATION->IncludeComponent(
		"bitrix:catalog.section",
		"catalog_detail",
		array(
			"ACTION_VARIABLE" => "action",
			"ADD_PICT_PROP" => "-",
			"ADD_PROPERTIES_TO_BASKET" => "Y",
			"ADD_SECTIONS_CHAIN" => "N",
			"ADD_TO_BASKET_ACTION" => "ADD",
			"AJAX_MODE" => "N",
			"AJAX_OPTION_ADDITIONAL" => "",
			"AJAX_OPTION_HISTORY" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"BACKGROUND_IMAGE" => "-",
			"BASKET_URL" => "/basket/",
			"BROWSER_TITLE" => "-",
			"CACHE_FILTER" => "N",
			"CACHE_GROUPS" => "Y",
			"CACHE_TIME" => "36000000",
			"CACHE_TYPE" => "A",
			"COMPATIBLE_MODE" => "Y",
			"COMPONENT_TEMPLATE" => "catalog_main",
			"CONVERT_CURRENCY" => "N",
			"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
			"DETAIL_URL" => "",
			"DISABLE_INIT_JS_IN_COMPONENT" => "N",
			"DISPLAY_BOTTOM_PAGER" => "Y",
			"DISPLAY_COMPARE" => "N",
			"DISPLAY_TOP_PAGER" => "N",
			"ELEMENT_SORT_FIELD" => "sort",
			"ELEMENT_SORT_FIELD2" => "id",
			"ELEMENT_SORT_ORDER" => "asc",
			"ELEMENT_SORT_ORDER2" => "desc",
			"ENLARGE_PRODUCT" => "STRICT",
			"FILTER_NAME" => "arrFilter",
			"HIDE_NOT_AVAILABLE" => "N",
			"HIDE_NOT_AVAILABLE_OFFERS" => "N",
			"IBLOCK_ID" => "14",
			"IBLOCK_TYPE" => "Shop",
			"INCLUDE_SUBSECTIONS" => "Y",
			"LABEL_PROP" => array(),
			"LAZY_LOAD" => "N",
			"LINE_ELEMENT_COUNT" => "3",
			"LOAD_ON_SCROLL" => "N",
			"MESSAGE_404" => "",
			"MESS_BTN_ADD_TO_BASKET" => "В корзину",
			"MESS_BTN_BUY" => "Купить",
			"MESS_BTN_DETAIL" => "Подробнее",
			"MESS_BTN_LAZY_LOAD" => "Показать ещё",
			"MESS_BTN_SUBSCRIBE" => "Подписаться",
			"MESS_NOT_AVAILABLE" => "Нет в наличии",
			"META_DESCRIPTION" => "-",
			"META_KEYWORDS" => "-",
			"OFFERS_FIELD_CODE" => array(0 => "", 1 => "",),
			"OFFERS_LIMIT" => "0",
			"OFFERS_SORT_FIELD" => "sort",
			"OFFERS_SORT_FIELD2" => "id",
			"OFFERS_SORT_ORDER" => "asc",
			"OFFERS_SORT_ORDER2" => "desc",
			"PAGER_BASE_LINK_ENABLE" => "N",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_SHOW_ALL" => "N",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_TEMPLATE" => ".default",
			"PAGER_TITLE" => "Товары",
			"PAGE_ELEMENT_COUNT" => "18",
			"PARTIAL_PRODUCT_PROPERTIES" => "N",
			"PRICE_CODE" => array(0 => "retail",),
			"PRICE_VAT_INCLUDE" => "Y",
			"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
			"PRODUCT_DISPLAY_MODE" => "N",
			"PRODUCT_ID_VARIABLE" => "id",
			"PRODUCT_PROPS_VARIABLE" => "prop",
			"PRODUCT_QUANTITY_VARIABLE" => "quantity",
			"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
			"PRODUCT_SUBSCRIPTION" => "Y",
			"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
			"RCM_TYPE" => "personal",
			"SECTION_CODE" => "",
			"SECTION_ID" => $arResult["IBLOCK_SECTION_ID"],
			"SECTION_ID_VARIABLE" => "SECTION_ID",
			"SECTION_URL" => "",
			"SECTION_USER_FIELDS" => array(0 => "", 1 => "",),
			"SEF_MODE" => "N",
			"SET_BROWSER_TITLE" => "Y",
			"SET_LAST_MODIFIED" => "N",
			"SET_META_DESCRIPTION" => "Y",
			"SET_META_KEYWORDS" => "Y",
			"SET_STATUS_404" => "N",
			"SET_TITLE" => "Y",
			"SHOW_404" => "N",
			"SHOW_ALL_WO_SECTION" => "Y",
			"SHOW_CLOSE_POPUP" => "Y",
			"SHOW_DISCOUNT_PERCENT" => "N",
			"SHOW_FROM_SECTION" => "N",
			"SHOW_MAX_QUANTITY" => "N",
			"SHOW_OLD_PRICE" => "N",
			"SHOW_PRICE_COUNT" => "1",
			"SHOW_SLIDER" => "Y",
			"SLIDER_INTERVAL" => "3000",
			"SLIDER_PROGRESS" => "N",
			"TEMPLATE_THEME" => "blue",
			"USE_ENHANCED_ECOMMERCE" => "N",
			"USE_MAIN_ELEMENT_SECTION" => "N",
			"USE_PRICE_COUNT" => "N",
			"USE_PRODUCT_QUANTITY" => "N"
		)
	);
	?>

</main>




<meta itemprop="name" content="<?= $name ?>" />
<meta itemprop="category" content="<?= $arResult['CATEGORY_PATH'] ?>" />
<meta itemprop="id" content="<?= $arResult['ID'] ?>" />
<?php
if ($haveOffers) {
	foreach ($arResult['JS_OFFERS'] as $offer) {
		$currentOffersList = array();

		if (!empty($offer['TREE']) && is_array($offer['TREE'])) {
			foreach ($offer['TREE'] as $propName => $skuId) {
				$propId = (int)substr($propName, 5);

				foreach ($skuProps as $prop) {
					if ($prop['ID'] == $propId) {
						foreach ($prop['VALUES'] as $propId => $propValue) {
							if ($propId == $skuId) {
								$currentOffersList[] = $propValue['NAME'];
								break;
							}
						}
					}
				}
			}
		}

		$offerPrice = $offer['ITEM_PRICES'][$offer['ITEM_PRICE_SELECTED']];
?>
		<span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
			<meta itemprop="sku" content="<?= htmlspecialcharsbx(implode('/', $currentOffersList)) ?>" />
			<meta itemprop="price" content="<?= $offerPrice['RATIO_PRICE'] ?>" />
			<meta itemprop="priceCurrency" content="<?= $offerPrice['CURRENCY'] ?>" />
			<link itemprop="availability" href="http://schema.org/<?= ($offer['CAN_BUY'] ? 'InStock' : 'OutOfStock') ?>" />
		</span>
	<?php
	}

	unset($offerPrice, $currentOffersList);
} else {
	?>
	<span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
		<meta itemprop="price" content="<?= $price['RATIO_PRICE'] ?>" />
		<meta itemprop="priceCurrency" content="<?= $price['CURRENCY'] ?>" />
		<link itemprop="availability" href="http://schema.org/<?= ($actualItem['CAN_BUY'] ? 'InStock' : 'OutOfStock') ?>" />
	</span>
<?php
}
?>
<?php
if ($haveOffers) {
	$offerIds = array();
	$offerCodes = array();

	$useRatio = $arParams['USE_RATIO_IN_RANGES'] === 'Y';

	foreach ($arResult['JS_OFFERS'] as $ind => &$jsOffer) {
		$offerIds[] = (int)$jsOffer['ID'];
		$offerCodes[] = $jsOffer['CODE'];

		$fullOffer = $arResult['OFFERS'][$ind];
		$measureName = $fullOffer['ITEM_MEASURE']['TITLE'];

		$strAllProps = '';
		$strMainProps = '';
		$strPriceRangesRatio = '';
		$strPriceRanges = '';

		if ($arResult['SHOW_OFFERS_PROPS']) {
			if (!empty($jsOffer['DISPLAY_PROPERTIES'])) {
				foreach ($jsOffer['DISPLAY_PROPERTIES'] as $property) {
					$current = '<li class="product-item-detail-properties-item">
					<span class="product-item-detail-properties-name">' . $property['NAME'] . '</span>
					<span class="product-item-detail-properties-dots"></span>
					<span class="product-item-detail-properties-value">' . (is_array($property['VALUE'])
						? implode(' / ', $property['VALUE'])
						: $property['VALUE']
					) . '</span></li>';
					$strAllProps .= $current;

					if (isset($arParams['MAIN_BLOCK_OFFERS_PROPERTY_CODE'][$property['CODE']])) {
						$strMainProps .= $current;
					}
				}

				unset($current);
			}
		}

		if ($arParams['USE_PRICE_COUNT'] && count($jsOffer['ITEM_QUANTITY_RANGES']) > 1) {
			$strPriceRangesRatio = '(' . Loc::getMessage(
				'CT_BCE_CATALOG_RATIO_PRICE',
				array('#RATIO#' => ($useRatio
					? $fullOffer['ITEM_MEASURE_RATIOS'][$fullOffer['ITEM_MEASURE_RATIO_SELECTED']]['RATIO']
					: '1'
				) . ' ' . $measureName)
			) . ')';

			foreach ($jsOffer['ITEM_QUANTITY_RANGES'] as $range) {
				if ($range['HASH'] !== 'ZERO-INF') {
					$itemPrice = false;

					foreach ($jsOffer['ITEM_PRICES'] as $itemPrice) {
						if ($itemPrice['QUANTITY_HASH'] === $range['HASH']) {
							break;
						}
					}

					if ($itemPrice) {
						$strPriceRanges .= '<dt>' . Loc::getMessage(
							'CT_BCE_CATALOG_RANGE_FROM',
							array('#FROM#' => $range['SORT_FROM'] . ' ' . $measureName)
						) . ' ';

						if (is_infinite($range['SORT_TO'])) {
							$strPriceRanges .= Loc::getMessage('CT_BCE_CATALOG_RANGE_MORE');
						} else {
							$strPriceRanges .= Loc::getMessage(
								'CT_BCE_CATALOG_RANGE_TO',
								array('#TO#' => $range['SORT_TO'] . ' ' . $measureName)
							);
						}

						$strPriceRanges .= '</dt><dd>' . ($useRatio ? $itemPrice['PRINT_RATIO_PRICE'] : $itemPrice['PRINT_PRICE']) . '</dd>';
					}
				}
			}

			unset($range, $itemPrice);
		}

		$jsOffer['DISPLAY_PROPERTIES'] = $strAllProps;
		$jsOffer['DISPLAY_PROPERTIES_MAIN_BLOCK'] = $strMainProps;
		$jsOffer['PRICE_RANGES_RATIO_HTML'] = $strPriceRangesRatio;
		$jsOffer['PRICE_RANGES_HTML'] = $strPriceRanges;
	}

	$templateData['OFFER_IDS'] = $offerIds;
	$templateData['OFFER_CODES'] = $offerCodes;
	unset($jsOffer, $strAllProps, $strMainProps, $strPriceRanges, $strPriceRangesRatio, $useRatio);

	$jsParams = array(
		'CONFIG' => array(
			'USE_CATALOG' => $arResult['CATALOG'],
			'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
			'SHOW_PRICE' => true,
			'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'] === 'Y',
			'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'] === 'Y',
			'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
			'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
			'SHOW_SKU_PROPS' => $arResult['SHOW_OFFERS_PROPS'],
			'OFFER_GROUP' => $arResult['OFFER_GROUP'],
			'MAIN_PICTURE_MODE' => $arParams['DETAIL_PICTURE_MODE'],
			'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
			'SHOW_CLOSE_POPUP' => $arParams['SHOW_CLOSE_POPUP'] === 'Y',
			'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
			'RELATIVE_QUANTITY_FACTOR' => $arParams['RELATIVE_QUANTITY_FACTOR'],
			'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
			'USE_STICKERS' => true,
			'USE_SUBSCRIBE' => $showSubscribe,
			'SHOW_SLIDER' => $arParams['SHOW_SLIDER'],
			'SLIDER_INTERVAL' => $arParams['SLIDER_INTERVAL'],
			'ALT' => $alt,
			'TITLE' => $title,
			'MAGNIFIER_ZOOM_PERCENT' => 200,
			'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
			'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
			'BRAND_PROPERTY' => !empty($arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']])
				? $arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']]['DISPLAY_VALUE']
				: null,
			'SHOW_SKU_DESCRIPTION' => $arParams['SHOW_SKU_DESCRIPTION'],
			'DISPLAY_PREVIEW_TEXT_MODE' => $arParams['DISPLAY_PREVIEW_TEXT_MODE']
		),
		'PRODUCT_TYPE' => $arResult['PRODUCT']['TYPE'],
		'VISUAL' => $itemIds,
		'DEFAULT_PICTURE' => array(
			'PREVIEW_PICTURE' => $arResult['DEFAULT_PICTURE'],
			'DETAIL_PICTURE' => $arResult['DEFAULT_PICTURE']
		),
		'PRODUCT' => array(
			'ID' => $arResult['ID'],
			'ACTIVE' => $arResult['ACTIVE'],
			'NAME' => $arResult['~NAME'],
			'CATEGORY' => $arResult['CATEGORY_PATH'],
			'DETAIL_TEXT' => $arResult['DETAIL_TEXT'],
			'DETAIL_TEXT_TYPE' => $arResult['DETAIL_TEXT_TYPE'],
			'PREVIEW_TEXT' => $arResult['PREVIEW_TEXT'],
			'PREVIEW_TEXT_TYPE' => $arResult['PREVIEW_TEXT_TYPE']
		),
		'BASKET' => array(
			'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
			'BASKET_URL' => $arParams['BASKET_URL'],
			'SKU_PROPS' => $arResult['OFFERS_PROP_CODES'],
			'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
			'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
		),
		'OFFERS' => $arResult['JS_OFFERS'],
		'OFFER_SELECTED' => $arResult['OFFERS_SELECTED'],
		'TREE_PROPS' => $skuProps
	);
} else {
	$emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
	if ($arParams['ADD_PROPERTIES_TO_BASKET'] === 'Y' && !$emptyProductProperties) {
?>
		<div id="<?= $itemIds['BASKET_PROP_DIV'] ?>" style="display: none;">
			<?php
			if (!empty($arResult['PRODUCT_PROPERTIES_FILL'])) {
				foreach ($arResult['PRODUCT_PROPERTIES_FILL'] as $propId => $propInfo) {
			?>
					<input type="hidden" name="<?= $arParams['PRODUCT_PROPS_VARIABLE'] ?>[<?= $propId ?>]" value="<?= htmlspecialcharsbx($propInfo['ID']) ?>">
				<?php
					unset($arResult['PRODUCT_PROPERTIES'][$propId]);
				}
			}

			$emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
			if (!$emptyProductProperties) {
				?>
				<table>
					<?php
					foreach ($arResult['PRODUCT_PROPERTIES'] as $propId => $propInfo) {
					?>
						<tr>
							<td><?= $arResult['PROPERTIES'][$propId]['NAME'] ?></td>
							<td>
								<?php
								if (
									$arResult['PROPERTIES'][$propId]['PROPERTY_TYPE'] === 'L'
									&& $arResult['PROPERTIES'][$propId]['LIST_TYPE'] === 'C'
								) {
									foreach ($propInfo['VALUES'] as $valueId => $value) {
								?>
										<label>
											<input type="radio" name="<?= $arParams['PRODUCT_PROPS_VARIABLE'] ?>[<?= $propId ?>]" value="<?= $valueId ?>" <?= ($valueId == $propInfo['SELECTED'] ? '"checked"' : '') ?>>
											<?= $value ?>
										</label>
										<br>
									<?php
									}
								} else {
									?>
									<select name="<?= $arParams['PRODUCT_PROPS_VARIABLE'] ?>[<?= $propId ?>]">
										<?php
										foreach ($propInfo['VALUES'] as $valueId => $value) {
										?>
											<option value="<?= $valueId ?>" <?= ($valueId == $propInfo['SELECTED'] ? '"selected"' : '') ?>>
												<?= $value ?>
											</option>
										<?php
										}
										?>
									</select>
								<?php
								}
								?>
							</td>
						</tr>
					<?php
					}
					?>
				</table>
			<?php
			}
			?>
		</div>
<?php
	}

	$jsParams = array(
		'CONFIG' => array(
			'USE_CATALOG' => $arResult['CATALOG'],
			'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
			'SHOW_PRICE' => !empty($arResult['ITEM_PRICES']),
			'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'] === 'Y',
			'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'] === 'Y',
			'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
			'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
			'MAIN_PICTURE_MODE' => $arParams['DETAIL_PICTURE_MODE'],
			'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
			'SHOW_CLOSE_POPUP' => $arParams['SHOW_CLOSE_POPUP'] === 'Y',
			'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
			'RELATIVE_QUANTITY_FACTOR' => $arParams['RELATIVE_QUANTITY_FACTOR'],
			'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
			'USE_STICKERS' => true,
			'USE_SUBSCRIBE' => $showSubscribe,
			'SHOW_SLIDER' => $arParams['SHOW_SLIDER'],
			'SLIDER_INTERVAL' => $arParams['SLIDER_INTERVAL'],
			'ALT' => $alt,
			'TITLE' => $title,
			'MAGNIFIER_ZOOM_PERCENT' => 200,
			'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
			'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
			'BRAND_PROPERTY' => !empty($arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']])
				? $arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']]['DISPLAY_VALUE']
				: null
		),
		'VISUAL' => $itemIds,
		'PRODUCT_TYPE' => $arResult['PRODUCT']['TYPE'],
		'PRODUCT' => array(
			'ID' => $arResult['ID'],
			'ACTIVE' => $arResult['ACTIVE'],
			'PICT' => reset($arResult['MORE_PHOTO']),
			'NAME' => $arResult['~NAME'],
			'SUBSCRIPTION' => true,
			'ITEM_PRICE_MODE' => $arResult['ITEM_PRICE_MODE'],
			'ITEM_PRICES' => $arResult['ITEM_PRICES'],
			'ITEM_PRICE_SELECTED' => $arResult['ITEM_PRICE_SELECTED'],
			'ITEM_QUANTITY_RANGES' => $arResult['ITEM_QUANTITY_RANGES'],
			'ITEM_QUANTITY_RANGE_SELECTED' => $arResult['ITEM_QUANTITY_RANGE_SELECTED'],
			'ITEM_MEASURE_RATIOS' => $arResult['ITEM_MEASURE_RATIOS'],
			'ITEM_MEASURE_RATIO_SELECTED' => $arResult['ITEM_MEASURE_RATIO_SELECTED'],
			'SLIDER_COUNT' => $arResult['MORE_PHOTO_COUNT'],
			'SLIDER' => $arResult['MORE_PHOTO'],
			'CAN_BUY' => $arResult['CAN_BUY'],
			'CHECK_QUANTITY' => $arResult['CHECK_QUANTITY'],
			'QUANTITY_FLOAT' => is_float($arResult['ITEM_MEASURE_RATIOS'][$arResult['ITEM_MEASURE_RATIO_SELECTED']]['RATIO']),
			'MAX_QUANTITY' => $arResult['PRODUCT']['QUANTITY'],
			'STEP_QUANTITY' => $arResult['ITEM_MEASURE_RATIOS'][$arResult['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'],
			'CATEGORY' => $arResult['CATEGORY_PATH']
		),
		'BASKET' => array(
			'ADD_PROPS' => $arParams['ADD_PROPERTIES_TO_BASKET'] === 'Y',
			'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
			'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
			'EMPTY_PROPS' => $emptyProductProperties,
			'BASKET_URL' => $arParams['BASKET_URL'],
			'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
			'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
		)
	);
	unset($emptyProductProperties);
}

if ($arParams['DISPLAY_COMPARE']) {
	$jsParams['COMPARE'] = array(
		'COMPARE_URL_TEMPLATE' => $arResult['~COMPARE_URL_TEMPLATE'],
		'COMPARE_DELETE_URL_TEMPLATE' => $arResult['~COMPARE_DELETE_URL_TEMPLATE'],
		'COMPARE_PATH' => $arParams['COMPARE_PATH']
	);
}

$jsParams["IS_FACEBOOK_CONVERSION_CUSTOMIZE_PRODUCT_EVENT_ENABLED"] =
	$arResult["IS_FACEBOOK_CONVERSION_CUSTOMIZE_PRODUCT_EVENT_ENABLED"];
?>
</div>
<script>
	BX.message({
		ECONOMY_INFO_MESSAGE: '<?= GetMessageJS('CT_BCE_CATALOG_ECONOMY_INFO2') ?>',
		TITLE_ERROR: '<?= GetMessageJS('CT_BCE_CATALOG_TITLE_ERROR') ?>',
		TITLE_BASKET_PROPS: '<?= GetMessageJS('CT_BCE_CATALOG_TITLE_BASKET_PROPS') ?>',
		BASKET_UNKNOWN_ERROR: '<?= GetMessageJS('CT_BCE_CATALOG_BASKET_UNKNOWN_ERROR') ?>',
		BTN_SEND_PROPS: '<?= GetMessageJS('CT_BCE_CATALOG_BTN_SEND_PROPS') ?>',
		BTN_MESSAGE_DETAIL_BASKET_REDIRECT: '<?= GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_BASKET_REDIRECT') ?>',
		BTN_MESSAGE_CLOSE: '<?= GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE') ?>',
		BTN_MESSAGE_DETAIL_CLOSE_POPUP: '<?= GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE_POPUP') ?>',
		TITLE_SUCCESSFUL: '<?= GetMessageJS('CT_BCE_CATALOG_ADD_TO_BASKET_OK') ?>',
		COMPARE_MESSAGE_OK: '<?= GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_OK') ?>',
		COMPARE_UNKNOWN_ERROR: '<?= GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_UNKNOWN_ERROR') ?>',
		COMPARE_TITLE: '<?= GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_TITLE') ?>',
		BTN_MESSAGE_COMPARE_REDIRECT: '<?= GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT') ?>',
		PRODUCT_GIFT_LABEL: '<?= GetMessageJS('CT_BCE_CATALOG_PRODUCT_GIFT_LABEL') ?>',
		PRICE_TOTAL_PREFIX: '<?= GetMessageJS('CT_BCE_CATALOG_MESS_PRICE_TOTAL_PREFIX') ?>',
		RELATIVE_QUANTITY_MANY: '<?= CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_MANY']) ?>',
		RELATIVE_QUANTITY_FEW: '<?= CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_FEW']) ?>',
		SITE_ID: '<?= CUtil::JSEscape($component->getSiteId()) ?>'
	});

	var <?= $obName ?> = new JCCatalogElement(<?= CUtil::PhpToJSObject($jsParams, false, true) ?>);
</script>
<?php
unset($actualItem, $itemIds, $jsParams);
