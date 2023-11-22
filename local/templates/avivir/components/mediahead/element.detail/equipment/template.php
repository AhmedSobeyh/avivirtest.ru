<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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


//apre($arResult, 'arResult');
?>

<?// START: App header ?>
<header class="c-app-header c-app-header--density-compact c-app-header--fullscreen c-app-header--has-media t-light c-test-kit-app-header">
	<div
		class="o-bg-holder c-test-kit-app-header__bg-holder"
		style="background-image: url(/upload/images/test-kit/test-kit-bg-holder-00.svg);"
	></div>

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
			<div class="c-app-header__media">
				<? // START: Picture ?>
				<?
				if( $arResult['DETAIL_PICTURE']['SRC'] )
					$picture = $arResult['DETAIL_PICTURE']['SRC'];

				if ( !$picture && $arResult['PREVIEW_PICTURE']['SRC'] )
					$picture = $arResult['PREVIEW_PICTURE']['SRC'];

				if ( !$picture )
					$picture = '/upload/images/renders/render-molecule.png';
				?>

				<?if ($picture):?>
					<picture class="c-picture o-ratio o-ratio--1x1">
						<img
							class="c-picture__img c-picture__img--contain"
							src="<?=$picture?>"
							alt="<?=$arResult['NAME']?>"
						>
					</picture>
				<?endif?>
				<? // END: Picture ?>
			</div>

			<div class="c-app-header__body">
				<h1 class="c-app-header__title">
					<?=$arResult['NAME']?>
				</h1>

				<span class="c-app-header__lead">
					<?=$arResult['PREVIEW_TEXT']?>
				</span>

				<div class="c-app-header__btn-group">
				<?// START: Button ?>
					<a
						class="
							c-btn
							c-btn--kind-primary
							c-btn--size-xl
							c-app-header__btn
						"
						href="#getConsultation"
						onclick="clickButtonToForm('<?=GetMessage('MD_CALC_ORDER')?>')"
					>
						<span
							class="c-btn__overlay"
						></span>
						<span class="c-btn__content">
							<?=GetMessage('MD_CALC_ORDER')?>
						</span>
					</a>
					<?// END: Button ?>

					<?if ($arResult['PROPERTIES']['PRESENTATION']['DISPLAY']):?>
						<?$file = $arResult['PROPERTIES']['PRESENTATION']['DISPLAY']['FILE_VALUE']?>
						<?// START: Button ?>
						<a href="<?=$file['SRC']?>" download="<?=$file["ORIGINAL_NAME"]?>" target="_blank"
							class="
								c-btn
								c-btn--kind-outline-primary
								c-btn--size-xl
								c-app-header__btn
							"
						>
							<span class="c-btn__overlay"></span>

							<span class="c-btn__content">
								<?=GetMessage('MD_TEST_PRESENTATION')?>
							</span>
						</a>
						<?// END: Button ?>
					<?endif?>
				</div>
			</div>
		</div>
	</div>
</header>
<?// END: App header ?>

<?// START: Main ?>
<main class="o-main">
	<div class="o-main__wrap">
		<?// START: Test kit summary ?>
		<div class="c-test-kit-summary c-test-kit-page__summary">
			<div class="o-container@lg c-test-kit-summary__container">
				<ul class="c-test-kit-summary__layout">
					<?if (!empty($arResult['PROPERTIES']['BRAND']['VALUE'])):?>
						<li class="c-test-kit-feature-list__item">
							<?// START: Feature item ?>
							<div class="c-feature-item c-feature-item--column">
								<?// START: Icon ?>
								<object
									class="c-icon c-icon--object c-feature-item__icon"
									data="/upload/images/icon/duotone/molecules.svg"
									type="image/svg+xml"
								></object>
								<?// END: Icon ?>

								<div class="c-feature-item__body">
									<h3 class="c-feature-item__text">
										<?=GetMessage("MD_MANUFACTURER")?>
									</h3>

									<p class="c-feature-item__title">
										<a href="<?=$arResult['BRAND']['DETAIL_PAGE_URL']?>" target="_blank"><?=$arResult['BRAND']['NAME']?></a>
									</p>
								</div>
							</div>
							<?// END: Feature item ?>
						</li>
					<?endif?>

					<li class="c-test-kit-feature-list__item">
						<?// START: Feature item ?>
						<div class="c-feature-item c-feature-item--column">
							<?// START: Icon ?>
							<object
								class="c-icon c-icon--object c-feature-item__icon"
								data="/upload/images/icon/duotone/globe.svg"
								type="image/svg+xml"
							></object>
							<?// END: Icon ?>

							<div class="c-feature-item__body">
								<h3 class="c-feature-item__text">
									<?=GetMessage("MD_LEADING_GLOBAL")?>
								</h3>

								<p class="c-feature-item__title">
									<?=GetMessage("MD_LEADING_GLOBAL_MANUFACTURER")?>
								</p>
							</div>
						</div>
						<?// END: Feature item ?>
					</li>

					<?if (!empty($arResult['PROPERTIES']['COUNTRY']['VALUE'])):?>
						<li class="c-test-kit-feature-list__item">
							<?// START: Feature item ?>
							<div class="c-feature-item c-feature-item--column">
								<?// START: Icon ?>
								<object
									class="c-icon c-icon--object c-feature-item__icon"
									data="/upload/images/icon/duotone/thermometer.svg"
									type="image/svg+xml"
								></object>
								<?// END: Icon ?>

								<div class="c-feature-item__body">
									<h3 class="c-feature-item__text">
										<?=GetMessage("MD_TEMPERATURE")?>
									</h3>

									<p class="c-feature-item__title">
										<?=$arResult['PROPERTIES']['TEMPERATURE']['VALUE']?>
									</p>
								</div>
							</div>
							<?// END: Feature item ?>
						</li>
					<?endif?>

					<li class="c-test-kit-feature-list__item">
						<?// START: Feature item ?>
						<div class="c-feature-item c-feature-item--column">
							<?// START: Icon ?>
							<object
								class="c-icon c-icon--object c-feature-item__icon"
								data="/upload/images/icon/duotone/boxes.svg"
								type="image/svg+xml"
							></object>
							<?// END: Icon ?>

							<div class="c-feature-item__body">
							<h3 class="c-feature-item__text">
									<?=GetMessage("MD_TURNKEY")?>
								</h3>

								<p class="c-feature-item__title">
									<?=GetMessage("MD_TURNKEY_BASIS")?>
								</p>
							</div>
						</div>
						<?// END: Feature item ?>
					</li>
				</ul>
			</div>
		</div>
		<?// END: Test kit summary ?>

		<?// START: Service detail description ?>
		<?if ($arResult['DETAIL_TEXT']):?>
			<section class="c-app-section c-app-section--density-comfortable c-service-detail-description">
				<div class="c-app-section__body">
					<div class="o-container@xl">
						<div class="s-service-detail-description">
							<?=$arResult['DETAIL_TEXT']?>
						</div>
					</div>
				</div>
			</section>
		<?endif?>
		<?// END: Service detail description ?>

		<?// START: Service detail feature list ?>
		<?if ($arResult['SECTION_TEASERS']):?>
			<section class="c-app-section c-app-section--density-comfortable c-service-detail-feature-list">
				<div class="c-app-section__header">
					<div class="o-container@xl">
						<h2 class="c-app-section__title">
							<?=GetMessage('MD_FEATURES')?>
						</h2>
					</div>
				</div>

				<div class="c-app-section__body">
					<div class="o-container@xl">
						<ul class="c-service-detail-feature-list__layout">
							<?foreach($arResult['SECTION_TEASERS'] as $teaser):?>
								<li class="c-service-detail-feature-list__item">
									<?// START: Feature item ?>
									<div
										class="c-feature-item c-feature-item--column c-feature-item--align-left c-feature-item--no-max-width">
										<?// START: Icon ?>
										<object
											class="c-icon c-icon--object c-feature-item__icon"
											data="<?=$teaser['ICON']['SRC']?>"
											type="image/svg+xml"
										></object>
										<?// END: Icon ?>

										<div class="c-feature-item__body">
											<div class="s-feature-item">
												<?=$teaser['PREVIEW_TEXT']?>
											</div>
										</div>
									</div>
									<?// END: Feature item ?>
								</li>
							<?endforeach?>
						</ul>
					</div>
				</div>
			</section>
		<?endif?>
		<?// END: Service detail feature list ?>

		<?// Оснащение учреждений ?>
		<?/*$APPLICATION->IncludeComponent(
			"bitrix:main.include",
			".default",
			array(
				"COMPONENT_TEMPLATE" => ".default",
				"AREA_FILE_SHOW" => "file",
				"PATH" => "/include/banner_equipment.php",
				"EDIT_TEMPLATE" => ""
			),
			false
		);*/?>
	</div>
</main>
<?// END: Main ?>
