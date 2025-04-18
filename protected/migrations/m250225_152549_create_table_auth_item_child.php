<?php

class m250225_152549_create_table_auth_item_child extends CDbMigration
{
		public function up() {
        $db = Yii::app()->db;
        $sql = "CREATE TABLE `authitemchild` (
				`parent` VARCHAR(64),
				`child` VARCHAR(64),
				PRIMARY KEY(`parent`, `child`)
			)";
			$db->createCommand($sql)->execute();
			echo "✔ User table created successfully.\n";
    	}

		public function down() {
			$db = Yii::app()->db;
			$db->createCommand("DROP TABLE IF EXISTS authitemchild;")->execute();
			echo "❌ User table deleted.\n";
		}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}