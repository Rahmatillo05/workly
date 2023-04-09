<?php

use yii\helpers\Url;
?>
<a href="<?= Url::to(['product/view', 'id' => $model->id]) ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
    <?= $model->name ?>
</a>