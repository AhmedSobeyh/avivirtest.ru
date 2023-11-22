<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

//apre($arResult["ITEMS"]);
?>


<? if (count($arResult["ITEMS"]) >= 1) : ?>
	<div class="express-item-ExpressItem-module-slider">

		<div class="swiper">
			<div class="swiper-wrapper">
				<? foreach ($arResult["ITEMS"] as $key => $item) : ?>
					<div class="swiper-slide">
						<img src="<?= $item['DATA']['MINI']['SRC'] ?>" alt="<?= $item["DATA"]["DESC"] ?>" />
					</div>
				<? endforeach ?>
			</div>
		</div>

		<div class="express-item-ExpressItem-module-slider-arrows">
			<div class="swiper-button-prev express-item-ExpressItem-module-slider-arrow"></div>
			<p>
				<span class="swiper-current-slide">1</span> / <?= count($arResult["ITEMS"]) ?>
			</p>
			<div class="swiper-button-next express-item-ExpressItem-module-slider-arrow"></div>
		</div>
	</div>

<? endif ?>