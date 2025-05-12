<?php

namespace app\actions;

use yii\rest\CreateAction;
use yii\web\BadRequestHttpException;

class ValidateCreateAction extends CreateAction
{
    public function run()
    {
        $model = new $this->modelClass;
        $model->load(\Yii::$app->request->getBodyParams(), '');

        if (!$model->validate()) {
            \Yii::$app->response->setStatusCode(422);
            return $model->getErrors();
        }

        if ($model->save()) {
            \Yii::$app->response->setStatusCode(201);
            return $model;
        }

        throw new BadRequestHttpException('Не удалось создать запись');
    }
}