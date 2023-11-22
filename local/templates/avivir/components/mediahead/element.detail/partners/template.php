<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

<?// START: App header ?>
<header class="c-app-header c-app-header--density-compact c-app-header--fullscreen c-app-header--has-media t-light c-test-kit-app-header">
	<div
		class="o-bg-holder c-test-kit-app-header__bg-holder"
		style="background-image: url(/upload/images/test-kit/test-kit-bg-holder-00.svg);"
	></div>

	<div class="o-container@lg c-app-header__container">
		<?$APPLICATION->IncludeComponent(
			"bitrix:breadcrumb",
			"breadcrumb",
			array(
				"COMPONENT_TEMPLATE" => "breadcrumb",
				"START_FROM" => "0",
				"PATH" => "",
				"SITE_ID" => "s1"
			),
			false
		);?>

		<div class="c-app-header__layout">
			<div class="c-app-header__media">
				<div
					class="o-bg-holder c-test-kit-app-header__media-bg-holder"
					style="background-image: url(/upload/images/test-kit/test-kit-shape-00.png);"
				></div>

				<? // START: Picture ?>
				<?
				if( $arResult['DETAIL_PICTURE']['SRC'] )
					$picture = $arResult['DETAIL_PICTURE']['SRC'];

				if ( !$picture && $arResult['PREVIEW_PICTURE']['SRC'] )
					$picture = $arResult['PREVIEW_PICTURE']['SRC'];

				if ( !$picture )
					$picture = '/upload/images/renders/render-molecule.png';
				?>

				<?if ($picture):?>
					<picture class="c-picture o-ratio o-ratio--1x1">
						<img
							class="c-picture__img c-picture__img--contain"
							src="<?=$picture?>"
							alt="<?=$arResult['NAME']?>"
						>
					</picture>
				<?endif?>
				<? // END: Picture ?>
			</div>

			<div class="c-app-header__body">
				<h1 class="c-app-header__title">
					<?=$arResult['NAME']?>
				</h1>

				<span class="c-app-header__lead">
					<?=$arResult['PREVIEW_TEXT']?>
				</span>
			</div>
		</div>
	</div>
</header>
<?// END: App header ?>

<?// START: Main ?>
<!-- <main class="o-main">
	<div class="o-main__wrap">
	</div>
</main> -->
<?// END: Main ?>

<?//apre($arResult,'result')?>
