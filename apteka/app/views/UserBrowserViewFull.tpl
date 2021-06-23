{extends file="main.tpl"}

{block name=content}
    <h2><strong>Lista użytkowników</strong></h2>
    <form id="form" onsubmit="ajaxPostForm('form','{$conf->action_root}userBrowserData','data'); return false;">
        <input id="id" type="text" name="id" value="" placeholder="ID użytkownika" style="margin-bottom: 1%"/>
        <input id="first_name" type="text" name="first_name" value="" placeholder="Imie użytkownika" style="margin-bottom: 1%"/>
        <input id="second_name" type="text" name="second_name" value="" placeholder="Nazwisko użytkownika" style="margin-bottom: 1%"/>
        <input id="email" type="text" name="email" value="" placeholder="Email użytkownika" style="margin-bottom: 1%"/>
        <input id="phone" type="text" name="phone" value="" placeholder="Nr telefonu użytkownika" style="margin-bottom: 1%"/>
        <select name="blocked" style="margin-bottom: 1%">
            <option value="" selected>Wszystkie statusy blokady</option>
            {foreach $blocked as $b}
                {strip}
                    <option value="{$b['blocked']}">
                        {if $b['blocked'] == 0}Nie - niezablokowani{else}Tak - zablokowani{/if}
                    </option>
                {/strip}
            {/foreach}
        </select>
        <select name="role">
            <option value="">Wszystkie role</option>
            {foreach $role as $r}
                {strip}
                    <option value="{$r['role']}">
                        {$r['role']}
                    </option>
                {/strip}
            {/foreach}
        </select>
        <input type="submit" style="padding: 1.15em 3em; margin: 1%; font-size: 120%" value="Wyszukaj" style="margin-top: 5%; margin-bottom: 5%"/>
        <a class="button" style="padding: 1.3em 3em; margin: 1%; font-size: 120%" onclick="document.getElementById('form').reset(); ajaxPostForm('form','{$conf->action_root}userBrowserData','data');">Wyczyść</a>
    </form>
    <div id="data">
        {include file="UserBrowserViewData.tpl"}
    </div>
{/block}
