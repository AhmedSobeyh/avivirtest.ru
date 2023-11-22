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

//apre($arResult["ITEMS"]);
?>

<?if( count($arResult["ITEMS"]) >= 1 ):?>
	<?// START: Partner list carousel ?>
	<div class="c-partner-list-carousel">
		<?// START: Carousel main container ?>
		<div class="c-carousel c-partner-list-carousel__carousel js-partner-list-carousel">
			<?// START: Additional required wrapper ?>
			<div class="c-carousel__inner">
				<?// START: Slides ?>
				<?foreach($arResult['ITEMS'] as $arItem):?>
					<div class="c-carousel__item c-partner-list-carousel__item">
						<div class="c-partner-list-carousel-item">
							<div
								class="c-partner-list-carousel-item__media c-partner-list-carousel-item__link"
							>
								<picture class="c-picture o-ratio o-ratio--1x1 c-partner-list-carousel-item__picture">
									<img
										class="c-picture__img c-picture__img--contain"
										src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>"
										alt="<?=$arItem['NAME']?>"
									>
								</picture>
							</div>

							<?// Заменить на ссылку ?>

							<!-- <a
								class="c-partner-list-carousel-item__media c-partner-list-carousel-item__link"
								href="<?=$arItem['DETAIL_PAGE_URL']?>"
							>
								<picture class="c-picture o-ratio o-ratio--1x1 c-partner-list-carousel-item__picture">
									<img
										class="c-picture__img c-picture__img--contain"
										src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>"
										alt="<?=$arItem['NAME']?>"
									>
								</picture>
							</a> -->
						</div>
					</div>
				<?endforeach?>
				<?// END: Slides ?>
			</div>
			<?// END: Additional required wrapper ?>
		</div>
		<?// END: Carousel main container ?>
	</div>
	<?// END: Partner list carousel ?>
<?endif?>
