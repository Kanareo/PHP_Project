{extends file="main.tpl"}

{block name=content}
    <h2><strong>Lista użytkowników</strong></h2>
    <form action="{$conf->action_url}adminPanel" method="post">
            <input id="id" type="text" name="id" value="" placeholder="ID użytkownika" style="margin-bottom: 1%"/>
            <input id="first_name" type="text" name="first_name" value="" placeholder="Imie użytkownika" style="margin-bottom: 1%"/>
            <input id="second_name" type="text" name="second_name" value="" placeholder="Nazwisko użytkownika" style="margin-bottom: 1%"/>
            <input id="email" type="text" name="email" value="" placeholder="Email użytkownika" style="margin-bottom: 1%"/>
            <input id="phone" type="text" name="phone" value="" placeholder="Nr telefonu użytkownika" style="margin-bottom: 1%"/>
        <select name="blocked" style="margin-bottom: 1%">
            <option value="" selected>-----</option>
            {foreach $blocked as $b}
                {strip}
                    <option value="{$b['blocked']}">
                        {if $b['blocked'] == 0}Nie{else}Tak{/if}
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
        <p>
            <input type="submit" value="Wyszukaj" style="margin-top: 5%; margin-bottom: 5%"/>
        </p>
    </form>
    {if count($users) > 0}
        <table>
            <thead style="color: white; font-weight: bold">
                <tr>
                    <th>ID</th>
                    <th>Imię</th>
                    <th>Nazwisko</th>
                    <th>Email</th>
                    <th>Telefon</th>
                    <th>Zablokowany</th>
                    <th>Rola</th>
                </tr>
            </thead>
            <tbody style="color: lightgray">
                {foreach $users as $u}
                    <tr>
                        <td>{$u['id_user']}</td>
                        <td>{$u['first_name']}</td>
                        <td>{$u['second_name']}</td>
                        <td>{$u['email']}</td>
                        <td>{$u['phone']}</td>
                        <td>{if $u['blocked'] == 1}Tak{else}Nie{/if}</td>
                        <td>{$u['role']}</td>
                        <td><a href="{url action='userInfo' user=$u['id_user']}">INFO</a></td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
    {/if}
{/block}
