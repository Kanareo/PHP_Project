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
                    {if \core\RoleUtils::inRole('admin')}<td>Ilość</td>{/if}
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>{$products['product_name']}</td>
                        <td>{$products['category_name']}</td>
                        <td>{$products['brand_name']}</td>
                        <td>{$products['product_price']}</td>
                        {if \core\RoleUtils::inRole('admin')}<td>{$products['quantity']}</td>{/if}
                    </tr>
            </tbody>
        </table>
{/block}