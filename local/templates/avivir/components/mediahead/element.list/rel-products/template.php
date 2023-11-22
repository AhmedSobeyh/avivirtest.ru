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
if (count($arResult['ITEMS']) < 1)
{
	return;
}
?>

<main class="c-catalog-section-page">
	<section class="c-catalog-section-page-product-list">
		<div class="o-container@lg c-catalog-section-page-product-list__container">

			<div class="c-catalog-product-list">
				<ul class="c-catalog-product-list__layout">
					<?foreach($arResult["ITEMS"] as $arItem):?>
						<?
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
						?>

						<li class="c-catalog-product-list__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
							<div class="c-catalog-test-kit-card">
								<?if( $arItem['PREVIEW_PICTURE']['SRC'] )
									$itemPicture = $arItem['PREVIEW_PICTURE']['SRC'];

								else
									$itemPicture = '/upload/images/catalog/catalog-section-page-header-00.png';
								?>

								<div class="c-catalog-test-kit-card__media">
									<picture class="o-ratio o-ratio--4x3 c-catalog-test-kit-card__picture">
										<img class="c-catalog-test-kit-card__img" src="<?=$itemPicture?>" alt="<?=$arItem['NAME'];?>" />
									</picture>
								</div>

								<div class="c-catalog-test-kit-card__body">
									<?$brand = current($arItem['BRANDS'])?>

									<?if ($brand['NAME']):?>
										<span class="c-catalog-test-kit-card__brand">
											<?=$brand['NAME']?>, <?=$arItem['PROPERTIES']['COUNTRY']['VALUE']?>
										</span>
									<?endif?>	

									<h3 class="c-catalog-test-kit-card__title">
										<a
											class="o-stretched-link c-catalog-test-kit-card__title-link"
											href="<?=$arItem['DETAIL_PAGE_URL']?>"
										>

										</a>
										<?=$arItem['NAME'];?>
									</h3>

									<p class="c-catalog-test-kit-card__text">
										<?=$arItem['PREVIEW_TEXT']?>
									</p>

									<?if ($arItem['PROPERTIES']['DETERMINES']['VALUE']):?>
										<span class="c-catalog-test-kit-card__determinant">
											<?=$arItem['PROPERTIES']['DETERMINES']['VALUE']?>
										</span>
									<?endif?>

									<?if ($arItem['PROPERTIES']['MINUTES']['VALUE']):?>
										<span class="c-catalog-test-kit-card__time">
											<?=$arItem['PROPERTIES']['MINUTES']['VALUE']?> <?=GetMessage("CT_BNL_MIN")?>
										</span>
									<?endif?>

									<?if ($arItem['PROPERTIES']['TEST_TYPE']['VALUE']):?>
										<span class="c-catalog-test-kit-card__type">
											<?=$arItem['PROPERTIES']['TEST_TYPE']['VALUE']?>
										</span>
									<?endif?>



								</div>

								<?// START: Button ?>
								<button
									class="c-btn c-btn--kind-primary c-btn--size-lg c-catalog-test-kit-card__btn"
									tabindex="-1"
									aria-disabled="true"
								>
									<span
										class="c-btn__overlay"
									></span>
									<span class="c-btn__content">
										<?=GetMessage("CT_BNL_GOTO_DETAIL")?>
									</span>
								</button>
								<?// END: Button ?>
							</div>
						</li>
					<?endforeach;?>
				</ul>

				<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
					<div class="c-catalog-product-list__pagination">
						<?=$arResult["NAV_STRING"]?>
					</div>
				<?endif;?>
			</div>

		</div>
	</section>
</main>	

