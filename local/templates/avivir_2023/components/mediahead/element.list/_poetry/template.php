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

	<?/** START: Poetry alphabet navbar */?>
	<nav class="c-poetry-alphabet-navbar">
		<div class="o-container@md c-poetry-alphabet-navbar__container">
			<div class="c-poetry-alphabet-navbar__scroller">
				<ul class="c-poetry-alphabet-navbar__nav u-ff-secondary">
					<?foreach($alph as $letter):?>
						<li class="c-poetry-alphabet-navbar-nav__item">
							<a class="c-poetry-alphabet-navbar-nav__link" href="#<?=$letter?>"><?=$letter?></a>
						</li>
					<?endforeach?>
				</ul>
			</div>
		</div>
	</nav>
	<?/** END: Poetry alphabet navbar */?>

	<div class="o-container@md">
		<?/** START: Poetry letter list */?>
		<ul class="c-poetry-letter-list">

			<?/** Добавил исключения, чтобы по одному столбцу на строку не оставлять */?>
			<?$arExclusive = ['Г','И','Л','Н','О','Р','Ч','Я'];?>	

			<?foreach($arResult["LETTERS"] as $letter => $arItems):

				$skipCount = false;
				$containerClass = '';

				if(in_array($letter, $arExclusive)): 
					$containerClass = "c-poetry-letter-list__item--span-2@md c-poetry-letter-list__item--span-3@lg";
					$skipCount = true;
				endif;	
				
				if (!$skipCount):
					if(count($arItems) > 10 && count($arItems) < 21):
						$containerClass = "c-poetry-letter-list__item--span-2@md c-poetry-letter-list__item--span-2@lg";
					elseif (count($arItems) > 20):
						$containerClass = "c-poetry-letter-list__item--span-2@md c-poetry-letter-list__item--span-3@lg";
					endif;
				endif;?>
				
				<li class="c-poetry-letter-list-item c-poetry-letter-list__item <?=$containerClass?>">
					<h2 class="c-poetry-letter-list-item__title" id="<?=$letter?>"><?=$letter?></h2>

					<?/** START: Poetry list */?>
					<div class="c-poetry-list">
						<ul class="c-poetry-list__list">
							<?foreach($arItems as $arItem):?>

								<?
								$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
								$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
								?>

								<br>
								<li class="c-poetry-list-item c-poetry-list__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
									<div class="c-poetry-list-item__container">
										<a class="c-poetry-list-item__title" href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a>

										<?if($arItem["AUDIO"]):?>
											<a class="c-poetry-list-item__audio" href="<?echo $arItem["DETAIL_PAGE_URL"]?>#media" aria-label="Прослушать аудио"></a>
										<?endif;?>

										<?if($arItem["VIDEO"]):?>
											<a class="c-poetry-list-item__video" href="<?echo $arItem["DETAIL_PAGE_URL"]?>#media" aria-label="Просмотреть видео"></a>
										<?endif;?>

										<?if($arItem["TRANSLATE"]):?>
											<?foreach($arItem["TRANSLATE"] as $code => $translate):?>
												<a class="c-poetry-list-item__lang" href="<?echo $arItem["DETAIL_PAGE_URL"]?>#translate_<?=$code?>" aria-label="Перевод на <?=$translate["LANGNAME"]?> язык"><?=$code?></a>
											<?endforeach?>
										<?endif;?>

										<?if($arItem['PREVIEW_TEXT']):?>
											<br><span class="c-poetry-list-item__subtitle"><?=$arItem['PREVIEW_TEXT']?></span>
										<?endif;?>
									</div>

								</li>

							<?endforeach?>
						</ul>
					</div>
					<?/** END: Poetry list */?>
				</li>

			<?endforeach?>
		</ul>
		<?/** END: Poetry letter list */?>
	</div>

<?else:?>

	<?/** START: Poetry list */
	//apre($arParams);
	?>
	<div class="c-poetry-list <?if ($arParams["SORT_BY1"] == "RAND" || strlen($arParams["FILTER_HAS_CHECKED_VALUES"])):?>c-poetry-list--filtered<?endif?>">
		<div class="o-container@md c-poetry-list-container">

			<?if (strlen($arParams["HEADER"])):?>
				<h2 class="c-poetry-list__title"><?=$arParams["HEADER"]?></h2>
				<div class="o-decor-divider c-poetry-list__delimeter"></div>
			<?endif?>

			<?for ($i = 0; $i < count(array_chunk($arResult["ITEMS"], 30, true)); $i++):?>
				<?if ($i != 0):?>
					<div class="o-decor-divider c-poetry-list__delimeter"></div>
				<?endif?>

				<ul class="c-poetry-list__list c-poetry-list__list--2-cols@md c-poetry-list__list--3-cols@lg">
					<?foreach(array_chunk($arResult["ITEMS"], 30, true)[$i] as $arItem):?>

						<?
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
						?>

						<br>
						<li class="c-poetry-list-item c-poetry-list__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">

							<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>

								<div class="c-poetry-list-item__container">
									<a class="c-poetry-list-item__title" href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a>

									<?if($arItem["AUDIO"]):?>
										<a class="c-poetry-list-item__audio" href="<?echo $arItem["DETAIL_PAGE_URL"]?>#media" aria-label="Прослушать аудио"></a>
									<?endif;?>

									<?if($arItem["VIDEO"]):?>
										<a class="c-poetry-list-item__video" href="#" aria-label="Просмотреть видео"></a>
									<?endif;?>

									<?if($arItem["TRANSLATE"]):?>
										<?foreach($arItem["TRANSLATE"] as $code => $translate):?>
											<a class="c-poetry-list-item__lang" href="<?echo $arItem["DETAIL_PAGE_URL"]?>#translate_<?=$code?>" aria-label="Перевод на <?=$translate["LANGNAME"]?> язык"><?=$code?></a>
										<?endforeach?>
									<?endif;?>

									<?if($arItem['PREVIEW_TEXT']):?>
										<br><span class="c-poetry-list-item__subtitle"><?=$arItem['PREVIEW_TEXT']?></span>
									<?endif;?>
								</div>

							<?endif;?>

						</li>

					<?endforeach?>
				</ul>
			<?endfor?>

			<?if ($arParams["SORT_BY1"] == "RAND"):?>
				<div class="o-decor-divider c-poetry-list__delimeter"></div>
			<?endif?>

		</div>
	</div>
	<?/** END: Poetry list */?>

<?endif?>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>
