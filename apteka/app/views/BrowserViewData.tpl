{if count($products) > 0}
    <table>
        <thead style="color: white; font-weight: bold">
            <tr>
                <th>Nazwa produktu</th>
                <th>Kategoria</th>
                <th>Producent</th>
                <th>Cena</th>
            </tr>
        </thead>
        <tbody style="color: lightgray">
            {foreach $products as $p}
                <tr>
                    <td>{$p['product_name']}</td>
                    <td>{$p['category_name']}</td>
                    <td>{$p['brand_name']}</td>
                    <td>{$p['product_price']}</td>
                    <td><a href="{url action='medInfo' product=$p['id_product']}">INFO</a></td>
                </tr>
            {/foreach}
        </tbody>
    </table>
{else}
    <h3 style="color: white; font-weight: bold">Nie znaleziono produktów</h3>
{/if}
