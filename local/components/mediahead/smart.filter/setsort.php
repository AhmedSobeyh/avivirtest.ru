<?
define('STOP_STATISTICS', true);
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
$GLOBALS['APPLICATION']->RestartBuffer();

if (!$_REQUEST['sort'] && $_REQUEST['sort'] != 'RAND' && $_REQUEST['sort'] != 'NAME')
{
    echo 'error';
    exit();
}

$_SESSION['POETRY_SORT'] = $_REQUEST['sort']; 
echo 'ok';
