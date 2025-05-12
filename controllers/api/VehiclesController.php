<?php

namespace app\controllers\api;

use app\models\Vehicles;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;

class VehiclesController extends BaseApiController
{
    public $modelClass = 'app\models\Vehicles';

    public function actions()
    {
        $actions = parent::actions();

        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        $actions['create']['class'] = 'app\actions\ValidateCreateAction';

        return $actions;
    }

    public function prepareDataProvider()
    {
        $query = Vehicles::find();

        $courier_id = \Yii::$app->request->get('courier_id');
        if ($courier_id) {
            $query->andWhere(['courier_id' => $courier_id]);
        }
        $type = \Yii::$app->request->get('type');
        if ($type) {
            $query->andWhere(['type' => $type]);
        }

        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }
}