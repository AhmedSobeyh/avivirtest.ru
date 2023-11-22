<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Официальные документы — компания «Авивир»");
$APPLICATION->SetPageProperty("description", "Официальные документы компании «Авивир». Кодекс этики. Антимонопольная политика. Антикоррупционная политика.");
$APPLICATION->SetTitle("Официальные документы");
?>

<? // START: Main 
?>
<div class="content-block-ContentBlock-module-block">
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
			Официальные документы
		</h2>
		<? $APPLICATION->IncludeComponent(
			"bitrix:news.list",
			"documents",
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
				"IBLOCK_ID" => "8",
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
				"COMPONENT_TEMPLATE" => "media",
				"HEADER" => "Наша компания"
			),
			false
		); ?>
	</div>
</div>

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

<? // END: Main 
?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>