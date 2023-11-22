<?

// Запросить список всех существующих слайдеров по месту, 

$arResult=array();
$arSlider = Array("IBLOCK_ID"); // Все свойства элемента
$properties = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>11));
while ($prop_fields = $properties->GetNext())
{
    $arSlider[]='PROPERTY_'.$prop_fields['CODE'];  
}

$arSlider11 = Array("IBLOCK_ID"=>11, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y",'ID'=>$ids);
$SliderMain = array();
$res11 = CIBlockElement::GetList(Array(), $arSlider11, false, Array("nPageSize"=>50), $arSlider);
    while($ob11 = $res11->GetNextElement())
    {
        $arFields11 = $ob11->GetFields();
        $SliderMain[] = $arFields11;
    }
    $fields = $arFields11; 
    $arResult['PROP'][] = $fields;
    

$arSelect11 = Array("ID");
$arFilter11 = Array("IBLOCK_ID"=>11, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y","PROPERTY_MESTO"=>$arParams['MESTO']);
$res11 = CIBlockElement::GetList(Array(), $arFilter11, false, Array("nPageSize"=>5), $arSelect11);

while($ob11 = $res11->GetNextElement())
{
    $arFields11 = $ob11->GetFields();
    // Определяем список слайдов для слайдера
    $ids=array();
    $res = CIBlockElement::GetProperty(11, $arFields11['ID'], "sort", "asc", array("CODE" => "SLIDES"));
    while ($ob = $res->GetNext())
    {
        $ids[] = $ob['VALUE'];

    }

    $arSelect10 = Array("IBLOCK_ID"); // Все свойства элемента
    $properties = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>10));
    while ($prop_fields = $properties->GetNext())
    {
        $arSelect10[]='PROPERTY_'.$prop_fields['CODE'];  
    }

    $arFilter10 = Array("IBLOCK_ID"=>10, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y",'ID'=>$ids);
    $sl=array();
    $res10 = CIBlockElement::GetList(Array(), $arFilter10, false, Array("nPageSize"=>50), $arSelect10);
    while($ob10 = $res10->GetNextElement())
    {
        $arFields10 = $ob10->GetFields();
        $sl[]=$arFields10;
    }
    
    $slider=$arFields10; 
    $slider['SLIDES']=$sl;
    $arResult['SLIDERS'][]=$slider;

}

$this->IncludeComponentTemplate();
	
?>