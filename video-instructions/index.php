<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Видео-инструкции тестов - «Авивир»");
$APPLICATION->SetTitle("Видео-инструкции тестов");
?>

<style>
	.c-app-header__media {
		width: 60%;
	}

	@media (min-width: 62em) {
		.c-app-header__media {
			width: 100%;
		}
	}
</style>

<?// START: App header ?>
<header class="c-app-header c-app-header--density-compact c-app-header--fullscreen c-app-header--has-media t-light">
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
				<picture class="c-picture o-ratio o-ratio--1x1">
					<img
						class="c-picture__img c-picture__img--contain"
						src="/upload/images/renders/render-test.png"
						alt="Видео-инструкции тестов"
					>
				</picture>
				<? // END: Picture ?>
			</div>

			<div class="c-app-header__body">
				<h1 class="c-app-header__title">
					<?=$APPLICATION->ShowTitle(false);?>
				</h1>

				<p class="c-app-header__lead">
					Выможете ознакомиться с видео-инструкциями тестов записанными компанией «Авивир» по ссылкам ниже
				</p>

				<div class="c-app-header__btn-group">
					<a class="c-btn c-btn--kind-primary c-btn--size-xl c-app-header__btn" href="https://www.youtube.com/watch?v=jXX9NcNN3Yw" target="_blank" rel="nofollow">
						<span class="c-btn__overlay"></span>
						<span class="c-btn__content">
							Видео-инструкция Gmate
						</span>
					</a>

					<a class="c-btn c-btn--kind-primary c-btn--size-xl c-app-header__btn" href="https://www.youtube.com/watch?v=YPdsJWukBNA" target="_blank" rel="nofollow">
						<span class="c-btn__overlay"></span>
						<span class="c-btn__content">
							Видео-инструкция Saliva
						</span>
					</a>
				</div>
			</div>
		</div>
	</div>
</header>
<?// END: App header ?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
