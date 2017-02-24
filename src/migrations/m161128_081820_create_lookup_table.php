<?php

use yii\db\Migration;

/**
 * Handles the creation of table `lookup`.
 */
class m161128_081820_create_lookup_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%lookup}}', [
            'id' => $this->primaryKey(),
            'type' => $this->string(100)->notNull(),
            'name' => $this->string(100)->notNull(),
            'code' => $this->integer()->defaultValue(1)->notNull(),
            'comment' => $this->text(),
            'active' => $this->boolean()->defaultValue(1),
            'order' => $this->integer()->defaultValue(1)->notNull(),
            'created_at' => $this->integer()->defaultValue(null)->notNull(),
            'updated_at' => $this->integer()->defaultValue(null)
        ]);
        $this->createIndex('lookup_type_name', '{{%lookup}}', ['type', 'name']);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%lookup}}');
    }
}
