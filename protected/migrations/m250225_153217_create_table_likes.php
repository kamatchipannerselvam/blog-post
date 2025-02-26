<?php

class m250225_153217_create_table_likes extends CDbMigration
{
	public function up() {
        $db = Yii::app()->db;
        $sql = "CREATE TABLE likes (
			id INT AUTO_INCREMENT PRIMARY KEY,
			post_id INT NOT NULL,
			ip_address TEXT NOT NULL,
			created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
			updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
			FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE
		);";
			$db->createCommand($sql)->execute();
			echo "✔ User table created successfully.\n";
    	}

		public function down() {
			$db = Yii::app()->db;
			$db->createCommand("DROP TABLE IF EXISTS likes;")->execute();
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