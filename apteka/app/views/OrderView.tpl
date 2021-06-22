{extends file="main.tpl"}

{block name=content}
    <h2><strong>Wprowadź zamówienie</strong></h2>
    <form method="post">
        <label style="color: white; font-size: 150%">Nazwa produktu: </label>
        <select name="id_product" style="width: 100%">
            {foreach $product as $p}
                {strip}
                    <option value="{$p['id_product']}">
                        {$p['product_name']}
                    </option>
                {/strip}
            {/foreach}
        </select>
        <br>
        <label style="color: white; font-size: 150%">Ilość produktu: </label>
        <input id="quantity" type="text" name="quantity" value="" style="width: 100%"/>
        <p>
            <input type="submit" value="Wprowadź zamówienie" style="margin-top: 5%; margin-bottom: 5%; font-size:70%"  formaction="{$conf->action_url}orderAdd"/>
            <input type="submit" value="Zamknij zamówienie" style="margin-top: 5%; margin-bottom: 5%; font-size:70%" formaction="{$conf->action_url}orderClear"/>
        </p>
    </form>   
    {include file='messages.tpl'}
{/block}
