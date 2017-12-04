<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `testexcution`.
 * Has foreign keys to the tables:
 *
 * - `user`
 */
class m171204_012830_add_columns_column_to_testexcution_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('testexcution', 'uid', $this->integer());
        $this->addColumn('testexcution', 'designCompleted', $this->boolean());
        $this->addColumn('testexcution', 'tcids', $this->string());

        // creates index for column `uid`
        $this->createIndex(
            'idx-testexcution-uid',
            'testexcution',
            'uid'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-testexcution-uid',
            'testexcution',
            'uid',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-testexcution-uid',
            'testexcution'
        );

        // drops index for column `uid`
        $this->dropIndex(
            'idx-testexcution-uid',
            'testexcution'
        );

        $this->dropColumn('testexcution', 'uid');
        $this->dropColumn('testexcution', 'designCompleted');
        $this->dropColumn('testexcution', 'tcids');
    }
}
