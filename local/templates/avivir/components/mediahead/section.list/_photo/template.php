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
	<div class="c-photo-section-list">
		<div class="o-container@md c-photo-section-list__container">
			<ul class="c-photo-section-list__layout">

				<?foreach( $arResult['SECTIONS'] as $arItem ):?>

					<li class="c-photo-section-list__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
						<?/** START: Photo section list item */?>
						<div class="o-image-stack o-image-stack--animated c-photo-section-list-item">
							<div class="o-image-stack__container">
								<?
								if( $arItem['PICTURE']['SRC'] )
									$picture = $arItem['PICTURE']['SRC'];
								else
									$picture = '/upload/img_none/poems.jpg';
								?>
								<img class="o-image-stack__img" src="<?=$picture?>" alt="<?=$arItem['NAME']?>">
								<img class="o-image-stack__img" src="<?=$picture?>" alt="<?=$arItem['NAME']?>">
								<img class="o-image-stack__img" src="<?=$picture?>" alt="<?=$arItem['NAME']?>">
							</div>
							<div class="c-photo-section-list-item__body">
								<h3 class="c-photo-section-list-item__title">
									<a class="o-stretched-link c-photo-section-list-item__link" href="<?=$arItem['SECTION_PAGE_URL']?>"><?=$arItem['NAME']?></a>
								</h3>
							</div>
						</div>
						<?/** END: Photo section list item */?>
					</li>

				<?endforeach?>

			</ul>
		</div>
	</div>
<?endif?>
