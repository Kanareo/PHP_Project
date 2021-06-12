{extends file="main.tpl"}

{block name=content}
    <h2><strong>Lista użytkowników</strong></h2>
    <h5><strong style="color: white">Wyszukaj użytkownika</strong></h5>
    <form action="{$conf->action_url}adminPanel" method="post">
        <p style="margin-bottom: 1%">
            <input id="id" type="text" name="id" value=""/>
        </p>
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
        <select name="brand">
            <option value="" >-----</option>
            {foreach $blocked as $b}
                {strip}
                    <option value="{$b['blocked']}">
                        {$b['blocked']}
                    </option>
                {/strip}
            {/foreach}
        </select>
        <select name="category">
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
            <thead>
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
            <tbody>
                {foreach $users as $u}
                    <tr>
                        <td>{$u['id_user']}</td>
                        <td>{$u['first_name']}</td>
                        <td>{$u['second_name']}</td>
                        <td>{$u['email']}</td>
                        <td>{$u['phone']}</td>
                        <td>{$u['blocked']}</td>
                        <td>{$u['role']}</td>
                        <td><a href="{url action='userView'}">INFO</a></td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
    {/if}
{/block}
