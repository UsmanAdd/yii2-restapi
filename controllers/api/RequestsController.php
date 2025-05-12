<?php

namespace app\controllers\api;

use app\models\CourierRequests;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;

class RequestsController extends BaseApiController
{
    public $modelClass = 'app\models\CourierRequests';

    public function actions()
    {
        $actions = parent::actions();

        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        $actions['delete']['class'] = 'app\actions\SoftDeleteAction';
        $actions['create']['class'] = 'app\actions\ValidateCreateAction';

        return $actions;
    }

    protected function verbs()
    {
        return [
            'delete' => ['DELETE']
        ];
    }

    public function prepareDataProvider()
    {
        $query = CourierRequests::find()->where(['deleted' => false]);

        $courier_id = \Yii::$app->request->get('courier_id');
        if ($courier_id) {
            $query->andWhere(['courier_id' => $courier_id]);
        }

        return new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => ['courier_id', 'created_at']
            ]
        ]);
    }
}