<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//apre( $arResult );
?>

<?if( count($arResult) >= 1 ):?>
	<nav class="c-app-footer__nav">
		<ul class="c-app-footer-nav">
			<?foreach($arResult as $arItem):?>

				<?if($arItem["SELECTED"]):?>
					<li class="c-app-footer-nav__item">
						<a class="c-app-footer-nav__link is-active" href="<?=$arItem['LINK']?>">
							<?=$arItem["TEXT"]?>
						</a>
					</li>
				<?else:?>
					<li class="c-app-footer-nav__item">
						<a class="c-app-footer-nav__link" href="<?=$arItem['LINK']?>">
							<?=$arItem["TEXT"]?>
						</a>
					</li>
				<?endif?>

			<?endforeach?>
		</ul>
	</nav>
<?endif?>
