<?php

declare(strict_types=1);

namespace App\Model;

use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $name
 */
class CarModel extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%models}}';
    }

    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id'   => 'ID',
            'name' => 'Название модели',
        ];
    }
}
