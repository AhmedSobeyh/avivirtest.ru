<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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

$lang = \Bitrix\Main\Context::getCurrent()->getLanguage();

use Bitrix\Iblock\InheritedProperty\ElementValues;

$desiredSectionId = 29;
$currentSectionId = $arResult['IBLOCK_SECTION_ID']; 
$isInSection39 = ($currentSectionId == $desiredSectionId);

$targetPrefix = '';

switch ($arResult['ID']) {
    case 45:
        $targetPrefix = 'SGTi-flex';
        break;
    case 36:
        $targetPrefix = 'NowCheck';
        break;
}

function ym($action, $targetPrefix, $withOnClick = false)
{
    if (empty($targetPrefix)) {
        return '';
    }
    if ($withOnClick) {
        return " onclick=\"ym(65192692,'reachGoal','{$action}_$targetPrefix')\" ";
    } else {
        return " ym(65192692,'reachGoal','{$action}_$targetPrefix') ";
    }
}
?>

<div class="content-block-ContentBlock-module-block express-item-ExpressItem-module-banner-wrapper">
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
            <?= $APPLICATION->ShowTitle(false); ?>
        </h2>
        <p class="content-block-ContentBlock-module-text content-block-ContentBlock-module-text-big">
            <?= $arResult['PREVIEW_TEXT'] ?>
        </p>
        <div class="content-block-ContentBlock-module-content"></div>
        <div class="content-block-ContentBlock-module-bottom">
            <div class="express-item-ExpressItem-module-buttons">
                <a href="/contacts/">
                    <button class="button-Button-module-button">
                        <?= GetMessage('MD_CALC_ORDER') ?>
                    </button>
                </a>
                <span id="call-tach-form">
                    <button onclick="openCallBack()" class="btn-white-bg button-Button-module-button express-item-ExpressItem-module-buttons-white button-Button-module-inversed">
                        Уточнить детали
                    </button>
                </span>

                <? if ($arResult['PHARM_RETAIL']) : ?>
                    <a href="<?= $arResult['PHARM_RETAIL'] ?>" <?= ym('Buy', $targetPrefix, true) ?>>
                        <button class="button-Button-module-button express-item-ExpressItem-module-buttons-white button-Button-module-inversed">
                            <?= GetMessage('MD_PHARM_RETAIL') ?>
                        </button>
                    </a>
                <? endif ?>
            </div>
        </div>
    </div>
    <?
    if ($arResult['DETAIL_PICTURE']['SRC'])
        $picture = $arResult['DETAIL_PICTURE']['SRC'];

    if (!$picture && $arResult['PREVIEW_PICTURE']['SRC'])
        $picture = $arResult['PREVIEW_PICTURE']['SRC'];

    if (!$picture)
        $picture = '/upload/images/renders/render-molecule.png';
    ?>

    <? if ($picture) : ?>
        <div class="content-block-ContentBlock-module-image">
            <img class="express-item-ExpressItem-module-banner" src="<?= $picture ?>" alt="<?= $arResult['NAME'] ?>" />
        </div>
    <? endif ?>
</div>
<? if (!$isInSection39) : ?>
<div class="content-block-ContentBlock-module-block express-item-ExpressItem-module-gray">
    <div class="content-block-ContentBlock-module-info">
        <div class="content-block-ContentBlock-module-content express-item-ExpressItem-module-examples content-block-ContentBlock-module-last">
            <? if (!empty($arResult['PROPERTIES']['BRAND'])) : ?>
                <div class="express-item-ExpressItem-module-example">
                    <img src="/upload/images/static_media/express-item/example-1.png" alt="<?= $arResult['BRAND']['NAME'] ?>" />
                    <h3><?= GetMessage("MD_MANUFACTURER") ?></h3>
                    <p><?= $arResult['BRAND']['NAME'] ?></p>
                </div>
            <? endif ?>

            <? if (!empty($arResult['PROPERTIES']['COUNTRY'])) : ?>
                <div class="express-item-ExpressItem-module-example">
                    <img src="/upload/images/static_media/express-item/example-2.png" alt="<?= $arResult['PROPERTIES']['COUNTRY']['VALUE'] ?>" />
                    <h3><?= GetMessage('MD_COUNTRY') ?></h3>
                    <p><?= $arResult['PROPERTIES']['COUNTRY']['VALUE'] ?></p>
                </div>
            <? endif ?>
            <div class="express-item-ExpressItem-module-example">
                <img src="/upload/images/static_media/express-item/example-3.png" alt="<?= $arResult['PROPERTIES']['DETERMINES']['HL_DATA']['NAME'] ?>" />
                <h3><?= GetMessage("MD_DETECTS") ?></h3>
                <p><?= $arResult['PROPERTIES']['DETERMINES']['HL_DATA']['NAME'] ?></p>
            </div>
            <div class="express-item-ExpressItem-module-example">
                <img src="/upload/images/static_media/express-item/example-4.png" alt="<?= $arResult['PROPERTIES']['BIOMATERIAL']['HL_DATA']['NAME'] ?>" />
                <h3><?= GetMessage('MD_BIOMATERIAL') ?></h3>
                <p><?= $arResult['PROPERTIES']['BIOMATERIAL']['HL_DATA']['NAME'] ?></p>
            </div>
        </div>
        <div class="content-block-ContentBlock-module-bottom"></div>
    </div>
</div>


<div class="content-block-ContentBlock-module-block express-item-ExpressItem-module-infos-wrapper">
    <div class="content-block-ContentBlock-module-info">
        <h2 class="content-block-ContentBlock-module-title"><?= $arResult["NAME"] ?></h2>
        <div class="content-block-ContentBlock-module-content express-item-ExpressItem-module-infos content-block-ContentBlock-module-last">
            <? if (mb_strlen($arResult['PROPERTIES']['SPECIFICITY']['VALUE']) > 0) : ?>
                <div class="express-item-ExpressItem-module-info">
                    <div class="express-item-ExpressItem-module-circle">
                        <p><?= $arResult['PROPERTIES']['SPECIFICITY']['VALUE'] ?><sup>%</sup></p>
                    </div>
                    <h3><?= GetMessage('MD_SPECIFICITY') ?></h3>
                </div>
            <? endif ?>

            <? if (mb_strlen($arResult['PROPERTIES']['ACCURACY']['VALUE']) > 0) : ?>
                <div class="express-item-ExpressItem-module-info">
                    <div class="express-item-ExpressItem-module-circle">
                        <p><?= $arResult['PROPERTIES']['ACCURACY']['VALUE'] ?><sup>%</sup></p>
                    </div>
                    <h3><?= GetMessage('MD_ACCURACY') ?></h3>
                </div>
            <? endif ?>

            <? if (mb_strlen($arResult['PROPERTIES']['SENSITIVITY']['VALUE']) > 0) : ?>
                <div class="express-item-ExpressItem-module-info">
                    <div class="express-item-ExpressItem-module-circle">
                        <p><?= $arResult['PROPERTIES']['SENSITIVITY']['VALUE'] ?><sup>%</sup></p>
                    </div>
                    <h3><?= GetMessage('MD_SENSITIVITY') ?></h3>
                </div>
            <? endif ?>

            <? if (mb_strlen($arResult['PROPERTIES']['MINUTES']['VALUE']) > 0) : ?>
                <div class="express-item-ExpressItem-module-info">
                    <img src="/upload/images/static_media/express-item/hourglass.png" alt="hourglass" />
                    <h3><?= $arResult['PROPERTIES']['MINUTES']['VALUE'] ?> <?= GetMessage('MD_MINUTES') ?></h3>
                </div>
            <? endif ?>

            <? foreach ($arResult['TEASERS'] as $teaser) : ?>
                <div class="express-item-ExpressItem-module-info">
                    <img src="<?= $teaser['ICON']['SRC'] ?>" alt="thermometer" />
                    <h3><?= $teaser['PREVIEW_TEXT'] ?></h3>
                </div>
            <? endforeach ?>
        </div>
        <div class="content-block-ContentBlock-module-bottom"></div>
    </div>
</div>
<? endif ?>

<div class="content-block-ContentBlock-module-block express-item-ExpressItem-module-review-wrapper">
    <div class="content-block-ContentBlock-module-info">
        <h2 class="content-block-ContentBlock-module-title"><?= GetMessage("MD_PRODUCT_OVERVIEW") ?></h2>
        <div class="content-block-ContentBlock-module-content express-item-ExpressItem-module-review content-block-ContentBlock-module-last">
            <? if ($arResult['PROPERTIES']['GALLERY']['VALUE']) : ?>
                <? $APPLICATION->IncludeComponent(
                    "mediahead:photogallery",
                    "mini",
                    array(
                        "PHOTOS" => $arResult["PROPERTIES"]["GALLERY"]["VALUE"],
                        "PHOTOS_DESC" => $arResult["PROPERTIES"]["GALLERY"]["DESCRIPTION"],
                        //"VIDEOS" => $arResult["PROPERTIES"]["SLIDER_PHOTOS"]["VALUE"],
                        //"VIDEOS_DESC" => $arItem["PROPERTY_VIDEO_DESCRIPTION"],
                        //"YOUTUBE" => $arResult["PROPERTIES"]["YOUTUBE"]["VALUE"],
                        //"TITLE" => GetMessage("MD_SERVICE_GALLERY"),
                        "WIDTH" => 500,
                        "HEIGHT" => 373,
                        "RESIZE_TYPE" => 'EXACT',
                        "AUTOPLAY" => true,
                        "NO_CLICK" => false,
                    ),
                    $component
                ); ?>
            <? endif ?>
            <div class="express-item-ExpressItem-module-review-info">
                <p>
                    <?= $arResult["DETAIL_TEXT"] ?>
                </p>
                <? if (mb_strlen($arResult['PROPERTIES']['COMPOSITION']['VALUE']['TEXT']) > 0) : ?>
                    <h3>
                        <img src="/upload/images/static_media/express-item/slider-icon.png" alt="three cubes" /> Набор
                        содержит:
                    </h3>
                    <p>
                        <?= $arResult['PROPERTIES']['COMPOSITION']['VALUE']['TEXT'] ?>
                    </p>
                <? endif ?>
                <div class="express-item-ExpressItem-module-buttons">
                    <? if ($arResult['PROPERTIES']['INSTRUCTION']['VALUE']) : ?>
                        <? $file = $arResult['PROPERTIES']['INSTRUCTION']['DISPLAY']['FILE_VALUE'] ?>
                        <a href="<?= $file['SRC'] ?>" <?= ym('Download_instruction', $targetPrefix, true) ?>>
                            <button class="button-Button-module-button">
                                <?= GetMessage("MD_INSTRUCTION") ?>
                            </button>
                        </a>
                    <? endif ?>

                    <? if ($arResult['PROPERTIES']['PRESENTATION']['DISPLAY']) : ?>
                        <? $file = $arResult['PROPERTIES']['PRESENTATION']['DISPLAY']['FILE_VALUE'] ?>
                        <a href="<?= $file['SRC'] ?>" <?= ym('Presentation', $targetPrefix, true) ?>>
                            <button class="button-Button-module-button express-item-ExpressItem-module-buttons-white button-Button-module-inversed">
                                <?= GetMessage('MD_TEST_PRESENTATION') ?>
                            </button>
                        </a>
                    <? endif ?>
                </div>
            </div>
        </div>
        <div class="content-block-ContentBlock-module-bottom"></div>
    </div>
</div>

<? if ($arResult["USAGE"]) : ?>
    <div class="content-block-ContentBlock-module-block express-item-ExpressItem-module-orders-wrapper">
        <div class="content-block-ContentBlock-module-info">
            <h2 class="content-block-ContentBlock-module-title"><?= GetMessage("MD_USAGE") ?></h2>
            <div class="content-block-ContentBlock-module-content express-item-ExpressItem-module-orders content-block-ContentBlock-module-last">
                <? foreach ($arResult["USAGE"] as $useTeaser) : ?>
                    <div class="express-item-ExpressItem-module-order">
                        <img src="<?= $useTeaser["ICON"]["SRC"] ?>" alt="<?= $useTeaser["PREVIEW_TEXT"] ?>" />
                        <p><?= $useTeaser["PREVIEW_TEXT"] ?></p>
                    </div>
                <? endforeach ?>

            </div>
            <div class="content-block-ContentBlock-module-bottom"></div>
        </div>
    </div>
<? endif ?>



<? $testType = $arResult['PROPERTIES']['TEST_TYPE']['HL_DATA']['XML_ID'] ?>
<? $determines = $arResult['PROPERTIES']['DETERMINES']['HL_DATA']['XML_ID'] ?>
<? $bio = $arResult['PROPERTIES']['BIOMATERIAL']['HL_DATA']['XML_ID'] ?>

<? // Двойка включает режим, если у теста на антиген полоски только красные (нет черных)
?>
<? // @todo: наверное надо свйоство ввести или справочник для этой фигни 
?>
<? $testMod = $bio == 'saliva' || $arResult['ID'] == '111' ||  $arResult['ID'] == '85' ? '2' : '' ?>

<? if ($testType == 'express' && $determines == 'antigen') : ?>
    <div class="content-block-ContentBlock-module-block content-block-ContentBlock-module-inner express-item-ExpressItem-module-gray">
        <div class="content-block-ContentBlock-module-info">
            <h2 class="content-block-ContentBlock-module-title">Расшифровка результата экспресс-теста</h2>
            <div class="content-block-ContentBlock-module-content express-item-ExpressItem-module-results content-block-ContentBlock-module-last">
                <div class="express-item-ExpressItem-module-result">
                    <img src="/upload/images/static_media/express-item/result-1.png" alt="result" />
                    <div class="express-item-ExpressItem-module-result-info">
                        <h3>Если линия (С) окрашивается в красный цвет:</h3>
                        <p>Анализ дал отрицательный результат на наличие антигена к коронавирусу.</p>
                    </div>
                </div>
                <div class="express-item-ExpressItem-module-result">
                    <img src="/upload/images/static_media/express-item/result-2.png" alt="result" />
                    <div class="express-item-ExpressItem-module-result-info">
                        <h3>Если линия (C) окрашивается в красный цвет а линия (Т) в черный:</h3>
                        <p>Анализ дал положительный результат на наличие антигена к коронавирусу</p>
                    </div>
                </div>
                <div class="express-item-ExpressItem-module-result">
                    <img src="/upload/images/static_media/express-item/result-3.png" alt="result" />
                    <div class="express-item-ExpressItem-module-result-info">
                        <h3>При отсутствии в окошке окрашенной в красный цвет линии (C):</h3>
                        <p>
                            Результат тестирования является недействительным. Причиной может быть нарушение требований взятия
                            биологического образца, и/или процедур проведения анализа, или негодность используемой испытательной
                            тест-системы.
                        </p>
                    </div>
                </div>
            </div>
            <div class="content-block-ContentBlock-module-bottom"></div>
        </div>
    </div>
    <? //$path = "lang/$lang/decrypt_ag.php" 
    ?>
    <? //if (file_exists(__DIR__ . '/' . $path)) : 
    ?>
    <? //include($path) 
    ?>
    <? //endif 
    ?>
<? endif ?>

<? //if ($testType == 'express' && $determines == 'antibody') : 
?>
<? //$antibody = $arResult['PROPERTIES']['ANTIBODY']['VALUE_XML_ID'] 
?>
<? //$path = "lang/$lang/decrypt_{$antibody}.php" 
?>
<? //if (file_exists(__DIR__ . '/' . $path)) : 
?>
<? //include($path) 
?>
<? //endif 
?>
<? //endif 
?>


<? if (!empty($arResult['CLINICS'])) : ?>
    <div class="content-block-ContentBlock-module-block content-block-ContentBlock-module-inner express-item-ExpressItem-module-gray">
        <div class="content-block-ContentBlock-module-info">
            <h2 class="content-block-ContentBlock-module-title"><?= GetMessage("MD_CLINICS_TEST") ?></h2>
            <div class="content-block-ContentBlock-module-content express-item-ExpressItem-module-cards content-block-ContentBlock-module-last">

                <? foreach ($arResult['CLINICS'] as $clinic) : ?>
                    <a href="<?= $clinic['LINK'] ?>" class="express-item-ExpressItem-module-card"><img src="<?= $clinic['ICON']['SRC'] ?>" alt="<?= GetMessage("MD_CLINICS_TEST") ?> <?= $clinic['NAME'] ?>" /><img class="express-item-ExpressItem-module-card-arrow" src="/upload/images/static_media/icons/express-tests-arrow.svg" alt="link-arrow" /></a>
                <? endforeach ?>
            </div>
            <div class="content-block-ContentBlock-module-bottom"></div>
        </div>
    </div>
<? endif ?>

<script>
    function openCallBack() {
        window.ct('modules', 'widgets', 'openExternal', 'request');
    }
</script>