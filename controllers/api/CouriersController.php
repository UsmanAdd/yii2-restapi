<?php

namespace app\controllers\api;

use app\models\Couriers;
use yii\data\ActiveDataProvider;

class CouriersController extends BaseApiController
{
    public $modelClass = 'app\models\Couriers';

    public function actions()
    {
        $actions = parent::actions();

        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

        return $actions;
    }

    public function prepareDataProvider()
    {
        $query = Couriers::find();

        $role = \Yii::$app->request->get('role');
        if ($role) {
            $query->andWhere(['role' => $role]);
        }
        return new ActiveDataProvider([
            'query' => $query
        ]);
    }
}