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

//apre( $arResult );
?>

<?if( count($arResult['SECTIONS']) >= 1 ):?>
	<div class="c-video-section-list">
		<div class="o-container@md c-video-section-list__container">
			<ul class="c-video-section-list__layout">

				<?foreach( $arResult['SECTIONS'] as $arItem ):?>

					<?
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					$section = false;
					if ($arItem['SECTION_ID'])
						$section = $arResult['SECTIONS'][$arItem['SECTION_ID']];
					?>

					<li class="c-video-section-list__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
						<div class="c-video-section-list-item">
							<div class="o-embed-responsive o-embed-responsive--1by1 c-video-section-list-item__media">
								<?if( $arItem['PICTURE']['SRC'] )
									$picture = $arItem['PICTURE']['SRC'];
								else
									$picture = '/upload/img_none/poems.jpg';
								?>
								<img class="o-embed-responsive__item c-video-section-list-item__img" src="<?=$picture?>" alt="<?=$arItem['NAME']?>">
							</div>
							<div class="c-video-section-list-item__body">
								<h3 class="c-video-section-list-item__title">
									<a class="o-stretched-link c-video-section-list-item__title-link" href="<?=$arItem['SECTION_PAGE_URL']?>">
										<?=$arItem['NAME']?>
									</a>
								</h3>
							</div>
						</div>
					</li>

				<?endforeach?>

			</ul>
		</div>
	</div>
<?endif?>
