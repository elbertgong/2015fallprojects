<div>
    
    <table class="table table-striped">

    <thead align="left">
        <tr>
            <th>Symbol</th>
            <th>Name</th>
            <th>Shares</th>
            <th>Price</th>
            <th>TOTAL</th>
        </tr>
    </thead>
    <tbody align="left">
        <?php foreach ($positions as $position): ?>
    
            <tr>
                <td><?= $position["symbol"] ?></td>
                <td><?= $position["name"] ?></td>
                <td><?= $position["shares"] ?></td>
                <td>$<?= number_format($position["price"], 2) ?></td>
                <td>$<?= number_format($position["shares"]*$position["price"], 2) ?></td>
            </tr>
    
            <?php endforeach ?>
            <tr>
            <td colspan="4">CASH</td>
            <td>$<?= number_format($cash, 2) ?></td>
        </tr>
    </tbody>
    </table>
</div>