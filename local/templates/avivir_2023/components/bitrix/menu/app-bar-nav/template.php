<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
// apre( $arResult );
?>
<? if (count($arResult) >= 1) : ?>
	<nav class="page-Header-module-links">
		<ul>
			<? foreach ($arResult as $key => $arItem) : ?>

				<li class="">
					<a href="<?= $arItem['LINK'] ?>"><?= $arItem["TEXT"] ?>
						<? // Проверка на наличие dropdown меню
						if ($arItem['PARAMS']['SUB'] == true) : ?>
							<svg width="3" height="7" viewBox="0 0 3 7" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M0.505127 2.18109e-07C0.406451 2.97906e-05 0.309996 0.0410492 0.227956 0.117874C0.145916 0.194699 0.0819746 0.303879 0.0442158 0.431612C0.00645677 0.559345 -0.00342496 0.699895 0.01582 0.835495C0.0350651 0.971096 0.0825729 1.09566 0.152337 1.19343L1.79553 3.4957L0.152338 5.79798C0.104679 5.86247 0.0666639 5.93962 0.040512 6.02491C0.0143601 6.11021 0.000594546 6.20195 1.87734e-05 6.29478C-0.000556999 6.38762 0.0120685 6.47968 0.0371585 6.5656C0.0622484 6.65152 0.0993004 6.72958 0.146152 6.79523C0.193005 6.86087 0.248718 6.91278 0.310043 6.94794C0.371368 6.98309 0.437076 7.00078 0.503332 6.99997C0.569588 6.99917 0.635066 6.97988 0.695946 6.94324C0.756825 6.9066 0.811887 6.85334 0.857918 6.78656L2.8539 3.99C2.94745 3.85889 3 3.68109 3 3.4957C3 3.31032 2.94745 3.13252 2.8539 3.00141L0.857917 0.204848C0.764359 0.0737245 0.637458 3.9784e-05 0.505127 2.18109e-07Z" fill="currentColor"></path>
							</svg>
					</a>


					<? // подключаем файл .submenu_inc - там размещаем контент,
							// который предполагается в правой части выпадающего меню
							$APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"",
								array(
									"AREA_FILE_RECURSIVE" => "N",
									"AREA_FILE_SHOW" => "file",
									"AREA_FILE_SUFFIX" => "",
									"EDIT_TEMPLATE" => "",
									"COMPONENT_TEMPLATE" => ".default",
									"PATH" => $arItem['LINK'] . ".submenu_inc.php",
								),
								null,
								["HIDE_ICONS" => "Y"] // важно, чтобы убрать кнопки редактирования области
							); ?>
					<div class="page-Header-module-holder"></div>
				<? else : ?>
					</a>
				<? endif; ?>
				</li>
			<? endforeach ?>
			<div class="page-Header-module-action">
        		<div class="page-Header-module-number">
        			<div class="hidden-Hidden-module-desktop-hidden">
                        <a href="https://en.avivir.ru/"><button class="button-Button-module-button" style="margin: 20px;">En</button></a>
                    </div>
                </div>
            </div>
		</ul>
	</nav>
	
<? endif ?>