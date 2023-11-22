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

<div class="c-event-detail">
	<div class="o-container@md c-event-detail__container">
		<div class="o-embed-responsive o-embed-responsive--1by1 c-event-detail__media">
			<?
			if( $arResult['DETAIL_PICTURE']['SRC'] )
				$picture = $arResult['DETAIL_PICTURE']['SRC'];
			else
				$picture = SITE_TEMPLATE_PATH.'/assets/images/placeholder/person-placeholder.svg';
			?>
			<img class="o-embed-responsive__item c-event-detail__img" src="<?=$picture?>" alt="">
		</div>

		<!-- <div class="c-event-detail-header c-event-detail__header">
			<h2 class="c-event-detail-header__title">
				<span class="o-sr-only">Собеседник - </span>
				<span><?=$arResult['PERSONA']['PREVIEW_TEXT']?></span>
			</h2>
			<p class="c-event-detail-header__desc">
				<?=$arResult["PROPERTIES"]["SUBHEADER"]["VALUE"]?>
			</p>
		</div> -->

		<div class="o-decor-divider"></div>

		<div class="s-event-detail-content">
			<?=$arResult["DETAIL_TEXT"];?>
		</div>
	</div>
</div>
