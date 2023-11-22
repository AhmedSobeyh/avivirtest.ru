<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

include "init.php";

global $USER;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Context;
use Bitrix\Main\Config\Option;

$context = Context::getCurrent();

$langUrl = $context->getLanguage() == "ru" ? Option::get("askaron.settings","UF_ENVERSION") . $curPage :  Option::get("askaron.settings","UF_RUVERSION") . $curPage;

Loc::loadMessages(__FILE__);
?><!DOCTYPE html>
<html lang="<?=$context->getLanguage()?>">
<head>
	<title><?$APPLICATION->ShowTitle()?><?/*if (!$isMainPage):?> / <?endif*/?><?//=GetMessage('TITLE_POSTFIX')?></title>

	<?$APPLICATION->ShowHead()?>

   <script src="https://www.google.com/recaptcha/api.js?render=6LeDbKcdAAAAAEfpnmdkR5hi-laNXammfGCj0kRv"></script>
    <script>
        grecaptcha.ready(function () {
            grecaptcha.execute('6LeDbKcdAAAAAEfpnmdkR5hi-laNXammfGCj0kRv', { action: 'contact' }).then(function (token) {
                var recaptchaResponse = document.getElementById('recaptchaResponse');
                recaptchaResponse.value = token;
            });
        });
    </script>
</head>
<body>

	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PWGP95R"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->

	<?// START: Application ?>
	<div class="o-app o-layout o-layout--full-height t-light">
		<div class="o-app__wrap">
			<?// START: Bitrix panel ?>
			<?if( $_REQUEST["np"] != "y" ):?>
				<?$APPLICATION->ShowPanel()?>
			<?endif?>
			<?// END: Bitrix panel ?>

			<?// START: App banner Top ?>
				<div class="c-dialog-overlay c-dialog--absolute c-dialog-overlay--active c-dialog--small c-delivery-banner" id="delivery-banner">
					<div class="c-dialog-overlay__content">
						<div class="c-dialog-overlay__layout c-delivery-banner__content" role="dialog">
							<div class="c-delivery-banner__body">
								<div class="o-container@lg c-delivery-banner__container">
									<div class="c-delivery-banner__layout">
										<div class="c-delivery-banner__media">
											<img src="<?=SITE_DIR?>upload/images/backgrounds/bg-guarantee.svg" alt="bg-guarantee.svg" class="c-delivery-banner__img">
										</div>
										<div class="c-delivery-banner__content">
											<?if($context->getLanguage() === 'ru'):?>
												<div class="c-delivery-banner__text">
													Несмотря на все ограничения, мы <strong>гарантируем поставку любого медицинского оборудования из Европы, США</strong> и других стран по <a class="c-delivery-banner__link" href="#getConsultation">вашей заявке</a>
												</div>
											<?else:?>
												<div class="c-delivery-banner__text">
													Despite all the restrictions, we <strong>guarantee the supply of any medical equipment from Europe, the USA</strong>  and other countries on  <a class="c-delivery-banner__link" href="#getConsultation">your request</a>
												</div>
											<?endif?>
										</div>
										<button class="c-btn c-btn--density-default c-btn--size-sm-small c-dialog-overlay__close" type="button" aria-label="Close modal" data-close-banner>
											<span class="btn__overlay"></span>
											<span class="btn__content btn__content--icon">
											</span>
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?// END: App banner Top?>

			<?// START: App banner Bottom ?>
				<div class="c-dialog-overlay c-dialog--fullscreen c-dialog-overlay--active c-dialog-information c-information-banner" id="information-banner">
					<div class="c-dialog-overlay__content">
						<div class="c-dialog-overlay__layout c-information-banner__content" role="dialog">
							<div class="c-information-banner__body">
								<div class="o-container@lg c-banner__container--information">
									<div class="c-banner__layout">
										<div class="c-banner__media">
											<img src="<?=SITE_DIR?>upload/images/backgrounds/bg-information.svg" alt="bg-information.svg" class="c-banner__img--information">
										</div>
										<div class="c-banner__content">
											<?if($context->getLanguage() === 'ru'):?>
												<div class="c-banner__text c-banner__text--information">
													Если вы сотрудник компании, которая покинула российский рынок, или у вас есть идеи по сотрудничеству <a class="c-banner__link c-banner__link--information" href="#getConsultation">отправьте своё предложение</a> и мы обязательно его рассмотрим
												</div>
											<?else:?>
												<div class="c-banner__text c-banner__text--information">
													If you are an employee of a company that has withdrawed from the Russian market, or you have business ideas, <a class="c-banner__link c-banner__link--information" href="#getConsultation">send your proposal</a>  and we will surely consider it
												</div>
											<?endif?>
										</div>
										<button class="c-btn c-btn--density-default c-btn--size-sm-small c-dialog-overlay__close" type="button" aria-label="Close modal" data-close-banner-bottom>
											<span class="btn__overlay"></span>
											<span class="btn__content btn__content-icon--dark">
											</span>
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?// END: App banner Bottom ?>

			<?// START: App bar ?>
			<nav class="c-app-bar c-app-bar--expanded@xl c-app-bar--absolute t-dark" data-floating>
				<div class="o-container@lg c-app-bar__container">
					<?if ( !$isMainPage ):?>
						<a class="c-app-bar-brand c-app-bar__brand" href="<?=SITE_DIR?>">
							<picture>
								<source
									srcset="
									<?=SITE_DIR?>upload/images/logo/logo-avivir-full-symbol-light.svg
									"
									type="image/jpeg"
									media="(min-width: 75em)"
								/>
								<img
									class="c-app-bar-brand__img"
									src="<?=SITE_DIR?>upload/images/logo/logo-avivir-full-slim-light.svg"
									alt="Логотип Авивир"
								/>
							</picture>
						</a>
					<?else:?>
						<div class="c-app-bar-brand c-app-bar__brand">
							<picture>
								<source
									srcset="
									<?=SITE_DIR?>upload/images/logo/logo-avivir-full-symbol-light.svg
									"
									type="image/jpeg"
									media="(min-width: 75em)"
								/>
								<img
									class="c-app-bar-brand__img"
									src="<?=SITE_DIR?>upload/images/logo/logo-avivir-full-slim-light.svg"
									alt="Логотип Авивир"
								/>
							</picture>
						</div>
					<?endif?>

					<div
						class="c-collapse c-app-bar__collapse"
						id="mainMenuCollapse"
						data-exo-forced-dimension="calc(100vh - 4rem)"
					>
						<div class="c-collapse__container">

							<?$APPLICATION->IncludeComponent(
								"bitrix:menu",
								"app-bar-nav",
								array(
									"ROOT_MENU_TYPE" => "top",
									"MENU_CACHE_TYPE" => "A",
									"MENU_CACHE_TIME" => "36000000",
									"MENU_CACHE_USE_GROUPS" => "N",
									"MENU_CACHE_GET_VARS" => array(
									),
									"MAX_LEVEL" => "2",
									"CHILD_MENU_TYPE" => "sub",
									"USE_EXT" => "Y",
									"DELAY" => "N",
									"ALLOW_MULTI_SELECT" => "N"
								),
								false
							);?>

							<ul class="c-app-bar-subnav c-app-bar__subnav">
								<li class="c-app-bar-subnav__item">
									<a class="c-app-bar-subnav__link" href="/media/">
										<?=GetMessage("MD_NAV_MEDIA")?>
									</a>
								</li>
								<?/*
								<li class="c-app-bar-subnav__item">
									<a class="c-app-bar-subnav__link" href="/social/">
										Социальная ответственность
									</a>
								</li>
								*/?>
								<li class="c-app-bar-subnav__item">
									<a class="c-app-bar-subnav__link" href="/contacts/"
										><?=GetMessage("MD_NAV_CONTACTS")?></a
									>
								</li>
							</ul>
						</div>
					</div>

					<?// START: Button ?>
					<? /* <a
						class="
							c-btn c-btn--kind-primary c-btn--size-lg
							c-app-bar__cta-btn
						"
						href="/calculatedata/"
					>
						<span class="c-btn__overlay"></span>
						<span class="c-btn__content">
							<?=GetMessage('MD_CALC_H')?>
						</span>
					</a> */ ?>
					<a
						class="c-btn c-btn--kind-primary c-btn--size-default c-app-bar__cta-btn d-none d-inline-flex@xl"
						href="tel:<?=Option::get("askaron.settings","UF_PHONE")?>"
					>
						<span class="c-btn__overlay"></span>
						<span class="c-btn__content">
							<?=Option::get("askaron.settings","UF_PHONE")?>
						</span>
					</a>
					<?// END: Button ?>

					<?// START: Button ?>
					<a
						class="c-btn c-btn--kind-primary c-btn--size-default c-btn--icon c-app-bar__cta-btn d-none@xl"
						href="tel:<?=Option::get("askaron.settings","UF_PHONE")?>"
					>
						<span class="c-btn__overlay"></span>
						<span class="c-btn__content">
							<svg class="c-icon c-icon--svg c-icon--size-sm" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" viewBox="0 0 512 512">
								<path d="M212.3 299.8c-48.9-48.9-60-97.8-62.5-117.4-.7-5.4 1.2-10.9 5-14.7l39.6-39.6c5.8-5.8 6.9-14.9 2.5-21.9l-63-97.9C129.1.6 119.2-2.2 111 1.9L9.8 49.5C3.2 52.8-.7 59.8.1 67.1 5.4 117.5 27.4 241.3 149 363c121.7 121.7 245.5 143.6 295.9 148.9 7.3.7 14.3-3.1 17.6-9.7L510.1 401c4.1-8.1 1.3-18-6.4-22.9l-97.9-63c-7-4.4-16-3.3-21.9 2.5l-39.6 39.6c-3.9 3.9-9.3 5.7-14.7 5-19.5-2.5-68.4-13.5-117.3-62.4z"/>
							</svg>
						</span>
					</a>
					<?// END: Button ?>

					<?// START: Button ?>
					<a
						class="c-btn c-btn--icon c-btn--rounded-circle c-app-bar__language-toggler"
						href="https://<?=$langUrl?>"
						rel="nofollow"
					>
						<span class="c-btn__overlay"></span>
						<span class="c-btn__content"> <?= $context->getLanguage() == "ru" ? 'en' : 'ru' ?> </span>
					</a>
					<?// END: Button ?>

					<button
						class="c-app-bar-toggler c-app-bar__toggler is-collapsed"
						type="button"
						data-exo-toggle="collapse"
						data-exo-target="#mainMenuCollapse"
						aria-controls="mainMenuCollapse"
						aria-expanded="false"
						aria-label="Переключатель основной навигации"
					>
						<span class="c-app-bar-toggler__container">
							<span class="c-app-bar-toggler__icon"></span>
						</span>
					</button>
				</div>
			</nav>
			<?// END: App bar ?>

			<?// START: App header ?>
			<?if ( $APPLICATION->GetDirProperty('DEFAULT_APP_HEADER') != 'N' && $APPLICATION->GetPageProperty('DEFAULT_APP_HEADER') != 'N' && !defined("ERROR_404") ) :?>
				<header class="c-app-header c-app-header--density-compact t-light">
					<div class="o-container@lg c-app-header__container">
						<?$APPLICATION->IncludeComponent(
							"bitrix:breadcrumb",
							"breadcrumb",
							array(
								"COMPONENT_TEMPLATE" => "breadcrumb",
								"START_FROM" => "0",
								"PATH" => "",
								"SITE_ID" => "s1"
							),
							false
						);?>

						<div class="c-app-header__layout">
							<div class="c-app-header__body">
								<h1 class="c-app-header__title"><? $APPLICATION->ShowTitle(true); ?></h1>
							</div>
						</div>
					</div>
				</header>
			<?endif?>
			<?// END: App header ?>