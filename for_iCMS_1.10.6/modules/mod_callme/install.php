<?php
/* ************************************************************************** */
/* created by soft-solution.ru, support@soft-solution.ru                      */
/* module.php of module mod_callme for InstantCMS 1.10.6                      */
/* license: commercialcc                                                      */
/* Незаконное использование преследуется по закону                            */
/* ************************************************************************** */

    function info_module_mod_callme(){

        $_module['title']         = 'Заказать звонок';
        $_module['name']          = 'Заказать звонок';
        $_module['description']   = 'Модуль создает на сайте всплывающую форму заказа звонка, которая отправляется на e-mail';
        $_module['link']          = 'mod_callme';
        $_module['position']      = 'sidebar';
        $_module['author']        = '<a href="http://soft-solution.ru" target="_blank">soft-solution.ru</a>';
        $_module['version']       = '1.3';

        $_module['config'] = array();
        $_module['config']['title']='Заказать звонок';
        $_module['config']['emails']='sample@mail.ru';
        $_module['config']['width']='500';
        $_module['config']['height']='430';
        $_module['config']['phone']='0 (000) 000-00-00';
        $_module['config']['show_phone_block']='1';
        $_module['config']['operating']='Звоните с 8.00 до 19.00';
        $_module['config']['show_operating_block']='1';
        $_module['config']['show_button_block']='1';
        $_module['config']['showname']='1';
        $_module['config']['phone_mustbe']='1';
        $_module['config']['showemail']='1';
        $_module['config']['email_mustbe']='0';
        $_module['config']['showcalltime']='1';
        $_module['config']['showcomment']='1';
        $_module['config']['commenttext']='';
        $_module['config']['prefix']='callme_';
        $_module['config']['generateform']='1';
        $_module['config']['redirect']='';

        return $_module;

    }

    function install_module_mod_callme(){

        return true;

    }

    function upgrade_module_mod_callme(){

        return true;

    }

?>