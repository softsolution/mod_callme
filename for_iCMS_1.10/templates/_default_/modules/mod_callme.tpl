{* FANCYBOX http://www.fancybox.net *}
<link media="screen" href="/templates/{template}/css/callme.css" type="text/css" rel="stylesheet">
{if $cfg.connectjs}
<script src="/modules/mod_callme/fancybox/jquery.fancybox-1.3.4.js" type="text/javascript"></script>
<link media="screen" href="/modules/mod_callme/fancybox/jquery.fancybox.css" type="text/css" rel="stylesheet">
{/if}

<div id="{$cfg.prefix}module">
    
    {* КНОПКА ЗАКАЗА ЗВОНКА *}
    {if $cfg.show_phone_block || $cfg.show_button_block}
    <div class="button_wrap">
    {if $cfg.show_phone_block}
        <span class="phone">{$cfg.phone}</span>
    {/if}
    {* Сюда можно дописать время работы *}
    
    {if $cfg.show_button_block}
        <span class="but_block">
            <a href="#callme_form{$mid}" class="but_callme" id="callmebut{$mid}"><span>{$cfg.title}</span></a>
        </span>
    {/if}
    </div>
    {/if}

    {* ФОРМА ОТПРАВКИ ЗАЯВКИ *}
    {if $cfg.generateform}
    <div style="display:none">
        {include file='mod_callme_form.tpl'}
    </div>
    {/if}
    
</div>
    
	{literal}
<script type="text/javascript">
$(document).ready(function() {
    $("a[id=callmebut{/literal}{$mid}{literal}]").fancybox({
        'scrolling' : 'no',
        'titleShow' : false,
        'width' : {/literal}{$cfg.width}{literal},
        'height' : {/literal}{$cfg.height}{literal},
        'autoDimensions' : false,
        'showNavArrows'  : false,
        'centerOnScroll' : true,
        'onClosed' : function() {
            $("#form_error .mess").hide();
        }
    });
        
    $("#callme_form{/literal}{$mid}{literal} #sendform").live("click", function() {{/literal}
        var errors = '';
    {if $cfg.phone_mustbe && $cfg.showphone}
        {literal}
        var phone = $("#callme_form{/literal}{$mid}{literal} #phone").attr('value');
        var pattern_phone = /^([0-9-()+\s]+)$/;
        if (phone.length < 5 || !pattern_phone.test(phone)) {
            errors ="Не корректный телефон";
        }
        {/literal}
    {/if}
    {if $cfg.email_mustbe && $cfg.showemail}
        {literal}
        var email = $("#callme_form{/literal}{$mid}{literal} #email").attr('value');
        var pattern_email = /^[a-zA-Z0-9_\.\-]+\@([a-zA-Z0-9\-]+\.)+[a-zA-Z0-9]{2,4}$/;  
        if (!pattern_email.test(email)) {
            if(errors){errors = errors + ', ';}
            errors = errors + "Не корректный E-mail";
        }
        {/literal}
    {/if}
    {literal}
        if(errors){
            $("#callme_form{/literal}{$mid}{literal} .mess").html(errors).show();
            return false;
        } else {
            $("#callme_form{/literal}{$mid}{literal} .mess").hide();
        }
        $.fancybox.showActivity();
        $.ajax({
            type : "POST",
            cache : false,
            url : "/modules/mod_callme/ajax/sendmail.php",
            data : $("#callme_form{/literal}{$mid}{literal}").serializeArray(),
            success: function(data) {{/literal}
                {if $cfg.redirect}
                    window.location.href = "{if $cfg.target}{$cfg.target}{else}/{/if}";
                {else}
                    $.fancybox(data);
                {/if}{literal}
            }
        });
        return false;
    });


});
</script>
{/literal}