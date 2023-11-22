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

<div class="c-event-carousel">
	<?if ($arParams["HEADER"]):?>
		<h2 class="c-event-carousel__title">
			<?if ($arParams["HEADER_LINK"]):?>
				<a href="<?=$arParams["HEADER_LINK"]?>"><?=$arParams["HEADER"]?></a>
			<?else:?>
				<?=$arParams["HEADER"]?>
			<?endif?>
		</h2>
	<?endif?>

	<? // START: Swiper main container ?>
	<div class="swiper-container c-event-carousel__swiper-container js-event-carousel">
		<? // START: Additional required wrapper ?>
		<div class="swiper-wrapper">
			<? // START: Slides ?>

			<?foreach($arResult["ITEMS"] as $arItem):?>

			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			$section = false;
			if ($arItem['SECTION_ID'])
				$section = $arResult['SECTIONS'][$arItem['SECTION_ID']];
			?>

				<div class="swiper-slide c-event-carousel__swiper-slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
					<div class="c-event-carousel-item">
						<div class="o-embed-responsive o-embed-responsive--1by1 c-event-carousel-item__media"><?
							if( $arItem['PREVIEW_PICTURE']['SRC'])
								$picture =$arItem['PREVIEW_PICTURE']['SRC'];
							else
								$picture = SITE_TEMPLATE_PATH.'/assets/images/placeholder/event-placeholder.svg';
							?>
							<img class="o-embed-responsive__item c-event-carousel-item__img" src="<?=$picture?>" alt="<?=$arItem["NAME"]?>">
						</div>

						<div class="c-event-carousel-item__body">
							<div class="c-event-carousel-item__container">
								<?if ($arItem['DISPLAY_ACTIVE_FROM']):?>
									<time class="c-event-carousel-item__date u-ff-secondary"><?=$arItem['DISPLAY_ACTIVE_FROM']?></time>
								<?endif?>

								<h2 class="c-event-carousel-item__title">
									<a class="o-stretched-link c-event-carousel-item__title-link" href="<?=$arItem["DETAIL_PAGE_URL"]?>">
										<?=$arItem["NAME"]?>
									</a>
								</h2>

								<div class="c-event-carousel-item__text">
									<?=$arItem["PREVIEW_TEXT"];?>
								</div>
							</div>
						</div>
					</div>
				</div>

			<?endforeach?>
			<? // END: Slides ?>
		</div>
		<? // END: Additional required wrapper ?>

		<? // START: Swiper pagination ?>
		<div class="swiper-pagination c-event-carousel__swiper-pagination"></div>
		<? // END: Swiper pagination ?>
	</div>
	<? // END: Swiper main container ?>

	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<?=$arResult["NAV_STRING"]?>
	<?endif;?>
</div>
