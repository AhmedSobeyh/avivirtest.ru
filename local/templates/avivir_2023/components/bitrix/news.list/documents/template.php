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

//apre( $arResult["ITEMS"] );
?>


<div class="content-block-ContentBlock-module-content official-Official-module-block">
	<? if (count($arResult["ITEMS"]) >= 1) : ?>
		<? foreach ($arResult['ITEMS'] as $arItem) : ?>
			<? if ($arItem['FILE']) : ?>
				<a class="official-Official-module-link" href="<?= $arItem['FILE'] ?>" target="_blank" rel="noreferrer">
					<?= $arItem['NAME'] ?>
				</a>
			<? endif ?>
		<? endforeach ?>
	<? endif ?>
</div>
<div class="content-block-ContentBlock-module-bottom"></div>