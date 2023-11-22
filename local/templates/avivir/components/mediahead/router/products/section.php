<?

\CModule::IncludeModule("mediahead.helpers");

if ($arResult['VARIABLES']['SECTION_ID'] > 0) {
	$sectionId = $arResult['VARIABLES']['SECTION_ID'];
	$section = \CIBlockSection::GetList([],['ID' => $sectionId,'IBLOCK_ID' => $arParams['IBLOCK_ID']],false,
		['ID','NAME','DESCRIPTION','PICTURE','SECTION_PAGE_URL','UF_EN_NAME','UF_EN_DESCRIPTION']
	)->GetNext();

	\Mediahead\Helpers\Lang::obtainLangFields($section);

	if ($section['PICTURE']) {
		$section['IMAGE'] = \CFile::GetFileArray($section['PICTURE']);
	} else {
		$section['IMAGE']['SRC'] = '/upload/images/catalog/catalog-section-page-header-00.png';
	}
}

//apre($arResult)
?>

<?// START: App header ?>
<header class="c-app-header c-app-header--density-compact c-app-header--fullscreen c-app-header--has-media t-light">
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

				<? // START: Picture ?>
				<?
				if( $section['IMAGE']['SRC'] )
					$picture = $section['IMAGE']['SRC'];

				if ( !$picture )
					$picture = '/upload/images/renders/render-molecule.png';
				?>

				<?if ($picture):?>
					<picture class="c-picture o-ratio o-ratio--1x1">
						<img
							class="c-picture__img c-picture__img--contain"
							src="<?=$section['IMAGE']['SRC']?>"
							alt="<?=$section['NAME']?>"
						>
					</picture>
				<?endif?>
				<? // END: Picture ?>
			</div>

			<div class="c-app-header__body">
				<h1 class="c-app-header__title">
					<?=$APPLICATION->ShowTitle(false);?>
				</h1>

				<span class="c-app-header__lead">
					<?=$section['DESCRIPTION']?>
				</span>
			</div>
		</div>
	</div>
</header>
<?// END: App header ?>

<?// START: Main ?>
<main class="o-main">
	<div class="o-main__wrap">
		<section
			class="c-app-section c-app-section--density-comfortable u-bg-light-mint-lighten-2"
			id="productList"
		>
			<div class="o-container@lg">
				<div class="c-app-section__header c-catalog-section-product-list__header">
					<h2 class="c-app-section__title c-catalog-section-product-list__title">
						<?=$section['NAME']?>
					</h2>

					<?$APPLICATION->IncludeComponent(
						"mediahead:smart.filter",
						"products",
						array(
							"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
							"IBLOCK_ID" => $arParams["IBLOCK_ID"],
							"SECTION_ID" =>  $arResult['VARIABLES']['SECTION_ID'],
							"FILTER_NAME" => $arParams["FILTER_NAME"],
							"PREFILTER_NAME" => "prefilter",
							"CACHE_TYPE" => $arParams["CACHE_TYPE"],
							"CACHE_TIME" => $arParams["CACHE_TIME"],
							"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
							"SAVE_IN_SESSION" => "N",
							"FILTER_VIEW_MODE" => $arParams["FILTER_VIEW_MODE"],
							"XML_EXPORT" => "N",
							"SECTION_TITLE" => "NAME",
							"SECTION_DESCRIPTION" => "DESCRIPTION",
							'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
							"TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
							"SEF_MODE" => $arParams["SEF_MODE"],
							"SEF_RULE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["smart_filter"],
							"SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
							"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
							"INSTANT_RELOAD" => "Y", //$arParams["INSTANT_RELOAD"],
							"COMPONENT_CONTAINER_ID" => "filterResult", //$arParams["INSTANT_RELOAD"],
							"SORT" => $elementsListParams['SORT_BY1'],
							"REQUESTED_PAGE" => $section["SECTION_PAGE_URL"]
						),
						$component,
						array('HIDE_ICONS' => 'Y')
					);?>
				</div>

				<div class="c-app-section__body">
					<?
					$APPLICATION->IncludeComponent(
						"mediahead:element.list",
						"products",
						Array(
							"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
							"IBLOCK_ID" => $arParams["IBLOCK_ID"],
							"NEWS_COUNT" => $arParams["NEWS_COUNT"],
							"SORT_BY1" => $arParams["SORT_BY1"],
							"SORT_ORDER1" => $arParams["SORT_ORDER1"],
							"SORT_BY2" => $arParams["SORT_BY2"],
							"SORT_ORDER2" => $arParams["SORT_ORDER2"],
							"FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
							"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
							"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
							"SET_TITLE" => $arParams["SET_TITLE"],
							"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
							"MESSAGE_404" => $arParams["MESSAGE_404"],
							"SET_STATUS_404" => $arParams["SET_STATUS_404"],
							"SHOW_404" => $arParams["SHOW_404"],
							"FILE_404" => $arParams["FILE_404"],
							"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
							"ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
							"CACHE_TYPE" => $arParams["CACHE_TYPE"],
							"CACHE_TIME" => $arParams["CACHE_TIME"],
							"CACHE_FILTER" => $arParams["CACHE_FILTER"],
							"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
							"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
							"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
							"PAGER_TITLE" => $arParams["PAGER_TITLE"],
							"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
							"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
							"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
							"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
							"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
							"PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
							"PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
							"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
							"DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
							"DISPLAY_NAME" => "Y",
							"DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
							"DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
							"PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
							"ACTIVE_DATE_FORMAT" => $arParams["LIST_ACTIVE_DATE_FORMAT"],
							"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
							"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
							"FILTER_NAME" => $arParams["FILTER_NAME"],
							"HIDE_LINK_WHEN_NO_DETAIL" => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],
							"CHECK_DATES" => $arParams["CHECK_DATES"],
							"STRICT_SECTION_CHECK" => $arParams["STRICT_SECTION_CHECK"],

							"PARENT_SECTION" => $arResult["VARIABLES"]["SECTION_ID"],
							"PARENT_SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
							"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
							"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
							"IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["sections"],

							"PROPERTY_CODE" => [0 => "DATE"]
						),
						$component
					);?>
				</div>
			</div>
		</section>
	</div>
</main>
<?// END: Main ?>