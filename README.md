# 📖 Blog Post  
Simple Blog POST using Yii v1.1  
**Backend Assignment v1.0**  

## 🚀 Installation Steps  

### **Step 1: Clone the Source Code**  
```sh
cd /var/www/html  # or your actual public path
git clone https://github.com/kamatchipannerselvam/blog-post.git blog-post


### **Step 2: Move and Unzip Files**  
```sh
unzip blog-post.zip -d /var/www/html/blog-post
sudo chmod -R 755 /var/www/html/blog-post
sudo chown -R www-data:www-data /var/www/html/blog-post


### **Step 3: Ensure System Requirements**
✅ PHP 7.4
✅ MySQL 5.7 (or MariaDB)
(Yii 1.1 supports up to PHP 7.4 & MySQL 5.7 only.)


### **Step 4: Create Database**
``sh
mysql -u root -p
CREATE DATABASE yii1db;
GRANT ALL PRIVILEGES ON yii1db.* TO 'your_db_user'@'localhost' IDENTIFIED BY 'your_db_password';
FLUSH PRIVILEGES;
EXIT;

### **Step 5: Update Database Configuration**

Edit protected/config/database.php:  
``php
return array(
    'connectionString' => 'mysql:host=localhost;dbname=yii1db',
    'emulatePrepare' => true,
    'username' => 'your_db_user',
    'password' => 'your_db_password',
    'charset' => 'utf8',
);

### **Step 6: Import SQL (Optional for Sample Data)**
``sh
mysql -u your_db_user -p yii1db < /var/www/html/blog-post/database.sql

Or Run Yii Migrations:

``sh
cd /var/www/html/blog-post/protected
php yiic migrate up

### **Step 7: Initiate RBAC Rules for Authentication**
``sh
cd /var/www/html/blog-post/protected
php yiic rbac init

### **Step 8: Setup Permissions for Yii**
``sh
chmod -R 777 /var/www/html/blog-post/protected/runtime
chmod -R 777 /var/www/html/blog-post/assets

### **Step 9: Start the Web Server**

visit: http://yourdomain.com/blog-post

### **Step 10: Sign Up as a New User**
Visit /signup

Register a new account

System automatically assigns the "author" role

🎉 Done! Yii 1 Blog is Now Live! 🚀










