{* == МОДУЛЬ ЗАКАЗА ЗВОНКА == *}

{*Условия для показа блока с телефоном и кнопкой заказа звонка *}
{if $cfg.show_phone_block || ($cfg.show_operating_block && $cfg.operating) || $cfg.show_button_block}
<div id="{$cfg.prefix}module" class="mod-call">
    {* Телефон *}
    {if $cfg.show_phone_block}
        <div class="phone">{$cfg.phone}</div>
    {/if}
    {* Время работы *}
    {if $cfg.show_operating_block && $cfg.operating}
        <div class="operating">{$cfg.operating}</div>
    {/if}
    {* Кнопка - ссылка заказа звонка *}
    {if $cfg.show_button_block}
    <div class="but_block">
        <a href="/modules/mod_callme/ajax/getform.php?module_id={$mid}" class="getpopupcallme dashed" id="callmebut{$mid}"><span class="dashed">{$cfg.title}</span></a>
    </div>
    {/if}
</div>
{/if}