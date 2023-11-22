<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);

//pre($arResult["ITEMS"]);
?>

<?if( count($arResult["ITEMS"]) >= 1 ):?>

	<div class="gallery_default">
		<?if( $arResult["TITLE"] ):?>
			<h2><?=$arResult["TITLE"]?></h2>
		<?endif?>
		
		<div class="gallery">
			<ul>
				<?foreach($arResult["ITEMS"] as $key => $item):?>
					
					<?// PHOTO?>
					<?if( $item["TYPE"] == "PHOTO" ):?>
						<li>
							<a href="<?=$item['DATA']['BIG']?>" data-fancybox="gallery" data-caption="<?=$item['DATA']['DESC']?>"><div class="imgg" style="background-image: url(<?=$item['DATA']['MINI']['SRC']?>);">
								<?if( $item["DATA"]["DESC"] ):?>
									<div class="desc"><?=$item["DATA"]["DESC"]?></div>
								<?endif?>
							</div></a>
						</li>
					
					<?// VIDEO?>
					<?elseif( $item["TYPE"] == "VIDEO" ):?>
						<li class="video">
							<a href="<?=$item['DATA']['LINK']?>" data-fancybox="gallery" data-type="iframe"><div class="imgg" style="background-image: url(<?=$item['DATA']['MINI']['SRC']?>);">
							</div></a>
						</li>
					
					<?// YOUTUBE?>
					<?elseif( $item["TYPE"] == "YOUTUBE" ):?>
						<li class="youtube">
							<a href="https://www.youtube.com/embed/<?=$item['DATA']?>" data-fancybox="gallery"><iframe width="100%" height="100%" src="https://www.youtube.com/embed/<?=$item['DATA']?>?rel=0&showinfo=0&disablekb=1&modestbranding=0&fs=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></a>
						</li>
					<?endif?>
					
				<?endforeach?>
			</ul>
		</div>
		
		<?if( count($arResult["ITEMS"]) >= 5 ):?>
			<div class="nav_but">
				<div class="prev nav_b"></div>
				<div class="next nav_b"></div>
			</div>
		<?endif?>
		
	</div>

<?endif?>
