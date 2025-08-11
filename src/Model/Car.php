<?php

declare(strict_types=1);

namespace App\Model;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

/**
 * @property int $id
 * @property int $brand_id
 * @property int $model_id
 * @property string|null $photo
 * @property int $price
 *
 * @property Brand $brand
 * @property CarModel $model
 */
class Car extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%cars}}';
    }

    public function rules(): array
    {
        return [
            [['brand_id', 'model_id', 'price'], 'required'],
            [['brand_id', 'model_id', 'price'], 'integer'],
            [['photo'], 'string', 'max' => 255],
            [
                'brand_id',
                'exist',
                'skipOnError'     => true,
                'targetClass'     => Brand::class,
                'targetAttribute' => ['brand_id' => 'id']
            ],
            [
                'model_id',
                'exist',
                'skipOnError'     => true,
                'targetClass'     => CarModel::class,
                'targetAttribute' => ['model_id' => 'id']
            ],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id'       => 'ID',
            'brand_id' => 'Бренд',
            'model_id' => 'Модель',
            'photo'    => 'Фото автомобиля',
            'price'    => 'Цена автомобиля',
        ];
    }

    protected function fullName(): string
    {
        return $this->brand->name . ' ' . $this->model->name;
    }

    public function fields(): array
    {
        return [
            'id',
            //'name'  => fn() => $this->fullName(),
            'brand' => 'brand',
            'model' => 'model',
            'photo',
            'price',
        ];
    }

    public function getBrand(): ActiveQuery
    {
        return $this->hasOne(Brand::class, ['id' => 'brand_id']);
    }

    public function getModel(): ActiveQuery
    {
        return $this->hasOne(CarModel::class, ['id' => 'model_id']);
    }
}
