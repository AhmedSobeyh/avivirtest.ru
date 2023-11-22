<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $elementEdit
 * @var string $elementDelete
 * @var string $elementDeleteParams
 */

global $APPLICATION;

$positionClassMap = array(
	'left' => 'product-item-label-left',
	'center' => 'product-item-label-center',
	'right' => 'product-item-label-right',
	'bottom' => 'product-item-label-bottom',
	'middle' => 'product-item-label-middle',
	'top' => 'product-item-label-top'
);

$discountPositionClass = '';
if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y' && !empty($arParams['DISCOUNT_PERCENT_POSITION'])) {
	foreach (explode('-', $arParams['DISCOUNT_PERCENT_POSITION']) as $pos) {
		$discountPositionClass .= isset($positionClassMap[$pos]) ? ' ' . $positionClassMap[$pos] : '';
	}
}

$labelPositionClass = '';
if (!empty($arParams['LABEL_PROP_POSITION'])) {
	foreach (explode('-', $arParams['LABEL_PROP_POSITION']) as $pos) {
		$labelPositionClass .= isset($positionClassMap[$pos]) ? ' ' . $positionClassMap[$pos] : '';
	}
}

$arParams['~MESS_BTN_BUY'] = $arParams['~MESS_BTN_BUY'] ?: Loc::getMessage('CT_BCT_TPL_MESS_BTN_BUY');
$arParams['~MESS_BTN_DETAIL'] = $arParams['~MESS_BTN_DETAIL'] ?: Loc::getMessage('CT_BCT_TPL_MESS_BTN_DETAIL');
$arParams['~MESS_BTN_COMPARE'] = $arParams['~MESS_BTN_COMPARE'] ?: Loc::getMessage('CT_BCT_TPL_MESS_BTN_COMPARE');
$arParams['~MESS_BTN_SUBSCRIBE'] = $arParams['~MESS_BTN_SUBSCRIBE'] ?: Loc::getMessage('CT_BCT_TPL_MESS_BTN_SUBSCRIBE');
$arParams['~MESS_BTN_ADD_TO_BASKET'] = $arParams['~MESS_BTN_ADD_TO_BASKET'] ?: Loc::getMessage('CT_BCT_TPL_MESS_BTN_ADD_TO_BASKET');
$arParams['~MESS_NOT_AVAILABLE'] = $arParams['~MESS_NOT_AVAILABLE'] ?: Loc::getMessage('CT_BCT_TPL_MESS_PRODUCT_NOT_AVAILABLE');
$arParams['~MESS_SHOW_MAX_QUANTITY'] = $arParams['~MESS_SHOW_MAX_QUANTITY'] ?: Loc::getMessage('CT_BCT_CATALOG_SHOW_MAX_QUANTITY');
$arParams['~MESS_RELATIVE_QUANTITY_MANY'] = $arParams['~MESS_RELATIVE_QUANTITY_MANY'] ?: Loc::getMessage('CT_BCT_CATALOG_RELATIVE_QUANTITY_MANY');
$arParams['~MESS_RELATIVE_QUANTITY_FEW'] = $arParams['~MESS_RELATIVE_QUANTITY_FEW'] ?: Loc::getMessage('CT_BCT_CATALOG_RELATIVE_QUANTITY_FEW');

$generalParams = array(
	'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
	'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
	'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
	'RELATIVE_QUANTITY_FACTOR' => $arParams['RELATIVE_QUANTITY_FACTOR'],
	'MESS_SHOW_MAX_QUANTITY' => $arParams['~MESS_SHOW_MAX_QUANTITY'],
	'MESS_RELATIVE_QUANTITY_MANY' => $arParams['~MESS_RELATIVE_QUANTITY_MANY'],
	'MESS_RELATIVE_QUANTITY_FEW' => $arParams['~MESS_RELATIVE_QUANTITY_FEW'],
	'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
	'USE_PRODUCT_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
	'PRODUCT_QUANTITY_VARIABLE' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
	'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
	'ADD_PROPERTIES_TO_BASKET' => $arParams['ADD_PROPERTIES_TO_BASKET'],
	'PRODUCT_PROPS_VARIABLE' => $arParams['PRODUCT_PROPS_VARIABLE'],
	'SHOW_CLOSE_POPUP' => $arParams['SHOW_CLOSE_POPUP'],
	'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
	'COMPARE_PATH' => $arParams['COMPARE_PATH'],
	'COMPARE_NAME' => $arParams['COMPARE_NAME'],
	'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
	'PRODUCT_BLOCKS_ORDER' => $arParams['PRODUCT_BLOCKS_ORDER'],
	'LABEL_POSITION_CLASS' => $labelPositionClass,
	'DISCOUNT_POSITION_CLASS' => $discountPositionClass,
	'SLIDER_INTERVAL' => $arParams['SLIDER_INTERVAL'],
	'SLIDER_PROGRESS' => $arParams['SLIDER_PROGRESS'],
	'~BASKET_URL' => $arParams['~BASKET_URL'],
	'~ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
	'~BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE'],
	'~COMPARE_URL_TEMPLATE' => $arResult['~COMPARE_URL_TEMPLATE'],
	'~COMPARE_DELETE_URL_TEMPLATE' => $arResult['~COMPARE_DELETE_URL_TEMPLATE'],
	'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
	'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
	'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
	'BRAND_PROPERTY' => $arParams['BRAND_PROPERTY'],
	'MESS_BTN_BUY' => $arParams['~MESS_BTN_BUY'],
	'MESS_BTN_DETAIL' => $arParams['~MESS_BTN_DETAIL'],
	'MESS_BTN_COMPARE' => $arParams['~MESS_BTN_COMPARE'],
	'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],
	'MESS_BTN_ADD_TO_BASKET' => $arParams['~MESS_BTN_ADD_TO_BASKET'],
	'MESS_NOT_AVAILABLE' => $arParams['~MESS_NOT_AVAILABLE']
);

$obName = 'ob' . preg_replace('/[^a-zA-Z0-9_]/', 'x', $this->GetEditAreaId($this->randString()));
$containerName = 'catalog-top-container';
?>


<div class="content-block-ContentBlock-module-block shop-Shop-module-wrapper">
	<div class="content-block-ContentBlock-module-info">
		<ul class="breadcrumbs-Breadcrumbs-module-list breadcrumbs-Breadcrumbs-module-avishop">
			<li class="breadcrumbs-Breadcrumbs-module-item"><a href="#">Продукция</a></li>
		</ul>
		<h2 class="content-block-ContentBlock-module-title content-block-ContentBlock-module-title-big">
			Продукция
		</h2>
		<div class="content-block-ContentBlock-module-content shop-Shop-module-inner content-block-ContentBlock-module-last">
			<form class="express-Filters-module-form">
				<div class="hidden-Hidden-module-desktop-hidden">
					<p class="express-Filters-module-title express-Filters-module-button express-Filters-module-visible">
						Фильтр<svg width="4" height="8" viewBox="0 0 4 8" fill="none" xmlns="http://www.w3.org/2000/svg" class="express-Filters-module-arrow express-Filters-module-visible">
							<path d="M0.673503 5.53131e-05C0.541935 8.67844e-05 0.413328 0.0440421 0.303941 0.126364C0.194555 0.208686 0.1093 0.32568 0.058955 0.462553C0.00860953 0.599427 -0.00456619 0.750034 0.0210941 0.895339C0.0467541 1.04064 0.110098 1.17412 0.203117 1.27889L2.39404 3.74591L0.203117 6.21293C0.139571 6.28204 0.0888851 6.36471 0.0540159 6.45611C0.0191469 6.54751 0.000792503 6.64582 2.47955e-05 6.7453C-0.000742912 6.84477 0.0160913 6.94342 0.0495446 7.03549C0.0829978 7.12756 0.132401 7.21121 0.19487 7.28155C0.257339 7.35189 0.331625 7.40752 0.413391 7.44519C0.495157 7.48286 0.582767 7.50181 0.671109 7.50095C0.759451 7.50008 0.846755 7.47942 0.927928 7.44015C1.0091 7.40089 1.08252 7.34382 1.14389 7.27226L3.8052 4.27558C3.92993 4.13509 4 3.94457 4 3.74591C4 3.54726 3.92993 3.35674 3.8052 3.21625L1.14389 0.219562C1.01915 0.0790553 0.849945 9.77516e-05 0.673503 5.53131e-05Z" fill="currentColor"></path>
						</svg>
					</p>
				</div>
				<div class="express-Filters-module-filters express-Filters-module-visible">
					<div class="express-Filters-module-filter">
						<h3 class="express-Filters-module-title">Каталог</h3>
						<ul class="express-Filters-module-items express-Filters-module-visible">
							<li class="express-Filters-module-item">
								<div class="КОММЕНТАРИЙ" style="display: none">
									Тут элементу input нужно сделать data-title (просто продублировать текст из label, например
									Слюна) и data-filter с названием соответствующего фильтра текстом (то есть сейчас в нашем
									случае - или По образцу, или По маркеру, или Инфекция)
								</div>
								<div class="contacts-CheckBox-module-wrapper">
									<input class="contacts-CheckBox-module-checkbox" type="checkbox" name="covid" id="covid" required="" data-title="Тесты COVID-19" data-filter="Каталог" /><label for="covid" class="contacts-CheckBox-module-label">Тесты COVID-19<span class="contacts-CheckBox-module-checkmark"><span class="contacts-CheckBox-module-checked"></span></span></label>
								</div>
							</li>
							<li class="express-Filters-module-item">
								<div class="КОММЕНТАРИЙ" style="display: none">
									Тут элементу input нужно сделать data-title (просто продублировать текст из label, например
									Слюна) и data-filter с названием соответствующего фильтра текстом (то есть сейчас в нашем
									случае - или По образцу, или По маркеру, или Инфекция)
								</div>
								<div class="contacts-CheckBox-module-wrapper">
									<input class="contacts-CheckBox-module-checkbox" type="checkbox" name="other_tests" id="other_tests" required="" data-title="Другие тесты" data-filter="Каталог" /><label for="other_tests" class="contacts-CheckBox-module-label">Другие тесты<span class="contacts-CheckBox-module-checkmark"><span class="contacts-CheckBox-module-checked"></span></span></label>
								</div>
							</li>
							<li class="express-Filters-module-item">
								<div class="КОММЕНТАРИЙ" style="display: none">
									Тут элементу input нужно сделать data-title (просто продублировать текст из label, например
									Слюна) и data-filter с названием соответствующего фильтра текстом (то есть сейчас в нашем
									случае - или По образцу, или По маркеру, или Инфекция)
								</div>
								<div class="contacts-CheckBox-module-wrapper">
									<input class="contacts-CheckBox-module-checkbox" type="checkbox" name="bad" id="bad" required="" data-title="БАДы и косметические средства" data-filter="Каталог" /><label for="bad" class="contacts-CheckBox-module-label">БАДы и косметические средства<span class="contacts-CheckBox-module-checkmark"><span class="contacts-CheckBox-module-checked"></span></span></label>
								</div>
							</li>
						</ul>
					</div>
					<p class="express-Filters-module-reset">Сбросить</p>
				</div>
			</form>


			<div class="shop-Shop-module-items" data-entity="<?= $containerName ?>">
				<?
				if (!empty($arResult['ITEMS']) && !empty($arResult['ITEM_ROWS'])) {
					$areaIds = array();

					foreach ($arResult['ITEMS'] as $item) {
						$uniqueId = $item['ID'] . '_' . md5($this->randString() . $component->getAction());
						$areaIds[$item['ID']] = $this->GetEditAreaId($uniqueId);
						$this->AddEditAction($uniqueId, $item['EDIT_LINK'], $elementEdit);
						$this->AddDeleteAction($uniqueId, $item['DELETE_LINK'], $elementDelete, $elementDeleteParams);
					}
				?>
					<!-- items-container -->
					<?
					foreach ($arResult['ITEM_ROWS'] as $rowData) {
						$rowItems = array_splice($arResult['ITEMS'], 0, $rowData['COUNT']);
					?>

						<?

						foreach ($rowItems as $item) {
						?>
							<?
							$APPLICATION->IncludeComponent(
								'bitrix:catalog.item',
								'catalog_item_main',
								array(
									'RESULT' => array(
										'ITEM' => $item,
										'AREA_ID' => $areaIds[$item['ID']],
										'TYPE' => $rowData['TYPE'],
										'BIG_LABEL' => 'N',
										'BIG_DISCOUNT_PERCENT' => 'N',
										'BIG_BUTTONS' => 'N',
										'SCALABLE' => 'N'
									),
									'PARAMS' => $generalParams
										+ array('SKU_PROPS' => $arResult['SKU_PROPS'][$item['IBLOCK_ID']])
								),
								$component,
								array('HIDE_ICONS' => 'Y')
							);
							?>
						<?
						}
						break;
						?>

					<?
					}
					unset($generalParams, $rowItems);
					?>
					<!-- items-container -->
				<?
				} else {
					// load css for bigData/deferred load
					$APPLICATION->IncludeComponent(
						'bitrix:catalog.item',
						'catalog_item_main',
						array(),
						$component,
						array('HIDE_ICONS' => 'Y')
					);
				}

				$signer = new \Bitrix\Main\Security\Sign\Signer;
				$signedTemplate = $signer->sign($templateName, 'catalog.top');
				$signedParams = $signer->sign(base64_encode(serialize($arResult['ORIGINAL_PARAMETERS'])), 'catalog.top');
				?>
			</div>
			<div class="content-block-ContentBlock-module-bottom"></div>
		</div>
	</div>

	<script>
		BX.message({
			RELATIVE_QUANTITY_MANY: '<?= CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_MANY']) ?>',
			RELATIVE_QUANTITY_FEW: '<?= CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_FEW']) ?>'
		});
		var <?= $obName ?> = new JCCatalogTopComponent({
			siteId: '<?= CUtil::JSEscape($component->getSiteId()) ?>',
			componentPath: '<?= CUtil::JSEscape($componentPath) ?>',
			deferredLoad: false, // enable it for deferred load
			initiallyShowHeader: '<?= !empty($arResult['ITEM_ROWS']) ?>',
			bigData: <?= CUtil::PhpToJSObject($arResult['BIG_DATA']) ?>,
			template: '<?= CUtil::JSEscape($signedTemplate) ?>',
			ajaxId: '<?= CUtil::JSEscape($arParams['AJAX_ID']) ?>',
			parameters: '<?= CUtil::JSEscape($signedParams) ?>',
			container: '<?= $containerName ?>'
		});
	</script>