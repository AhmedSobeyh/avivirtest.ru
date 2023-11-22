<?

$l=mb_strtoupper(LANGUAGE_ID);

foreach($arResult['SLIDERS'] as $arSliders) {
	foreach($arResult['PROP'] as $arProps) {
		// Интервал для слайдера
		if($arProps['PROPERTY_INTERVAL_VALUE']) {
			$intervalTime = $arProps['PROPERTY_INTERVAL_VALUE'];
		} else {
			$intervalTime = 4000;
		}

		// Остановка слайдера
		$loopSlide = true;
		if(count($arSliders['SLIDES']) <= 1) {
			$loopSlide = false;
			$disabledArrows = 'style="display: none"';
		};
		
		// Тема слайдера
		if($arProps['PROPERTY_THEME_VALUE'] == 'Темная' || $arProps['PROPERTY_THEME_VALUE'] == '' )
		{
			$themeStyle = 't-dark u-bg-secondary';
		} else {
			$themeStyle = 'u-bg-light-mint';
		}
		
?>

<?if($arSliders):?>
	<section class="c-app-section c-app-section--density-comfortable <?=$themeStyle?> c-cta c-cta-target" >
		<div class="c-app-section__body">
			<?// START: Cta list carousel ?>
			<div class="c-cta-list-carousel" data-time-slider="<?=$intervalTime?>" data-loop-slider="<?=$loopSlide?>">
				<?// START: Carousel main container ?>
				<div class="c-carousel c-cta-list-carousel__carousel js-cta-list-carousel" >
					<?// START: Additional required wrapper ?>
					<div class="c-carousel__inner">
						<?// START: Slides ?>
							<?foreach($arSliders['SLIDES'] as $Slide) {	?>
							<div class="c-carousel__item c-cta-list-carousel__item">
								<div class="c-cta-list-carousel-item">
									<div class="c-cta__layout">
										<div class="c-cta__media">
											<? // START: Picture ?>
											<? $picture = $Slide['PROPERTY_'.$l.'_PIC_VALUE'] ? CFile::GetPath($Slide['PROPERTY_'.$l.'_PIC_VALUE']) : '/upload/images/renders/render-molecule.png';?>
											<?if ($picture):?>
												<picture class="c-picture o-ratio o-ratio--1x1 c-cta__picture">
													<img
														class="c-picture__img c-picture__img--contain"
														src="<?=$picture?>"
														alt="<?=$Slide['PROPERTY_'.$l.'_TITLE_VALUE'];?>"
													/>
												</picture>
											<?endif?>
											<? // END: Picture ?>
										</div>
										<div class="c-cta__body">
											<?// START: Title ?>
											<?if($Slide['PROPERTY_'.$l.'_TITLE_VALUE']):?>
												<h2 class="c-cta__title">
													<?=$Slide['PROPERTY_'.$l.'_TITLE_VALUE'];?>
												</h2>
											<?endif?>
											<?// END: Title ?>
											<?if($Slide['PROPERTY_'.$l.'_TEXT_VALUE']['TEXT']):?>
												<p class="c-cta__text">
													<?=$Slide['PROPERTY_'.$l.'_TEXT_VALUE']['TEXT'];?>
												</p>
											<?endif?>
											<?// START: Button ?>
											<?if($Slide['PROPERTY_'.$l.'_URL_VALUE'] && $Slide['PROPERTY_'.$l.'_BUTTON_VALUE'] ):?>
												<a
													class="c-btn c-btn--kind-primary c-btn--size-lg c-cta__btn"
													href="<?=$Slide['PROPERTY_'.$l.'_URL_VALUE'];?>" target="_blank"
												>
													<span class="c-btn__overlay"></span>
													<span class="c-btn__content">
														<?=$Slide['PROPERTY_'.$l.'_BUTTON_VALUE'];?>
													</span>
												</a>
											<?endif?>
											<?// END: Button ?>
										</div>
									</div>
								</div>
							</div>
							<? } ?>
						<?// END: Slides ?>
					</div>
					<button class="c-carousel__btn c-carousel__btn--prev c-carousel__btn--light
					c-cta-list-carousel-fullscreen__btn" <?=$disabledArrows?>></button>

					<div class="c-carousel-pagination c-cta-list-carousel-fullscreen__pagination c-carousel-pagination--clickable"></div>

					<button class="c-carousel__btn c-carousel__btn--next  c-carousel__btn--light
					c-cta-list-carousel-fullscreen__btn
					"<?=$disabledArrows?>></button>
					<?// END: Additional required wrapper ?>
				</div>
				<?// START: Carousel main container ?>
			</div>
			<?// END: Cta list carousel ?>
		</div>
	</section>
<?endif?>
<? } ?>
<? } ?>