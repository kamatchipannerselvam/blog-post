<?php

class m250225_152601_create_table_auth_assignment extends CDbMigration
{
		public function up() {
        $db = Yii::app()->db;
        $sql = "CREATE TABLE `authassignment` (
				`itemname` VARCHAR(64),
				`userid` INT(11),
				`bizrule` TEXT,
				`data` TEXT,
				PRIMARY KEY(`itemname`, `userid`)
			)";
			$db->createCommand($sql)->execute();
			echo "✔ User table created successfully.\n";
    	}

		public function down() {
			$db = Yii::app()->db;
			$db->createCommand("DROP TABLE IF EXISTS authassignment;")->execute();
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