<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Инновационные решения для комплексных проектов в здравоохранении");
$APPLICATION->SetPageProperty("title","«Авивир» — Инновационные решения для комплексных проектов в здравоохранении");
$APPLICATION->SetPageProperty("description", "Компания «Авивир» — это исследовательские, производственные и инвестиционные разработки в области медицинских изделий и инновационной фармацевтики.");
?>

<?// START: App header ?>
<header class="c-app-header c-app-header--density-compact c-app-header--fullscreen c-app-header--has-media t-dark u-bg-secondary-darken-3">
	<div
		class="o-bg-holder"
		style="background-image: url(/upload/images/main/main-page-header-bg-00.jpg); opacity: 0.1;"
	></div>

	<div class="o-container@lg c-app-header__container">
		<div class="c-app-header__layout">
			<div class="c-app-header__media">
				<div
					class="
						o-bg-holder
						c-main-page-header__media-bg-holder
					"
					style="
						background-image: url(/upload/images/main/main-shape-00.png);
					"
				></div>

				<? /* START: Picture */ ?>
				<picture class="c-picture o-ratio o-ratio--1x1">
					<img
						class="c-picture__img c-picture__img--contain"
						src="/upload/images/main/main-page-header-media-00.png"
						alt="<?$APPLICATION->ShowTitle()?>"
					/>
				</picture>
				<? /* END: Picture */ ?>
			</div>

			<div class="c-app-header__body">
				<h1 class="c-app-header__title"><? $APPLICATION->ShowTitle(true); ?></h1>

				<p class="c-app-header__lead">
					Исследовательские, производственные и инвестиционные разработки в области медицинских изделий и инновационной фармацевтики
				</p>

				<div class="c-app-header__btn-group">
					<?// START: Button ?>
					<a
						class="
							c-btn
							c-btn--kind-primary
							c-btn--size-lg
							c-app-header__btn
						"
						href="/products/"
					>
						<span class="c-btn__overlay"></span>
						<span class="c-btn__content">
							Перейти в каталог
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

		<?$APPLICATION->IncludeComponent(
			"bitrix:main.include","",
			Array(
				"AREA_FILE_SHOW" => "file",
				"PATH" => "/include/main-page/.sale_timer.php",
				"EDIT_TEMPLATE" => ""
			)
		);?>

		
		
		<?$APPLICATION->IncludeComponent(
			"mediahead:banners-products", 
			"", 
			array(	
			),
			false
		);?>

				
	</div>
</main>
<?// END: Main ?>



<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
