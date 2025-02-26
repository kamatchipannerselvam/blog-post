<?php

class m250225_153208_create_table_comments extends CDbMigration
{
	public function up() {
        $db = Yii::app()->db;
        $sql = "CREATE TABLE comments (
			id INT AUTO_INCREMENT PRIMARY KEY,
			post_id INT NOT NULL,
			content TEXT NOT NULL,
			created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
			updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
			created_by INT NOT NULL,
			updated_by INT NOT NULL,
			FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE
		);";
			$db->createCommand($sql)->execute();
			echo "✔ User table created successfully.\n";
    	}

		public function down() {
			$db = Yii::app()->db;
			$db->createCommand("DROP TABLE IF EXISTS comments;")->execute();
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