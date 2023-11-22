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

$i = 0;
?>


<? foreach ($arResult["ITEMS"] as $arItem) : ?>
	<?

	if ($arItem['ID'] == 418) {
		continue;
	}

	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

	$i++;

	$classes = '';
	$bgHolderImg = '';

	if ($i % 2 != 0) {
		$classes = 'content-block-ContentBlock-module-block services-Services-module-decor';
	} else {
		$classes = 'content-block-ContentBlock-module-block services-Services-module-reversed';
	}

    if($_SERVER['REMOTE_ADDR'] == "195.46.191.186"){
        //echo '<pre>'; print_r($arItem['PROPERTIES']['URL']['VALUE']); echo '</pre>'; die;
    }

    $url = $arItem['DETAIL_PAGE_URL'];
    if(!empty($arItem['PROPERTIES']['URL']['VALUE'])) $url = $arItem['PROPERTIES']['URL']['VALUE'];
	?>

	<div class="<?= $classes ?>">
		<div class="content-block-ContentBlock-module-info">
			<h2 class="content-block-ContentBlock-module-title"><?= $arItem['NAME'] ?></h2>
			<p class="content-block-ContentBlock-module-text">
				<?= htmlspecialchars_decode($arItem['PROPERTIES']['SERVICES_DESCRIPTION']['VALUE']['TEXT'], ENT_HTML5) ?>
			</p>
			<div class="content-block-ContentBlock-module-bottom">
				<a href="<?=$url?>"><button class="button-Button-module-button">Подробнее</button></a>
			</div>
		</div>

		<?
		if ($arItem['PREVIEW_PICTURE']['SRC'])
			$picture = $arItem['PREVIEW_PICTURE']['SRC'];

		if (!$picture)
			$picture = '/upload/images/renders/render-molecule.png';
		?>

		<? if ($picture) : ?>
			<div class="content-block-ContentBlock-module-image">
				<img class="services-Services-module-image" src="<?= $picture ?>" alt="<?= $arItem['NAME'] ?>" />
			</div>
		<? endif ?>


	</div>



<? endforeach; ?>