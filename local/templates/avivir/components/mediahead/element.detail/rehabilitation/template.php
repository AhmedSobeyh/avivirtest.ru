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

<?// START: App header ?>
<header class="c-app-header c-app-header--density-compact c-app-header--fullscreen c-app-header--has-media c-rehabilitation-app-header">
	<div
		class="o-bg-holder c-rehabilitation-app-header__bg-holder"
		style="background-image: url(/upload/images/backgrounds/bg-hexagon-color-primary-00.svg);"
	></div>

	<div class="o-container@lg c-app-header__container">
		<?$APPLICATION->IncludeComponent(
			"bitrix:breadcrumb",
			"breadcrumb-scrollable",
			array(
				"COMPONENT_TEMPLATE" => "breadcrumb-scrollable",
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

				<? /* START: Picture */ ?>
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
				<? /* END: Picture */ ?>
			</div>

			<div class="c-app-header__body">
				<h1 class="c-app-header__title">
					<? $APPLICATION->ShowTitle(true); ?>
				</h1>

				<? if ($arResult['PREVIEW_TEXT']): ?>
					<p class="c-app-header__lead">
						<?=$arResult['PREVIEW_TEXT']?>
					</p>
				<? endif ?>

				<div class="c-app-header__btn-group">
					<?// START: Button ?>
					<a
						class="
							c-btn
							c-btn--kind-primary
							c-btn--size-lg
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
								c-btn--size-lg
								c-page-header__btn
							"
						>
							<span class="c-btn__overlay"></span>

							<span class="c-btn__content">
								<?=GetMessage('MD_DOWNLOAD_PRESENTATION')?>
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

<main class="o-main">
	<div class="o-main__wrap">
		<?// START: Rehabilitation banner ?>
		<section
			class="
				c-dynamic-banner
				c-dynamic-banner--size-lg
				c-dynamic-banner--density-default
				c-dynamic-banner--split@lg
				c-dynamic-banner--center-body@lg
				c-dynamic-banner--displaced@xl
				u-bg-primary-lighten-4
			"
		>
			<div class="o-container@lg c-dynamic-banner__container">
				<div class="c-dynamic-banner__layout">
					<div class="c-dynamic-banner__media c-dynamic-banner__media--align-end">
						<picture class="c-picture c-dynamic-banner__picture">
							<img
								class="c-picture__img c-picture__img--contain c-dynamic-banner__img"
								src="/upload/images/dynamic-banners/dynamic-banner-00.svg"
								alt="Необходимость реабилитации после COVID-19"
							>
						</picture>
					</div>
					<div class="c-dynamic-banner__body">
						<h2 class="c-dynamic-banner__title">
							Необходимость реабилитации после COVID-19
						</h2>

						<p class="c-dynamic-banner__text">
							Вопрос реабилитации стоит на повестке дня у специалистов всего мира. Сегодня  есть исследования, которые говорят о том, что все, кто переболел  коронавирусом, нуждаются в реабилитации, потому что все они получают  выраженное снижение функционирования органов и систем.
						</p>
					</div>
				</div>
			</div>
		</section>
		<?// END: Rehabilitation banner ?>

		<?// START: Rehabilitation feature list ?>
		<section class="c-app-section c-app-section--density-comfortable c-rehabilitation-feature-list">
			<div
				class="o-bg-holder c-rehabilitation-feature-list__bg-holder"
				style="background-image: url(/upload/images/backgrounds/bg-molecule-color-primary-00.png);"
			></div>

			<div class="c-app-section__header">
				<div class="o-container@lg">
					<h2 class="c-app-section__title">
						Особенности аппарата
					</h2>
				</div>
			</div>

			<div class="c-app-section__body">
				<div class="o-container@lg">
					<ul class="c-feature-list">
						<li class="c-feature-list__item">
							<div class="
								c-feature-item
								c-feature-item--row
							">
								<object
									class="c-icon c-icon--object c-feature-item__icon"
									data="/upload/images/icons/multicolor/icon-stethoscope.svg" type="image/svg+xml"
								></object>

								<div class="c-feature-item__body">
									<p class="c-feature-item__text">
										Автоматический расчет индивидуальных  параметров процедуры
									</p>
								</div>
							</div>
						</li>
						<li class="c-feature-list__item">
							<div class="
								c-feature-item
								c-feature-item--row
							">
								<object
									class="c-icon c-icon--object c-feature-item__icon"
									data="/upload/images/icons/multicolor/icon-shield.svg" type="image/svg+xml"
								></object>

								<div class="c-feature-item__body">
									<p class="c-feature-item__text">
										Многоуровневая система  безопасности
									</p>
								</div>
							</div>
						</li>
						<li class="c-feature-list__item">
							<div class="
								c-feature-item
								c-feature-item--row
							">
								<object
									class="c-icon c-icon--object c-feature-item__icon"
									data="/upload/images/icons/multicolor/icon-pulse-heart.svg" type="image/svg+xml"
								></object>

								<div class="c-feature-item__body">
									<p class="c-feature-item__text">
										Оперативный медицинский  контроль за жизненно  важными показателями  организма
									</p>
								</div>
							</div>
						</li>
						<li class="c-feature-list__item">
							<div class="
								c-feature-item
								c-feature-item--row
							">
								<object
									class="c-icon c-icon--object c-feature-item__icon"
									data="/upload/images/icons/multicolor/icon-reg-docs.svg" type="image/svg+xml"
								></object>

								<div class="c-feature-item__body">
									<p class="c-feature-item__text">
										Зарегистрирован в МЗ РФ  (РЗН 2014/1486 от  30.04.2019)
									</p>
								</div>
							</div>
						</li>
						<li class="c-feature-list__item">
							<div class="
								c-feature-item
								c-feature-item--row
							">
								<object
									class="c-icon c-icon--object c-feature-item__icon"
									data="/upload/images/icons/multicolor/icon-web-globus.svg" type="image/svg+xml"
								></object>

								<div class="c-feature-item__body">
									<p class="c-feature-item__text">
										Не имеет прямых российских аналогов
									</p>
								</div>
							</div>
						</li>
						<li class="c-feature-list__item">
							<div class="
								c-feature-item
								c-feature-item--row
							">
								<object
									class="c-icon c-icon--object c-feature-item__icon"
									data="/upload/images/icons/multicolor/icon-map-points-globus.svg" type="image/svg+xml"
								></object>

								<div class="c-feature-item__body">
									<p class="c-feature-item__text">
										Производится в Германии  согласно требованиям  европейской медицинской  директивы MDD 93/42/EEC
									</p>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</section>
		<?// END: Rehabilitation feature list ?>

		<?// START: Rehabilitation clinical effects ?>
		<section
			class="
				c-dynamic-banner
				c-dynamic-banner--media-fullsize
				c-dynamic-banner--size-default
				c-dynamic-banner--density-compact
				c-dynamic-banner--split-reverse@lg
				c-dynamic-banner--center-body@lg
				c-dynamic-banner--container-left@lg
				u-bg-grey-lighten-4
				с-rehabilitation-clinical-effects
			"
		>
			<div class="o-container-fluid c-dynamic-banner__container">
				<div class="c-dynamic-banner__layout">
					<div class="c-dynamic-banner__media">
						<div
							class="o-bg-holder с-rehabilitation-clinical-effects__bg-holder"
							style="background-image: url(/upload/images/backgrounds/bg-hexagon-color-primary-01.svg);"
						></div>

						<picture class="c-picture c-dynamic-banner__picture">
							<img
								class="c-picture__img c-picture__img--cover c-dynamic-banner__img"
								src="/upload/images/dynamic-banners/dynamic-banner-01.jpg"
								alt="Клинические эффекты ReOxy-терапии"
							>
						</picture>
					</div>

					<div class="c-dynamic-banner__body">
						<h2 class="c-dynamic-banner__title">
							Клинические эффекты ReOxy-терапии
						</h2>

						<div class="c-dynamic-banner__content s-dynamic-banner-content">
							<ul class="o-list o-list--checkmark-circle">
								<li class="o-list__item">
									Уменьшение  одышки при  физической  нагрузке
								</li>
								<li class="o-list__item">
									Восстановление  легочных функций
								</li>
								<li class="o-list__item">
									Профилактика  инфаркта и  инсульта
								</li>
								<li class="o-list__item">
									Восстановление  утраченной  физической  работоспособност
								</li>
								<li class="o-list__item">
									Повышение  выносливости
								</li>
								<li class="o-list__item">
									Профилактика  осложнений после  COVID-19
								</li>
							</ul>
						</div>

						<div class="c-dynamic-banner__btn-group">
							<?// START: Button ?>
							<a
								class="
									c-btn
									c-btn--kind-primary
									c-btn--size-lg
									c-dynamic-banner__btn
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
						</div>
					</div>
				</div>
			</div>
		</section>
		<?// END: Rehabilitation clinical effects ?>

		<?// START: Rehabilitation feature list ?>
		<section class="c-app-section c-app-section--density-comfortable c-rehabilitation-clinical-researches">
			<div
				class="o-bg-holder c-rehabilitation-clinical-researches__bg-holder"
				style="background-image: url(/upload/images/backgrounds/bg-molecule-color-primary-00.png);"
			></div>

			<div class="c-app-section__header">
				<div class="o-container@lg">
					<h2 class="c-app-section__title">
						Клинические исследования
					</h2>
				</div>
			</div>

			<div class="c-app-section__body">
				<div class="o-container@lg">
					<div class="c-data-table c-data-table--striped c-rehabilitation-clinical-researches__data-table">
						<div class="c-data-table__wrapper">
							<table>
								<thead>
									<tr>
										<th scope="col">Официальное наименование исследования</th>
										<th scope="col">Клиническая база</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											ИГГТ в коррекции индивидуальных компонентов  метаболического синдрома
										</td>
										<td>
											ЦНИИ гастроэнтерологии, ПГМУ  им. Сеченова
										</td>
									</tr>
									<tr>
										<td>
											Адаптация к интервальной гипоксии-гипероксии в реабилитации  пациентов с ИБС
										</td>
										<td>
											Московский областной  кардиологический центр
										</td>
									</tr>
									<tr>
										<td>
											Применение метода ИГГТ у пациентов с ИБС
										</td>
										<td>
											Первый МГМУ им. И.М. Сеченова
										</td>
									</tr>
									<tr>
										<td>
											Эффективность и безопасность метода ИГГТ на основе обратной  связи в комплексном лечении больных с зависимостью от  алкоголя
										</td>
										<td>
											ФМИЦ психиатрии и наркологии  Минздрава РФ
										</td>
									</tr>
									<tr>
										<td>
											Оценка безопасности и эффективности применения ИГГТ в  ранней реабилитации пациентов с острыми нарушениями  мозгового кровообращения
										</td>
										<td>
											НИИ цереброваскулярной  патологии и инсульта РНИМУ им. Н.И. Пирогова
										</td>
									</tr>
									<tr>
										<td>
											Применение аппарата ReOxy для гипоксического  прекондиционирования на этапе предоперационной подготовки  кардиологических пациентов
										</td>
										<td>
											Первый МГМУ им. И.М. Сеченова
										</td>
									</tr>
								</tbody>

							</table>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?// END: Rehabilitation feature list ?>

		<?// START: Rehabilitation special ?>
		<section
			class="
				c-dynamic-banner
				c-dynamic-banner--size-default
				c-dynamic-banner--density-comfortable
				c-dynamic-banner--split-reverse@lg
				c-dynamic-banner--center-body@lg
				u-bg-grey-lighten-4
				с-rehabilitation-special
			"
		>
			<div
				class="o-bg-holder с-rehabilitation-special__bg-holder с-rehabilitation-special__bg-holder--hexagon"
				style="background-image: url(/upload/images/backgrounds/bg-hexagon-color-primary-01.svg);"
			></div>

			<div class="o-container@lg c-dynamic-banner__container">
				<div class="c-dynamic-banner__layout">
					<div class="c-dynamic-banner__media c-dynamic-banner__media--align-end">
						<div
							class="o-bg-holder с-rehabilitation-special__bg-holder с-rehabilitation-special__bg-holder--circle"
							style="background-image: url(/upload/images/backgrounds/bg-circle-gradient-primary-01.svg);"
						></div>

						<picture class="c-picture c-dynamic-banner__picture">
							<img
								class="c-picture__img c-picture__img--contain c-dynamic-banner__img"
								src="/upload/images/dynamic-banners/dynamic-banner-02.png"
								alt="РЕЖИМ «ГИПОКСИЯ-ГИПЕРОКСИЯ»"
							>
						</picture>
					</div>

					<div class="c-dynamic-banner__body">
						<h2 class="c-dynamic-banner__title">
							РЕЖИМ «ГИПОКСИЯ-ГИПЕРОКСИЯ»
						</h2>

						<div class="c-dynamic-banner__content s-dynamic-banner-content">
							<p>
								В отличие от других методов, режим «гипоксия-гипероксия» не борется с отдельными заболеваниями, а обеспечивает надежность всего организма за счет увеличения его функциональных резервов, в основе  которых лежит общая неспецифическая резистентность к  широкому спектру повреждающих факторов.
							</p>

							<ul class="o-list o-list--checkmark-circle">
								<li class="o-list__item">
									Усиливает эффект от процедуры без углубления гипоксии
								</li>
								<li class="o-list__item">
									Сокращает число побочных эффектов
								</li>
								<li class="o-list__item">
									Сокращает количества необходимых процедур
								</li>
							</ul>
						</div>

						<div class="c-dynamic-banner__btn-group">
							<?// START: Button ?>
							<a
								class="
									c-btn
									c-btn--kind-primary
									c-btn--size-lg
									c-dynamic-banner__btn
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
						</div>
					</div>
				</div>
			</div>
		</section>
		<?// END: Rehabilitation special ?>
	</div>
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
