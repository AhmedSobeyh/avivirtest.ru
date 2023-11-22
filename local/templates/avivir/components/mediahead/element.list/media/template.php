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

$arRandCard = [
	0 => 'picture-top',
	1 => 'no-media',
	2 => 'overlaid',
	3 => 'has-avatar',
];

?>

<section class="c-news-list">
	<div class="o-container@lg c-news-list__container">
		
		<?if ($arParams["HEADER"]):?>
			<div class="c-news-list__header">
				<h2 class="c-news-list__title">
					<?=$arParams['HEADER']?>
				</h2>
			</div>
		<?else:?>
			<div class="c-news-list__header">
				<h2 class="c-news-list__title">
					<?=GetMessage('MD_MEDIA_HEADER');?>
				</h2>
			</div>
		<?endif?>	

		<div class="c-news-list__body">
			<ul
				class="c-news-list__layout js-masonry-news-list"
			>

				<?foreach($arResult["ITEMS"] as $arItem):?>

					<?
					$rand = rand(0,3);
					$type = $arRandCard[$rand];

					if (empty($arItem['PREVIEW_PICTURE']['SRC']))
						$type = "no-media";

					$theme = $type == 'overlaid' ? 't-dark' : 't-light';

					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					$section = false;
					if ($arItem['SECTION_ID'])
						$section = $arResult['SECTIONS'][$arItem['SECTION_ID']];


					?>

					<li class="c-news-list__item js-masonry-news-list-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
						<div class=" c-news-card c-news-card--<?=$type?> <?=$theme?>">

							<?if ($type == "picture-top"):?>

								<picture
									class=" o-ratio o-ratio--16x9 c-news-card__picture"
								>
									<img
										class="o-ratio__item c-news-card__img"
										src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>"
										alt=""
									/>
								</picture>
							<?elseif($type == "overlaid"):?>
								<picture class="c-news-card__picture">
									<img
										class="c-news-card__img"
										src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>"
										alt=""
									/>
								</picture>
							<?elseif($type == "has-avatar"):?>
								<div class="c-avatar c-news-card__avatar">
									<picture
										class="o-ratio o-ratio--1x1 c-avatar__picture"
									>
										<img
											class="o-ratio__item c-avatar__img"
											src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>"
											alt=""
										/>
									</picture>
								</div>
							<?endif?>


							<div class="c-news-card__body">
								<h3 class="c-news-card__title">
									<a class="
											o-stretched-link
											c-news-card__title-link
										"
										href="<?=$arItem["DETAIL_PAGE_URL"]?>"
									>
										<?=$arItem["NAME"]?>
									</a>
								</h3>
								<p class="c-news-card__text">
									<?=$arItem["PREVIEW_TEXT"]?>
								</p>
							</div>

							<?// START: Chip ?>
							<a
								class="
									c-chip
									c-chip--kind-primary
									c-chip--size-sm
									c-news-card__chip
								"
								href="<?=$section['SECTION_PAGE_URL']?>"
							>
								<span class="c-chip__overlay"></span>
								<span class="c-chip__content">
									<?=$section['NAME']?>
								</span>
							</a>
							<?// END: Chip ?>
						</div>
					</li>

				<?endforeach?>

			</ul>
		</div>
	</div>
</section>

<?/*
<div class="c-proze-list">
	<div class="o-container@md c-proze-list__container">
		<?if ($arParams["HEADER"]):?>
			<h2 class="c-proze-list__title">
				<?if ($arParams["HEADER_LINK"]):?>
					<a href="<?=$arParams["HEADER_LINK"]?>"><?=$arParams["HEADER"]?></a>
				<?else:?>
					<?=$arParams["HEADER"]?>
				<?endif?>
			</h2>
		<?endif?>

		<ul class="c-proze-list__layout">

			<?foreach($arResult["ITEMS"] as $arItem):?>

				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				$section = false;
				if ($arItem['SECTION_ID'])
					$section = $arResult['SECTIONS'][$arItem['SECTION_ID']];
				?>

				<li class="c-proze-list__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
					<article class="c-proze-list-item">
						<header class="c-proze-list-item__header">
							<h2 class="c-proze-list-item__title">
								<a class="o-stretched-link c-proze-list-item__title-link" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
							</h2>
						</header>

						<?if ($arItem["PREVIEW_PICTURE"]):?>
							<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="200" />
						<?endif?>

						<div class="c-proze-list-item__body">
							<p class="c-proze-list-item__text">
								<?=$arItem["PREVIEW_TEXT"];?>
							</p>
						</div>

						<footer class="c-proze-list-item__footer">
							<?if ($section):?>
								<a class="c-proze-list-item__section-link" href="<?=$section['SECTION_PAGE_URL']?>"><?=$section['NAME']?></a>
							<?endif?>

							<?if ($arItem['MINUTS']):?>
							<span class="c-proze-list-item__reading-time">
								<?=$arItem["MINUTS"]?> минут
							</span>
							<?endif?>

							<?if ($arItem['DATE']):?>
								<time class="c-proze-list-item__date"><?=$arItem['DATE']?></time>
							<?endif?>
						</footer>
					</article>
				</li>

			<?endforeach?>

		</ul>

		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
			<?=$arResult["NAV_STRING"]?>
		<?endif;?>
	</div>
</div>
*/?>
