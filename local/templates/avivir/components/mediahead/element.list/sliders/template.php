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

foreach ($arResult['ITEMS'] as $arItem)
{	
	$intervalTime = $arItem['PROPERTIES']['INTERVAL']['VALUE']; // Интервал для слайдов
	$defaultSlide = $arItem['PROPERTIES']['DEFAULT']['VALUE']; // Слайд по умолчанию
	$activeSlide = $arItem['PROPERTIES']['SLIDES']['VALUE']; // Список слайдов
	$arElements = $activeSlide  ? $activeSlide  : $defaultSlide ;
	$arSlider = array();
	$arFilter = array("IBLOCK_ID"=>10, "ID" =>$arElements, 
	"ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
	$resList = CIBlockElement::GetList(array(), $arFilter);
	while($obList = $resList->GetNextElement())
	{
		$arListFields = $obList->GetFields();
		$arListProps = $obList->GetProperties(); // свойства элемента
		if($arListFields['ACTIVE'] == 'Y') {
			$arSlider[$arListFields["ID"]] = $arListProps; 
		} 
	}

	$loopSlide = true;
	if(count($arSlider) <= 1) {
		$loopSlide = false;
	};
}

?>
<section class="c-app-section c-app-section--density-comfortable u-bg-light-mint c-cta" >
	<div class="c-app-section__body">
		<?// START: Cta list carousel ?>
		<div class="c-cta-list-carousel" data-time-slider="<?=$intervalTime?>" data-loop-slider="<?=$loopSlide?>">
			<?// START: Carousel main container ?>
			<div class="c-carousel c-cta-list-carousel__carousel js-cta-list-carousel" id=<?=?>>
				<?// START: Additional required wrapper ?>
				<div class="c-carousel__inner">
					<?// START: Slides ?>
					<?foreach($arSlider as $arItem):?>			
						<div class="c-carousel__item c-cta-list-carousel__item">
							<div class="c-cta-list-carousel-item">
								<div class="c-cta__layout">
									<div class="c-cta__media">
										<? // START: Picture ?>
										<? $picture = $arItem['RU_PIC']['VALUE'] ? CFile::GetPath($arItem['RU_PIC']['VALUE']) : '/upload/images/renders/render-molecule.png';?>
										<?if ($picture):?>
											<picture class="c-picture o-ratio o-ratio--1x1 c-cta__picture">
												<img
													class="c-picture__img c-picture__img--contain"
													src="<?=$picture?>"
													alt="<?=$arItem['RU_TITLE']["VALUE"]?>"
												/>
											</picture>
										<?endif?>
										<? // END: Picture ?>
									</div>
									<div class="c-cta__body">
										<h2 class="c-cta__title">
											<?=$arItem['RU_TITLE']["VALUE"]?>
										</h2>

										<p class="c-cta__text">
											<?=$arItem['RU_TEXT']["VALUE"]["TEXT"];?>
										</p>

										<?// START: Button ?>
										<a
											class="c-btn c-btn--kind-primary c-btn--size-lg c-cta__btn"
											href="<?=$arItem['RU_URL']['VALUE']?>"
										>
											<span class="c-btn__overlay"></span>
											<span class="c-btn__content">
												<?=$arItem['RU_BUTTON']['VALUE']?>
											</span>
										</a>
										<?// END: Button ?>
									</div>
								</div>
							</div>
						</div>
					<?endforeach?>
					<?// END: Slides ?>
				</div>
				
				<?// END: Additional required wrapper ?>
			</div>
			<?// START: Carousel main container ?>
		</div>
		<?// END: Cta list carousel ?>
	</div>
</section>




