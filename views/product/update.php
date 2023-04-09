<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Product $model */
$id = Yii::$app->request->get('id');
$this->title = 'Update Product: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="row">

    <div class="col-8 offset-2">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title"><?= Html::encode($this->title) ?></h1>

            </div>
            <div class="card-body">

                <?= $this->render('_form', [
                    'model' => $model,
                    'update' => true
                ]) ?>
            </div>
        </div>
    </div>

</div>