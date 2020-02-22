<?php
/* ************************************************************************** */
/* created by soft-solution.ru, support@soft-solution.ru                      */
/* sendmail.php of module mod_callme for InstantCMS 1.10.6                    */
/* license: commercialcc                                                      */
/* Незаконное использование преследуется по закону                            */
/* ************************************************************************** */

    define('PATH', $_SERVER['DOCUMENT_ROOT']);
    include(PATH.'/core/ajax/ajax_core.php');

    $module_id         = $inCore->request('mid', 'int');
    if(!$module_id){ die(); }

    $cfg        = $inCore->loadModuleConfig($module_id);

    $name       = $inCore->request('name', 'str', '');
    $email      = $inCore->request('email', 'str', '');
    $phone      = $inCore->request('phone', 'str', '');
    $calltime   = $inCore->request('calltime', 'str', '');
    $comment    = $inCore->request('comment', 'str', '');

    $inUser->update();
    $url =  $_SERVER['HTTP_REFERER'];

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
        $letter = str_replace('{calltime}', $calltime ? 'Время звонка: '.$calltime : '', $letter);
        $letter = str_replace('{comment}', $comment ? 'Комментарий: '.$comment : '', $letter);
        $letter = str_replace('{url}', $url, $letter);
        $letter = str_replace('{ip}', $inUser->ip, $letter);

        $emails = array();

        if (!mb_strstr($cfg['emails'], ',')){
            $emails[] = trim($cfg['emails']);
        } else {
            $emails = explode(',', $cfg['emails']);
            foreach($tmp_emails as $email){
                $emails[] = trim($email);
            }
        }

        $inCore->mailText($emails, 'Новая заявка на сайте '.$inConf->sitename, $letter);
        $success = true;

    } else {
        $success = false;
    }

    if($success){
        //успешная отправка
        $class = 'call-success';
        $msg = 'Мы получили ваш запрос.<br /> Наш менеджер свяжется с вами в ближайшее время.';
    } else {
        //неудача
        $class = 'call-error';
        $msg = 'Возникла непредвиденная ошибка.<br />Мы работаем над ее устранением.<br />Попробуйте отправить заявку позже';
    }

    $html = '<div id="sendresult"><div class="'.$class.'">'.$msg.'</div></div>';

    if($success && $cfg['redirect'] && $cfg['target']){
        cmsCore::jsonOutput(array('redirect'=>$cfg['target']));
    } else {
        cmsCore::jsonOutput(array('html'=>$html, 'redirect'=>false));
    }

?>
