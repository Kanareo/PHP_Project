{extends file="main.tpl"}

{block name=content}
    <h2><strong>Aktualne zamówienia</strong></h2>
    {if count($orders) > 0}
        <table>
            <thead style="color: white; font-weight: bold">
                <tr>
                    <th>ID Zamówienia</th>
                    <th>ID Użytkownika</th>
                    <th>Status zamówienia</th>
                    <th>Data złożenia zamówienia</th>
                </tr>
            </thead>
            <tbody style="color: lightgray">
                {foreach $orders as $o}
                    <tr>
                        <td>{$o['id_order']}</td>
                        <td>{$o['id_user']}</td>
                        <td>{$o['order_status']}</td>
                        <td>{$o['order_date']}</td>
                        <td><a href="{url action='orderDelivered' order=$o['id_order']}">Potwierdź dostawe</a></td>
                        <td><a href="{url action='orderDelete' order=$o['id_order']}">Usuń dostawe</a></td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
    {else} <span style="font-weight:bold; font-size:2em">Brak zamówień</span>
    {/if}
{/block}
