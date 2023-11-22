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

$curPage = $APPLICATION->GetCurPage();
?>

<div class="content-block-ContentBlock-module-block import-Import-module-banner-wrapper">
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
		<h2 class="content-block-ContentBlock-module-title content-block-ContentBlock-module-title-big"><?= $arResult['NAME'] ?></h2>
		<p class="content-block-ContentBlock-module-text content-block-ContentBlock-module-text-big content-block-ContentBlock-module-last">
			<?= $arResult['PREVIEW_TEXT'] ?>
		</p>
		<div class="content-block-ContentBlock-module-content"></div>
		<div class="content-block-ContentBlock-module-bottom">
			<a href="/contacts/"><button class="button-Button-module-button"><?= strlen($arResult["PROPERTIES"]["BTNTEXT"]["VALUE"]) > 1 ? $arResult["PROPERTIES"]["BTNTEXT"]["VALUE"] : GetMessage('MD_FREE_CONSULTATION') ?></button></a>
		</div>
	</div>

	<?
	if ($arResult['DETAIL_PICTURE']['SRC'])
		$picture = $arResult['DETAIL_PICTURE']['SRC'];
	if (!$picture)
		$picture = '/upload/images/renders/render-molecule.png';
	?>

	<? if ($picture) : ?>
		<div class="content-block-ContentBlock-module-image">
			<img class="import-Import-module-banner" src="<?= $picture ?>" alt="<?= $arResult['NAME'] ?>" />
		</div>
	<? endif ?>

</div>


<div class="service-item-ServiceItem-module-content">
	<? if ($arResult['DETAIL_TEXT']) : ?>
		<div class="content-block-ContentBlock-module-block import-Import-module-possibilities">
			<div class="content-block-ContentBlock-module-info">
				<?= $arResult['DETAIL_TEXT'] ?>
				<div class="content-block-ContentBlock-module-bottom"></div>
			</div>
		</div>
	<? endif ?>

	<? if ($arResult['PROPERTIES']['TOP_GALLERY']['VALUE']) : ?>
		<? $APPLICATION->IncludeComponent(
			"mediahead:photogallery",
			"project-list-carousel",
			array(
				"PHOTOS" => $arResult["PROPERTIES"]["TOP_GALLERY"]["VALUE"],
				"PHOTOS_DESC" => $arResult["PROPERTIES"]["TOP_GALLERY"]["DESCRIPTION"],
				//"VIDEOS" => $arResult["PROPERTIES"]["SLIDER_PHOTOS"]["VALUE"],
				//"VIDEOS_DESC" => $arItem["PROPERTY_VIDEO_DESCRIPTION"],
				//"YOUTUBE" => $arResult["PROPERTIES"]["YOUTUBE"]["VALUE"],
				"WIDTH" => 1312,
				"HEIGHT" => 440,
				"RESIZE_TYPE" => 'EXACT',
				"AUTOPLAY" => true,
				"NO_CLICK" => false,
			),
			$component
		); ?>
	<? endif ?>

	<? if ($arResult['PROPERTIES']['STAGES']['VALUE']) : ?>
		<div class="content-block-ContentBlock-module-block import-Import-module-steps-wrapper">
			<div class="content-block-ContentBlock-module-info">
				<? if ($arResult['CODE'] == 'parapharmaceuticals') : ?>
					<h5 class="content-block-ContentBlock-module-title" style="font-size: 25px;">Профессиональная команда и высокотехнологичное оборудование позволяют в короткие сроки создавать готовую к реализации продукцию:</h5>
				<? else : ?>
					<h2 class="content-block-ContentBlock-module-title"><?= GetMessage("MD_STAGES") ?></h2>
				<? endif ?>

				<div class="content-block-ContentBlock-module-content import-Import-module-steps content-block-ContentBlock-module-last">

					<? foreach ($arResult['PROPERTIES']['STAGES']['VALUE'] as $key => $stage) : ?>


						<div class="import-Import-module-step">
							<h3><?= $arResult['PROPERTIES']['STAGES']['DESCRIPTION'][$key] ?></h3>
							<div class="import-Import-module-decor">
								<img src="/upload/images/static_media/import/gear.png" alt="gear" />
							</div>
							<p>
								<?= $stage['TEXT'] ?>
							</p>
						</div>

					<? endforeach ?>

				</div>
				<div class="content-block-ContentBlock-module-bottom"></div>
			</div>
		</div>
	<? endif ?>

	



<? if ($arResult['TEASERS_FEATURES']) : ?>
		<div class="content-block-ContentBlock-module-block content-block-ContentBlock-module-inner">
			<div class="content-block-ContentBlock-module-info">
				<h2 class="content-block-ContentBlock-module-title"><?= GetMessage('MD_ADVANTAGES') ?></h2>
				<div class="content-block-ContentBlock-module-content service-item-ServiceItem-module-pros content-block-ContentBlock-module-last">

					<? foreach ($arResult['TEASERS_FEATURES'] as $teaser) : ?>
						<div class="service-item-ServiceItem-module-pro">
							<img src="<?= $teaser['ICON']['SRC'] ?>" alt="<?= $teaser['PREVIEW_TEXT'] ?>" />
							<?= $teaser['PREVIEW_TEXT'] ?>
						</div>

					<? endforeach ?>

				</div>
				<div class="content-block-ContentBlock-module-bottom"></div>
			</div>
		</div>
	<? endif ?>






	<? if ($arResult['PROPERTIES']['TEASERS_NUM']['DISPLAY']['LINK_ELEMENT_VALUE']) : ?>

		<div class="content-block-ContentBlock-module-block import-Import-module-pros-wrapper">
			<div class="content-block-ContentBlock-module-info">
				<h2 class="content-block-ContentBlock-module-title">Преимущества</h2>
				<div class="content-block-ContentBlock-module-content import-Import-module-pros-content content-block-ContentBlock-module-last">
					<ul class="import-Import-module-pros">
						<? foreach ($arResult['PROPERTIES']['TEASERS_NUM']['DISPLAY']['LINK_ELEMENT_VALUE'] as $teaser) : ?>
							<li class="import-Import-module-pro"><?= $teaser['~NAME'] ?></li>
						<? endforeach ?>

					</ul>
				</div>
				<div class="content-block-ContentBlock-module-bottom"></div>
			</div>
		</div>
	<? endif ?>


	<? if (!empty($arResult['RETAIL'])) : ?>
		<div class="content-block-ContentBlock-module-block import-Import-module-goods-wrapper">
			<div class="content-block-ContentBlock-module-info">
				<h2 class="content-block-ContentBlock-module-title">Поставляемые товары</h2>
				<div class="content-block-ContentBlock-module-content import-Import-module-goods content-block-ContentBlock-module-last">

					<? foreach ($arResult['RETAIL'] as $retail) : ?>
						<div class="import-Import-module-good">
							<img src="<?= $retail['ICON']['SRC'] ?>" alt="<?= GetMessage("MD_PERSONAL_USE") ?> <?= $retail['NAME'] ?>" />
						</div>
					<? endforeach ?>

				</div>
				<div class="content-block-ContentBlock-module-bottom"></div>
			</div>
		</div>
	<? endif ?>
</div>

<? if ($arResult['CODE'] != 'parapharmaceuticals') : ?>
<? if (!empty($arResult['CLINICS'])) : ?>
	<div class="content-block-ContentBlock-module-block import-Import-module-goods-wrapper">
		<div class="content-block-ContentBlock-module-info">
			<h2 class="content-block-ContentBlock-module-title">
				<? if ($arResult['CODE'] == 'parallelnyy-import') : ?>
					Поставляемые товары
				<? else : ?>
					<?= GetMessage("MD_CLINICS_TEST") ?>
				<? endif ?>
			</h2>
			<div class="content-block-ContentBlock-module-content import-Import-module-goods content-block-ContentBlock-module-last">

				<? foreach ($arResult['CLINICS'] as $clinic) : ?>
					<div class="import-Import-module-good">
						<img src="<?= $clinic['ICON']['SRC'] ?>" alt="<?= GetMessage("MD_CLINICS_TEST") ?> <?= $clinic['NAME'] ?>" />
					</div>
				<? endforeach ?>

			</div>
			<div class="content-block-ContentBlock-module-bottom"></div>
		</div>
	</div>
<? endif ?>
<? endif ?>

<? if ($arResult['PROPERTIES']['SHOW_FEEDBACK']['VALUE'] == "Да") : ?>
	<? $APPLICATION->IncludeComponent(
		"bitrix:main.include",
		".default",
		array(
			"COMPONENT_TEMPLATE" => ".default",
			"AREA_FILE_SHOW" => "file",
			"PATH" => "/include/footer_feedback.php",
			"EDIT_TEMPLATE" => "",
			"SHOW_BREADCRUMBS" => "N"
		),
		false,
		["HIDE_ICONS" => "Y"]
	); ?>
<? endif ?>


