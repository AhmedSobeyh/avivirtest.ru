<style>
    .typeselect {top: -1000px;position: absolute;}
</style>
<?echo CLanguage::SelectBox('Lang', LANGUAGE_ID,'','action_lang()');?><? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

global $USER;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Context;
use Bitrix\Main\Config\Option;

$context = Context::getCurrent();

$langUrl = $context->getLanguage() == "ru" ? Option::get("askaron.settings", "UF_ENVERSION") . $curPage :  Option::get("askaron.settings", "UF_RUVERSION") . $curPage;

Loc::loadMessages(__FILE__);
?>

<!DOCTYPE html>
<html lang="<?= $context->getLanguage() ?>">

<head>
	<? include "init.php"; ?>
	<title><? $APPLICATION->ShowTitle() ?><?/*if (!$isMainPage):?> / <?endif*/ ?><? //=GetMessage('TITLE_POSTFIX')?></title>
	<meta name="description" content="Компания «Авивир» реализует проекты оснащения медицинских организаций и фармацевтических производств оборудованием, строительства объектов здравоохранения; занимается поставками средств диагностики, лекарственных препаратов и парафармацевтических товаров.">
																					

	<?
	$APPLICATION->ShowHead()
	?>

	<script src="https://www.google.com/recaptcha/api.js?render=6LeDbKcdAAAAAEfpnmdkR5hi-laNXammfGCj0kRv"></script>
	<script>
		grecaptcha.ready(function() {
			grecaptcha.execute('6LeDbKcdAAAAAEfpnmdkR5hi-laNXammfGCj0kRv', {
				action: 'contact'
			}).then(function(token) {
				var recaptchaResponse = document.getElementById('recaptchaResponse');
				recaptchaResponse.value = token;
			});
		});
	</script>
	
      <style>
        body {
          font-family: Mikro,sans-serif!important;
        }
      </style>
</head>

<body>
	<? // START: Bitrix panel 
	?>
	<? if ($_REQUEST["np"] != "y") : ?>
		<? $APPLICATION->ShowPanel() ?>
	<? endif ?>
	<? // END: Bitrix panel 
	?>
	<div id="react-root">

		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PWGP95R" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->

		<? // START: Application 
		?>

		<? // START: App bar 
		?>

		<header class="page-Header-module-header" id="header">
			<div class="page-Header-module-info">
				<div class="page-Header-module-logo">
					<a href="/">
						<div class="hidden-Hidden-module-mobile-hidden">
							<svg width="54" height="55" viewBox="0 0 54 55" fill="none" xmlns="http://www.w3.org/2000/svg">
								<g clip-path="url(#clip0_0_772)">
									<path d="M33.4449 6.65616H30.7838C30.6345 6.65616 30.5047 6.75414 30.4625 6.89458L26.101 21.2782L21.7265 6.89458C21.6843 6.75414 21.5545 6.65616 21.4052 6.65616H18.7279C18.5397 6.65616 18.4066 6.83906 18.4618 7.01869L24.3486 26.3765C24.4005 26.543 24.5498 26.6541 24.7218 26.6541H27.5289C27.6781 26.6541 27.808 26.5561 27.8501 26.4157L33.711 7.09054C33.7239 7.04808 33.7272 7.00236 33.7239 6.9599C33.7402 6.79986 33.6136 6.65289 33.4449 6.65289V6.65616Z" fill="#DDF0E9"></path>
									<path d="M53.6624 34.9988H44.4526C44.2806 34.9988 44.128 35.1132 44.0794 35.2765L38.1893 54.6342C38.1342 54.8139 38.2672 54.9968 38.4554 54.9968H41.0808C41.2528 54.9968 41.4053 54.8824 41.454 54.7191L44.6927 44.0751L47.9606 54.7224C48.0125 54.889 48.1618 55 48.3338 55H50.9722C51.1604 55 51.2967 54.8171 51.2383 54.6342L47.9963 44.0751H51.05C51.222 44.0751 51.3746 43.9608 51.4232 43.7975L53.9772 35.4365C54.0421 35.2177 53.8831 34.9988 53.6559 34.9988H53.6624ZM48.5447 42.4127H45.199L46.9481 36.6645H50.3004L48.5447 42.4127Z" fill="#DDF0E9"></path>
									<path d="M30.1283 26.6574H32.8089C32.9582 26.6574 33.088 26.5594 33.1301 26.419L38.991 7.09384C39.0559 6.87501 38.8969 6.65619 38.6697 6.65619H36.067C35.9178 6.65619 35.788 6.75417 35.7458 6.89461L29.8622 26.2916C29.8071 26.4712 29.9434 26.6541 30.1283 26.6541V26.6574Z" fill="#DDF0E9"></path>
									<path d="M41.9798 34.9988H39.3771C39.2278 34.9988 39.098 35.0968 39.0558 35.2372L33.1723 54.6342C33.1171 54.8138 33.2534 54.9967 33.4384 54.9967H36.1189C36.2682 54.9967 36.398 54.8988 36.4402 54.7583L42.301 35.4332C42.3659 35.2176 42.2069 34.9955 41.9798 34.9955V34.9988Z" fill="#DDF0E9"></path>
									<path d="M38.9779 28.3328H29.4306C29.2845 28.3328 29.1515 28.4308 29.1093 28.5712L27.292 34.5546C27.2271 34.7734 27.3861 34.9923 27.6132 34.9923H35.8106L30.5599 52.2565L23.3556 28.5745C23.3134 28.4308 23.1836 28.3361 23.0343 28.3361H17.1215C16.8944 28.3361 16.7354 28.5549 16.8003 28.7737L24.6958 54.7256C24.7477 54.8922 24.897 55.0033 25.069 55.0033H31.1083C31.2803 55.0033 31.4328 54.8889 31.4815 54.7256L39.3544 28.8456C39.4322 28.5908 39.244 28.3361 38.9812 28.3361L38.9779 28.3328Z" fill="#DDF0E9"></path>
									<path d="M22.5701 26.2295L14.6778 0.277613C14.6259 0.111045 14.4766 0 14.3046 0H8.26532C8.09332 0 7.9408 0.114311 7.89212 0.277613L0.0160408 26.1577C-0.0618438 26.4124 0.126377 26.6672 0.389238 26.6672H9.93984C10.0859 26.6672 10.2189 26.5692 10.2611 26.4287L12.0784 20.4454C12.1433 20.2265 11.9843 20.0077 11.7571 20.0077H3.55979L8.81051 2.74673L16.0148 26.4287C16.057 26.5724 16.1868 26.6672 16.3361 26.6672H22.2489C22.476 26.6672 22.635 26.4483 22.5701 26.2295Z" fill="#DDF0E9"></path>
								</g>
								<defs>
									<clipPath id="clip0_0_772">
										<rect width="54" height="55" fill="white"></rect>
									</clipPath>
								</defs>
							</svg>
						</div>
						<div class="hidden-Hidden-module-desktop-hidden">
							<svg width="47" height="42" viewBox="0 0 47 42" fill="none" xmlns="http://www.w3.org/2000/svg">
								<g clip-path="url(#clip0_0_49)">
									<path d="M46.256 13.297H36.1799C36.022 13.297 35.8852 13.3976 35.8431 13.551L33.9226 19.8573C33.8542 20.0848 34.0226 20.3176 34.2593 20.3176H42.9096L37.3637 38.5223L29.7606 13.5457C29.7132 13.3976 29.5764 13.2917 29.4238 13.2917H23.1835C22.9467 13.2917 22.773 13.5245 22.8467 13.752L31.1812 41.1199C31.2339 41.2945 31.397 41.4162 31.5759 41.4162H37.9478C38.1319 41.4162 38.2898 41.2945 38.3424 41.1199L46.6506 13.8314C46.7296 13.5616 46.5349 13.2917 46.256 13.2917V13.297Z" fill="#DDF0E9"></path>
									<path d="M24.8249 27.6641L16.4904 0.296269C16.4378 0.121682 16.2747 0 16.0958 0H9.72385C9.53969 0 9.38184 0.121682 9.32922 0.296269L1.01574 27.5848C0.936812 27.8546 1.1315 28.1244 1.41037 28.1244H11.4918C11.6496 28.1244 11.7864 28.0239 11.8285 27.8705L13.7491 21.5642C13.8175 21.3367 13.6491 21.1039 13.4123 21.1039H4.75681L10.3026 2.89392L17.9058 27.8705C17.9531 28.0186 18.09 28.1244 18.2425 28.1244H24.4829C24.7197 28.1244 24.8933 27.8916 24.8197 27.6641H24.8249Z" fill="#DDF0E9"></path>
								</g>
								<defs>
									<clipPath id="clip0_0_49">
										<rect width="47" height="42" fill="white"></rect>
									</clipPath>
								</defs>
							</svg>
						</div>
					</a>
				</div>
				<div class="hidden-Hidden-module-mobile-hidden">
					<?
					$APPLICATION->IncludeComponent( //навигация в хедере
						"bitrix:menu",
						"app-bar-nav",
						array(
							"ROOT_MENU_TYPE" => "top",
							"MENU_CACHE_TYPE" => "A",
							"MENU_CACHE_TIME" => "36000000",
							"MENU_CACHE_USE_GROUPS" => "N",
							"MENU_CACHE_GET_VARS" => array(),
							"MAX_LEVEL" => "2",
							"CHILD_MENU_TYPE" => "sub",
							"USE_EXT" => "Y",
							"DELAY" => "N",
							"ALLOW_MULTI_SELECT" => "N"
						),
						false
					);
					?>
					
				</div>
			</div>
			<div class="page-Header-module-action">
				<div class="page-Header-module-number">
					<div class="hidden-Hidden-module-desktop-hidden">
						<a href="tel:+74952415107" target="_blank" rel="noreferrer"><img class="page-Header-module-phone" src="/upload/images/static_media/icons/phone.svg" alt="phone-call" /></a>
						<img class="page-Header-module-sandwich" src="/upload/images/static_media/icons/sandwich.svg" alt="sandwich" />
						
						
					</div>
					<div class="hidden-Hidden-module-mobile-hidden">
						<a href="tel:+74952415107"><button class="button-Button-module-button">+7 (495) 241-51-07</button></a>
						<a href="https://en.avivir.ru/"><button class="button-Button-module-button">En</button></a>
					</div>
				</div>
			</div>
			<div class="hidden-Hidden-module-desktop-hidden">
			    
				<div class="page-Header-module-menu">
					<?
					$APPLICATION->IncludeComponent( //навигация в хедере
						"bitrix:menu",
						"app-bar-nav",
						array(
							"ROOT_MENU_TYPE" => "top",
							"MENU_CACHE_TYPE" => "A",
							"MENU_CACHE_TIME" => "36000000",
							"MENU_CACHE_USE_GROUPS" => "N",
							"MENU_CACHE_GET_VARS" => array(),
							"MAX_LEVEL" => "2",
							"CHILD_MENU_TYPE" => "sub",
							"USE_EXT" => "Y",
							"DELAY" => "N",
							"ALLOW_MULTI_SELECT" => "N"
						),
						false
					);
					?>
					
				</div>
			</div>
		</header>
		<div class="page-Header-module-layer"></div>
		<main class="page-Page-module-content">