<?php

namespace app\components;

use Yii;
use yii\web\ErrorHandler as BaseErrorHandler;
use yii\web\Response;

class ErrorHandler extends BaseErrorHandler
{
    protected function renderException($exception)
    {
        if (Yii::$app->has('response')) {
            $response = Yii::$app->getResponse();
            $response->format = Response::FORMAT_JSON;
            $response->data = [
                'status' => 'error',
                'message' => $exception->getMessage()
            ];
            
            if ($exception instanceof \yii\web\HttpException) {
                $response->setStatusCode($exception->statusCode);
            } else {
                $response->setStatusCode(500);
            }
            
            $response->send();
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => $exception->getMessage()
            ]);
        }
    }
} 