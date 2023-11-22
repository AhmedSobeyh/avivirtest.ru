<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title","Калькулятор вероятности госпитализации при заболевании коронавирусом COVID-19 — компания «Авивир»");
$APPLICATION->SetPageProperty("description", "Узнайте вероятность госпитализации при заболевании COVID-19 в специальном калькуляторе от Avivir.");
$APPLICATION->SetTitle("Вероятность госпитализации");
?>

<?// START: App header ?>
<header class="c-app-header c-app-header--density-compact c-app-header--fullscreen c-app-header--has-media t-light">
	<div class="o-container@xl c-app-header__container">
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
					style="background-image: url(/upload/images/backgrounds/bg-plus-grid-color-primary-00.svg);"
				></div>

				<? /* START: Picture */ ?>
				<picture class="c-picture o-ratio o-ratio--1x1">
					<img
						class="c-picture__img c-picture__img--contain"
						src="/upload/images/renders/render-user-friends.png"
						alt="<?$APPLICATION->ShowTitle()?>"
					/>
				</picture>
				<? /* END: Picture */ ?>
			</div>

			<div class="c-app-header__body">
				<h1 class="c-app-header__title"><?$APPLICATION->ShowTitle(true)?></h1>

				<span class="c-app-header__lead">
					Узнайте вероятность госпитализации при заболевании <br/>COVID-19 в специальном калькуляторе от Avivir.
				</span>

				<div class="c-app-header__btn-group">
					<?// START: Button ?>
					<a
						class="c-btn c-btn--kind-primary c-btn--size-xl c-app-header__btn"
						href="#calculatedata"
					>
						<span class="c-btn__overlay"></span>
						<span class="c-btn__content">
							Рассчитать вероятность
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
		<div class="c-app-section c-app-section--density-comfortable">
			<div class="o-container@xl">
				<ul class="c-feature-list">
					<li class="c-feature-list__item">
						<?// START: Feature item ?>
						<div class="c-feature-item c-feature-item--row">
							<?// START: Icon ?>
							<object
								class="
									c-icon
									c-icon--object
									c-feature-item__icon
								"
								data="/upload/images/icon/duotone/people-group.svg"
								type="image/svg+xml"
							></object>
							<?// END: Icon ?>

							<div class="c-feature-item__body">
								<h2 class="c-feature-item__title">
									500 тысяч
								</h2>

								<p class="c-feature-item__text">
									участников исследования
								</p>
							</div>
						</div>
						<?// END: Feature item ?>
					</li>
					<li class="c-feature-list__item">
						<?// START: Feature item ?>
						<div class="c-feature-item c-feature-item--row">
							<?// START: Icon ?>
							<object
								class="
									c-icon
									c-icon--object
									c-feature-item__icon
								"
								data="/upload/images/icon/duotone/infected-lungs.svg"
								type="image/svg+xml"
							></object>
							<?// END: Icon ?>

							<div class="c-feature-item__body">
								<h2 class="c-feature-item__title">
									~ 10 000 тысяч
								</h2>

								<p class="c-feature-item__text">
									положительных результатов COVID-19
								</p>
							</div>
						</div>
						<?// END: Feature item ?>
					</li>
					<li class="c-feature-list__item">
						<?// START: Feature item ?>
						<div class="c-feature-item c-feature-item--row">
							<?// START: Icon ?>
							<object
								class="
									c-icon
									c-icon--object
									c-feature-item__icon
								"
								data="/upload/images/icon/duotone/hospitalization.svg"
								type="image/svg+xml"
							></object>
							<?// END: Icon ?>

							<div class="c-feature-item__body">
								<h2 class="c-feature-item__title">
									~ 750 человек
								</h2>

								<p class="c-feature-item__text">
									госпитализированы COVID-19
								</p>
							</div>
						</div>
						<?// END: Feature item ?>
					</li>
				</ul>
			</div>
		</div>

		<fieldset class="c-calculatedata" id="calculatedata">
			<div class="o-container@xl">
				<div class="c-calculatedata__header">
					<legend class="c-calculatedata__title">
						Вероятность госпиталиации при заболевании COVID-19
					</legend>
				</div>

				<div class="c-calculatedata__body">
					<div class="c-calculatedata__layout">
						<form class="c-calculatedata-form c-calculatedata__form" id="calculatedataForm">
							<div class="c-calculatedata-form__group">
								<span class="c-calculatedata-form__label">
									Пол
								</span>

								<div class="c-form-check c-form-check--kind-radio c-calculatedata-form__check">
									<input
										class="c-form-check__input"
										id="calculatedataFormMale"
										name="gender"
										type="radio"
										value="male"
										checked="checked"
									>
									<label for="calculatedataFormMale" class="c-form-check__label">
										Мужской
									</label>
								</div>

								<div class="c-form-check c-form-check--kind-radio c-calculatedata-form__check">
									<input
										class="c-form-check__input"
										id="calculatedataFormFemale"
										name="gender"
										type="radio"
										value="female"
									>
									<label for="calculatedataFormFemale" class="c-form-check__label">
										Женский
									</label>
								</div>
							</div>

							<div class="c-calculatedata-form__group">
								<div class="c-form-select c-form-select--size-lg c-calculatedata-form__select">
									<div class="c-form-select__control">
										<label
											class="c-form-select__label"
											for="calculatedataFormAge"
										>
											Возраст
										</label>
										<select
											class="c-form-select__select"
											id="calculatedataFormAge"
											name="age"
										>
											<option value="20" selected>20-30</option>
											<option value="30">30-40</option>
											<option value="40">40-50</option>
											<option value="50">50-60</option>
											<option value="60">60-70</option>
											<option value="70">70-80</option>
											<option value="80">за 80</option>
										</select>
									</div>
								</div>
							</div>

							<div class="c-calculatedata-form__group">
								<div class="c-form-textfield c-form-textfield--size-lg c-calculatedata-form__textfield">
									<div class="c-form-textfield__control">
										<label
											class="c-form-textfield__label"
											for="calculatedataFormWeight"
										>
											Вес
										</label>
										<input
											class="c-form-textfield__input"
											id="calculatedataFormWeight"
											name="weight"
											type="text"
											placeholder="Вес"
											value="70"
										>
									</div>

									<span class="c-form-message c-form-message--kind-tooltip"></span>
								</div>

								<div class="c-form-textfield c-form-textfield--size-lg c-calculatedata-form__textfield">
									<div class="c-form-textfield__control">
										<label
											class="c-form-textfield__label"
											for="calculatedataFormHeight"
										>
											Рост
										</label>
										<input
											class="c-form-textfield__input"
											id="calculatedataFormHeight"
											name="height"
											type="text"
											placeholder="Рост"
											value="170"
										>
									</div>

									<span class="c-form-message c-form-message--kind-tooltip">
										Укажите рост
									</span>
								</div>
							</div>

							<div class="c-calculatedata-form__group">
								<div class="c-form-select c-form-select--size-lg c-calculatedata-form__select">
									<div class="c-form-select__control">
										<label
											class="c-form-select__label"
											for="calculatedataFormActivity"
										>
											Частота физических упражнений
										</label>
										<select
											class="c-form-select__select"
											id="calculatedataFormActivity"
											name="activity"
										>
											<option value="no" selected>Не занимаюсь</option>
											<option value="moderate">1-4 раза в неделю</option>
											<option value="good">5+ раз в неделю</option>
										</select>
									</div>
								</div>
							</div>

							<div class="c-calculatedata-form__group">
								<span class="c-calculatedata-form__label" style="margin-bottom: 0;">
									Дополнительная информация
								</span>

								<div class="c-form-check c-form-check--kind-chip c-calculatedata-form__check">
									<input id="calculatedataFormSmoking" name="additional" type="checkbox" class="c-form-check__input">
									<label for="calculatedataFormSmoking" class="c-chip c-chip--size-default c-chip--kind-outline-primary c-form-check__label">
										<span class="c-chip__content">
											Курение
										</span>
									</label>
								</div>

								<div class="c-form-check c-form-check--kind-chip c-calculatedata-form__check">
									<input id="calculatedataFormDiabetes" name="additional" type="checkbox" class="c-form-check__input">
									<label for="calculatedataFormDiabetes" class="c-chip c-chip--size-default c-chip--kind-outline-primary c-form-check__label">
										<span class="c-chip__content">
											Диабет
										</span>
									</label>
								</div>

								<div class="c-form-check c-form-check--kind-chip c-calculatedata-form__check">
									<input id="calculatedataFormCardio" name="additional" type="checkbox" class="c-form-check__input">
									<label for="calculatedataFormCardio" class="c-chip c-chip--size-default c-chip--kind-outline-primary c-form-check__label">
										<span class="c-chip__content">
											Заболевание сердца
										</span>
									</label>
								</div>

								<div class="c-form-check c-form-check--kind-chip c-calculatedata-form__check">
									<input id="calculatedataFormLiver" name="additional" type="checkbox" class="c-form-check__input">
									<label for="calculatedataFormLiver" class="c-chip c-chip--size-default c-chip--kind-outline-primary c-form-check__label">
										<span class="c-chip__content">
											Проблемы с печенью
										</span>
									</label>
								</div>

								<div class="c-form-check c-form-check--kind-chip c-calculatedata-form__check">
									<input id="calculatedataFormPressure" name="additional" type="checkbox" class="c-form-check__input">
									<label for="calculatedataFormPressure" class="c-chip c-chip--size-default c-chip--kind-outline-primary c-form-check__label">
										<span class="c-chip__content">
											Высокое кровяное давление
										</span>
									</label>
								</div>
							</div>

							<?// START: Button ?>
							<button
								class="
									c-btn
									c-btn--kind-primary
									c-btn--size-lg
									c-calculatedata-form__btn
								"
								id="calculatedataFormSubmit"
								type="button"
							>
								<span
									class="c-btn__overlay"
								></span>
								<span class="c-btn__content">
									Рассчитать
								</span>
							</button>
							<?// END: Button ?>
						</form>

						<div class="c-calculatedata-result c-calculatedata__result" id="calculatedataResult">
							<div class="c-calculatedata-result__body">
								<h2 class="c-calculatedata-result__title">
									Риск при заболевании COVID-19:
								</h2>

								<div
									class="c-progress-linear c-progress-linear--rounded c-progress-linear--primary c-calculatedata-result__progress"
									aria-valuemin="0"
									aria-valuemax="100"
									aria-valuenow="0"
									id="calculatedataResultProgress"
									role="progressbar"
								>
									<div class="c-progress-linear__background" style="left: 0%; width: 100%;"></div>
									<div class="c-progress-linear__buffer"></div>
									<div class="c-progress-linear__determinate" style="width: 0%;"></div>
									<div class="c-progress-linear__content">
										0%
									</div>
								</div>

								<div class="c-calculatedata-result__media">
									<picture class="o-ratio o-ratio--4x3 c-calculatedata-result__picture c-calculatedata-result__picture--positive is-active">
										<img
											class="o-ratio__item c-calculatedata-result__img"
											src="/upload/images/calculatedata/calculatedata-result-positive.svg"
											alt="Риск при заболевании COVID-19"
										>
									</picture>
								</div>
							</div>

							<div class="c-calculatedata-result__footer">
								<p class="c-calculatedata-result__lead">
									Введите необходимую информацию, чтобы оценить риск заболевания Covid-19
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</fieldset>
	</div>
</main>
<?// END: Main ?>

<script>
	// START: Calculate data
	document.addEventListener("DOMContentLoaded", function() {
		document.querySelector('#calculatedataFormSubmit').addEventListener('click', function(event) {
			event.preventDefault

			console.log('click');

			const GENDER_SELECTOR = document.querySelector('input[name="gender"]:checked')
			const AGE_SELECTOR = document.querySelector('#calculatedataFormAge')
			const WEIGHT_SELECTOR = document.querySelector('#calculatedataFormWeight')
			const HEIGHT_SELECTOR = document.querySelector('#calculatedataFormHeight')
			const ACTIVITY_SELECTOR = document.querySelector('#calculatedataFormActivity')

			const SMOKING_SELECTOR = document.querySelector('#calculatedataFormSmoking')
			const DIABETES_SELECTOR = document.querySelector('#calculatedataFormDiabetes')
			const CARDIO_SELECTOR = document.querySelector('#calculatedataFormCardio')
			const LIVER_SELECTOR = document.querySelector('#calculatedataFormLiver')
			const PRESSURE_SELECTOR = document.querySelector('#calculatedataFormPressure')

			const WEIGHT_TEXTFIELD_SELECTOR = WEIGHT_SELECTOR.parentElement.parentElement
			const HEIGHT_TEXTFIELD_SELECTOR = HEIGHT_SELECTOR.parentElement.parentElement

			const RESULT_SELECTOR = document.querySelector('#calculatedataResult')
			const RESULT_PROGRESS_SELECTOR = document.querySelector('#calculatedataResultProgress')
			const RESULT_PROGRESS_DETERMINATE_SELECTOR = RESULT_PROGRESS_SELECTOR.querySelector('.c-progress-linear__determinate')
			const RESULT_PROGRESS_CONTENT_SELECTOR = RESULT_PROGRESS_SELECTOR.querySelector('.c-progress-linear__content')
			const RESULT_LEAD_SELECTOR = RESULT_SELECTOR.querySelector('.c-calculatedata-result__lead')

			let minValue = 0
				illChance =''
				gender = GENDER_SELECTOR.value
				age = AGE_SELECTOR.value
				weight = WEIGHT_SELECTOR.value
				height = HEIGHT_SELECTOR.value
				activity = ACTIVITY_SELECTOR.value

			WEIGHT_TEXTFIELD_SELECTOR.classList.remove('is-invalid')
			HEIGHT_TEXTFIELD_SELECTOR.classList.remove('is-invalid')

			RESULT_PROGRESS_DETERMINATE_SELECTOR.style.width = minValue + '%'
			RESULT_PROGRESS_CONTENT_SELECTOR.innerHTML = minValue + '%'

			if (weight < 30) {
				WEIGHT_TEXTFIELD_SELECTOR.classList.add('is-invalid')
				WEIGHT_TEXTFIELD_SELECTOR.querySelector('.c-form-message').innerHTML = 'Укажите вес свыше 30кг'

				return false;
			}

			if (weight > 170) {
				WEIGHT_TEXTFIELD_SELECTOR.classList.add('is-invalid')
				WEIGHT_TEXTFIELD_SELECTOR.querySelector('.c-form-message').innerHTML = 'Укажите вес меньше 170кг'

				return false;
			}

			if (height < 140) {
				HEIGHT_TEXTFIELD_SELECTOR.classList.add('is-invalid')
				HEIGHT_TEXTFIELD_SELECTOR.querySelector('.c-form-message').innerHTML = 'Минимальное значение роста - 140см'

				return false;
			}

			if (height > 220) {
				HEIGHT_TEXTFIELD_SELECTOR.classList.add('is-invalid')
				HEIGHT_TEXTFIELD_SELECTOR.querySelector('.c-form-message').innerHTML = 'Максимальное значение роста - 220см'

				return false;
			}

			switch(age) {
				case '20':
					illChance = 5
					break
				case '30':
					illChance = 7
					break
				case '40':
					illChance = 9
					break
				case '50':
					illChance = 12
					break
				case '60':
					illChance = 16
					break
				case '70':
					illChance = 21
					break
				case '80':
					illChance = 27
					break
			}

			gender === "female" ? illChance -= 2 : illChance

			age < 40 ? weightIndex = height - 110 : weightIndex = height - 100

			if (weight < (weightIndex - 20) || weight > (weightIndex + 20)) {
				illChance += 1
			}

			switch(activity) {
				case 'no':
					illChance
				break
				case 'moderate':
					illChance-=1
				break
				case 'good':
					illChance-=2
				break
			}

			SMOKING_SELECTOR.checked ? illChance+=1 : illChance
			DIABETES_SELECTOR.checked ? illChance+=1 : illChance
			CARDIO_SELECTOR.checked ? illChance+=1 : illChance
			LIVER_SELECTOR.checked ? illChance+=1 : illChance
			PRESSURE_SELECTOR.checked ? illChance+=1 : illChance

			value = Math.ceil(parseInt(illChance)) + '%'

			RESULT_PROGRESS_DETERMINATE_SELECTOR.style.width = value
			RESULT_PROGRESS_CONTENT_SELECTOR.innerHTML = value

			if (illChance < 5) {
				resultLeadHtml = 'Ура! Поздравляем! Теперь ты знаешь, что тебе не страшно толкаться в метро!'
			} else if ((illChance >= 5) && (illChance < 10)) {
				resultLeadHtml = 'Фух, всего ничего! Продолжай и дальше свои тесные танцы в барах, но, пожалуйста, будь в маске!'
			} else if ((illChance >= 10) && (illChance < 15)) {
				resultLeadHtml = 'Эх, а шумные компании и походы в рестораны, кажется, стоит отложить на потом. Советуем бутылочку вина под хороший фильм!'
			} else if ((illChance >= 15) && (illChance < 20)) {
				resultLeadHtml = 'Хочешь на вечеринку - устрой ее сам! По ZOOM-у!'
			} else if ((illChance >= 20) && (illChance < 25)) {
				resultLeadHtml = 'Ух, не боись! Главное, перед выходом на свидание, не забудь свою маску и антисептик!'
			} else if ((illChance >= 25) && (illChance < 34)) {
				resultLeadHtml = 'Это совсем не страшно, когда рядом друзья (с отрицательным тестом). А если подружишься с маской и социальной дистанцией, никакой коронавирус тебе нипочем!'
			}

			RESULT_LEAD_SELECTOR.innerHTML = resultLeadHtml

			// let data = {
			// 	'gender': gender,
			// 	'age': age,
			// 	'weight': weight,
			// 	'height': height,
			// 	'activity': activity,
			// 	'illChance': illChance,
			// }

			// console.log(data);
		})
	})
	// END: Calculate data
</script>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
