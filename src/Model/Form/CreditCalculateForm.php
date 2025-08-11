<?php

namespace App\Model\Form;

use yii\base\Model;

/**
 * @property int $price Цена автомобиля
 * @property float $initialPayment Первоначальный взнос
 * @property int $loanTerm Срок кредита в месяцах
 */
class CreditCalculateForm extends Model
{
    public ?int $price = null;
    public ?float $initialPayment = null;
    public ?int $loanTerm = null;

    public function formName(): string
    {
        return '';
    }

    public function rules(): array
    {
        return [
            [['price', 'initialPayment', 'loanTerm'], 'required'],
            [['price', 'loanTerm'], 'integer'],
            [['initialPayment'], 'number'],
            [
                ['price', 'initialPayment', 'loanTerm'],
                'compare',
                'compareValue' => 0,
                'operator'     => '>',
                'type'         => 'number',
                'message'      => 'Значение должно быть больше нуля.'
            ],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'price'          => 'Цена автомобиля',
            'initialPayment' => 'Первоначальный взнос',
            'loanTerm'       => 'Срок кредита в месяцах',
        ];
    }
}
