SMART COLLEGE DIGITAL NOTICE BOARD - MONGODB VERSION

Database:
MongoDB local server at mongodb://127.0.0.1:27017

Database name:
college_notice_board

Collections:
1. users
2. notices

Important:
- XAMPP Apache is used for PHP.
- MySQL/phpMyAdmin is NOT used.
- MongoDB Compass can be used to view the data.
- The PHP MongoDB extension and Composer package mongodb/mongodb are required.

Default login:
Username: admin
Password: admin123

Registered accounts:
Use the Sign Up page. The account is stored in the MongoDB users collection.
Login using the registered email and password.

INSTALL:
1. Put this folder inside C:\xampp\htdocs\
2. Open Command Prompt/PowerShell in this folder.
3. Run:
   composer install
4. Make sure MongoDB is running.
5. Make sure PHP has the MongoDB extension enabled.
6. Start Apache in XAMPP.
7. Open:
   http://localhost/oss-micro-project-mongodb/

MongoDB Compass:
Connect to:
mongodb://127.0.0.1:27017

The database college_notice_board will be created automatically after the first successful connection/write.
