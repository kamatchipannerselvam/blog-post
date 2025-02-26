<?php

class m250225_153151_create_table_posts extends CDbMigration
{
	public function up() {
        $db = Yii::app()->db;
        $sql = "CREATE TABLE posts (
			id INT AUTO_INCREMENT PRIMARY KEY,
			title VARCHAR(255) NOT NULL,
			content TEXT NOT NULL,
			created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
			updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
			created_by INT NOT NULL,
			updated_by INT NOT NULL
		);";
			$db->createCommand($sql)->execute();
			echo "✔ User table created successfully.\n";
    	}

		public function down() {
			$db = Yii::app()->db;
			$db->createCommand("DROP TABLE IF EXISTS posts;")->execute();
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