<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

// Время кэширования
$arParams["CACHE_TIME"] = 36000000;

// Настройки для Аякса
$arParams["AJAX_CALL"] = isset($arParams["AJAX_CALL"]) && $arParams["AJAX_CALL"] == "Y" ? "Y" : "N";
$SPAM = trim($_POST["default"]);
$EMAIL = trim($_POST["email"]);
$DELETE = trim($_POST["unsubscribe"]);

if($arParams["AJAX_CALL"] == "Y")
{
	// Если инфоблоки не установлены, то выводим ошибку и останавливаем
	if(!\Bitrix\Main\Loader::includeModule("subscribe"))
	{
		//$this->AbortResultCache();
		ShowError("Модуль не установлен");
		return;
	}
	
	if( !$SPAM )
	{
	
		//Регистрируем подписчика
		if(!empty($EMAIL) && empty($DELETE))
		{	
			$arFields = Array(
				"USER_ID" => NULL,
				"FORMAT" => "html",
				"EMAIL" => $EMAIL,
				"ACTIVE" => "Y",
				"RUB_ID" => array(1),
				"CONFIRMED" => "Y",
				"SEND_CONFIRM" => "N"
			);
			
			$user = CSubscription::GetByEmail($EMAIL);
			$userInfo = $arUser = $user->Fetch();
			
			//pre($userInfo);
			
			if( is_array($userInfo) )
			{
				// Если адрес найден и он не активен, то вклюаем его обратно
				if( $userInfo["ACTIVE"] == "N" )
				{
					$subscr = new CSubscription;
					$subscr->Update($userInfo["ID"], array("ACTIVE"=>"Y"));
					
					$arParams["SUBJECT"] = Loc::GetMessage("S_RESTART");
				}
				else
				{
					$arParams["SUBJECT"] = Loc::GetMessage("S_RESTART_ERROR");
				}
			}
			else
			{
				$subscr = new CSubscription;
				$subscr->Add($arFields);
				
				$arParams["SUBJECT"] = Loc::GetMessage("S_START");
			}
		}
		
		// Удаляем (отключаем) подписчика
		if(!empty($EMAIL) && !empty($DELETE))
		{
			$user = CSubscription::GetByEmail($EMAIL);
			$arUser = $user->Fetch();
			
			if(is_array($arUser) && $arUser["ACTIVE"] == "Y")
			{
				$subscr = new CSubscription;
				$subscr->Update($arUser["ID"], array("ACTIVE"=>"N"));
				
				$arParams["SUBJECT"] = Loc::GetMessage("S_UNSUBCRIBE");
			}
			else
			{
				$arParams["SUBJECT"] = Loc::GetMessage("S_UNSUBCRIBE_ERROR");
			}
		}
		
		echo $arParams["SUBJECT"];
	
	}
	
}
else
{
	// Кэшируем все данные
	if($this->StartResultCache(false))
	{
		$this->IncludeComponentTemplate();
	}
}
?>