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

// На основе шаблона media-section-carousel на сайте Levitansky.ru

//apre( $arResult );
?>

<?if( count($arResult['SECTIONS']) >= 1 ):?>
	<ul class="c-catalog-section-list">
		<?foreach( $arResult['SECTIONS'] as $arItem ):?>
			<li class="c-catalog-section-list__item">
				<?// START: Catalog section card ?>
				<div class="c-catalog-section-card u-bg-secondary-darken-2">
					<div
						class="o-bg-holder c-catalog-section-card__bg-holder"
						style="background-image: url(/upload/images/catalog/catalog-section-card-bg-holder-00.svg);"
					></div>

					<?
					$picture = false;

					if( $arItem['UF_SVG'] )
					{
						$svg = CFile::GetFileArray($arItem['UF_SVG']);
						$picture = $svg['SRC'];
					}
					else
					{
						$picture = '/upload/images/catalog/catalog-section-card-00.svg';
					}
					?>

					<?if (!empty($picture)):?>
						<div class="c-catalog-section-card__media">
							<picture class="c-picture o-ratio o-ratio--1x1 c-catalog-section-card__picture">
								<img class="c-picture__img c-picture__img--contain c-media-section-item__img" src="<?=$picture?>" alt="<?=$arItem['NAME']?>">
							</picture>
						</div>
					<?endif?>

					<div class="c-catalog-section-card__body">
						<a class="o-stretched-link c-catalog-section-card__link c-catalog-section-card__title u-text-primary" href="#catalog-section-<?=$arItem['CODE']?>">
							<?=$arItem['NAME']?>
						</a>
					</div>
				</div>
				<?// END: Catalog section card ?>
			</li>
		<?endforeach?>
	</ul>
<?endif?>
