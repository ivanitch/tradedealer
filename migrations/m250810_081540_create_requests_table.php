<?php

use yii\db\Migration;

class m250810_081540_create_requests_table extends Migration
{
    const string TABLE_NAME = '{{%requests}}';

    public function up(): void
    {
        $this->createTable(self::TABLE_NAME, [
            'id'              => $this->primaryKey(),
            'car_id'          => $this->integer()->notNull()->comment('ID автомобиля'),
            'program_id'      => $this->integer()->notNull()->comment('ID кредитной программы'),
            'initial_payment' => $this->float(2)->notNull()->comment('Первоначальный взнос'),
            'loan_term'       => $this->integer()->notNull()->comment('Срок кредита в месяцах'),
            'created_at'      => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->comment('Дата создания заявки'),
        ]);

        $this->createIndex(
            'idx-requests-car_id',
            self::TABLE_NAME,
            'car_id'
        );

        $this->addForeignKey(
            'fk-requests-car_id',
            self::TABLE_NAME,
            'car_id',
            '{{%cars}}',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-requests-program_id',
            self::TABLE_NAME,
            'program_id'
        );

        $this->addForeignKey(
            'fk-requests-program_id',
            self::TABLE_NAME,
            'program_id',
            '{{%credit_programs}}',
            'id',
            'CASCADE'
        );

        $this->addCommentOnTable(self::TABLE_NAME, 'Таблица заявок');
    }

    public function down(): void
    {
        $this->dropForeignKey(
            'fk-requests-program_id',
            self::TABLE_NAME
        );

        $this->dropIndex(
            'idx-requests-program_id',
            self::TABLE_NAME
        );

        $this->dropForeignKey(
            'fk-requests-car_id',
            self::TABLE_NAME
        );

        $this->dropIndex(
            'idx-requests-car_id',
            self::TABLE_NAME
        );

        $this->dropTable(self::TABLE_NAME);
    }
}
