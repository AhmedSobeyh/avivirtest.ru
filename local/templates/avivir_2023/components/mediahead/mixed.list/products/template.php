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



<? foreach ($arResult['TREE'] as $section) : ?>
	<? //apre($section, $section['NAME'])
	?>

	<div class="content-block-ContentBlock-module-block products-Products-module-cards-wrapper">
		<div class="content-block-ContentBlock-module-info">
			<h2 class="content-block-ContentBlock-module-title"><?= $section['NAME'] ?></h2>
			<div class="content-block-ContentBlock-module-content products-Products-module-cards-content content-block-ContentBlock-module-last">
				<div class="products-Products-module-cards">

					<? foreach ($section['ELEMENTS'] as $item) : ?>

						<? if ($item['PREVIEW_PICTURE']['SRC'])
							$itemPicture = $item['PREVIEW_PICTURE']['SRC'];

						else
							$itemPicture = '/upload/images/catalog/catalog-section-info-00.png';
						?>

						<a href="<?= $item['DETAIL_PAGE_URL'] ?>" class="products-Products-module-card">
							<div class="products-Products-module-card-image">
								<img src="<?= $itemPicture ?>" alt="<?= $item['NAME']; ?>" />
							</div>
							<p><?= $item['NAME']; ?></p>
						</a>

					<? endforeach ?>
				</div>
				<a href="<?= $section['SECTION_PAGE_URL'] ?>"><button class="button-Button-module-button products-Products-module-button">
						Перейти в каталог
					</button></a>
			</div>
			<div class="content-block-ContentBlock-module-bottom"></div>
		</div>
	</div>
<? endforeach ?>