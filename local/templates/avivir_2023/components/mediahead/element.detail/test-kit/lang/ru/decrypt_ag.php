<? // START: Test kit decryption 
?>

<section class="c-test-kit-decryption c-test-kit-page__decryption">
	<div class="o-container@lg c-test-kit-decryption__container">
		<div class="c-test-kit-decryption__header">
			<h2 class="c-test-kit-decryption__title">
				Расшифровка результата экспресс-теста
			</h2>
		</div>

		<div class="c-test-kit-decryption__body">
			<section class="c-test-kit-decryption-item c-test-kit-decryption__item">
				<div class="c-test-kit-decryption-item__media">
					<? // prettier-ignore 
					?>
					<picture class="c-picture ">
						<img class="c-picture__img c-test-kit-decryption-item__img" src="/upload/images/test-kit/test-kit-decryption-ag-c-negative.svg" alt="Если линия (С) окрашивается в красный цвет" />
					</picture>
				</div>
				<div class="c-test-kit-decryption-item__body">
					<h3 class="c-test-kit-decryption-item__title">
						Если линия (С) окрашивается в красный цвет:
					</h3>

					<p class="c-test-kit-decryption-item__text">
						Анализ дал отрицательный результат на наличие антигена к коронавирусу.
					</p>
				</div>
			</section>

			<section class="c-test-kit-decryption-item c-test-kit-decryption__item">
				<div class="c-test-kit-decryption-item__media">
					<? // prettier-ignore 
					?>
					<picture class="c-picture ">
						<img class="c-picture__img c-test-kit-decryption-item__img" src="/upload/images/test-kit/test-kit-decryption-ag-c-t-positive<?= $testMod ?>.svg" alt="Если линия (C) окрашивается в красный цвет а линия (Т) в черный" />
					</picture>
				</div>
				<div class="c-test-kit-decryption-item__body">
					<h3 class="c-test-kit-decryption-item__title">
						<? if ($testMod == '2') : // обелинии красные
						?>
							Если обе линии (C и Т) окрашиваются в красный цвет:
						<? else : ?>
							Если линия (C) окрашивается в красный цвет а линия (Т) в черный:
						<? endif ?>
					</h3>

					<p class="c-test-kit-decryption-item__text">
						Анализ дал положительный результат на наличие антигена к коронавирусу
					</p>
				</div>
			</section>

			<section class="c-test-kit-decryption-item c-test-kit-decryption__item c-test-kit-decryption__item--span-2">
				<div class="c-test-kit-decryption-item__media">
					<? // prettier-ignore 
					?>
					<picture class="c-picture ">
						<img class="c-picture__img c-test-kit-decryption-item__img" src="/upload/images/test-kit/test-kit-decryption-ag-unknown<?= $testMod ?>.svg" alt="При отсутствии в окошке окрашенной в красный цвет линии (C)" />
					</picture>
				</div>

				<div class="c-test-kit-decryption-item__body">
					<h3 class="c-test-kit-decryption-item__title">
						При отсутствии в окошке окрашенной в красный цвет линии (C):
					</h3>

					<p class="c-test-kit-decryption-item__text">
						Результат тестирования является недействительным. Причиной может быть нарушение требований взятия биологического образца, и/или процедур проведения анализа, или негодность используемой испытательной тест-системы.
					</p>
				</div>
			</section>
		</div>
	</div>
</section>
<? // END: Test kit decryption 
?>