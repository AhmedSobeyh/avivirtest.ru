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
//apre($arResult['PERSONA'], 'PERSON');
//apre($arResult, 'arResult');
?>

<div class="c-literature-detail">
	<div class="o-container@md c-literature-detail__container">
		<div class="o-embed-responsive o-embed-responsive--1by1 c-literature-detail__media">
			<?
			if( $arResult['DETAIL_PICTURE']['SRC'] )
				$picture = $arResult['DETAIL_PICTURE']['SRC'];
			else
				$picture = SITE_TEMPLATE_PATH.'/assets/images/placeholder/person-placeholder.svg';
			?>
			<img class="o-embed-responsive__item c-literature-detail__img" src="<?=$picture?>" alt="">
		</div>

		<div class="c-literature-detail-header c-literature-detail__header">
			<h2 class="c-literature-detail-header__title">
				<span class="o-sr-only">Собеседник - </span>
				<span><?=$arResult['PERSONA']['PREVIEW_TEXT']?></span>
			</h2>
			<p class="c-literature-detail-header__desc">
				<?=$arResult["PROPERTIES"]["SUBHEADER"]["VALUE"]?>
			</p>
		</div>

		<div class="o-decor-divider c-literature-detail__divider"></div>

		<div class="s-literature-detail-content">
			<?=$arResult["DETAIL_TEXT"];?>
		</div>
	</div>
</div>
