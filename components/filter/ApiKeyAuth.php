<?php

namespace app\components\filter;

use yii\base\ActionFilter;
use yii\web\UnauthorizedHttpException;
use yii\web\ForbiddenHttpException;
use yii\web\Response;

class ApiKeyAuth extends ActionFilter
{
    public function beforeAction($action)
    {
        $apiKey = \Yii::$app->request->headers->get('X-Api-Key');
        if ($apiKey === null || $apiKey !== \Yii::$app->params['apiKey']) {
            throw new UnauthorizedHttpException('Неверный API ключ.');
        }

        $role = \Yii::$app->request->headers->get('X-Role');
        $method = \Yii::$app->request->method;

        if ($method !== 'GET' && $role !== 'main') {
            throw new ForbiddenHttpException('Только role = main может выполнять POST, PUT, DELETE. Остальные — только GET.');
        }

        return parent::beforeAction($action);
    }
} 