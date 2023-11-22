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

?>

<div class="content-block-ContentBlock-module-block express-item-ExpressItem-module-banner-wrapper">
	<div class="content-block-ContentBlock-module-info">
		<? $APPLICATION->IncludeComponent(
			"bitrix:breadcrumb",
			"breadcrumb",
			array(
				"COMPONENT_TEMPLATE" => "breadcrumb",
				"START_FROM" => "0",
				"PATH" => "",
				"SITE_ID" => "s1"
			),
			false
		); ?>
		<h2 class="content-block-ContentBlock-module-title content-block-ContentBlock-module-title-big">
			<?= $APPLICATION->ShowTitle(false); ?>
		</h2>
		<p class="content-block-ContentBlock-module-text content-block-ContentBlock-module-text-big">
			<?= $arResult['PREVIEW_TEXT'] ?>
		</p>
		<div class="content-block-ContentBlock-module-content"></div>
		<div class="content-block-ContentBlock-module-bottom">
		</div>
	</div>
	<?
	if ($arResult['DETAIL_PICTURE']['SRC'])
		$picture = $arResult['DETAIL_PICTURE']['SRC'];

	if (!$picture && $arResult['PREVIEW_PICTURE']['SRC'])
		$picture = $arResult['PREVIEW_PICTURE']['SRC'];

	if (!$picture)
		$picture = '/upload/images/renders/render-molecule.png';
	?>

	<? if ($picture) : ?>
		<div class="content-block-ContentBlock-module-image">
			<img class="express-item-ExpressItem-module-banner" src="<?= $picture ?>" alt="<?= $arResult['NAME'] ?>" />
		</div>
	<? endif ?>
</div>