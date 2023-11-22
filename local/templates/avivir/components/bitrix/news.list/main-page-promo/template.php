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

//apre($arResult["ITEMS"]);
?>

<?// START: Main page promo ?>
<section class="c-main-page-promo js-main-page-parallax-table-input">
	<div class="c-parallax-scene c-main-page-promo__parallax js-main-page-parallax-table">
		<div class="c-parallax-scene__layer" data-depth="0.0"></div>

		<div class="c-parallax-scene__layer" data-depth="0.2">
			<div class="c-parallax-scene__table">
				<img class="c-parallax-scene__img" src="<?=SITE_TEMPLATE_PATH?>/assets/images/photo/photo-table-01.jpg" alt="Стол">
			</div>
		</div>

		<div class="c-parallax-scene__layer" data-depth="0.2">
			<a class="c-parallax-scene-book-stack c-parallax-scene__book-stack" class="/poeziya/">
				<div class="c-parallax-scene-book-stack__container">
					<div class="c-parallax-scene-book-stack__item c-parallax-scene-book-stack__item--left">
						<img class="c-parallax-scene__img" src="<?=SITE_TEMPLATE_PATH?>/assets/images/photo/photo-book-zemnoe-nebo-01.png" alt="Сборник - Земное небо">
					</div>
					<div class="c-parallax-scene-book-stack__item c-parallax-scene-book-stack__item--top">
						<img class="c-parallax-scene__img" src="<?=SITE_TEMPLATE_PATH?>/assets/images/photo/photo-book-faust-01.png" alt="Сборник - Письмо Катерине или прогулки с Фаустом">
					</div>
					<div class="c-parallax-scene-book-stack__item c-parallax-scene-book-stack__item--bottom">
						<img class="c-parallax-scene__img" src="<?=SITE_TEMPLATE_PATH?>/assets/images/photo/photo-book-kinematograf-01.png" alt="Сборник - Кинематограф">
					</div>
					<div class="c-parallax-scene-book-stack__item c-parallax-scene-book-stack__item--right">
						<img class="c-parallax-scene__img" src="<?=SITE_TEMPLATE_PATH?>/assets/images/photo/photo-book-dentakoito-01.png" alt="Сборник - День такой-то">
					</div>
				</div>
			</a>

			<div class="c-parallax-scene-description c-parallax-scene-description--book-stack">
				<span class="c-parallax-scene-description__icon"></span>
				<h2 class="c-parallax-scene-description__title">Поэзия</h2>
				<p class="c-parallax-scene-description__text u-ff-secondary">Текст для поэзии</p>
			</div>
		</div>

		<div class="c-parallax-scene__layer" data-depth="0.2">
			<a class="c-parallax-scene-photo-stack c-parallax-scene__photo-stack" href="/mediateka/foto/">
				<div class="c-parallax-scene-photo-stack__container">
					<div class="c-parallax-scene-photo-stack__item c-parallax-scene-photo-stack__item--left">
						<img class="c-parallax-scene__img" src="<?=SITE_TEMPLATE_PATH?>/assets/images/photo/photo-levitansky-family-01.png" alt="Сборник - Письмо Катерине или прогулки с Фаустом">
					</div>
					<div class="c-parallax-scene-photo-stack__item c-parallax-scene-photo-stack__item--left-center">
						<img class="c-parallax-scene__img" src="<?=SITE_TEMPLATE_PATH?>/assets/images/photo/photo-levitansky-family-02.png" alt="Сборник - Письмо Катерине или прогулки с Фаустом">
					</div>
					<div class="c-parallax-scene-photo-stack__item c-parallax-scene-photo-stack__item--right-center">
						<img class="c-parallax-scene__img" src="<?=SITE_TEMPLATE_PATH?>/assets/images/photo/photo-levitansky-family-03.png" alt="Сборник - Письмо Катерине или прогулки с Фаустом">
					</div>
					<div class="c-parallax-scene-photo-stack__item c-parallax-scene-photo-stack__item--right">
						<img class="c-parallax-scene__img" src="<?=SITE_TEMPLATE_PATH?>/assets/images/photo/photo-levitansky-family-04.png" alt="Сборник - Письмо Катерине или прогулки с Фаустом">
					</div>
					<div class="c-parallax-scene-photo-stack__item c-parallax-scene-photo-stack__item--camera">
						<img class="c-parallax-scene__img" src="<?=SITE_TEMPLATE_PATH?>/assets/images/photo/photo-camera-01.png" alt="Сборник - Письмо Катерине или прогулки с Фаустом">
					</div>
				</div>
			</a>

			<div class="c-parallax-scene-description c-parallax-scene-description--photo-stack">
				<span class="c-parallax-scene-description__icon"></span>
				<h2 class="c-parallax-scene-description__title">Фотогалерея</h2>
				<p class="c-parallax-scene-description__text u-ff-secondary">Галерея фотографий, предоставленых семьей Ю.Д. Левитанского</p>
			</div>
		</div>

		<div class="c-parallax-scene__layer" data-depth="0.2">
			<a class="c-parallax-scene-typewriter c-parallax-scene__typewriter" href="/pryamaya-rech/">
				<img class="c-parallax-scene__img" src="<?=SITE_TEMPLATE_PATH?>/assets/images/photo/photo-typewriter-01.png" alt="Typewriter">
			</a>

			<div class="c-parallax-scene-description c-parallax-scene-description--typewriter">
				<span class="c-parallax-scene-description__icon"></span>
				<h2 class="c-parallax-scene-description__title">Прямая речь</h2>
				<p class="c-parallax-scene-description__text u-ff-secondary">Текс для прямой речи</p>
			</div>
		</div>

		<div class="c-parallax-scene__layer" data-depth="0.2">
			<a class="c-parallax-scene-archive c-parallax-scene__archive" href="/mediateka/arkhivnye-dokumenty/">
				<!-- <img class="c-parallax-scene__img" src="<?=SITE_TEMPLATE_PATH?>/assets/images/photo/photo-archive-01.png" alt="Archive"> -->
				<img class="c-parallax-scene__img" src="<?=SITE_TEMPLATE_PATH?>/assets/images/photo/photo-archive-02.png" alt="Archive">
			</a>

			<div class="c-parallax-scene-description c-parallax-scene-description--archive">
				<span class="c-parallax-scene-description__icon"></span>
				<h2 class="c-parallax-scene-description__title">Архивные документы</h2>
				<p class="c-parallax-scene-description__text u-ff-secondary">Текс для архивных документов</p>
			</div>
		</div>

		<div class="c-parallax-scene__layer" data-depth="0.2">
			<a class="c-parallax-scene-video c-parallax-scene__video" href="/mediateka/video/">
				<img class="c-parallax-scene__img" src="<?=SITE_TEMPLATE_PATH?>/assets/images/photo/photo-video-01.png" alt="Video">
			</a>

			<div class="c-parallax-scene-description c-parallax-scene-description--video">
				<span class="c-parallax-scene-description__icon"></span>
				<h2 class="c-parallax-scene-description__title">Видеотека</h2>
				<p class="c-parallax-scene-description__text u-ff-secondary">Текст для видеотеки</p>
			</div>
		</div>

		<div class="c-parallax-scene__layer" data-depth="0.2">
			<a class="c-parallax-scene-calendar c-parallax-scene__calendar" href="/sobytiya/">
				<img class="c-parallax-scene__img" src="<?=SITE_TEMPLATE_PATH?>/assets/images/photo/photo-calendar-01.png" alt="Table">
			</a>

			<div class="c-parallax-scene-description c-parallax-scene-description--calendar">
				<span class="c-parallax-scene-description__icon"></span>
				<h2 class="c-parallax-scene-description__title">События</h2>
				<p class="c-parallax-scene-description__text u-ff-secondary">Текст для событий</p>
			</div>
		</div>

		<div class="c-parallax-scene__layer" data-depth="0.2">
			<div class="c-parallax-scene-poetry c-parallax-scene__poetry">
				<img class="c-parallax-scene__img" src="<?=SITE_TEMPLATE_PATH?>/assets/images/photo/photo-poetry-01.png" alt="Archive">
				
				<?if( $arResult['PROZE_NAME'] ):?>
					
					<div class="c-parallax-scene-poetry__content">
					<h3 class="c-parallax-scene-poetry__title"><?=$arResult['PROZE_NAME']?></h3>
					<p class="c-parallax-scene-poetry__text js-typing-poetry">
						<?foreach ( $arResult['PROZE_TEXT'] as $arText ) :?>
							<span><?=$arText?></span>
						<?endforeach?>
					</p>
				</div>
					
				<?else:?>
				
					<div class="c-parallax-scene-poetry__content">
						<h3 class="c-parallax-scene-poetry__title">Что я знаю про стороны света?..</h3>
						<p class="c-parallax-scene-poetry__text js-typing-poetry">
							<span>Что я знаю про стороны света?</span>
							<span>Вот опять, с наступлением дня,</span>
							<span>недоступные стороны света,</span>
							<span>как леса, обступают меня.</span>
							<span>Нет, не стороны те</span>
							<span>и не страны,</span>
							<span>где дожди не такие, как тут,</span>
							<span>где деревья причудливо странны</span>
							<span>и цветы по-другому цветут,</span>
							<span>где природы безмерны щедроты</span>
							<span>и где лето полгода в году, —</span>
							<span>я сегодня иные широты</span>
							<span>и долготы имею в виду.</span>
							<span></span>
							<span>Вот в распахнутой раме рассвета</span>
							<span>открываются стороны света.</span>
							<span>Сколько их?</span>
							<span>Их никто не считал...</span>
						</p>
					</div>
					
				<?endif?>
				
			</div>
		</div>

		<div class="c-parallax-scene__layer" data-depth="0.2">
			<div class="c-parallax-scene__smoking-pipe">
				<img class="c-parallax-scene__img" src="<?=SITE_TEMPLATE_PATH?>/assets/images/photo/photo-smoking-pipe-01.png" alt="Smoking pipe">
			</div>
		</div>

		<div class="c-parallax-scene__layer" data-depth="0.2">
			<div class="c-parallax-scene__cup">
				<img class="c-parallax-scene__img" src="<?=SITE_TEMPLATE_PATH?>/assets/images/photo/photo-cup-01.png" alt="Cup">
			</div>
		</div>

		<div class="c-parallax-scene__layer" data-depth="0.2">
			<a class="c-parallax-scene-turntable c-parallax-scene__turntable" href="/mediateka/audio/">
				<img class="c-parallax-scene__img" src="<?=SITE_TEMPLATE_PATH?>/assets/images/photo/photo-turntable-01.png" alt="Turntable">
			</a>

			<div class="c-parallax-scene-description c-parallax-scene-description--turntable">
				<span class="c-parallax-scene-description__icon"></span>
				<h2 class="c-parallax-scene-description__title">Аудиотека</h2>
				<p class="c-parallax-scene-description__text u-ff-secondary">Текст для аудиотеки</p>
			</div>
		</div>

		<div class="c-parallax-scene__layer" data-depth="0.2">
			<a class="c-parallax-scene-newspaper c-parallax-scene__newspaper" href="">
				<img class="c-parallax-scene__img" src="<?=SITE_TEMPLATE_PATH?>/assets/images/photo/photo-newspaper-01.png" alt="Newspaper">
			</a>

			<div class="c-parallax-scene-description c-parallax-scene-description--newspaper">
				<span class="c-parallax-scene-description__icon"></span>
				<h2 class="c-parallax-scene-description__title">Литература о поэте</h2>
				<p class="c-parallax-scene-description__text u-ff-secondary">Текс для литературы о поэте</p>
			</div>
		</div>
	</div>
</section>
<?// END: Main page promo ?>