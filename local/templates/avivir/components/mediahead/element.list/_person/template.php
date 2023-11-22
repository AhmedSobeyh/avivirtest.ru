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

<?if (!$arParams["HEADER"] && $arParams["SHOW_SUBNAV"] == "Y"):?>
	<?// START: Person list navbar?>
	<nav class="c-person-list-navbar">
		<div class="o-container@md c-person-list-navbar__container">
			<div class="c-person-list-navbar__scroller">
				<ul class="c-person-list-navbar-nav c-person-list-navbar__nav">

					<?foreach($arResult["ITEMS"] as $arItem):?>

						<?if ($arItem["PERSONA"]):?>
							<li class="c-person-list-navbar-nav__item">
								<a class="c-person-list-navbar-nav__link" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["PERSONA"]["PREVIEW_TEXT"]?></a>
							</li>
						<?endif?>

					<?endforeach?>

				</ul>
			</div>
		</div>
	</nav>
	<?// END: Person list navbar?>
<?endif?>

<div class="c-person-list">
	<div class="o-container@md c-person-list__container">
		<?if ($arParams["HEADER"]):?>
			<h2 class="c-person-list__title">
				<?if ($arParams["HEADER_LINK"]):?>
					<a href="<?=$arParams["HEADER_LINK"]?>"><?=$arParams["HEADER"]?></a>
				<?else:?>
					<?=$arParams["HEADER"]?>
				<?endif?>
			</h2>
		<?endif?>

		<ul class="c-person-list__layout">

			<?foreach($arResult["ITEMS"] as $arItem):?>

				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				$section = false;
				if ($arItem['SECTION_ID'])
					$section = $arResult['SECTIONS'][$arItem['SECTION_ID']];
				?>

				<li class="c-person-list__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
					<article class="c-person-list-item">
						<div class="o-embed-responsive o-embed-responsive--4by3 c-person-list-item__media"><?
							if( $arItem['PREVIEW_PICTURE']['SRC'])
								$picture =$arItem['PREVIEW_PICTURE']['SRC'];
							else
								$picture = SITE_TEMPLATE_PATH.'/assets/images/placeholder/person-placeholder.svg';
							?>
							<img class="o-embed-responsive__item c-person-list-item__img" src="<?=$picture?>" alt="<?=$arItem["NAME"]?>">
							<div class="c-person-list-item__author">
								<h3 class="c-person-list-item__author-name u-ff-primary">
									<?if ($arItem["PERSONA"]):?>
										<?=$arItem["PERSONA"]["PREVIEW_TEXT"]?>
									<?endif?>
								</h3>
							</div>
						</div>

						<div class="c-person-list-item__container">
							<header class="c-person-list-item__header">
								<h2 class="c-person-list-item__title">
									<a class="o-stretched-link c-person-list-item__title-link" href="<?=$arItem["DETAIL_PAGE_URL"]?>">
										<?=$arItem["NAME"]?>
									</a>
								</h2>
							</header>

							<div class="c-person-list-item__body">
								<div class="c-person-list-item__text">
									<?=$arItem["PREVIEW_TEXT"];?>
								</div>
							</div>

							<footer class="c-person-list-item__footer">
								<?if ($section):?>
									<a class="c-person-list-item__section-link" href="<?=$section['SECTION_PAGE_URL']?>"><?=$section['NAME']?></a>
								<?endif?>

								<?if ($arItem['MINUTS']):?>
									<span class="c-person-list-item__reading-time">
										<?=$arItem["MINUTS"]?> минут
									</span>
								<?endif?>

								<?if ($arItem['DATE']):?>
									<time class="c-person-list-item__date"><?=$arItem['DATE']?></time>
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
