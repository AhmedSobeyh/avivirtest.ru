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

//apre($arResult, 'mixed result');

?>

<div class="content-block-ContentBlock-module-block partners-Partners-module-wrapper">
	<div class="content-block-ContentBlock-module-info">
		<div class="content-block-ContentBlock-module-content content-block-ContentBlock-module-last">
			<? foreach ($arResult['TREE'] as $section) : ?>
				<? if ($section['DEPTH_LEVEL'] == '1') : ?>
					<h2><?= $section['NAME'] ?></h2>
				<? endif ?>
				<div class="partners-Partners-module-list">
					<? if ($section['DEPTH_LEVEL'] == '2') : ?>
						<h3><?= $section['NAME'] ?></h3>
					<? endif ?>
					<div class="partners-Partners-module-items">

						<?
						$counter = 1;
						foreach ($section['ELEMENTS'] as $item) : ?>

							<? if ($item['PREVIEW_PICTURE']['SRC'])
								$itemPicture = $item['PREVIEW_PICTURE']['SRC'];

							else
								$itemPicture = '/upload/images/catalog/catalog-section-info-00.png';

							$website_src = '';
							if ($item['PROPERTIES']['WEBSITE']['VALUE'] != '') {
								$website_src = 'href="' . $item['PROPERTIES']['WEBSITE']['VALUE'] . '"';
							} ?>


							<a <?= $website_src ?> <?= $counter > 8 ? 'class="hidden"' : ''; ?>>
								<div class="partners-Partners-module-image">
									<img src="<?= $itemPicture ?>" alt="<?= $item['NAME']; ?>" />
								</div>
								<p class="partners-Partners-module-company"><?= $item['NAME']; ?></p>
							</a>

						<?
							$counter++;
						endforeach ?>
					</div>
					<? if ($counter > 8) : ?>
						<div class="partners-Partners-module-forward">Посмотреть весь список</div>
					<? endif ?>
				</div>

			<? endforeach ?>

		</div>
		<div class="content-block-ContentBlock-module-bottom"></div>
	</div>
</div>