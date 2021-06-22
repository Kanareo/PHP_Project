{extends file="main.tpl"}

{block name=content}
    <h2><strong>Wprowadź zamówienie</strong></h2>
    <form action="{$conf->action_url}orderAdd" method="post">
        <select name="id_product">
            {foreach $id_product as $id}
                {strip}
                    <option value="{$id['id_product']}">
                        {$id['id_product']}
                    </option>
                {/strip}
            {/foreach}
        </select>
        <p style="margin-bottom: 1%">
            <input id="quantity" type="text" name="quantity" value=""/>
        </p>
        <p>
            <input type="submit" value="Wprowadź zamówienie" style="margin-top: 5%; margin-bottom: 5%"/>
        </p>
    </form>
    <form action="{$conf->action_url}orderClear" method="post">
            <input type="submit" value="Nowe zamówienie" style="margin-top: 5%; margin-bottom: 5%"/>
    </form>    
    {include file='messages.tpl'}
{/block}
