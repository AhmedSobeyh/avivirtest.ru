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

//apre( $arResult );
?>

<?if( count($arResult['SECTIONS']) >= 1 ):?>
	<div class="c-photo-section-carousel">

		<?if ($arParams["HEADER"]):?>
			<div class="o-container@md">
				<h2 class="c-photo-section-carousel__title">
					<?if ($arParams["HEADER_LINK"]):?>
						<a href="<?=$arParams["HEADER_LINK"]?>"><?=$arParams["HEADER"]?></a>
					<?else:?>
						<?=$arParams["HEADER"]?>
					<?endif?>
				</h2>
				<div class="o-decor-divider c-photo-section-carousel__divider"></div>
			</div>
		<?endif?>

		<div class="o-container@xl c-photo-section-carousel__container">
			<?/** START: Swiper main container */?>
			<div class="swiper-container c-photo-section-carousel__swiper-container js-photo-section-carousel">
				<?/** START: Additional required wrapper */?>
				<div class="swiper-wrapper">
					<?/** START: Slides */?>
					<?foreach( $arResult['SECTIONS'] as $arItem ):?>

						<div class="swiper-slide c-photo-section-carousel__swiper-slide">
							<?/** START: Photo section list item */?>
							<div class="o-image-stack o-image-stack--animated c-photo-section-list-item">
								<div class="o-image-stack__container">
									<?
									if( $arItem['PICTURE']['SRC'] )
										$picture = $arItem['PICTURE']['SRC'];
									else
										$picture = '/upload/img_none/poems.jpg';
									?>
									<img class="o-image-stack__img" src="<?=$picture?>" alt="<?=$arItem['NAME']?>">
									<img class="o-image-stack__img" src="<?=$picture?>" alt="<?=$arItem['NAME']?>">
									<img class="o-image-stack__img" src="<?=$picture?>" alt="<?=$arItem['NAME']?>">
								</div>
								<div class="c-photo-section-list-item__body">
									<h3 class="c-photo-section-list-item__title">
										<a class="o-stretched-link c-photo-section-list-item__link" href="<?=$arItem['SECTION_PAGE_URL']?>"><?=$arItem['NAME']?></a>
									</h3>
								</div>
							</div>
							<?/** END: Photo section list item */?>
						</div>

					<?endforeach?>
					<?/** END: Slides */?>
				</div>
				<?/** END: Additional required wrapper */?>
			</div>
			<?/** END: Swiper main container */?>
		</div>
	</div>
<?endif?>
