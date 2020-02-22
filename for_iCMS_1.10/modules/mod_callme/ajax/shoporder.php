<?php
//создает форму для конкретной заявки на позицию магазина
//используется скрытый модуль, отображемый на всех страницах сайта

/*==================================================*/
/*            created by soft-solution.ru           */
/*==================================================*/

    if ($_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') { die();}
    header('Content-Type: text/html; charset=utf-8');
    session_start();

    define("VALID_CMS", 1);
    define('PATH', $_SERVER['DOCUMENT_ROOT']);

    //PROTECT FROM DIRECT RUN
    if (isset($_REQUEST['sid'])){
        if (md5(session_id()) != $_REQUEST['sid']){ die(); }
    } else {
        die();
    }

    // Грузим ядро и классы
    include(PATH.'/core/cms.php');

    // Грузим конфиг
    include(PATH.'/includes/config.inc.php');
    $inCore = cmsCore::getInstance();

    define('HOST', 'http://' . $inCore->getHost());

    $inCore->loadClass('config');
    $inCore->loadClass('db');
    $inCore->loadClass('user');
    $inCore->loadClass('page');
    $inDB   = cmsDatabase::getInstance();

    $id     = $inCore->request('id', 'int', '');// id позиции магазина
    $module_id     = $inCore->request('mid', 'int', '');
    $cfg    = $inCore->loadModuleConfig($module_id);

    if(!$cfg || !$module_id || !$id) { $errors = true; }

    if (!isset($cfg['phone'])) { $cfg['phone'] = '0 (000) 000-00-00'; }
    if (!isset($cfg['showname'])) { $cfg['showname'] = 1; }
    if (!isset($cfg['showemail'])) { $cfg['showemail'] = 1; }
    if (!isset($cfg['showcalltime'])) { $cfg['showcalltime'] = 1; }
    if (!isset($cfg['showcomment'])) { $cfg['showcomment'] = 1; }

    if(!$errors){

        //вытаскиваем название позиции и проверяем ее сучествование

        $sql = "SELECT title, seolink FROM cms_shop_items WHERE published = 1 AND id = $id LIMIT 1";
        $result = $inDB->query($sql);

        if ($inDB->num_rows($result)) {
            $position = $inDB->fetch_assoc($result);
        }

        // Грузим шаблонизатор
        $smarty = $inCore->initSmarty();

        // Отдаем в шаблон
        ob_start();
        $smarty = $inCore->initSmarty('modules', 'mod_callme_form.tpl');
        $smarty->assign('cfg', $cfg);
        $smarty->assign('position', $position);
        $smarty->assign('sid', md5(session_id()));
        $smarty->assign('mid', $module_id);
        $smarty->display('mod_callme_form.tpl');
        $html = ob_get_clean();
    }


    if($errors) {$html = '<div id="callmuresult126"><div class="alert alert-error">Произошла непредвиденная ошибка!<br />Пожалуйста, повторите попытку позже</div></div>';}

    echo $html;
?>