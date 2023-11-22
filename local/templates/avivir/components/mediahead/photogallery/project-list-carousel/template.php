<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);

//apre($arResult["ITEMS"]);
?>

<?if( count($arResult["ITEMS"]) >= 1 ):?>
	<?// START: Project list carousel?>
	<div class="c-project-list-carousel">
		<?// START: Carousel container?>
		<div class="c-carousel c-project-list-carousel__carousel t-light" id="projectListCarousel">
			<?// START: Additional required inner?>
			<div class="c-carousel__inner">

				<?// START: Items?>
				<?foreach($arResult["ITEMS"] as $key => $item):?>
					<div class="c-carousel__item c-project-list-carousel__item">

						<?if($arParams["USE_ZOOM"]):?>
							<a href="<?=$item['DATA']['BIG']?>" data-fancybox="gallery">
						<?endif?>

							<div class="c-project-list-carousel-item">
								<picture class="c-project-list-carousel-item__media">

									<img
										class="c-project-list-carousel-item__img"
										src="<?=$item['DATA']['MINI']['SRC']?>"
										alt="<?=$item["DATA"]["DESC"]?>"
									>

								</picture>

								<!-- <div class="c-project-list-carousel-item__body">
									<h3 class="c-project-list-carousel-item__title">
										<?//=$item["DATA"]["DESC"]?>
									</h3>
									<span class="c-project-list-carousel-item__subtitle">
										Санкт-Петебург
									</span>
								</div> -->
							</div>

						<?if($arParams["USE_ZOOM"]):?>
							</a>
						<?endif?>
					</div>
				<?endforeach?>
				<?// END: Items?>
			</div>
			<?// END: Additional required inner?>

			<div class="c-project-list-carousel__nav">

				<?if( count($arResult["ITEMS"]) > 1 ):?>
					<div class="c-carousel-btn c-carousel-btn--prev c-project-list-carousel__btn"></div>
					<div class="c-carousel-pagination c-project-list-carousel__pagination"></div>
					<div class="c-carousel-btn c-carousel-btn--next c-project-list-carousel__btn"></div>
				<?endif?>

				<?// START: Button ?>
				<!-- <button
					class="
						c-btn
						c-btn--kind-primary
						c-btn--size-lg
						c-project-list-carousel__action-btn
					"
				>
					<span class="c-btn__overlay"></span>
					<span class="c-btn__content">
						Все проекты
					</span>
				</button> -->
				<?// END: Button ?>
			</div>

		</div>
		<?// END: Carousel container?>
	</div>
	<?// END: Project list carousel?>
<?endif?>
