# eSewa Payment Integration Troubleshooting Guide

## Common Issues and Solutions

### 1. **Form Not Submitting / No Redirect to eSewa**

**Symptoms:**
- Clicking "Pay with eSewa" button does nothing
- Page doesn't redirect to eSewa payment page

**Possible Causes:**
- JavaScript errors on the page
- Form action URL is incorrect
- Browser blocking the redirect

**Solutions:**
1. **Check Browser Console:**
   - Open browser Developer Tools (F12)
   - Check Console tab for JavaScript errors
   - Fix any errors found

2. **Verify Form Action:**
   - The form should POST to: `https://uat.esewa.com.np/epay/main` (for testing)
   - For production: `https://esewa.com.np/epay/main`

3. **Test Form Submission:**
   - Right-click on "Pay with eSewa" button
   - Select "Inspect Element"
   - Check if the form has all required hidden fields

4. **Check Network Tab:**
   - Open Developer Tools → Network tab
   - Click "Pay with eSewa"
   - See if a POST request is made to eSewa
   - Check the response

### 2. **eSewa Page Shows Error / Invalid Merchant**

**Symptoms:**
- Redirects to eSewa but shows error message
- "Invalid merchant code" or similar error

**Possible Causes:**
- Using test merchant code `EPAYTEST` which may not be active
- Merchant code not registered with eSewa
- Wrong environment (UAT vs Production)

**Solutions:**
1. **For Testing:**
   - Use the "Complete Payment (Test Mode)" button instead
   - This bypasses eSewa and directly processes payment
   - Useful for development and testing

2. **For Production:**
   - Register with eSewa to get your merchant credentials
   - Replace `EPAYTEST` with your actual merchant code
   - Update in all three package files:
     - `cwms/user/basic-wash.php`
     - `cwms/user/standard-care.php`
     - `cwms/user/premium-treatment.php`

3. **Check Merchant Code:**
   - Line with `id="scd"` should have your merchant code
   - Currently set to `EPAYTEST` for testing

### 3. **Payment Success but Not Redirecting Back**

**Symptoms:**
- Payment completes on eSewa
- But doesn't redirect back to your site
- Or redirects to wrong page

**Possible Causes:**
- Incorrect callback URLs (su/fu parameters)
- URLs not accessible from internet (localhost issue)
- URL encoding issues

**Solutions:**
1. **Check Callback URLs:**
   - The `su` (success URL) should point to: `yourdomain.com/cwms/user/process-payment.php`
   - The `fu` (failure URL) should point back to the package page
   - URLs must be accessible from the internet (not localhost)

2. **For Local Development:**
   - Use a tool like ngrok to expose localhost
   - Or use the "Test Mode" payment button instead

3. **Verify URL Format:**
   - URLs should be absolute (starting with http:// or https://)
   - No trailing slashes
   - Properly encoded if needed

4. **Check process-payment.php:**
   - Ensure the file exists and is accessible
   - Check file permissions
   - Verify it can handle GET parameters from eSewa

### 4. **Payment Processed but Dashboard Still Locked**

**Symptoms:**
- Payment completes successfully
- But still can't access dashboard
- Shows "Please complete payment" message

**Possible Causes:**
- Database table not created
- Payment not being saved to database
- Payment status not being updated

**Solutions:**
1. **Run Database Migration:**
   ```sql
   -- Run the SQL file: SQL File/add_user_payments_table.sql
   ```

2. **Check Database:**
   - Verify `tbluserpayments` table exists
   - Check if payment record was inserted
   - Verify `payment_completed` column exists in `admin` table

3. **Check Payment Status:**
   ```sql
   SELECT * FROM tbluserpayments WHERE username = 'your_username';
   SELECT payment_completed FROM admin WHERE UserName = 'your_username';
   ```

4. **Check process-payment.php:**
   - Verify it's updating both tables
   - Check for PHP errors in error logs

### 5. **Session Issues**

**Symptoms:**
- Payment completes but user is logged out
- Can't access dashboard after payment

**Possible Causes:**
- Session not maintained during eSewa redirect
- Session timeout
- Session cookie issues

**Solutions:**
1. **Check Session Configuration:**
   - Ensure `session_start()` is called in process-payment.php
   - Verify session is maintained across redirects

2. **Check Session Variables:**
   - After payment callback, verify `$_SESSION['alogin']` exists
   - Check if session is being destroyed somewhere

### 6. **Testing eSewa Integration**

**For Development/Testing:**

1. **Use Test Mode Button:**
   - Each package page has a "Complete Payment (Test Mode)" button
   - This bypasses eSewa and directly processes payment
   - Perfect for testing the payment flow without eSewa

2. **Test eSewa UAT:**
   - eSewa UAT environment: `https://uat.esewa.com.np`
   - May require registration or special test credentials
   - Contact eSewa for UAT access

3. **Check Error Logs:**
   - Check PHP error logs for any issues
   - Check browser console for JavaScript errors
   - Check network tab for failed requests

### 7. **Production Setup Checklist**

Before going live:

- [ ] Register with eSewa and get merchant credentials
- [ ] Replace `EPAYTEST` with actual merchant code
- [ ] Update eSewa URL from UAT to production
- [ ] Ensure callback URLs are publicly accessible
- [ ] Implement proper payment verification with eSewa API
- [ ] Test complete payment flow end-to-end
- [ ] Set up error logging and monitoring
- [ ] Test with real eSewa account (small amount)

### 8. **Debugging Tips**

1. **View Form Data:**
   Add this before the form to see what's being sent:
   ```php
   <?php if (isset($_GET['debug'])): ?>
   <pre>
   Success URL: <?php echo $successUrl; ?>
   Failure URL: <?php echo $failureUrl; ?>
   Product ID: <?php echo $productId; ?>
   </pre>
   <?php endif; ?>
   ```
   Then access page with `?debug=1`

2. **Check eSewa Response:**
   In `process-payment.php`, add:
   ```php
   error_log("eSewa Callback: " . print_r($_GET, true));
   ```

3. **Test URLs:**
   Manually test if callback URLs are accessible:
   - Visit: `yourdomain.com/cwms/user/process-payment.php`
   - Should not show 404 error

## Quick Fix: Use Test Mode

If eSewa integration is not working, you can use the **"Complete Payment (Test Mode)"** button on each package page. This:
- Bypasses eSewa completely
- Directly processes payment
- Grants dashboard access
- Perfect for development and testing

## Getting Help

If issues persist:
1. Check PHP error logs
2. Check browser console for errors
3. Verify database tables exist
4. Test with "Test Mode" button first
5. Contact eSewa support for merchant/API issues

