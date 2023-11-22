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
// apre($arResult["VIDEO"])
?>

<div class="c-video-list">
	<div class="o-container@md c-video-list__container">
		<ul class="c-video-list__layout">
			<?//apre($arResult['ITEMS'],'videoItems'); ?>
			<?foreach($arResult["VIDEO"] as $arItem):?>

				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				$section = false;
				if ($arItem['SECTION_ID'])
					$section = $arResult['SECTIONS'][$arItem['SECTION_ID']];
				?>

				<li class="c-video-list__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>" name="<?=$arItem["CODE"]?>">
					<a name="<?=$arItem["CODE"]?>"></a>  
					<div class="c-video-list-item">
						<video poster="<?=$arItem['POSTER']?>" preload="metadata">
							<source src="<?=str_replace('https:','',$arItem['SRC'])?>" type="video/youtube" />
						</video>

						<div class="c-video-list-item__body">
							<h3 class="c-video-list-item__title">
								<?=$arItem['NAME']?>
							</h3>
							<p class="c-video-list-item__text">
								<?=$arItem["PREVIEW_TEXT"];?>
							</p>
						</div>
					</div>
				</li>

			<?endforeach?>

		</ul>
	</div>
</div>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>
