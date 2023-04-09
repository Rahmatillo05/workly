<?php

namespace app\controllers;

use app\models\Product;
use app\models\ProductAmountHistory;
use app\models\ProductCreateModel;
use app\models\ProductPurchaseHistory;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends BaseController
{

    /**
     * Lists all Product models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find(),

            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],

        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new ProductCreateModel();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if ($model->isSave()) {
                    Yii::$app->session->setFlash('success', "Product saved");
                } else {
                    Yii::$app->session->setFlash('success', "Error while product saved");
                }
                return $this->redirect(Yii::$app->request->referrer);
            }
        }

        return $this->redirect(['index']);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->isUpdated()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionMultipleUpdate()
    {
        if ($this->request->isPost) {
            if ($product_ids = $this->request->post('selection')) {
                $products = Product::findAll(['id' => $product_ids]);
                return $this->render('multiple-update', compact('products'));
            } else {
                Yii::$app->session->setFlash('error', 'No row selected');
            }
        }
        return $this->redirect(['index']);
    }

    public function actionMultipleUpdateSave()
    {
        if ($this->request->isPost) {
            $data = Yii::$app->request->post();
            $products = [];
            foreach ($data as $key => $value) {
                if (strpos($key, 'Product_') === 0) {
                    $products[$key] = $value;
                }
            }
            if ((new Product())->multipleUpdated($products)) {
                Yii::$app->session->setFlash('success', 'Selected rows updated successfully!');
            }
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
