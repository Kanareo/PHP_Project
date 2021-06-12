{extends file="main.tpl"}

{block name=content}
    <h5><strong style="color: white">Wyszukaj lek</strong></h5>
    <form action="{$conf->action_url}browser" method="post">
        <p style="margin-bottom: 1%">
            <input id="name" type="text" name="name" value="{$form->name}"/>
        </p>
        <select name="brand">
            <option value="" >Wszyscy producenci</option>
            {foreach $brands as $b}
                {strip}
                    <option value="{$b['brand_name']}" {if $form->brand === $b['brand_name']}selected{/if}>
                        {$b['brand_name']}
                    </option>
                {/strip}
            {/foreach}
        </select>
        <select name="category">
            <option value="">Wszystkie kategorie</option>
            {foreach $categories as $c}
                {strip}
                    <option value="{$c['category_name']}" {if $form->category === $c['category_name']}selected{/if}>
                        {$c['category_name']}
                    </option>
                {/strip}
            {/foreach}
        </select>
        <p>
            <input type="submit" value="Wyszukaj" style="margin-top: 5%; margin-bottom: 5%"/>
        </p>
    </form>
    {if count($products) > 0}
        <table>
            <thead>
                <tr>
                    <th>Nazwa produktu</th>
                    <th>Kategoria</th>
                    <th>Producent</th>
                    <th>Cena</th>
                </tr>
            </thead>
            <tbody>
                {foreach $products as $p}
                    <tr>
                        <td>{$p['product_name']}</td>
                        <td>{$p['category_name']}</td>
                        <td>{$p['brand_name']}</td>
                        <td>{$p['product_price']}</td>
                        <td><a href="{url action='medInfo'}">INFO</a></td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
    {/if}
{/block}