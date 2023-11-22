<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("title","Статистика по коронавирусу COVID-19, динамика заболеваний и смертей по Москве, России и всему миру — компания «Авивир»");
$APPLICATION->SetPageProperty("description", "Динамика заболевших и умерших от коронавируса SARS-CoV-2 по Москве, регионам и городам России и странам мира.");
$APPLICATION->SetTitle("Статистика COVID-19");

use Bitrix\Main\Page\AssetLocation;
use Bitrix\Main\Page\Asset;

$assets = Asset::getInstance();


$assets->addCss('https://unpkg.com/leaflet@1.7.1/dist/leaflet.css', false, AssetLocation::BEFORE_CSS);
$assets->addCss('https://cdn.jsdelivr.net/npm/leaflet-timedimension@1.1.1/dist/leaflet.timedimension.control.min.css', false, AssetLocation::BEFORE_CSS);
$assets->addCss(SITE_TEMPLATE_PATH . '/assets/css/covid-stat.css', false, AssetLocation::BEFORE_CSS);

//$assets->addJs(SITE_TEMPLATE_PATH . '/assets/vendors/masonry/dist/masonry.pkgd.min.js', false, AssetLocation::AFTER_JS);
$assets->addJs('https://unpkg.com/leaflet@1.7.1/dist/leaflet.js', false, AssetLocation::AFTER_JS);
$assets->addJs('https://cdn.jsdelivr.net/npm/iso8601-js-period@0.2.1/iso8601.min.js', false, AssetLocation::AFTER_JS);
$assets->addJs('https://cdn.jsdelivr.net/npm/leaflet-timedimension@1.1.1/dist/leaflet.timedimension.min.js', false, AssetLocation::AFTER_JS);
$assets->addJs('https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js', false, AssetLocation::AFTER_JS);
$assets->addJs('https://cdn.jsdelivr.net/npm/echarts@5.1.2/dist/echarts.min.js', false, AssetLocation::AFTER_JS);
$assets->addJs('https://cdn.jsdelivr.net/npm/luxon@2.0.2/build/global/luxon.min.js', false, AssetLocation::AFTER_JS);
$assets->addJs('https://cdn.jsdelivr.net/npm/d3-array@3', false, AssetLocation::AFTER_JS);
$assets->addJs('https://cdn.jsdelivr.net/npm/d3-color@3', false, AssetLocation::AFTER_JS);
$assets->addJs('https://cdn.jsdelivr.net/npm/d3-format@3', false, AssetLocation::AFTER_JS);
$assets->addJs('https://cdn.jsdelivr.net/npm/d3-interpolate@3', false, AssetLocation::AFTER_JS);
$assets->addJs('https://cdn.jsdelivr.net/npm/d3-time@3', false, AssetLocation::AFTER_JS);
$assets->addJs('https://cdn.jsdelivr.net/npm/d3-time-format@4', false, AssetLocation::AFTER_JS);
$assets->addJs('https://cdn.jsdelivr.net/npm/d3-scale@4', false, AssetLocation::AFTER_JS);
?>

<? // START: App header 
?>
<header class="c-app-header c-app-header--density-compact c-app-header--fullscreen c-app-header--has-media t-light">
    <div class="o-container@lg c-app-header__container">
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

        <div class="c-app-header__layout">
            <div class="c-app-header__media">
                <div class="o-bg-holder c-app-header__media-bg-holder" style="background-image: url(/upload/images/backgrounds/bg-plus-grid-color-primary-01.svg);"></div>

                <? /* START: Picture */ ?>
                <picture class="c-picture o-ratio o-ratio--1x1">
                    <img class="c-picture__img c-picture__img--contain" src="/upload/images/renders/render-molecule.png" alt="<? $APPLICATION->ShowTitle(); ?>" />
                </picture>
                <? /* END: Picture */ ?>
            </div>

            <div class="c-app-header__body">
                <h1 class="c-app-header__title"><? $APPLICATION->ShowTitle(true); ?></h1>

                <p class="c-app-header__lead">
                    В этом блоке можно следить за динамикой новых случаев смерти от коронавируса в некоторых странах Западной Европы, США, Израиле и России. В отличие от числа заражений показатель смертей нечувствителен к изменению числа тестирований, поэтому он лучше подходит для сравнения волн заболевания.
                </p>
            </div>
        </div>
    </div>
</header>
<? // END: App header 
?>

<? // START: Main 
?>
<main class="o-main">
    <div class="o-main__wrap">
        <? // START: Covid stat data 
        ?>
        <section class="c-app-section c-app-section--density-comfortable c-covid-stat-data">
            <div class="c-app-section__header">
                <div class="o-container@lg">
                    <h2 class="c-app-section__title">
                        Данные
                    </h2>
                </div>
            </div>

            <div class="c-app-section__body">
                <div class="c-tabs c-tabs--grow">
                    <div class="o-container@lg">
                        <nav class="c-tabs-bar c-tabs-bar--scrollable c-covid-stat-data__tabs-bar">
                            <div class="c-tabs-bar__content" id="tabList" role="tablist" data-exo-tab-list>
                                <button class="c-tab is-active" id="eventsTab" data-exo-toggle="tab" data-exo-target="#eventsTabPane" type="button" role="tab" aria-controls="eventsTabPane" aria-selected="true">
                                    Развитие событий
                                </button>
                                <button class="c-tab" id="regionsStatTab" data-exo-toggle="tab" data-exo-target="#regionsStatTabPane" type="button" role="tab" aria-controls="regionsStatTabPane" aria-selected="false">
                                    Статистика по регионам
                                </button>
                                <button class="c-tab" id="countriesStatTab" data-exo-toggle="tab" data-exo-target="#countriesStatTabPane" type="button" role="tab" aria-controls="countriesStatTabPane" aria-selected="false">
                                    Статистика по странам
                                </button>
                                <button class="c-tab" id="experienceTab" data-exo-toggle="tab" data-exo-target="#experienceTabPane" type="button" role="tab" aria-controls="experienceTabPane" aria-selected="false">
                                    Опыт разных стран
                                </button>
                            </div>
                        </nav>
                    </div>

                    <div class="c-tabs-content" id="tabContent">
                        <div class="c-tabs-content__wrap">
                            <div class="c-tab-pane c-tab-pane--transition c-covid-stat-data__tab-pane is-shown is-active is-loading" id="eventsTabPane" role="tabpanel" aria-labelledby="eventsTab">
                                <div class="c-covid-stat-data__tab-loader">
                                    <div class="c-progress-circular c-progress-circular--visible c-progress-circular--indeterminate" style="height: 2rem; width: 2rem;" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="22.857142857142858 22.857142857142858 45.714285714285715 45.714285714285715" style="transform: rotate(0deg);">
                                            <circle fill="transparent" cx="45.714285714285715" cy="45.714285714285715" r="20" stroke-width="5.714285714285714" stroke-dasharray="125.664" stroke-dashoffset="125.66370614359172px" class="c-progress-circular__overlay"></circle>
                                        </svg>
                                    </div>
                                </div>

                                <div class="c-covid-stat-data__tab-data">
                                    <div class="o-container@lg">
                                        <div class="c-covid-stat-card c-covid-stat-events">
                                            <div class="c-covid-stat-card__header">
                                                <h3 class="c-covid-stat-card__title">Развитие событий</h3>
                                            </div>

                                            <div class="c-covid-stat-card-toolbar c-covid-stat-card__toolbar">
                                                <div class="c-covid-stat-card-toolbar__layout">
                                                    <div class="c-form-textfield c-form-textfield--size-xs c-form-textfield--label-hidden c-covid-stat-card-toolbar__search">
                                                        <div class="c-form-textfield__control">
                                                            <label class="c-form-textfield__label" for="eventsSearchInput">
                                                                Поиск по субъектам России и другим странам
                                                            </label>
                                                            <input class="c-form-textfield__input" id="eventsSearchInput" type="text" placeholder="Поиск..." autocomplete="off" autocorrect="off" autocapitalize="off">
                                                        </div>

                                                        <div class="c-menu" id="eventsSearchMenu" role="menu">
                                                            <div class="o-stylized-scrollbar c-list" id="eventsSearchVariants"></div>
                                                        </div>
                                                    </div>

                                                    <div class="c-covid-stat-card-toolbar__togglers">
                                                        <div class="c-covid-stat-card-toolbar__togglers-content" id="eventsToolbarPlaces"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="c-covid-stat-events-general c-covid-stat-events__general">
                                                <div class="c-covid-stat-events-general__layout">
                                                    <h4 class="c-covid-stat-card__subtitle">
                                                        Главные цифры на <span id="eventsGeneralDate">###DATE###</span>
                                                    </h4>

                                                    <div class="c-covid-stat-events-general-item c-covid-stat-events-general__item">
                                                        <h5 class="c-covid-stat-events-general-item__title">
                                                            Заражения
                                                        </h5>

                                                        <span class="c-covid-stat-events-general-item__data">
                                                            <span class="c-covid-stat-events-general-item__total" id="eventsGeneralCasesTotal">
                                                                0
                                                            </span>
                                                            <span class="c-covid-stat-events-general-item__delta" id="eventsGeneralCasesDelta">
                                                                0
                                                            </span>
                                                        </span>
                                                    </div>

                                                    <div class="c-covid-stat-events-general-item c-covid-stat-events-general__item">
                                                        <h5 class="c-covid-stat-events-general-item__title">
                                                            Смерти
                                                        </h5>

                                                        <span class="c-covid-stat-events-general-item__data">
                                                            <span class="c-covid-stat-events-general-item__total" id="eventsGeneralDeathsTotal">
                                                                0
                                                            </span>
                                                            <span class="c-covid-stat-events-general-item__delta" id="eventsGeneralDeathsDelta">
                                                                0
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="c-covid-stat-events-chart c-covid-stat-events__chart">
                                                <h4 class="c-covid-stat-events-chart__title">
                                                    Число новых <span class="c-covid-stat-events-chart__marker u-text-primary-darken-1">заражений</span>
                                                    и <span class="c-covid-stat-events-chart__marker u-text-secondary-lighten-1">смертей</span>,
                                                    <span class="c-covid-stat-events-chart__marker" data-chart-place>###PLACE###</span>
                                                </h4>

                                                <div class="c-covid-stat-chart c-covid-stat-events-chart__chart" id="eventsChartCasesNDeaths"></div>
                                                <div class="c-covid-stat-chart__hidden-data" id="eventsChartCases"></div>
                                                <div class="c-covid-stat-chart__hidden-data" id="eventsChartDeaths"></div>
                                            </div>

                                            <div class="c-covid-stat-events-chart c-covid-stat-events__chart">
                                                <h4 class="c-covid-stat-events-chart__title">
                                                    Число новых <span class="c-covid-stat-events-chart__marker u-text-primary-darken-1">заражений</span>
                                                    в последние <span data-chart-week-count>три</span> недели, тыс.,
                                                    <span class="c-covid-stat-events-chart__marker" data-chart-place>###PLACE###</span>
                                                </h4>

                                                <div class="c-covid-stat-chart c-covid-stat-events-chart__chart" id="eventsChartNewThreeWeeksCases"></div>
                                            </div>

                                            <div class="c-covid-stat-events-chart c-covid-stat-events__chart">
                                                <h4 class="c-covid-stat-events-chart__title">
                                                    Число новых <span class="c-covid-stat-events-chart__marker u-text-secondary-lighten-1">смертей</span>
                                                    в последние <span data-chart-week-count>три</span> недели, тыс.,
                                                    <span class="c-covid-stat-events-chart__marker" data-chart-place>###PLACE###</span>
                                                </h4>

                                                <div class="c-covid-stat-chart c-covid-stat-events-chart__chart" id="eventsChartNewThreeWeeksDeaths"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="c-tab-pane c-tab-pane--transition c-covid-stat-data__tab-pane" id="regionsStatTabPane" role="tabpanel" aria-labelledby="regionsStatTab">
                                <div class="c-covid-stat-data__tab-loader">
                                    <div class="c-progress-circular c-progress-circular--visible c-progress-circular--indeterminate" style="height: 2rem; width: 2rem;" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="22.857142857142858 22.857142857142858 45.714285714285715 45.714285714285715" style="transform: rotate(0deg);">
                                            <circle fill="transparent" cx="45.714285714285715" cy="45.714285714285715" r="20" stroke-width="5.714285714285714" stroke-dasharray="125.664" stroke-dashoffset="125.66370614359172px" class="c-progress-circular__overlay"></circle>
                                        </svg>
                                    </div>
                                </div>

                                <div class="c-covid-stat-data__tab-data">
                                    <div class="o-container@lg">
                                        <div class="c-covid-stat-card c-covid-stat-regions">
                                            <div class="c-covid-stat-card__header">
                                                <h3 class="c-covid-stat-card__title">
                                                    Статистика по регионам
                                                </h3>
                                            </div>

                                            <div class="c-covid-stat-card-toolbar c-covid-stat-card__toolbar c-covid-stat-regions__toolbar">
                                                <div class="c-covid-stat-card-toolbar__layout">
                                                    <nav class="c-tabs-bar c-tabs-bar--scrollable c-covid-stat-regions__tabs-bar">
                                                        <div class="c-tabs-bar__content" id="regionsTabList" role="tablist" data-exo-tab-list>
                                                            <button class="c-btn c-btn--size-xs c-btn--kind-primary is-active" id="regionsStatPivotTableTab" data-exo-toggle="tab" data-exo-target="#regionsStatPivotTableTabPane" type="button" role="tab" aria-controls="regionsStatPivotTableTabPane" aria-selected="true">
                                                                <span class="c-btn__overlay"></span>
                                                                <span class="c-btn__content">
                                                                    Таблица
                                                                </span>
                                                            </button>

                                                            <button class="c-btn c-btn--size-xs c-btn--kind-outline-primary c-tab--pill" id="regionsStatMapTab" data-exo-toggle="tab" data-exo-target="#regionsStatMapTabPane" type="button" role="tab" aria-controls="regionsStatMapTabPane" aria-selected="false">
                                                                <span class="c-btn__overlay"></span>
                                                                <span class="c-btn__content">
                                                                    На карте
                                                                </span>
                                                            </button>

                                                            <button class="c-btn c-btn--size-xs c-btn--kind-outline-primary c-tab--pill" id="regionsStatDynamicMapTab" data-exo-toggle="tab" data-exo-target="#regionsStatDynamicMapTabPane" type="button" role="tab" aria-controls="regionsStatDynamicMapTabPane" aria-selected="false">
                                                                <span class="c-btn__overlay"></span>
                                                                <span class="c-btn__content">
                                                                    Динамика на карте
                                                                </span>
                                                            </button>
                                                        </div>
                                                    </nav>
                                                </div>
                                            </div>

                                            <div class="c-tabs-content" id="regionsTabContent">
                                                <div class="c-tab-pane c-tab-pane--transition c-covid-stat-data__tab-pane is-shown is-active" id="regionsStatPivotTableTabPane" role="tabpanel" aria-labelledby="regionsStatPivotTableTab">
                                                    <div class="c-covid-stat-data__tab-loader">
                                                        <div class="c-progress-circular c-progress-circular--visible c-progress-circular--indeterminate" style="height: 2rem; width: 2rem;" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="22.857142857142858 22.857142857142858 45.714285714285715 45.714285714285715" style="transform: rotate(0deg);">
                                                                <circle fill="transparent" cx="45.714285714285715" cy="45.714285714285715" r="20" stroke-width="5.714285714285714" stroke-dasharray="125.664" stroke-dashoffset="125.66370614359172px" class="c-progress-circular__overlay"></circle>
                                                            </svg>
                                                        </div>
                                                    </div>

                                                    <div class="c-covid-stat-data__tab-data">
                                                        <h4 class="c-covid-stat-card__subtitle c-covid-stat-regions__subtitle">
                                                            По данным на <span id="regionsStatDate">###date###</span>
                                                        </h4>

                                                        <div class="c-covid-stat-card-toolbar c-covid-stat-card__toolbar">
                                                            <div class="c-covid-stat-card-toolbar__layout">
                                                                <div class="c-form-textfield c-form-textfield--size-xs c-form-textfield--label-hidden c-covid-stat-card-toolbar__search">
                                                                    <div class="c-form-textfield__control">
                                                                        <label class="c-form-textfield__label" for="regionsStatFilterInput">
                                                                            Поиск по субъектам России и другим странам
                                                                        </label>
                                                                        <input class="c-form-textfield__input" id="regionsStatFilterInput" type="text" placeholder="Введите название региона..." autocomplete="off" autocorrect="off" autocapitalize="off">
                                                                    </div>

                                                                    <div class="search-variants" id="eventsSearchVariants"></div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div id="regionsStatTable" class="c-covid-stat-table c-covid-stat-table--regions">
                                                            <div class="c-covid-stat-table__header u-text-secondary">
                                                                <div class="c-covid-stat-table__row">
                                                                    <span class="c-covid-stat-table__cell table__header_cell_name">
                                                                        Регион
                                                                    </span>
                                                                    <span class="c-covid-stat-table__cell c-covid-stat-table__cell--hidden@down-lg table__header_cell_stats">
                                                                        Число новых случаев по дням
                                                                    </span>
                                                                    <span class="c-covid-stat-table__cell c-covid-stat-table__cell--align-right table__header_cell_cases">
                                                                        Всего заражений
                                                                    </span>
                                                                    <span class="c-covid-stat-table__cell c-covid-stat-table__cell--align-right c-covid-stat-table__cell--hidden@down-lg table__header_cell_cases100pop">
                                                                        Заражений на&nbsp;100&nbsp;000 человек
                                                                    </span>
                                                                    <span class="c-covid-stat-table__cell c-covid-stat-table__cell--align-right table__header_cell_deaths">
                                                                        Всего смертей
                                                                    </span>
                                                                    <span class="c-covid-stat-table__cell c-covid-stat-table__cell--align-right c-covid-stat-table__cell--hidden@down-lg table__header_cell_deaths100pop">
                                                                        Смертей на&nbsp;100&nbsp;000 человек
                                                                    </span>
                                                                </div>
                                                            </div>

                                                            <div class="c-covid-stat-table__body" id="regionsStatTableBody"></div>

                                                            <button id="regionsStatButtonShowMore" class="c-btn c-btn--kind-outline-primary c-btn--size-sm c-covid-stat-table__more-btn">
                                                                <span class="c-btn__overlay"></span>
                                                                <span class="c-btn__content">
                                                                    Показать ещё
                                                                </span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="c-tab-pane c-tab-pane--transition c-covid-stat-data__tab-pane" id="regionsStatMapTabPane" role="tabpanel" aria-labelledby="regionsStatMapTab">
                                                    <div class="c-covid-stat-data__tab-loader">
                                                        <div class="c-progress-circular c-progress-circular--visible c-progress-circular--indeterminate" style="height: 2rem; width: 2rem;" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="22.857142857142858 22.857142857142858 45.714285714285715 45.714285714285715" style="transform: rotate(0deg);">
                                                                <circle fill="transparent" cx="45.714285714285715" cy="45.714285714285715" r="20" stroke-width="5.714285714285714" stroke-dasharray="125.664" stroke-dashoffset="125.66370614359172px" class="c-progress-circular__overlay"></circle>
                                                            </svg>
                                                        </div>
                                                    </div>

                                                    <div class="c-covid-stat-data__tab-data">
                                                        <h4 class="c-covid-stat-card__subtitle c-covid-stat-regions__subtitle">
                                                            По данным на <span id="regionsStatMapDate">###date###</span>
                                                        </h4>

                                                        <span class="c-covid-stat-regions__description">
                                                            Чем <span class="c-covid-stat-regions__marker u-text-primary-darken-1">больше</span> круг,
                                                            тем выше <span class="c-covid-stat-regions__marker u-text-secondary-lighten-1">общее число</span> заражений на 100 тыс. населения на дату.
                                                        </span>

                                                        <span class="c-covid-stat-regions__description">
                                                            Чем <span class="c-covid-stat-regions__marker u-text-primary-darken-1">темнее</span> круг,
                                                            тем выше <span class="c-covid-stat-regions__marker u-text-secondary-lighten-1">прирост</span> заражений на 1000 населения на дату.
                                                        </span>

                                                        <div class="c-covid-stat-regions-map c-covid-stat-regions__map">
                                                            <div class="c-covid-stat-regions-map__wrap" id="regionsStatMap">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="c-tab-pane c-tab-pane--transition c-covid-stat-data__tab-pane" id="regionsStatDynamicMapTabPane" role="tabpanel" aria-labelledby="regionsStatDynamicMapTab">
                                                    <div class="c-covid-stat-data__tab-loader">
                                                        <div class="c-progress-circular c-progress-circular--visible c-progress-circular--indeterminate" style="height: 2rem; width: 2rem;" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="22.857142857142858 22.857142857142858 45.714285714285715 45.714285714285715" style="transform: rotate(0deg);">
                                                                <circle fill="transparent" cx="45.714285714285715" cy="45.714285714285715" r="20" stroke-width="5.714285714285714" stroke-dasharray="125.664" stroke-dashoffset="125.66370614359172px" class="c-progress-circular__overlay"></circle>
                                                            </svg>
                                                        </div>
                                                    </div>

                                                    <div class="c-covid-stat-data__tab-data">
                                                        <h4 class="c-covid-stat-card__subtitle c-covid-stat-regions__subtitle">
                                                            Рост суммарного числа зараженных во времени
                                                        </h4>

                                                        <span class="c-covid-stat-regions__description">
                                                            Чем <span class="c-covid-stat-regions__marker u-text-primary-darken-1">больше</span> круг,
                                                            тем выше <span class="c-covid-stat-regions__marker u-text-secondary-lighten-1">общее число</span> заражений на 100 тыс. населения.
                                                        </span>

                                                        <div class="c-covid-stat-regions-map c-covid-stat-regions__map">
                                                            <div class="c-covid-stat-regions-map__wrap" id="regionsStatDynamicMap">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="c-tab-pane c-tab-pane--transition c-covid-stat-data__tab-pane" id="countriesStatTabPane" role="tabpanel" aria-labelledby="countriesStatTab">
                                <div class="c-covid-stat-data__tab-loader">
                                    <div class="c-progress-circular c-progress-circular--visible c-progress-circular--indeterminate" style="height: 2rem; width: 2rem;" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="22.857142857142858 22.857142857142858 45.714285714285715 45.714285714285715" style="transform: rotate(0deg);">
                                            <circle fill="transparent" cx="45.714285714285715" cy="45.714285714285715" r="20" stroke-width="5.714285714285714" stroke-dasharray="125.664" stroke-dashoffset="125.66370614359172px" class="c-progress-circular__overlay"></circle>
                                        </svg>
                                    </div>
                                </div>

                                <div class="c-covid-stat-data__tab-data">
                                    <div class="o-container@lg">
                                        <div class="c-covid-stat-card c-covid-stat-countries">
                                            <div class="c-covid-stat-card__header">
                                                <h3 class="c-covid-stat-card__title">
                                                    Статистика по странам
                                                </h3>
                                            </div>

                                            <h4 class="c-covid-stat-card__subtitle c-covid-stat-countries__subtitle">
                                                По данным на <span id="countriesStatDate">###date###</span>
                                            </h4>

                                            <div class="c-covid-stat-card-toolbar c-covid-stat-card__toolbar">
                                                <div class="c-covid-stat-card-toolbar__layout">
                                                    <div class="c-form-textfield c-form-textfield--size-xs c-form-textfield--label-hidden c-covid-stat-card-toolbar__search">
                                                        <div class="c-form-textfield__control">
                                                            <label class="c-form-textfield__label" for="countriesStatFilterInput">
                                                                Поиск по субъектам России и другим странам
                                                            </label>
                                                            <input class="c-form-textfield__input" id="countriesStatFilterInput" type="text" placeholder="Введите название страны..." autocomplete="off" autocorrect="off" autocapitalize="off">
                                                        </div>

                                                        <div class="search-variants" id="eventsSearchVariants"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="countriesStatTable" class=" c-covid-stat-table c-covid-stat-table--countries">
                                                <div class="c-covid-stat-table__header u-text-secondary">
                                                    <div class="c-covid-stat-table__row">
                                                        <span class="c-covid-stat-table__cell table__header_cell_name">
                                                            Страна
                                                        </span>
                                                        <span class="c-covid-stat-table__cell c-covid-stat-table__cell--hidden@down-lg table__header_cell_stats">
                                                            Число новых случаев по дням
                                                        </span>
                                                        <span class="c-covid-stat-table__cell c-covid-stat-table__cell--align-right table__header_cell_cases">
                                                            Всего заражений
                                                        </span>
                                                        <span class="c-covid-stat-table__cell c-covid-stat-table__cell--align-right c-covid-stat-table__cell--hidden@down-lg table__header_cell_cases100pop">
                                                            Заражений на&nbsp;100&nbsp;000 человек
                                                        </span>
                                                        <span class="c-covid-stat-table__cell c-covid-stat-table__cell--align-right table__header_cell_deaths">
                                                            Всего смертей
                                                        </span>
                                                        <span class="c-covid-stat-table__cell c-covid-stat-table__cell--align-right c-covid-stat-table__cell--hidden@down-lg table__header_cell_deaths100pop">
                                                            Смертей на&nbsp;100&nbsp;000 человек
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="c-covid-stat-table__body" id="countriesStatTableBody"></div>

                                                <button id="countriesStatButtonShowMore" class="c-btn c-btn--kind-outline-primary c-btn--size-sm c-covid-stat-table__more-btn">
                                                    <span class="c-btn__overlay"></span>
                                                    <span class="c-btn__content">
                                                        Показать ещё
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="c-tab-pane c-tab-pane--transition c-covid-stat-data__tab-pane" id="experienceTabPane" role="tabpanel" aria-labelledby="experienceTab">
                                <div class="c-covid-stat-data__tab-loader">
                                    <div class="c-progress-circular c-progress-circular--visible c-progress-circular--indeterminate" style="height: 2rem; width: 2rem;" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="22.857142857142858 22.857142857142858 45.714285714285715 45.714285714285715" style="transform: rotate(0deg);">
                                            <circle fill="transparent" cx="45.714285714285715" cy="45.714285714285715" r="20" stroke-width="5.714285714285714" stroke-dasharray="125.664" stroke-dashoffset="125.66370614359172px" class="c-progress-circular__overlay"></circle>
                                        </svg>
                                    </div>
                                </div>

                                <div class="c-covid-stat-data__tab-data">
                                    <div class="o-container@lg">
                                        <div class="c-covid-stat-card c-covid-stat-experience">
                                            <div class="c-covid-stat-card__header">
                                                <h3 class="c-covid-stat-card__title">
                                                    Опыт разных стран
                                                </h3>
                                            </div>

                                            <div class="c-covid-stat-experience__layout">
                                                <h4 class="c-covid-stat-card__subtitle c-covid-stat-experience__subtitle">
                                                    Заражения, тыс.чел. в сутки
                                                </h4>

                                                <div class="c-covid-stat-chart c-covid-stat-experience__chart" id="experienceChartCases"></div>

                                                <div class="c-covid-stat-experience-filter c-covid-stat-experience__filter">
                                                    <h5 class="c-covid-stat-experience-filter__title">
                                                        Фильтр по странам
                                                    </h5>

                                                    <div class="o-stylized-scrollbar c-covid-stat-experience-filter__list" id="experienceChartCasesCountriesList"></div>
                                                </div>
                                            </div>

                                            <div class="c-covid-stat-experience__layout">
                                                <h4 class="c-covid-stat-card__subtitle c-covid-stat-experience__subtitle">
                                                    Смерти, чел. в сутки
                                                </h4>

                                                <div class="c-covid-stat-chart c-covid-stat-experience__chart" id="experienceChartDeaths"></div>

                                                <div class="c-covid-stat-experience-filter c-covid-stat-experience__filter">
                                                    <h5 class="c-covid-stat-experience-filter__title">
                                                        Фильтр по странам
                                                    </h5>

                                                    <div class="o-stylized-scrollbar c-covid-stat-experience-filter__list" id="experienceChartDeathsCountriesList"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <? // END: Covid stat data 
        ?>

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
                        <div class="o-bg-holder c-dynamic-banner__media-bg-holder" style="background-image: url(/upload/images/backgrounds/bg-plus-grid-color-primary-02.svg);"></div>

                        <? // START: Picture 
                        ?>
                        <picture class="c-picture c-dynamic-banner__picture">
                            <img class="c-picture__img c-picture__img--contain c-dynamic-banner__img" src="/upload/images/renders/render-user-friends.png" alt="Вероятность госпитализации">
                        </picture>
                        <? // END: Picture 
                        ?>
                    </div>
                    <div class="c-dynamic-banner__body">
                        <h2 class="c-dynamic-banner__title">
                            Вероятность госпитализации
                        </h2>

                        <p class="c-dynamic-banner__text">
                            Узнайте вероятность госпитализации при заболевании COVID-19 в специальном калькуляторе от Avivir.
                        </p>

                        <div class="c-dynamic-banner__btn-group">
                            <? // START: Button 
                            ?>
                            <a class="c-btn c-btn--kind-primary c-btn--size-lg c-dynamic-banner__btn" href="/calculatedata/">
                                <span class="c-btn__overlay"></span>
                                <span class="c-btn__content">
                                    Подробнее
                                </span>
                            </a>
                            <? // END: Button 
                            ?>
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
                        <div class="o-bg-holder c-dynamic-banner__media-bg-holder" style="background-image: url(/upload/images/backgrounds/bg-plus-grid-color-primary-01.svg);"></div>

                        <? // START: Picture 
                        ?>
                        <picture class="c-picture c-dynamic-banner__picture">
                            <img class="c-picture__img c-picture__img--contain c-dynamic-banner__img" src="/upload/images/renders/render-map-marker.png" alt="Выездное тестирование">
                        </picture>
                        <? // END: Picture 
                        ?>
                    </div>
                    <div class="c-dynamic-banner__body">
                        <h2 class="c-dynamic-banner__title">
                            Выездное тестирование
                        </h2>

                        <p class="c-dynamic-banner__text">
                            В любой момент вы можете заказать выездное тестирование на Covid-19 с помощью наших экспресс-тестов у наших коллег в H-Сlinic.
                        </p>

                        <div class="c-dynamic-banner__btn-group">
                            <? // START: Button 
                            ?>
                            <a class="c-btn c-btn--kind-primary c-btn--size-lg c-dynamic-banner__btn" href="/services/testing-emergency/">
                                <span class="c-btn__overlay"></span>
                                <span class="c-btn__content">
                                    Подробнее
                                </span>
                            </a>
                            <? // END: Button 
                            ?>
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
                        <div class="o-bg-holder c-dynamic-banner__media-bg-holder" style="background-image: url(/upload/images/backgrounds/bg-plus-grid-color-primary-02.svg);"></div>

                        <? // START: Picture 
                        ?>
                        <picture class="c-picture c-dynamic-banner__picture">
                            <img class="c-picture__img c-picture__img--contain c-dynamic-banner__img" src="/upload/images/renders/render-plus.png" alt="Обзор вакцин">
                        </picture>
                        <? // END: Picture 
                        ?>
                    </div>
                    <div class="c-dynamic-banner__body">
                        <h2 class="c-dynamic-banner__title">
                            Обзор вакцин
                        </h2>

                        <p class="c-dynamic-banner__text">
                            Подробная и актуальная информация по разрабатываемым и используемым вакцинам от COVID-19 как в России, так и за рубежом.
                        </p>

                        <div class="c-dynamic-banner__btn-group">
                            <? // START: Button 
                            ?>
                            <a class="c-btn c-btn--kind-primary c-btn--size-lg c-dynamic-banner__btn" href="/individuals/vaccines/">
                                <span class="c-btn__overlay"></span>
                                <span class="c-btn__content">
                                    Подробнее
                                </span>
                            </a>
                            <? // END: Button 
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END: Dynamic banner -->

        <div class="c-test-kit-partner-action c-test-kit-page__partner-action">
            <? $APPLICATION->IncludeComponent(
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
            ); ?>

            <? $APPLICATION->IncludeComponent(
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
            ); ?>
        </div>

        <? // Выездное тестирование 
        ?>
        <? /*$APPLICATION->IncludeComponent(
            "bitrix:main.include",
            ".default",
            array(
                "COMPONENT_TEMPLATE" => ".default",
                "AREA_FILE_SHOW" => "file",
                "PATH" => "/include/banner_testing.php",
                "EDIT_TEMPLATE" => ""
            ),
            false
        );*/ ?>
    </div>
</main>
<? // END: Main 
?>

<script src="<?= SITE_TEMPLATE_PATH ?>/assets/js/covid-stat.js"></script>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php") ?>