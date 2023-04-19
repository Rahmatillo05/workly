<?php
/**
 * @var \app\models\PurchaseHistory $history
 */

use app\components\widgets\PriceFormatter;

?>


<?php foreach ($history as $order) : ?>
    <div class="card accordion-item">
        <h2 class="accordion-header" id="headingOne">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                    data-bs-target="#purchase_<?= $order->id ?>" aria-expanded="false" aria-controls="purchase_<?= $order->id ?>">
                Purchased:
                <?= date('H:i d-m-Y', $order->created_at) ?>
            </button>
        </h2>

        <div id="purchase_<?= $order->id ?>" class="accordion-collapse collapse" data-bs-parent="#purchaseAccordion"
             style="">
            <div class="accordion-body">
                <table class="table">
                    <tr>
                        <th>#ID</th>
                        <th>Amount</th>
                        <th>Purchase Price</th>
                        <th>Sell price</th>
                    </tr>
                    <tr>
                        <td><?= $order->id ?></td>
                        <td><?= $order->amount ?></td>
                        <td><?= $order->purchase_price ?> $</td>
                        <td><?= $order->sell_price ?> $</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
<?php endforeach; ?>

