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
		<?//apre($section, $section['NAME'])?>
		<section
			class="
				c-dynamic-banner
				c-dynamic-banner--size-lg
				c-dynamic-banner--density-compact
				c-dynamic-banner--center-body@lg
				c-dynamic-banner--split-reverse@lg
				c-dynamic-banner--displaced-reverse@xl
				c-catalog-mixed-list__dynamic-banner
			"
			id="catalog-section-<?=$section['CODE']?>"
		>
			<div class="o-container@lg c-dynamic-banner__container">
				<div class="c-dynamic-banner__layout">
					<div class="c-dynamic-banner__media c-dynamic-banner__media--align-center">
						<div
							class="o-bg-holder c-dynamic-banner__media-bg-holder"
							style="background-image: url(/upload/images/backgrounds/bg-plus-grid-color-primary-01.svg);"
						></div>

						<? // START: Picture ?>
						<?
						if ( $section['DETAIL_PICTURE'] )
							$image = CFile::GetFileArray($section['DETAIL_PICTURE']);
							$picture = $image['SRC'];

						if ( !$picture )
							$picture = '/upload/images/renders/render-molecule.png';
						?>

						<?if ($picture):?>
							<picture class="c-picture c-dynamic-banner__picture">
								<img
									class="c-picture__img c-picture__img--contain c-dynamic-banner__img"
									src="<?=$picture?>"
									alt="<?=$section['NAME']?>"
								>
							</picture>
						<?endif?>
						<? // END: Picture ?>
					</div>

					<div class="c-dynamic-banner__body">
						<h2 class="c-dynamic-banner__title">
							<?=$section['NAME']?>
						</h2>

						<p class="c-dynamic-banner__text">
							<?=$section['DESCRIPTION']?>
						</p>

						<div class="c-dynamic-banner__btn-group">
							<?// START: Button ?>
							<a
								class="c-btn c-btn--kind-primary c-btn--size-lg c-dynamic-banner__btn"
								href="<?=$section['SECTION_PAGE_URL']?>#productList"
							>
								<span class="c-btn__overlay"></span>
								<span class="c-btn__content">
									Перейти в каталог
								</span>
							</a>
							<?// END: Button ?>
						</div>
					</div>
				</div>
			</div>
		</section>

		<div class="c-app-section c-app-section--density-comfortable u-bg-light-mint-lighten-2">
			<div class="c-app-section__body">
				<div class="o-container@lg">
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
		</div>
	<?endforeach?>
</div>
