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

$curPage = $APPLICATION->GetCurPage();
?>

<?// START: App header ?>
<header class="c-app-header c-app-header--density-compact c-app-header--fullscreen c-app-header--has-media t-light u-bg-light-mint-lighten-2">
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
				<div
					class="o-bg-holder c-app-header__media-bg-holder"
					style="background-image: url(/upload/images/backgrounds/bg-plus-grid-color-primary-01.svg);"
				></div>

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
						class="c-btn c-btn--kind-primary c-btn--size-xl c-app-header__btn"
						href="#getConsultation"
						onclick="clickButtonToForm('<?=$arResult['NAME']?>')"
					>
						<span class="c-btn__overlay"></span>
						<span class="c-btn__content">
							<?= strlen($arResult["PROPERTIES"]["BTNTEXT"]["VALUE"]) > 1 ? $arResult["PROPERTIES"]["BTNTEXT"]["VALUE"] : GetMessage('MD_FREE_CONSULTATION')?>
						</span>
					</a>
					<?// END: Button ?>
				</div>
			</div>
		</div>
	</div>
</header>
<?// END: App header ?>

<?// START: Main ?>
<main class="o-main">
	<div class="o-main__wrap">
		<?// START: Service detail description ?>
		<?if ($arResult['DETAIL_TEXT']):?>
			<section class="c-app-section c-app-section--density-comfortable c-service-detail-description">
				<div class="c-app-section__body">
					<div class="o-container@lg">
						<div class="s-service-detail-description">
							<?=$arResult['DETAIL_TEXT']?>
						</div>
					</div>
				</div>
			</section>
		<?endif?>
		<?// END: Service detail description ?>

		<?// START: Service detail project list carousel ?>
		<?if ($arResult['PROPERTIES']['TOP_GALLERY']['VALUE']):?>
			<section class="c-app-section c-app-section--density-comfortable c-service-detail-project-list-carousel">
				<div class="c-app-section__header">
					<div class="o-container@lg">
						<h2 class="c-app-section__title">
							<?=GetMessage("MD_SERVICE_GALLERY")?>
						</h2>
					</div>
				</div>

				<div class="c-app-section__body">
					<div class="o-container@lg">
						<?$APPLICATION->IncludeComponent(
							"mediahead:photogallery",
							"project-list-carousel",
							array(
								"PHOTOS" => $arResult["PROPERTIES"]["TOP_GALLERY"]["VALUE"],
								"PHOTOS_DESC" => $arResult["PROPERTIES"]["TOP_GALLERY"]["DESCRIPTION"],
								//"VIDEOS" => $arResult["PROPERTIES"]["SLIDER_PHOTOS"]["VALUE"],
								//"VIDEOS_DESC" => $arItem["PROPERTY_VIDEO_DESCRIPTION"],
								//"YOUTUBE" => $arResult["PROPERTIES"]["YOUTUBE"]["VALUE"],
								"WIDTH" => 1312,
								"HEIGHT" => 440,
								"RESIZE_TYPE" => 'EXACT',
								"AUTOPLAY" => true,
								"NO_CLICK" => false,
							),
							$component
						);?>
					</div>
				</div>
			</section>
		<?endif?>
		<?// END: Service detail project list carousel ?>

		<?// START: Service detail feature list ?>
		<?if ($arResult['TEASERS']):?>
			<section class="c-app-section c-app-section--density-comfortable c-service-detail-feature-list">
				<?if (mb_strpos($curPage, 'testing-emergency') === false):?>
					<div class="c-app-section__header">
						<div class="o-container@lg">
							<h2 class="c-app-section__title">
								<?=GetMessage("MD_WE_EQUIP")?>
							</h2>
						</div>
					</div>
				<?endif?>

				<div class="c-app-section__body">
					<div class="o-container@lg">
						<ul class="c-feature-list">
							<?foreach($arResult['TEASERS'] as $teaser):?>
								<li class="c-feature-list__item">
									<?// START: Feature item ?>
									<div class="c-feature-item c-feature-item--row">
										<?// START: Icon ?>
										<object
											class="c-icon c-icon--object c-feature-item__icon"
											data="<?=$teaser['ICON']['SRC']?>"
											type="image/svg+xml"
										></object>
										<?// END: Icon ?>

										<div class="c-feature-item__body">
											<p class="c-feature-item__text">
												<?=$teaser['PREVIEW_TEXT']?>
											</p>
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

		<?// START: Service detail stage list ?>
		<?if ($arResult['PROPERTIES']['STAGES']['VALUE']):?>
			<section class="c-app-section c-app-section--density-comfortable u-bg-light-mint-lighten-2 c-service-detail-stage-list">
				<div class="c-app-section__header">
					<div class="o-container@lg">
						<h2 class="c-app-section__title">
							<?=GetMessage("MD_STAGES")?>
						</h2>
					</div>
				</div>

				<div class="c-app-section__body">
					<div class="o-container@lg">
						<ol class="c-service-detail-stage-list__layout">
							<?foreach($arResult['PROPERTIES']['STAGES']['VALUE'] as $key => $stage):?>
								<li class="c-service-detail-stage-list-item c-service-detail-stage-list__item">
									<h3 class="c-service-detail-stage-list-item__title">
										<?=$arResult['PROPERTIES']['STAGES']['DESCRIPTION'][$key]?>
									</h3>

									<?// START: Icon ?>
									<div class="c-service-detail-stage-list-item__icon"></div>
									<?// END: Icon ?>

									<p class="c-service-detail-stage-list-item__text">
										<?=$stage['TEXT']?>
									</p>
								</li>
							<?endforeach?>
						</ol>
					</div>
				</div>
			</section>
		<?endif?>
		<?// END: Service detail stage list ?>


		<?// START: Service detail feature list ?>
		<?if ($arResult['TEASERS_FEATURES']):?>
			<section class="c-app-section c-app-section--density-comfortable c-service-detail-feature-list">
				<div class="c-app-section__header">
					<div class="o-container@lg">
						<h2 class="c-app-section__title">
							<?=GetMessage('MD_ADVANTAGES')?>
						</h2>
					</div>
				</div>

				<div class="c-app-section__body">
					<div class="o-container@lg">
						<ul class="c-service-detail-feature-list__layout">
							<?foreach($arResult['TEASERS_FEATURES'] as $teaser):?>
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

		<?// START: Test kit partner action ?>
		<div class="c-test-kit-partner-action c-test-kit-page__partner-action">
			<?if (!empty($arResult['RETAIL'])):?>
				<section class="c-test-kit-partner-action__section">
					<div class="o-container@lg c-test-kit-partner-action__container">
						<div class="c-test-kit-partner-action__header">
							<h2 class="c-test-kit-partner-action__title">
								<?=GetMessage("MD_PERSONAL_USE")?>
							</h2>
						</div>

						<div class="c-test-kit-partner-action__body">
							<ul class="c-test-kit-partner-action__list">
								<?foreach($arResult['RETAIL'] as $retail):?>
									<li class="c-test-kit-partner-action__item">
										<div class="c-partner-card">
											<div class="c-partner-card__media">
												<picture class="o-ratio o-ratio--4x3 c-partner-card__picture">
													<img
													class="c-partner-card__img"
													src="<?=$retail['ICON']['SRC']?>"
													alt="<?=GetMessage("MD_PERSONAL_USE")?> <?=$retail['NAME']?>"
													/>
												</picture>
											</div>

											<a
												class="o-stretched-link c-partner-card__link"
												href="<?=strlen($retail['CUSTOM']) > 0 ? $retail['CUSTOM']: $retail['LINK']?>"
												target="_blank"
												rel="noopener noreferrer"
												title="<?=GetMessage("MD_PERSONAL_USE")?> <?=$retail['NAME']?>"
												aria-label="<?=GetMessage("MD_PERSONAL_USE")?> <?=$retail['NAME']?>"
											></a>
										</div>
									</li>
								<?endforeach?>
							</ul>
						</div>
					</div>
				</section>
			<?endif?>

			<?if (!empty($arResult['CLINICS'])):?>
				<section class="c-test-kit-partner-action__section">
					<div class="o-container@lg c-test-kit-partner-action__container">
						<div class="c-test-kit-partner-action__header">
							<h2 class="c-test-kit-partner-action__title">
								<?if ($arResult['CODE'] == 'parallelnyy-import'):?>
									Производители и поставщики
								<?else:?>	
									<?=GetMessage("MD_CLINICS_TEST")?>
								<?endif?>
							</h2>
						</div>

						<div class="c-test-kit-partner-action__body">
							<ul class="c-test-kit-partner-action__list">
								<?foreach($arResult['CLINICS'] as $clinic):?>
									<li class="c-test-kit-partner-action__item">
										<div class="c-partner-card">
											<div class="c-partner-card__media">
												<picture class="o-ratio o-ratio--4x3 c-partner-card__picture">
													<img
													class="c-partner-card__img"
													src="<?=$clinic['ICON']['SRC']?>"
													alt="<?=GetMessage("MD_CLINICS_TEST")?> <?=$clinic['NAME']?>"
													/>
												</picture>
											</div>

											<?if ($clinic['LINK']):?>
												<a
													class="o-stretched-link c-partner-card__link"
													href="<?=$clinic['LINK']?>"
													target="_blank"
													rel="noopener noreferrer"
													title="<?=GetMessage("MD_CLINICS_TEST")?> <?=$clinic['NAME']?>"
													aria-label="<?=GetMessage("MD_CLINICS_TEST")?> <?=$clinic['NAME']?>"
												></a>
											<?endif?>	
										</div>
									</li>
								<?endforeach?>
							</ul>
						</div>
					</div>
				</section>
			<?endif?>
		</div>
		<?// END: Test kit partner action ?>

		<?// START: Service detail documents ?>
		<?if ($arResult['PROPERTIES']['GALLERY']['VALUE']):?>
			<section class="c-app-section c-app-section--density-comfortable c-service-detail-documents">
				<div class="c-app-section__header">
					<div class="o-container@lg">
						<h2 class="c-app-section__title">
							<?=GetMessage('MD_DOCS')?>
						</h2>
					</div>
				</div>

				<div class="c-app-section__body">
					<div class="o-container@lg">
						<?$APPLICATION->IncludeComponent(
							"mediahead:photogallery",
							"docs",
							array(
								"PHOTOS" => $arResult["PROPERTIES"]["GALLERY"]["VALUE"],
								"PHOTOS_DESC" => $arResult["PROPERTIES"]["GALLERY"]["DESCRIPTION"],
								//"VIDEOS" => $arResult["PROPERTIES"]["SLIDER_PHOTOS"]["VALUE"],
								//"VIDEOS_DESC" => $arItem["PROPERTY_VIDEO_DESCRIPTION"],
								//"YOUTUBE" => $arResult["PROPERTIES"]["YOUTUBE"]["VALUE"],
								"WIDTH" => 240,
								"HEIGHT" => 340,
								"RESIZE_TYPE" => 'EXACT',
								// "AUTOPLAY" => false,
								"NO_CLICK" => false,
								"USE_ZOOM" => true
							),
							$component
						);?>
					</div>
				</div>
			</section>
		<?endif?>
		<?// END: Service detail documents ?>
	</div>
</main>
<?// END: Main ?>

<?//apre($arResult,'arResult')?>
