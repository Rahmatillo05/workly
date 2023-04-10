<?php
/**
 * @var \app\models\Order $orders
 */
?>


<?php foreach ($orders as $order) : ?>
    <div class="card accordion-item">
        <h2 class="accordion-header" id="headingOne">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                    data-bs-target="#accordion_<?= $order->id ?>" aria-expanded="false" aria-controls="accordion_<?= $order->id ?>">
                Order date:
                <?= date('H:i d-m-Y', $order->created_at) ?>
            </button>
        </h2>

        <div id="accordion_<?= $order->id ?>" class="accordion-collapse collapse" data-bs-parent="#accordionExample"
             style="">
            <div class="accordion-body">
                <table class="table">
                    <tr>
                        <th>#ID</th>
                        <th>Amount</th>
                        <th>Sell price</th>
                    </tr>
                    <tr>
                        <td><?= $order->id ?></td>
                        <td><?= $order->sell_amount ?></td>
                        <td><?= $order->sell_price ?> $</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
<?php endforeach; ?>

