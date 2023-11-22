<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Контакты компании «Авивир» — инновационные решения для комплексных проектов в здравоохранении");
$APPLICATION->SetPageProperty("description", "Мы находимся на ул. Нобеля д. 5, офис 230, Инновационный центр «Сколково». &#128222; +7 (495) 241-92-83.");
$APPLICATION->SetTitle("Контакты");

use Bitrix\Main\Page\AssetLocation;
use Bitrix\Main\Page\Asset;

$curDir = $APPLICATION->GetCurDir();

$assets = Asset::getInstance();
$assets->addJs($curDir . '/script.js', false, AssetLocation::BODY_END);

// Yandex Maps API
$assets->addJs('https://api-maps.yandex.ru/2.1/?apikey=61b6ce9e-f2a1-4547-a2da-1b1c76edff28&lang=ru_RU', false, AssetLocation::BODY_END);

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Context;
use Bitrix\Main\Config\Option;

$context = Context::getCurrent();

Loc::loadMessages(__FILE__);
?>
<? $APPLICATION->IncludeComponent(
	"bitrix:main.include",
	".default",
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"AREA_FILE_SHOW" => "file",
		"PATH" => "/include/footer_feedback.php",
		"EDIT_TEMPLATE" => "",
		"SHOW_BREADCRUMBS" => "Y"
	),
	false,
	["HIDE_ICONS" => "Y"]
); ?>

<div class="contacts-ContactsBlock-module-wrapper">
	<div class="contacts-ContactsBlock-module-left">
		<h2 class="contacts-ContactsBlock-module-heading">Контакты</h2>
		<div class="contacts-ContactsBlock-module-block-big">
			<a class="contacts-ContactsBlock-module-link contacts-ContactsBlock-module-phone" href="tel:+74957409920">+7
				(495) 740-99-20</a>
		</div>
		<div class="contacts-ContactsBlock-module-block">
			<p class="contacts-ContactsBlock-module-title">Заказ дефицитного оборудования и реагентов</p>
			<a class="contacts-ContactsBlock-module-link" href="mailto:import@avivir.ru">import@avivir.ru</a>
			<p class="contacts-ContactsBlock-module-title">Для СМИ</p>
			<a class="contacts-ContactsBlock-module-link" href="mailto:media@avivir.ru">media@avivir.ru</a>
			<p class="contacts-ContactsBlock-module-title">
				Регистрация медицицинских изделий и лекарственных препаратов
			</p>
			<a class="contacts-ContactsBlock-module-link" href="mailto:reg@avivir.ru">reg@avivir.ru</a>
			<p class="contacts-ContactsBlock-module-title">Уточнение статуса заказа</p>
			<a class="contacts-ContactsBlock-module-link" href="mailto:logistics@avivir.ru">logistics@avivir.ru</a>
			<p class="contacts-ContactsBlock-module-title">Отдел продаж</p>
			<a class="contacts-ContactsBlock-module-link" href="mailto:sales@avivir.ru">sales@avivir.ru</a>
			<p class="contacts-ContactsBlock-module-title">Исполнение госконтрактов и участие в торгах</p>
			<a class="contacts-ContactsBlock-module-link" href="mailto:tenders@avivir.ru">tenders@avivir.ru</a>
			<p class="contacts-ContactsBlock-module-title">По прочим вопросам</p>
			<a class="contacts-ContactsBlock-module-link" href="mailto:info@avivir.ru">info@avivir.ru</a>
		</div>
	</div>
	<div class="contacts-ContactsBlock-module-right">
		<p class="contacts-ContactsBlock-module-title contacts-ContactsBlock-module-title-big">Где мы находимся:</p>
		<p class="contacts-ContactsBlock-module-text">
			121205, ул. Нобеля, д. 5, Инновационный центр «Сколково»
		</p>
		<div class="contacts-ContactsBlock-module-map">
			<div style="position: relative; overflow: hidden; height: 100%;margin-top: -48px;">
				<iframe src="https://yandex.ru/map-widget/v1/?ll=37.342443%2C55.684022&amp;mode=search&amp;ol=geo&amp;ouri=ymapsbm1%3A%2F%2Fgeo%3Fdata%3DCgoxNTc4NjYyMjMzEm7QoNC-0YHRgdC40Y8sINCc0L7RgdC60LLQsCwg0JjQvdC90L7QstCw0YbQuNC-0L3QvdGL0Lkg0YbQtdC90YLRgCDQodC60L7Qu9C60L7QstC-LCDRg9C70LjRhtCwINCd0L7QsdC10LvRjywgNSIKDb1dFUIVsbxeQg%2C%2C&amp;sctx=ZAAAAAgAEAAaKAoSCQCuZMdGcD5AET%2FjwoGQBk5AEhIJRUYHJGHfuj8RSgnBqnr5nT8iBgABAgMEBSgKOABAmKEHSAFiIGFkZF9zbmlwcGV0PXBob3RvX2VtYmVkZGluZ3MvMi54YiNyZW1vdmVfc25pcHBldD1waG90b19lbWJlZGRpbmdzLzEueGI5cmVhcnI9c2NoZW1lX0xvY2FsL0dlby9TdWJ0aXRsZXMvVXNlUGluU3VidGl0bGVzRm9ybXVsYT0xagJydZ0BzcxMPaABAKgBAL0BIbq7YMIBDAAAAAAAAAAAAAAAAOoBAPIBAPgBAIICItGD0Lsg0L3QvtCx0LXQu9GPINC0NSDQvtGE0LjRgSAyMzCKAgCSAgCaAgxkZXNrdG9wLW1hcHM%3D&amp;sll=37.341547%2C55.684270&amp;sspn=0.024891%2C0.008159&amp;text=%D1%83%D0%BB%20%D0%BD%D0%BE%D0%B1%D0%B5%D0%BB%D1%8F%20%D0%B45%20%D0%BE%D1%84%D0%B8%D1%81%20230&amp;z=16" width="100%" height="100%" allowfullscreen="" style="position: relative"></iframe>
			</div>
		</div>
		
	</div>
</div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>