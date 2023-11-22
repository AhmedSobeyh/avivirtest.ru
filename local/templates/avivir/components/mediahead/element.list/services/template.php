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

	if ($i % 2 == 0) {
        $reverseClass = 'c-section-preview--reverse';
    };
	?>

	<section class="c-section-preview <?=$reverseClass?>">
		<div class="o-container@lg c-section-preview__container">
			<div class="c-section-preview__layout">
				<?if( $arItem['PREVIEW_PICTURE'] )
					$picture = $arItem['PREVIEW_PICTURE']['SRC'];

				else
					$picture = '/upload/images/catalog/catalog-section-info-00.png';
				?>

				<div class="c-section-preview__media">
					<picture class="c-section-preview__picture">
						<img class="c-section-preview__img" src="<?=$picture?>" alt="<?=$section['NAME']?>" />
					</picture>
				</div>

				<div class="c-section-preview__body">
					<h2 class="c-section-preview__title">
						<?=$arItem['NAME'];?>
					</h2>

					<p class="c-section-preview__text">
						<?=$arItem['PREVIEW_TEXT'];?>
					</p>

					<?// START: Button ?>
					<a
						class="c-btn c-btn--kind-primary c-btn--size-lg c-section-preview__btn"
						href="<?=$arItem['DETAIL_PAGE_URL']?>"
					>
						<span
							class="c-btn__overlay"
						></span>
						<span class="c-btn__content">
							Подробнее
						</span>
					</a>
					<?// END: Button ?>
				</div>
			</div>
		</div>
	</section>
	<?//apre($item, 'товар')?>
<?endforeach;?>



<?//if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?//=$arResult["NAV_STRING"]?>
<?//endif;?>

<?//apre($arResult)?>
