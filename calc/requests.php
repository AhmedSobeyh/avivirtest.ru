<?
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);


// Переменные с формы
$gender = $_POST['gender'];
$age = $_POST['age'];
$height = $_POST['height'];
$weight = $_POST['weight'];
$exercise = $_POST['exercise'];

if(isset($_POST['gender'])){
($_POST['liver']) ? $liver = $_POST['liver'] : $liver = "0";
($_POST['pressure']) ? $pressure = $_POST['pressure'] : $pressure = "0";
($_POST['diabet']) ? $diabet = $_POST['diabet'] : $diabet = "0";
($_POST['heart']) ? $heart = $_POST['heart'] : $heart = "0";
($_POST['smoking']) ? $smoking = $_POST['smoking'] : $smoking = "0";


echo ($liver);

$connection = \Bitrix\Main\Application::getConnection();

$curdate = date('Y-m-d');
$curtime = date("H:i:s");

//$data = array('date' => $curdate, 'time' => $curtime, 'gender' => $gender, 'age' => $age, 'height' => $height, 'weight' => $weight, 'diabet' => $diabet, 'exercise' => $exercise, 'liver' => $liver, 'pressure' => $pressure, 'heart' => $heart, 'smoking' => $smoking ); 
// Подготавливаем SQL-запрос
$query = "INSERT INTO covid (date, time, gender, age, height, weight, exercise, liver, pressure, diabet, heart, smoking) values ($date, $time, $gender, $age, $height, $weight, $exercise, $liver, $pressure, $diabet, $heart, $smoking)";

// Выполняем запрос с данными
$connection->queryExecute($query);


?>