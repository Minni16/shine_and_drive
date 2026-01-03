# Car Wash Management System - Setup Instructions

## Current Status
✅ PHP Development Server is running at: **http://localhost:8000**
❌ MySQL Database needs to be set up

## Database Setup Steps

### Option 1: Using XAMPP (Recommended for Windows)

1. **Start XAMPP Control Panel**
   - Start Apache (if not already running)
   - Start MySQL service

2. **Create Database**
   - Open phpMyAdmin: http://localhost/phpmyadmin
   - Click "New" to create a database
   - Name it: `cwmsdb`
   - Click "Create"

3. **Import SQL File**
   - Select the `cwmsdb` database
   - Click "Import" tab
   - Choose file: `SQL File/cwmsdb.sql`
   - Click "Go"

### Option 2: Using MySQL Command Line

1. **Start MySQL Service** (if using standalone MySQL)
   ```bash
   # If MySQL is installed as a service, start it from Services
   # Or use: net start MySQL (in Command Prompt as Admin)
   ```

2. **Create and Import Database**
   ```bash
   mysql -u root -p
   CREATE DATABASE cwmsdb;
   USE cwmsdb;
   SOURCE SQL\ File/cwmsdb.sql;
   ```

### Option 3: Using WAMP

1. Start WAMP server
2. Open phpMyAdmin: http://localhost/phpmyadmin
3. Follow steps 2-3 from Option 1

## Database Configuration

The database is configured in:
- `cwms/includes/config.php`
- `cwms/admin/includes/config.php`

Default settings:
- Host: `localhost`
- User: `root`
- Password: `` (empty)
- Database: `cwmsdb`

If your MySQL has a different password, update these files.

## Access the Application

Once database is set up:
- **Frontend**: http://localhost:8000/
- **Admin Panel**: http://localhost:8000/admin/

## Admin Credentials
- Username: `admin`
- Password: `Test@123`

## Stop the Server

Press `Ctrl+C` in the terminal where the server is running, or close the terminal window.

