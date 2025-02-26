<?php

class m250225_152528_create_table_auth_item extends CDbMigration
{
	public function up() {
        $db = Yii::app()->db;
        $sql = "CREATE TABLE `auth_item` (
				`name` VARCHAR(64) PRIMARY KEY,
				`type` INT(1) NOT NULL,
				`description` TEXT,
				`bizrule` TEXT,
				`data` TEXT
			)";
			$db->createCommand($sql)->execute();
			echo "✔ User table created successfully.\n";
    	}

		public function down() {
			$db = Yii::app()->db;
			$db->createCommand("DROP TABLE IF EXISTS auth_item;")->execute();
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