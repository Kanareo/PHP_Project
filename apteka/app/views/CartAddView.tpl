{extends file="main.tpl"}

{block name=content}
    <h2><strong>Dodaj do koszyka</strong></h2>
    <table>
        <thead>
            <tr>
                <th>Nazwa produktu</th>
                <th>Kategoria</th>
                <th>Producent</th>
                <th>Cena</th>
                <td>Ilość</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{$products['product_name']}</td>
                <td>{$products['category_name']}</td>
                <td>{$products['brand_name']}</td>
                <td>{$products['product_price']}</td>
                <form action="{$conf->action_url}cartSave/{$products['id_product']}" method="post">
                <td>
                    <p style="margin-bottom: 1%">
                        <input id="quantity" type="text" name="quantity" value="{$products['quantity']}"/>
                    </p>        
                </td>
                <td><input type="submit" value="Dodaj do koszyka" style="margin-top: 5%; margin-bottom: 5%"/></td>
                </form>
            </tr>
        </tbody>
    </table>
{/block}