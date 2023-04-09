<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\bootstrap5\LinkPager;
?>
<div class="col-4">
    <div class="card overflow-hidden">
        <div class="card-header border-bottom p-1">
            <h4 class="card-title"><?= Html::encode($this->title) ?></h4>
            <?= $this->render('_form', ['model' => $model]) ?>
        </div>
        <div class="card-body card-body ps ps--active-y p-0" style="height: 450px" id="vertical-example">
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'options' => ['class' => 'list-group list-group-flush'],
                'itemView' => '_category_view_item',
                'layout' => "{items}"
            ]) ?>
            <div class="ps__rail-x" style="left: 0px; bottom: -1080px;">
                <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
            </div>
            <div class="ps__rail-y" style="top: 1080px; height: 232px; right: 0px;">
                <div class="ps__thumb-y" tabindex="0" style="top: 191px; height: 40px;"></div>
            </div>
        </div>
        <div class="card-footer">
            <?= LinkPager::widget([
                'pagination' => $dataProvider->pagination
            ]) ?>
        </div>
    </div>
</div>