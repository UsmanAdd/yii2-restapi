<?php

namespace app\models;

use yii\db\ActiveRecord;

class Vehicles extends ActiveRecord
{
    public function rules()
    {
        return [
            [['courier_id', 'type', 'serial_number'], 'required'],
            [['courier_id'], 'integer'],
            ['courier_id', 'validateVehicleLimit'],
            ['type', 'in', 'range' => ['car', 'scooter']],
            [['serial_number'], 'string'],
        ];
    }

    public function extraFields()
    {
        $extraFields = parent::extraFields();
        $extraFields['courier'] = function() {
            return $this->courier;
        };
        return $extraFields;
    }

    public function getCourier()
    {
        return $this->hasOne(Couriers::class, ['id' => 'courier_id']);
    }

    public function validateVehicleLimit($attribute, $params)
    {
        $existingVehicle = self::find()
            ->where([
                'courier_id' => $this->courier_id,
                'type' => $this->type,
            ])
        ->exists();

        if ($existingVehicle)
        {
            $typeName = $this->type === 'car' ? 'автомобиль' : 'скутер';
            $message = "У курьера уже есть {$typeName}. Можно иметь только один транспорт каждого типа.";
            $this->addError($attribute, $message);
        }
    }
}