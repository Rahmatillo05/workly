<?php

/**
 * @var \app\models\Order $orders
 */

?>


<?php if ($orders) : foreach ($orders as $order) : ?>
<li class="d-flex mb-4 pb-1">
    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
        <div class="me-2">
            <small class="text-muted d-block mb-1"><?= $order->product->name ?></small>
            <h6 class="mb-0">Amount: <?= $order->sell_amount ?></h6>
        </div>
        <div class="user-progress d-flex align-items-center gap-1">
            <h6 class="mb-0">Money: <?= $order->sell_price ?></h6>
            <span class="text-muted">USD</span>
        </div>
    </div>
</li>
<?php endforeach; else: ?>
    <li class="d-flex mb-4 pb-1">
        <h3 class="text-danger">Orders not found</h3>
    </li>
<?php endif; ?>
