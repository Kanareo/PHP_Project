{extends file="main.tpl"}

{block name=content}
    <h2><strong>Informacja o użytkowniku</strong></h2>
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
            <tr>
                <td>{$users['id_user']}</td>
                <td>{$users['first_name']}</td>
                <td>{$users['second_name']}</td>
                <td>{$users['email']}</td>
                <td>{$users['phone']}</td>
                <form action="{$conf->action_url}userUpdateSave/{$users['id_user']}" method="post">
                <td>
                <select name="blocked">
                        {foreach $blocked as $b}
                            {strip}
                                <option value="{$b['blocked']}">
                                {if $b['blocked'] == 0}Nie{else}Tak{/if}
                                </option>
                            {/strip}
                        {/foreach}
                </select>       
                </td>
                <td>{$users['role']}</td>
                <td><input type="submit" value="Aktualizuj" style="margin-top: 5%; margin-bottom: 5%"/></td>
                </form>
            </tr>
        </tbody>
    </table>
{/block}