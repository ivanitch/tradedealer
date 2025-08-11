<?php

namespace App\Model;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

/**
 * @property int $id
 * @property int $car_id
 * @property int $program_id
 * @property float $initial_payment
 * @property int $loan_term
 * @property string $created_at
 *
 * @property Car $car
 * @property CreditProgram $program
 */
class CreditRequest extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%requests}}';
    }

    public function rules(): array
    {
        return [
            [['car_id', 'program_id', 'initial_payment', 'loan_term'], 'required'],
            [['car_id', 'program_id', 'loan_term'], 'integer'],
            [['initial_payment'], 'number'],
            [['created_at'], 'safe'],
            [
                ['car_id'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => Car::class,
                'targetAttribute' => ['car_id' => 'id']
            ],
            [
                ['program_id'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => CreditProgram::class,
                'targetAttribute' => ['program_id' => 'id']
            ],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id'              => 'ID',
            'car_id'          => 'ID автомобиля',
            'program_id'      => 'ID кредитной программы',
            'initial_payment' => 'Первоначальный взнос',
            'loan_term'       => 'Срок кредита в месяцах',
            'created_at'      => 'Дата создания',
        ];
    }

    public function getCar(): ActiveQuery
    {
        return $this->hasOne(Car::class, ['id' => 'car_id']);
    }

    public function getProgram(): ActiveQuery
    {
        return $this->hasOne(CreditProgram::class, ['id' => 'program_id']);
    }
}
