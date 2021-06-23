{if count($products) > 0}
    <table>
        <thead style="color: white; font-weight: bold">
            <tr>
                <th style="width: 12em">Nazwa produktu</th>
                <th style="width: 12em">Kategoria</th>
                <th style="width: 12em">Producent</th>
                <th style="width: 12em">Cena</th>
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
    <center>          
        <button onclick="ajaxPostForm('form', '{url action="browserData" p = {$page-1}}', 'data'); return false;" {if {$page-1}==0}class="alt" disabled{/if}> &lt; </button>
        <button onclick="ajaxPostForm('form', '{url action="browserData" p = 1}', 'data'); return false;" {if {$page}==1}class="alt" disabled{/if}>1</button>
        <span style="margin:5%">Strona {$page} z {$lastPage-1}</span>
        <button onclick="ajaxPostForm('form', '{url action="browserData" p = {$lastPage-1}}', 'data'); return false;" {if {$page}=={$lastPage-1}}class="alt" disabled{/if}>{$lastPage-1}</button>
        <button onclick="ajaxPostForm('form', '{url action="browserData" p = {$page+1}}', 'data'); return false;" {if {$page+1}=={$lastPage}}class="alt" disabled{/if}> &gt; </button>
    </center>
{else}
    <h3 style="color: white; font-weight: bold">Nie znaleziono produktów</h3>
{/if}
