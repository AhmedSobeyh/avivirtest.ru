<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

//apre($arResult["ITEMS"]);
?>

<? if (count($arResult["ITEMS"]) >= 1) : ?>
<div class="content-block-ContentBlock-module-block content-block-ContentBlock-module-inner">
	<div class="content-block-ContentBlock-module-info">
		<h2 class="content-block-ContentBlock-module-title">Современное оснащение</h2>
		<div class="content-block-ContentBlock-module-content content-block-ContentBlock-module-last">
			<img class="service-item-ServiceItem-module-image" src="<?= $arResult["ITEMS"][array_key_first($arResult["ITEMS"])]['DATA']['MINI']['SRC'] ?>" />
		</div>
		<div class="content-block-ContentBlock-module-bottom"></div>
	</div>
</div>
<? endif ?>
