<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Комплексные решения
для здравоохранения");
$APPLICATION->SetPageProperty("title","«Авивир» — Инновационные решения для комплексных проектов в здравоохранении");
$APPLICATION->SetPageProperty("description", "Компания «Авивир» — это исследовательские, производственные и инвестиционные разработки в области медицинских изделий и инновационной фармацевтики.");
?>
<style>
	.c-app-header__layout--video-player {
		row-gap: 6.25rem !important;
	}

	.c-app-header--density-compact {
    	--app-header-padding-y: 4.25rem;
	}
	.o-bg-holder--video-block:after {
		content: '';
		position: absolute;
		top: 0;
		width: 100%;
		height: 100%;
		background-color: rgba(16, 36, 47, 0.5);
		background-blend-mode: lighten;
	}

	.o-bg-holder--video-block:before {
		content: '';
		position: absolute;
		width: 100%;
		height: 100%;
		top: 0;
		opacity: 0.7;
		background: linear-gradient(0deg, #5AD8A9, #5AD8A9);

	}
	.o-bg-holder__decoration {
		position: relative;
		width: 100%;
		height: 100%;
		z-index: 100;
	}
	.o-bg-holder__decoration:after {
		content: '';
		position: absolute;
		top: 0;
		background-image: url('/upload/images/video-player/sphare-background.png');
		width: 100%;
		height: 100%;
		background-position: bottom;
	}

	.o-bg-holder__decoration:before {
		content: '';
		position: absolute;
		top: 0;
		background-image: url('/upload/images/video-player/grid-background.png');
		width: 100%;
		height: 100%;
		background-position: left center;
	}
	.c-app-header__media--video-block {
		display: flex;
		justify-content: center;
	}

	.c-icon--size-lg--play {
		font-size: 10.75rem;
   	 	height: 3.81rem;
    	width: 3.5rem;
	}

	.c-video-player__body {
		height: 100%;
	}

	.c-video-block__body {
		background-color: #FFFFFF;
		height: 185px;
		width: 100%;
		border-radius: 1rem;
		overflow: hidden;
		box-shadow: 0px 10px 40px 0px rgba(90, 216, 169, 1);
	}

	.c-video-block__layout {
		width: 100%;
    	height: 100%;
		padding: 1rem;
	}

	.c-video-player {
		background: rgba(90, 216, 169, 0.7);
	}

	.c-video-player__img--placeholder {
		width: 100%;
		height: 100%;
		object-fit: cover;
	}
	.btn__content--icon {
		width: 2rem;
		height: 2rem;
		background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg class='c-icon c-icon--size-lg c-icon--svg' viewBox='0 0 34 34' fill='none' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='M33 1L0.999894 33.0001' stroke='white' stroke-width='2' stroke-linecap='round'/%3e%3cpath d='M1 1L33.0001 33.0001' stroke='white' stroke-width='2' stroke-linecap='round'/%3e%3c/svg%3e");
	}

	@media (min-width: 75em) {
		.c-video-block__body  {
			height: 738px;
		}
		.c-video-block__layout {
			width: 100%;
			height: 100%;
			padding-top: 3rem;
			padding-bottom: 3rem;
			padding-left: calc((100vw - 84rem) / 2 + 0.5rem);
    		padding-right: calc((100vw - 84rem) / 2 + 0.5rem);
		}

		.c-video-player__container {
			padding-top: 2rem;
		}

		.c-icon--size-lg--play {
			font-size: 10.75rem;
			height: 5.81rem;
			width: 5.5rem;
		}
		.o-bg-holder--video-block:after {
			content: '';
			position: absolute;
			top: 7%;
			background-image: url('/upload/images/video-player/mask-background.png');
			background-position: center;
			background-size: cover;
			width: 100%;
			height: 100%;
			mix-blend-mode: multiply;
		}
		.c-btn--video-block {
			margin-right: 7rem;
		}
	}

	#main-video-player {
		width: 100%;
		height: 100%;
	}

</style>

<?// START: App header ?>
<header class="c-app-header c-app-header--density-compact c-app-header--fullscreen c-app-header--has-media t-dark u-bg-secondary-darken-3">

	<div class="o-bg-holder o-bg-holder--video-block">
		<div class="o-bg-holder__decoration"></div>
		<video src="/upload/videos/avivir-video/avivir-video-looped.mp4" width="100%" height="100%"
			class="o-bg-holder__video"
			id="bg-video-player"
			type="video/mp4"
			autoplay
			loop
			muted>
		</video>
	</div>

	<div class="o-container@lg c-app-header__container">
		<div class="c-app-header__layout c-app-header__layout--video-player">
			<div class="c-app-header__media c-app-header__media--video-block">
				<a href="#video-player"  class="c-btn c-btn--kind-plain-primary c-icon--size-lg--extra c-btn-icon c-btn--video-block " data-play>
					<span class="c-btn__overlay"></span>
					<span class="c-btn__content">
						<svg class="c-icon c-icon--size-lg--play"  width="94" height="99" viewBox="0 0 94 99" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M91 49.5L3 3V96L91 49.5Z" stroke="white" stroke-width="6" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</span>
				</a>
			</div>

			<div class="c-app-header__body">
				<h1 class="c-app-header__title"><? $APPLICATION->ShowTitle(true); ?></h1>

				<p class="c-app-header__lead">
				Специализируемся на исследованиях, разработке, производстве лекарственных средств, лабораторного оборудования и медицинской техники
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
		<?// START: Video Player ?>
		<section class="c-app-section c-app-section--density-default c-video-player" >
			<div class="o-container@lg c-video-player__container" id="video-player">
				<div class="c-video-block__body">
					<video src="/upload/videos/avivir-video/avivir-video.mp4" 
						width="100%" 
						height="100%"
						class="mejs__player"
						id="main-video-player"
						type="video/mp4"
						poster="/upload/images/video-player/video-avivir-placeholder.jpeg" 
						data-mejsoptions='{"pluginPath": "/path/to/shims/", "alwaysShowControls": "true" }'>
					</video>
				</div>
			</div>
		</section>
		<?// END: Video Player ?>
	</div>
</main>
<?// END: Main ?>



<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
