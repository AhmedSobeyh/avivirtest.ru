<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$data = json_encode($arResult["DATA"], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP);

$data = str_replace('\u0026quot;', '\"', $data);

echo $data;
