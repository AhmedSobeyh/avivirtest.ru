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

	<section class="c-test-kit-partner-action__section">
		<div class="o-container@lg c-test-kit-partner-action__container">
			
			<?if (!empty($section) || !empty($arParams['HEADER'])):?>
				<div class="c-test-kit-partner-action__header">
					<h2 class="c-test-kit-partner-action__title">
						<?=$arParams['HEADER'] ?? $section['NAME']?>
					</h2>
				</div>
			<?endif?>	

			<div class="c-test-kit-partner-action__body">
				<ul class="c-test-kit-partner-action__list">
					<?foreach($arResult['ITEMS'] as $arItem):?>
						<li class="c-test-kit-partner-action__item">
							<div class="c-partner-card">
								<div class="c-partner-card__media">
									<picture class="o-ratio o-ratio--4x3 c-partner-card__picture">
										<img
										class="c-partner-card__img"
										src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>"
										alt="<?=$arItem['NAME']?>"
										/>
									</picture>
								</div>

								<a
									class="o-stretched-link c-partner-card__link"
									href="<?=$arItem['PROPERTIES']['WEBSITE']['VALUE']?>"
									target="_blank"
									rel="noopener noreferrer"
									title="<?=$arItem['NAME']?>"
									aria-label="<?=$arItem['NAME']?>"
								></a>
							</div>
						</li>
					<?endforeach?>
				</ul>
			</div>
		</div>
	</section>
		
	
<?endif?>
