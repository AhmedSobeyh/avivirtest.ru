<main class="c-media-section-page">

	<!-- section.list здесь -->

	<div class="c-media-section-page__media-list">

		<?
		
		if ($arResult['VARIABLES']['SECTION_ID']) {

			// todo: перенсти этот код в модуль и закешировать
			$sectionId = $arResult['VARIABLES']['SECTION_ID'];

			$obSection = new \CIblockSection;
			$obEnum = new \CUserFieldEnum;

			$hasChildren = $obSection->GetCount(["SECTION_ID" => $sectionId]) > 0 ? true : false;
			$select = ['ID','NAME','IBLOCK_ID','IBLOCK_SECTION_ID','UF_LIST_TEMPLATE','UF_SECTION_TEMPLATE','DEPTH_LEVEL'];

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
		}

		//apre($currentSection, 'section');
		
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
			"SHOW_PARENT_NAME" => "N", //$arParams["SECTIONS_SHOW_PARENT_NAME"],
			"HIDE_SECTION_NAME" => "N",
			"ADD_SECTIONS_CHAIN" => '',
			"SECTION_USER_FIELDS" => array("UF_YEAR"),
			"SECTION" => $arResult["VARIABLES"]["SECTION_ID"],
			"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
			"SET_TITLE" => $hasChildren ? "Y" : "N",
		);

		$sectionTemplate = !empty($currentSection['TPL_SECTION']) ? $currentSection['TPL_SECTION'] : '.default';

		$APPLICATION->IncludeComponent(
			"levitansky:section.list",
			$sectionTemplate,
			$sectionListParams,
			$component,
			array("HIDE_ICONS" => "Y")
		);

		if (!$hasChildren) {

			$sectionTemplate = !empty($currentSection['TPL_LIST']) ? $currentSection['TPL_LIST'] : '.default';

			//apre($arParams,'params');

			$APPLICATION->IncludeComponent(
				"levitansky:element.list",
				$sectionTemplate,
				Array(
					"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
					"IBLOCK_ID" => $arParams["IBLOCK_ID"],
					"NEWS_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
					"SORT_BY1" => $arParams["SORT_BY1"],
					"SORT_ORDER1" => $arParams["SORT_ORDER1"],
					"SORT_BY2" => $arParams["SORT_BY2"],
					"SORT_ORDER2" => $arParams["SORT_ORDER2"],
					"FIELD_CODE" => ['DETAIL_PICTURE','PREVIEW_PICTURE','PREVIEW_TEXT','DETAIL_TEXT'], //$arParams["LIST_FIELD_CODE"],
					"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
					"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
					"SET_TITLE" => $arParams["SET_TITLE"],
					"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
					"MESSAGE_404" => $arParams["MESSAGE_404"],
					"SET_STATUS_404" => $arParams["SET_STATUS_404"],
					"SHOW_404" => $arParams["SHOW_404"],
					"FILE_404" => $arParams["FILE_404"],
					"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
					"ADD_SECTIONS_CHAIN" => "N", //$arParams["ADD_SECTIONS_CHAIN"],
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
				),
				$component
			);
		}?>

	</div>

	<?
	if (!$hasChildren) {
		$sectionListParams['SECTION_ID'] = $currentSection['IBLOCK_SECTION_ID'];
		unset($sectionListParams['SECTION_CODE']);
		?>

		<?if ($sectionTemplate == "audio") {
			$sectionListParams['HEADER'] = "Послушать ещё";
			?>

			<div class="c-media-section-page__audio-section-list">
				<?$APPLICATION->IncludeComponent(
					"levitansky:section.list",
					"audio",
					$sectionListParams,
					$component,
					array("HIDE_ICONS" => "Y")
				);?>
			</div>

		<?
		}

		if ($sectionTemplate == "photo") {
			$sectionListParams['HEADER'] = "Другие фотоальбомы";
		
		
		// Покажем все фотоальбомы из раздела «Фотографии»
		// если мы находимся в архивных документах
		if ( $arResult['VARIABLES']['SECTION_ID'] == 20 )
		{
			$sectionListParams['SECTION'] = 17;
			$sectionListParams['SECTION_CODE'] = 'foto';
		}
		?>

			<div class="c-media-section-page__photo-section-carousel">
				<?$APPLICATION->IncludeComponent(
					"levitansky:section.list",
					"photo-section-carousel",
					$sectionListParams,
					$component,
					array("HIDE_ICONS" => "Y")
				);?>
			</div>

		<?
		}
	}
	?>
</main>
