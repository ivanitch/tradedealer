<?php

use yii\db\Migration;

class m250810_075039_create_brands_table extends Migration
{
    private const string TABLE_NAME = '{{%brands}}';

    public function up(): void
    {
        $this->createTable(self::TABLE_NAME, [
            'id'   => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Название бренда'),
        ]);

        $this->createIndex(
            'idx-brands-name',
            self::TABLE_NAME,
            'name',
            true
        );

        $this->addCommentOnTable(self::TABLE_NAME, 'Таблица брендов');
    }

    public function down(): void
    {
        $this->dropIndex(
            'idx-brands-name',
            self::TABLE_NAME
        );
        $this->dropTable(self::TABLE_NAME);
    }
}
