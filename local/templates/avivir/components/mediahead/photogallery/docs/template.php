<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);

//apre($arResult["ITEMS"]);
?>

<?if( count($arResult["ITEMS"]) >= 1 ):?>
	<ul class="c-document-list">
		<?foreach($arResult["ITEMS"] as $key => $item):?>
			<li class="c-document-list__item">
				<?if($arParams["USE_ZOOM"]):?>
					<a class="c-document-list-item" href="<?=$item['DATA']['BIG']?>" data-fancybox="gallery">
				<?endif?>

				<picture class="c-picture">
					<img
						class="c-picture__img c-picture__img--contain"
						src="<?=$item['DATA']['MINI']['SRC']?>"
						alt="<?=$image['EXTERNAL_ID']?>"
					/>
				</picture>

				<?if($arParams["USE_ZOOM"]):?>
					</a>
				<?endif?>
			</li>
		<?endforeach?>
	</ul>
<?endif?>
