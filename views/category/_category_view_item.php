<?php

use yii\helpers\Url;
?>
<a href="<?= Url::to(['category/index', 'category_id' => $model->id]) ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
    <?= $model->name ?>
    <span class="badge bg-primary rounded-pill"><?= count($model->products) ?></span>
</a>