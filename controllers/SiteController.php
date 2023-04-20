<?php

namespace app\controllers;

use app\components\widgets\PriceFormatter;
use app\models\LoginHistory;
use app\models\Order;
use app\models\Product;
use Yii;
use yii\web\Response;
use app\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends BaseController
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $today = strtotime("today");
        $order = new Order();
        $orders = Order::find()->where(['between', 'created_at', $today, $today + 86400])->all();
        return $this->render('index', compact('order', 'orders'));
    }

    public function actionOrder()
    {
        $model = new Order();
        if ($this->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $product_id = $this->request->post('product_id');
            $product = Product::find()->where(['id' => $product_id])->orderBy(['id' => SORT_DESC])->one();
            $discount = PriceFormatter::calculateDiscountSum($product->sell_price, $product->discount);
            return [
                'sell_price' => round($product->sell_price, 1),
                'discount' => $discount,
                'discount_per' => $product->discount
            ];
        }
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $result = $model->isSave();
                if (!is_array($result)) {
                    Yii::$app->session->setFlash('success', "Order saved");
                    $this->redirect(['index']);
                } else {
                    Yii::$app->session->setFlash('error', "Order not saved");
                    $this->redirect(['index']);
                }
            }
        }
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLoginHistory()
    {
        $history = LoginHistory::find()->where(['user_id' => Yii::$app->user->id])->all();
        return $this->render('login-history', compact('history'));
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
