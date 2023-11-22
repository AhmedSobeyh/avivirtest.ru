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

<div class="c-biblio-list">
	<div class="o-container@md c-biblio-list__container">
		<?if ($arParams["HEADER"]):?>
			<h2 class="c-biblio-list__title">
				<?if ($arParams["HEADER_LINK"]):?>
					<a href="<?=$arParams["HEADER_LINK"]?>"><?=$arParams["HEADER"]?></a>
				<?else:?>
					<?=$arParams["HEADER"]?>
				<?endif?>
			</h2>
		<?endif?>

		<ul class="c-biblio-list__layout">

			<?foreach($arResult["ITEMS"] as $arItem):?>

				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				$section = false;
				if ($arItem['SECTION_ID'])
					$section = $arResult['SECTIONS'][$arItem['SECTION_ID']];
				?>

				<li class="c-biblio-list__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
					<article class="c-biblio-list-item">
						<div class="o-embed-responsive o-embed-responsive--3by4 c-biblio-list-item__media"><?
							if( $arItem['PREVIEW_PICTURE']['SRC'])
								$picture =$arItem['PREVIEW_PICTURE']['SRC'];
							else
								$picture = SITE_TEMPLATE_PATH.'/assets/images/placeholder/person-placeholder.svg';
							?>
							<img class="o-embed-responsive__item c-biblio-list-item__img" src="<?=$picture?>" alt="<?=$arItem["NAME"]?>">
						</div>

						<div class="c-biblio-list-item__container">
							<header class="c-biblio-list-item__header">
								<h2 class="c-biblio-list-item__title">
									<a class="o-stretched-link c-biblio-list-item__title-link" href="<?=$arItem["DETAIL_PAGE_URL"]?>">
										<?=$arItem["NAME"]?>
									</a>
								</h2>
							</header>

							<div class="c-biblio-list-item__body">
								<div class="c-biblio-list-item__text">
									<?=$arItem["PREVIEW_TEXT"];?>
								</div>
							</div>

							<footer class="c-biblio-list-item__footer">
								<?if ($section):?>
									<a class="c-biblio-list-item__section-link" href="<?=$section['SECTION_PAGE_URL']?>"><?=$section['NAME']?></a>
								<?endif?>

								<?if ($arItem['MINUTS']):?>
									<span class="c-biblio-list-item__reading-time">
										<?=$arItem["MINUTS"]?> минут
									</span>
								<?endif?>

								<?if ($arItem['PROPERTIES']['SERIES']['VALUE']):?>
									<time class="c-biblio-list-item__date">Серия: <?=$arItem['PROPERTIES']['SERIES']['VALUE']?>,</time>
								<?endif?>	

								<?if ($arItem['PROPERTIES']['PUBLISHER']['VALUE']):?>
									<time class="c-biblio-list-item__date">Издательство: <?=$arItem['PROPERTIES']['PUBLISHER']['VALUE']?></time>
								<?endif?>
								
								<?if ($arItem['PROPERTIES']['YEAR']['VALUE']):?>
									<time class="c-biblio-list-item__date"><?=$arItem['PROPERTIES']['YEAR']['VALUE']?> г.</time>
								<?endif?>

								
							</footer> 
						</div>
					</article>
				</li>

			<?endforeach?>

		</ul>

		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
			<?=$arResult["NAV_STRING"]?>
		<?endif;?>
	</div>
</div>
