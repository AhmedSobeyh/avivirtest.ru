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

$lang = \Bitrix\Main\Context::getCurrent()->getLanguage();


//apre($arResult, 'arResult');
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
			<div class="express-item-ExpressItem-module-buttons">
				<a href="/contacts">
					<button class="button-Button-module-button">
						<?= GetMessage('MD_CALC_ORDER') ?>
					</button>
				</a>
			</div>
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


<div class="content-block-ContentBlock-module-block express-item-ExpressItem-module-gray">
	<div class="content-block-ContentBlock-module-info">
		<div class="content-block-ContentBlock-module-content express-item-ExpressItem-module-examples content-block-ContentBlock-module-last">
			<? if (!empty($arResult['PROPERTIES']['BRAND']['VALUE'])) : ?>
				<div class="express-item-ExpressItem-module-example">
					<img src="/upload/images/icon/duotone/molecules.svg" alt="<?= $arResult['BRAND']['NAME'] ?>" />
					<h3><?= GetMessage("MD_MANUFACTURER") ?></h3>
					<p><?= $arResult['BRAND']['NAME'] ?></p>
				</div>
			<? endif ?>


			<div class="express-item-ExpressItem-module-example">
				<img src="/upload/images/icon/duotone/globe.svg" alt="<?= GetMessage("MD_LEADING_GLOBAL") ?>" />
				<h3><?= GetMessage("MD_LEADING_GLOBAL") ?></h3>
				<p><?= GetMessage("MD_LEADING_GLOBAL_MANUFACTURER") ?></p>
			</div>


			<? if (!empty($arResult['PROPERTIES']['COUNTRY']['VALUE'])) : ?>
				<div class="express-item-ExpressItem-module-example">
					<img src="/upload/images/icon/duotone/thermometer.svg" alt="<?= $arResult['PROPERTIES']['TEMPERATURE']['VALUE'] ?>" />
					<h3><?= GetMessage("MD_TEMPERATURE") ?>></h3>
					<p><?= $arResult['PROPERTIES']['TEMPERATURE']['VALUE'] ?></p>
				</div>
			<? endif ?>

			<div class="express-item-ExpressItem-module-example">
				<img src="/upload/images/icon/duotone/boxes.svg" alt="<?= GetMessage("MD_TURNKEY") ?>" />
				<h3><?= GetMessage("MD_TURNKEY") ?></h3>
				<p><?= GetMessage("MD_TURNKEY_BASIS") ?></p>
			</div>
		</div>
		<div class="content-block-ContentBlock-module-bottom"></div>
	</div>
</div>

<div class="content-block-ContentBlock-module-block content-block-ContentBlock-module-inner">
	<div class="content-block-ContentBlock-module-info">
		<h2 class="content-block-ContentBlock-module-title"><?= GetMessage('MD_FEATURES') ?></h2>
		<div class="content-block-ContentBlock-module-content service-item-ServiceItem-module-pros content-block-ContentBlock-module-last">
			<? foreach ($arResult['SECTION_TEASERS'] as $teaser) : ?>
				<div class="service-item-ServiceItem-module-pro">
					<img src="<?= $teaser['ICON']['SRC'] ?>" alt="pro" />
					<?= $teaser['PREVIEW_TEXT'] ?>
				</div>
			<? endforeach ?>
			<div class="content-block-ContentBlock-module-bottom"></div>
		</div>
	</div>
</div>