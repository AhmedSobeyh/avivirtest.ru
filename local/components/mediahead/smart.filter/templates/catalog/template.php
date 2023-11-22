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
$arContinue = array();
?>

<div class="filter_wr">
	<div class="filter_wr_center">
		
		<div id="tabs1" class="filter filter_hidden">
		    <div class="container">
		        <? foreach ($arResult["ITEMS"] as $key=>$arItem) : ?>
		        	<?$arCur = current($arItem["VALUES"]);?>
		        	<? if ($arItem["CODE"] == "type_bargain") : ?>
						<ul class="filter__tabs">
							<?
							foreach ($arItem["VALUES"] as $val => $ar):
								$class = "";
								if ($ar["CHECKED"])
									$class.= " ui-tabs-active";
								if ($ar["DISABLED"])
									$class.= " disabled";
							?>
								<li class="ui-tabs-tab ui-corner-top ui-state-default ui-tab ui-state-hover <?=$class?> ui-state-active">
									<a class="ui-tabs-anchor" data-role="label_<?=$ar["CONTROL_ID"]?>" onclick="smartFilter.selectDropDownItemMobile('<?=CUtil::JSEscape($ar["CONTROL_ID"])?>','<?=$key?>')"><?=$ar["VALUE"]?></a>
								</li>
							<?endforeach?>
						</ul>
		        	<? endif; ?>
		        <? endforeach; ?>
		    	<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="form smartfilter horizontal" id="smartfilter">
					<?foreach($arResult["HIDDEN"] as $arItem):?>
						<input type="hidden" name="<?echo $arItem["CONTROL_NAME"]?>" id="<?echo $arItem["CONTROL_ID"]?>" value="<?echo $arItem["HTML_VALUE"]?>" />
					<?endforeach;?>
					<div class="filter__head">
		                <a href="javascript:void(0)" class="filter__back">
		                    <img src="<?=$templateFolder?>/img/filter-back.png" alt="">
		                </a>
		                <input type="submit" class="form__reset" value="Сбросить">
		            </div>
		            <div class="filter__block">
		                <? foreach ($arResult["ITEMS"] as $key=>$arItem) : ?>
		                	<?$arCur = current($arItem["VALUES"]);?>
		                	<? if ($arItem["CODE"] == "type_bargain") : ?>
		                		<?$arContinue[] = $arItem["CODE"];?>
		                    	<div class="b-container_item bx_filter_select_container filter__item item_code_type_bargain" data-template="<?=$arItem["DISPLAY_TYPE"]?>">
									<div class="bx_filter_select_block" onclick="smartFilter.showDropDownPopup(this, '<?=CUtil::JSEscape($key)?>')">
										<div class="b-container_item-btn bx_filter_select_text" data-role="currentOption">
											<?
											foreach ($arItem["VALUES"] as $val => $ar)
											{
												if ($ar["CHECKED"])
												{
													echo $ar["VALUE"];
													$checkedItemExist = true;
												} else {}
											}
											if (!$checkedItemExist)
											{
												echo $arItem["NAME"];
											}
											?>
										</div>
										<img src="<?=$templateFolder?>/img/drop.png" alt="">
										<input
											style="display: none"
											type="radio"
											name="<?=$arCur["CONTROL_NAME_ALT"]?>"
											id="<? echo "all_".$arCur["CONTROL_ID"] ?>"
											value=""
										/>
										<?foreach ($arItem["VALUES"] as $val => $ar):?>
											<input
												<?/*style="display: none"*/?>
												type="radio"
												name="<?=$ar["CONTROL_NAME_ALT"]?>"
												id="<?=$ar["CONTROL_ID"]?>"
												value="<? echo $ar["HTML_VALUE_ALT"] ?>"
												<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
											/>
										<?endforeach?>
										<div class="bx_filter_select_popup" data-role="dropdownContent" style="display: none;">
											<ul>
												<li>
													<label for="<?="all_".$arCur["CONTROL_ID"]?>" class="bx_filter_param_label" data-role="label_<?="all_".$arCur["CONTROL_ID"]?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape("all_".$arCur["CONTROL_ID"])?>')">
														<? echo GetMessage("CT_BCSF_FILTER_ALL"); ?>
													</label>
												</li>
											<?
											foreach ($arItem["VALUES"] as $val => $ar):
												$class = "";
												if ($ar["CHECKED"])
													$class.= " selected";
												if ($ar["DISABLED"])
													$class.= " disabled";
											?>
												<li>
													<label for="<?=$ar["CONTROL_ID"]?>" class="bx_filter_param_label<?=$class?>" data-role="label_<?=$ar["CONTROL_ID"]?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')"><?=$ar["VALUE"]?></label>
												</li>
											<?endforeach?>
											</ul>
										</div>
									</div>
								</div>
		                	<? endif; ?>
		                <? endforeach; ?>
			
						<?/*
						<div class="filter__item filter__item_tags">
							<? if ($arResult["HTML_TAGS"]) : ?>
								<?=$arResult["HTML_TAGS"]?>  
							<? endif; ?>
						</div>   
						*/?>				
						
						<div class="form__group filter__item filter__item_submit hidden">
		                    <input class="bx_filter_search_button btn-search" type="submit" id="set_filter" name="set_filter" value="<?=GetMessage("CT_BCSF_SET_FILTER")?>" disabled/>
		                </div>
						<?
		               
						//not prices
						$countItems = 0;
						foreach($arResult["ITEMS"] as $key=>$arItem)
						{
							$searchedBlockClass = in_array($arItem["CODE"], $arParams["SEARCHED_BLOCKS"]) ? "searched-block" : "";	
							if(
								empty($arItem["VALUES"])
								|| isset($arItem["PRICE"])
							)
								continue;
		
							if (
								$arItem["DISPLAY_TYPE"] == "A"
								&& (
									$arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0
								)
							)
								continue;
							if ($arContinue && in_array($arItem["CODE"],$arContinue))
								continue;
							$countItems++;
							$hiddenItemsClass = $countItems > 4 ? "hidden-item" : "";
		
							if($arItem["VALUES"]) {
								$disableBlockClass = "hidden";
								foreach ($arItem["VALUES"] as $val => $ar)
								{
									if (!$ar["DISABLED"])
									{
										$disableBlockClass = "";
									}
								}
							} else {
								$disableBlockClass = "";
							}
							
							$arCur = current($arItem["VALUES"]);
							switch ($arItem["DISPLAY_TYPE"])
							{
								
								case "P"://DROPDOWN
									$checkedItemExist = false;
									?>
									<div class="b-container_item bx_filter_select_container filter__item <?=$hiddenItemsClass?> item_code_<?=$arItem["CODE"]?> <?=$disableBlockClass?>" data-template="<?=$arItem["DISPLAY_TYPE"]?>">
										<div class="bx_filter_select_block" onclick="smartFilter.showDropDownPopup(this, '<?=CUtil::JSEscape($key)?>')">
											<div class="b-container_item-btn bx_filter_select_text" data-role="currentOption">
												<?
												foreach ($arItem["VALUES"] as $val => $ar)
												{
													if ($ar["CHECKED"])
													{
														echo $ar["VALUE"];
														$checkedItemExist = true;
													}
													if (!$ar["DISABLED"])
													{
														$disableBlock = false;
													}
												}
												if (!$checkedItemExist)
												{
													echo $arItem["NAME"];
												}
												?>
											</div>
											<img src="<?=$templateFolder?>/img/drop.png" alt="">
											<input
												style="display: none"
												type="radio"
												name="<?=$arCur["CONTROL_NAME_ALT"]?>"
												id="<? echo "all_".$arCur["CONTROL_ID"] ?>"
												value=""
											/>
											<?foreach ($arItem["VALUES"] as $val => $ar):?>
												<input
													style="display: none"
													type="radio"
													name="<?=$ar["CONTROL_NAME_ALT"]?>"
													id="<?=$ar["CONTROL_ID"]?>"
													value="<? echo $ar["HTML_VALUE_ALT"] ?>"
													<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
												/>
											<?endforeach?>
											<div class="bx_filter_select_popup" data-role="dropdownContent" style="display: none;">
												<ul>
													<li>
														<label for="<?="all_".$arCur["CONTROL_ID"]?>" class="bx_filter_param_label" data-role="label_<?="all_".$arCur["CONTROL_ID"]?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape("all_".$arCur["CONTROL_ID"])?>')">
															<? echo GetMessage("CT_BCSF_FILTER_ALL"); ?>
														</label>
													</li>
												<?
												foreach ($arItem["VALUES"] as $val => $ar):
													$class = "";
													if ($ar["CHECKED"])
														$class.= " selected";
													if ($ar["DISABLED"])
														$class.= " disabled";
												?>
													<li>
														<label for="<?=$ar["CONTROL_ID"]?>" class="bx_filter_param_label<?=$class?>" data-role="label_<?=$ar["CONTROL_ID"]?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')"><?=$ar["VALUE"]?></label>
													</li>
												<?endforeach?>
												</ul>
											</div>
										</div>
									</div>
									<?
									break;
								
								
								default://CHECKBOXES
									?>
									<? if (count($arItem["VALUES"]) == 1) : ?>
										<?$firstValue = $arItem["VALUES"]?>
										<?$ar = array_shift($firstValue);?>
										<div class="dropdown filter__item filter__item_single item_code_<?=$arItem["CODE"]?> <?=$hiddenItemsClass?> <?=$disableBlockClass?>" data-template="<?=$arItem["DISPLAY_TYPE"]?>">
			                                <input type="checkbox" value="<? echo $ar["HTML_VALUE"] ?>" name="<? echo $ar["CONTROL_NAME"] ?>" id="<? echo $ar["CONTROL_ID"] ?>" <? echo $ar["CHECKED"]? 'checked="checked"': '' ?> onclick="smartFilter.click(this)"/>
			                                <label data-role="label_<?=$ar["CONTROL_ID"]?>" for="<?=$ar["CONTROL_ID"] ?>"><?=$arItem["NAME"]?></label>
			                            </div>
									<? else: ?>
										<div class="dropdown filter__item item_code_<?=$arItem["CODE"]?> <?=$hiddenItemsClass?> <?=$searchedBlockClass?> <?=$disableBlockClass?>" data-template="<?=$arItem["DISPLAY_TYPE"]?>">
					                        <a href="#" class="dropdown__toggle">
					                            <span class="name" title="<?=$arItem["NAME"]?>"><span class="value"></span><?=$arItem["NAME"]?></span>
					                            <img src="<?=$templateFolder?>/img/drop.png" alt="">
					                        </a>
					                        <div class="dropdown__menu hidden">
					                        	<?foreach($arItem["VALUES"] as $val => $ar):?>
													<div class="dropdown__item <? echo $ar["DISABLED"] ? 'disabled': '' ?>">
						                                <input type="checkbox" value="<? echo $ar["HTML_VALUE"] ?>" name="<? echo $ar["CONTROL_NAME"] ?>" id="<? echo $ar["CONTROL_ID"] ?>" <? echo $ar["CHECKED"]? 'checked="checked"': '' ?> onclick="smartFilter.click(this)"/>
														<label data-role="label_<?=$ar["CONTROL_ID"]?>" for="<?=$ar["CONTROL_ID"] ?>"
															<?global $USER;
															if($USER->isAdmin() && !empty($arItem["FILTER_HINT"])):?>
																data-filterHint = "<?=$arItem["FILTER_HINT"]?>"
															<?endif;?>
															title="<?=$ar["VALUE"];?>">
						                                	<a class="fv-link" onclick="$('#<?=$ar["CONTROL_ID"] ?>').click(); return false;" href="<?=$arResult["LOGIC_URLS"][$arItem['CODE'].$val]?>"><?= $ar['VALUE'] ?></a>
						                                	<?/*if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):?> (<span data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)
						                                	<?endif*/?>
						                                </label>
						                            </div>
												<?endforeach;?>
					                        </div>
					                    </div>
				                    <? endif; ?>	
									<?
							}
							?>
						<?
						}
						?>
					</div>
					<input class="bx_filter_search_reset" type="submit" id="del_filter" name="del_filter" style="display:none" value="<?=GetMessage("CT_BCSF_DEL_FILTER")?>" />	
				</form> 
		    </div>
		</div>

	</div>
</div>

<? 
if ($arResult["HTML_TAGS"])
	$hiddenTags = "";
else
	$hiddenTags = "hidden";
?>

<?/*
<div class="tags <?=$hiddenTags?>">
    <div class="container">
    	<?=$arResult["HTML_TAGS"]?>
		<div class="tags__reset"><?=GetMessage("CT_BCSF_DEL_FILTER")?></div>
    </div>
</div>
*/?>

<script>
	var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', 'horizontal', <?echo CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
</script>