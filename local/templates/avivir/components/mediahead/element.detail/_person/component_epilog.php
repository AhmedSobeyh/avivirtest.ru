<?
// Общие параметры для всех компонентов
$listParams = array(
        "IBLOCK_TYPE" => "content",
        //"IBLOCK_ID" => $arParams["IBLOCK_ID"],
        "NEWS_COUNT" => "100",
        "SORT_BY1" => $arParams["SORT_BY1"],
        "SORT_ORDER1" => $arParams["SORT_ORDER1"],
        "SORT_BY2" => $arParams["SORT_BY2"],
        "SORT_ORDER2" => $arParams["SORT_ORDER2"],
        "FIELD_CODE" => ['DETAIL_PICTURE','PREVIEW_PICTURE','PREVIEW_TEXT','DETAIL_TEXT'], //$arParams["LIST_FIELD_CODE"],
        "PROPERTY_CODE" => ['AUDIO','VIDEO_LINK'],
        "DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
        "SET_TITLE" => $arParams["SET_TITLE"],
        "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
        "MESSAGE_404" => $arParams["MESSAGE_404"],
        "SET_STATUS_404" => $arParams["SET_STATUS_404"],
        "SHOW_404" => $arParams["SHOW_404"],
        "FILE_404" => $arParams["FILE_404"],
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "ADD_SECTIONS_CHAIN" => "N", //$arParams["ADD_SECTIONS_CHAIN"],
        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
        "CACHE_TIME" => $arParams["CACHE_TIME"],
        "CACHE_FILTER" => $arParams["CACHE_FILTER"],
        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "USE_PERMISSIONS" => "N",
        //"FILTER_NAME" => $arParams["FILTER_NAME"],
        "HIDE_LINK_WHEN_NO_DETAIL" => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],
        //"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
        //"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
        //"IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["sections"],
    );

?>

    <?if ($arResult["FILTER_EVENT"]):?>

        <div class="c-person-detail-page-media-list c-person-detail-page__media-list">
            <div class="o-container@md">
                <h2 class="c-person-detail-page-media-list__title">События</h2>
            </div>

            <?$GLOBALS["search_event_filter"]["ID"] = $arResult["FILTER_EVENT"];
            $listParams["IBLOCK_ID"] = 8;
            $listParams["FILTER_NAME"] = "search_event_filter";
            $APPLICATION->IncludeComponent(
                "levitansky:element.list",
                "event-carousel",
                $listParams,
                false
            );
            ?>
        </div>

    <?endif?>

    <?if ($arResult["FILTER_VIDEO"]):?>

        <div class="c-person-detail-page-media-list c-person-detail-page__media-list">
            <div class="o-container@md">
                <h2 class="c-person-detail-page-media-list__title">Видеозаписи</h2>
            </div>

            <?
            $GLOBALS["search_video_filter"]["ID"] = $arResult["FILTER_VIDEO"];
            $listParams["IBLOCK_ID"] = 3;
            $listParams["FILTER_NAME"] = "search_video_filter";
            $APPLICATION->IncludeComponent(
                "levitansky:element.list",
                "video",
                $listParams,
                false
            );
            ?>

        </div>

    <?endif?>

    <?if ($arResult["FILTER_AUDIO"]):?>

        <div class="c-person-detail-page-media-list c-person-detail-page__media-list">
            <div class="o-container@md">
                <h2 class="c-person-detail-page-media-list__title">Из нашего аудио-архива</h2>
            </div>

            <?$GLOBALS["search_audio_filter"]["ID"] = $arResult["FILTER_AUDIO"];
            $listParams["IBLOCK_ID"] = 3;
            $listParams["FILTER_NAME"] = "search_audio_filter";
            $APPLICATION->IncludeComponent(
                "levitansky:element.list",
                "audio",
                $listParams,
                false
            );
            ?>
        </div>

    <?endif?>

    <?if ($arResult["FILTER_PHOTO"]):?>

        <div class="c-person-detail-media-list c-person-detail-page__media-list">
            <div class="o-container@md">
                <h2 class="c-person-detail-page-media-list__title">Из фотоархива</h2>
            </div>

            <?$GLOBALS["search_photo_filter"]["ID"] = $arResult["FILTER_PHOTO"];
            $listParams["IBLOCK_ID"] = 3;
            $listParams["FILTER_NAME"] = "search_photo_filter";
            $APPLICATION->IncludeComponent(
                "levitansky:element.list",
                "photo",
                $listParams,
                false
            );
            ?>
        </div>

    <?endif?>

    <?if ($arResult["FILTER_ABOUT"]):?>

        <div class="c-person-detail-media-list c-person-detail-page__media-list">
            <div class="o-container@md">
                <h2 class="c-person-detail-page-media-list__title">Литература о поэте</h2>
            </div>

            <?$GLOBALS["search_about_filter"]["ID"] = $arResult["FILTER_ABOUT"];
            $listParams["IBLOCK_ID"] = 5;
            $listParams["FILTER_NAME"] = "search_about_filter";
            $APPLICATION->IncludeComponent(
                "levitansky:element.list",
                "literature",
                $listParams,
                false
            );
            ?>
        </div>

    <?endif?>

    <?if ($arResult["FILTER_LIT"]):?>

        <div class="c-person-detail-media-list c-person-detail-page__media-list">
            <div class="o-container@md">
                <h2 class="c-person-detail-page-media-list__title">Прямая речь</h2>
            </div>

            <?$GLOBALS["search_lit_filter"]["ID"] = $arResult["FILTER_LIT"];
            $listParams["IBLOCK_ID"] = 2;
            $listParams["FILTER_NAME"] = "search_lit_filter";
            $APPLICATION->IncludeComponent(
                "levitansky:element.list",
                "literature",
                $listParams,
                false
            );
            ?>
        </div>

    <?endif?>


</div>
