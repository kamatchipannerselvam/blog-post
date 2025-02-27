# blog-post
Simple Blog POST using yii v1.1
Backend Assignment v1.0
step 1:  Clone the Source Code from gitrepo url: https://github.com/kamatchipannerselvam/blog-post.git
cd /var/www/html  # or your actual public path
git clone https://github.com/kamatchipannerselvam/blog-post.git blog-post
Step 2: Move and Unzip Files
unzip blog-post.zip -d /var/www/html/blog-post
sudo chmod -R 755 /var/www/html/blog-post
sudo chown -R www-data:www-data /var/www/html/blog-post
step 3: Ensure system configuration with PHP 7.4 & MySQL 5.7 (or MariaDB), Since yii1.0 only support upto php 7.4 and mysql 5.7
step 4: create db yii1db 
    a. Login into mysql: mysql -u root -p
    b. create db and give permissions to the databaseuser
        CREATE DATABASE yii1db;
        GRANT ALL PRIVILEGES ON yii1db.* TO 'your_db_user'@'localhost' IDENTIFIED BY 'your_db_password';
        FLUSH PRIVILEGES;
        EXIT;
step 5: Update Database Configuration 
    Edit protected/config/database.php:
    return array(
        'connectionString' => 'mysql:host=localhost;dbname=yii1db',
        'emulatePrepare' => true,
        'username' => 'your_db_user',
        'password' => 'your_db_password',
        'charset' => 'utf8',
    );
step 6: Import SQL (Optional for Sample Data)
    mysql -u your_db_user -p yii1db < /var/www/html/blog-post/database.sql
        or
    cd /var/www/html/blog-post/protected
    php yiic migrate up 
step 7: Initiate RBAC rules for authentications
     cd /var/www/html/blog-post/protected
     php yiic rbac init
Step 7: Setup Permissions for Yii 
    chmod -R 777 /var/www/html/blog-post/protected/runtime
    chmod -R 777 /var/www/html/blog-post/assets
Step 8: Start the Web Server
    http://yourdomain.com/blog-post
Step 9: Sign Up as a New User
    1. Visit /signup
    2. Register a new account
    3. The system will automatically assign the "author" role.
🎉 Done! Yii 1 Blog is Now Live! 🚀
