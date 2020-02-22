<?php
/* ****************************************************************************************** */
/* created by soft-solution.ru                                                                */
/* sendmail.php of module mod_callme for InstantCMS 1.10.1                                    */
/* ****************************************************************************************** */

    define('PATH', $_SERVER['DOCUMENT_ROOT']);
    include(PATH.'/core/ajax/ajax_core.php');

    //PROTECT FROM DIRECT RUN
    if (isset($_REQUEST['sid'])){
        if (md5(session_id()) != $_REQUEST['sid']){ die(); }
    } else {
        die();
    }

    $module_id         = $inCore->request('mid', 'int', '');
    $cfg               = $inCore->loadModuleConfig($module_id);

    //Расширение для подачи заявки на конкретную позицию - компоненты catalog + InstantShop
    $position   = $inCore->request('position', 'str', '');
    $link       = $inCore->request('link', 'str', '');
    
    $name       = $inCore->request('name', 'str', '');
    $phone      = $inCore->request('phone', 'str', '');
    $email      = $inCore->request('email', 'str', '');
    $calltime   = $inCore->request('calltime', 'str', '');
    $comment    = $inCore->request('comment', 'str', '');

    if($cfg['emails']){

        //подготавливаем письмо

        // Загружаем шаблон письма
        $letter_path = PATH.'/modules/mod_callme/callme.txt';
        $letter      = file_get_contents($letter_path);

        // Заменяем теги в шаблоне на текст
        $letter = str_replace('{sitename}', $inConf->sitename, $letter);
        $letter = str_replace('{order_type}', $cfg['title'], $letter);
        $letter = str_replace('{name}', $name, $letter);
        $letter = str_replace('{phone}', $phone, $letter);
        $letter = str_replace('{email}', $email, $letter);
        $letter = str_replace('{calltime}', $calltime, $letter);
        $letter = str_replace('{comment}', $comment, $letter);
        $letter = str_replace('{position}', $position, $letter);
        $letter = str_replace('{link}', $link, $letter);

        $emails = array();

        if (!strstr($cfg['emails'], ',')){
            // указан один адрес
            $emails[] = $cfg['emails'];
        } else {
            // указано несколько адресов через запятую
            $emails = explode(',', $cfg['emails']);
        }

        foreach($emails as $email){
            $email = trim($email);
            $inCore->mailText($email, 'Новая заявка на сайте '.$inConf->sitename, $letter);
        }

        $success = true;

    } else {
        die();
    }


if($success){
    //успешная отправка
    $class = 'alert-success';
    $msg = 'Мы получили ваш запрос.<br /> Наш менеджер свяжется с вами в ближайшее время.';
} else {
    //неудача
    $class = 'alert-error';
    $msg = 'Возникла непредвиденная ошибка.<br /> Мы работаем над ее устранением.<br /> Попробуйте отправить заявку позже';
}
$msg = '<div id="sendresult"><div class="'.$class.'">'.$msg.'</div></div>';

echo $msg;
?>
