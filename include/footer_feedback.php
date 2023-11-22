<? // START: Get consultation 
?>
<div class="content-block-ContentBlock-module-block contacts-Form-module-block">
    <div class="content-block-ContentBlock-module-info">

        <? if ($arParams["SHOW_BREADCRUMBS"] == "Y") : ?>
            <? $APPLICATION->IncludeComponent(
                "bitrix:breadcrumb",
                "breadcrumb",
                array(
                    "COMPONENT_TEMPLATE" => "breadcrumb",
                    "START_FROM" => "0",
                    "PATH" => "",
                    "SITE_ID" => "s1"
                ),
                false
            ); ?>
        <? endif ?>
        <h2 class="content-block-ContentBlock-module-title content-block-ContentBlock-module-title-big">
            Оставьте заявку и получите коммерческое предложение
        </h2>
        <div class="content-block-ContentBlock-module-content contacts-Form-module-block-wrapper contacts-Form-module-contacts">

            <form action="" id="consultationForm" enctype="multipart/form-data">

                <input type="hidden" name="page" value="https://<?= $_SERVER['HTTP_HOST'] ?><?= $APPLICATION->GetCurPage() ?>" />
                <input type="hidden" name="type" value="простое заполнение формы" id="formTypeValue" />
                <input type="hidden" name="recaptcha_response" id="recaptchaResponse">

                <input type="text" style="left:-10000px;position: absolute;" name="default" value="" />

                <label>
                    <input class="contacts-Form-module-input" placeholder="ФИО*" type="text" name="name" required="" />
                </label>
                <div class="contacts-CheckBox-module-wrapper contacts-Form-module-type">
                    <input class="contacts-CheckBox-module-checkbox" type="radio" name="human_type" id="human_type_1" required="" />
                    <label for="human_type_1" class="contacts-CheckBox-module-label">Юридическое лицо
                        <span class="contacts-CheckBox-module-checkmark">
                            <span class="contacts-CheckBox-module-checked"></span>
                        </span>
                    </label>
                </div>
                <div class="contacts-CheckBox-module-wrapper contacts-Form-module-type">
                    <input class="contacts-CheckBox-module-checkbox" type="radio" name="human_type" id="human_type_2" required="" />
                    <label for="human_type_2" class="contacts-CheckBox-module-label">Физическое лицо
                        <span class="contacts-CheckBox-module-checkmark">
                            <span class="contacts-CheckBox-module-checked"></span>
                        </span>
                    </label>
                </div>
                <label>
                    <input class="contacts-Form-module-input" placeholder="Организация*" type="text" name="organisation" />
                </label>
                <label>
                    <input class="contacts-Form-module-input" placeholder="+7 999 99 99*" type="text" name="phone" required="" />
                </label>
                <label>
                    <input class="contacts-Form-module-input" placeholder="Почта*" type="text" name="email" required="" pattern=".+(@)(.+)(\.)(.+)$" />
                </label>
                <label>
                    <textarea placeholder="Текст*" name="comment" class="contacts-Form-module-textarea"></textarea>
                </label>
                <div>
                    <label class="contacts-Form-module-file">
                        <input hidden name="MAX_FILE_SIZE" value="1048576">
                        <input class="contacts-Form-module-input" type="file" multiple id="js-file" />
                        <img class="contacts-Form-module-file-cross" src="/upload/images/static_media/icons/file-cross.svg">
                    </label>
                </div>
                <div class="contacts-CheckBox-module-wrapper contacts-Form-module-agreement">
                    <input class="contacts-CheckBox-module-checkbox" type="checkbox" name="agreement" id="agreement" required />
                    <label for="agreement" class="contacts-CheckBox-module-label">Я согласен с
                        <a href="/privacy" target="_blank" rel="noreferrer">Политикой обработки персональных данных</a>
                        <span class="contacts-CheckBox-module-checkmark">
                            <span class="contacts-CheckBox-module-checked"></span>
                        </span>
                    </label>
                </div>
                <button class="button-Button-module-button" type="submit" id="consultationFormSubmit">Отправить</button>
                <p id="feedbackResult"></p>
            </form>
        </div>
        <div class="content-block-ContentBlock-module-bottom"></div>
    </div>
    <div class="content-block-ContentBlock-module-image">
        
        <img class="contacts-Form-module-banner" src="/upload/images/static_media/contacts/banner.png" alt="contacts" />
    </div>
</div>

<script>
    $('#consultationForm input').focus(function() {
        $(".c-form-textfield").removeClass("is-invalid");
        $(".c-form-message").hide();
    });

    $('#consultationForm').submit(function(e) {

        e.preventDefault();

        let $form = $(this);
        let url = '/local/tools/feedback.php';
        let params = $form.serializeArray();

        $('#consultationFormSubmit').addClass('is-loading');

        //validate


        var formData = new FormData();

        for (const key in params) {
            formData.append(params[key]['name'], params[key]['value']);
        }

        var counter = 6

        $.each($("#js-file")[0].files, function(key, input) {
            counter += 1
            console.log('aaaaaaa')
            formData.append('form_file_' + counter, input);
        });


        var $fileUpload = $("input[type='file']");
        if (parseInt($fileUpload.get(0).files.length) > 5) {
            alert("Вы можете загрузить до 5-ти файлов.");
        } else {
            $.ajax({
                type: "POST",
                url: url,
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                dataType: 'json',
                success: function(data) {
                    // result = JSON.parse(data);
                    // console.log(data)
                    if (data['status'] == 'ok') {
                        $('#feedbackResult').append(data['message']);
                        $("#consultationFormSubmit").remove();
                    }
                }
            });
        }

        // $.post(url, params, function(data) {

        //     result = JSON.parse(data);

        //     if (result.status == 'error') {
        //         // result.error_fields.forEach(function(field, i, arr) {
        //         //     $container = $form.find('input[name=' + field + ']').closest(".c-form-textfield");
        //         //     $container.addClass("is-invalid");
        //         //     $container.find(".c-form-message").show();
        //         // });

        //         $('#consultationFormSubmit').removeClass('is-loading');
        //     }

        //     if (result.status == 'ok') {
        //         $("#consultationForm").addClass('is-success');

        //         $("#feedbackResult").html(result.message);
        //     }
        // });
    });
</script>