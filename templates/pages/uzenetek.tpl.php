<h2>eddig kapott üzenetek</h2>
<?php if (isset($szoveg)) : ?>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Név</th>
                <th scope="col">E-mail</th>
                <th scope="col">Üzenet</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= $szoveg->nev ?></td>
                <td><?= $szoveg->email ?></td>
                <td><?= $szoveg->szoveg ?></td>
            </tr>
        </tbody>
    </table>
<?php endif; ?>