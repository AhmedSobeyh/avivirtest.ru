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

// apre($arResult, 'mixed result');

?>

<div class="c-vaccine-mixed-list">
	<?foreach($arResult['TREE'] as $section):?>
		<section
			class="c-app-section c-app-section--density-comfortable u-bg-light-mint-lighten-2"
			id="vaccines-section-<?=$section['CODE']?>"
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
					<span class="c-vaccine-mixed-list__title"></span>

					<ul class="c-vaccine-mixed-list__layout">

						<?foreach($section['ELEMENTS'] as $item):?>
							<li class="c-vaccine-mixed-list__item">
								<div class="c-vaccine-card">
									<?if( $item['PREVIEW_PICTURE']['SRC'] )
										$itemPicture = $item['PREVIEW_PICTURE']['SRC'];

									else
										$itemPicture = '/upload/images/renders/render-molecule.png';
									?>
									<div class="c-vaccine-card__media">
										<picture class="c-picture o-ratio o-ratio--21x9">
											<img class="c-picture__img c-picture__img--contain c-vaccine-card__img" src="<?=$itemPicture?>" />
										</picture>
									</div>

                                    <div class="c-vaccine-card__body">
										<p class="c-vaccine-card__text">
											<a class="o-stretched-link c-vaccine-card__text-link" href="<?=$item['DETAIL_PAGE_URL']?>">
												<?=mb_substr($item['PREVIEW_TEXT'], 0, 100);?>...
											</a>
										</p>
									</div>
								</div>
							</li>
						<?endforeach?>

					</ul>
				</div>
			</div>
		</section>
	<?endforeach?>
</div>
