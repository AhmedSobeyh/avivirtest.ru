<?

use Bitrix\Main\Config\Option;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

// Если запрос через аякс
if ($_SERVER["HTTP_X_REQUESTED_WITH"] == "XMLHttpRequest") {
    // Проверяем наличие заполнения секретной формы
    $default = htmlspecialchars(strip_tags($_POST["default"]));

    if ($_REQUEST['recaptcha_response']) {

        // Создаем POST запрос
        $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
        $recaptcha_secret = '6LeDbKcdAAAAANQ9XZZw5sIM8f7SRALYSRJC1RCm';
        $recaptcha_response = $_POST['recaptcha_response'];

        // Отправляем POST запрос и декодируем результаты ответа
        $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
        $recaptcha = json_decode($recaptcha);

        // Принимаем меры в зависимости от полученного результата
        if ($recaptcha->score >= 0.5) {


            if ($default == "") {

                //City by IP
                if (CModule::IncludeModuleEx("reaspekt.geobase")) {
                    $geo = ReaspGeoIP::GetAddr();
                }

                $name = htmlspecialchars(strip_tags($_POST["name"]));
                $phone = htmlspecialchars(strip_tags($_POST["phone"]));
                $email = htmlspecialchars(strip_tags($_POST["email"]));
                $comment = htmlspecialchars(strip_tags($_POST["comment"]));

                if ($geo && $geo['COUNTRY_CODE'] == 'RU') {
                    $comment .= "\n\n Местоположение: {$geo['CITY']}, {$geo['REGION']}, {$geo['OKRUG']}";
                }

                if (mb_strlen($name) < 1) {
                    $result = ["status" => "error", "message" => GetMessage('MD_FEEDBACK_CHECK_FIELDS')];
                    $result["error_fields"][] = "name";
                }

                if (mb_strlen($email) < 5 && mb_strlen($phone) < 10) {
                    $result["status"] = "error";
                    $result["message"] .= GetMessage('MD_FEEDBACK_CHECK_CONTACTS');
                    $result["error_fields"][] = "email";
                    $result["error_fields"][] = "phone";
                }


                // Формируем массив значений
                $arFields = [
                    "form_text_1" => $name,
                    "form_text_2" => $phone,
                    "form_text_3" => $email,
                    "form_textarea_4" => $comment,
                    // скрытые поля
                    "form_text_5" => htmlspecialchars(strip_tags($_POST["page"])),
                    "form_text_6" => htmlspecialchars(strip_tags($_POST["type"])),
                    "form_text_12" => htmlspecialchars(strip_tags($_POST["organisation"])),

                ];

                $files_arr = $_FILES;

                $arFields = array_merge($arFields, $files_arr);

                if ($result["status"] != "error") {

                    // Подключаем модуль форм
                    CModule::IncludeModule('form');

                    // Создаем лид
                    if ($LID = CFormResult::Add(1, $arFields, "N")) {
                        $result = ["status" => "ok", "message" => GetMessage('MD_FEEDBACK_SUCCESS'), "lid" => $LID];
                    } else {
                        global $strError;
                        $result = ["status" => "error", "message" => $strError];
                    }
                }
            }
        } else {

            // Проверка не пройдена. Показываем ошибку. Или не показываем, зачем спамерам подсказывать что не прошло?
        }
    }



    // Когда лид создан
    if ($LID) {

        // Отправляем письмо на почту
        CFormResult::Mail($LID);

        //CRM Avivir
        //host: https://crm.avivir.ru/api/client/createDeal
        //API key 6f9f6fb9fad9022794957998323d996fe76d3c47
        /*
        __________________
        HTTP:
        POST /api/api/createDeal HTTP/1.1
        Host: localhost:1337
        apiKey: 6f9f6fb9fad9022794957998323d996fe76d3c47
        Content-Type: application/json
        Content-Length: 190

        {
            "id": 1,
            "name": "Евгений",
            "phone": "+79999999999",
            "email": "test@avivir.ru",
            "message": "что по чем",
            "ref": "http://avivir.ru/link",
            "type": "Тип запроса"
        }
        */


        $arFields = [
            "id" => $LID,
            "name" => $name,
            "phone" => $phone,
            "email" => $email,
            "message" => $comment,
            // скрытые поля
            "ref" => htmlspecialchars(strip_tags($_POST["page"])),
            "type" => htmlspecialchars(strip_tags($_POST["type"])),
        ];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crm.avivir.ru/api/client/createDeal',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($arFields),
            CURLOPT_HTTPHEADER => array(
                'apiKey: 6f9f6fb9fad9022794957998323d996fe76d3c47',
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        // debug 
        //$result['crm'] = $response;

        // Отправляем данные в битрикс24
        /*
        $lidID = CFormCrm::AddLead(1, $LID);
		$VALUE["form_text_25"] = $lidID;
		
		CFormResult::Update($LID, $VALUE, "N", "N");
		
		
		// Добавляем email в базу рассылки
		CModule::IncludeModule('subscribe');
		$subscr = new CSubscription;
		$arFields = Array(
			"USER_ID" => NULL,
			"FORMAT" => "html",
			"EMAIL" => $VALUE["form_text_3"],
			"ACTIVE" => "Y",
			"RUB_ID" => array(1),
			"CONFIRMED" => "Y",
			"SEND_CONFIRM" => "N"
		);
		$ID = $subscr->Add($arFields);
		// Выводим результат обработки	
		*/
    }

    echo json_encode($result);
}
