<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title","Частным лицам — компания «Авивир»");
$APPLICATION->SetPageProperty("description", "Информация о возможности приобретения нашей продукции для частного использования, а также о клиниках и лабораториях, проводящих тестирования с применением нашей продукции.");
$APPLICATION->SetTitle("Частным лицам");
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

				<? /* START: Picture */ ?>
				<picture class="c-picture o-ratio o-ratio--1x1">
					<img
						class="c-picture__img c-picture__img--contain"
						src="/upload/images/renders/render-molecule.png"
						alt="<? $APPLICATION->ShowTitle(); ?>"
					/>
				</picture>
				<? /* END: Picture */ ?>
			</div>

			<div class="c-app-header__body">
				<h1 class="c-app-header__title"><? $APPLICATION->ShowTitle(true); ?></h1>

				<p class="c-app-header__lead">
					<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						Array(
							"AREA_FILE_RECURSIVE" => "N",
							"AREA_FILE_SHOW" => "file",
							"AREA_FILE_SUFFIX" => "",
							"EDIT_TEMPLATE" => "",
							"COMPONENT_TEMPLATE" => ".default",
							"PATH" => "/individuals/.subheader_inc.php",
						),
						$component
					);?>
				</p>
			</div>
		</div>
	</div>
</header>
<?// END: App header ?>

<?// START: Main ?>
<main class="o-main">
	<div class="o-main__wrap">
		<?$APPLICATION->IncludeComponent(
			"bitrix:main.include",
			".default",
			array(
				"COMPONENT_TEMPLATE" => ".default",
				"AREA_FILE_SHOW" => "file",
				"PATH" => "/include/banner_careus_antigen.php",
				"EDIT_TEMPLATE" => ""
			),
			false
		);?>

		<!-- START: Dynamic banner -->
		<section class="
			c-dynamic-banner
			c-dynamic-banner--size-lg
			c-dynamic-banner--density-compact
			c-dynamic-banner--center-body@lg
			c-dynamic-banner--split-reverse@lg
			c-dynamic-banner--displaced-reverse@xl
		">
			<div class="o-container@lg c-dynamic-banner__container">
				<div class="c-dynamic-banner__layout">
					<div class="c-dynamic-banner__media c-dynamic-banner__media--align-center">
						<div
							class="o-bg-holder c-dynamic-banner__media-bg-holder"
							style="background-image: url(/upload/images/backgrounds/bg-plus-grid-color-primary-01.svg);"
						></div>

						<? // START: Picture ?>
						<picture class="c-picture c-dynamic-banner__picture">
							<img
								class="c-picture__img c-picture__img--contain c-dynamic-banner__img"
								src="/upload/images/renders/render-molecule.png"
								alt="Статистика Covid-19"
							>
						</picture>
						<? // END: Picture ?>
					</div>
					<div class="c-dynamic-banner__body">
						<h2 class="c-dynamic-banner__title">
							Статистика Covid-19
						</h2>

						<p class="c-dynamic-banner__text">
							Вы можете следить за динамикой новых случаев смерти от коронавируса в некоторых странах Западной Европы, США, Израиле и России.
						</p>

						<div class="c-dynamic-banner__btn-group">
							<?// START: Button ?>
							<a
								class="c-btn c-btn--kind-primary c-btn--size-lg c-dynamic-banner__btn"
								href="/individuals/covid-stat/"
							>
								<span class="c-btn__overlay"></span>
								<span class="c-btn__content">
									Подробнее
								</span>
							</a>
							<?// END: Button ?>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- END: Dynamic banner -->

		<!-- START: Dynamic banner -->
		<section class="
			c-dynamic-banner
			c-dynamic-banner--size-lg
			c-dynamic-banner--density-compact
			c-dynamic-banner--center-body@lg
			c-dynamic-banner--split@lg
			c-dynamic-banner--displaced@xl
			u-bg-light-mint
		">
			<div class="o-container@lg c-dynamic-banner__container">
				<div class="c-dynamic-banner__layout">
					<div class="c-dynamic-banner__media c-dynamic-banner__media--align-center">
						<div
							class="o-bg-holder c-dynamic-banner__media-bg-holder"
							style="background-image: url(/upload/images/backgrounds/bg-plus-grid-color-primary-02.svg);"
						></div>

						<? // START: Picture ?>
						<picture class="c-picture c-dynamic-banner__picture">
							<img
								class="c-picture__img c-picture__img--contain c-dynamic-banner__img"
								src="/upload/images/renders/render-plus.png"
								alt="Обзор вакцин"
							>
						</picture>
						<? // END: Picture ?>
					</div>
					<div class="c-dynamic-banner__body">
						<h2 class="c-dynamic-banner__title">
							Обзор вакцин
						</h2>

						<p class="c-dynamic-banner__text">
							Подробная и актуальная информация по разрабатываемым и используемым вакцинам от COVID-19 как в России, так и за рубежом.
						</p>

						<div class="c-dynamic-banner__btn-group">
							<?// START: Button ?>
							<a
								class="c-btn c-btn--kind-primary c-btn--size-lg c-dynamic-banner__btn"
								href="/individuals/vaccines/"
							>
								<span class="c-btn__overlay"></span>
								<span class="c-btn__content">
									Подробнее
								</span>
							</a>
							<?// END: Button ?>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- END: Dynamic banner -->

		<!-- START: Dynamic banner -->
		<section class="
			c-dynamic-banner
			c-dynamic-banner--size-lg
			c-dynamic-banner--density-compact
			c-dynamic-banner--center-body@lg
			c-dynamic-banner--split-reverse@lg
			c-dynamic-banner--displaced-reverse@xl
		">
			<div class="o-container@lg c-dynamic-banner__container">
				<div class="c-dynamic-banner__layout">
					<div class="c-dynamic-banner__media c-dynamic-banner__media--align-center">
						<div
							class="o-bg-holder c-dynamic-banner__media-bg-holder"
							style="background-image: url(/upload/images/backgrounds/bg-plus-grid-color-primary-01.svg);"
						></div>

						<? // START: Picture ?>
						<picture class="c-picture c-dynamic-banner__picture">
							<img
								class="c-picture__img c-picture__img--contain c-dynamic-banner__img"
								src="/upload/images/renders/render-map-marker.png"
								alt="Выездное тестирование"
							>
						</picture>
						<? // END: Picture ?>
					</div>
					<div class="c-dynamic-banner__body">
						<h2 class="c-dynamic-banner__title">
							Выездное тестирование
						</h2>

						<p class="c-dynamic-banner__text">
							В любой момент вы можете заказать выездное тестирование на Covid-19 с помощью наших экспресс-тестов у наших коллег в H-Сlinic.
						</p>

						<div class="c-dynamic-banner__btn-group">
							<?// START: Button ?>
							<a
								class="c-btn c-btn--kind-primary c-btn--size-lg c-dynamic-banner__btn"
								href="/services/testing-emergency/"
							>
								<span class="c-btn__overlay"></span>
								<span class="c-btn__content">
									Подробнее
								</span>
							</a>
							<?// END: Button ?>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- END: Dynamic banner -->

		<!-- START: Dynamic banner -->
		<section class="
			c-dynamic-banner
			c-dynamic-banner--size-lg
			c-dynamic-banner--density-compact
			c-dynamic-banner--center-body@lg
			c-dynamic-banner--split@lg
			c-dynamic-banner--displaced@xl
			u-bg-light-mint
		">
			<div class="o-container@lg c-dynamic-banner__container">
				<div class="c-dynamic-banner__layout">
					<div class="c-dynamic-banner__media c-dynamic-banner__media--align-center">
						<div
							class="o-bg-holder c-dynamic-banner__media-bg-holder"
							style="background-image: url(/upload/images/backgrounds/bg-plus-grid-color-primary-02.svg);"
						></div>

						<? // START: Picture ?>
						<picture class="c-picture c-dynamic-banner__picture">
							<img
								class="c-picture__img c-picture__img--contain c-dynamic-banner__img"
								src="/upload/images/renders/render-user-friends.png"
								alt="Вероятность госпитализации"
							>
						</picture>
						<? // END: Picture ?>
					</div>
					<div class="c-dynamic-banner__body">
						<h2 class="c-dynamic-banner__title">
							Вероятность госпитализации
						</h2>

						<p class="c-dynamic-banner__text">
							Узнайте вероятность госпитализации при заболевании COVID-19 в специальном калькуляторе от Avivir.
						</p>

						<div class="c-dynamic-banner__btn-group">
							<?// START: Button ?>
							<a
								class="c-btn c-btn--kind-primary c-btn--size-lg c-dynamic-banner__btn"
								href="/calculatedata/"
							>
								<span class="c-btn__overlay"></span>
								<span class="c-btn__content">
									Подробнее
								</span>
							</a>
							<?// END: Button ?>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- END: Dynamic banner -->

		<div class="c-test-kit-partner-action c-test-kit-page__partner-action" id="retail-distributors">
			<?$APPLICATION->IncludeComponent(
				"mediahead:element.list",
				"partner",
				array(
					"ACTIVE_DATE_FORMAT" => "j F Y",
					"ADD_SECTIONS_CHAIN" => "N",
					"AJAX_MODE" => "N",
					"CACHE_FILTER" => "N",
					"CACHE_GROUPS" => "N",
					"CACHE_TIME" => "36000000",
					"CACHE_TYPE" => "A",
					"DISPLAY_BOTTOM_PAGER" => "N",
					"DISPLAY_PICTURE" => "Y",
					"DISPLAY_TOP_PAGER" => "N",
					"FIELD_CODE" => array(
						0 => "PREVIEW_PICTURE",
						1 => "DETAIL_PICTURE",
						2 => "",
					),
					"FILTER_NAME" => "",
					"IBLOCK_ID" => "2",
					"IBLOCK_TYPE" => "catalog",
					"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
					"INCLUDE_SUBSECTIONS" => "Y",
					"NEWS_COUNT" => "50",
					"PAGER_BASE_LINK_ENABLE" => "N",
					"PAGER_DESC_NUMBERING" => "N",
					"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
					"PAGER_SHOW_ALL" => "N",
					"PAGER_SHOW_ALWAYS" => "N",
					"PARENT_SECTION" => "7",
					"PARENT_SECTION_CODE" => "",
					"PROPERTY_CODE" => array(
						0 => "EN_NAME",
						1 => "",
					),
					"SET_BROWSER_TITLE" => "N",
					"SET_LAST_MODIFIED" => "N",
					"SET_META_DESCRIPTION" => "N",
					"SET_META_KEYWORDS" => "N",
					"SET_STATUS_404" => "N",
					"SET_TITLE" => "N",
					"SHOW_404" => "N",
					"SORT_BY1" => "SORT",
					"SORT_ORDER1" => "ASC",
					"STRICT_SECTION_CHECK" => "N",
					"HEADER" => "Купить тесты для личного использования"
				),
				false
			);?>

			<?$APPLICATION->IncludeComponent(
				"mediahead:element.list",
				"partner",
				array(
					"ACTIVE_DATE_FORMAT" => "j F Y",
					"ADD_SECTIONS_CHAIN" => "N",
					"AJAX_MODE" => "N",
					"CACHE_FILTER" => "N",
					"CACHE_GROUPS" => "N",
					"CACHE_TIME" => "36000000",
					"CACHE_TYPE" => "A",
					"DISPLAY_BOTTOM_PAGER" => "N",
					"DISPLAY_PICTURE" => "Y",
					"DISPLAY_TOP_PAGER" => "N",
					"FIELD_CODE" => array(
						0 => "PREVIEW_PICTURE",
						1 => "DETAIL_PICTURE",
						2 => "",
					),
					"FILTER_NAME" => "",
					"IBLOCK_ID" => "2",
					"IBLOCK_TYPE" => "catalog",
					"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
					"INCLUDE_SUBSECTIONS" => "Y",
					"NEWS_COUNT" => "50",
					"PAGER_BASE_LINK_ENABLE" => "N",
					"PAGER_DESC_NUMBERING" => "N",
					"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
					"PAGER_SHOW_ALL" => "N",
					"PAGER_SHOW_ALWAYS" => "N",
					"PARENT_SECTION" => "8",
					"PARENT_SECTION_CODE" => "",
					"PROPERTY_CODE" => array(
						0 => "EN_NAME",
						1 => "",
					),
					"SET_BROWSER_TITLE" => "N",
					"SET_LAST_MODIFIED" => "N",
					"SET_META_DESCRIPTION" => "N",
					"SET_META_KEYWORDS" => "N",
					"SET_STATUS_404" => "N",
					"SET_TITLE" => "N",
					"SHOW_404" => "N",
					"SORT_BY1" => "SORT",
					"SORT_ORDER1" => "ASC",
					"STRICT_SECTION_CHECK" => "N",
					"HEADER" => "Пройти тестирование"
				),
				false
			);?>
		</div>

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
				"NEWS_COUNT" => "7",
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
	</div>
</main>
<?// END: Main ?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
