<?php

use yii\db\Migration;

class m250810_075632_create_models_table extends Migration
{
    const string TABLE_NAME = '{{%models}}';

    public function up(): void
    {
        $this->createTable(self::TABLE_NAME, [
            'id'   => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Название модели'),
        ]);

        $this->createIndex(
            'idx-models-name',
            self::TABLE_NAME,
            'name'
        );

        $this->addCommentOnTable(self::TABLE_NAME, 'Таблица моделей');
    }

    public function down(): void
    {
        $this->dropIndex(
            'idx-models-name',
            self::TABLE_NAME
        );
        $this->dropTable(self::TABLE_NAME);
    }
}
