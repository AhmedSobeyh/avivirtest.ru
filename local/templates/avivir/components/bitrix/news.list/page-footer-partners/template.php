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

	<?// START: Page footer partners list ?>
	<ul class="c-page-footer-partner-list">

			<?foreach($arResult["ITEMS"] as $arItem):?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>

				<li class="c-page-footer-partner-list__item" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
					<?if( $arItem["PROPERTIES"]["LINK"]["VALUE"] ):?>
						<a class="c-page-footer-partner-list__link" href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>">
							<img class="c-page-footer-partner-list__img" src="<?=$arItem['DETAIL_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>" />
						</a>
					<?else:?>
						<img class="c-page-footer-partner-list__img" src="<?=$arItem['DETAIL_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>" />
					<?endif?>
				</li>
			<?endforeach?>

			<li class="c-page-footer-partner-list-more c-page-footer-partner-list__item">
				<a class="c-page-footer-partner-list-more__link" href="/partners/">Все партнеры</a>
			</li>
	</ul>
	<?// END: Page footer partners list ?>

<?endif?>
