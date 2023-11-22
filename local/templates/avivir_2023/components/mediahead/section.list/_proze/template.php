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

<?if( count($arResult['SECTIONS']) >= 1 ):?>
	<div class="poems_list">
		<div class="poems_list_wr">
			<div class="swiper-wrapper">

				<?foreach( $arResult['SECTIONS'] as $arItem ):?>

					<div class="swiper-slide">

						<?
						if( $arItem['PICTURE']['SRC'] )
							$picture = $arItem['PICTURE']['SRC'];
						else
							$picture = '/upload/img_none/poems.jpg';
						?>

						<a href="<?=$arItem['SECTION_PAGE_URL']?>" class="img_wr">
							<div class="front" style="background-image: url(<?=$picture?>);"></div>
							<div class="middle" style="background-image: url(<?=$picture?>);"></div>
							<div class="back" style="background-image: url(<?=$picture?>);"></div>
						</a>

						<h3><a href="<?=$arItem['SECTION_PAGE_URL']?>"><?=$arItem['NAME']?></a></h3>

						<?if( $arItem['UF_YEAR'] ):?>
							<div class="date"><?=$arItem['UF_YEAR']?></div>
						<?endif?>
					</div>

				<?endforeach?>

			</div>
		</div>
	</div>
<?endif?>
