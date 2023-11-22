<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();



$arComponentParameters = array(
	"GROUPS" => array(
		"PARAMS" => array(
			"NAME" => 'TEST',
		),
	),
	
	
);



CModule::IncludeModule('iblock');
$arForumList=array();
$property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>11, "CODE"=>"MESTO"));
while($enum_fields = $property_enums->GetNext())
{
 
    $arForumList[$enum_fields['ID']]=$enum_fields['VALUE'];
}


$arComponentParameters["PARAMETERS"]["MESTO"] = array(
	"NAME" => 'Место', 
	"TYPE" => "LIST",
	"VALUES" => $arForumList,
	"DEFAULT"=>'1'
);



?>