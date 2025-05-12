<?php

namespace app\models;

use yii\db\ActiveRecord;

class CourierRequests extends ActiveRecord
{
    public function rules()
    {
        return [
            [['courier_id', 'vehicle_id', 'status', 'deleted'], 'required'],
            [['courier_id', 'vehicle_id'], 'integer'],
            ['courier_id', 'validateRequestLimit'],
            ['status', 'in', 'range' => ['started', 'holded', 'finished']],
            [['deleted'], 'boolean'],
            [['created_at'], 'safe'],
        ];
    }

    public function delete()
    {
        $this->deleted = true;
        return $this->save(false, ['deleted']);
    }

    public function validateRequestLimit($attribute, $params)
    {
        $existingRequest = self::find()
            ->where([
                'courier_id' => $this->courier_id,
                'status' => 'started'
            ])
        ->exists();

        if ($existingRequest) {
            $message = 'На курьера уже создана активная заявка';
            $this->addError($attribute, $message);
        }
    }
}