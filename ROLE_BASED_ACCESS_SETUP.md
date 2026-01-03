# Role-Based Access Control Setup Guide

## Overview
This system now implements role-based access control to separate regular users from administrators. Regular users can register and access the frontend, but only administrators can access the admin panel.

## Database Migration

### Step 1: Run the SQL Migration
Execute the SQL script to add the `role` column to the `admin` table:

**File:** `SQL File/add_role_column.sql`

You can run this in phpMyAdmin:
1. Open phpMyAdmin (http://localhost/phpmyadmin)
2. Select the `cwmsdb` database
3. Click on the "SQL" tab
4. Copy and paste the contents of `SQL File/add_role_column.sql`
5. Click "Go"

Or via MySQL command line:
```bash
mysql -u root -p cwmsdb < "SQL File/add_role_column.sql"
```

### What the Migration Does:
- Adds a `role` column (ENUM: 'admin' or 'user') to the `admin` table
- Sets existing admin user (username: 'admin') to have 'admin' role
- Sets all other users to 'user' role by default

## How It Works

### Registration (`cwms/register.php`)
- New users are registered with `role = 'user'` by default
- They are saved in the `admin` table (for simplicity, but with user role)
- Regular users **cannot** access the admin panel

### Admin Login (`cwms/admin/index.php`)
- Checks if the user exists and password is correct
- **Verifies the user has 'admin' role**
- Only users with `role = 'admin'` can log into the admin panel
- Regular users will see: "Access Denied! Only administrators can access this panel."

### Admin Pages Protection
- All admin pages now include `includes/auth-check.php`
- This file verifies:
  1. User is logged in (`$_SESSION['alogin']`)
  2. User has admin role (`$_SESSION['role'] == 'admin'`)
- If either check fails, user is redirected to login page

### Session Management
- On successful admin login, both `$_SESSION['alogin']` and `$_SESSION['role']` are set
- On logout, both session variables are cleared

## Files Modified

### Core Files:
1. **`cwms/register.php`** - Now saves users with `role='user'`
2. **`cwms/admin/index.php`** - Checks role before allowing admin access
3. **`cwms/admin/logout.php`** - Clears role from session

### New File:
- **`cwms/admin/includes/auth-check.php`** - Centralized authentication/authorization check

### Protected Admin Pages (all updated):
- `dashboard.php`
- `all-bookings.php`
- `add-booking.php`
- `addcar-washpoint.php`
- `about.php`
- `booking-details.php`
- `change-password.php`
- `completed-booking.php`
- `contact.php`
- `editcar-washpoint.php`
- `manage-enquires.php`
- `managecar-washingpoints.php`
- `new-booking.php`

## Testing

### Test Regular User Registration:
1. Go to registration page
2. Register a new user
3. Try to login to admin panel with that user
4. **Expected:** Access denied message

### Test Admin Access:
1. Login with admin credentials (username: `admin`, password: `Test@123`)
2. **Expected:** Access granted to admin dashboard

### Test Role Protection:
1. If you manually set a user's role to 'admin' in database
2. That user should now be able to access admin panel

## Making a User an Admin

To promote a regular user to admin, run this SQL:
```sql
UPDATE admin SET role = 'admin' WHERE UserName = 'username_here';
```

## Security Notes

⚠️ **Important:** The system still uses MD5 for password hashing, which is insecure. For production, consider upgrading to:
- `password_hash()` with `PASSWORD_BCRYPT` or `PASSWORD_ARGON2ID`
- Update both registration and login accordingly

## Future Enhancements

Consider creating a separate `users` table for regular users instead of using the `admin` table for both roles. This would provide better separation of concerns.

