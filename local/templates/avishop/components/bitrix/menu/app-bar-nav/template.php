<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
// apre( $arResult );
?>
<? if (count($arResult) >= 1) : ?>
	<ul class="avishop-Header-module-list">
		<? foreach ($arResult as $key => $arItem) : ?>
			<?php if($arItem["TEXT"]==='Доставка и оплата') {  ?>
				<li class="avishop-Header-module-list-item"><a href="<?= $arItem['LINK'] ?>" target="_blank"><?= $arItem["TEXT"] ?></a></li>
			<?php } else{ ?>
				<li class="avishop-Header-module-list-item"><a href="<?= $arItem['LINK'] ?>"><?= $arItem["TEXT"] ?></a></li>
			<?php } ?>
		<? endforeach ?>
	</ul>

<? endif ?>