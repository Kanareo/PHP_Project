{extends file="main.tpl"}

{block name=content}
    <h2><strong>Aktualizacja produktu</strong></h2>
    <table>
        <thead style="color: white; font-weight: bold">
            <tr>
                <th>Nazwa produktu</th>
                <th>Kategoria</th>
                <th>Producent</th>
                <th>Cena</th>
                <td>Ilość</td>
            </tr>
        </thead>
        <tbody style="color: lightgray">
            <tr>
                <td>{$products['product_name']}</td>
                <td>{$products['category_name']}</td>
                <td>{$products['brand_name']}</td>
                <td>{$products['product_price']}</td>
                <form action="{$conf->action_url}medUpdateSave/{$products['id_product']}" method="post">
                <td>
                    <input style="width: 30%; border-radius: 35%; text-align: center; border-style:solid" id="quantity" type="text" name="quantity" value="{$products['quantity']}"/>      
                </td>
                <td><input type="submit" value="Aktualizuj" style="margin-top: 5%; margin-bottom: 5%"/></td>
                </form>
    </tr>
</tbody>
</table>
{/block}