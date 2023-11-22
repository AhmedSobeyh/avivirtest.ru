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

<div class="c-biblio-detail">
	<div class="o-container@md c-biblio-detail__container">
		<div class="o-embed-responsive o-embed-responsive--1by1 c-biblio-detail__media" style="height: <?=$arResult['DETAIL_PICTURE']['height']?>px;">
			<?
			if( $arResult['DETAIL_PICTURE']['SRC'] )
				$picture = $arResult['DETAIL_PICTURE']['SRC'];
			else
				$picture = SITE_TEMPLATE_PATH.'/assets/images/placeholder/person-placeholder.svg';
			?>
			<img class="o-embed-responsive__item c-biblio-detail__img" src="<?=$picture?>" alt="">
		</div>

		<div class="c-biblio-detail-header c-biblio-detail__header">
			<h2 class="c-biblio-detail-header__title">
				<span class="o-sr-only">Собеседник - </span>
				<span><?=$arResult['PERSONA']['PREVIEW_TEXT']?></span>
			</h2>
			<p class="c-biblio-detail-header__desc">
				<?if ($arResult['PROPERTIES']['SERIES']['VALUE']):?>
					Серия: <?=$arResult['PROPERTIES']['SERIES']['VALUE']?>, 
				<?endif?>	

				<?if ($arResult['PROPERTIES']['PUBLISHER']['VALUE']):?>
					Издательство: <?=$arResult['PROPERTIES']['PUBLISHER']['VALUE']?>,
				<?endif?>
				
				<?if ($arResult['PROPERTIES']['YEAR']['VALUE']):?>
					<?=$arResult['PROPERTIES']['YEAR']['VALUE']?> г.
				<?endif?>
			</p>
		</div>

		<div class="o-decor-divider"></div>

		<div class="s-biblio-detail-content">
			<?=$arResult["DETAIL_TEXT"];?>
		</div>

		<?if($arResult['PROPERTIES']['BUY_LINKS']['VALUE']):?>
			
			<div class="o-decor-divider"></div>
			<h3>Где купить книгу: </h3>
			
			<?$links = $arResult['PROPERTIES']['BUY_LINKS']['VALUE'];?>
			<?$descs = $arResult['PROPERTIES']['BUY_LINKS']['DESCRIPTION'];?>

			<?foreach($links as $i => $link):?>
				<a href="<?=$link?>" target="_blank"><?=$descs[$i]?></a>
			<?endforeach?>

		<?endif?>	

	</div>
</div>
