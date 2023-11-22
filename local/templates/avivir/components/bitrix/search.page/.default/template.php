<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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
?>

<main class="с-search-page">
	<div class="с-searchbar с-search-page__searchbar">
		<div class="o-container@md с-searchbar__container">
			<form class="с-searchbar__form" action="" method="get">
				<?if($arParams["USE_SUGGEST"] === "Y"):
					if(mb_strlen($arResult["REQUEST"]["~QUERY"]) && is_object($arResult["NAV_RESULT"]))
					{
						$arResult["FILTER_MD5"] = $arResult["NAV_RESULT"]->GetFilterMD5();
						$obSearchSuggest = new CSearchSuggest($arResult["FILTER_MD5"], $arResult["REQUEST"]["~QUERY"]);
						$obSearchSuggest->SetResultCount($arResult["NAV_RESULT"]->NavRecordCount);
					}
					?>
					<?$APPLICATION->IncludeComponent(
						"bitrix:search.suggest.input",
						"",
						array(
							"NAME" => "q",
							"VALUE" => $arResult["REQUEST"]["~QUERY"],
							"INPUT_SIZE" => 40,
							"DROPDOWN_SIZE" => 10,
							"FILTER_MD5" => $arResult["FILTER_MD5"],
						),
						$component, array("HIDE_ICONS" => "Y")
					);?>
				<?else:?>

					<input class="с-searchbar__textfield" type="text" name="q" value="<?=$arResult["REQUEST"]["QUERY"]?>" size="40" placeholder="Я ищу..." />

				<?endif;?>

					<button class="с-searchbar__btn" type="submit"/>
						<span class="o-sr-only"><?=GetMessage("SEARCH_GO")?></span>
					</button>

					<input type="hidden" name="how" value="<?echo $arResult["REQUEST"]["HOW"]=="d"? "d": "r"?>" />

			</form>

			<ul class="с-searchbar-tag-list с-searchbar__tag-list">
				<li class="с-searchbar-tag-list__item">
					<a class="с-searchbar-tag-list__link" href="#">#Никитин</a>
				</li>
				<li class="с-searchbar-tag-list__item">
					<a class="с-searchbar-tag-list__link" href="#">#Хаматова</a>
				</li>
				<li class="с-searchbar-tag-list__item">
					<a class="с-searchbar-tag-list__link" href="#">#Берковский</a>
				</li>
				<li class="с-searchbar-tag-list__item">
					<a class="с-searchbar-tag-list__link" href="#">#Кинематограф</a>
				</li>
				<li class="с-searchbar-tag-list__item">
					<a class="с-searchbar-tag-list__link" href="#">#Война</a>
				</li>
			</ul>
		</div>
	</div>

	<?if(isset($arResult["REQUEST"]["ORIGINAL_QUERY"])):
		?>
		<div class="search-language-guess">
			<?echo GetMessage("CT_BSP_KEYBOARD_WARNING", array("#query#"=>'<a href="'.$arResult["ORIGINAL_QUERY_URL"].'">'.$arResult["REQUEST"]["ORIGINAL_QUERY"].'</a>'))?>
		</div><br /><?
	endif;?>

	<?if($arResult["REQUEST"]["QUERY"] === false && $arResult["REQUEST"]["TAGS"] === false):?>

	<?elseif($arResult["ERROR_CODE"]!=0):?>
		<p><?=GetMessage("SEARCH_ERROR")?></p>
		<?ShowError($arResult["ERROR_TEXT"]);?>
		<p><?=GetMessage("SEARCH_CORRECT_AND_CONTINUE")?></p>
		<br /><br />
		<p><?=GetMessage("SEARCH_SINTAX")?><br /><b><?=GetMessage("SEARCH_LOGIC")?></b></p>
		<table border="0" cellpadding="5">
			<tr>
				<td align="center" valign="top"><?=GetMessage("SEARCH_OPERATOR")?></td><td valign="top"><?=GetMessage("SEARCH_SYNONIM")?></td>
				<td><?=GetMessage("SEARCH_DESCRIPTION")?></td>
			</tr>
			<tr>
				<td align="center" valign="top"><?=GetMessage("SEARCH_AND")?></td><td valign="top">and, &amp;, +</td>
				<td><?=GetMessage("SEARCH_AND_ALT")?></td>
			</tr>
			<tr>
				<td align="center" valign="top"><?=GetMessage("SEARCH_OR")?></td><td valign="top">or, |</td>
				<td><?=GetMessage("SEARCH_OR_ALT")?></td>
			</tr>
			<tr>
				<td align="center" valign="top"><?=GetMessage("SEARCH_NOT")?></td><td valign="top">not, ~</td>
				<td><?=GetMessage("SEARCH_NOT_ALT")?></td>
			</tr>
			<tr>
				<td align="center" valign="top">( )</td>
				<td valign="top">&nbsp;</td>
				<td><?=GetMessage("SEARCH_BRACKETS_ALT")?></td>
			</tr>
		</table>
	<?elseif(count($arResult["SEARCH"])>0):?>

	<div class="с-search-page-list с-search-page__list">
		<div class="o-container@md с-search-page-list__container">

				<?apre($arResult["SEARCH"], 'search')?>

				<div class="с-search-page-list__section">
					<h2 class="с-search-page-list__title">Заголовок раздела</h2>

					<div class="с-search-page-list__list">

						<?foreach($arResult["SEARCH"] as $arItem):?>

							<div class="с-search-page-list-item с-search-page-list__item">
								<div class="с-search-page-list-item__container">
									<div class="с-search-page-list-item__media">

									</div>

									<div class="с-search-page-list-item__body">
										<h3 class="с-search-page-list-item__title">
											<a class="с-search-page-list-item__title-link" href="<?echo $arItem["URL"]?>"><?echo $arItem["TITLE_FORMATED"]?></a>
										</h3>

										<p class="с-search-page-list-item__text"><?echo $arItem["BODY_FORMATED"]?></p>
									</div>

									<div class="с-search-page-list-item__footer">
										<? if($arItem["CHAIN_PATH"]):?>
											<span class="с-search-page-list-item__section"><?=$arItem["CHAIN_PATH"]?></span>
										<?endif;?>

										<time class="с-search-page-list-item__date"><?=$arItem["DATE_CHANGE"]?></time>
									</div>
								</div>
							</div>

						<?endforeach;?>

					</div>
				</div>

			</div>
		</div>

	<?else:?>
		<?ShowNote(GetMessage("SEARCH_NOTHING_TO_FOUND"));?>
	<?endif;?>
</main>
