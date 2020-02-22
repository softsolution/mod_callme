<?php
/* ****************************************************************************************** */
/* created by soft-solution.ru                                                                */
/* module.php of module mod_callme for InstantCMS 1.10                                        */
/* ****************************************************************************************** */

function mod_callme($module_id){

        $inCore = cmsCore::getInstance();
        $cfg    = $inCore->loadModuleConfig($module_id);
        
        if (!isset($cfg['width'])) { $cfg['width']=500; }
        if (!isset($cfg['height'])) { $cfg['height']=430; }
        if (!isset($cfg['phone'])) { $cfg['phone'] = '0 (000) 000-00-00'; }
        if (!isset($cfg['showphone'])) { $cfg['showphone'] = 1; }
        if (!isset($cfg['showbutton'])) { $cfg['showbutton'] = 1; }
        if (!isset($cfg['showname'])) { $cfg['showname'] = 1; }
        if (!isset($cfg['showphone'])) { $cfg['showphone'] = 1; }
        if (!isset($cfg['phone_mustbe'])) { $cfg['phone_mustbe'] = 1; }
        if (!isset($cfg['showemail'])) { $cfg['showemail'] = 1; }
        if (!isset($cfg['email_mustbe'])) { $cfg['email_mustbe'] = 0; }
        if (!isset($cfg['showcalltime'])) { $cfg['showcalltime'] = 1; }
        if (!isset($cfg['showcomment'])) { $cfg['showcomment'] = 1; }
        if (!isset($cfg['prefix'])) { $cfg['prefix'] = "callme_"; }

        $smarty = $inCore->initSmarty('modules', 'mod_callme.tpl');
        $smarty->assign('cfg', $cfg);
        $smarty->assign('sid', md5(session_id()));
        $smarty->assign('mid', $module_id);
        $smarty->display('mod_callme.tpl');

        return true;
}
?>