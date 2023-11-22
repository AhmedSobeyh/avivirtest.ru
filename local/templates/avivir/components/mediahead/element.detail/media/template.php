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

// apre($arResult);
?>

<?// START: App header ?>
<header class="c-app-header c-app-header--density-compact c-app-header--fullscreen c-app-header--has-media t-light c-news-detail-app-header">
	<div
		class="o-bg-holder c-news-detail-app-header__bg-holder"
		style="background-image: url(/upload/images/news/news-detail-header-bg-00.jpg);"
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
				<? /* START: Picture */ ?>
				<?
				if( $arResult['DETAIL_PICTURE']['SRC'] )
					$picture = $arResult['DETAIL_PICTURE']['SRC'];

				if ( !$picture && $arResult['PREVIEW_PICTURE']['SRC'] )
					$picture = $arResult['PREVIEW_PICTURE']['SRC'];

				if ( !$picture )
					$picture = '/upload/images/renders/render-molecule.png';
				?>

				<?if ($picture):?>
					<picture class="c-picture c-news-detail-app-header__picture">
						<img
							class="c-picture__img c-picture__img--contain"
							src="<?=$picture?>"
							alt="<?=$arResult['NAME']?>"
						>
					</picture>
				<?endif?>
				<? /* END: Picture */ ?>
			</div>

			<div class="c-app-header__body">
				<?$section = current($arResult["SECTION"]["PATH"]);?>

				<?// START: Chip ?>
				<a
					class="c-chip c-chip--size-sm c-news-detail-app-header__chip"
					href="<?=$section['SECTION_PAGE_URL'];?>"
				>
					<span class="c-chip__overlay"></span>
					<span class="c-chip__content">
						<?=$section['NAME'];?>
					</span>
				</a>
				<?// END: Chip ?>

				<h1 class="c-app-header__title"><?=$sectName;?></h1>

				<span class="c-news-detail-app-header__date">
					<?=$arResult['DISPLAY_ACTIVE_FROM'];?>
				</span>
			</div>
		</div>
	</div>
</header>
<?// END: App header ?>

<?// START: Main ?>
<main class="o-main">
	<div class="o-main__wrap">
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

<?// apre($arResult,'arResult')?>
