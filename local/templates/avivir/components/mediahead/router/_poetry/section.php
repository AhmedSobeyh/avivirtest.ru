<?
use Bitrix\Main\Loader;

if ($arResult['VARIABLES']['SECTION_ID'])
{
	$sectionId = $arResult['VARIABLES']['SECTION_ID'];

	$obSection = new \CIblockSection;
	$obEnum = new \CUserFieldEnum;

	$hasChildren = $obSection->GetCount(["SECTION_ID" => $sectionId]) > 0 ? true : false;
	$select = ['ID','NAME','IBLOCK_ID','UF_YEAR','UF_LIST_TEMPLATE','UF_SECTION_TEMPLATE','DEPTH_LEVEL','PICTURE','DESCRIPTION'];

	// Наследование шаблона вывода подразделов и элементов
	$rsTree = $obSection->GetNavChain( $arParams['IBLOCK_ID'], $sectionId, $select);
	while($topSection = $rsTree->Fetch())
	{
		$tree[$topSection['DEPTH_LEVEL']] = $topSection;
		$treeIds[] = $topSection['ID'];
	}

	// Т.к. GetNavChain не умеет выбирать UF_ поля - приходится делать повторный запрос
	$rsTreeWithUf = $obSection->GetList([], ["ID" => $treeIds, "IBLOCK_ID" => $arParams["IBLOCK_ID"]],false, $select);
	while ($topSection = $rsTreeWithUf->Fetch())
	{
		$tree[$topSection['DEPTH_LEVEL']] = $topSection;
	}

	krsort($tree);
	$sectionsTree = $tree;
	unset($tree);

	foreach($sectionsTree as $section)
	{

		if ($section['ID'] == $sectionId)
		{
			$currentSection = $section;
		}

		if ($section["UF_SECTION_TEMPLATE"] && empty($currentSection['TPL_SECTION']))
		{

			$raw = $obEnum->GetList(array(), array("ID" => $section["UF_SECTION_TEMPLATE"]))->Fetch();
			if ($raw['XML_ID'])
			{
				$currentSection['TPL_SECTION'] = $raw['XML_ID'];
			}
		}

		if ($section["UF_LIST_TEMPLATE"] && empty($currentSection['TPL_LIST']))
		{

			$raw = $obEnum->GetList(array(), array("ID" => $section["UF_SECTION_TEMPLATE"]))->Fetch();
			if ($raw['XML_ID'])
			{
				$currentSection['TPL_LIST'] = $raw['XML_ID'];
			}
		}
	}

	if ($currentSection['PICTURE'])
	{
		$currentSection['PICTURE_ID'] = $currentSection['PICTURE'];
		$currentSection['PICTURE'] = CFile::ResizeImageGet($currentSection['PICTURE_ID'],["width" => 263, "height" => 355],BX_RESIZE_IMAGE_PROPORTIONAL,true);
	}

}
?>

<main class="c-poetry-section-page">
	<div class="c-poetry-section-page-description c-poetry-section-page__description">
		<div class="o-container@md c-poetry-section-page-description__container">
			<div class="o-image-stack o-image-stack__container c-poetry-section-page-description__media">
				<?
				if( $currentSection['PICTURE']['src'] )
					$picture = $currentSection['PICTURE']['src'];
				else
					$picture = SITE_TEMPLATE_PATH.'/assets/images/placeholder/poetry-placeholder.svg';
				?>
				<img class="o-image-stack__img c-poetry-section-page-description__img" src="<?=$picture?>" alt="">
				<img class="o-image-stack__img c-poetry-section-page-description__img" src="<?=$picture?>" alt="">
				<img class="o-image-stack__img c-poetry-section-page-description__img" src="<?=$picture?>" alt="">
			</div>
			<div class="c-poetry-section-page-description__body">
				<h2 class="c-poetry-section-page-description__title">Описание сборника</h2>
				<div class="c-poetry-section-page-description__text s-poetry-section-page-description-text">
					<?=$currentSection['DESCRIPTION']?>
				</div>
			</div>

			<div class="o-decor-divider"></div>
		</div>
	</div>


	<?
	//apre($currentSection, 'section');
	$APPLICATION->IncludeComponent(
		"levitansky:element.list",
		"poetry",
		Array(
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"NEWS_COUNT" => "1000",
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

			"MEDIA_IBLOCK_ID" => $arParams["MEDIA_IBLOCK_ID"],
			"TRANSLATE_IBLOCK_ID" => $arParams["TRANSLATE_IBLOCK_ID"],

			"CURRENT_SECTION" => $currentSection,

		),
		$component
	);
	?>

	<div class="c-poetry-section-page__poetry-section-carousel">
			<?
			$GLOBALS["poetry_section_filter"] = array(
				"!ID" => $currentSection["ID"]
			);

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
				"HIDE_SECTION_NAME" => "Y",
				"ADD_SECTIONS_CHAIN" => '',
				"SECTION_USER_FIELDS" => array("UF_YEAR", "UF_OTHER"),

				"FILTER_NAME" => "poetry_section_filter",
				"HEADER" => $arParams["OTHER_HEADER"]
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
</main>
