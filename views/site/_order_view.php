<?php

/**
 * @var \app\models\Order $order
 * @var \app\models\Order[] $orders
 */

?>
<div class="accordion" id="order-history">
    <?php if ($orders) : foreach ($orders as $order) : ?>
        <div class="card accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                        data-bs-target="#accordion_<?= $order->id ?>" aria-expanded="true"
                        aria-controls="accordion_<?= $order->id ?>">
                    Order date:
                    <?= date('H:i d-m-Y', $order->created_at) ?>
                </button>
            </h2>

            <div id="accordion_<?= $order->id ?>" class="accordion-collapse collapse " data-bs-parent="#order-history"
                 style="">
                <div class="accordion-body">
                    <table class="table">
                        <tr>
                            <th>Amount</th>
                            <th>With discount</th>
                            <th>Sell price</th>
                        </tr>
                        <tr>
                            <td><?= $order->amount ?></td>
                            <td><?= $order->discount_price ?> $</td>
                            <td><?= $order->sell_price ?> $</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    <?php endforeach; else: ?>
        <li class="d-flex mb-4 pb-1">
            <h3 class="text-danger">Orders not found</h3>
        </li>
    <?php endif; ?>
</div>
