<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
$arContinue = array();

//apre($arParams,'params');
// Наложение тени на фильтр

//apre($arResult);

if (empty($arResult['ITEMS'])) return;

?>

<div class="c-catalog-section-product-list__filter">

	<?$active = $arResult['filterHasCheckedValues']	!== true ? 'is-active' : ''?>
	<a
		class="c-btn c-btn--kind-outline-primary c-btn--size-default c-catalog-section-product-list__tag <?=$active?>"
		href="<?=$arParams['REQUESTED_PAGE']?>#productList"
		>
		<span class="c-btn__overlay"></span>
		<span class="c-btn__content"><?=GetMessage("MD_ALL")?></span>
	</a>

	<?foreach($arResult['ITEMS'] as $item):?>
		<?foreach($item['VALUES'] as $code => $value):?>
			<?$active = $value["CHECKED"] == true ? 'is-active' : ''?>
			<a
				class="c-btn c-btn--kind-outline-primary c-btn--size-default c-catalog-section-product-list__tag <?=$active?>"
				href="<?=$arParams['REQUESTED_PAGE']?>filter/<?=mb_strtolower($item['CODE'])?>-is-<?=$value['URL_ID']?>/#productList"
				>
				<span
					class="c-btn__overlay"
				></span>
				<span class="c-btn__content">
					<?=$value['VALUE']?>
				</span>
			</a>

		<?endforeach?>
	<?endforeach?>

</div>
