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

// START: SEO
if ( LANGUAGE_ID == 'ru' )
{
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

//apre($arResult);
?>

<?// START: App header ?>
<header class="c-app-header c-app-header--density-compact c-app-header--fullscreen c-app-header--has-media t-light c-vaccine-detail-app-header">
	<div
		class="o-bg-holder c-vaccine-detail-app-header__bg-holder"
		style="background-image: url(/upload/images/backgrounds/bg-hexagon-color-primary-00.svg);"
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
					class="o-bg-holder c-app-header__media-bg-holder"
					style="background-image: url(/upload/images/backgrounds/bg-plus-grid-color-primary-01.svg);"
				></div>

				<?// START: Picture ?>
				<?
				if ( $arResult['DETAIL_PICTURE']['SRC'] ):
					$picture = $arResult['DETAIL_PICTURE']['SRC'];
				elseif ( !$picture && $arResult['PREVIEW_PICTURE']['SRC'] ):
					$picture = $arResult['PREVIEW_PICTURE']['SRC'];
				elseif ( !$picture ):
					$picture = '/upload/images/renders/render-molecule.png';
				endif
				?>

				<?if ( $picture ):?>
					<picture class="c-picture o-ratio o-ratio--1x1">
						<img
							class="c-picture__img c-picture__img--contain c-vaccine-detail-app-header__img"
							src="<?=$picture?>"
							alt="<?=$arResult['NAME']?>"
						>
					</picture>
				<?endif?>
				<?// END: Picture ?>
			</div>

			<div class="c-app-header__body">
				<h1 class="c-app-header__title"><?=$sectName?></h1>

				<span class="c-app-header__lead">
					<?=$arResult['PREVIEW_TEXT']?>
				</span>
			</div>
		</div>
	</div>
</header>
<?// END: App header ?>

<?// START: Main ?>
<main class="o-main">
	<div class="o-main__wrap">
		<!-- START: Dynamic banner -->
		<section class="
			c-dynamic-banner
			c-dynamic-banner--size-lg
			c-dynamic-banner--density-comfortable
			c-dynamic-banner--center-body@lg
			c-dynamic-banner--split@lg
			u-bg-light-mint
			c-vaccine-detail-dynamic-banner
		">
			<div class="o-container@lg c-dynamic-banner__container">
				<div class="c-dynamic-banner__layout">
					<div class="c-dynamic-banner__media c-dynamic-banner__media--align-center">
						<div
							class="o-bg-holder c-dynamic-banner__media-bg-holder"
							style="background-image: url(data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'%3E%3Cstyle type='text/css'%3E .ellipse%7Bfill:url(%23gradient);%7D%0A%3C/style%3E%3CradialGradient id='gradient' cx='-565.791' cy='655.7343' r='1.8618' gradientTransform='matrix(198.8216 -169.7268 -169.2873 -196.8725 223560.3438 33473.1641)' gradientUnits='userSpaceOnUse'%3E%3Cstop offset='0' style='stop-color:%23FFFFFF'/%3E%3Cstop offset='0.6302' style='stop-color:%23E3E3E3'/%3E%3Cstop offset='1' style='stop-color:%23FFFFFF'/%3E%3C/radialGradient%3E%3Cellipse class='ellipse' cx='256' cy='256' rx='256' ry='256'/%3E%3C/svg%3E%0A);%7D%0A%3C/style%3E%3CradialGradient id='gradient' cx='-565.791' cy='655.7343' r='1.8618' gradientTransform='matrix(198.8216 -169.7268 -169.2873 -196.8725 223560.3438 33473.1641)' gradientUnits='userSpaceOnUse'%3E%3Cstop offset='0' style='stop-color:%23FFFFFF'/%3E%3Cstop offset='0.6302' style='stop-color:%23E3E3E3'/%3E%3Cstop offset='1' style='stop-color:%23FFFFFF'/%3E%3C/radialGradient%3E%3Cellipse class='ellipse' cx='256' cy='256' rx='256' ry='256'/%3E%3C/svg%3E%0A);"
						></div>

						<? // START: Picture ?>
						<?
						if ( $arResult['PROPERTIES']['BANNER_TITLE']['VALUE']['src'] )
							$bannerPicture = $arResult['PROPERTIES']['BANNER_PICTURE']['VALUE']['src'];

						if ( !$bannerPicture )
							$bannerPicture = '/upload/images/renders/render-molecule.png';
						?>

						<?if ($picture):?>
							<picture class="c-picture o-ratio o-ratio--1x1 c-dynamic-banner__picture">
								<img
									class="c-picture__img c-picture__img--contain c-dynamic-banner__img"
									src="<?=$bannerPicture?>"
									alt="<?=$arResult['PROPERTIES']['BANNER_TITLE']['VALUE']?>"
								>
							</picture>
						<?endif?>
						<? // END: Picture ?>
					</div>
					<div class="c-dynamic-banner__body">
						<h2 class="c-dynamic-banner__title">
							<?=$arResult['PROPERTIES']['BANNER_TITLE']['VALUE']?>
						</h2>

						<p class="c-dynamic-banner__text">
							<?=$arResult['PROPERTIES']['BANNER_TEXT']['VALUE']['TEXT']?>
						</p>
					</div>
				</div>
			</div>
		</section>
		<!-- END: Dynamic banner -->

		<div class="c-news-detail">
			<div class="o-container@lg c-news-detail__container">
				<article class="s-wysiwyg">
					<?=$arResult["DETAIL_TEXT"];?>
				</article>
			</div>
		</div>
	</div>
</main>
<?// END: Main ?>

<?apre($arResult,'arResult')?>