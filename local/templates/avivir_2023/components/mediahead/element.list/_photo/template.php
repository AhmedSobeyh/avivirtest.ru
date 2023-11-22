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

<div class="c-photo-list">
	<div class="o-container@md c-photo-list__container">
		<ul class="c-photo-list__layout js-masonry-layout js-photoswipe-gallery" itemscope itemtype="http://schema.org/ImageGallery">

		<?foreach($arResult["ITEMS"] as $arItem):?>

			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			$section = false;
			if ($arItem['SECTION_ID'])
				$section = $arResult['SECTIONS'][$arItem['SECTION_ID']];
			?>

			<li class="c-photo-list__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>" name="<?=$arItem["CODE"]?>">
				<a name="<?=$arItem["CODE"]?>"></a> 
				<?/** START: Photo list item */?>
				<figure class="c-photo-list-item">
					<a class="o-stretched-link c-photo-list-item__link" href="<?=$arItem['DETAIL_PICTURE']['SRC']?>" data-toggle="photoswipe" data-size="<?=$arItem['DETAIL_PICTURE']['WIDTH']?>x<?=$arItem['DETAIL_PICTURE']['HEIGHT']?>" itemprop="contentUrl">
						<img class="c-photo-list-item__img" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>" width="<?=$arItem['PREVIEW_PICTURE']['WIDTH']?>" height="<?=$arItem['PREVIEW_PICTURE']['HEIGHT']?>" itemprop="thumbnail">
					</a>
					<figcaption class="c-photo-list-item__caption">
						<?=$arItem['NAME']?>
					</figcaption>
				</figure>
				<?/** END: Photo list item */?>
			</li>

		<?endforeach?>

		</ul>
	</div>
</div>

<?$this->SetViewTarget('photoswipe');?>
   <?// Root element of PhotoSwipe. Must have class pswp.?>
	<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

		<?// Background of PhotoSwipe.
			// It's a separate element as animating opacity is faster than rgba().?>
		<div class="pswp__bg"></div>

		<?// Slides wrapper with overflow:hidden.?>
		<div class="pswp__scroll-wrap">

			<?// Container that holds slides.
				// PhotoSwipe keeps only 3 of them in the DOM to save memory.
				// Don't modify these 3 pswp__item elements, data is added later on.?>
			<div class="pswp__container">
				<div class="pswp__item"></div>
				<div class="pswp__item"></div>
				<div class="pswp__item"></div>
			</div>

			<?// Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed.?>
			<div class="pswp__ui pswp__ui--hidden">

				<div class="pswp__top-bar">

					<?//  Controls are self-explanatory. Order can be changed.?>

					<div class="pswp__counter"></div>

					<button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

					<button class="pswp__button pswp__button--share" title="Share"></button>

					<button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

					<button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

					<?// Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR?>
					<?// element will get class pswp__preloader--active when preloader is running?>
					<div class="pswp__preloader">
						<div class="pswp__preloader__icn">
						<div class="pswp__preloader__cut">
							<div class="pswp__preloader__donut"></div>
						</div>
						</div>
					</div>
				</div>

				<div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
					<div class="pswp__share-tooltip"></div>
				</div>

				<button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
				</button>

				<button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
				</button>

				<div class="pswp__caption">
					<div class="pswp__caption__center"></div>
				</div>

			</div>

		</div>

	</div>
<?$this->EndViewTarget();?>
