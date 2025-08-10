<?php

use yii\db\Migration;

class m250810_075856_create_cars_table extends Migration
{
    const string TABLE_NAME = '{{%cars}}';

    public function up(): void
    {
        $this->createTable(self::TABLE_NAME, [
            'id'       => $this->primaryKey(),
            'brand_id' => $this->integer()->notNull()->comment('ID бренда'),
            'model_id' => $this->integer()->notNull()->comment('ID модели'),
            'photo'    => $this->string()->comment('Фото автомобиля'),
            'price'    => $this->integer()->notNull()->comment('Цена автомобиля'),
        ]);

        $this->createIndex(
            'idx-cars-brand_id',
            self::TABLE_NAME,
            'brand_id'
        );

        $this->addForeignKey(
            'fk-cars-brand_id',
            self::TABLE_NAME,
            'brand_id',
            '{{%brands}}',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-cars-model_id',
            self::TABLE_NAME,
            'model_id'
        );

        $this->addForeignKey(
            'fk-cars-model_id',
            self::TABLE_NAME,
            'model_id',
            '{{%models}}',
            'id',
            'CASCADE'
        );

        $this->addCommentOnTable(self::TABLE_NAME, 'Таблица автомобилей');
    }

    public function down(): void
    {
        $this->dropForeignKey(
            'fk-cars-model_id',
            self::TABLE_NAME
        );

        $this->dropIndex(
            'idx-cars-model_id',
            self::TABLE_NAME
        );

        $this->dropForeignKey(
            'fk-cars-brand_id',
            self::TABLE_NAME
        );

        $this->dropIndex(
            'idx-cars-brand_id',
            self::TABLE_NAME
        );

        $this->dropTable(self::TABLE_NAME);
    }
}
