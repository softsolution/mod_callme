<form id="callme_form{$mid}" method="post" action="" name="callmeform">
    <div id="{$cfg.prefix}popup">
        <div class="popup_header"><h3>{$cfg.title}</h3></div>

        <div class="popup_fields">
            {* Расширение для подачи заявки на конкретную позицию - компоненты catalog + InstantShop *}
            {if $position}
                <div id="position">
                    <span class="title"><a href="{$position.link}">{$position.title}</a></span>
                    <input type="hidden" name="position" value="{$position.title}">
                    <input type="hidden" name="link" value="{$position.link}">
                </div>
            {/if}

            <div id="form_error"><span class="mess"></span></div>
            <input type="hidden" name="sid" value="{$sid}">
            <input type="hidden" name="mid" value="{$mid}">

            <table width="100%" border="0">
                {if $cfg.showname}
                <tr>
                    <td width="180">
                        <span class="callfield">Ваше имя:</span>
                    </td>
                    <td>
                        <input name="name" class="callvalue" value="">
                    </td>
                </tr>
                <tr height="10"><td colspan="2"></td></tr>
                {/if}

                {if $cfg.showphone}
                <tr>
                    <td>
                        <span class="callfield">Телефон:</span>{if $cfg.phone_mustbe}<span class="callstar">*</span>{/if}
                    </td>
                    <td>
                        <input name="phone" id="phone" class="callvalue" value="">
                    </td>
                </tr>
                <tr height="10"><td colspan="2"></td></tr>
                {/if}

                {if $cfg.showemail}
                <tr>
                    <td>
                        <span class="callfield">E-mail:</span>{if $cfg.email_mustbe}<span class="callstar">*</span>{/if}
                    </td>
                    <td>
                        <input name="email" id="email" class="callvalue" value="">
                    </td>
                </tr>
                <tr height="10"><td colspan="2"></td></tr>
                {/if}

                {if $cfg.showcalltime && $cfg.showphone}
                <tr>
                    <td>
                        <span class="callfield">Время звонка:*</span>
                    </td>
                    <td>
                        <input name="calltime" class="callvalue" value="">
                    </td>
                </tr>
                <tr height="10"><td colspan="2"></td></tr>
                {/if}

                {if $cfg.showcomment}
                <tr>
                    <td valign="top">
                        <span class="callfield">Комментарий:</span>
                    </td>
                    <td>
                        <textarea rows="3" id="comment" class="calltextarea" name="comment">{$cfg.commenttext}</textarea>
                    </td>
                </tr>
                <tr height="10"><td colspan="2"></td></tr>
                {/if}
                
                <tr><td></td>
                    <td>
                        <div class="control">
                            <a id="sendform" href="#" class="but_sendform"><span>{$cfg.title}</span></a>
                        </div>
                    </td>
                </tr>
                
                {if $cfg.showcalltime && $cfg.showphone}
                <tr>
                    <td colspan=2>
                        <div class="callmehint">* В указанное время сотрудник нашей компании свяжется с вами по телефону</div>
                    </td>
                </tr>
                {/if}
            </table>
        </div>
    </div>
</form>