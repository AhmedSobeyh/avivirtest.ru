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

// if ($USER->IsAdmin()) {

// 	echo "<pre>";
// 	print_r($arResult);
// 	echo "</pre>";
// } 

?>


<? foreach ($arResult["ITEMS"] as $arItem) : ?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="product-item-ProductItem-module-card">
		<div class="product-item-ProductItem-module-meta">
			<? if ($arItem['PREVIEW_PICTURE']['SRC'])
				$itemPicture = $arItem['PREVIEW_PICTURE']['SRC'];

			else
				$itemPicture = '/upload/images/catalog/catalog-section-page-header-00.png';
			?>
			<img class="product-item-ProductItem-module-image" src="<?= $itemPicture ?>" />
			<div class="product-item-ProductItem-module-info">
				<h3><?= $arItem['NAME']; ?></h3>
				<p>
					<?= $arItem['PREVIEW_TEXT'] ?>
				</p>
			</div>
		</div>
		<div class="product-item-ProductItem-module-action">
			<div class="hidden-Hidden-module-mobile-hidden">
				<div><button class="button-Button-module-button">Подробнее</button></div>
			</div>
			<div class="hidden-Hidden-module-desktop-hidden">
				<div class="product-item-ProductItem-module-forward">Перейти</div>
			</div>
		</div>
	</a>
<? endforeach; ?>