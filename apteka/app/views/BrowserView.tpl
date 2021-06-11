{extends file="main.tpl"}

{block name=content}
    <h5><strong style="color: white">Wyszukaj lek</strong></h5>
    <form action="{$conf->action_url}browser" method="post">
        <p style="margin-bottom: 1%">
            <input id="name" type="text" name="name" />
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
            <input type="submit" value="Wyszukaj" style="margin-top: 5%"/>
        </p>
    </form>
{/block}