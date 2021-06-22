{extends file="main.tpl"}

{block name=content}
<div>
    <form action="{$conf->action_url}login" method="post">
        <p style="margin-bottom: 1%"><label for="id_login" style="color: white; margin-bottom: 0px;">Email: </label>
        <input id="id_login" type="text" name="login" /></p>
        <p><label for="id_pass" style="color: white; margin-bottom: 0px;">Hasło: </label>
        <input id="id_pass" type="password" name="pass" /></p>
        <p><input type="submit" value="Zaloguj" style="margin-top: 5%"/></p>
    </form>
    <div style="font-weight: bold">
        {include file='messages.tpl'}
    </div>
</div>
    
{/block}
