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

<div class="c-audio-list" <?=!$arResult["HEAD"]["IMAGE"]["src"] ? 'style="padding-top: 0;"' : ''?>> 
	<div class="o-container@md c-audio-list__container">
		<div class="c-audio-list__layout" <?=!$arResult["HEAD"]["IMAGE"]["src"] ? 'style="padding-top: 0;"' : ''?>>
			
			<?if ($arResult["HEAD"]["IMAGE"]["src"]):?>
				<div class="o-embed-responsive o-embed-responsive--1by1 c-audio-list__cover">
					<img class="o-embed-responsive__item c-audio-list__img" src="<?=$arResult["HEAD"]["IMAGE"]["src"]?>" />
				</div>
			<?endif?> 

			<div class="c-audio-list__body">
				<p class="c-audio-list__lead"><?=$arResult["HEAD"]["DESCRIPTION"]?></p>

				<ul class="c-audio-list__list">

					<?foreach($arResult["AUDIO"] as $i => $arItem):?>

						<li class="c-audio-list-item c-audio-list__item">

							<a name="<?=$arItem["CODE"]?>"></a>

							<div name="<?=$arItem["CODE"]?>" class="c-audio-list-item__title">
								<?=$arItem["NAME"]?>
							</div>

							<div class="c-audio-list-item__container">
								<div class="c-audio-list-item__player">
									<?$next = count($arResult["AUDIO"]) == $i + 1 ? 0 : $i + 1?>
									<?$prev = $i == 0 ? count($arResult["AUDIO"]) - 1 : $i - 1?>

									<audio width="100%" controls="controls" preload="metadata" data-next="<?=$next?>" data-prev="<?=$prev?>" src="<?=$arItem["SRC"]?>" type="audio/mp3">
										<track src="<?=$arItem["SRC"]?>" label="<?=$arItem["NAME"]?>" srclang="ru" />
									</audio>
								</div>

								<a href="<?=$arItem["SRC"]?>" target="_blank" class="c-audio-list-item-download c-audio-list-item-download__link c-audio-list-item__download" download="<?=$arItem['NAME']?>.mp3">
									<span class="c-audio-list-item-download__icon"></span>mp3
								</a>
							</div>
						</li>

					<?endforeach?>

				</ul>
			</div>
		</div>
	</div>
</div>

<?if( $arParams["DISPLAY_BOTTOM_PAGER"] ):?>
	<?=$arResult["NAV_STRING"]?>
<?endif?>
