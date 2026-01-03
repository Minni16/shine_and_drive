# Khalti Payment Gateway Setup Guide

## Overview
The system has been updated to use Khalti payment gateway instead of eSewa. Khalti is a popular payment gateway in Nepal that provides secure payment processing.

## Setup Instructions

### 1. Register with Khalti

1. **Visit Khalti Merchant Portal:**
   - Go to: https://khalti.com/merchant/
   - Click "Sign Up" to create a merchant account

2. **Complete KYC Process:**
   - Provide company registration documents
   - Submit PAN certificate
   - Submit tax clearance certificate
   - Complete the verification process

3. **Get API Keys:**
   - After registration, log into your merchant dashboard
   - Navigate to "Keys" section
   - Copy your **Test Secret Key** and **Test Public Key**
   - For production, you'll get **Live Secret Key** and **Live Public Key**

### 2. Configure API Keys

**File:** `cwms/user/includes/khalti-config.php`

Update the following lines with your actual API keys:

```php
// Test Mode (for development)
define('KHALTI_TEST_SECRET_KEY', 'your_test_secret_key_here');
define('KHALTI_TEST_PUBLIC_KEY', 'your_test_public_key_here');

// Production Mode (uncomment when ready)
// define('KHALTI_LIVE_SECRET_KEY', 'your_live_secret_key_here');
// define('KHALTI_LIVE_PUBLIC_KEY', 'your_live_public_key_here');
```

### 3. Test the Integration

1. **Use Test Keys:**
   - Khalti allows test transactions up to Rs 999 without signing a contract
   - Use test keys for development and testing
   - Test payments won't charge real money

2. **Test Payment Flow:**
   - Go to any package page (Basic Wash, Standard Care, or Premium Treatment)
   - Click "Pay with Khalti" button
   - You'll be redirected to Khalti payment page
   - Complete the test payment
   - You'll be redirected back and gain dashboard access

### 4. Go Live

1. **Switch to Production:**
   - In `khalti-config.php`, change:
     ```php
     define('KHALTI_ENVIRONMENT', 'live');
     ```
   - Uncomment and add your live API keys
   - Comment out test keys

2. **For Transactions Above Rs 999:**
   - Contact Khalti merchant support
   - Finalize the agreement and commission details
   - Your account will be activated for higher amounts

## How It Works

### Payment Flow:

1. **User clicks "Pay with Khalti"**
   - JavaScript calls `khalti-payment.php`
   - Payment is initiated with Khalti API
   - User is redirected to Khalti payment page

2. **User completes payment on Khalti**
   - User enters payment details on Khalti's secure page
   - Payment is processed by Khalti

3. **Khalti redirects back**
   - After successful payment, Khalti redirects to `process-payment.php`
   - Payment is verified with Khalti API
   - Payment record is saved to database
   - User gains dashboard access

### Files Involved:

1. **`cwms/user/includes/khalti-config.php`**
   - Contains API keys and configuration
   - Set your Khalti credentials here

2. **`cwms/user/khalti-payment.php`**
   - Initiates payment with Khalti API
   - Returns payment URL for redirect

3. **`cwms/user/process-payment.php`**
   - Handles payment verification
   - Verifies payment with Khalti API
   - Updates database and grants access

4. **Package Pages:**
   - `cwms/user/basic-wash.php`
   - `cwms/user/standard-care.php`
   - `cwms/user/premium-treatment.php`
   - All contain Khalti payment button

## API Endpoints Used

### Test Environment:
- API URL: `https://a.khalti.com/api/v2`
- Payment Initiation: `POST /epayment/initiate/`
- Payment Verification: `POST /epayment/lookup/`

### Production Environment:
- API URL: `https://khalti.com/api/v2`
- Same endpoints as test

## Troubleshooting

### Payment Not Initiating

1. **Check API Keys:**
   - Verify keys are correct in `khalti-config.php`
   - Ensure test keys for test environment
   - Ensure live keys for production

2. **Check Browser Console:**
   - Open Developer Tools (F12)
   - Check for JavaScript errors
   - Check Network tab for failed requests

3. **Check PHP Error Logs:**
   - Look for errors in PHP error log
   - Common issues: cURL not enabled, invalid API keys

### Payment Verification Fails

1. **Check Return URL:**
   - Ensure `KHALTI_RETURN_URL` is correct
   - Must be publicly accessible (not localhost)
   - Must match URL configured in Khalti dashboard

2. **Check API Response:**
   - Payment verification checks `status == 'Completed'`
   - Ensure payment was actually completed on Khalti

### Localhost Issues

- Khalti requires publicly accessible URLs for callbacks
- For local development:
  - Use ngrok or similar to expose localhost
  - Or use the "Test Mode" button instead
  - Or test on a live server

## Test Mode (Alternative)

Each package page still includes a "Complete Payment (Test Mode)" button that:
- Bypasses Khalti completely
- Directly processes payment
- Perfect for development without Khalti setup

## Support

- **Khalti Documentation:** https://docs.khalti.com/
- **Khalti Merchant Support:** Contact through merchant dashboard
- **Khalti API Reference:** https://docs.khalti.com/api/

## Security Notes

1. **Never commit API keys to version control**
2. **Use environment variables for production**
3. **Always verify payments server-side**
4. **Use HTTPS in production**
5. **Keep API keys secure and rotate them regularly**

