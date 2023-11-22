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
<?if ($arResult['LETTERS']):?>

	<?$alph = array_keys($arResult['LETTERS']);?>
	<?foreach($alph as $letter):?>
		<a href="#<?=$letter?>"><?=$letter?></a> 
	<?endforeach?> 
	
	<?foreach($arResult["LETTERS"] as $letter => $arItems):?>
	
		<h2><a name="<?=$letter?>"><?=$letter?></a></h2> 
		
		<?foreach($arItems as $arItem):?> 
		
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<div class="" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			
				<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
					<div class="bx-newslist-title">
						<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
							<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a>
						<?else:?>
							<?echo $arItem["NAME"]?>
						<?endif;?>
						
						<?if($arItem["AUDIO"]):?>
							<span class="audio">[есть аудио]</span>
						<?endif;?>
						
						<?if($arItem["VIDEO"]):?>
							<span class="audio">[есть видео]</span>
						<?endif;?>  
						
					</div>
				<?endif;?>
				
				<?/*if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
					<div class="">
						<?echo $arItem["PREVIEW_TEXT"];?><br /><br />
					</div>
				<?endif;*/?>
				
				
				
				
			</div>
		
		<?endforeach?>
	
	<?endforeach?>
	

<?else:?>

<div class="row">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
	
		<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
			<h3 class="bx-newslist-title">
				<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
					<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a>
				<?else:?>
					<?echo $arItem["NAME"]?>
				<?endif;?>
			</h3>
		<?endif;?>
		<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
			<div class="">
			<?echo $arItem["PREVIEW_TEXT"];?>
			</div>
		<?endif;?>
		
		
	</div>

<?endforeach;?>
</div>

<?endif?>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>

