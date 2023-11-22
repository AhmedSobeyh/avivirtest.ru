<?
/**
 * Mediahead Agency
 * @package mediahead
 * @subpackage mediahead.helpers
 * @copyright 2007-2020 Mediahead
 */
 namespace Mediahead\Helpers;

 use Bitrix\Iblock;
 use Bitrix\Main\Context;
/*
 * Пояснения:
 * (*)  - Мы принимаем массив array('VALUE' => , 'DESCRIPTION' => ) и должны его же вернуть. 
 * Если поле с описанием - оно будет содержаться в соответствующем ключе.
 */
 
class listElementWithDescription    
{
     
    // инициализация пользовательского свойства для инфоблока
    function GetIBlockPropertyDescription()
    {
        return array(
            "PROPERTY_TYPE" => "E", // основываемся на привязке к элементам
            "USER_TYPE" => "listElementWithDescription",
            "DESCRIPTION" => "Привязка к элементам с доп.описанием",
            'GetPropertyFieldHtml' => array(__CLASS__, 'GetPropertyFieldHtml'),
            "ConvertToDB" => array(__CLASS__,"ConvertToDB"),
            "ConvertFromDB" => array(__CLASS__,"ConvertFromDB"),
        );
    }
     
    function GetPropertyFieldHtml($arProperty, $value, $strHTMLControlName)
    {
        $value["DESCRIPTION"] = unserialize($value["DESCRIPTION"]);
         
        // значения по умолчанию
        $arItem = Array(
            "ID" => 0,
            "IBLOCK_ID" => 0,
            "NAME" => ""
        );
         
        // получение информации по выбранному элементу
        if(intval($value["VALUE"]) > 0)
        {
            $arFilter = Array(
                "ID" => intval($value["VALUE"]),
                "IBLOCK_ID" => $arProperty["LINK_IBLOCK_ID"],
            );
 
            $arItem = \CIBlockElement::GetList(Array(), $arFilter, false, false, Array("ID", "IBLOCK_ID", "NAME"))->Fetch();
        }
         
        // сама строка с товаром и доп.значениями
        $inpId = $strHTMLControlName["VALUE"].htmlspecialcharsex($value["VALUE"]);
        $spanId = 'sp_'.md5($strHTMLControlName["VALUE"]);
        
        $html = '<input name="'.$strHTMLControlName["VALUE"].'" id="'.$strHTMLControlName["VALUE"].'" value="'.htmlspecialcharsex($value["VALUE"]).'" size="5" type="text">';
        $html .= ' <span id="sp_'.md5($strHTMLControlName["VALUE"]).'_'.$key.'">'.$arItem["NAME"].'</span>';
        $html .= '<input type="button" value="Выбрать" onclick="jsUtils.OpenWindow(\'/bitrix/admin/iblock_element_search.php?lang='.LANG.'&IBLOCK_ID='.$arProperty["LINK_IBLOCK_ID"].'&n='.$strHTMLControlName["VALUE"].'\', 600, 500);">';
        $html .= ' Ссылка на товар: <input type="text" id="link" name="'.$strHTMLControlName["DESCRIPTION"].'" value="'.htmlspecialcharsex($value["DESCRIPTION"]).'">';
        
        return  $html; 
       
        /*
        $html .= "<pre>key: $key</pre>"; 
        $html .= "<pre>" . print_r($strHTMLControlName, true) . "</pre>"; 
        $html .= "<pre>" . print_r($arProperty, true) . "</pre>"; 
        $html .= "<pre>" . print_r($value, true) . "</pre>"; 
 
        return  $html;
        */
    }
     
    function GetAdminListViewHTML($arProperty, $value, $strHTMLControlName)
    {
        return;
    }
     
    function ConvertToDB($arProperty, $value) // сохранение в базу данных
    {
        $return = false;
         
        if( is_array($value) && array_key_exists("VALUE", $value) )
        {
            $return = array(
                "VALUE" => serialize($value["VALUE"])
            );
        }
         
        // сериализацию убирать не стал, если понадобится сохранять несколько значений
        if( is_array($value) && array_key_exists("DESCRIPTION", $value) )
            $return["DESCRIPTION"] = serialize($value["DESCRIPTION"]);
         
        return $return; 
    }
     
    function ConvertFromDB($arProperty, $value) // извлечение значений из Базы Данных
    {
        $return = false;
         
        if(!is_array($value["VALUE"]))
        {
            $return = array(
                "VALUE" => unserialize($value["VALUE"])
            );
        }
         
        return $return;
    }
}