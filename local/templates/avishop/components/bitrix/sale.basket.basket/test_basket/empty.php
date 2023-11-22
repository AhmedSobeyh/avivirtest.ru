<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
?>
<main class="page-Page-module-content">
	<div class="content-block-ContentBlock-module-block cart-Cart-module-cart-wrapper">
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
				Корзина
			</h2>

			<p>Ваша корзина пуста</p>
		</div>
	</div>
</main>