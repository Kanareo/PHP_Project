{extends file="main.tpl"}

{block name=content}
    <h2><strong>Lista użytkowników</strong></h2>
    <h5><strong style="color: white">Wyszukaj użytkownika</strong></h5>
    <form action="{$conf->action_url}userAddSave" method="post">
        <p style="margin-bottom: 1%">
            <input id="first_name" type="text" name="first_name" value=""/>
        </p>
        <p style="margin-bottom: 1%">
            <input id="second_name" type="text" name="second_name" value=""/>
        </p>
        <p style="margin-bottom: 1%">
            <input id="email" type="text" name="email" value=""/>
        </p>
        <p style="margin-bottom: 1%">
            <input id="phone" type="text" name="phone" value=""/>
        </p>
        <p style="margin-bottom: 1%">
            <input id="password" type="text" name="password" value=""/>
        </p>
        <select name="blocked">
            {foreach $blocked as $b}
                {strip}
                    <option value="{$b['blocked']}">
                        {if $b['blocked'] == 0}Nie{else}Tak{/if}
                    </option>
                {/strip}
            {/foreach}
        </select>
        <select name="role">
            {foreach $role as $r}
                {strip}
                    <option value="{$r['role']}">
                        {$r['role']}
                    </option>
                {/strip}
            {/foreach}
        </select>
        <p>
            <input type="submit" value="Dodaj użytkownika" style="margin-top: 5%; margin-bottom: 5%"/>
        </p>
    </form>
    {include file='messages.tpl'}
{/block}
