<?php

declare(strict_types=1);

namespace App\Model;

use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $title
 * @property float $interest_rate
 */
class CreditProgram extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%credit_programs}}';
    }

    public function rules(): array
    {
        return [
            [['title', 'interest_rate'], 'required'],
            [['interest_rate'], 'number'],
            [['title'], 'string', 'max' => 255],
            [['title'], 'unique'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id'            => 'ID',
            'title'         => 'Название кредитной программы',
            'interest_rate' => 'Процентная ставка',
        ];
    }
}
