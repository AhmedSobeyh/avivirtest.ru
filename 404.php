<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');
CHTTP::SetStatus("404 Not Found");

@define("ERROR_404", "Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$APPLICATION->SetTitle("Страница не найдена");
$APPLICATION->SetPageProperty("APP_HEADER_TEXT", "Извините, но вероятно ссылка устарела и страница теперь находится по другому адресу. Попробуйте полистать меню сайта.");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_after.php");
?>

<?// START: App header ?>
<header class="c-app-header c-app-header--density-compact c-app-header--fullscreen c-app-header--has-media t-light">
	<div class="o-container@lg c-app-header__container">
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
						alt="<?$APPLICATION->ShowTitle()?>"
					/>
				</picture>
				<? /* END: Picture */ ?>
			</div>

			<div class="c-app-header__body">
				<h1 class="c-app-header__title">
					<?$APPLICATION->ShowTitle()?>
				</h1>

				<p class="c-app-header__lead">
					<?$APPLICATION->ShowProperty("APP_HEADER_TEXT")?>
				</p>
			</div>
		</div>
	</div>
</header>
<?// END: App header ?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
