<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

use Bitrix\Main\Context,
	Bitrix\Main\Type\DateTime,
	Bitrix\Main\Loader,
	Bitrix\Iblock;
	
/**
*
* Madiahead Agency
* Leonid Zakhvatkin
*
* Этот компонент по сути news.detail, 
* но умеет наследовать фоновую картинку 
* из раздела и свойств элемента
*
* TODO: вписать сюда языковые операции, учесть Title, Description 
*
*/ 	

CModule::IncludeModule("mediahead.helpers");

CPageOption::SetOptionString("main", "nav_page_in_session", "N");

if(!isset($arParams["CACHE_TIME"]))
	$arParams["CACHE_TIME"] = 36000000;

$arParams["IBLOCK_TYPE"] = trim($arParams["IBLOCK_TYPE"]);
if(strlen($arParams["IBLOCK_TYPE"])<=0)
	$arParams["IBLOCK_TYPE"] = "news";

$arParams["ELEMENT_ID"] = intval($arParams["~ELEMENT_ID"]);
if($arParams["ELEMENT_ID"] > 0 && $arParams["ELEMENT_ID"]."" != $arParams["~ELEMENT_ID"])
{
	if (Loader::includeModule("iblock"))
	{
		Iblock\Component\Tools::process404(
			trim($arParams["MESSAGE_404"]) ?: GetMessage("T_NEWS_DETAIL_NF")
			,true
			,$arParams["SET_STATUS_404"] === "Y"
			,$arParams["SHOW_404"] === "Y"
			,$arParams["FILE_404"]
		);
	}
	return;
}

$arParams["CHECK_DATES"] = $arParams["CHECK_DATES"]!="N";
if(!is_array($arParams["FIELD_CODE"]))
	$arParams["FIELD_CODE"] = array();
foreach($arParams["FIELD_CODE"] as $key=>$val)
	if(!$val)
		unset($arParams["FIELD_CODE"][$key]);
if(!is_array($arParams["PROPERTY_CODE"]))
	$arParams["PROPERTY_CODE"] = array();
foreach($arParams["PROPERTY_CODE"] as $k=>$v)
	if($v==="")
		unset($arParams["PROPERTY_CODE"][$k]);

$arParams["IBLOCK_URL"]=trim($arParams["IBLOCK_URL"]);

$arParams["META_KEYWORDS"]=trim($arParams["META_KEYWORDS"]);
if(strlen($arParams["META_KEYWORDS"])<=0)
	$arParams["META_KEYWORDS"] = "-";
$arParams["META_DESCRIPTION"]=trim($arParams["META_DESCRIPTION"]);
if(strlen($arParams["META_DESCRIPTION"])<=0)
	$arParams["META_DESCRIPTION"] = "-";
$arParams["BROWSER_TITLE"]=trim($arParams["BROWSER_TITLE"]);
if(strlen($arParams["BROWSER_TITLE"])<=0)
	$arParams["BROWSER_TITLE"] = "-";

$arParams["INCLUDE_IBLOCK_INTO_CHAIN"] = $arParams["INCLUDE_IBLOCK_INTO_CHAIN"]!="N";
$arParams["ADD_SECTIONS_CHAIN"] = $arParams["ADD_SECTIONS_CHAIN"]!="N"; //Turn on by default
$arParams["ADD_ELEMENT_CHAIN"] = (isset($arParams["ADD_ELEMENT_CHAIN"]) && $arParams["ADD_ELEMENT_CHAIN"] == "Y");
$arParams["SET_TITLE"] = $arParams["SET_TITLE"]!="N";
$arParams["SET_LAST_MODIFIED"] = $arParams["SET_LAST_MODIFIED"]==="Y";
$arParams["SET_BROWSER_TITLE"] = (isset($arParams["SET_BROWSER_TITLE"]) && $arParams["SET_BROWSER_TITLE"] === 'N' ? 'N' : 'Y');
$arParams["SET_META_KEYWORDS"] = (isset($arParams["SET_META_KEYWORDS"]) && $arParams["SET_META_KEYWORDS"] === 'N' ? 'N' : 'Y');
$arParams["SET_META_DESCRIPTION"] = (isset($arParams["SET_META_DESCRIPTION"]) && $arParams["SET_META_DESCRIPTION"] === 'N' ? 'N' : 'Y');
$arParams["STRICT_SECTION_CHECK"] = (isset($arParams["STRICT_SECTION_CHECK"]) && $arParams["STRICT_SECTION_CHECK"] === "Y");
$arParams["ACTIVE_DATE_FORMAT"] = trim($arParams["ACTIVE_DATE_FORMAT"]);
if(strlen($arParams["ACTIVE_DATE_FORMAT"])<=0)
	$arParams["ACTIVE_DATE_FORMAT"] = $DB->DateFormatToPHP(CSite::GetDateFormat("SHORT"));

$arParams["DISPLAY_TOP_PAGER"] = $arParams["DISPLAY_TOP_PAGER"]=="Y";
$arParams["DISPLAY_BOTTOM_PAGER"] = $arParams["DISPLAY_BOTTOM_PAGER"]!="N";
$arParams["PAGER_TITLE"] = trim($arParams["PAGER_TITLE"]);
$arParams["PAGER_SHOW_ALWAYS"] = $arParams["PAGER_SHOW_ALWAYS"]!="N";
$arParams["PAGER_TEMPLATE"] = trim($arParams["PAGER_TEMPLATE"]);
$arParams["PAGER_SHOW_ALL"] = $arParams["PAGER_SHOW_ALL"]!=="N";

if($arParams["DISPLAY_TOP_PAGER"] || $arParams["DISPLAY_BOTTOM_PAGER"])
{
	$arNavParams = array(
		"nPageSize" => 1,
		"bShowAll" => $arParams["PAGER_SHOW_ALL"],
	);
	$arNavigation = CDBResult::GetNavParams($arNavParams);
}
else
{
	$arNavParams = null;
	$arNavigation = false;
}

if (empty($arParams["PAGER_PARAMS_NAME"]) || !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["PAGER_PARAMS_NAME"]))
{
	$pagerParameters = array();
}
else
{
	$pagerParameters = $GLOBALS[$arParams["PAGER_PARAMS_NAME"]];
	if (!is_array($pagerParameters))
		$pagerParameters = array();
}

$arParams["SHOW_WORKFLOW"] = $_REQUEST["show_workflow"]=="Y";

$arParams["USE_PERMISSIONS"] = $arParams["USE_PERMISSIONS"]=="Y";
if(!is_array($arParams["GROUP_PERMISSIONS"]))
	$arParams["GROUP_PERMISSIONS"] = array(1);

$bUSER_HAVE_ACCESS = !$arParams["USE_PERMISSIONS"];
if($arParams["USE_PERMISSIONS"] && isset($USER) && is_object($USER))
{
	$arUserGroupArray = $USER->GetUserGroupArray();
	foreach($arParams["GROUP_PERMISSIONS"] as $PERM)
	{
		if(in_array($PERM, $arUserGroupArray))
		{
			$bUSER_HAVE_ACCESS = true;
			break;
		}
	}
}
if(!$bUSER_HAVE_ACCESS)
{
	ShowError(GetMessage("T_NEWS_DETAIL_PERM_DEN"));
	return 0;
}

if($arParams["SHOW_WORKFLOW"] || $this->startResultCache(false, array(($arParams["CACHE_GROUPS"]==="N"? false: $USER->GetGroups()),$bUSER_HAVE_ACCESS, $arNavigation, $pagerParameters)))
{

	if(!Loader::includeModule("iblock"))
	{
		$this->abortResultCache();
		ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
		return;
	}

	$arFilter = array(
		"IBLOCK_LID" => SITE_ID,
		"IBLOCK_ACTIVE" => "Y",
		"ACTIVE" => "Y",
		"CHECK_PERMISSIONS" => "Y",
		"SHOW_HISTORY" => $arParams["SHOW_WORKFLOW"]? "Y": "N",
	);
	if($arParams["CHECK_DATES"])
		$arFilter["ACTIVE_DATE"] = "Y";
	if(intval($arParams["IBLOCK_ID"]) > 0)
		$arFilter["IBLOCK_ID"] = $arParams["IBLOCK_ID"];
	else
		$arFilter["=IBLOCK_TYPE"] = $arParams["IBLOCK_TYPE"];

	//Handle case when ELEMENT_CODE used
	if($arParams["ELEMENT_ID"] <= 0)
		$arParams["ELEMENT_ID"] = CIBlockFindTools::GetElementID(
			$arParams["ELEMENT_ID"],
			$arParams["~ELEMENT_CODE"],
			$arParams["STRICT_SECTION_CHECK"]? $arParams["SECTION_ID"]: false,
			$arParams["STRICT_SECTION_CHECK"]? $arParams["~SECTION_CODE"]: false,
			$arFilter
		);

	if ($arParams["STRICT_SECTION_CHECK"])
	{
		if ($arParams["SECTION_ID"] > 0)
		{
			$arFilter["SECTION_ID"] = $arParams["SECTION_ID"];
		}
		elseif (strlen($arParams["~SECTION_CODE"]) > 0)
		{
			$arFilter["SECTION_CODE"] = $arParams["~SECTION_CODE"];
		}
		elseif ($this->getParent() && strpos($arParams["DETAIL_URL"], "#SECTION_CODE_PATH#") !== false)
		{
			$this->abortResultCache();
			Iblock\Component\Tools::process404(
				trim($arParams["MESSAGE_404"]) ?: GetMessage("T_NEWS_DETAIL_NF")
				,true
				,$arParams["SET_STATUS_404"] === "Y"
				,$arParams["SHOW_404"] === "Y"
				,$arParams["FILE_404"]
			);
			return 0;
		}
	}

	$WF_SHOW_HISTORY = "N";


	$arSelect = array_merge($arParams["FIELD_CODE"], array(
		"ID",
		"NAME",
		"IBLOCK_ID",
		"IBLOCK_SECTION_ID",
		"DETAIL_TEXT",
		"DETAIL_TEXT_TYPE",
		"PREVIEW_TEXT",
		"PREVIEW_TEXT_TYPE",
		"DETAIL_PICTURE",
		"TIMESTAMP_X",
		"ACTIVE_FROM",
		"LIST_PAGE_URL",
		"DETAIL_PAGE_URL",
	));

	/*
	$bGetProperty = count($arParams["PROPERTY_CODE"]) > 0
			|| $arParams["BROWSER_TITLE"] != "-"
			|| $arParams["META_KEYWORDS"] != "-"
			|| $arParams["META_DESCRIPTION"] != "-";
			*/

	$bGetProperty = true;

	if($bGetProperty)
		$arSelect[]="PROPERTY_*";

	if ($arParams['SET_CANONICAL_URL'] === 'Y')
		$arSelect[] = 'CANONICAL_PAGE_URL';

	$arFilter["ID"] = $arParams["ELEMENT_ID"];
	$arFilter["SHOW_HISTORY"] = $WF_SHOW_HISTORY;

	$rsElement = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
	$rsElement->SetUrlTemplates($arParams["DETAIL_URL"], "", $arParams["IBLOCK_URL"]);
	if($obElement = $rsElement->GetNextElement())
	{
		$arResult = $obElement->GetFields();

		$arResult["NAV_RESULT"] = new CDBResult;
		if(($arResult["DETAIL_TEXT_TYPE"]=="html") && (strstr($arResult["DETAIL_TEXT"], "<BREAK />")!==false))
			$arPages=explode("<BREAK />", $arResult["DETAIL_TEXT"]);
		elseif(($arResult["DETAIL_TEXT_TYPE"]!="html") && (strstr($arResult["DETAIL_TEXT"], "&lt;BREAK /&gt;")!==false))
			$arPages=explode("&lt;BREAK /&gt;", $arResult["DETAIL_TEXT"]);
		else
			$arPages=array();
		$arResult["NAV_RESULT"]->InitFromArray($arPages);
		$arResult["NAV_RESULT"]->NavStart($arNavParams);
		if(count($arPages)==0)
		{
			$arResult["NAV_RESULT"] = false;
		}
		else
		{
			$navComponentParameters = array();
			if ($arParams["PAGER_BASE_LINK_ENABLE"] === "Y")
			{
				$pagerBaseLink = trim($arParams["PAGER_BASE_LINK"]);
				if ($pagerBaseLink === "")
					$pagerBaseLink = $arResult["DETAIL_PAGE_URL"];

				if ($pagerParameters && isset($pagerParameters["BASE_LINK"]))
				{
					$pagerBaseLink = $pagerParameters["BASE_LINK"];
					unset($pagerParameters["BASE_LINK"]);
				}

				$navComponentParameters["BASE_LINK"] = CHTTP::urlAddParams($pagerBaseLink, $pagerParameters, array("encode"=>true));
			}

			$arResult["NAV_STRING"] = $arResult["NAV_RESULT"]->GetPageNavStringEx(
				$navComponentObject,
				$arParams["PAGER_TITLE"],
				$arParams["PAGER_TEMPLATE"],
				$arParams["PAGER_SHOW_ALWAYS"],
				$this,
				$navComponentParameters
			);
			/** @var CBitrixComponent $navComponentObject */
			$arResult["NAV_CACHED_DATA"] = $navComponentObject->getTemplateCachedData();

			$arResult["NAV_TEXT"] = "";
			while($ar = $arResult["NAV_RESULT"]->Fetch())
				$arResult["NAV_TEXT"].=$ar;
		}

		if(strlen($arResult["ACTIVE_FROM"])>0)
			$arResult["DISPLAY_ACTIVE_FROM"] = CIBlockFormatProperties::DateFormat($arParams["ACTIVE_DATE_FORMAT"], MakeTimeStamp($arResult["ACTIVE_FROM"], CSite::GetDateFormat()));
		else
			$arResult["DISPLAY_ACTIVE_FROM"] = "";

		$ipropValues = new Iblock\InheritedProperty\ElementValues($arResult["IBLOCK_ID"], $arResult["ID"]);
		$arResult["IPROPERTY_VALUES"] = $ipropValues->getValues();

		Iblock\Component\Tools::getFieldImageData(
			$arResult,
			array('PREVIEW_PICTURE', 'DETAIL_PICTURE'),
			Iblock\Component\Tools::IPROPERTY_ENTITY_ELEMENT,
			'IPROPERTY_VALUES'
		);

		$arResult["FIELDS"] = array();
		foreach($arParams["FIELD_CODE"] as $code)
			if(array_key_exists($code, $arResult))
				$arResult["FIELDS"][$code] = $arResult[$code];

		if($bGetProperty)
			$arResult["PROPERTIES"] = $obElement->GetProperties();
		$arResult["DISPLAY_PROPERTIES"]=array();
		
		/*
		* Lvzx. Значения из справочников с мультиязычной поддержкой
		*/
		foreach($arResult["PROPERTIES"] as &$prop)
		{
			if ($prop['USER_TYPE'] == 'directory' && !empty($prop['USER_TYPE_SETTINGS']['TABLE_NAME']))
			{
				\Mediahead\Helpers\Tools::obtainDirectoryProp($prop);
			}
		}
		
		foreach($arParams["PROPERTY_CODE"] as $pid)
		{
			$prop = &$arResult["PROPERTIES"][$pid];
			if(
				(is_array($prop["VALUE"]) && count($prop["VALUE"])>0)
				|| (!is_array($prop["VALUE"]) && strlen($prop["VALUE"])>0)
			)
			{
				$arResult["PROPERTIES"][$pid]['DISPLAY'] = CIBlockFormatProperties::GetDisplayValue($arResult, $prop, "news_out");
			}
		}

		//$arResult["MYTEST"] = "test";
		
		/*
		* Lvzx. Тизеры с мультиязычной поддержкой
		*/
		if ($arResult['PROPERTIES']['TEASERS']['VALUE'])
		{
			$arResult['TEASERS'] = \Mediahead\Helpers\Tools::getTeasers($arResult['PROPERTIES']['TEASERS']['VALUE']);
		} 

		/*
		* Lvzx. Тизеры с мультиязычной поддержкой
		*/
		if ($arResult['PROPERTIES']['TEASERS_FEATURES']['VALUE'])
		{
			$arResult['TEASERS_FEATURES'] = \Mediahead\Helpers\Tools::getTeasers($arResult['PROPERTIES']['TEASERS_FEATURES']['VALUE']);
		} 

		/*
		* Lvzx. Тизеры с мультиязычной поддержкой
		*/
		if ($arResult['PROPERTIES']['USAGE_TEASERS']['VALUE'])
		{
			$arResult['USAGE'] = \Mediahead\Helpers\Tools::getTeasers($arResult['PROPERTIES']['USAGE_TEASERS']['VALUE']);
		} 
		
		/*
		* Lvzx. Бренд с мультиязычной поддержкой
		*/
		if ($arResult['PROPERTIES']['BRAND']['VALUE'])
		{
			$arBrand = \Mediahead\Helpers\Tools::getPartners($arResult['PROPERTIES']['BRAND']['VALUE']);
			if (!empty($arBrand))

			$arResult['BRAND'] = current($arBrand);
		} 
		
		/*
		* Lvzx. Магазины с мультиязычной поддержкой
		*/
		if ($arResult['PROPERTIES']['RETAIL']['VALUE'])
		{
			$arResult['RETAIL'] = \Mediahead\Helpers\Tools::getPartners($arResult['PROPERTIES']['RETAIL']['VALUE'], $arResult['PROPERTIES']['RETAIL']['~DESCRIPTION']);
		} 
		
		/*
		* Lvzx. Клиники с мультиязычной поддержкой
		*/
		if ($arResult['PROPERTIES']['CLINICS']['VALUE'])
		{
			$arResult['CLINICS'] = \Mediahead\Helpers\Tools::getPartners($arResult['PROPERTIES']['CLINICS']['VALUE']);
		} 
		
		
		$arResult["IBLOCK"] = GetIBlock($arResult["IBLOCK_ID"], $arResult["IBLOCK_TYPE"]);

		/*
		* Lvzx. Наследуемая картинка раздела
		* сначала проверяем картинку из настроек инфоблока
		*/
		if ($arResult["IBLOCK"]['PICTURE'])
		{
			$arResult['~CUSTOM_BACKGROUND'] = $arResult["IBLOCK"]['PICTURE'];
		}

		$arResult["SECTION"] = array("PATH" => array());
		$arResult["SECTION_URL"] = "";

		if($arResult["IBLOCK_SECTION_ID"] > 0)
		{
			$rsPath = CIBlockSection::GetNavChain(
				$arResult["IBLOCK_ID"],
				$arResult["IBLOCK_SECTION_ID"],
				array(
					"ID", "CODE", "XML_ID", "EXTERNAL_ID", "IBLOCK_ID",
					"IBLOCK_SECTION_ID", "SORT", "NAME", "ACTIVE",
					"DEPTH_LEVEL", "SECTION_PAGE_URL", "DETAIL_PICTURE"
				)
			);
			$rsPath->SetUrlTemplates("", $arParams["SECTION_URL"]);
			while($arPath = $rsPath->GetNext())
			{
				$ipropValues = new Iblock\InheritedProperty\SectionValues($arParams["IBLOCK_ID"], $arPath["ID"]);
				$arPath["IPROPERTY_VALUES"] = $ipropValues->getValues();
				$arResult["SECTION"]["PATH"][$arPath['ID']] = $arPath;
				$arResult["SECTION_URL"] = $arPath["~SECTION_PAGE_URL"];
				$sectionFilter["ID"][] = $arPath["ID"];
			} 

			$sectionFilter["IBLOCK_ID"] = $arResult["IBLOCK_ID"]; 
			$rsUf = CIBlockSection::GetList([],$sectionFilter,false,['ID','IBLOCK_ID','UF_*']);
			while($uf = $rsUf->Fetch())
			{
				foreach($uf as $name => $value)
				{
					$arResult["SECTION"]["PATH"][$uf['ID']][$name] = $value;
				}
				
			}

			/*
			* Lvzx. Наследуемая картинка раздела
			* смотрим картинку по разделам, согласно вложенности
			*/
			if ($arResult["SECTION"]["PATH"])
			{
				$arPath = array_reverse($arResult["SECTION"]["PATH"]);
				foreach($arPath as $section)
				{
					if ($section['DETAIL_PICTURE'])
					{
						$arResult['~CUSTOM_BACKGROUND'] = $section['DETAIL_PICTURE'];
						break;
					}
				}

			}

		}

		/*
		* Lvzx. Наследуемая картинка элемента.
		* проверяем нет ли своей подложки.
		*/
		// apre($arResult['PROPERTIES']);
		if ($arResult['PROPERTIES']['CUSTOM_BACKGROUND']['VALUE'] > 0)
		{
			$arResult['~CUSTOM_BACKGROUND'] = $arResult['PROPERTIES']['CUSTOM_BACKGROUND']['VALUE'];
		}

		

		$resultCacheKeys = array(
			"ID",
			"IBLOCK_ID",
			"NAV_CACHED_DATA",
			"NAME",
			"IBLOCK_SECTION_ID",
			"IBLOCK",
			"LIST_PAGE_URL", "~LIST_PAGE_URL",
			"SECTION_URL",
			"CANONICAL_PAGE_URL",
			"SECTION",
			"IPROPERTY_VALUES",
			"TIMESTAMP_X",
			"NAVCHAIN",
		);

		/*
		* Lvzx. Наследуемая картинка
		* если нашли - делаем ресайз и пишем в кеш компонента
		*/
		if ($arResult['~CUSTOM_BACKGROUND'])
		{
			$arResult['CUSTOM_BACKGROUND'] = CFile::ResizeImageGet($arResult['~CUSTOM_BACKGROUND'], ["width" => 1700, "height" => 900], BX_RESIZE_IMAGE_PROPORTIONAL);
			$resultCacheKeys[] = 'CUSTOM_BACKGROUND';
		}

		// Lvzx. Lang data 
		Loader::includeModule("mediahead.helpers");
		\Mediahead\Helpers\Lang::obtainLangFields($arResult);	

		$lang = \Mediahead\Helpers\Lang::getLang();
		
		if (
			$arParams["SET_TITLE"]
			|| $arParams["ADD_ELEMENT_CHAIN"]
			|| $arParams["SET_BROWSER_TITLE"] === 'Y'
			|| $arParams["SET_META_KEYWORDS"] === 'Y'
			|| $arParams["SET_META_DESCRIPTION"] === 'Y'
		)
		{
			$arResult["META_TAGS"] = array();
			$resultCacheKeys[] = "META_TAGS";

			if ($arParams["SET_TITLE"])
			{
				$arResult["META_TAGS"]["TITLE"] = (
					$arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"] != "" && $lang == 'RU'
					? $arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"]
					: $arResult["NAME"]
				);
			}

			if ($arParams["ADD_ELEMENT_CHAIN"])
			{
				$arResult["META_TAGS"]["ELEMENT_CHAIN"] = (
					$arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"] != "" && $lang == 'RU'
					? $arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"]
					: $arResult["NAME"]
				);
			}

			if ($arParams["SET_BROWSER_TITLE"] === 'Y')
			{
				$browserTitle = \Bitrix\Main\Type\Collection::firstNotEmpty(
					$arResult["PROPERTIES"], array($arParams["BROWSER_TITLE"], "VALUE")
					,$arResult, $arParams["BROWSER_TITLE"]
					,$arResult["IPROPERTY_VALUES"], "ELEMENT_META_TITLE"
				);
				$arResult["META_TAGS"]["BROWSER_TITLE"] = (
					is_array($browserTitle)
					? implode(" ", $browserTitle)
					: $browserTitle
				);

				if ($lang != 'RU')
				{
					$arResult["META_TAGS"]["BROWSER_TITLE"] = $arResult["NAME"];
				}

				unset($browserTitle);
			}
			if ($arParams["SET_META_KEYWORDS"] === 'Y')
			{
				$metaKeywords = \Bitrix\Main\Type\Collection::firstNotEmpty(
					$arResult["PROPERTIES"], array($arParams["META_KEYWORDS"], "VALUE")
					,$arResult["IPROPERTY_VALUES"], "ELEMENT_META_KEYWORDS"
				);
				$arResult["META_TAGS"]["KEYWORDS"] = (
					is_array($metaKeywords)
					? implode(" ", $metaKeywords)
					: $metaKeywords
				);
				unset($metaKeywords);
			}
			if ($arParams["SET_META_DESCRIPTION"] === 'Y')
			{
				$metaDescription = \Bitrix\Main\Type\Collection::firstNotEmpty(
					$arResult["PROPERTIES"], array($arParams["META_DESCRIPTION"], "VALUE")
					,$arResult["IPROPERTY_VALUES"], "ELEMENT_META_DESCRIPTION"
				);
				$arResult["META_TAGS"]["DESCRIPTION"] = (
					is_array($metaDescription)
					? implode(" ", $metaDescription)
					: $metaDescription
				);
				unset($metaDescription);
			}
		}

		

		foreach($arResult['SECTION']['PATH'] as &$section)
		{
			\Mediahead\Helpers\Lang::obtainLangFields($section);	
		}

		$this->setResultCacheKeys($resultCacheKeys);

		$this->includeComponentTemplate();
	}
	else
	{
		$this->abortResultCache();
		Iblock\Component\Tools::process404(
			trim($arParams["MESSAGE_404"]) ?: GetMessage("T_NEWS_DETAIL_NF")
			,true
			,$arParams["SET_STATUS_404"] === "Y"
			,$arParams["SHOW_404"] === "Y"
			,$arParams["FILE_404"]
		);
	}
}

if(isset($arResult["ID"]))
{
	$arTitleOptions = null;
	if(Loader::includeModule("iblock"))
	{
		CIBlockElement::CounterInc($arResult["ID"]);

		if($USER->IsAuthorized())
		{
			if(
				$APPLICATION->GetShowIncludeAreas()
				|| $arParams["SET_TITLE"]
				|| isset($arResult[$arParams["BROWSER_TITLE"]])
			)
			{
				$arReturnUrl = array(
					"add_element" => CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "DETAIL_PAGE_URL"),
					"delete_element" => (
						empty($arResult["SECTION_URL"])?
						$arResult["LIST_PAGE_URL"]:
						$arResult["SECTION_URL"]
					),
				);

				$arButtons = CIBlock::GetPanelButtons(
					$arResult["IBLOCK_ID"],
					$arResult["ID"],
					$arResult["IBLOCK_SECTION_ID"],
					Array(
						"RETURN_URL" => $arReturnUrl,
						"SECTION_BUTTONS" => false,
					)
				);

				if($APPLICATION->GetShowIncludeAreas())
					$this->addIncludeAreaIcons(CIBlock::GetComponentMenu($APPLICATION->GetPublicShowMode(), $arButtons));

				if($arParams["SET_TITLE"] || isset($arResult[$arParams["BROWSER_TITLE"]]))
				{
					$arTitleOptions = array(
						'ADMIN_EDIT_LINK' => $arButtons["submenu"]["edit_element"]["ACTION"],
						'PUBLIC_EDIT_LINK' => $arButtons["edit"]["edit_element"]["ACTION"],
						'COMPONENT_NAME' => $this->getName(),
					);
				}
			}
		}
	}

	$this->setTemplateCachedData($arResult["NAV_CACHED_DATA"]);

	/*
	* Lvzx. Наследуемая картинка раздела
	* подключаем картинку на странице
	*/
	if ($arResult['CUSTOM_BACKGROUND'])
	{
		$APPLICATION->SetPageProperty("background", $arResult['CUSTOM_BACKGROUND']['src']);
	}

	if ($arParams['SET_CANONICAL_URL'] === 'Y' && $arResult["CANONICAL_PAGE_URL"])
	{
		$APPLICATION->SetPageProperty('canonical', $arResult["CANONICAL_PAGE_URL"]);
	}

	if($arParams["SET_TITLE"])
		$APPLICATION->SetTitle($arResult["META_TAGS"]["TITLE"], $arTitleOptions);

	if ($arParams["SET_BROWSER_TITLE"] === 'Y')
	{
		if ($arResult["META_TAGS"]["BROWSER_TITLE"] !== '')
			$APPLICATION->SetPageProperty("title", $arResult["META_TAGS"]["BROWSER_TITLE"], $arTitleOptions);
	}

	if ($arParams["SET_META_KEYWORDS"] === 'Y')
	{
		if ($arResult["META_TAGS"]["KEYWORDS"] !== '')
			$APPLICATION->SetPageProperty("keywords", $arResult["META_TAGS"]["KEYWORDS"], $arTitleOptions);
	}

	if ($arParams["SET_META_DESCRIPTION"] === 'Y')
	{
		if ($arResult["META_TAGS"]["DESCRIPTION"] !== '')
			$APPLICATION->SetPageProperty("description", $arResult["META_TAGS"]["DESCRIPTION"], $arTitleOptions);
	}

	if($arParams["INCLUDE_IBLOCK_INTO_CHAIN"] && isset($arResult["IBLOCK"]["NAME"]))
	{
		$APPLICATION->AddChainItem($arResult["IBLOCK"]["NAME"], $arResult["~LIST_PAGE_URL"]);
	}

	if($arParams["ADD_SECTIONS_CHAIN"] && is_array($arResult["SECTION"]))
	{
		foreach($arResult["SECTION"]["PATH"] as $arPath)
		{
			if ($arPath["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"] != "")
				$APPLICATION->AddChainItem($arPath["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"], $arPath["~SECTION_PAGE_URL"]);
			else
				$APPLICATION->AddChainItem($arPath["NAME"], $arPath["~SECTION_PAGE_URL"]);
		}
	}
	if ($arParams["ADD_ELEMENT_CHAIN"])
		$APPLICATION->AddChainItem($arResult["META_TAGS"]["ELEMENT_CHAIN"]);

	if ($arParams["SET_LAST_MODIFIED"] && $arResult["TIMESTAMP_X"])
	{
		Context::getCurrent()->getResponse()->setLastModified(DateTime::createFromUserTime($arResult["TIMESTAMP_X"]));
	}

	return $arResult["ID"];
}
else
{
	return 0;
}
