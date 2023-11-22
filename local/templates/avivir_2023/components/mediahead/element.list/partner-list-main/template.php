<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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

//apre($arResult["ITEMS"]);
?>

<div class="content-block-ContentBlock-module-block home-Home-module-partners-wrapper">
	<div class="content-block-ContentBlock-module-info">
		<h2 class="content-block-ContentBlock-module-title">Партнеры</h2>
		<div class="content-block-ContentBlock-module-content home-Home-module-partners">
			<? if (count($arResult["ITEMS"]) >= 1) : ?>

				<? foreach ($arResult['ITEMS'] as $arItem) : ?>
					<div class="home-Home-module-partner"><img src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" alt="<?= $arItem['NAME'] ?>" /></div>
				<? endforeach ?>

			<? endif ?>
		</div>
		<div class="content-block-ContentBlock-module-bottom">
			<button class="button-Button-module-button" onclick="document.location='/business/partners/'">Перейти к полному списку</button>
		</div>
	</div>
</div>