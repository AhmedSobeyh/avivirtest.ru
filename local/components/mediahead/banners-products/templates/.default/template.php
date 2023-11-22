<?

$l=mb_strtoupper(LANGUAGE_ID);

foreach($arResult['PRODUCTS'] as $arProducts) {

	$loopSlide = true;
	if(count($arProducts['PRODUCTS']) <= 1) {
		$loopSlide = false;
		$disabledArrows = 'style="display: none"';
	};
	$intervalTime = 4000;
	
?>
<!-- Временное рещение  -->
<?if ($l === 'RU'):?>
<?if($arProducts):?>
	<section class="c-app-section c-catalog-product c-catalog-product-target u-bg-light-mint" >
		<div class="o-container@lg">
			<div class="c-app-section__header c-catalog-section-product-list__header">
				<h2 class="c-app-section__title c-catalog-section-product-list__title">Тесты COVID-19</h2>
			</div>
		</div>
		<div class="c-app-section__body">
			<?// START: Cta list carousel ?>
			<div class="c-catalog-product-carousel" data-time-slider="<?=$intervalTime?>" data-loop-slider="<?=$loopSlide?>">
				<?// START: Carousel main container ?>
				<div class="c-carousel c-catalog-product-carousel__carousel js-c-catalog-product-carousel" >
					<?// START: Additional required wrapper ?>
					<div class="c-carousel__inner">
						<?// START: Slides ?>
							<?foreach($arProducts['PRODUCTS'] as $Slide) {	?>
							<div class="c-carousel__item c-catalog-product-carousel__item">
								<div class="c-catalog-product-list__item c-catalog-product-list__item--сarousel">
									<div class="c-catalog-test-kit-card c-catalog-test-kit-card--carousel  c-catalog-test-kit-card--banner">
										<?if( $Slide['DETAIL_PICTURE']['SRC'] )
											$itemPicture = CFile::GetPath($Slide['DETAIL_PICTURE']);

										else
											$itemPicture = '/upload/images/catalog/catalog-section-page-header-00.png';
										?>

										<div class="c-catalog-test-kit-card__media">
											<picture class="o-ratio o-ratio--4x3 c-catalog-test-kit-card__picture">
												<img class="c-catalog-test-kit-card__img" src="<?=$itemPicture?>" alt="<?=$Slide['NAME'];?>" />
											</picture>
										</div>
										
										<div class="c-catalog-test-kit-card__body">
									
											<?
												$resBrand = CIBlockElement::GetByID($Slide['PROPERTIES']['BRAND']['VALUE']);
												if($ar_res = $resBrand->GetNext())
													$brand = $ar_res['NAME'];

											?>

											<?if ($brand):?>
												<span class="c-catalog-test-kit-card__brand">
													<?=$brand?>, <?=$Slide['PROPERTIES']['COUNTRY']['VALUE']?>
												</span>
											<?endif?>	

											<h3 class="c-catalog-test-kit-card__title">
												<a
													class="o-stretched-link c-catalog-test-kit-card__title-link"
													href="<?=$Slide['DETAIL_PAGE_URL']?>"
												>

												</a>
												<?=$Slide['NAME'];?>
											</h3>

											<p class="c-catalog-test-kit-card__text">
												<?=$Slide['PREVIEW_TEXT']?>
											</p>

											<?if ($Slide['PROPERTIES']['DETERMINES']['VALUE']):?>
												<span class="c-catalog-test-kit-card__determinant">
													<?=$Slide['PROPERTIES']['DETERMINES']['VALUE']?>
												</span>
											<?endif?>

											<?if ($Slide['PROPERTIES']['MINUTES']['VALUE']):?>
												<span class="c-catalog-test-kit-card__time">
													<?=$Slide['PROPERTIES']['MINUTES']['VALUE']?> <?=GetMessage("CT_BNL_MIN")?>
												</span>
											<?endif?>

											<?if ($Slide['PROPERTIES']['TEST_TYPE']['VALUE']):?>
												<span class="c-catalog-test-kit-card__type">
													<?=$Slide['PROPERTIES']['TEST_TYPE']['VALUE']?>
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
												Подробнее
											</span>
										</button>
										<?// END: Button ?>
									</div>
								</div>
							</div>

							<? } ?>
						<?// END: Slides ?>
					</div>
					<button class="c-carousel__btn c-carousel__btn--prev c-carousel__btn--light
					c-catalog-product-carousel-fullscreen__btn" <?=$disabledArrows?>></button>

					<div class="c-carousel-pagination c-catalog-product-carousel-fullscreen__pagination c-carousel-pagination--clickable"></div>

					<button class="c-carousel__btn c-carousel__btn--next  c-carousel__btn--light
					c-catalog-product-carousel-fullscreen__btn
					"<?=$disabledArrows?>></button>
					<?// END: Additional required wrapper ?>
				</div>
				<?// START: Carousel main container ?>
			</div>
			<?// END: Cta list carousel ?>
		</div>
	</section>
<?endif?>
<?endif?>
<? } ?>


