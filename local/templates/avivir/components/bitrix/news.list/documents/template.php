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
	<div class="c-file-list">
		<?foreach ( $arResult['ITEMS'] as $arItem ) :?>
			<div class="c-file-list--item">
				<?if ( $arItem['FILE'] ) :?>
					<a href="<?=$arItem['FILE']?>" target="_blank">
						<?=$arItem['NAME']?>
					</a>
				<?else:?>
					<?=$arItem['NAME']?>
				<?endif?>
			</div>
		<?endforeach?>
	</div>
<?endif?>