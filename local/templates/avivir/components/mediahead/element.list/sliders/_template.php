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


	<section class="c-app-section c-app-section--density-comfortable u-bg-light-mint c-cta">
			<div class="c-app-section__body">
				<?// START: Cta list carousel ?>
				<div class="c-cta-list-carousel">
					<?// START: Carousel main container ?>
					<div class="c-carousel c-cta-list-carousel__carousel js-cta-list-carousel">
						<?// START: Additional required wrapper ?>
						<div class="c-carousel__inner">
							<?// START: Slides ?>
							<?foreach($arResult['ITEMS'] as $arItem):?>
								<?
									$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
									$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

									$i++;

									$bgHolderImg = '';

									if ($i % 2 != 0) 
									{
										$bgHolderImg = 'bg-plus-grid-color-primary-02.svg';
									} 
									else 
									{
										$bgHolderImg = 'bg-plus-grid-color-primary-01.svg';
									}
									?>
								<div class="c-carousel__item c-cta-list-carousel__item">
									<div class="c-cta-list-carousel-item">
										<div class="c-cta__layout">
											<div class="c-cta__media">
												<? // START: Picture ?>
												<? 
												if ( $arItem['PROPERTIES']['RU_PIC']['VALUE'] )
													$picture = CFile::GetPath($arItem['PROPERTIES']['RU_PIC']['VALUE']);

												if ( !$picture )
													$picture = '/upload/images/renders/render-molecule.png';
												?>

												<?if ($picture):?>
													<picture class="c-picture o-ratio o-ratio--1x1 c-cta__picture">
														<img
															class="c-picture__img c-picture__img--contain"
															src="<?=$picture?>"
															alt="<?=$arItem['NAME']?>"
														/>
													</picture>

												<?endif?>
												<? // END: Picture ?>
											</div>
											<div class="c-cta__body">
												<h2 class="c-cta__title">
													<?=$arItem['PROPERTIES']['RU_TITLE']['VALUE']?>
												</h2>

												<p class="c-cta__text">
													<?=$arItem['PROPERTIES']['RU_TEXT']["VALUE"]["TEXT"];?>
												</p>

												<?// START: Button ?>
												<a
													class="c-btn c-btn--kind-primary c-btn--size-lg c-cta__btn"
													href="<?=$arItem['PROPERTIES']['RU_URL']['VALUE']?>"
												>
													<span class="c-btn__overlay"></span>
													<span class="c-btn__content">
														<?=$arItem['PROPERTIES']['RU_BUTTON']['VALUE']?>
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




