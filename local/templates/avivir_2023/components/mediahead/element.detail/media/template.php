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

// START: SEO
if (LANGUAGE_ID == 'ru') {
	$sectName = $arResult["NAME"];
	$sectTitle = $arResult["NAME"];
	$sectDescription = '';
} else {
	$sectName = $arResult["NAME"];
	$sectTitle = $arResult["NAME"];
	$sectDescription = '';
}

$APPLICATION->SetPageProperty("title", $sectTitle);
//$APPLICATION->SetPageProperty("description", $sectDescription);
// END: SEO

// apre($arResult);
?>

<div class="content-block-ContentBlock-module-block article-Article-module-block">
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
			<? $section = current($arResult["SECTION"]["PATH"]); ?>
			<p>
			<div><button class="button-Button-module-button article-Article-module-section"><?= $section['NAME']; ?></button></div>
			</p>
			<?= $sectName; ?>
		</h2>
		<p class="content-block-ContentBlock-module-text content-block-ContentBlock-module-text-big"><?= $arResult['DISPLAY_ACTIVE_FROM']; ?></p>
		<div class="content-block-ContentBlock-module-bottom"></div>
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
			<img class="article-Article-module-image" src="<?= $picture ?>" alt="<?= $arResult['NAME'] ?>" />
		</div>
	<? endif ?>

</div>
<div class="content-block-ContentBlock-module-block">
	<div class="content-block-ContentBlock-module-info">
		<div class="content-block-ContentBlock-module-content article-Article-module-article">
			<?= $arResult["DETAIL_TEXT"]; ?>
		</div>
		<div class="content-block-ContentBlock-module-bottom"></div>
	</div>
</div>


<? // apre($arResult,'arResult')
?>