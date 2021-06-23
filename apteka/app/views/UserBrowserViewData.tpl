{if count($users) > 0}
    <table>
        <thead style="color: white; font-weight: bold">
            <tr>
                <th style="width: 5%">ID</th>
                <th style="width: 15%">Imię</th>
                <th style="width: 20%">Nazwisko</th>
                <th style="width: 30%">Email</th>
                <th style="width: 15%">Telefon</th>
                <th style="width: 5%">Zablokowany</th>
                <th style="width: 10%">Rola</th>
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
    <center>          
        <button onclick="ajaxPostForm('form', '{url action="userBrowserData" p = {$page-1}}', 'data'); return false;" {if {$page-1}==0}class="alt" disabled{/if}> &lt; </button>
        <button onclick="ajaxPostForm('form', '{url action="userBrowserData" p = 1}', 'data'); return false;" {if {$page}==1}class="alt" disabled{/if}>1</button>
        <span style="margin:5%">Strona {$page} z {$lastPage-1}</span>
        <button onclick="ajaxPostForm('form', '{url action="userBrowserData" p = {$lastPage-1}}', 'data'); return false;" {if {$page}=={$lastPage-1}}class="alt" disabled{/if}>{$lastPage-1}</button>
        <button onclick="ajaxPostForm('form', '{url action="userBrowserData" p = {$page+1}}', 'data'); return false;" {if {$page+1}=={$lastPage}}class="alt" disabled{/if}> &gt; </button>
    </center>
{else}
    <h3 style="color: white; font-weight: bold">Nie znaleziono użytkowników</h3>
{/if}

