<?// START: Test kit decryption ?>
	<section class="c-test-kit-decryption c-test-kit-page__decryption">
		<div class="o-container@lg c-test-kit-decryption__container">
			<div class="c-test-kit-decryption__header">
				<h2 class="c-test-kit-decryption__title">
					Decoding COVID-19 express test
				</h2> 
			</div>

			<div class="c-test-kit-decryption__body">
				<section class="c-test-kit-decryption-item c-test-kit-decryption__item">
					<div class="c-test-kit-decryption-item__media">
						<?// prettier-ignore ?>
						<picture class="c-picture ">
							<img
								class="c-picture__img c-test-kit-decryption-item__img"
								src="/upload/images/test-kit/test-kit-decryption-ag-c-negative.svg"
								alt="One colored band (red C Control line)"
							/>
						</picture>
					</div>
					<div class="c-test-kit-decryption-item__body">
						<h3 class="c-test-kit-decryption-item__title">
							One colored band (red C Control line)
						</h3>

						<p class="c-test-kit-decryption-item__text">
							Indicates a negative result for the presence of an antigen to the coronavirus.
						</p>
					</div>
				</section>

				<section class="c-test-kit-decryption-item c-test-kit-decryption__item">
					<div class="c-test-kit-decryption-item__media">
						<?// prettier-ignore ?>
						<picture class="c-picture ">
							<img
								class="c-picture__img c-test-kit-decryption-item__img"
								src="/upload/images/test-kit/test-kit-decryption-ag-c-t-positive<?=$testMod?>.svg"
								alt="Two colored bands (red C Control line and black T Test line) "
							/>
						</picture>
					</div>
					<div class="c-test-kit-decryption-item__body">
						<h3 class="c-test-kit-decryption-item__title">
							<?if ($testMod == '2'): // обелинии красные?>
								Two colored bands (red C Control and T Test lines)
							<?else:?>
								Two colored bands (red C Control line and black T Test line)
							<?endif?>	
						</h3>

						<p class="c-test-kit-decryption-item__text">
							Indicate a positive result for the presence of an antigen to the coronavirus
						</p>
					</div>
				</section>

				<section class="c-test-kit-decryption-item c-test-kit-decryption__item c-test-kit-decryption__item--span-2">
					<div class="c-test-kit-decryption-item__media">
						<?// prettier-ignore ?>
						<picture class="c-picture ">
							<img
								class="c-picture__img c-test-kit-decryption-item__img"
								src="/upload/images/test-kit/test-kit-decryption-ag-unknown<?=$testMod?>.svg"
								alt="If the control band (C Control line) is not visible"
							/>
						</picture>
					</div>

					<div class="c-test-kit-decryption-item__body">
						<h3 class="c-test-kit-decryption-item__title">
							If the control band (C Control line) is not visible 
						</h3>

						<p class="c-test-kit-decryption-item__text">
							The result is considered invalid.  <br /><br />
							The reason may be a violation of the requirements for taking a biological specimen, and/or analysis procedures or the unsuitability of the test system used.	
						</p>
					</div>
				</section>
			</div>
		</div>
	</section>
	<?// END: Test kit decryption ?>