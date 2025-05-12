<?php

namespace app\controllers\api;

use yii\rest\ActiveController;
use app\components\filter\ApiKeyAuth;
use yii\web\Response;
use yii\helpers\ArrayHelper;

class BaseApiController extends ActiveController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        
        $behaviors['apiKeyAuth'] = [
            'class' => ApiKeyAuth::class,
        ];

        $behaviors['contentNegotiator'] = [
            'class' => 'yii\filters\ContentNegotiator',
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];

        return $behaviors;
    }
} 