<?

// Запросить список всех существующих слайдеров по месту, 

$arResult=array();

$arSelect12 = Array("ID");
$arFilter12 = Array("IBLOCK_ID"=>12, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res11 = CIBlockElement::GetList(Array(), $arFilter12, false, Array("nPageSize"=>5), $arSelect12);
while($ob11 = $res11->GetNextElement())
{
 $arFields12 = $ob11->GetFields();
 
 // Определяем список слайдов для слайдера
 $ids=array();
    $res = CIBlockElement::GetProperty(12, $arFields12['ID'], "sort", "asc", array("CODE" => "PRODUCTS"));
    while ($ob = $res->GetNext())
    {
        $ids[] = $ob['VALUE'];
    }
 
   
$arSelect10 = Array("IBLOCK_ID"); // Все свойства элемента

$properties = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>1));
while ($prop_fields = $properties->GetNext())
{
$arSelect10[] = $prop_fields['CODE'];  

}

$arFilter10 = Array("IBLOCK_ID" => 1, "ID" => $ids, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$sl=array();
$pr = array();
$res10 = CIBlockElement::GetList(Array(), $arFilter10, false, Array("nPageSize"=>50));

while($ob10 = $res10->GetNextElement())
{
 $arFields10 = $ob10->GetFields();
 $arProps1 = $ob10->GetProperties();
 
 $pr[] = $arProps1;
 $arFields10['PROPERTIES'] = $arProps1;
 $sl[] = $arFields10;
}


$slider=$arFields10; 
$slider['PRODUCTS'] = $sl;
$arResult['PRODUCTS'][] = $slider;

}


$this->IncludeComponentTemplate();
	
?>