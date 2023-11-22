<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
// apre( $arResult );
?>

<? if (count($arResult) >= 1) : ?>
	<ul>
		<? foreach ($arResult as $key => $arItem) : ?>

			<li class="">
				<a href="<?= $arItem['LINK'] ?>"><?= $arItem["TEXT"] ?></a>
			</li>

		<? endforeach ?>
		<li class="">
			<a href="/basket/">Корзина</a>
		</li>
		<li class="page-Header-module-green">
			<a href="https://avivir.ru/">Перейти на сайт Avivir.ru</a>
		</li>
	</ul>

<? endif ?>