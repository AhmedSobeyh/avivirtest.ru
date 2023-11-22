<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
?>



<?= $brand['NAME'] ?> <?= $arItem['PROPERTIES']['COUNTRY']['VALUE'] //Имя регион 
						?>

<?= $arItem['NAME']; // описание
?>

<?= $arItem['PROPERTIES']['DETERMINES']['VALUE'] // маркер
?>

<?= $arItem['PROPERTIES']['BIOMATERIAL']['VALUE'] // образец
?>

<?= $arItem['PROPERTIES']['INFECTION']['VALUE'] // инфекция
?>

<div class="content-block-ContentBlock-module-block express-Express-module-assortment">
	<div class="content-block-ContentBlock-module-info">
		<h2 class="content-block-ContentBlock-module-title">Ассортимент</h2>
		<div class="content-block-ContentBlock-module-content express-Express-module-content">
			<div class="content-block-ContentBlock-module-content express-Express-module-content">
				<form class="express-Filters-module-form">
					<div class="hidden-Hidden-module-desktop-hidden">
						<p class="express-Filters-module-title express-Filters-module-button express-Filters-module-visible">
							Фильтр<svg width="4" height="8" viewBox="0 0 4 8" fill="none" xmlns="http://www.w3.org/2000/svg" class="express-Filters-module-arrow express-Filters-module-visible">
								<path d="M0.673503 5.53131e-05C0.541935 8.67844e-05 0.413328 0.0440421 0.303941 0.126364C0.194555 0.208686 0.1093 0.32568 0.058955 0.462553C0.00860953 0.599427 -0.00456619 0.750034 0.0210941 0.895339C0.0467541 1.04064 0.110098 1.17412 0.203117 1.27889L2.39404 3.74591L0.203117 6.21293C0.139571 6.28204 0.0888851 6.36471 0.0540159 6.45611C0.0191469 6.54751 0.000792503 6.64582 2.47955e-05 6.7453C-0.000742912 6.84477 0.0160913 6.94342 0.0495446 7.03549C0.0829978 7.12756 0.132401 7.21121 0.19487 7.28155C0.257339 7.35189 0.331625 7.40752 0.413391 7.44519C0.495157 7.48286 0.582767 7.50181 0.671109 7.50095C0.759451 7.50008 0.846755 7.47942 0.927928 7.44015C1.0091 7.40089 1.08252 7.34382 1.14389 7.27226L3.8052 4.27558C3.92993 4.13509 4 3.94457 4 3.74591C4 3.54726 3.92993 3.35674 3.8052 3.21625L1.14389 0.219562C1.01915 0.0790553 0.849945 9.77516e-05 0.673503 5.53131e-05Z" fill="currentColor"></path>
							</svg>
						</p>
					</div>
					<div class="express-Filters-module-filters express-Filters-module-visible">
						<div class="express-Filters-module-filter">
							<h3 class="express-Filters-module-title">
								По образцу<svg width="4" height="8" viewBox="0 0 4 8" fill="none" xmlns="http://www.w3.org/2000/svg" class="express-Filters-module-arrow express-Filters-module-visible">
									<path d="M0.673503 5.53131e-05C0.541935 8.67844e-05 0.413328 0.0440421 0.303941 0.126364C0.194555 0.208686 0.1093 0.32568 0.058955 0.462553C0.00860953 0.599427 -0.00456619 0.750034 0.0210941 0.895339C0.0467541 1.04064 0.110098 1.17412 0.203117 1.27889L2.39404 3.74591L0.203117 6.21293C0.139571 6.28204 0.0888851 6.36471 0.0540159 6.45611C0.0191469 6.54751 0.000792503 6.64582 2.47955e-05 6.7453C-0.000742912 6.84477 0.0160913 6.94342 0.0495446 7.03549C0.0829978 7.12756 0.132401 7.21121 0.19487 7.28155C0.257339 7.35189 0.331625 7.40752 0.413391 7.44519C0.495157 7.48286 0.582767 7.50181 0.671109 7.50095C0.759451 7.50008 0.846755 7.47942 0.927928 7.44015C1.0091 7.40089 1.08252 7.34382 1.14389 7.27226L3.8052 4.27558C3.92993 4.13509 4 3.94457 4 3.74591C4 3.54726 3.92993 3.35674 3.8052 3.21625L1.14389 0.219562C1.01915 0.0790553 0.849945 9.77516e-05 0.673503 5.53131e-05Z" fill="currentColor"></path>
								</svg>
							</h3>
							<ul class="express-Filters-module-items express-Filters-module-visible">
								<li class="express-Filters-module-item">
									<div class="contacts-CheckBox-module-wrapper">
										<input class="contacts-CheckBox-module-checkbox" type="checkbox" name="sluna" id="sluna" required="" data-title="Слюна" data-filter="По образцу" /><label for="sluna" class="contacts-CheckBox-module-label">Слюна<span class="contacts-CheckBox-module-checkmark"><span class="contacts-CheckBox-module-checked"></span></span></label>
									</div>
								</li>
								<li class="express-Filters-module-item">
									<div class="contacts-CheckBox-module-wrapper">
										<input class="contacts-CheckBox-module-checkbox" type="checkbox" name="blood" id="blood" required="" data-title="Капиллярная кровь" data-filter="По образцу" /><label for="blood" class="contacts-CheckBox-module-label">Капиллярная кровь<span class="contacts-CheckBox-module-checkmark"><span class="contacts-CheckBox-module-checked"></span></span></label>
									</div>
								</li>
								<li class="express-Filters-module-item">
									<div class="contacts-CheckBox-module-wrapper">
										<input class="contacts-CheckBox-module-checkbox" type="checkbox" name="nase_1" id="nase_1" required="" data-title="Мазок из носоглотки" data-filter="По образцу" /><label for="nase_1" class="contacts-CheckBox-module-label">Мазок из носоглотки<span class="contacts-CheckBox-module-checkmark"><span class="contacts-CheckBox-module-checked"></span></span></label>
									</div>
								</li>
								<li class="express-Filters-module-item">
									<div class="contacts-CheckBox-module-wrapper">
										<input class="contacts-CheckBox-module-checkbox" type="checkbox" name="nase_2" id="nase_2" required="" data-title="Мазок из носа" data-filter="По образцу" /><label for="nase_2" class="contacts-CheckBox-module-label">Мазок из носа<span class="contacts-CheckBox-module-checkmark"><span class="contacts-CheckBox-module-checked"></span></span></label>
									</div>
								</li>
							</ul>
						</div>
						<div class="express-Filters-module-filter">
							<h3 class="express-Filters-module-title">
								По маркеру<svg width="4" height="8" viewBox="0 0 4 8" fill="none" xmlns="http://www.w3.org/2000/svg" class="express-Filters-module-arrow express-Filters-module-visible">
									<path d="M0.673503 5.53131e-05C0.541935 8.67844e-05 0.413328 0.0440421 0.303941 0.126364C0.194555 0.208686 0.1093 0.32568 0.058955 0.462553C0.00860953 0.599427 -0.00456619 0.750034 0.0210941 0.895339C0.0467541 1.04064 0.110098 1.17412 0.203117 1.27889L2.39404 3.74591L0.203117 6.21293C0.139571 6.28204 0.0888851 6.36471 0.0540159 6.45611C0.0191469 6.54751 0.000792503 6.64582 2.47955e-05 6.7453C-0.000742912 6.84477 0.0160913 6.94342 0.0495446 7.03549C0.0829978 7.12756 0.132401 7.21121 0.19487 7.28155C0.257339 7.35189 0.331625 7.40752 0.413391 7.44519C0.495157 7.48286 0.582767 7.50181 0.671109 7.50095C0.759451 7.50008 0.846755 7.47942 0.927928 7.44015C1.0091 7.40089 1.08252 7.34382 1.14389 7.27226L3.8052 4.27558C3.92993 4.13509 4 3.94457 4 3.74591C4 3.54726 3.92993 3.35674 3.8052 3.21625L1.14389 0.219562C1.01915 0.0790553 0.849945 9.77516e-05 0.673503 5.53131e-05Z" fill="currentColor"></path>
								</svg>
							</h3>
							<ul class="express-Filters-module-items express-Filters-module-visible">
								<li class="express-Filters-module-item">
									<div class="contacts-CheckBox-module-wrapper">
										<input class="contacts-CheckBox-module-checkbox" type="checkbox" name="antigen" id="antigen" required="" data-title="Антиген" data-filter="По маркеру" /><label for="antigen" class="contacts-CheckBox-module-label">Антиген<span class="contacts-CheckBox-module-checkmark"><span class="contacts-CheckBox-module-checked"></span></span></label>
									</div>
								</li>
								<li class="express-Filters-module-item">
									<div class="contacts-CheckBox-module-wrapper">
										<input class="contacts-CheckBox-module-checkbox" type="checkbox" name="antitela" id="antitela" required="" data-title="Антитела" data-filter="По маркеру" /><label for="antitela" class="contacts-CheckBox-module-label">Антитела<span class="contacts-CheckBox-module-checkmark"><span class="contacts-CheckBox-module-checked"></span></span></label>
									</div>
								</li>
								<li class="express-Filters-module-item">
									<div class="contacts-CheckBox-module-wrapper">
										<input class="contacts-CheckBox-module-checkbox" type="checkbox" name="virus_RNA" id="virus_RNA" required="" data-title="РНК вируса" data-filter="По маркеру" /><label for="virus_RNA" class="contacts-CheckBox-module-label">РНК вируса<span class="contacts-CheckBox-module-checkmark"><span class="contacts-CheckBox-module-checked"></span></span></label>
									</div>
								</li>
							</ul>
						</div>
						<!-- <div class="express-Filters-module-filter">
							<h3 class="express-Filters-module-title">
								Инфекция<svg width="4" height="8" viewBox="0 0 4 8" fill="none" xmlns="http://www.w3.org/2000/svg" class="express-Filters-module-arrow express-Filters-module-visible">
									<path d="M0.673503 5.53131e-05C0.541935 8.67844e-05 0.413328 0.0440421 0.303941 0.126364C0.194555 0.208686 0.1093 0.32568 0.058955 0.462553C0.00860953 0.599427 -0.00456619 0.750034 0.0210941 0.895339C0.0467541 1.04064 0.110098 1.17412 0.203117 1.27889L2.39404 3.74591L0.203117 6.21293C0.139571 6.28204 0.0888851 6.36471 0.0540159 6.45611C0.0191469 6.54751 0.000792503 6.64582 2.47955e-05 6.7453C-0.000742912 6.84477 0.0160913 6.94342 0.0495446 7.03549C0.0829978 7.12756 0.132401 7.21121 0.19487 7.28155C0.257339 7.35189 0.331625 7.40752 0.413391 7.44519C0.495157 7.48286 0.582767 7.50181 0.671109 7.50095C0.759451 7.50008 0.846755 7.47942 0.927928 7.44015C1.0091 7.40089 1.08252 7.34382 1.14389 7.27226L3.8052 4.27558C3.92993 4.13509 4 3.94457 4 3.74591C4 3.54726 3.92993 3.35674 3.8052 3.21625L1.14389 0.219562C1.01915 0.0790553 0.849945 9.77516e-05 0.673503 5.53131e-05Z" fill="currentColor"></path>
								</svg>
							</h3>
							<ul class="express-Filters-module-items express-Filters-module-visible">
								<li class="express-Filters-module-item">
									<div class="contacts-CheckBox-module-wrapper">
										<input class="contacts-CheckBox-module-checkbox" type="checkbox" name="covid" id="covid" required="" data-title="COVID-19" data-filter="Инфекция" /><label for="covid" class="contacts-CheckBox-module-label">COVID-19<span class="contacts-CheckBox-module-checkmark"><span class="contacts-CheckBox-module-checked"></span></span></label>
									</div>
								</li>
								<li class="express-Filters-module-item">
									<div class="contacts-CheckBox-module-wrapper">
										<input class="contacts-CheckBox-module-checkbox" type="checkbox" name="sifilis" id="sifilis" required="" data-title="Сифилис" data-filter="Инфекция" /><label for="sifilis" class="contacts-CheckBox-module-label">Сифилис<span class="contacts-CheckBox-module-checkmark"><span class="contacts-CheckBox-module-checked"></span></span></label>
									</div>
								</li>
								<li class="express-Filters-module-item">
									<div class="contacts-CheckBox-module-wrapper">
										<input class="contacts-CheckBox-module-checkbox" type="checkbox" name="gepatit" id="gepatit" required="" data-title="Гепатит" data-filter="Инфекция" /><label for="gepatit" class="contacts-CheckBox-module-label">Гепатит<span class="contacts-CheckBox-module-checkmark"><span class="contacts-CheckBox-module-checked"></span></span></label>
									</div>
								</li>
							</ul>
						</div> -->
						<p class="express-Filters-module-reset">Сбросить</p>
					</div>
				</form>

				<ul class="express-Express-module-products" id="products">
					<? foreach ($arResult["ITEMS"] as $arItem) : ?>
						<?
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
						?>
						<a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="express-Express-module-product">
							<div class="express-Express-module-info">
								<? if ($arItem['PREVIEW_PICTURE']['SRC'])
									$itemPicture = $arItem['PREVIEW_PICTURE']['SRC'];

								else
									$itemPicture = '/upload/images/catalog/catalog-section-page-header-00.png';
								?>
								<img class="express-Express-module-image" src="<?= $itemPicture ?>" alt="<?= $arItem['NAME']; ?>" />
								<div class="express-Express-module-data">
									<? $brand = current($arItem['BRANDS']) ?>
									<h5 class="express-Express-module-location"><?= $brand['NAME'] ?> <?= $arItem['PROPERTIES']['COUNTRY']['VALUE'] ?></h5>
									<h4 class="express-Express-module-title"><?= $arItem['NAME'] ?></h4>
									<p class="express-Express-module-text">
										<?= $arItem['PREVIEW_TEXT'] ?>
									</p>
									<ul class="express-Express-module-filters">
										<? if ($arItem['PROPERTIES']['DETERMINES']['VALUE'] != '') : ?>
											<li class="express-Express-module-filter marker" data-title="<?= $arItem['PROPERTIES']['DETERMINES']['VALUE'] ?>" data-filter="По маркеру">
												<?= $arItem['PROPERTIES']['DETERMINES']['VALUE'] ?>
											</li>
										<? endif ?>
										<? if ($arItem['PROPERTIES']['BIOMATERIAL']['VALUE'] != '') : ?>
											<li class="express-Express-module-filter example" data-title="<?= $arItem['PROPERTIES']['BIOMATERIAL']['VALUE'] ?>" data-filter="По образцу">
												<?= $arItem['PROPERTIES']['BIOMATERIAL']['VALUE'] ?>
											</li>
										<? endif ?>
										<? if ($arItem['PROPERTIES']['BIOMATERIAL_SECOND']['VALUE'] != '') : ?>
											<li class="express-Express-module-filter example" data-title="<?= $arItem['PROPERTIES']['BIOMATERIAL_SECOND']['VALUE'] ?>" data-filter="По образцу">
												<?= $arItem['PROPERTIES']['BIOMATERIAL_SECOND']['VALUE'] ?>
											</li>
										<? endif ?>
										<? if ($arItem['PROPERTIES']['BIOMATERIAL_THIRD']['VALUE'] != '') : ?>
											<li class="express-Express-module-filter example" data-title="<?= $arItem['PROPERTIES']['BIOMATERIAL_THIRD']['VALUE'] ?>" data-filter="По образцу">
												<?= $arItem['PROPERTIES']['BIOMATERIAL_THIRD']['VALUE'] ?>
											</li>
										<? endif ?>
										<? if ($arItem['PROPERTIES']['INFECTION']['VALUE'] != '') : ?>
											<li class="express-Express-module-filter infection" data-title="<?= $arItem['PROPERTIES']['INFECTION']['VALUE'] ?>" data-filter="Инфекция">
												<?= $arItem['PROPERTIES']['INFECTION']['VALUE'] ?>
											</li>
										<? endif ?>
									</ul>
								</div>
							</div>
							<button class="button-Button-module-button express-Express-module-button"><?= GetMessage("CT_BNL_GOTO_DETAIL") ?></button>
						</a>
					<? endforeach; ?>
				</ul>
			</div>
			<div class="content-block-ContentBlock-module-bottom"></div>
		</div>
	</div>
</div>