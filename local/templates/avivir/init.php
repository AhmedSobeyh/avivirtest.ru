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
$assets->addString('<link rel="preconnect" href="https://fonts.gstatic.com" />', false, AssetLocation::BEFORE_CSS);
$assets->addString('<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet" />', false, AssetLocation::BEFORE_CSS);

// Exo JS
$assets->addJs(SITE_TEMPLATE_PATH.'/assets/js/exo.js', false, AssetLocation::AFTER_JS);

// Masonry JS
$assets->addJs(SITE_TEMPLATE_PATH.'/assets/vendors/masonry/dist/masonry.pkgd.min.js', false, AssetLocation::AFTER_JS);

// PhotoSwipe CSS
$assets->addCss(SITE_TEMPLATE_PATH.'/assets/vendors/photoswipe/dist/photoswipe.css', false, AssetLocation::BEFORE_CSS);
$assets->addCss(SITE_TEMPLATE_PATH.'/assets/vendors/photoswipe/dist/default-skin/default-skin.css', false, AssetLocation::BEFORE_CSS);

// PhotoSwipe JS
$assets->addJs(SITE_TEMPLATE_PATH.'/assets/vendors/photoswipe/dist/photoswipe.min.js', false, AssetLocation::AFTER_JS);
$assets->addJs(SITE_TEMPLATE_PATH.'/assets/vendors/photoswipe/dist/photoswipe-ui-default.min.js', false, AssetLocation::AFTER_JS);

// Moment JS
$assets->addJs(SITE_TEMPLATE_PATH.'/assets/vendors/moment/moment.min.js', false, AssetLocation::AFTER_JS);
$assets->addJs(SITE_TEMPLATE_PATH.'/assets/vendors/moment/moment-with-locales.min.js', false, AssetLocation::AFTER_JS);

//Micromodal
$assets->addJs(SITE_TEMPLATE_PATH.'/assets/vendors/micromodal/dist/micromodal.min.js', false, AssetLocation::AFTER_JS);

//Mediaelement video-player
$assets->addCss(SITE_TEMPLATE_PATH.'/assets/vendors/mediaelement/build/mediaelementplayer.css', false, AssetLocation::BEFORE_CSS);
$assets->addJs(SITE_TEMPLATE_PATH.'/assets/vendors/mediaelement/build/mediaelement-and-player.min.js', false, AssetLocation::AFTER_JS);

// Swiper CSS
// $assets->addCss(SITE_TEMPLATE_PATH.'/assets/vendors/swiper/dist/swiper-bundle.min.css', false, AssetLocation::BEFORE_CSS);

// Swiper JS
$assets->addJs(SITE_TEMPLATE_PATH.'/assets/vendors/swiper/dist/swiper-bundle.min.js', false, AssetLocation::AFTER_JS);

// Common CSS
$assets->addCss(SITE_TEMPLATE_PATH.'/assets/css/common.css', false, AssetLocation::BEFORE_CSS);

// Common JS
$assets->addJs(SITE_TEMPLATE_PATH.'/assets/js/common.js', false, AssetLocation::AFTER_JS);

?>
