<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Инновационные решения для комплексных проектов в здравоохранении");
$APPLICATION->SetPageProperty("title","«Авивир» — Инновационные решения для комплексных проектов в здравоохранении");
$APPLICATION->SetPageProperty("description", "Компания «Авивир» — это исследовательские, производственные и инвестиционные разработки в области медицинских изделий и инновационной фармацевтики.");
?>

<?// START: App header ?>
<header class="c-app-header c-app-header--density-compact c-app-header--fullscreen c-app-header--has-media t-dark u-bg-secondary-darken-3">

	<div class="o-bg-holder o-bg-holder--video-block">
		<div class="o-bg-holder__decoration"></div>
		<video src="/upload/videos/avivir-video/avivir-video-looped.mp4" width="100%" height="100%"
			class="o-bg-holder__video"
			id="bg-video-player"
			type="video/mp4"
			autoplay
			loop
			muted>
		</video>
	</div>

	<div class="o-container@lg c-app-header__container">
		<div class="c-app-header__layout c-app-header__layout--video-player">
			<div class="c-app-header__media c-app-header__media--video-block">
				<a href="#video-player"  class="c-btn c-btn--kind-plain-primary c-icon--size-lg--extra c-btn-icon c-btn--video-block " data-play>
					<span class="c-btn__overlay"></span>
					<span class="c-btn__content">
						<svg class="c-icon c-icon--size-lg--play"  width="94" height="99" viewBox="0 0 94 99" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M91 49.5L3 3V96L91 49.5Z" stroke="white" stroke-width="6" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</span>
				</a>
			</div>

			<div class="c-app-header__body">
				<h1 class="c-app-header__title"><? $APPLICATION->ShowTitle(true); ?></h1>

				<p class="c-app-header__lead">
				Специализируемся на исследованиях, разработке, производстве лекарственных средств, лабораторного оборудования и медицинской техники
				</p>

				<div class="c-app-header__btn-group">
					<?// START: Button ?>
					<a
						class="
							c-btn
							c-btn--kind-primary
							c-btn--size-lg
							c-app-header__btn
						"
						href="/products/"
					>
						<span class="c-btn__overlay"></span>
						<span class="c-btn__content">
							Перейти в каталог
						</span>
					</a>
					<?// END: Button ?>
				</div>
			</div>
		</div>
	</div>
</header>
<?// END: App header ?>

<?// START: Main ?>
<main class="o-main">
	<div class="o-main__wrap">

		<?$APPLICATION->IncludeComponent(
			"bitrix:main.include","",
			Array(
				"AREA_FILE_SHOW" => "file",
				"PATH" => "/include/main-page/.sale_timer.php",
				"EDIT_TEMPLATE" => ""
			)
		);?>

		<?/*$APPLICATION->IncludeComponent(
			"bitrix:main.include",
			".default",
			array(
				"COMPONENT_TEMPLATE" => ".default",
				"AREA_FILE_SHOW" => "file",
				"PATH" => "/include/banner_careus_antigen.php",
				"EDIT_TEMPLATE" => ""
			),
			false
		);*/?>

		<?
		$GLOBALS['presentFilter'] = ["!PROPERTY_SHOW_PRESENT" => false];
		$APPLICATION->IncludeComponent(
			"mediahead:element.list",
			"partner-present",
			array(
				"ACTIVE_DATE_FORMAT" => "j F Y",
				"ADD_SECTIONS_CHAIN" => "N",
				"AJAX_MODE" => "N",
				"AJAX_OPTION_ADDITIONAL" => "",
				"AJAX_OPTION_HISTORY" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"CACHE_FILTER" => "N",
				"CACHE_GROUPS" => "N",
				"CACHE_TIME" => "36000000",
				"CACHE_TYPE" => "A",
				"CHECK_DATES" => "Y",
				"DETAIL_URL" => "",
				"DISPLAY_BOTTOM_PAGER" => "Y",
				"DISPLAY_DATE" => "Y",
				"DISPLAY_NAME" => "Y",
				"DISPLAY_PICTURE" => "Y",
				"DISPLAY_PREVIEW_TEXT" => "Y",
				"DISPLAY_TOP_PAGER" => "N",
				"FIELD_CODE" => array(
					0 => "PREVIEW_PICTURE",
					1 => "DETAIL_PICTURE",
					2 => "",
				),
				"FILTER_NAME" => "presentFilter",
				"HIDE_LINK_WHEN_NO_DETAIL" => "N",
				"IBLOCK_ID" => "2",
				"IBLOCK_TYPE" => "catalog",
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
				"INCLUDE_SUBSECTIONS" => "Y",
				"MEDIA_PROPERTY" => "",
				"MESSAGE_404" => "",
				"NEWS_COUNT" => "10",
				"PAGER_BASE_LINK_ENABLE" => "N",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
				"PAGER_SHOW_ALL" => "N",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => ".default",
				"PAGER_TITLE" => "Новости",
				"PARENT_SECTION" => "",
				"PARENT_SECTION_CODE" => "",
				"PREVIEW_TRUNCATE_LEN" => "",
				"PROPERTY_CODE" => array(
					0 => "EN_NAME",
					1 => "",
				),
				"SEARCH_PAGE" => "/search/",
				"SET_BROWSER_TITLE" => "N",
				"SET_LAST_MODIFIED" => "N",
				"SET_META_DESCRIPTION" => "N",
				"SET_META_KEYWORDS" => "N",
				"SET_STATUS_404" => "N",
				"SET_TITLE" => "N",
				"SHOW_404" => "N",
				"SLIDER_PROPERTY" => "",
				"SORT_BY1" => "ACTIVE_FROM",
				"SORT_BY2" => "SORT",
				"SORT_ORDER1" => "DESC",
				"SORT_ORDER2" => "ASC",
				"STRICT_SECTION_CHECK" => "N",
				"TEMPLATE_THEME" => "blue",
				"USE_RATING" => "N",
				"USE_SHARE" => "N",
				"COMPONENT_TEMPLATE" => "media",
				"HEADER" => "Наша компания"
			),
			false
		);?>

		<?// START: Video Player ?>
		<section class="c-app-section c-app-section--density-default c-video-player" >
			<div class="o-container@lg c-video-player__container" id="video-player">
				<div class="c-video-block__body">
					<video src="/upload/videos/avivir-video/avivir-video.mp4" 
						width="100%" 
						height="100%"
						class="mejs__player"
						id="main-video-player"
						type="video/mp4"
						poster="/upload/images/video-player/video-avivir-placeholder.jpeg" 
						data-mejsoptions='{"pluginPath": "/path/to/shims/", "alwaysShowControls": "true" }'>
					</video>
				</div>
			</div>
		</section>
		<?// END: Video Player ?>

		<?// START: Company partners ?>
		<section class="c-app-section c-app-section--density-comfortable">
			<div class="c-app-section__header">
				<div class="o-container@lg">
					<h2 class="c-app-section__title">
						Партнёры компании
					</h2>
				</div>
			</div>

			<div class="c-app-section__body">
				<?
				$GLOBALS['slidersFilter'] = ["!PROPERTY_SHOW_SLIDERS" => false];
				$APPLICATION->IncludeComponent(
					"mediahead:element.list",
					"partner-list-carousel",
					array(
						"ACTIVE_DATE_FORMAT" => "j F Y",
						"ADD_SECTIONS_CHAIN" => "N",
						"AJAX_MODE" => "N",
						"AJAX_OPTION_ADDITIONAL" => "",
						"AJAX_OPTION_HISTORY" => "N",
						"AJAX_OPTION_JUMP" => "N",
						"AJAX_OPTION_STYLE" => "Y",
						"CACHE_FILTER" => "N",
						"CACHE_GROUPS" => "N",
						"CACHE_TIME" => "36000000",
						"CACHE_TYPE" => "A",
						"CHECK_DATES" => "Y",
						"DETAIL_URL" => "",
						"DISPLAY_BOTTOM_PAGER" => "Y",
						"DISPLAY_DATE" => "Y",
						"DISPLAY_NAME" => "Y",
						"DISPLAY_PICTURE" => "Y",
						"DISPLAY_PREVIEW_TEXT" => "Y",
						"DISPLAY_TOP_PAGER" => "N",
						"FIELD_CODE" => array(
							0 => "PREVIEW_PICTURE",
							1 => "DETAIL_PICTURE",
							2 => "",
						),
						"FILTER_NAME" => "slidersFilter",
						"HIDE_LINK_WHEN_NO_DETAIL" => "N",
						"IBLOCK_ID" => "2",
						"IBLOCK_TYPE" => "catalog",
						"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
						"INCLUDE_SUBSECTIONS" => "Y",
						"MEDIA_PROPERTY" => "",
						"MESSAGE_404" => "",
						"NEWS_COUNT" => "10",
						"PAGER_BASE_LINK_ENABLE" => "N",
						"PAGER_DESC_NUMBERING" => "N",
						"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
						"PAGER_SHOW_ALL" => "N",
						"PAGER_SHOW_ALWAYS" => "N",
						"PAGER_TEMPLATE" => ".default",
						"PAGER_TITLE" => "Новости",
						"PARENT_SECTION" => "",
						"PARENT_SECTION_CODE" => "",
						"PREVIEW_TRUNCATE_LEN" => "",
						"PROPERTY_CODE" => array(
							0 => "EN_NAME",
							1 => "",
						),
						"SEARCH_PAGE" => "/search/",
						"SET_BROWSER_TITLE" => "N",
						"SET_LAST_MODIFIED" => "N",
						"SET_META_DESCRIPTION" => "N",
						"SET_META_KEYWORDS" => "N",
						"SET_STATUS_404" => "N",
						"SET_TITLE" => "N",
						"SHOW_404" => "N",
						"SLIDER_PROPERTY" => "",
						"SORT_BY1" => "ACTIVE_FROM",
						"SORT_BY2" => "SORT",
						"SORT_ORDER1" => "DESC",
						"SORT_ORDER2" => "ASC",
						"STRICT_SECTION_CHECK" => "N",
						"TEMPLATE_THEME" => "blue",
						"USE_RATING" => "N",
						"USE_SHARE" => "N",
						"COMPONENT_TEMPLATE" => "media",
						"HEADER" => "Наша компания"
					),
					false
				);?>
			</div>
		</section>
		<?// END: Company partners ?>


		<?$APPLICATION->IncludeComponent(
			"mediahead:element.list",
			"media",
			array(
				"ACTIVE_DATE_FORMAT" => "j F Y",
				"ADD_SECTIONS_CHAIN" => "N",
				"AJAX_MODE" => "N",
				"AJAX_OPTION_ADDITIONAL" => "",
				"AJAX_OPTION_HISTORY" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"CACHE_FILTER" => "N",
				"CACHE_GROUPS" => "N",
				"CACHE_TIME" => "36000000",
				"CACHE_TYPE" => "A",
				"CHECK_DATES" => "Y",
				"DETAIL_URL" => "",
				"DISPLAY_BOTTOM_PAGER" => "Y",
				"DISPLAY_DATE" => "Y",
				"DISPLAY_NAME" => "Y",
				"DISPLAY_PICTURE" => "Y",
				"DISPLAY_PREVIEW_TEXT" => "Y",
				"DISPLAY_TOP_PAGER" => "N",
				"FIELD_CODE" => array(
					0 => "PREVIEW_PICTURE",
					1 => "DETAIL_PICTURE",
					2 => "",
				),
				"FILTER_NAME" => "",
				"HIDE_LINK_WHEN_NO_DETAIL" => "N",
				"IBLOCK_ID" => "5",
				"IBLOCK_TYPE" => "info",
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
				"INCLUDE_SUBSECTIONS" => "Y",
				"MEDIA_PROPERTY" => "",
				"MESSAGE_404" => "",
				"NEWS_COUNT" => "10",
				"PAGER_BASE_LINK_ENABLE" => "N",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
				"PAGER_SHOW_ALL" => "N",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => ".default",
				"PAGER_TITLE" => "Новости",
				"PARENT_SECTION" => "",
				"PARENT_SECTION_CODE" => "",
				"PREVIEW_TRUNCATE_LEN" => "",
				"PROPERTY_CODE" => array(
					0 => "EN_NAME",
					1 => "",
				),
				"SEARCH_PAGE" => "/search/",
				"SET_BROWSER_TITLE" => "N",
				"SET_LAST_MODIFIED" => "N",
				"SET_META_DESCRIPTION" => "N",
				"SET_META_KEYWORDS" => "N",
				"SET_STATUS_404" => "N",
				"SET_TITLE" => "N",
				"SHOW_404" => "N",
				"SLIDER_PROPERTY" => "",
				"SORT_BY1" => "ACTIVE_FROM",
				"SORT_BY2" => "SORT",
				"SORT_ORDER1" => "DESC",
				"SORT_ORDER2" => "ASC",
				"STRICT_SECTION_CHECK" => "N",
				"TEMPLATE_THEME" => "blue",
				"USE_RATING" => "N",
				"USE_SHARE" => "N",
				"COMPONENT_TEMPLATE" => "media"
			),
			false
		);?>

		<?/*$APPLICATION->IncludeComponent(
			"bitrix:main.include",
			".default",
			array(
				"COMPONENT_TEMPLATE" => ".default",
				"AREA_FILE_SHOW" => "file",
				"PATH" => "/include/banner_testing.php",
				"EDIT_TEMPLATE" => ""
			),
			false
		);*/?>

		<?$APPLICATION->IncludeComponent(
			"mediahead:banners", 
			"banners", 
			array(
				"MESTO" => "9",
			),
			false
		);?>

	</div>
</main>
<?// END: Main ?>



<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
