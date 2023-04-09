<?php

namespace app\controllers;

use app\models\ProductDiscount;
use app\models\Category;
use app\models\Product;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends BaseController
{
    /**
     * Lists all Category models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Category::find(),

            'pagination' => [
                'pageSize' => 20
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],

        ]);

        $category_id = Yii::$app->request->get('category_id');
        $productProvider = $this->selectCategory($category_id);
        $category = $this->findModel($category_id);
        if (isset($_POST['hasEditable'])) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $this->updateCategory($category);
        }
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => new Category(),
            'productProvider' => $productProvider,
            'category' => $category
        ]);
    }


    /**
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Category();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(Yii::$app->request->referrer);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function updateCategory(Category $category)
    {
        $oldValue = $category->name;
        $category->name = $this->request->post('category_name');
        if ($category->save()) {
            $value = $category->name;
            return ['output' => $value, 'message' => ''];
        } else {
            return ['output' => $oldValue, 'message' => 'Incorrect Value! Please reenter.'];
        }
    }
    public function actionSetDiscount()
    {
        $model = new ProductDiscount();
        if ($model->load($this->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', "Change saved");
                return $this->redirect(['index', 'category_id' => $model->category_id]);
            } else {
                Yii::$app->session->setFlash('error', "Change not saved");
                return $this->redirect(['index', 'category_id' => $model->category_id]);
            }
        }
    }
    /**
     * Deletes an existing Category model.
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

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne(['id' => $id])) !== null) {
            return $model;
        }

        return null;
    }
    protected function selectCategory($category_id)
    {
        return new ActiveDataProvider([
            'query' => Product::find()->where(['category_id' => $category_id]),
            'pagination' => [
                'pageSize' => 20
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
        ]);
    }
}
