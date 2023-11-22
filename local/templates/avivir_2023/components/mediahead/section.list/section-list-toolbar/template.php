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
?>

<?if( count($arResult['SECTIONS']) >= 1 ):?>

	<nav class="c-section-list-toolbar">
		<div class="o-container@md c-section-list-toolbar__container">
			<div class="c-section-list-toolbar__scroller">
				<ul class="c-section-list-toolbar-nav c-section-list-toolbar__nav">

					<?//apre($APPLICATION->GetCurPage())?>

					<?if (!$arParams["HIDE_ALL_LINK"]):?>
						<li class="c-section-list-toolbar-nav__item">
							<?// START: Chip ?>
							<a
								class="
									c-chip
									c-chip--kind-outline-primary
									c-chip--size-sm
								"
								href="<?=$arResult['SECTIONS']['0']['LIST_PAGE_URL']?>"
							>
								<span class="c-chip__overlay"></span>
								<span class="c-chip__content">
									Все
								</span>
							</a>
							<?// END: Chip ?>
						</li>
					<?endif?>

					<?foreach( $arResult['SECTIONS'] as $arItem ):?>

						<?
						if ( $arItem['SECTION_PAGE_URL'] == $APPLICATION->GetCurPage() ) {
							$active = 'c-chip--kind-primary';
						} else {
							$active = 'c-chip--kind-outline-primary';
						}
						?>

						<li class="c-section-list-toolbar-nav__item">
							<?// START: Chip ?>
							<a
								class="
									c-chip
									<?=$active?>
									c-chip--size-sm
								"
								href="<?=$arItem['SECTION_PAGE_URL']?>"
							>
								<span class="c-chip__overlay"></span>
								<span class="c-chip__content">
									<?=$arItem['NAME']?>
								</span>
							</a>
							<?// END: Chip ?>
						</li>

					<?endforeach?>

				</ul>
			</div>
		</div>
	</nav>

<?endif?>
