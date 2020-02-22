{* == ФОРМА ЗАКАЗА ЗВОНКА == *}
<div class="white-popup-block" style="width:{$cfg.width}px;">
    <form id="callme_form{$mid}" method="post" action="" name="callmeform">
        <input type="hidden" name="csrf_token" value="{csrf_token}"/>
        <input type="hidden" name="mid" value="{$mid}">
        <div id="{$cfg.prefix}popup" class="{$cfg.prefix}popup">
            <div class="popup_header"><h3>{$cfg.title}</h3></div>
            <div id="form_error"><span class="mess">Есть ошибки в форме</span></div>
            <div class="popup_fields">
                {if $cfg.showname}
                    <div class="form-group">
                        <label for="popup_name_{$mid}">Ваше имя:</label>
                        <input type="text" class="form-control" id="popup_name_{$mid}" placeholder="Ваше имя" name="name">
                    </div>
                {/if}
                {if $cfg.showemail}
                    <div class="form-group">
                        <label for="popup_email_{$mid}">Email: {if $cfg.email_mustbe}<span class="callstar">*</span>{/if}</label>
                        <input type="text" class="form-control{if $cfg.email_mustbe} c_required{/if}" id="popup_email_{$mid}" placeholder="my@gmail.com" name="email"{if $cfg.email_mustbe} required{/if}>
                    </div>
                {/if}
                {if $cfg.showphone}
                    <div class="form-group">
                        <label for="popup_phone_{$mid}">Телефон: {if $cfg.phone_mustbe}<span class="callstar">*</span>{/if}</label>
                        <input type="text" class="form-control{if $cfg.phone_mustbe} c_required{/if}" id="popup_phone_{$mid}" placeholder="+7(999)-999-99-99" name="phone"{if $cfg.phone_mustbe} required{/if}>
                    </div>
                {/if}
                {if $cfg.showcalltime && $cfg.showphone}
                    <div class="form-group">
                        <label for="popup_calltime_{$mid}">Время звонка:</label>
                        <input type="text" class="form-control" id="popup_calltime_{$mid}" placeholder="c 15-00 до 18-00" name="calltime">
                    </div>
                {/if}
                {if $cfg.showcomment}
                    <div class="form-group">
                        <label for="popup_comment_{$mid}">Комментарий:</label>
                        <textarea id="popup_comment_{$mid}" class="form-control" rows="3" style="resize: none" name="comment">{$cfg.commenttext}</textarea>
                    </div>
                {/if}
                <div class="text-center">
                    <a id="sendform" href="javascript:" class="btn btn-color btn-lg" onclick="sendCallmeForm({$mid});"><span>{$cfg.title}</span></a>
                </div>
                {if $cfg.showcalltime && $cfg.showphone}
                    <div class="text-center">
                        <div class="callmehint">* В указанное время сотрудник нашей компании свяжется с вами по телефону</div>
                    </div>
                {/if}
            </div>
        </div>
    </form>
</div>