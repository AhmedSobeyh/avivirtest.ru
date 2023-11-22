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

<?if( count($arResult['LIST']) >= 1 ):?>
	<div class="c-poetry-section-carousel">

		<?if ($arParams["HEADER"]):?>
			<div class="o-container@md">
				<h2 class="c-poetry-section-carousel__title">
					<?if ($arParams["HEADER_LINK"]):?>
						<a href="<?=$arParams["HEADER_LINK"]?>"><?=$arParams["HEADER"]?></a>
					<?else:?>
						<?=$arParams["HEADER"]?>
					<?endif?>
				</h2>
				<div class="o-decor-divider"></div>
			</div>
		<?endif?>

		<div class="o-container@xl c-poetry-section-carousel__container">
			<?/** START: Swiper main container */?>
			<div class="swiper-container c-poetry-section-carousel__swiper-container js-poetry-section-carousel">
				<?/** START: Additional required wrapper */?>
				<div class="swiper-wrapper">
					<?/** START: Slides */?>
					<?foreach( $arResult['LIST'] as $arItem ):?>
						
						<div class="swiper-slide c-poetry-section-carousel__swiper-slide">
							<?/** START: Poetry section item */?>
							<div class="o-image-stack o-image-stack--animated c-poetry-section-item">
								<div class="o-image-stack__container">
									<?
									if( $arItem['PICTURE']['SRC'] )
										$picture = $arItem['PICTURE']['SRC'];
									else
										$picture = SITE_TEMPLATE_PATH.'/assets/images/placeholder/poetry-placeholder.svg';
									?>
									<img class="o-image-stack__img c-poetry-section-item__img" src="<?=$picture?>" alt="<?=$arItem['NAME']?>">
									<img class="o-image-stack__img c-poetry-section-item__img" src="<?=$picture?>" alt="<?=$arItem['NAME']?>">
									<img class="o-image-stack__img c-poetry-section-item__img" src="<?=$picture?>" alt="<?=$arItem['NAME']?>">
								</div>
								<div class="c-poetry-section-item__body">
									<h3 class="c-poetry-section-item__title">
										<a class="o-stretched-link c-poetry-section-item__link" href="<?=$arItem['SECTION_PAGE_URL']?>"><?=$arItem['NAME']?></a>
									</h3>
									<?if( $arItem['UF_YEAR'] ):?>
										<time class="c-poetry-section-item__date" datetime="<?=$arItem['UF_YEAR']?>"><?=$arItem['UF_YEAR']?></time>
									<?endif?>
								</div>
							</div>
							<?/** END: Poetry section item */?>
						</div>
						
					<?endforeach?>

					<!-- START: Конечный слайд -->
					<?if ( count($arResult['OTHER_LIST']) >= 1 ) :?>
						<div class="swiper-slide c-poetry-section-carousel__swiper-slide">
							<?/** START: Poetry section item */?>
							<div class="o-image-stack c-poetry-section-item c-poetry-section-item--ending">
								<div class="o-image-stack__container">
									<div class="o-image-stack__img c-poetry-section-item__holder"></div>
									<div class="o-image-stack__img c-poetry-section-item__holder"></div>
									<div class="o-image-stack__img c-poetry-section-item__holder"></div>
								</div>
								<div class="c-poetry-section-item__body">
									<h3 class="c-poetry-section-item__title">Другое</h3>
	
									<ul class="c-poetry-section-item-list c-poetry-section-item__list">
										<?foreach( $arResult['OTHER_LIST'] as $arItem ):?>
											<li class="c-poetry-section-item-list__item">
												<a class="c-poetry-section-item-list__link" href="<?=$arItem['SECTION_PAGE_URL']?>"><?=$arItem['NAME']?></a>
											</li>
										<?endforeach?>
									</ul>
								</div>
							</div>
							<?/** END: Poetry section item */?>
						</div>
					<?endif?>
					<!-- END: Конечный слайд -->

					<?/** END: Slides */?>
				</div>
				<?/** END: Additional required wrapper */?>
			</div>
			<?/** END: Swiper main container */?>
		</div>
	</div>
<?endif?>
