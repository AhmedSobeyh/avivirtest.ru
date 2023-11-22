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

// GetMessage('MD_MEDIA_HEADER');
?>

<?
$data = json_encode($arResult["DATA"], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP);

$data = str_replace('\u0026quot;', '\"', $data) //От двойных кавычек не спасал ни json_encode, ни str_replace(), ни addslashes()...


?>

<div class="content-block-ContentBlock-module-block media-Media-module-block">
	<div class="content-block-ContentBlock-module-info">
		<h2 class="content-block-ContentBlock-module-title"><?= $arParams['HEADER'] ?></h2>
		<div class="content-block-ContentBlock-module-content media-Media-module-news">
			<div class="initial-news" data-news-count='<?= $arParams['AJAX_SECTIONS_CODE'] ?>' data-sections='<?= json_encode($arParams['AJAX_SECTIONS_CODE']) ?>' data-news='<?= $data ?>'></div>
			<div class="hidden-Hidden-module-mobile-hidden">
				<div class="media-Media-module-column"></div>
				<div class="media-Media-module-column"></div>
				<div class="media-Media-module-column"></div>
				<div class="media-Media-module-column"></div>
			</div>
			<div class="hidden-Hidden-module-desktop-hidden">
				<div class="media-Media-module-column"></div>
			</div>
			<div class="media-Media-module-next" id="<?= $arParams["LOAD_ID"] ?>">
				<p>Загрузить ещё</p>
				<svg width="33" height="9" viewBox="0 0 33 9" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M1 1L16.5 7L32 1" stroke="currentColor" stroke-width="2"></path>
				</svg>
			</div>
		</div>
		<div class="content-block-ContentBlock-module-bottom"></div>
	</div>
</div>