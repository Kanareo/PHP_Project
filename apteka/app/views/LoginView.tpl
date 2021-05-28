{extends file="main.tpl"}

{block name=content}
<div style="min-height:43.55em;padding:4em">
    <form action="{$conf->action_url}login" method="post">
        <p><label for="id_login">Email: </label>
        <input id="id_login" type="text" name="login" /></p>
        <p><label for="id_pass">Hasło: </label>
        <input id="id_pass" type="password" name="pass" /></p>
        <p><input type="submit" value="Zaloguj" /></p>
    </form>
    {include file='messages.tpl'}
</div>
    
{/block}
