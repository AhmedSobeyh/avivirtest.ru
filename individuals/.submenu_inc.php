<?
$curPage = $APPLICATION->GetCurPage();

$navList = [
	0 => [
		'CODE' => 'covid-stat',
		'NAME' => 'Статистика Covid-19',
		'URL' => '/individuals/covid-stat/'
	],
	1 => [
		'CODE' => 'vaccines',
		'NAME' => 'Обзор вакцин',
		'URL' => '/individuals/vaccines/'
	],
	2 => [
		'CODE' => 'testing-emergency2',
		'NAME' => 'Выездное тестирование',
		'URL' => '/services/testing-emergency/'
	],
	3 => [
		'CODE' => 'calculatedata',
		'NAME' => 'Вероятность госпитализации',
		'URL' => '/calculatedata/'
	],
	4 => [
		'CODE' => 'retail-distributors',
		'NAME' => 'Купить тесты COVID-19',
		'URL' => '/individuals/#retail-distributors'
	],
];
?>

<div class="c-app-bar-nav-dropdown-menu c-app-bar-nav__dropdown-menu">
	<div class="o-container@lg c-app-bar-nav-dropdown-menu__container">
		<div class="c-app-bar-nav-dropdown-menu__primary">
			<ul class="c-app-bar-dropdown-nav c-app-bar-nav-dropdown-menu__nav">

				<?foreach($navList as $key=>$item):?>
					<?
						if ($key !== 0) {
							$isActiveClass = mb_strpos($curPage, $item['URL']) === false ? '' : 'is-active';
						} else {
							$isActiveClass = mb_strpos($curPage, $item['URL']) === false
							&& mb_strpos($curPage, $navList[1]['URL']) !== false
							|| mb_strpos($curPage, $navList[2]['URL']) !== false
							|| mb_strpos($curPage, $navList[3]['URL']) !== false
							? '' : 'is-active';
						}
					?>

					<li class="c-app-bar-dropdown-nav__item <?= $isActiveClass ?>">
						<a
							class="c-app-bar-dropdown-nav__link"
							href="<?=$item['URL']?>"
							data-exo-toggle="appBarSecondaryNav"
							data-exo-target="#dropdown-menu-<?=$item['CODE']?>"
						>
							<?=$item['NAME']?>
						</a>
					</li>
				<?endforeach?>

			</ul>
		</div>

		<?
			$isActiveClass = mb_strpos($curPage, $navList[0]['URL']) === false
			&& mb_strpos($curPage, $navList[1]['URL']) !== false
			|| mb_strpos($curPage, $navList[2]['URL']) !== false
			|| mb_strpos($curPage, $navList[3]['URL']) !== false
			|| mb_strpos($curPage, $navList[4]['URL']) !== false
			? '' : 'is-active';
		?>

		<div
			class="c-app-bar-nav-dropdown-menu__secondary c-app-bar-nav-dropdown-menu__secondary--promo <?= $isActiveClass ?>"
			id="dropdown-menu-<?=$navList[0]['CODE']?>"
		>
			<div class="o-bg-holder c-app-bar-nav-dropdown-menu__bg-holder c-app-bar-nav-dropdown-menu__bg-holder--underlay"></div>
			<div
				class="o-bg-holder c-app-bar-nav-dropdown-menu__bg-holder"
				style="background-image: url(/upload/images/renders/render-molecule.png);"
			></div>
			<div class="c-app-bar-nav-dropdown-menu__layout">
				<div class="c-app-bar-nav-dropdown-menu__section">
					<span class="c-app-bar-nav-dropdown-menu__title">
						Статистика Covid-19
					</span>

					<span class="c-app-bar-nav-dropdown-menu__lead">
						Вы можете следить за динамикой новых случаев смерти от коронавируса в некоторых странах Западной Европы, США, Израиле и России.
					</span>

					<a
						class="c-btn c-btn--kind-primary c-btn--size-lg c-app-bar-nav-dropdown-menu__btn"
						href="<?= $navList[0]['URL'] ?>"
					>
						<span class="c-btn__overlay"></span>
						<span class="c-btn__content">
							Посмотреть статистику
						</span>
					</a>
				</div>
			</div>
		</div>

		<?
			$isActiveClass = mb_strpos($curPage, $navList[1]['URL']) === false ? '' : 'is-active';
		?>

		<div
			class="c-app-bar-nav-dropdown-menu__secondary c-app-bar-nav-dropdown-menu__secondary--promo <?= $isActiveClass ?>"
			id="dropdown-menu-<?=$navList[1]['CODE']?>"
		>
			<div class="o-bg-holder c-app-bar-nav-dropdown-menu__bg-holder c-app-bar-nav-dropdown-menu__bg-holder--underlay"></div>
			<div
				class="o-bg-holder c-app-bar-nav-dropdown-menu__bg-holder"
				style="background-image: url(/upload/images/renders/render-plus.png);"
			></div>
			<div class="c-app-bar-nav-dropdown-menu__layout">
				<div class="c-app-bar-nav-dropdown-menu__section">
					<span class="c-app-bar-nav-dropdown-menu__title">
						Обзор вакцин
					</span>

					<span class="c-app-bar-nav-dropdown-menu__lead">
						Подробная и актуальная информация по разрабатываемым и используемым вакцинам от COVID-19 как в России, так и за рубежом.
					</span>

					<ul class="c-app-bar-dropdown-nav c-app-bar-dropdown-nav--subnav c-app-bar-nav-dropdown-menu__nav">

						<li class="c-app-bar-dropdown-nav__item">
							<a
								class="c-app-bar-dropdown-nav__link"
								href="/individuals/vaccines/#vaccines-section-russian"
							>
								Российские вакцины
							</a>
						</li>
						<li class="c-app-bar-dropdown-nav__item">
							<a
								class="c-app-bar-dropdown-nav__link"
								href="/individuals/vaccines/#vaccines-section-other"
							>
								Зарубежные вакцины
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>

		<?
			$isActiveClass = mb_strpos($curPage, $navList[2]['URL']) === false ? '' : 'is-active';
		?>

		<div
			class="c-app-bar-nav-dropdown-menu__secondary c-app-bar-nav-dropdown-menu__secondary--promo <?= $isActiveClass ?>"
			id="dropdown-menu-<?=$navList[2]['CODE']?>"
		>
			<div class="o-bg-holder c-app-bar-nav-dropdown-menu__bg-holder c-app-bar-nav-dropdown-menu__bg-holder--underlay"></div>
			<div
				class="o-bg-holder c-app-bar-nav-dropdown-menu__bg-holder"
				style="background-image: url(/upload/images/renders/render-map-marker.png);"
			></div>
			<div class="c-app-bar-nav-dropdown-menu__layout">
				<div class="c-app-bar-nav-dropdown-menu__section">
					<span class="c-app-bar-nav-dropdown-menu__title">
						Выездное тестирование
					</span>

					<span class="c-app-bar-nav-dropdown-menu__lead">
					   В любой момент вы можете заказать выездное тестирование на COVID-19 с помощью наших экспресс-тестов у наших коллег в H-Сlinic.
					</span>

					<a
						class="c-btn c-btn--kind-primary c-btn--size-lg c-app-bar-nav-dropdown-menu__btn"
						href="<?= $navList[2]['URL'] ?>"
					>
						<span class="c-btn__overlay"></span>
						<span class="c-btn__content">
							Перейти в раздел
						</span>
					</a>
				</div>
			</div>
		</div>

		<?
			$isActiveClass = mb_strpos($curPage, $navList[3]['URL']) === false ? '' : 'is-active';
		?>

		<div
			class="c-app-bar-nav-dropdown-menu__secondary c-app-bar-nav-dropdown-menu__secondary--promo <?= $isActiveClass ?>"
			id="dropdown-menu-<?=$navList[3]['CODE']?>"
		>
			<div class="o-bg-holder c-app-bar-nav-dropdown-menu__bg-holder c-app-bar-nav-dropdown-menu__bg-holder--underlay"></div>
			<div
				class="o-bg-holder c-app-bar-nav-dropdown-menu__bg-holder"
				style="background-image: url(/upload/images/renders/render-user-friends.png);"
			></div>
			<div class="c-app-bar-nav-dropdown-menu__layout">
				<div class="c-app-bar-nav-dropdown-menu__section">
					<span class="c-app-bar-nav-dropdown-menu__title">
						Вероятность госпитализации
					</span>

					<span class="c-app-bar-nav-dropdown-menu__lead">
					   Узнайте вероятность госпитализации при заболевании COVID-19 в специальном калькуляторе от Avivir.
					</span>

					<a
						class="c-btn c-btn--kind-primary c-btn--size-lg c-app-bar-nav-dropdown-menu__btn"
						href="<?= $navList[3]['URL'] ?>#calculatedata"
					>
						<span class="c-btn__overlay"></span>
						<span class="c-btn__content">
							Рассчитать вероятность
						</span>
					</a>
				</div>
			</div>
		</div>

		<?
			$isActiveClass = mb_strpos($curPage, $navList[4]['URL']) === false ? '' : 'is-active';
		?>

		<div
			class="c-app-bar-nav-dropdown-menu__secondary c-app-bar-nav-dropdown-menu__secondary--promo <?= $isActiveClass ?>"
			id="dropdown-menu-<?=$navList[4]['CODE']?>"
		>
			<div class="o-bg-holder c-app-bar-nav-dropdown-menu__bg-holder c-app-bar-nav-dropdown-menu__bg-holder--underlay"></div>
			<div
				class="o-bg-holder c-app-bar-nav-dropdown-menu__bg-holder"
				style="background-image: url(/upload/images/renders/render-test.png);"
			></div>
			<div class="c-app-bar-nav-dropdown-menu__layout">
				<div class="c-app-bar-nav-dropdown-menu__section">
					<span class="c-app-bar-nav-dropdown-menu__title">
						Купить тесты COVID-19
					</span>

					<span class="c-app-bar-nav-dropdown-menu__lead">
						Вы можете приобрести тесты COVID-19 для личного использования у наших розничных партнёров.
					</span>

					<a
						class="c-btn c-btn--kind-primary c-btn--size-lg c-app-bar-nav-dropdown-menu__btn"
						href="<?= $navList[4]['URL'] ?>"
					>
						<span class="c-btn__overlay"></span>
						<span class="c-btn__content">
							Посмотреть магазины
						</span>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
