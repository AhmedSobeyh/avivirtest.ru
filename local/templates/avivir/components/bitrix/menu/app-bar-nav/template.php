<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
// apre( $arResult );
?>
<?if( count($arResult) >= 1 ):?>
	<ul class="c-app-bar-nav c-app-bar__nav">

		<?foreach($arResult as $key => $arItem):?>
			<?
			// Проверка активности пункта меню
			if( $arItem['SELECTED'] )
				$active = 'is-active';
			else
				$active = '';

			// Проверка на наличие dropdown меню
			if( $arItem['PARAMS']['SUB'] == true )
			{
				$sub = 'c-app-bar-nav__dropdown';
				$subA = 'c-app-bar-nav__dropdown-toggler';
			}
			else
			{
				$sub = '';
				$subA = '';
			}
			?>

			<li class="c-app-bar-nav__item <?=$active?> <?=$sub?>" data-id="<?=$key?>">
				<a class="c-app-bar-nav__link  <?=$subA?>" href="<?=$arItem['LINK']?>"><?=$arItem["TEXT"]?></a>

				<?
				// подключаем файл .submenu_inc - там размещаем контент,
				// который предполагается в правой части выпадающего меню
				$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_RECURSIVE" => "N",
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "",
						"EDIT_TEMPLATE" => "",
						"COMPONENT_TEMPLATE" => ".default",
						"PATH" => $arItem['LINK'] . ".submenu_inc.php",
					),
					null,
					["HIDE_ICONS"=>"Y"] // важно, чтобы убрать кнопки редактирования области
				);?>

			</li>

		<?endforeach?>

	</ul>
<?endif?>
