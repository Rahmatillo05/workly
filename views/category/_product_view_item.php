<?php
/**
 * @var \app\models\Product $model
 */

use yii\helpers\Url;

?>
<a href="<?= Url::to(['product/view', 'id' => $model->id]) ?>"
   class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
    <b>
        <?= $model->name ?>
    </b>
    <span>
        Purchase price:
    <i>
        <?= $model->purchase_price ?> $
    </i>
    </span>
    <i>
        Sell price:
        <?= $model->sell_price ?> $
    </i>
    <i>
        Discount:
        <?= $model->discount ?> %
    </i>
</a>