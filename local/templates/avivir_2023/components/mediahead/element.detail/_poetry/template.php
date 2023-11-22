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

<div class="c-poetry-detail">
	<div class="c-poetry-detail-text c-poetry-detail__text">
		<div class="o-container@md c-poetry-detail-text__container">
			<p class="c-poetry-detail-text__content u-ff-secondary">
				<?=$arResult["DETAIL_TEXT"];?>
			</p>

			<?if ($arResult["TRANSLATE"]):?>

				<div class="c-poetry-detail-translation c-poetry-detail__translation">
					<h3 class="c-poetry-detail-translation__title">Доступные переводы</h3>

					<div class="c-poetry-detail-translation__list">

						<?//apre($arResult['TRANSLATE'], 'translate')?>

						<?foreach($arResult["TRANSLATE"] as $arItem):?>

							<?
							$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
							$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

							if ($arItem['AUTHOR_NAME']) {
								$translationAuthor = $arItem['AUTHOR_NAME'];
							} else {
								$translationAuthor = 'Автор не известен';
							}
							?>

							<div class="c-poetry-detail-translation__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
								<h4 class="c-poetry-detail-translation__subtitle">
									<button class="c-poetry-detail-translation-toggle" type="button" data-toggle="collapse">
										Перевод на <?=strtolower($arItem['LANGNAME']) . ', ' . $translationAuthor?>
									</button>
								</h4>

								<div class="o-collapse">
									<div class="c-poetry-detail-translation__body">
										<p class="c-poetry-detail-text__content u-ff-secondary">
											<?=$arItem['DETAIL_TEXT']?>
										</p>
									</div>
								</div>
							</div>

						<?endforeach?>

					</div>
				</div>

			<?endif?>
		</div>

		<?$section = $arResult['SECTION']['PATH'][0]?>
		<?if (!empty($section)):?>
			<div class="o-decor-divider"></div>

			<div class="c-poetry-detail-section c-poetry-detail__section">
				<a class="c-poetry-detail-section__link u-ff-secondary" href="<?=$section["SECTION_PAGE_URL"]?>">
					<?=$section["NAME"]?><?if ($arResult['SECTION']['UF'][$section['ID']]['UF_YEAR']):?>, <?endif?><?=$arResult['SECTION']['UF'][$section['ID']]['UF_YEAR']?>
				</a>
			</div>
		<?endif?>

	</div>


	<?if (!empty($arResult["PLAYER"])):?>

		<?
		if (!empty($arResult["PLAYER"]["AUTHOR"]))
			$firstElement = $arResult["PLAYER"]["AUTHOR"][0];
		else
			$firstElement = $arResult["PLAYER"]["OTHER"][0];
		?>

		<div class="c-poetry-detail-media c-poetry-detail__media">
			<div class="o-container@md c-poetry-detail-media__container">
				<h2 class="c-poetry-detail-media__title">Из нашей медиатеки</h2>

				<?// START: Media player ?>
				<div class="c-media-player c-poetry-detail-media__player">

					<?// START: Media player current ?>
					<div class="c-media-player-current c-media-player__current">

						<?if ( $firstElement['TYPE'] == 'VIDEO' ):?>
							<div class="js-media-player-current-container">
								<video poster="<?=$firstElement['PHOTO']['SRC']?>" preload="metadata">
									<source src="<?=$firstElement['VIDEO_NO_HTTP']?>" type="video/youtube" />
								</video>
							</div>
						<?else:?>
							<div class="js-media-player-current-container">
								<div class="o-embed-responsive o-embed-responsive--16by9 c-media-player-current-placeholder c-media-player-current__placeholder <?//is-active?>">
									<div class="o-embed-responsive__item">
										<img class="c-media-player-current-placeholder__bg" src="<?=SITE_TEMPLATE_PATH?>/assets/images/player/player-bg.jpg" alt="Фон плеера">
										<img class="c-media-player-current-placeholder__base" src="<?=SITE_TEMPLATE_PATH?>/assets/images/player/player-base.png" alt="Плеер">
										<img class="c-media-player-current-placeholder__bobbin c-media-player-current-placeholder__bobbin--left" src="<?=SITE_TEMPLATE_PATH?>/assets/images/player/player-bobbin-left.png" alt="Левая катушка">
										<img class="c-media-player-current-placeholder__bobbin c-media-player-current-placeholder__bobbin--right" src="<?=SITE_TEMPLATE_PATH?>/assets/images/player/player-bobbin-right.png" alt="Правая катушка">
										<div class="c-media-player-current-placeholder__led"></div>

										<button class="c-media-player-current-placeholder__play-btn"></button>
									</div>
								</div>

								<audio width="100%" controls="controls" preload="metadata" src="<?=$firstElement["AUDIO"]["SRC"]?>" type="audio/mp3">
									<track src="<?=$firstElement["AUDIO"]["SRC"]?>" label="<?=$firstElement["AUDIO"]["NAME"]?>" srclang="ru" />
								</audio>
							</div>
						<?endif?>

					</div>
					<?// END: Media player current ?>


					<?// START: Media player playlist ?>
					<div class="c-media-player-playlist c-media-player__playlist js-perfect-scrollbar">

						<?//apre( $arResult["PLAYER"] )?>

						<?foreach($arResult["PLAYER"] as $playListCotegory => $playList):?>

							<?if ( $playListCotegory == 'AUTHOR' ):?>
								<h3 class="c-media-player-playlist__title u-ff-primary">Читает автор</h3>
							<?elseif ( $playListCotegory == 'OTHER' && !empty($arResult["PLAYER"]["AUTHOR"]) ):?>
								<h3 class="c-media-player-playlist__title u-ff-primary">Другие исполнения</h3>
							<?endif?>

							<ul class="c-media-player-playlist__list">

								<?foreach($playList as $i => $arItem):?>

									<?if ($arItem['TYPE'] == 'AUDIO'):?>
										<li
											data-id="<?=$arItem['ID']?>"
											data-type="AUDIO"
											data-src="<?=$arItem["AUDIO"]["SRC"]?>"
											data-poster="<?=SITE_TEMPLATE_PATH?>/assets/images/placeholder/placeholder-player-audio.jpg"
											data-name="<?=$arItem["NAME"]?>"

											class="c-media-player-playlist-item c-media-player-playlist__item"
										>
											<span class="c-media-player-playlist-item-type c-media-player-playlist-item__type">
												<span class="c-media-player-playlist-item-type__icon c-media-player-playlist-item-type__icon--audio"></span>
												<span class="c-media-player-playlist-item-type__text">аудио</span>
											</span>

											<h4 class="c-media-player-playlist-item__title u-ff-primary"><?=$arItem["NAME"]?></h4>

											<a href="<?=$arItem["AUDIO"]["SRC"]?>" target="_blank" class="c-media-player-playlist-item-download c-media-player-playlist-item-download__link c-media-player-playlist-item__download" download="<?=$arItem['NAME']?>.mp3">
												<span class="c-media-player-playlist-item-download__icon"></span>
												mp3
											</a>
										</li>
									<?endif?>

									<?if ($arItem['TYPE'] == 'VIDEO'):?>
										<?
										if( $arItem['PHOTO']['SRC'] )
											$picture = $arItem['PHOTO']['SRC'];
										else
											$picture = SITE_TEMPLATE_PATH.'/assets/images/placeholder/placeholder-player-video.jpg';
										?>

										<li
											data-id="<?=$arItem['ID']?>"
											data-type="VIDEO"
											data-src="<?=$arItem["VIDEO_NO_HTTP"]?>"
											data-poster="<?=$picture?>"
											data-name="<?=$arItem["NAME"]?>"

											class="c-media-player-playlist-item c-media-player-playlist-item--video c-media-player-playlist__item"
										>

											<div class="o-embed-responsive o-embed-responsive--16by9 c-media-player-playlist-item__media">
												<img class="o-embed-responsive__item c-media-player-playlist-item__img" src="<?=$picture?>" alt="<?=$arItem["NAME"]?>">
											</div>

											<div class="c-media-player-playlist-item__body">
												<h4 class="c-media-player-playlist-item__title c-media-player-playlist-item__title--video u-ff-primary"><?=$arItem["NAME"]?></h4>

												<?/**
												 * Здесь нужно вывести чтеца (наверное PREVIEW_TEXT)
												 * */ ?>
												<?if ($playListCotegory == 'AUTHOR'):?>
													<span class="c-media-player-playlist-item__author">Читает Юрий Левитанский</span>
												<?endif?>
											</div>
										</li>
									<?endif?>

								<?endforeach?>

							</ul>
						<?endforeach?>

					</div>
					<?// END: Media player playlist ?>

				</div>
				<?// END: Media player ?>

			</div>
		</div>

	<?endif?>

</div>
