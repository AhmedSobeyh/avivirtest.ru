<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

\CModule::IncludeModule("iblock");
$ob = new CIBlockElement;

$arFilter = [
    "IBLOCK_ID" => ["1","4","5"],
    "PROPERTY_OLDURL" => "/wellsbio"
];

$arSelect = [
    "IBLOCK_ID","ID","NAME","DETAIL_PAGE_URL","PROPERTY_OLDURL"
]; 

$res = $ob->GetList([], $arFilter, false, false, $arSelect)->GetNext();

apre($res);

?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>