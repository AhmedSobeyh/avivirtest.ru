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

<section class="c-main-page-audio-list">
	<h2 class="c-main-page-audio-list__title">Читает автор</h2>

	<div class="c-main-page-audio-list__panel">
		<div style="width: 100%; min-height: 264px;">
			
			<div class="c-audio-list" <?=!$arResult["HEAD"]["IMAGE"]["src"] ? 'style="padding-top: 0;"' : ''?>> 
				<div class="o-container@md c-audio-list__container">
					<div class="c-audio-list__layout" <?=!$arResult["HEAD"]["IMAGE"]["src"] ? 'style="padding-top: 0;"' : ''?>>
						
						<?if ($arResult["HEAD"]["IMAGE"]["src"]):?>
							<div class="o-embed-responsive o-embed-responsive--1by1 c-audio-list__cover">
								<img class="o-embed-responsive__item c-audio-list__img" src="<?=$arResult["HEAD"]["IMAGE"]["src"]?>" />
							</div>
						<?endif?> 
			
						<div class="c-audio-list__body">
							<p class="c-audio-list__lead"><?=$arResult["HEAD"]["DESCRIPTION"]?></p>
			
							<ul class="c-audio-list__list">
			
								<li class="c-audio-list-item c-audio-list__item">
		
									<a name="<?=$arResult["AUDIO"]["CODE"]?>"></a>
		
									<div name="<?=$arResult["AUDIO"]["CODE"]?>" class="c-audio-list-item__title">
										<?=$arResult["AUDIO"]["NAME"]?>
									</div>
		
									<div class="c-audio-list-item__container">
										<div class="c-audio-list-item__player">
		
											<audio width="100%" controls="controls" preload="metadata" src="<?=$arResult["AUDIO"]["SRC"]?>" type="audio/mp3">
												<track src="<?=$arResult["AUDIO"]["SRC"]?>" label="<?=$arResult["AUDIO"]["NAME"]?>" srclang="ru" />
											</audio>
										</div>
		
										<a href="<?=$arResult["AUDIO"]["SRC"]?>" target="_blank" class="c-audio-list-item-download c-audio-list-item-download__link c-audio-list-item__download" download="<?=$arResult["AUDIO"]['NAME']?>.mp3">
											<span class="c-audio-list-item-download__icon"></span>mp3
										</a>
									</div>
								</li>
			
							</ul>
						</div>
					</div>
				</div>
			</div>
			
		</div>

		<div class="c-main-page-audio-list__list c-main-page-audio-list__list--fake">
			<div class="c-main-page-audio-list-item c-main-page-audio-list__item">
				<div class="c-main-page-audio-list-item__title">Запись журнала Кругозор. 3 стихотворения</div>

				<div class="c-main-page-audio-list-item__container">
					<div class="c-main-page-audio-list-item__player">
						<div class="mejs__container mejs__container-keyboard-inactive mejs__audio">
							<div class="mejs__inner">
								<div class="mejs__layers">
									<div class="mejs__poster mejs__layer" style="display: none;"></div>
								</div>
								<div class="mejs__controls">
									<div class="mejs__button mejs__playpause-button mejs__play">
										<button tabindex="0"></button>
									</div>
									<div class="mejs__time">
										<span class="mejs__currenttime">00:00</span> / <span class="mejs__duration">05:32</span>
									</div>
									<div class="mejs__time-rail">
										<span class="mejs__time-total mejs__time-slider" tabindex="0"><span class="mejs__time-buffering" style="display: none;"></span><span class="mejs__time-loaded"></span><span class="mejs__time-current" style="transform: scaleX(0);"></span><span class="mejs__time-hovered no-hover" style="left: 0px; transform: scaleX(0);"></span><span class="mejs__time-handle" style="transform: translateX(0);"><span class="mejs__time-handle-content"></span></span><span class="mejs__time-float" style="display: none; left: 27px;"><span class="mejs__time-float-current">00:23</span><span class="mejs__time-float-corner"></span></span></span>
									</div>
								</div>
							</div>
						</div>
					</div>

					<span class="c-main-page-audio-list-download c-main-page-audio-list-download__link c-main-page-audio-list__download">
						<span class="c-main-page-audio-list-download__icon"></span>mp3
					</span>
				</div>
			</div>
		</div>

		<a class="c-btn c-btn--lg c-btn--icon-right c-btn--outline-secondary c-main-page-audio-list__more-link" href="/mediateka/audio/chitaet-yuriy-levitanskiy/">
			<svg class="o-svg-inline c-btn__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300 512">
				<path fill="currentColor" d="M12.3,75.4C-4,59-3.9,32.3,12.3,16l3.7-3.7C32.3-4.1,58.6-4.2,75.1,12.4l212.6,213.8c16.4,16.4,16.5,43,0,59.6 L75.1,499.7c-16.4,16.4-42.9,16.4-59.1,0.1l-3.7-3.7c-16.3-16.4-16.4-42.9,0-59.4L191.8,256L12.3,75.4z" />
			</svg>
			<span class="c-btn__text">Послушать еще</span>
		</a>
	</div>
</section>
