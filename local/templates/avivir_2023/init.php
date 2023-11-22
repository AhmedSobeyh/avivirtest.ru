<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Page\AssetLocation;
use Bitrix\Main\Page\Asset;

CJSCore::Init(["jquery"]);

$assets = Asset::getInstance();

// Meta
$assets->addString('<meta charset="utf-8" />', false, AssetLocation::BEFORE_CSS);
$assets->addString('<meta http-equiv="X-UA-Compatible" content="IE=edge">', false, AssetLocation::BEFORE_CSS);
$assets->addString('<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">', false, AssetLocation::BEFORE_CSS);

// Favicon & theme
$assets->addString('<link rel="apple-touch-icon" sizes="180x180" href="/upload/images/favicon/apple-touch-icon.png">', false, AssetLocation::BEFORE_CSS);
$assets->addString('<link rel="icon" type="image/png" sizes="32x32" href="/upload/images/favicon/favicon-32x32.png">', false, AssetLocation::BEFORE_CSS);
$assets->addString('<link rel="icon" type="image/png" sizes="16x16" href="/upload/images/favicon/favicon-16x16.png">', false, AssetLocation::BEFORE_CSS);
$assets->addString('<link rel="manifest" href="/upload/images/favicon/site.webmanifest">', false, AssetLocation::BEFORE_CSS);
$assets->addString('<link rel="mask-icon" href="/upload/images/favicon/safari-pinned-tab.svg" color="#2b5763">', false, AssetLocation::BEFORE_CSS);
$assets->addString('<link rel="shortcut icon" href="/upload/images/favicon/favicon.ico">', false, AssetLocation::BEFORE_CSS);
$assets->addString('<meta name="msapplication-TileColor" content="#2b5763">', false, AssetLocation::BEFORE_CSS);
$assets->addString('<meta name="msapplication-config" content="/upload/images/favicon/browserconfig.xml">', false, AssetLocation::BEFORE_CSS);
$assets->addString('<meta name="theme-color" content="#2b5763">', false, AssetLocation::BEFORE_CSS);

// Open Graph
$assets->addString('<meta property="og:type" content="website">', false, AssetLocation::BEFORE_CSS);
$assets->addString('<meta property="og:title" content="Avivir - Комплексные решения для здравоохранения">', false, AssetLocation::BEFORE_CSS);
// $assets->addString('<meta property="og:description" content="Описание">', false, AssetLocation::BEFORE_CSS);
$assets->addString('<meta property="og:url" content="https://avivir.ru/">', false, AssetLocation::BEFORE_CSS);
$assets->addString('<meta property="og:image" content="/upload/images/favicon/android-chrome-512x512.png">', false, AssetLocation::BEFORE_CSS);
$assets->addString('<meta property="og:site_name" content="Avivir">', false, AssetLocation::BEFORE_CSS);
$assets->addString('<meta property="og:locale" content="ru_RU">', false, AssetLocation::BEFORE_CSS);
$assets->addString('<meta property="fb:app_id" content="avivir.ru">', false, AssetLocation::BEFORE_CSS);

// Google fonts
$assets->addString('<link rel="preconnect" href="https://fonts.googleapis.com" />', false, AssetLocation::BEFORE_CSS);
$assets->addString('<link rel="preconnect" href="https://fonts.gstatic.com" />', false, AssetLocation::BEFORE_CSS);
$assets->addString('<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet" />', false, AssetLocation::BEFORE_CSS);

// Common CSS
$assets->addCss(SITE_TEMPLATE_PATH . '/assets/css/style.css', false, AssetLocation::BEFORE_CSS);


// Common JS
$assets->addString('<script type="module" src="' . SITE_TEMPLATE_PATH . '/assets/js/script.js" defer></script>', false, AssetLocation::AFTER_JS);

//Slider JS
$assets->addString('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" data-rh="true">', false, AssetLocation::AFTER_JS);
$assets->addString('<link rel="stylesheet" href="https://code.jquery.com/jquery-3.4.1.min.js" data-rh="true">', false, AssetLocation::AFTER_JS);
$assets->addString('<script type="module" src="' . SITE_TEMPLATE_PATH . '/assets/js/slick.min.js" defer></script>', false, AssetLocation::AFTER_JS);

