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

<main class="c-poetry-list-page">
	<div class="c-poetry-list-page-poetry-section-carousel" id="poetrySections">
		<div class="c-poetry-list-page-poetry-section-carousel__container">
			<?
			use Bitrix\Main\Loader;

			$sectionListParams = array(
				"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
				"IBLOCK_ID" => $arParams["IBLOCK_ID"],
				"CACHE_TYPE" => $arParams["CACHE_TYPE"],
				"CACHE_TIME" => $arParams["CACHE_TIME"],
				"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
				"COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
				"TOP_DEPTH" => $arParams["SECTION_TOP_DEPTH"],
				"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
				"VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
				"SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
				"HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
				"ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : ''),
				"SECTION_USER_FIELDS" => array("UF_YEAR", "UF_OTHER")
			);

			$APPLICATION->IncludeComponent(
				"levitansky:section.list",
				"poetry",
				$sectionListParams,
				$component,
				array("HIDE_ICONS" => "Y")
			);
			?>
		</div>
	</div>


	<?
	$elementsListParams = Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"NEWS_COUNT" => "10000", //$arParams["NEWS_COUNT"],
		"SORT_BY1" => "NAME",//$arParams["SORT_BY1"],
		"SORT_ORDER1" => "ASC", //$arParams["SORT_ORDER1"],
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

		"MEDIA_IBLOCK_ID" => $arParams["MEDIA_IBLOCK_ID"],
		"TRANSLATE_IBLOCK_ID" => $arParams["TRANSLATE_IBLOCK_ID"],
		"LETTER_SORT" => "Y"
	);

	$isFilter = ($arParams['USE_FILTER'] == 'Y');

	if ($isFilter)
	{

		$arFilter = array(
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"ACTIVE" => "Y",
			"GLOBAL_ACTIVE" => "Y",
		);
		if (0 < intval($arResult["VARIABLES"]["SECTION_ID"]))
			$arFilter["ID"] = $arResult["VARIABLES"]["SECTION_ID"];
		elseif ('' != $arResult["VARIABLES"]["SECTION_CODE"])
			$arFilter["=CODE"] = $arResult["VARIABLES"]["SECTION_CODE"];

		$obCache = new CPHPCache();
		if ($obCache->InitCache(36000, serialize($arFilter), "/iblock/catalog"))
		{
			$arCurSection = $obCache->GetVars();
		}
		elseif ($obCache->StartDataCache())
		{
			$arCurSection = array();
			if (Loader::includeModule("iblock"))
			{
				$dbRes = CIBlockSection::GetList(array(), $arFilter, false, array("ID"));

				if(defined("BX_COMP_MANAGED_CACHE"))
				{
					global $CACHE_MANAGER;
					$CACHE_MANAGER->StartTagCache("/iblock/catalog");

					if ($arCurSection = $dbRes->Fetch())
						$CACHE_MANAGER->RegisterTag("iblock_id_".$arParams["IBLOCK_ID"]);

					$CACHE_MANAGER->EndTagCache();
				}
				else
				{
					if(!$arCurSection = $dbRes->Fetch())
						$arCurSection = array();
				}
			}
			$obCache->EndDataCache($arCurSection);
		}
		if (!isset($arCurSection))
			$arCurSection = array();

		if (!$_SESSION['POETRY_SORT'])
		{
			$_SESSION['POETRY_SORT'] = !empty($_REQUEST['sort']) ? $_REQUEST['sort'] : 'NAME';
		}
		else
		{
			$_SESSION['POETRY_SORT'] = !empty($_REQUEST['sort']) ? $_REQUEST['sort'] : $_SESSION['POETRY_SORT'];
		}

		//apre();
		$elementsListParams['SORT_BY1'] = $_SESSION['POETRY_SORT'];
		$elementsListParams['SORT_ORDER1'] = $_SESSION['POETRY_SORT'] == 'RAND' ? 'RAND' : 'ASC';

		if ($elementsListParams['SORT_BY1'] != 'NAME')
		{
			$elementsListParams['LETTER_SORT'] = 'N';
		}


		if (strpos($_SERVER['REQUEST_URI'], '/filter') !== false && strpos($_SERVER['REQUEST_URI'], '/filter/clear') === false) {
			$elementsListParams['LETTER_SORT'] = 'N';
		}



		$APPLICATION->IncludeComponent(
			"levitansky:smart.filter",
			"poetry",
			array(
				"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
				"IBLOCK_ID" => $arParams["IBLOCK_ID"],
				"SECTION_ID" => "0",//$arCurSection['ID'],
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
				"SORT" => $elementsListParams['SORT_BY1']
			),
			$component,
			array('HIDE_ICONS' => 'Y')
		);


	}
	?>

	<div id="filterResult">
		<?
		if ($_SERVER['HTTP_BX_AJAX'] == 'true')
			$APPLICATION->RestartBuffer();



		if ($_SERVER['HTTP_BX_AJAX'] == 'true')
		{
			//apre($GLOBALS['prefilter'], 'prefilter');
			//apre($a, 'getList');
			//apre($_REQUEST, 'request');
		}

		if ($GLOBALS['filterHasCheckedValues'])
		{
			$elementsListParams['FILTER_HAS_CHECKED_VALUES'] = !empty($GLOBALS["SUBTITLE"]) ? $GLOBALS["SUBTITLE"] :  'true';
			$elementsListParams['HEADER'] = !empty($GLOBALS["SUBTITLE"]) ? $GLOBALS["SUBTITLE"] :  'Отобранные произведения';
		}

		// if (strpos($GLOBALS["APPLICATION"]->GetCurPage(true), "/index.php" !=0)
		// {

		// }

		$APPLICATION->IncludeComponent(
			"levitansky:element.list",
			"poetry",
			$elementsListParams,
			$component
		);

		if ($_SERVER['HTTP_BX_AJAX'] == 'true')
			exit();
		?>
	</div>
</main>
