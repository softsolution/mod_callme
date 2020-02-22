<?php
/* ************************************************************************** */
/* created by soft-solution.ru, support@soft-solution.ru                      */
/* getform.php of module mod_callme for InstantCMS 1.10.6                     */
/* license: commercialcc                                                      */
/* Незаконное использование преследуется по закону                            */
/* ************************************************************************** */

    define('PATH', $_SERVER['DOCUMENT_ROOT']);
    include(PATH.'/core/ajax/ajax_core.php');

    $module_id = $inCore->request('module_id', 'int');
    if(!$module_id){ die(); }
    $cfg       = $inCore->loadModuleConfig($module_id);

    if (!isset($cfg['width'])) { $cfg['width'] = 500; }

    ob_start();

    cmsPage::initTemplate('modules', 'mod_callme_form')->
        assign('cfg', $cfg)->
        assign('mid', $module_id)->
        display('mod_callme_form.tpl');

    $html = ob_get_clean();

    $inCore->halt($html);

?>
