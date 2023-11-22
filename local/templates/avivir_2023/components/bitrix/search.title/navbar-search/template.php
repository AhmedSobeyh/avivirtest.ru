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
$this->setFrameMode(true);?>

<?
$INPUT_ID = trim($arParams["~INPUT_ID"]);
if($INPUT_ID == '')
	$INPUT_ID = "navbarSearchTextfield";
$INPUT_ID = CUtil::JSEscape($INPUT_ID);

$CONTAINER_ID = trim($arParams["~CONTAINER_ID"]);
if($CONTAINER_ID == '')
	$CONTAINER_ID = "navbarSearch";
$CONTAINER_ID = CUtil::JSEscape($CONTAINER_ID);

if($arParams["SHOW_INPUT"] !== "N"):?>
	<div class="c-navbar-search" id="<?echo $CONTAINER_ID?>">
		<?// <span class="c-navbar-search__title">Поиск</span>?>

		<form class="c-navbar-search__form" action="<?echo $arResult["FORM_ACTION"]?>">
			<input class="c-navbar-search__textfield" id="<?echo $INPUT_ID?>" type="text" name="q" value="" size="40" maxlength="50" autocomplete="off" placeholder="Я ищу..." />
			<button class="c-navbar-search__btn" name="s" type="submit"/>
				<span class="o-sr-only"><?=GetMessage("CT_BST_SEARCH_BUTTON");?></span>
			</button>
		</form>
	</div>

	<ul class="c-navbar-search-tag-list">
		<li class="c-navbar-search-tag-list__item">
			<a class="c-navbar-search-tag-list__link" href="#">#Никитин</a>
		</li>
		<li class="c-navbar-search-tag-list__item">
			<a class="c-navbar-search-tag-list__link" href="#">#Хаматова</a>
		</li>
		<li class="c-navbar-search-tag-list__item">
			<a class="c-navbar-search-tag-list__link" href="#">#Берковский</a>
		</li>
		<li class="c-navbar-search-tag-list__item">
			<a class="c-navbar-search-tag-list__link" href="#">#Кинематограф</a>
		</li>
		<li class="c-navbar-search-tag-list__item">
			<a class="c-navbar-search-tag-list__link" href="#">#Война</a>
		</li>
	</ul>
<?endif?>

<script>
	BX.ready(function(){
		new JCTitleSearch({
			'AJAX_PAGE' : '<?echo CUtil::JSEscape(POST_FORM_ACTION_URI)?>',
			'CONTAINER_ID': '<?echo $CONTAINER_ID?>',
			'INPUT_ID': '<?echo $INPUT_ID?>',
			'MIN_QUERY_LEN': 2
		});
	});
</script>
