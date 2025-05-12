<?php

namespace app\actions;

use yii\rest\DeleteAction;
use yii\web\ServerErrorHttpException;

class SoftDeleteAction extends DeleteAction
{
    public function run($id)
    {
        $model = $this->findModel($id);

        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id, $model);
        }

        if ($model->delete() === false) {
            throw new ServerErrorHttpException('Не удалось удалить запись');
        }

        return $model;
    }
}