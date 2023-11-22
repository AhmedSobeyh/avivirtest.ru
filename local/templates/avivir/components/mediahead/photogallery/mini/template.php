<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);

//apre($arResult["ITEMS"]);
?>

<?if( count($arResult["ITEMS"]) >= 1 ):?>

	<?// START: Photo gallery carousel?>
	<div class="c-photo-gallery-carousel">
		<?// START: Carousel container?>
		<div class="c-carousel c-photo-gallery-carousel__carousel t-light" id="photoGalleryCarousel">
			<?// START: Additional required inner?>
			<div class="c-carousel__inner">

				<?// START: Items?>
				<?foreach($arResult["ITEMS"] as $key => $item):?>
					<div class="c-carousel__item c-photo-gallery-carousel__item">
						<div class="c-photo-gallery-carousel-item">
							<?if($arParams["USE_ZOOM"]):?>
								<a class="c-photo-gallery-carousel-item__link" href="<?=$item['DATA']['BIG']?>">
							<?endif?>

							<picture class="o-ratio o-ratio--4x3 c-photo-gallery-carousel-item__picture">
								<img
									class="c-photo-gallery-carousel-item__img"
									src="<?=$item['DATA']['MINI']['SRC']?>"
									alt="<?=$item["DATA"]["DESC"]?>"
								/>
							</picture>

							<?if($arParams["USE_ZOOM"]):?>
								</a>
							<?endif?>
						</div>
					</div>
				<?endforeach?>
				<?// END: Items?>
			</div>
			<?// END: Additional required inner?>

			<?if( count($arResult["ITEMS"]) > 1 ):?>
				<div class="c-photo-gallery-carousel__nav">
					<div class="c-carousel-btn c-carousel-btn--prev c-photo-gallery-carousel__btn"></div>
					<div class="c-carousel-pagination c-photo-gallery-carousel__pagination"></div>
					<div class="c-carousel-btn c-carousel-btn--next c-photo-gallery-carousel__btn"></div>
				</div>
			<?endif?>

		</div>
		<?// END: Carousel container?>
	</div>
	<?// END: Photo gallery carousel?>

<?endif?>
