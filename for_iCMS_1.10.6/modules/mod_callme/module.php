<?php
/* ************************************************************************** */
/* created by soft-solution.ru, support@soft-solution.ru                      */
/* module.php of module mod_callme for InstantCMS 1.10.6                      */
/* license: commercialcc                                                      */
/* Незаконное использование преследуется по закону                            */
/* ************************************************************************** */

function mod_callme($mod, $cfg){

	$inConf     = cmsConfig::getInstance();
	$inPage     = cmsPage::getInstance();

	if (!isset($cfg['phone'])) { $cfg['phone'] = '0 (000) 000-00-00'; }
	if (!isset($cfg['show_phone_block'])) { $cfg['show_phone_block'] = 1; }
	if (!isset($cfg['operating'])) { $cfg['operating'] = 'Звоните с 8.00 до 19.00'; }
	if (!isset($cfg['show_operating_block'])) { $cfg['show_operating_block'] = 1; }
	if (!isset($cfg['show_button_block'])) { $cfg['show_button_block'] = 1; }
	if (!isset($cfg['showname'])) { $cfg['showname'] = 1; }
	if (!isset($cfg['showphone'])) { $cfg['showphone'] = 1; }
	if (!isset($cfg['phone_mustbe'])) { $cfg['phone_mustbe'] = 1; }
	if (!isset($cfg['showemail'])) { $cfg['showemail'] = 1; }
	if (!isset($cfg['email_mustbe'])) { $cfg['email_mustbe'] = 0; }
	if (!isset($cfg['showcalltime'])) { $cfg['showcalltime'] = 1; }
	if (!isset($cfg['showcomment'])) { $cfg['showcomment'] = 1; }
	if (!isset($cfg['prefix'])) { $cfg['prefix'] = "callme_"; }

	$inPage->addHeadCSS('templates/'.$inConf->template.'/css/callme.css');
	$inPage->addHeadJS('templates/'.$inConf->template.'/js/callme.js');

	cmsPage::initTemplate('modules', 'mod_callme')->
		assign('cfg', $cfg)->
		assign('mid', $mod['id'])->
		display('mod_callme.tpl');

	return true;
}
?>