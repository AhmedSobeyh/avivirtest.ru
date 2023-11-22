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
$section = $arResult['SECTION']['PATH'][0];
?>

<?if( count($arResult["ITEMS"]) >= 1 ):?>

	
	<section class="c-main-company c-main-page__company">
		<div class="o-container@lg">
			<?if (!empty($section) || !empty($arParams['HEADER'])):?>
				<div class="c-main-company__header">
					<h2 class="c-main-company__title">
						<?=$arParams['HEADER'] ?? $section['NAME']?>
					</h2>
				</div>
			<?endif?>	

			<div class="c-main-company__body">
				<div class="c-company-card-list">
					<ul class="c-company-card-list__layout">
						
						<?foreach($arResult['ITEMS'] as $arItem):?>
							<li class="c-company-card-list__item">
								<div class="c-company-card">
									<div class="c-company-card__media">
										<picture class="o-ratio o-ratio--3x1 c-company-card__picture">
											<img
											class="c-company-card__img"
											src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>"
											alt="<?=$arItem['NAME']?>"
											/>
										</picture>
									</div>

									<div class="c-company-card__body">
										<h3 class="c-company-card__title">
											<a
												class="o-stretched-link c-company-card__link"
												href="<?=$arItem['DETAIL_PAGE_URL']?>"
											>
												<?=$arItem['PROPERTIES']['SUBTEXT']['VALUE']?>
											</a>
										</h3>
									</div>
								</div>
							</li>
						<?endforeach?>
					</ul>
				</div>
			</div>
		</div>
	</section>	
	
<?endif?>
