<?php

declare(strict_types=1);

namespace App\Model;

use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $name
 */
class Brand extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%brands}}';
    }

    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id'   => 'ID',
            'name' => 'Название бренда',
        ];
    }
}
