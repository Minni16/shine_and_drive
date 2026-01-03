# Payment Flow Setup Guide

## Overview
The system has been updated to implement a payment-gated access model. Users must complete a package payment before accessing the dashboard and booking features.

## Changes Made

### 1. Database Changes
**File:** `SQL File/add_user_payments_table.sql`

Run this SQL script to create the necessary tables:
- `tbluserpayments` - Tracks user package payments
- Adds `payment_completed` column to `admin` table

**To apply:**
1. Open phpMyAdmin
2. Select your database (`cwmsdb`)
3. Go to SQL tab
4. Copy and paste the contents of `SQL File/add_user_payments_table.sql`
5. Click "Go"

### 2. Authentication Flow Changes

#### Login Behavior (`cwms/login.php`)
- After login, users are redirected back to the page they came from (or index.php)
- No longer automatically redirects to dashboard
- Users can browse the site and access package pages after login

#### "Get Now" Button Behavior (`cwms/index.php`)
- **Not logged in:** Redirects to login page
- **Logged in:** Redirects directly to package payment page (basic-wash.php, standard-care.php, or premium-treatment.php)

### 3. Package Payment Pages

All three package pages have been updated:
- `cwms/user/basic-wash.php` (Rs 500)
- `cwms/user/standard-care.php` (Rs 1500)
- `cwms/user/premium-treatment.php` (Rs 2500)

**Layout:**
- Left side: Package card showing features and price
- Right side: eSewa payment form

**Features:**
- Embedded eSewa payment form
- Test mode payment button (for development/testing)
- After payment, user gains access to dashboard

### 4. Payment Processing

**File:** `cwms/user/process-payment.php`

Handles:
- eSewa payment callbacks
- Test mode payments (for development)
- Updates payment status in database
- Grants dashboard access after successful payment

### 5. Access Control

**Payment Required Pages:**
- Dashboard (`user/dashboard.php`)
- All Bookings (`user/all-bookings.php`)
- New Booking (`user/new-booking.php`)
- Booking Details (`user/booking-details.php`)
- Add Booking (`user/add-booking.php`)
- Change Password (`user/change-password.php`)

**No Payment Required:**
- Package payment pages (basic-wash.php, standard-care.php, premium-treatment.php)
- Process payment page
- Public pages (index.php, etc.)

## eSewa Integration Setup

### For Development/Testing:
The current setup uses eSewa UAT (test) environment:
- URL: `https://uat.esewa.com.np/epay/main`
- Merchant Code: `EPAYTEST`

### For Production:
1. **Update Merchant Code:**
   - Replace `EPAYTEST` with your actual eSewa merchant code
   - Update in all three package payment pages (basic-wash.php, standard-care.php, premium-treatment.php)

2. **Update eSewa URL:**
   - Change from `https://uat.esewa.com.np/epay/main` to `https://esewa.com.np/epay/main`
   - Update in all three package payment pages

3. **Implement Payment Verification:**
   - Currently, payment verification is simulated
   - In production, implement proper verification using eSewa's verification API
   - Update `process-payment.php` to verify payments with eSewa before marking as completed

4. **Update Callback URLs:**
   - Ensure `su` (success URL) and `fu` (failure URL) in the eSewa form point to your production domain
   - Currently uses relative paths which should work, but verify in production

## User Flow

1. **Unauthenticated User:**
   - Clicks "Get Now" → Redirected to login
   - After login → Returns to index.php
   - Can browse packages

2. **Authenticated User (No Payment):**
   - Clicks "Get Now" → Redirected to package payment page
   - Sees package card + eSewa form
   - Completes payment → Gains dashboard access
   - Can access all booking features

3. **Authenticated User (Payment Completed):**
   - Can access dashboard immediately
   - Can book services, view history, change password

## Testing

### Test Mode Payment:
Each package page includes a "Complete Payment (Test Mode)" button that:
- Bypasses eSewa
- Directly marks payment as completed
- Grants dashboard access
- Useful for development and testing

### eSewa Test Payment:
- Use eSewa UAT environment
- Test credentials provided by eSewa
- Verify callback handling works correctly

## Files Modified

1. `cwms/login.php` - Redirect logic
2. `cwms/index.php` - "Get Now" button links
3. `cwms/user/basic-wash.php` - Package page with payment form
4. `cwms/user/standard-care.php` - Package page with payment form
5. `cwms/user/premium-treatment.php` - Package page with payment form
6. `cwms/user/process-payment.php` - Payment processing (NEW)
7. `cwms/user/includes/payment-check.php` - Payment verification (NEW)
8. `cwms/user/dashboard.php` - Payment check added
9. `cwms/user/all-bookings.php` - Payment check added
10. `cwms/user/new-booking.php` - Payment check added
11. `cwms/user/booking-details.php` - Payment check added
12. `cwms/user/add-booking.php` - Payment check added
13. `cwms/user/change-password.php` - Payment check added

## Database Schema

### tbluserpayments
- `id` - Primary key
- `username` - User who made payment
- `packageType` - 1=Basic, 2=Standard, 3=Premium
- `amount` - Payment amount
- `paymentStatus` - pending/completed/failed
- `paymentMode` - eSewa, Card, etc.
- `transactionId` - Transaction identifier
- `esewaRefId` - eSewa reference ID
- `paymentDate` - When payment was completed
- `postingDate` - When record was created

### admin table (new column)
- `payment_completed` - 1 if user has completed at least one payment

## Notes

- Users can purchase multiple packages (each payment is tracked separately)
- Once a user completes any payment, they get dashboard access permanently
- The `payment_completed` flag in the admin table is set to 1 after first successful payment
- Package pages remain accessible even after payment (users can purchase additional packages)

