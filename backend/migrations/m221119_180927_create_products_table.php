<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%products}}`.
 */
class m221119_180927_create_products_table extends Migration
{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$this->createTable('{{%products}}', [
			'id' => $this->primaryKey(),
			'name' => $this->string()->notNull(),
			'category_name' => $this->string()->notNull(),
			'brand_name' => $this->string(),
			'price' => $this->integer(),
			'rrp_price' => $this->integer(),
			'status' => $this->integer()->notNull(),
		]);
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		$this->dropTable('{{%products}}');
	}
}
