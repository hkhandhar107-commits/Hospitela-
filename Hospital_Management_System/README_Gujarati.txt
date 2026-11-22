HOSPITAL MANAGEMENT SYSTEM (College Project)
=============================================

Jaruri:
- XAMPP (Apache + MySQL)
- Browser (Chrome)
- Project folder: D:\xampp\htdocs\Hospital_Management_System
  NOTE: Tamara XAMPP nu folder D:\xampp ma hoy to aa path use karo.
  Jo XAMPP C:\xampp ma hoy, to C:\xampp\htdocs\Hospital_Management_System ma extract karo.

STEP 1: ZIP extract karo
1. ZIP file par right click > Extract All.
2. Extract thayeli Hospital_Management_System folder ne tamara XAMPP htdocs ma mukvo.
3. Folder ma index.php, config.php, database.sql vagere hova joie.

STEP 2: XAMPP start karo
1. XAMPP Control Panel open karo.
2. Apache pase Start dabavo.
3. MySQL pase Start dabavo.

STEP 3: Database import karo
1. Browser ma http://localhost/phpmyadmin kholo.
2. Import tab par click karo.
3. Choose File par click kari project ni database.sql select karo.
4. Go dabavo.
   database.sql import karvathi hospital_db database ane tables banse.

STEP 4: Database connection check
- config.php ma default settings:
  host = localhost
  user = root
  password = empty
  database = hospital_db
- Tamara MySQL root password hoy to config.php ma password update karo.

STEP 5: Website open karo
http://localhost/Hospital_Management_System/

Demo login:
Email: admin@hospital.com
Password: password
Pehla login na thay to database.sql fari import karo, ane password_hash mismatch issue mate
register.php thi navo account banavi login karo. Demo account SQL ma password_hash() supported nathi,
etle demo login mate project na login.php ma password === 'password' fallback rakhelu chhe.

FEATURES:
- Login / Registration / Logout
- Dashboard
- Patient registration and patient list
- Doctor management
- Appointment booking/list
- Billing
- Reports
- MySQL database connection via PHP

IMPORTANT:
Aa educational college project chhe. Real hospital ma patient ni sensitive information
store karva mate aa basic demo ne direct use na karsho. Security, backups, access roles,
validation ane privacy review jaruri chhe.
