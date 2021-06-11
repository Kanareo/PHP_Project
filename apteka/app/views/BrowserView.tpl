{extends file="main.tpl"}

{block name=content}
    <h5><strong style="color: white">Wyszukaj lek</strong></h5>
    <form action="{$conf->action_url}browser" method="post">
        <p style="margin-bottom: 1%">
            <input id="med_name" type="text" name="med_name" />
        </p>
        <p>
            <input type="submit" value="Wyszukaj" style="margin-top: 5%"/>
        </p>
    </form>
    <select>
        <option>Nazwa</option>
        <option>Kategoria</option>
        <option>Producent</option>
    </select>
{/block}