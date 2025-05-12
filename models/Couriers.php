<?php

namespace app\models;

use yii\db\ActiveRecord;

class Couriers extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%couriers}}';
    }

    public function rules()
    {
        return [
            [['role', 'email', 'first_name', 'last_name'], 'required'],
            [['email', 'first_name', 'last_name', 'patronymic'], 'string'],
            ['role', 'in', 'range' => ['basic', 'main']],
        ];
    }
}