<?php

namespace App\Controller\v1;

use App\Controller\BaseRestController;
use App\Model\Car;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class CarController extends BaseRestController
{
    /**
     * @return ActiveDataProvider
     */
    public function actionIndex(): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query'      => Car::find(),
            'pagination' => [
                'pageSize' => Yii::$app->params['pageSize'],
            ],
        ]);
    }

    /**
     * @param int $id
     * @return Car
     * @throws NotFoundHttpException
     */
    public function actionView(int $id): Car
    {
        $car = Car::find()->where(['id' => $id])->one();
        if ($car === null) {
            throw new NotFoundHttpException('The requested car was not found.');
        }

        return $car;
    }
}
