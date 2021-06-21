{extends file="main.tpl"}

{block name=content}
    <h2><strong>Informacja o leku</strong></h2>
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
                        <td>{$products['quantity']}</td>
                        {if \core\RoleUtils::inRole('admin')}<td><a href="{url action='medUpdate' product=$products['id_product']}">Aktualizuj</a></td>{/if}
                        {if \core\RoleUtils::inRole('user')}<td><a href="{url action='cartAdd' product=$products['id_product']}">Dodaj do koszyka</a></td>{/if}
                    </tr>
            </tbody>
        </table>
{/block}