<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);

use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
?>

<div class="meeting">
	
	<h2><?=Loc::GetMessage("M_TITLE")?></h2>
	
	<div class="content">
		<div class="description"><?=Loc::GetMessage("M_DESCRIPTION")?></div>
		
		<div class="form">
			<form action="<?=$APPLICATION->GetCurPage()?>?subscribe=Y" enctype="multipart/form-data">
				<input type="text" name="email" class="sure" placeholder="Электронная@почта">
				<input type="hidden" name="default" value="" />
				<button type="button" class="btn btn_green_white"><?=Loc::GetMessage("M_BUTTON")?></button>
			</form>
			<div class="rule"><?=Loc::GetMessage("M_RULE")?></div>
		</div>
	</div>
	
</div>