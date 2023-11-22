<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$lastParent = false;

foreach($arResult as $key => $item)
{
	if ($item['PARAMS']['SUB'])
	{
		$lastParent = $key;
	}
	
	if ($item['DEPTH_LEVEL'] == 2 /*|| $item['PARAMS']['FROM_IBLOCK'] == true*/)
	{
		$arResult[$lastParent]['SUB_ITEMS'][] = $item;
		unset($arResult[$key]);
	}
		
}