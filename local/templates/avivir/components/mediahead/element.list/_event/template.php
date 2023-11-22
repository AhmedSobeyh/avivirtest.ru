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

<div class="c-event-list">
	<div class="o-container@md c-event-list__container">
		<?if ($arParams["HEADER"]):?>
			<h2 class="c-event-list__title">
				<?if ($arParams["HEADER_LINK"]):?>
					<a href="<?=$arParams["HEADER_LINK"]?>"><?=$arParams["HEADER"]?></a>
				<?else:?>
					<?=$arParams["HEADER"]?>
				<?endif?>
			</h2>
		<?endif?>

		<ul class="c-event-list__layout">

			<?foreach($arResult["ITEMS"] as $arItem):?>

				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				$section = false;
				if ($arItem['SECTION_ID'])
					$section = $arResult['SECTIONS'][$arItem['SECTION_ID']];
				?>

				<li class="c-event-list__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
					<article class="c-event-list-item">
						<div class="o-embed-responsive o-embed-responsive--4by3 c-event-list-item__media"><?
							if( $arItem['PREVIEW_PICTURE']['SRC'])
								$picture =$arItem['PREVIEW_PICTURE']['SRC'];
							else
								$picture = SITE_TEMPLATE_PATH.'/assets/images/placeholder/event-placeholder.svg';
							?>
							<img class="o-embed-responsive__item c-event-list-item__img" src="<?=$picture?>" alt="<?=$arItem["NAME"]?>">
						</div>

						<div class="c-event-list-item__container">
							<header class="c-event-list-item__header">
								<h2 class="c-event-list-item__title">
									<a class="o-stretched-link c-event-list-item__title-link" href="<?=$arItem["DETAIL_PAGE_URL"]?>">
										<?=$arItem["NAME"]?>
									</a>
								</h2>
							</header>

							<div class="c-event-list-item__body">
								<div class="c-event-list-item__text">
									<?=$arItem["PREVIEW_TEXT"];?>
								</div>
							</div>

							<footer class="c-event-list-item__footer">
								<?if ($section):?>
									<a class="c-event-list-item__section-link" href="<?=$section['SECTION_PAGE_URL']?>"><?=$section['NAME']?></a>
								<?endif?>

								<?if ($arItem['MINUTS']):?>
									<span class="c-event-list-item__reading-time">
										<?=$arItem["MINUTS"]?> минут
									</span>
								<?endif?>

								<?if ($arItem['DISPLAY_ACTIVE_FROM']):?>
									<time class="c-event-list-item__date"><?=$arItem['DISPLAY_ACTIVE_FROM']?></time>
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
