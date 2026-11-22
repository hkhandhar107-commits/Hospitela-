MEDICARE HOSPITAL MANAGEMENT SYSTEM (PHP + MySQL)
==================================================

FEATURES
- Login/logout with password hashing
- Dashboard summary and recent appointments
- Patient create, list, search, edit, delete
- Doctor create, list, search, edit, delete
- Appointment booking and status updates
- Bills, paid/unpaid status and totals
- Responsive blue/white layout

REQUIREMENTS
- XAMPP with Apache, MySQL and PHP PDO MySQL enabled
- Web browser

INSTALLATION (Windows + XAMPP)
1. Extract the Hospital_Management_System folder into:
   C:\xampp\htdocs\Hospital_Management_System\
2. Open XAMPP Control Panel and start Apache and MySQL.
3. Open http://localhost/phpmyadmin/
4. Click Import, select database.sql from this folder, then click Import/Go.
   Alternatively, open the SQL tab and paste the contents of database.sql.
5. Check config.php. Default XAMPP settings are host=localhost, user=root,
   password blank, database=hospital_db. Update if your MySQL credentials differ.
6. In your browser open:
   http://localhost/Hospital_Management_System/setup_admin.php
7. It creates the initial admin login:
   Email: admin@hospital.com
   Password: Admin@123
8. IMPORTANT: Delete setup_admin.php after the admin is created.
9. Open http://localhost/Hospital_Management_System/
10. Open home.php for the Home page. Use Register to create a staff account, or sign in with the initial admin account.
11. Start by adding patients and doctors, then appointments and bills.

TROUBLESHOOTING
- "Database connection failed": make sure MySQL is running, import database.sql,
  and verify config.php credentials and the database name.
- Blank page/PHP error: check Apache's error log in XAMPP.
- PDO driver issue: enable pdo_mysql in the PHP configuration used by XAMPP.
- Port 80/443 conflict: resolve the conflict in XAMPP before starting Apache.

SECURITY / PROJECT LIMITATIONS
- This is an educational starter project, not a certified clinical system.
- Change the initial password immediately and remove setup_admin.php.
- For real deployment, add CSRF protection, role/permission management, audit logs,
  backups, HTTPS, stronger validation and privacy/security review.
- Do not enter real patient medical information into a public deployment.
