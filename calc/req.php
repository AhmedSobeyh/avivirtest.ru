<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>

		<form class="g-form" id="g-form-1" method="POST" action="requests.php" autocomplete="off">
			<h2 class="g-form__title g-form__title_respond"></h2>
			<div class="firstblock">
				<div class="blockinn">
					<div class="selhead">Пол:</div>
					<select class="sd-form-select" id="gender" name="gender">
						<option value="male" name="мужской">Мужской</option>
						<option value="female" name="женский">Женский</option>
					</select>
					<div class="wrong_gender"> </div>
				</div>
				<div class="blockinn">
					<div class="selhead">Возраст:</div>
					<select class="sd-form-select" id="age" name="age">
						<option value='20'>20-30</option>
						<option value='30'>30-40</option>
						<option value='40'>40-50</option>
						<option value='50'>50-60</option>
						<option value='60'>60-70</option>
						<option value='70'>70-80</option>
						<option value='80'>за 80</option>
					</select>
					<div class="wrong_age"> </div>
				</div>
			</div>
			<div class="secondblock">
				<div class="weight selhead">
					<p>Вес:</p>
					<p><input id="weight" type="number" size="3" name="weight" min="30" max="170" value="70"></p>
				</div>
				<div class="height selhead">
					<p>Рост:</p>
					<p><input id="height" type="number" size="3" name="height" min="140" max="220" value="170"></p>
				</div>
			</div>
			<div class="thirdblock">
				<div class="blockinn">
					<div class="selhead">Частота физических упражнений:</div>
					<select class="sd-form-select" id="exercise" name="exercise">
						<option value='1' name="age20">Не занимаюсь</option>
						<option value='2' name="age30">1-4 раз в неделю</option>
						<option value='3' name="age40">5+ раз в неделю</option>
					</select>
				</div>
				
			</div>

			<div class="fourthblock">				
			<div class="checker"><input type="checkbox" id="cb1" name="liver" value="1"> <label class="doplabel"for="cb1">Проблемы с печенью</br></label></div>
				<div class="checker"><input type="checkbox" id="cb2" name="pressure" value="1"> <label class="doplabel"for="cb2">Высокое кровяное давление</br></label></div>				
				<div class="checker"><input type="checkbox" id="cb3" name="diabet" value="1"> <label class="doplabel"for="cb3">Диабет</br></label></div>				
				<div class="checker"><input type="checkbox" id="cb4" name="heart" value="1"> <label class="doplabel"for="cb4">Заболевания сердца</br></label></div>				
				<div class="checker"><input type="checkbox" id="cb5" name="smoking" value="1"> <label class="doplabel"for="cb5">Курение</br></label></div>				
			</div>
		<button type="submit" class="calcbutt">Рассчитать</button>
			<div class="confirmbutt">
			</div>
		</form>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>		