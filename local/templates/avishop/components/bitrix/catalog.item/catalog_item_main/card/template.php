<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $item
 * @var array $actualItem
 * @var array $minOffer
 * @var array $itemIds
 * @var array $price
 * @var array $measureRatio
 * @var bool $haveOffers
 * @var bool $showSubscribe
 * @var array $morePhoto
 * @var bool $showSlider
 * @var bool $itemHasDetailUrl
 * @var string $imgTitle
 * @var string $productTitle
 * @var string $buttonSizeClass
 * @var string $discountPositionClass
 * @var string $labelPositionClass
 * @var CatalogSectionComponent $component
 */
?>

<?
$res = CIBlockSection::GetByID($arResult['ITEM']['IBLOCK_SECTION_ID']);
if ($ar_res = $res->GetNext())
	$section_name = $ar_res['NAME'];
?>


<div data-entity="image-wrapper">
	<a href="<?= $item['DETAIL_PAGE_URL'] ?>" title="<?= $imgTitle ?>" data-entity="image-wrapper">
		<span id="<?= $itemIds['PICT_SLIDER'] ?>" data-slider-interval="<?= $arParams['SLIDER_INTERVAL'] ?>" data-slider-wrap="true">
			<img class="shop-Shop-module-image" src="<?= $item['PREVIEW_PICTURE']['SRC'] ?>" id="<?= $itemIds['SECOND_PICT'] ?>" />
		</span>
	</a>
	<p class="shop-Shop-module-title" data-filter="Каталог" data-title="<?= $section_name ?>">
		<?= $productTitle ?>
	</p>

	<div data-entity="price-block">
		<p class="shop-Shop-module-price" id="<?= $itemIds['PRICE'] ?>" data-entity="price-block"><?= $price['PRINT_RATIO_PRICE'] ?></p>
	</div>
	<div data-entity="buttons-block">
		<div class="" id="<?= $itemIds['BASKET_ACTIONS'] ?>">
			<button class="button-Button-module-button shop-Shop-module-button button-Button-module-widthFull" id="<?= $itemIds['BUY_LINK'] ?>" href="javascript:void(0)" rel="nofollow">
				<?= ($arParams['ADD_TO_BASKET_ACTION'] === 'BUY' ? $arParams['MESS_BTN_BUY'] : $arParams['MESS_BTN_ADD_TO_BASKET']) ?>
			</button>
		</div>
	</div>
</div>