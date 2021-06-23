{extends file="main.tpl"}

{block name=content}
    <h5><strong style="color: white">Wyszukaj lek</strong></h5>
    <form id="form" onsubmit="ajaxPostForm('form','{$conf->action_root}browserData','data'); return false;">
        <input id="name" type="text" name="name" value="{$form->name}" placeholder="Nazwa leku" style="margin-bottom: 1%"/>
        <select name="brand" style="margin-bottom: 1%">
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
            <input type="submit" style="padding: 1.15em 3em; margin: 1%; font-size: 120%" value="Wyszukaj" style="margin-top: 5%; margin-bottom: 5%"/>
            <a class="button" style="padding: 1.3em 3em; margin: 1%; font-size: 120%" onclick="document.getElementById('form').reset(); ajaxPostForm('form','{$conf->action_root}browserData','data');">Wyczyść</a>
    </form>
    <div id="data">
        {include file="BrowserViewData.tpl"}
    </div>
{/block}