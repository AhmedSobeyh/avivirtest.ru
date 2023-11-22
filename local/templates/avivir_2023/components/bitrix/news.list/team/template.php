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

//apre( $arResult["ITEMS"] );
?>

<?if ( count($arResult["ITEMS"]) >= 1 ) :?>
	<div class="o-container@lg c-team-list">
		<?foreach ( $arResult['ITEMS'] as $arItem ) :?>
			<div class="c-team-list--item">
				
				<?if ( $arItem['DETAIL_PICTURE']['NEW_SRC'] ) :?>
					<div class="c-team-list--item--image">
						<img src="<?=$arItem['DETAIL_PICTURE']['NEW_SRC']?>" alt="<?=$arItem['NAME']?>" class="c-team-list--item--image-img" />
					</div>
				<?endif?>

				<div class="c-team-list--item--title">
					<?=$arItem['NAME']?>
				</div>

				<div class="c-team-list--item--regalia">
					<?=$arItem['REGALIA']?>
				</div>

			</div>
		<?endforeach?>
	</div>
<?endif?>