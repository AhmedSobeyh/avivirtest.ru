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

//apre($arResult, 'mixed result');

?>

<div class="c-catalog-mixed-list">
	<?foreach($arResult['TREE'] as $section):?>
		<section
			class="c-app-section c-app-section--density-comfortable u-bg-light-mint-lighten-2"
			id="<?=$section['CODE']?>"
		>
			<div class="c-app-section__header">
				<div class="o-container@lg">
					<h2 class="c-app-section__title">
					<?=$section['NAME']?>
					</h2>
				</div>
			</div>

			<div class="c-app-section__body">
				<div class="o-container@lg">
					<span class="c-catalog-mixed-list__title"></span>

					<ul class="c-catalog-mixed-list__layout">

						<?foreach($section['ELEMENTS'] as $item):?>
							<li class="c-catalog-mixed-list__item">
								<div class="c-catalog-product-card">
									<?if( $item['PREVIEW_PICTURE']['SRC'] )
										$itemPicture = $item['PREVIEW_PICTURE']['SRC'];

									else
										$itemPicture = '/upload/images/catalog/catalog-section-info-00.png';
									?>

									<div class="c-catalog-product-card__media">
										<picture class="o-ratio o-ratio--1x1 c-catalog-product-card__picture">
											<img class="c-catalog-product-card__img" src="<?=$itemPicture?>" />
										</picture>
									</div>

									<div class="c-catalog-product-card__body">
										<h3 class="c-catalog-product-card__title">
											<a class="o-stretched-link c-catalog-product-card__title-link" href="<?=$item['DETAIL_PAGE_URL']?>">
												<?=$item['NAME'];?>
											</a>
										</h3>
										<!-- <div><?=$item['PROPERTIES']['BRAND']['VALUE']?></div>
										<div>Тип: <?=$item['PROPERTIES']['TEST_TYPE']['VALUE']?></div> -->
									</div>

									<?//apre($item, 'товар')?>
								</div>
							</li>
						<?endforeach?>

					</ul>
				</div>
			</div>
		</section>
	<?endforeach?>
</div>
