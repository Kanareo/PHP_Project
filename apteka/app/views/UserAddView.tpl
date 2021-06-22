{extends file="main.tpl"}

{block name=content}
    <h2><strong>Dodaj użytkownika</strong></h2>
    <form action="{$conf->action_url}userAddSave" method="post">
        <p style="margin-bottom: 1%">
            <input id="first_name" type="text" name="first_name" value="" placeholder="Imie użytkownika" style="width: 166.9%"/>
        </p>
        <p style="margin-bottom: 1%">
            <input id="second_name" type="text" name="second_name" value="" placeholder="Nazwisko użytkownika" style="width: 166.9%"/>
        </p>
        <p style="margin-bottom: 1%">
            <input id="email" type="text" name="email" value="" placeholder="Email użytkownika" style="width: 166.9%"/>
        </p>
        <p style="margin-bottom: 1%">
            <input id="phone" type="text" name="phone" value="" placeholder="Nr telefonu użytkownika" style="width: 166.9%"/>
        </p>
        <p style="margin-bottom: 1%">
            <input id="password" type="text" name="password" value="" placeholder="Haslo użytkownika" style="width: 166.9%"/>
        </p>
        <p style="margin-bottom: 1%; color: white; text-align: left; font-size: 120%">Status aktywacji:</p>
        <select id="blocked" name="blocked" style="margin-bottom: 1%">
            <option value="0">Nie</option>
            <option value="1">Tak</option>
        </select>
        <p style="margin-bottom: 1%; color: white; text-align: left; font-size: 120%">Rola użytkownika:</p>
        <select name="role">
            <option value="user">Użytkownik</option>
            <option value="admin">Administrator</option>
        </select>
        <p>
            <input type="submit" value="Dodaj użytkownika" style="margin-top: 5%; margin-bottom: 5%"/>
        </p>
    </form>
    {include file='messages.tpl'}
{/block}
