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
?>

<?// START: Page header ?>
<header
	class="
		c-page-header
		c-page-header--fullscreen
		c-page-header--has-media
		t-light
	"
>
	<div
		class="o-bg-holder c-test-kit-page-header__bg-holder"
		style="background-image: url(/upload/images/test-kit/test-kit-bg-holder-00.svg);"
	></div>

	<div class="o-container@lg c-page-header__container">
		<div class="c-page-header__breadcrumb">
			<nav class="c-breadcrumb c-breadcrumb--scrollable" aria-label="<?=GetMessage('MD_BREADCRUMB_NAME')?>">
				<ol
					class="c-breadcrumb__list"
					itemprop="http://schema.org/breadcrumb"
					itemscope
					itemtype="http://schema.org/BreadcrumbList"
				>
					<li
						class="c-breadcrumb__item"
						id="bx_breadcrumb_0"
						itemprop="itemListElement"
						itemscope
						itemtype="http://schema.org/ListItem"
					>
						<a class="c-breadcrumb__link" href="/" itemprop="item">
							<span itemprop="name">
								<?=GetMessage("MD_NAV_HOME")?>
							</span>
						</a>
						<meta itemprop="position" content="1">
					</li>
					<li
						class="c-breadcrumb__item"
						id="bx_breadcrumb_1"
						itemprop="itemListElement"
						itemscope
						itemtype="http://schema.org/ListItem"
					>
						<a class="c-breadcrumb__link" href="/products/" itemprop="item">
							<span itemprop="name">
								<?=GetMessage("MD_NAV_PRODUCTS")?>
							</span>
						</a>
						<meta itemprop="position" content="2">
					</li>
					<?$section = current($arResult["SECTION"]["PATH"]);?>
					<li
						class="c-breadcrumb__item"
						id="bx_breadcrumb_2"
						itemprop="itemListElement"
						itemscope
						itemtype="http://schema.org/ListItem"
					>
						<a class="c-breadcrumb__link" href="<?=$section['SECTION_PAGE_URL']?>" itemprop="item">
							<span itemprop="name">
								<?=$section['NAME']?>
							</span>
						</a>
						<meta itemprop="position" content="3">
					</li>
					<li
						class="c-breadcrumb__item is-active o-sr-only"
						id="bx_breadcrumb_3"
						itemprop="itemListElement"
						itemscope
						itemtype="http://schema.org/ListItem"
					>
						<?=$arResult["NAME"]?>
						<meta itemprop="name" content="<?=$arResult["NAME"]?>">
						<link itemprop="item" href="<?=$section['SECTION_PAGE_URL'].$arResult['CODE']?>/">
						<meta itemprop="position" content="4">
					</li>
				</ol>
			</nav>
		</div>

		<div class="c-page-header__layout">
			<div class="c-page-header__media">
				<div
					class="
						o-bg-holder
						c-test-kit-page-header__media-bg-holder
					"
					style="
						background-image: url(/upload/images/test-kit/test-kit-shape-00.png);
					"
				></div>

				<?
				if( $arResult['DETAIL_PICTURE']['SRC'] )
					$picture = $arResult['DETAIL_PICTURE']['SRC'];

				//else
					//$picture = SITE_TEMPLATE_PATH.'/assets/images/placeholder/person-placeholder.svg';
				?>

				<?if ($picture):?>
					<picture>

						<img
						class="c-page-header__img"
						src="<?=$picture?>"
						alt="<?=$arResult['NAME']?>"
						/>
					</picture>
				<?endif?>
			</div>

			<?//apre($arResult, 'arResult')?>
			<?//apre($arResult['RETAIL'], '$arResult["RETAIL"]')?>

			<div class="c-page-header__body">
				<h1 class="c-page-header__title">
					<?=$arResult['NAME']?>
				</h1>

				<p class="c-page-header__lead">
					<?=$arResult['PREVIEW_TEXT']?>
				</p>

				<div class="c-page-header__btn-group">
					<?// START: Button ?>
					<a
						class="
							c-btn
							c-btn--kind-primary
							c-btn--size-xl
							c-page-header__btn
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

					<?// START: Купить в розницу - Button ?>
					<?if ( $arResult['PHARM_RETAIL'] ) :?>
						<a href="<?=$arResult['PHARM_RETAIL']?>" download="<?=$file["ORIGINAL_NAME"]?>" target="_blank"
							class="
								c-btn
								c-btn--kind-outline-primary
								c-btn--size-xl
								c-page-header__btn
							"
						>
							<span class="c-btn__overlay"></span>

							<span class="c-btn__content">
								<?=GetMessage('MD_PHARM_RETAIL')?>
							</span>
						</a>
					<?endif?>
					<?// END: Купить в розницу - Button ?>

					<?/*if ($arResult['PROPERTIES']['PRESENTATION']['DISPLAY']):?>
						<?$file = $arResult['PROPERTIES']['PRESENTATION']['DISPLAY']['FILE_VALUE']?>
						<?// START: Button ?>
						<a href="<?=$file['SRC']?>" download="<?=$file["ORIGINAL_NAME"]?>" target="_blank"
							class="
								c-btn
								c-btn--kind-outline-primary
								c-btn--size-xl
								c-page-header__btn
							"
						>
							<span class="c-btn__overlay"></span>

							<span class="c-btn__content">
								<?=GetMessage('MD_TEST_PRESENTATION')?>
							</span>
						</a>
						<?// END: Button ?>
					<?endif*/?>
				</div>
			</div>
		</div>
	</div>
</header>
<?// END: Page header ?>

<main class="c-test-kit-page">
	<?// START: Test kit statistic ?>
	<? /* <section class="c-test-kit-statistic c-test-kit-page__statistic">
		<div class="o-container@lg c-test-kit-statistic__container">
			<div class="c-test-kit-statistic__summary">
				<object
					class="
						c-icon c-icon__object
						c-test-kit-statistic__icon
					"
					data="/upload/images/icon/duotone/users.svg"
					type="image/svg+xml"
				></object>
				<h2 class="c-test-kit-statistic__title">
					По данным <br />статистики ВОЗ
					<span
						class="
							c-test-kit-statistic__title-number
						"
					>
						80%
					</span>
					<span
						class="
							c-test-kit-statistic__title-after
						"
					>
						заразившихся болеют бессимптомной
						формой коронавируса и не знают об
						этом
					</span>
				</h2>
			</div>

			<div class="c-test-kit-statistic__layout">
				<div
					class="
						c-test-kit-statistic-detail
						c-test-kit-statistic__detail
					"
				>
					<object
						class="
							c-icon c-icon__object
							c-test-kit-statistic-detail__media
						"
						data="/upload/images/test-kit/test-kit-type-m.svg"
						type="image/svg+xml"
					></object>
					<div
						class="
							c-test-kit-statistic-detail__body
						"
					>
						<h3
							class="
								c-test-kit-statistic-detail__title
							"
						>
							Антитела М
						</h3>
						<p
							class="
								c-test-kit-statistic-detail__text
							"
						>
							указывают на активную стадию
							течения заболевания используется
							в качестве скрининга вирусной
							инфекции
						</p>
					</div>
				</div>
				<div
					class="
						c-test-kit-statistic-detail
						c-test-kit-statistic__detail
					"
				>
					<object
						class="
							c-icon c-icon__object
							c-test-kit-statistic-detail__media
						"
						data="/upload/images/test-kit/test-kit-type-g.svg"
						type="image/svg+xml"
					></object>
					<div
						class="
							c-test-kit-statistic-detail__body
						"
					>
						<h3
							class="
								c-test-kit-statistic-detail__title
							"
						>
							Антитела G
						</h3>
						<p
							class="
								c-test-kit-statistic-detail__text
							"
						>
							производятся после острой фазы
							заболевания, являются
							показателем предыдущей или
							вторичной инфекции
						</p>
					</div>
				</div>
			</div>
		</div>
	</section> */ ?>
	<?// END: Test kit statistic ?>

	<?// START: Test kit summary ?>
	<div class="c-test-kit-summary c-test-kit-page__summary">
		<div class="o-container@lg c-test-kit-summary__container">
			<ul class="c-test-kit-summary__layout">
				<?if (!empty($arResult['PROPERTIES']['BRAND'])):?>
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

				<?if (!empty($arResult['PROPERTIES']['COUNTRY'])):?>
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
									<?=GetMessage('MD_COUNTRY')?>
								</h3>

								<p class="c-feature-item__title">
									<?=$arResult['PROPERTIES']['COUNTRY']['VALUE']?>
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
							data="/upload/images/icon/duotone/search.svg"
							type="image/svg+xml"
						></object>
						<?// END: Icon ?>

						<div class="c-feature-item__body">
							<h3 class="c-feature-item__text">
								<?=GetMessage("MD_DETECTS")?>
							</h3>

							<p class="c-feature-item__title">
								<?//=$arResult['PROPERTIES']['TEMPERATURE']['VALUE']?>
								<?=$arResult['PROPERTIES']['DETERMINES']['HL_DATA']['NAME']?>
							</p>
						</div>
					</div>
					<?// END: Feature item ?>
				</li>

				<li class="c-test-kit-feature-list__item">
					<?// START: Feature item ?>
					<div class="c-feature-item c-feature-item--column">
						<?// START: Icon ?>
						<object
							class="c-icon c-icon--object c-feature-item__icon"
							data="/upload/images/icon/duotone/test-tube-single.svg"
							type="image/svg+xml"
						></object>
						<?// END: Icon ?>

						<div class="c-feature-item__body">
							<h3 class="c-feature-item__text">
								<?=GetMessage('MD_BIOMATERIAL')?>
							</h3>

							<p class="c-feature-item__title">
								<?=$arResult['PROPERTIES']['BIOMATERIAL']['HL_DATA']['NAME']?>
							</p>
						</div>
					</div>
					<?// END: Feature item ?>
				</li>
			</ul>
		</div>
	</div>
	<?// END: Test kit summary ?>

	<?// $arResult['PROPERTIES']['TIZERS']?>
	<?// START: Test kit feature list ?>
	<section class="c-test-kit-feature-list c-test-kit-page__feature-list">
		<div class="o-container@lg c-test-kit-feature-list__container">
			<div class="c-test-kit-feature-list__header">
				<h2 class="c-test-kit-feature-list__title">
					<?//Вероятно задать имя блока тизеров как свойство?>
					<?=$arResult["NAME"]?>
				</h2>
			</div>

			<div class="c-test-kit-feature-list__body">
				<ul class="c-test-kit-feature-list__layout">

					<?if (mb_strlen($arResult['PROPERTIES']['SPECIFICITY']['VALUE']) > 0):?>
						<li class="c-test-kit-feature-list__item">
							<?// START: Feature item ?>
							<div
								class="
									c-feature-item
									c-feature-item--row
								"
							>
								<span class="c-feature-item__data">
									<span class="c-feature-item__value">
									<?=$arResult['PROPERTIES']['SPECIFICITY']['VALUE']?>
									</span>
									<span class="c-feature-item__unit">
										%
									</span>
								</span>

								<div
									class="c-feature-item__body"
								>
									<p class="c-feature-item__text">
										<?=GetMessage('MD_SPECIFICITY')?> <span class="o-sr-only"><?=$arResult['PROPERTIES']['SPECIFICITY']['VALUE']?>%</span>
									</p>
								</div>
							</div>
							<?// END: Feature item ?>
						</li>
					<?endif?>

					<?if (mb_strlen($arResult['PROPERTIES']['ACCURACY']['VALUE']) > 0):?>
						<li class="c-test-kit-feature-list__item">
							<?// START: Feature item ?>
							<div
								class="
									c-feature-item
									c-feature-item--row
									test-class
								"
							>
								<span class="c-feature-item__data">
									<span class="c-feature-item__value">
									<?=$arResult['PROPERTIES']['ACCURACY']['VALUE']?>
									</span>
									<span class="c-feature-item__unit">
										%
									</span>
								</span>

								<div
									class="c-feature-item__body"
								>
									<p class="c-feature-item__text">
									<?=GetMessage('MD_ACCURACY')?> <span class="o-sr-only"><?=$arResult['PROPERTIES']['ACCURACY']['VALUE']?>%</span>
									</p>
								</div>
							</div>
							<?// END: Feature item ?>
						</li>
					<?endif?>

					<?if (mb_strlen($arResult['PROPERTIES']['SENSITIVITY']['VALUE']) > 0):?>
						<li class="c-test-kit-feature-list__item">
							<?// START: Feature item ?>
							<div
								class="
									c-feature-item
									c-feature-item--row
									test-class
								"
							>
								<span class="c-feature-item__data">
									<span class="c-feature-item__value">
									<?=$arResult['PROPERTIES']['SENSITIVITY']['VALUE']?>
									</span>
									<span class="c-feature-item__unit">
										%
									</span>
								</span>

								<div
									class="c-feature-item__body"
								>
									<p class="c-feature-item__text">
									<?=GetMessage('MD_SENSITIVITY')?> <span class="o-sr-only"><?=$arResult['PROPERTIES']['SENSITIVITY']['VALUE']?>%</span>
									</p>
								</div>
							</div>
							<?// END: Feature item ?>
						</li>
					<?endif?>

					<?if (mb_strlen($arResult['PROPERTIES']['MINUTES']['VALUE']) > 0):?>
						<li class="c-test-kit-feature-list__item">
							<?// START: Feature item ?>
							<div
								class="
									c-feature-item
									c-feature-item--row
								"
							>
								<?// START: Icon ?>
								<object
									class="
										c-icon
										c-icon--object
										c-feature-item__icon
									"
									data="/upload/images/icon/duotone/hourglass.svg"
									type="image/svg+xml"
								></object>
								<?// END: Icon ?>

								<div
									class="
										c-feature-item__body
									"
								>
									<p
										class="c-feature-item__text"
									>
										<?=$arResult['PROPERTIES']['MINUTES']['VALUE']?> <?=GetMessage('MD_MINUTES')?>
									</p>
								</div>
							</div>
							<?// END: Feature item ?>
						</li>
					<?endif?>

					<?//apre($arResult);?>
					<?foreach($arResult['TEASERS'] as $teaser):?>
						<li
							class="
								c-test-kit-feature-list__item
							"
						>
							<?// START: Feature item ?>
							<div
								class="
									c-feature-item
									c-feature-item--row
								"
							>
								<?// START: Icon ?>
								<object
									class="
										c-icon
										c-icon--object
										c-feature-item__icon
									"
									data="<?=$teaser['ICON']['SRC']?>"
									type="image/svg+xml"
								></object>
								<?// END: Icon ?>

								<div
									class="
										c-feature-item__body
									"
								>
									<p
										class="c-feature-item__text"
									>
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
	<?// END: Test kit feature list ?>

	<?// START: Test kit detail ?>
	<section class="c-test-kit-detail c-test-kit-page__detail">
		<div
			class="o-bg-holder c-test-kit-detail__bg-holder"
			style="background-image: url(/upload/images/test-kit/test-kit-shape-01.png);"
		></div>

		<div class="o-container@lg c-test-kit-detail__container">
			<div class="c-test-kit-detail__header">
				<h2 class="c-test-kit-detail__title">
					<?=GetMessage("MD_PRODUCT_OVERVIEW")?>
				</h2>
			</div>

			<div class="c-test-kit-detail__body">
				<div class="c-test-kit-detail__layout">
					<div class="c-test-kit-detail__media">
						<?if ($arResult['PROPERTIES']['GALLERY']['VALUE']):?>
							<?$APPLICATION->IncludeComponent(
								"mediahead:photogallery",
								"mini",
								array(
									"PHOTOS" => $arResult["PROPERTIES"]["GALLERY"]["VALUE"],
									"PHOTOS_DESC" => $arResult["PROPERTIES"]["GALLERY"]["DESCRIPTION"],
									//"VIDEOS" => $arResult["PROPERTIES"]["SLIDER_PHOTOS"]["VALUE"],
									//"VIDEOS_DESC" => $arItem["PROPERTY_VIDEO_DESCRIPTION"],
									//"YOUTUBE" => $arResult["PROPERTIES"]["YOUTUBE"]["VALUE"],
									//"TITLE" => GetMessage("MD_SERVICE_GALLERY"),
									"WIDTH" => 500,
									"HEIGHT" => 373,
									"RESIZE_TYPE" => 'EXACT',
									"AUTOPLAY" => true,
									"NO_CLICK" => false,
								),
								$component
							);?>
						<?endif?>
					</div>

					<div class="c-test-kit-detail__content">
						<div class="c-test-kit-detail__text">
							<div class="s-test-kit-detail">
								<?=$arResult["DETAIL_TEXT"]?>
							</div>
						</div>

						<?if (mb_strlen($arResult['PROPERTIES']['COMPOSITION']['VALUE']['TEXT']) > 0):?>
							<div class="c-test-kit-detail__set">
								<?// START: Icon ?>
								<object
									class="c-icon c-icon--object c-test-kit-detail__set-icon"
									data="/upload/images/icon/duotone/3d-boxes.svg"
									type="image/svg+xml"
								></object>
								<?// END: Icon ?>

								<div class="c-test-kit-detail__set-text">
									<div class="s-test-kit-detail-set">
										<?=$arResult['PROPERTIES']['COMPOSITION']['VALUE']['TEXT']?>
									</div>
								</div>
							</div>
						<?endif?>

						<div class="c-test-kit-detail__btn-group">
							<?if ($arResult['PROPERTIES']['INSTRUCTION']['VALUE']):?>
								<?$file = $arResult['PROPERTIES']['INSTRUCTION']['DISPLAY']['FILE_VALUE']?>
								<a
									class="c-btn c-btn--kind-primary c-btn--size-lg c-test-kit-detail__btn"
									target="_blank"
									href="<?=$file['SRC']?>"
									download="<?=$file['ORIGINAL_NAME']?>"
								>
									<span
										class="c-btn__overlay"
									></span>
									<span class="c-btn__content">
										<?=GetMessage("MD_INSTRUCTION")?>
									</span>
								</a>
							<?endif?>

							<?if ($arResult['REGDOCS']):?>
								<button
									class="c-btn c-btn--kind-outline-primary c-btn--size-lg c-test-kit-detail__btn js-photoswipe-show-regdocs"
								>
									<span
										class="c-btn__overlay"
									></span>
									<span class="c-btn__content">
										<?=GetMessage("MD_REGDOCS")?>
									</span>
								</button>
							<?endif?>

							<?if ($arResult['PROPERTIES']['PRESENTATION']['DISPLAY']):?>
								<?$file = $arResult['PROPERTIES']['PRESENTATION']['DISPLAY']['FILE_VALUE']?>
								<?// START: Button ?>
								<a href="<?=$file['SRC']?>" download="<?=$file["ORIGINAL_NAME"]?>" target="_blank"
									class="
										c-btn
										c-btn--kind-outline-primary
										c-btn--size-lg
										c-test-kit-detail__btn
										js-photoswipe-show-regdocs
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
		</div>
	</section>
	<?// END: Test kit detail ?>

	<?// Порядок использования ?>
	<?// START: Test kit usage ?>
	<?if ($arResult["USAGE"]):?>
		<section class="c-test-kit-usage c-test-kit-page__usage">
			<div
				class="o-bg-holder c-test-kit-usage__bg-holder"
				style="background-image: url(/upload/images/test-kit/test-kit-shape-01.png);"
			></div>

			<div class="o-container@lg c-test-kit-usage__container">
				<div class="c-test-kit-usage__header">
					<h2 class="c-test-kit-usage__title">
						<?=GetMessage("MD_USAGE")?>
					</h2>
				</div>

				<div class="c-test-kit-usage__body">
					<ul class="c-test-kit-usage__layout">
						<?foreach($arResult["USAGE"] as $useTeaser):?>
							<li class="c-test-kit-usage__item">
								<?// START: Feature item ?>
								<div class="c-feature-item c-feature-item--column">
									<?// START: Icon ?>
									<object
										class="
											c-icon
											c-icon--object
											c-feature-item__icon
										"
										data="<?=$useTeaser["ICON"]["SRC"]?>"
										type="image/svg+xml"
									></object>
									<?// END: Icon ?>

									<div class="c-feature-item__body">
										<p class="c-feature-item__text">
											<?=$useTeaser["PREVIEW_TEXT"]?>
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
	<?// END: Test kit usage ?>

	<?// START: Test kit usage ?>
	<? /* Пока отключу. Оживить надо нормально?>
	<section class="c-test-kit-procedure c-test-kit-page__procedure">
		<div class="o-container@lg c-test-kit-procedure__container">
			<div class="c-test-kit-procedure__header">
				<h2 class="c-test-kit-procedure__title">
					Процедура взятия мазка из области носоглотки
				</h2>
			</div>

			<div class="c-test-kit-procedure__body">
				<div class="c-test-kit-procedure__layout">
					<div class="c-test-kit-procedure__media">
						<div class="o-ratio o-ratio--1x1">
							<object
								class="
									o-ratio__item
									c-icon
									c-icon--object
									c-test-kit-procedure__icon
								"
								data="/upload/images/test-kit/test-kit-procedure-00.svg"
								type="image/svg+xml"
							></object>
						</div>
					</div>

					<div class="c-test-kit-procedure__content">
						<ol class="c-test-kit-procedure__list">
							<li class="c-test-kit-procedure__item">
								Для взятия биологического биологического образца из носоглоточной области, с осторожностью введите тампон на палочке в носовую полость. Продолжайте аккуратно вводить тампон до тех пор, пока не встретите сопротивления в носовой раковине.
							</li>
							<li class="c-test-kit-procedure__item">
								Мягкими движениями пальцев несколько раз поверните палочку с тампоном вокруг своей оси и извлеките ее из носовой полости.
							</li>
							<li class="c-test-kit-procedure__item">
								Визуально убедитесь в том, что кончик тампона увлажнен
							</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?// END: Test kit usage ?>

	<?// START: Test kit conducting test ?>
	<section class="c-test-kit-conducting-test c-test-kit-page__usage">
		<div class="o-container@lg c-test-kit-conducting-test__container">
			<div class="c-test-kit-conducting-test__header">
				<h2 class="c-test-kit-conducting-test__title">
					Проведение теста
				</h2>
			</div>

			<div class="c-test-kit-conducting-test__body">
				<ul class="c-test-kit-conducting-test__layout">
					<li class="c-test-kit-conducting-test__item">
						<?// START: Feature item ?>
						<div class="c-feature-item c-feature-item--row">
							<?// START: Icon ?>
							<object
								class="
									c-icon
									c-icon--object
									c-feature-item__icon
								"
								data="/upload/images/test-kit/test-kit-conducting-test-00.svg"
								type="image/svg+xml"
							></object>
							<?// END: Icon ?>

							<div class="c-feature-item__body">
								<p class="c-feature-item__text">
									Поместите тампон во флакон и размешайте содержимое.
								</p>
							</div>
						</div>
						<?// END: Feature item ?>
					</li>
					<li class="c-test-kit-conducting-test__item">
						<?// START: Feature item ?>
						<div class="c-feature-item c-feature-item--row">
							<?// START: Icon ?>
							<object
								class="
									c-icon
									c-icon--object
									c-feature-item__icon
								"
								data="/upload/images/test-kit/test-kit-conducting-test-01.svg"
								type="image/svg+xml"
							></object>
							<?// END: Icon ?>

							<div class="c-feature-item__body">
								<p class="c-feature-item__text">
									Прижмите кончик тампона к внутренней стенке для выдавливания из него жидкости. Извлеките из флакона и утилизируйте.
								</p>
							</div>
						</div>
						<?// END: Feature item ?>
					</li>
					<li class="c-test-kit-conducting-test__item">
						<?// START: Feature item ?>
						<div class="c-feature-item c-feature-item--row">
							<?// START: Icon ?>
							<object
								class="
									c-icon
									c-icon--object
									c-feature-item__icon
								"
								data="/upload/images/test-kit/test-kit-conducting-test-02.svg"
								type="image/svg+xml"
							></object>
							<?// END: Icon ?>

							<div class="c-feature-item__body">
								<p class="c-feature-item__text">
									Надежно закройте флакон, используя насадку с капельницей.
								</p>
							</div>
						</div>
						<?// END: Feature item ?>
					</li>
					<li class="c-test-kit-conducting-test__item">
						<?// START: Feature item ?>
						<div class="c-feature-item c-feature-item--row">
							<?// START: Icon ?>
							<object
								class="
									c-icon
									c-icon--object
									c-feature-item__icon
								"
								data="/upload/images/test-kit/test-kit-conducting-test-03.svg"
								type="image/svg+xml"
							></object>
							<?// END: Icon ?>

							<div class="c-feature-item__body">
								<p class="c-feature-item__text">
									Переверните флакон и надавите на его стенки. Выделите 3-4 капли в центр углубления для образцов
								</p>
							</div>
						</div>
						<?// END: Feature item ?>
					</li>
				</ul>
			</div>
		</div>
	</section>
	<?// END: Test kit conducting test ?>
	*/?>

	<?$testType = $arResult['PROPERTIES']['TEST_TYPE']['HL_DATA']['XML_ID']?>
	<?$determines = $arResult['PROPERTIES']['DETERMINES']['HL_DATA']['XML_ID']?>
	<?$bio = $arResult['PROPERTIES']['BIOMATERIAL']['HL_DATA']['XML_ID']?>

	<?// Двойка включает режим, если у теста на антиген полоски только красные (нет черных)?>
	<?// @todo: наверное надо свйоство ввести или справочник для этой фигни ?>
	<?$testMod = $bio == 'saliva' || $arResult['ID'] == '111' ||  $arResult['ID'] == '85' ? '2' : ''?>
	
	<?if ($testType == 'express' && $determines == 'antigen'):?>
		<?$path = "lang/$lang/decrypt_ag.php"?>
		<?if (file_exists(__DIR__.'/'.$path)):?>
			<?include($path)?>
		<?endif?>
	<?endif?>

	<?if ($testType == 'express' && $determines == 'antibody'):?>
		<?$antibody = $arResult['PROPERTIES']['ANTIBODY']['VALUE_XML_ID']?>
		<?$path = "lang/$lang/decrypt_{$antibody}.php"?>
		<?if (file_exists(__DIR__.'/'.$path)):?>
			<?include($path)?>
		<?endif?>
	<?endif?>

	<?// START: Test kit video ?>
	<?if (!empty($arResult['PROPERTIES']['YOUTUBE']['VALUE'])):?>
		<div class="c-test-kit-video">
			<div class="o-container@lg c-test-kit-video__container">
				<div class="o-ratio o-ratio--16x9">
					<iframe
						src="<?=str_replace("https://www.youtube.com/watch?v=", "https://www.youtube.com/embed/", $arResult['PROPERTIES']['YOUTUBE']['VALUE'])?>"
						title="<?=$arResult['PROPERTIES']['YOUTUBE']['NAME']?>"
						frameborder="0"
						height="100%"
						width="100%"
						allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
						allowfullscreen
					></iframe>
				</div>
			</div>
		</div>
	<?endif?>
	<?// END: Test kit video ?>

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
							<?=GetMessage("MD_CLINICS_TEST")?>
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

										<a
											class="o-stretched-link c-partner-card__link"
											href="<?=$clinic['LINK']?>"
											target="_blank"
											rel="noopener noreferrer"
											title="<?=GetMessage("MD_CLINICS_TEST")?> <?=$clinic['NAME']?>"
											aria-label="<?=GetMessage("MD_CLINICS_TEST")?> <?=$clinic['NAME']?>"
										></a>
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

	<?// Выездное тестирование ?>
	<?$APPLICATION->IncludeComponent(
        "bitrix:main.include",
        ".default",
        array(
            "COMPONENT_TEMPLATE" => ".default",
            "AREA_FILE_SHOW" => "file",
            "PATH" => "/include/banner_testing.php",
            "EDIT_TEMPLATE" => ""
        ),
        false
    );?>

	<?// START: Test kit buy ?>
	<? /* <div class="c-test-kit-buy c-test-kit-page__buy">
		<div class="o-container c-test-kit-buy__container">
			<div class="c-test-kit-buy__layout">
				<object
					class="c-icon c-icon__object c-test-kit-buy__icon"
					data="/upload/images/icon/multicolor/plus.svg"
					type="image/svg+xml"
				></object>

				<p class="c-test-kit-buy__text">
					Купить тесты для личного
					использования вы можете одним кликом
					на сайте ЕАПТЕКА
				</p>

				<?// START: Button ?>
				<a
					class="
						c-btn
						c-btn--kind-primary
						c-btn--size-lg
						c-test-kit-buy__action
					"
					href="#"
				>
					<span class="c-btn__overlay"></span>
					<span class="c-btn__content">
						Перейти в магазин
					</span>
				</a>
				<?// END: Button ?>
			</div>
		</div>
	</div> */ ?>
	<?// END: Test kit buy ?>
</main>

<?if ($arResult['REGDOCS']):?>
	<?$this->SetViewTarget('photoSwipe');?>
	<!-- Root element of PhotoSwipe. Must have class pswp. -->
		<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

			<!-- Background of PhotoSwipe.
				It's a separate element as animating opacity is faster than rgba(). -->
			<div class="pswp__bg"></div>

			<!-- Slides wrapper with overflow:hidden. -->
			<div class="pswp__scroll-wrap">

				<!-- Container that holds slides.
					PhotoSwipe keeps only 3 of them in the DOM to save memory.
					Don't modify these 3 pswp__item elements, data is added later on. -->
				<div class="pswp__container">
					<div class="pswp__item"></div>
					<div class="pswp__item"></div>
					<div class="pswp__item"></div>
				</div>

				<!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
				<div class="pswp__ui pswp__ui--hidden">

					<div class="pswp__top-bar">

						<!--  Controls are self-explanatory. Order can be changed. -->

						<div class="pswp__counter"></div>

						<button class="pswp__button pswp__button--close" title="Закрыть (Esc)"></button>

						<button class="pswp__button pswp__button--share" title="Поделиться"></button>

						<button class="pswp__button pswp__button--fs" title="Развернуть во весь экран"></button>

						<button class="pswp__button pswp__button--zoom" title="Увеличить/Уменьшить"></button>

						<!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR -->
						<!-- element will get class pswp__preloader--active when preloader is running -->
						<div class="pswp__preloader">
							<div class="pswp__preloader__icn">
							<div class="pswp__preloader__cut">
								<div class="pswp__preloader__donut"></div>
							</div>
							</div>
						</div>
					</div>

					<div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
						<div class="pswp__share-tooltip"></div>
					</div>

					<button class="pswp__button pswp__button--arrow--left" title="Предыдущий (стрелка влево)">
					</button>

					<button class="pswp__button pswp__button--arrow--right" title="Следующий (стрелка вправо)">
					</button>

					<div class="pswp__caption">
						<div class="pswp__caption__center"></div>
					</div>

				</div>

			</div>

		</div>
	<?$this->EndViewTarget();?>

	<script>
		var photoSwipeShow = function() {
			var pswpElement = document.querySelectorAll('.pswp')[0];

			// build items array
			var items = [
				<?foreach($arResult['REGDOCS'] as $regdoc):?>
					{
						src: '<?=$regdoc['SRC']?>',
						w: <?=$regdoc['WIDTH']?>,
						h: <?=$regdoc['HEIGHT']?>
					},
				<?endforeach?>
			];

			// define options (if needed)
			var options = {
				bgOpacity: 0.96,
				history: false,
				shareEl: false,
				showHideOpacity: true

			};

			var gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
			gallery.init();
		};

		document.addEventListener("DOMContentLoaded", function() {
			document.querySelector('.js-photoswipe-show-regdocs').onclick = photoSwipeShow;
		})
	</script>
<?endif?>

<?//apre($arResult,'result')?>
