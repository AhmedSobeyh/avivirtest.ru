<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!empty($arResult["CATEGORIES"]) && $arResult['CATEGORIES_ITEMS_EXISTS']):?>

	<div class="c-navbar-search-suggest">

		<?foreach($arResult["CATEGORIES"] as $category_id => $arCategory):?>

			<?//apre($arCategory)?>

			<div class="c-navbar-search-suggest-section c-navbar-search-suggest__section">

				<?if($arCategory["TITLE"] && count($arCategory["ITEMS"])):?>

					<span class="c-navbar-search-suggest-section__title">
						<?echo $arCategory["TITLE"]?>
					</span>

				<?endif?>

				<?foreach($arCategory["ITEMS"] as $i => $arItem):?>

					<?if($category_id === "all"):?>

						<a class="c-navbar-search-suggest__all" href="<?echo $arItem["URL"]?>"><?echo $arItem["NAME"]?></a>

					<?elseif(isset($arItem["ICON"])):?>

						<div class="title-search-item">
							<a class="c-navbar-search-suggest-section__link" href="<?echo $arItem["URL"]?>">
								<img class="c-navbar-search-suggest-section__img" src="<?echo $arItem["ICON"]?>" <?=$arItem["ICON"] == 'audio' ? 'class="audio"' : '';?>><?echo $arItem["NAME"]?>
							</a>
						</div>

					<?else:?>

						<a class="c-navbar-search-suggest-section__link" href="<?echo $arItem["URL"]?>"><?echo $arItem["NAME"]?></a>

					<?endif;?>

				<?endforeach;?>

			</div>
		<?endforeach;?>

	</div>

<?endif;?>
