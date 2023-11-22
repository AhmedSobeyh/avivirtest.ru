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
?>

<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

	$i++;

	$classes = '';
	$bgHolderImg = '';

	if ($i % 2 != 0) {
        $classes = 'c-dynamic-banner--split@lg c-dynamic-banner--displaced@xl u-bg-light-mint';

		$bgHolderImg = 'bg-plus-grid-color-primary-02.svg';
    } else {
		$classes = 'c-dynamic-banner--split-reverse@lg c-dynamic-banner--displaced-reverse@xl';

		$bgHolderImg = 'bg-plus-grid-color-primary-01.svg';
	}
	?>

	<section class="
		c-dynamic-banner
		c-dynamic-banner--size-lg
		c-dynamic-banner--density-compact
		c-dynamic-banner--center-body@lg
		<?=$classes?>
	">
		<div class="o-container@lg c-dynamic-banner__container">
			<div class="c-dynamic-banner__layout">
				<div class="c-dynamic-banner__media c-dynamic-banner__media--align-center">
					<div
						class="o-bg-holder c-dynamic-banner__media-bg-holder"
						style="background-image: url(/upload/images/backgrounds/<?=$bgHolderImg?>);"
					></div>

					<? // START: Picture ?>
					<?
					if ( $arItem['PREVIEW_PICTURE']['SRC'] )
						$picture = $arItem['PREVIEW_PICTURE']['SRC'];

					if ( !$picture )
						$picture = '/upload/images/renders/render-molecule.png';
					?>

					<?if ($picture):?>
						<picture class="c-picture c-dynamic-banner__picture">
							<img
								class="c-picture__img c-picture__img--contain c-dynamic-banner__img"
								src="<?=$picture?>"
								alt="<?=$arItem['NAME']?>"
							>
						</picture>
					<?endif?>
					<? // END: Picture ?>
				</div>
				<div class="c-dynamic-banner__body">
					<h2 class="c-dynamic-banner__title">
						<?=$arItem['NAME']?>
					</h2>

					<p class="c-dynamic-banner__text">
						<?=$arItem['PREVIEW_TEXT'];?>
					</p>

					<div class="c-dynamic-banner__btn-group">
						<?// START: Button ?>
						<a
							class="c-btn c-btn--kind-primary c-btn--size-lg c-dynamic-banner__btn"
							href="<?=$arItem['DETAIL_PAGE_URL']?>"
						>
							<span class="c-btn__overlay"></span>
							<span class="c-btn__content">
								Подробнее
							</span>
						</a>
						<?// END: Button ?>
					</div>
				</div>
			</div>
		</div>
	</section>
<?endforeach;?>
