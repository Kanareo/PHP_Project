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
                <td>{if $users['blocked'] == 1}Tak{else}Nie{/if}</td>
                <td>{$users['role']}</td>
            </tr>
        </tbody>
    </table>
{/block}