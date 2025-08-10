<?php

use yii\db\Migration;

class m250810_081138_create_credit_programs_table extends Migration
{
    const string TABLE_NAME = '{{%credit_programs}}';

    public function up(): void
    {
        $this->createTable(self::TABLE_NAME, [
            'id'            => $this->primaryKey(),
            'title'         => $this->string()->notNull()->comment('Название кредитной программы'),
            'interest_rate' => $this->float(2)->notNull()->comment('Процентная ставка'),
        ]);

        $this->createIndex(
            'idx-credit_programs-title',
            self::TABLE_NAME,
            'title',
            true
        );

        $this->addCommentOnTable(self::TABLE_NAME, 'Таблица кредитных программ');
    }

    public function down(): void
    {
        $this->dropIndex(
            'idx-credit_programs-title',
            self::TABLE_NAME
        );

        $this->dropTable(self::TABLE_NAME);
    }
}
