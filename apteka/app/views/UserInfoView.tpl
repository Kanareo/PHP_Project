{extends file="main.tpl"}

{block name=content}
    <h2><strong>Informacja o użytkowniku</strong></h2>
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
            <tr>
                <td>{$users['id_user']}</td>
                <td>{$users['first_name']}</td>
                <td>{$users['second_name']}</td>
                <td>{$users['email']}</td>
                <td>{$users['phone']}</td>
                <td>{if $users['blocked'] == 1}Tak{else}Nie{/if}</td>
                <td>{$users['role']}</td>
                {if \core\RoleUtils::inRole('admin')}<td><a href="{url action='userUpdate' product=$users['id_user']}">Aktualizuj</a></td>{/if}
            </tr>
        </tbody>
    </table>
{/block}