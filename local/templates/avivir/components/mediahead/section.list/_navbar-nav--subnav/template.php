<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

<?if( count($arResult['SECTIONS']) >= 1 ):?>

	<ul class="c-navbar-nav c-navbar-nav--subnav">
		<?foreach($arResult["SECTIONS"] as $arItem):?>
			<li class="c-navbar-nav__item c-navbar-nav__item--subnav">
				<a class="c-navbar-nav__link c-navbar-nav__link--subnav" href="<?=$arItem["SECTION_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
			</li>
		<?endforeach;?>
	</ul>

<?endif?>
