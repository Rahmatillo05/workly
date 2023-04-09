<?php
/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">

    <div class="col-12">
        <div class="row">
            <?= $this->render('_category_view', compact('model', 'dataProvider')) ?>
            <?= $this->render('_product_view', compact('productProvider', 'category')) ?>
        </div>
    </div>

</div>
<?php
$this->registerJs("let verticalExample2 = document.getElementById('vertical-example2')
new PerfectScrollbar(verticalExample2, {
        wheelPropagation: false
});");
